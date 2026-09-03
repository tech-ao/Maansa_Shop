<?php

namespace App\Models;
use DB;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $fillable = [
        'user_id',
        'user_info',
        'cart',
        'shipping',
        'discount',
        'payment_method',
        'txnid',
        'charge_id',
        'transaction_number',
        'order_status',
        'payment_status',
        'shipping_info',
        'billing_info',
        'currency_sign',
        'currency_value',
        'tax',
        'state_price',
        'state'
    ];

    public function user()
    {
    	return $this->belongsTo('App\Models\User')->withDefault();
    }

    public function tracks()
    {
    	return $this->belongsTo('App\Models\TrackOrder','order_id')->withDefault();
    }

    public function tranaction()
    {
    	return $this->hasOne('App\Models\Transaction','order_id')->withDefault();
    }

    public function tracks_data()
    {
    	return $this->hasMany('App\Models\TrackOrder','order_id');
    }

    public function notificaton()
    {
    	return $this->hasMany('App\Models\Notification','order_id');
    }

    public static function linkGuestOrdersToUser($user)
    {
        if (!$user || empty($user->email)) {
            return;
        }

        $email = strtolower(trim($user->email));

        // 1. Find guest orders where user_id is 0 or null
        $guestOrders = self::where(function ($q) {
            $q->whereNull('user_id')->orWhere('user_id', 0);
        })->get();

        foreach ($guestOrders as $order) {
            $billing = json_decode($order->billing_info, true) ?: [];
            $shipping = json_decode($order->shipping_info, true) ?: [];

            $billEmail = isset($billing['bill_email']) ? strtolower(trim($billing['bill_email'])) : '';
            $shipEmail = isset($shipping['ship_email']) ? strtolower(trim($shipping['ship_email'])) : '';

            if ($billEmail === $email || $shipEmail === $email) {
                $order->user_id = $user->id;
                $order->save();
            }
        }

        // 2. Also link Transaction records
        try {
            \App\Models\Transaction::where(function ($q) {
                $q->whereNull('user_id')->orWhere('user_id', 0);
            })->whereRaw('LOWER(user_email) = ?', [$email])->update(['user_id' => $user->id]);
        } catch (\Throwable $e) {}
    }

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($order) {
            if (empty($order->user_id) || $order->user_id == 0) {
                if (!empty($order->billing_info)) {
                    $billing = is_array($order->billing_info) ? $order->billing_info : json_decode($order->billing_info, true);
                    $billEmail = $billing['bill_email'] ?? null;
                    if ($billEmail) {
                        $regUser = \App\Models\User::where('email', strtolower(trim($billEmail)))->first();
                        if ($regUser) {
                            $order->user_id = $regUser->id;
                        }
                    }
                }
            }
        });

        static::created(function ($order) {
            if (empty($order->user_id) || $order->user_id == 0) {
                if (!empty($order->billing_info)) {
                    $billing = is_array($order->billing_info) ? $order->billing_info : json_decode($order->billing_info, true);
                    if ($billing && is_array($billing)) {
                        \App\Models\GuestUser::storeOrUpdateGuest($billing, $order);
                    }
                }
            }
        });
    }
}
