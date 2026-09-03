<?php

/**
 * Created by UniverseCode.
 */

namespace App\Helpers;

use App\{
    Models\EmailTemplate,
    Models\Order,
    Models\Setting
};
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Session;
use PHPMailer\PHPMailer\{
    PHPMailer,
    Exception
};
use Dompdf\Dompdf;
use Dompdf\Options;

class EmailHelper
{

    public $mail;
    public $setting;

    public function __construct()
    {
        $this->setting = Setting::first();

        $this->mail = new PHPMailer(true);

        if ($this->setting && $this->setting->smtp_check == 1) {
            $this->mail->isSMTP();
            $this->mail->Host       = trim($this->setting->email_host);
            $this->mail->SMTPAuth   = true;
            $this->mail->Username   = trim($this->setting->email_user);
            $this->mail->Password   = $this->setting->email_pass;

            $port = (int)trim($this->setting->email_port);
            $encryption = strtolower(trim($this->setting->email_encryption ?? ''));

            if ($port === 465 || $encryption === 'ssl') {
                $this->mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;
                $this->mail->Port       = $port ?: 465;
            } else {
                $this->mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
                $this->mail->Port       = $port ?: 587;
            }

            $this->mail->Timeout       = 6;
            $this->mail->Timelimit     = 6;
            $this->mail->SMTPKeepAlive = false;
            $this->mail->CharSet       = 'UTF-8';
            $this->mail->SMTPOptions   = [
                'ssl' => [
                    'verify_peer'       => false,
                    'verify_peer_name'  => false,
                    'allow_self_signed' => true
                ]
            ];
        }
    }

    private function getFromEmail()
    {
        if (!empty($this->setting->email_from)) {
            return trim($this->setting->email_from);
        }
        return !empty($this->setting->email_user) ? trim($this->setting->email_user) : 'help@techao.in';
    }

    private function getFromName()
    {
        if (!empty($this->setting->email_from_name)) {
            return $this->setting->email_from_name;
        }
        return !empty($this->setting->title) ? $this->setting->title : 'Maansa';
    }

    public function sendTemplateMail(array $emailData)
    {
        try {
            // Check if this is an Order confirmation email
            if (isset($emailData['type']) && strtolower($emailData['type']) === 'order') {
                $order = null;
                if (!empty($emailData['order_id'])) {
                    $order = Order::find($emailData['order_id']);
                } elseif (!empty($emailData['transaction_number'])) {
                    $order = Order::where('transaction_number', $emailData['transaction_number'])->latest()->first();
                }

                if ($order) {
                    return $this->sendOrderMail($order, $emailData['to'] ?? null);
                }
            }

            $template = EmailTemplate::whereType($emailData['type'])->first();
            if (!$template) {
                Log::warning("Email template type '{$emailData['type']}' not found.");
                return false;
            }

            $userName = $emailData['user_name'] ?? 'Customer';
            $orderCost = $emailData['order_cost'] ?? '';
            $txnNumber = $emailData['transaction_number'] ?? '';
            $siteTitle = $this->setting->title ?? 'Maansa';

            $email_body = preg_replace("/{user_name}/", $userName, $template->body);
            $email_body = preg_replace("/{order_cost}/", $orderCost, $email_body);
            $email_body = preg_replace("/{transaction_number}/", $txnNumber, $email_body);
            $email_body = preg_replace("/{site_title}/", $siteTitle, $email_body);

            $this->mail->clearAddresses();
            $this->mail->clearAttachments();
            $this->mail->setFrom($this->getFromEmail(), $this->getFromName());
            $this->mail->addAddress($emailData['to']);
            $this->mail->isHTML(true);
            $this->mail->Subject = $template->subject;
            $this->mail->Body    = $email_body;
            $this->mail->send();

            if (isset($this->setting->order_mail) && $this->setting->order_mail == 1) {
                $this->adminMail($emailData);
            }
            return true;
        } catch (\Throwable $e) {
            Log::error('EmailHelper sendTemplateMail error: ' . $e->getMessage());
            return false;
        }
    }

    public function sendOrderMail($order, $toEmail = null)
    {
        try {
            if (is_numeric($order)) {
                $order = Order::find($order);
            }
            if (!$order) {
                Log::warning("EmailHelper: order not found for sendOrderMail");
                return false;
            }

            $cart = is_array($order->cart) ? $order->cart : json_decode($order->cart, true);
            $bill = is_array($order->billing_info) ? $order->billing_info : json_decode($order->billing_info, true);
            $ship = is_array($order->shipping_info) ? $order->shipping_info : json_decode($order->shipping_info, true);
            $state = is_array($order->state) ? $order->state : json_decode($order->state, true);
            $shipping = is_array($order->shipping) ? $order->shipping : json_decode($order->shipping, true);
            $discount = is_array($order->discount) ? $order->discount : json_decode($order->discount, true);

            $customerEmail = !empty($toEmail) ? $toEmail : ($bill['bill_email'] ?? ($order->user->email ?? null));
            if (empty($customerEmail)) {
                $customerEmail = self::getEmail();
            }

            // 1. Generate Base64 Logo for PDF Invoice if exists
            $logoBase64 = null;
            if (!empty($this->setting->logo)) {
                $candidates = [
                    base_path('public/storage/images/' . $this->setting->logo),
                    base_path('../assets/images/' . $this->setting->logo),
                    public_path('storage/images/' . $this->setting->logo),
                    public_path('assets/images/' . $this->setting->logo)
                ];
                foreach ($candidates as $cand) {
                    if (file_exists($cand)) {
                        $logoData = file_get_contents($cand);
                        $mime = mime_content_type($cand) ?: 'image/png';
                        $logoBase64 = 'data:' . $mime . ';base64,' . base64_encode($logoData);
                        break;
                    }
                }
            }

            // 2. Generate PDF Invoice in Memory via Dompdf
            $pdfBytes = null;
            try {
                $pdfHtml = view('mail.invoice_pdf', [
                    'order' => $order,
                    'setting' => $this->setting,
                    'cart' => $cart ?: [],
                    'bill' => $bill ?: [],
                    'ship' => $ship ?: [],
                    'state' => $state ?: [],
                    'shipping' => $shipping ?: [],
                    'discount' => $discount ?: [],
                    'logoBase64' => $logoBase64,
                ])->render();

                $options = new Options();
                $options->set('isRemoteEnabled', true);
                $options->set('isHtml5ParserEnabled', true);
                $options->set('defaultFont', 'DejaVu Sans');
                $dompdf = new Dompdf($options);
                $dompdf->loadHtml($pdfHtml);
                $dompdf->setPaper('A4', 'portrait');
                $dompdf->render();
                $pdfBytes = $dompdf->output();
            } catch (\Throwable $pdfEx) {
                Log::error('PDF Invoice Generation Error: ' . $pdfEx->getMessage());
            }

            // 3. Send Rich HTML Confirmation to Customer with Attached PDF
            if (!empty($customerEmail)) {
                $customerHtml = view('mail.order_confirmation', [
                    'order' => $order,
                    'setting' => $this->setting,
                    'cart' => $cart ?: [],
                    'bill' => $bill ?: [],
                    'ship' => $ship ?: [],
                    'state' => $state ?: [],
                    'shipping' => $shipping ?: [],
                    'discount' => $discount ?: [],
                ])->render();

                $this->mail->clearAddresses();
                $this->mail->clearAttachments();
                $this->mail->setFrom($this->getFromEmail(), $this->getFromName());
                $this->mail->addAddress($customerEmail);
                $this->mail->isHTML(true);
                $this->mail->Subject = "Order Confirmed: #{$order->transaction_number} - " . ($this->setting->title ?: 'Maansa');
                $this->mail->Body    = $customerHtml;

                if ($pdfBytes) {
                    $this->mail->addStringAttachment($pdfBytes, "Invoice-{$order->transaction_number}.pdf", 'base64', 'application/pdf');
                }

                $this->mail->send();
            }

            // 4. Send Rich HTML Notification to Admin
            if (isset($this->setting->order_mail) && $this->setting->order_mail == 1) {
                $adminEmail = !empty($this->setting->contact_email) ? $this->setting->contact_email : $this->setting->email_user;
                if (!empty($adminEmail)) {
                    $adminHtml = view('mail.admin_order_notification', [
                        'order' => $order,
                        'setting' => $this->setting,
                        'cart' => $cart ?: [],
                        'bill' => $bill ?: [],
                        'ship' => $ship ?: [],
                        'state' => $state ?: [],
                        'shipping' => $shipping ?: [],
                        'discount' => $discount ?: [],
                    ])->render();

                    $this->mail->clearAddresses();
                    $this->mail->clearAttachments();
                    $this->mail->setFrom($this->getFromEmail(), $this->getFromName());
                    $this->mail->addAddress($adminEmail);
                    $this->mail->isHTML(true);
                    $this->mail->Subject = "🛒 New Order Received: #{$order->transaction_number} - " . ($bill['bill_first_name'] ?? 'Customer');
                    $this->mail->Body    = $adminHtml;

                    $this->mail->send();
                }
            }

            return true;
        } catch (\Throwable $e) {
            Log::error('EmailHelper sendOrderMail error: ' . $e->getMessage());
            return false;
        }
    }

    public function sendOrderShippedMail($order, $toEmail = null)
    {
        try {
            if (is_numeric($order)) {
                $order = Order::find($order);
            }
            if (!$order) {
                Log::warning("EmailHelper: order not found for sendOrderShippedMail");
                return false;
            }

            $bill = is_array($order->billing_info) ? $order->billing_info : json_decode($order->billing_info, true);
            $customerEmail = !empty($toEmail) ? $toEmail : ($bill['bill_email'] ?? ($order->user->email ?? null));
            if (empty($customerEmail)) {
                return false;
            }

            $customerHtml = view('mail.order_shipped', [
                'order' => $order,
                'setting' => $this->setting,
            ])->render();

            $this->mail->clearAddresses();
            $this->mail->clearAttachments();
            $this->mail->setFrom($this->getFromEmail(), $this->getFromName());
            $this->mail->addAddress($customerEmail);
            $this->mail->isHTML(true);
            $this->mail->Subject = "📦 Your Order Has Been Shipped: #{$order->transaction_number} - " . ($this->setting->title ?: 'Maansa');
            $this->mail->Body    = $customerHtml;
            $this->mail->send();

            return true;
        } catch (\Throwable $e) {
            Log::error('EmailHelper sendOrderShippedMail error: ' . $e->getMessage());
            return false;
        }
    }

    public function sendCustomMail(array $emailData)
    {
        try {
            $this->mail->clearAddresses();
            $this->mail->clearAttachments();
            $this->mail->setFrom($this->getFromEmail(), $this->getFromName());
            $this->mail->addAddress($emailData['to']);
            $this->mail->isHTML(true);
            $this->mail->Subject = $emailData['subject'] ?? '';
            $this->mail->Body    = $emailData['body'] ?? '';

            $this->mail->send();
            return true;
        } catch (\Throwable $e) {
            Log::error('SMTP Mail Error in sendCustomMail: ' . $e->getMessage());
            return false;
        }
    }

    public static function getEmail()
    {
        $user = Auth::user();
        if (isset($user)) {
            $email = $user->email;
        } else {
            $email = Session::get('billing_address')['bill_email'] ?? '';
        }
        return $email;
    }

    public function adminMail(array $emailData)
    {
        try {
            $template = EmailTemplate::whereType('New Order Admin')->first();
            if (!$template) {
                return false;
            }

            $userName = $emailData['user_name'] ?? 'Customer';
            $orderCost = $emailData['order_cost'] ?? '';
            $txnNumber = $emailData['transaction_number'] ?? '';
            $siteTitle = $this->setting->title ?? 'Maansa';

            $email_body = preg_replace("/{user_name}/", $userName, $template->body);
            $email_body = preg_replace("/{order_cost}/", $orderCost, $email_body);
            $email_body = preg_replace("/{transaction_number}/", $txnNumber, $email_body);
            $email_body = preg_replace("/{site_title}/", $siteTitle, $email_body);

            $adminEmail = !empty($this->setting->contact_email) ? $this->setting->contact_email : $this->setting->email_user;
            if (empty($adminEmail)) {
                return false;
            }

            $this->mail->clearAddresses();
            $this->mail->clearAttachments();
            $this->mail->setFrom($this->getFromEmail(), $this->getFromName());
            $this->mail->addAddress($adminEmail);
            $this->mail->isHTML(true);
            $this->mail->Subject = $template->subject;
            $this->mail->Body    = $email_body;

            $this->mail->send();
            return true;
        } catch (\Throwable $th) {
            Log::error('EmailHelper adminMail error: ' . $th->getMessage());
            return false;
        }
    }
}
