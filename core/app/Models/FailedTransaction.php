<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

class FailedTransaction extends Model
{
    protected $fillable = [
        'user_id',
        'email',
        'phone',
        'user_name',
        'gateway',
        'amount',
        'currency_sign',
        'currency_value',
        'error_message',
        'ip_address',
        'attempts',
        'last_attempt_at'
    ];

    protected $dates = ['last_attempt_at'];

    public function user()
    {
        return $this->belongsTo('App\Models\User', 'user_id')->withDefault();
    }

    public static function record(array $data)
    {
        try {
            $email = $data['email'] ?? null;
            $ip = $data['ip_address'] ?? request()->ip();
            $gateway = $data['gateway'] ?? 'Online Gateway';

            $query = self::where('created_at', '>=', Carbon::now()->subHours(24));
            if (!empty($email)) {
                $query->where('email', $email);
            } else {
                $query->where('ip_address', $ip);
            }
            if (!empty($gateway)) {
                $query->where('gateway', $gateway);
            }

            $recent = $query->latest()->first();

            if ($recent) {
                $recent->attempts += 1;
                if (!empty($data['error_message'])) {
                    $recent->error_message = $data['error_message'];
                }
                if (!empty($data['amount'])) {
                    $recent->amount = $data['amount'];
                }
                if (!empty($data['phone']) && empty($recent->phone)) {
                    $recent->phone = $data['phone'];
                }
                if (!empty($data['user_name']) && empty($recent->user_name)) {
                    $recent->user_name = $data['user_name'];
                }
                $recent->last_attempt_at = Carbon::now();
                $recent->save();
                return $recent;
            }

            return self::create([
                'user_id' => $data['user_id'] ?? (Auth::check() ? Auth::id() : 0),
                'email' => $email,
                'phone' => $data['phone'] ?? null,
                'user_name' => $data['user_name'] ?? null,
                'gateway' => $gateway,
                'amount' => $data['amount'] ?? 0,
                'currency_sign' => $data['currency_sign'] ?? '₹',
                'currency_value' => $data['currency_value'] ?? 1,
                'error_message' => $data['error_message'] ?? 'Payment Failed / Cancelled',
                'ip_address' => $ip,
                'attempts' => 1,
                'last_attempt_at' => Carbon::now(),
            ]);
        } catch (\Throwable $e) {
            \Illuminate\Support\Facades\Log::error('FailedTransaction::record error: ' . $e->getMessage());
            return null;
        }
    }
}
