<?php

/**
 * Created by UniverseCode.
 */

namespace App\Helpers;

use App\{
    Models\EmailTemplate,
    Models\Setting
};
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Session;
use PHPMailer\PHPMailer\{
    PHPMailer,
    Exception
};

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
