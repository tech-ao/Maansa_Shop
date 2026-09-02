<?php

namespace App\Http\Controllers\User;

use App\Helpers\EmailHelper;
use App\Http\Controllers\Controller;
use App\Jobs\EmailSendJob;
use App\Models\Message;
use App\Models\Setting;
use App\Models\Ticket;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class TicketController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('localize');
    }

    public function ticket()
    {
        $tickets = Ticket::where('user_id', Auth::user()->id)->get();
        return view('user.dashboard.ticket', compact('tickets'));
    }

    public function ticketNew()
    {
        return view('user.dashboard.ticket-new');
    }

    public function ticketView($id)
    {
        $ticket = Ticket::findOrFail($id);
        return view('user.dashboard.ticket-view', compact('ticket'));
    }

    public function ticketStore(Request $request)
    {
        // validations 
        $request->validate([
            'file' => 'file|mimes:zip|max:5000',
            'message' => 'required|max:255',
            'subject' => 'required|max:255'
        ]);
        $input = $request->all();
        $input['user_id'] = Auth::user()->id;
        $input['status'] = 'Open';
        // file upload 
        if ($request->has('file') && $request->file->getClientOriginalExtension() != 'zip') {
            Session::flash('error', __('File type not supported.'));
        }
        if ($request->has('file')) {
            $file = $request->file;
            $name = time() . str_replace(' ', '', $file->getClientOriginalName());
            $file->move('assets/files/', $name);
            $input['file'] = $name;
        }
        $ticket = Ticket::create($input);

        $message = new Message();
        $message->ticket_id = $ticket->id;
        $message->user_id = Auth::user()->id;
        $message->message = $request->message;
        $message->save();

        $setting = Setting::first();
        $adminEmail = $setting->contact_email ?: ($setting->email ?: ($setting->email_from ?: 'support@maansa.in'));
        $user = Auth::user();
        $userName = trim(($user->first_name ?? '') . ' ' . ($user->last_name ?? ''));
        if (empty($userName)) {
            $userName = $user->email ?? 'Customer';
        }

        $mailBody = "
        <div style='font-family: Arial, sans-serif; max-width: 600px; margin: 0 auto; padding: 20px; border: 1px solid #e2e8f0; border-radius: 12px; background: #ffffff;'>
            <div style='background: #10b981; color: #ffffff; padding: 16px 20px; border-radius: 8px 8px 0 0;'>
                <h2 style='margin: 0; font-size: 20px;'>New Support Ticket #{$ticket->id}</h2>
            </div>
            <div style='padding: 20px;'>
                <p style='font-size: 15px; color: #334155; margin-bottom: 16px;'>A new support ticket has been raised by a customer:</p>
                <table style='width: 100%; border-collapse: collapse; margin-bottom: 20px;'>
                    <tr>
                        <td style='padding: 8px 0; color: #64748b; width: 130px; font-weight: bold;'>Ticket ID:</td>
                        <td style='padding: 8px 0; color: #0f172a; font-weight: bold;'>#{$ticket->id}</td>
                    </tr>
                    <tr>
                        <td style='padding: 8px 0; color: #64748b; font-weight: bold;'>Customer:</td>
                        <td style='padding: 8px 0; color: #0f172a;'>" . htmlspecialchars($userName) . " (" . htmlspecialchars($user->email) . ")</td>
                    </tr>
                    <tr>
                        <td style='padding: 8px 0; color: #64748b; font-weight: bold;'>Subject:</td>
                        <td style='padding: 8px 0; color: #0f172a; font-weight: 600;'>" . htmlspecialchars($ticket->subject) . "</td>
                    </tr>
                    <tr>
                        <td style='padding: 8px 0; color: #64748b; font-weight: bold;'>Status:</td>
                        <td style='padding: 8px 0;'><span style='background: #ecfdf5; color: #059669; padding: 4px 10px; border-radius: 999px; font-weight: bold; font-size: 12px;'>" . htmlspecialchars($ticket->status) . "</span></td>
                    </tr>
                </table>
                <div style='background: #f8fafc; border-left: 4px solid #10b981; padding: 14px 18px; border-radius: 6px; margin-bottom: 24px;'>
                    <p style='margin: 0 0 6px 0; font-weight: bold; color: #334155;'>Customer Message:</p>
                    <p style='margin: 0; color: #475569; white-space: pre-wrap;'>" . nl2br(htmlspecialchars($request->message)) . "</p>
                </div>
                <div style='text-align: center; margin-top: 24px;'>
                    <a href='" . route('back.ticket.edit', $ticket->id) . "' style='display: inline-block; background: #10b981; color: #ffffff; padding: 12px 28px; border-radius: 8px; text-decoration: none; font-weight: bold; font-size: 14px;'>View & Reply in Admin Panel</a>
                </div>
            </div>
        </div>
        ";

        $mailData = [
            'to' => $adminEmail,
            'type' => 'ticket',
            'subject' => "[New Support Ticket #{$ticket->id}] - " . $ticket->subject,
            'body' => $mailBody
        ];

        try {
            if ($setting->is_queue_enabled == 1) {
                dispatch(new EmailSendJob($mailData));
            } else {
                $email = new EmailHelper();
                $email->sendCustomMail($mailData);
            }
        } catch (\Throwable $e) {
            \Illuminate\Support\Facades\Log::error('Ticket notification email failed: ' . $e->getMessage());
        }

        Session::flash('success', __('Ticket Created Successfully.'));
        return redirect()->route('user.ticket');
    }


    public function ticketReply(Request $request)
    {
        $request->validate([
            'message' => 'required|max:255'
        ]);
        $message = new Message();
        $message->ticket_id = $request->ticket_id;
        $message->user_id = Auth::user()->id;
        $message->message = $request->message;
        $message->save();

        $ticket = Ticket::find($request->ticket_id);
        if ($ticket) {
            $ticket->status = 'Open';
            $ticket->save();
        }

        $setting = Setting::first();
        $adminEmail = $setting->contact_email ?: ($setting->email ?: ($setting->email_from ?: 'support@maansa.in'));
        $user = Auth::user();
        $userName = trim(($user->first_name ?? '') . ' ' . ($user->last_name ?? ''));
        if (empty($userName)) {
            $userName = $user->email ?? 'Customer';
        }

        $replyBody = "
        <div style='font-family: Arial, sans-serif; max-width: 600px; margin: 0 auto; padding: 20px; border: 1px solid #e2e8f0; border-radius: 12px; background: #ffffff;'>
            <div style='background: #0284c7; color: #ffffff; padding: 16px 20px; border-radius: 8px 8px 0 0;'>
                <h2 style='margin: 0; font-size: 20px;'>New Reply on Ticket #" . ($ticket ? $ticket->id : $request->ticket_id) . "</h2>
            </div>
            <div style='padding: 20px;'>
                <p style='font-size: 15px; color: #334155; margin-bottom: 16px;'>Customer <strong>" . htmlspecialchars($userName) . "</strong> has posted a new reply:</p>
                <div style='background: #f8fafc; border-left: 4px solid #0284c7; padding: 14px 18px; border-radius: 6px; margin-bottom: 24px;'>
                    <p style='margin: 0; color: #475569; white-space: pre-wrap;'>" . nl2br(htmlspecialchars($request->message)) . "</p>
                </div>
                <div style='text-align: center; margin-top: 24px;'>
                    <a href='" . route('back.ticket.edit', $request->ticket_id) . "' style='display: inline-block; background: #0284c7; color: #ffffff; padding: 12px 28px; border-radius: 8px; text-decoration: none; font-weight: bold; font-size: 14px;'>View Thread & Reply</a>
                </div>
            </div>
        </div>
        ";

        $mailData = [
            'to' => $adminEmail,
            'type' => 'ticket',
            'subject' => "[New Reply on Ticket #" . ($ticket ? $ticket->id : $request->ticket_id) . "] - " . ($ticket ? $ticket->subject : 'Support Ticket'),
            'body' => $replyBody
        ];

        try {
            if ($setting->is_queue_enabled == 1) {
                dispatch(new EmailSendJob($mailData));
            } else {
                $email = new EmailHelper();
                $email->sendCustomMail($mailData);
            }
        } catch (\Throwable $e) {
            \Illuminate\Support\Facades\Log::error('Ticket reply email failed: ' . $e->getMessage());
        }

        Session::flash('success', __('Reply Send Successfully.'));
        return redirect()->back();
    }


    public function ticketDelete($id)
    {
        if (Ticket::whereId($id)->where('user_id', Auth::user()->id)->exists()) {
            $ticket = Ticket::findOrFail($id);
            $messages = $ticket->messages;
            if ($messages->count() > 0) {
                foreach ($messages as $message) {
                    $message->delete();
                }
            }
            if ($ticket->file) {
                @unlink('assets/files/' . $ticket->file);
            }
            $ticket->delete();
            Session::flash('success', __('Ticket Delete Successfully.'));
            return redirect()->back();
        }
    }
}
