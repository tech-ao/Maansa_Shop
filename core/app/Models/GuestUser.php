<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;

class GuestUser extends Model
{
    protected $table = 'guest_users';

    protected $fillable = [
        'first_name',
        'last_name',
        'email',
        'phone',
        'bill_address1',
        'bill_address2',
        'bill_zip',
        'bill_city',
        'bill_country',
        'bill_company',
        'total_orders',
        'last_order_at',
    ];

    protected $dates = [
        'last_order_at',
        'created_at',
        'updated_at'
    ];

    /**
     * Get display name of guest customer.
     */
    public function name()
    {
        $fullName = trim(($this->first_name ?? '') . ' ' . ($this->last_name ?? ''));
        return $fullName !== '' ? $fullName : __('Guest Customer');
    }

    /**
     * Get all orders related to this guest customer.
     */
    public function getOrders()
    {
        $email = $this->email;
        $phone = $this->phone;

        return Order::where(function ($query) {
            $query->where('user_id', 0)->orWhereNull('user_id');
        })
        ->where(function ($query) use ($email, $phone) {
            $hasCondition = false;
            if (!empty($email)) {
                $query->where('billing_info', 'LIKE', '%"bill_email":"' . $email . '"%')
                      ->orWhere('billing_info', 'LIKE', '%"email":"' . $email . '"%');
                $hasCondition = true;
            }
            if (!empty($phone)) {
                if ($hasCondition) {
                    $query->orWhere('billing_info', 'LIKE', '%"bill_phone":"' . $phone . '"%')
                          ->orWhere('billing_info', 'LIKE', '%"phone":"' . $phone . '"%');
                } else {
                    $query->where('billing_info', 'LIKE', '%"bill_phone":"' . $phone . '"%')
                          ->orWhere('billing_info', 'LIKE', '%"phone":"' . $phone . '"%');
                }
            }
        })
        ->orderBy('id', 'desc')
        ->get();
    }

    /**
     * Ensure guest_users table exists in database.
     */
    public static function ensureTableExists()
    {
        if (!Schema::hasTable('guest_users')) {
            Schema::create('guest_users', function (Blueprint $table) {
                $table->bigIncrements('id');
                $table->string('first_name')->nullable();
                $table->string('last_name')->nullable();
                $table->string('email')->nullable()->index();
                $table->string('phone')->nullable()->index();
                $table->text('bill_address1')->nullable();
                $table->text('bill_address2')->nullable();
                $table->string('bill_city')->nullable();
                $table->string('bill_zip')->nullable();
                $table->string('bill_country')->nullable();
                $table->string('bill_company')->nullable();
                $table->integer('total_orders')->default(0);
                $table->timestamp('last_order_at')->nullable();
                $table->timestamps();
            });
        }
    }

    /**
     * Store or update a guest customer entry from billing details and/or an order.
     */
    public static function storeOrUpdateGuest($billing, $order = null)
    {
        self::ensureTableExists();

        if (empty($billing) || !is_array($billing)) {
            return null;
        }

        $email = trim($billing['bill_email'] ?? ($billing['email'] ?? ''));
        $phone = trim($billing['bill_phone'] ?? ($billing['phone'] ?? ''));

        if (empty($email) && empty($phone)) {
            return null;
        }

        $guest = null;
        if (!empty($email)) {
            $guest = self::where('email', $email)->first();
        }
        if (!$guest && !empty($phone)) {
            $guest = self::where('phone', $phone)->first();
        }

        if (!$guest) {
            $guest = new self();
        }

        if (!empty($billing['bill_first_name']) || !empty($billing['first_name'])) {
            $guest->first_name = $billing['bill_first_name'] ?? ($billing['first_name'] ?? $guest->first_name);
        }
        if (!empty($billing['bill_last_name']) || !empty($billing['last_name'])) {
            $guest->last_name = $billing['bill_last_name'] ?? ($billing['last_name'] ?? $guest->last_name);
        }

        if (!empty($email)) {
            $guest->email = $email;
        }
        if (!empty($phone)) {
            $guest->phone = $phone;
        }

        if (!empty($billing['bill_address1']) || !empty($billing['address1'])) {
            $guest->bill_address1 = $billing['bill_address1'] ?? ($billing['address1'] ?? $guest->bill_address1);
        }
        if (!empty($billing['bill_address2']) || !empty($billing['address2'])) {
            $guest->bill_address2 = $billing['bill_address2'] ?? ($billing['address2'] ?? $guest->bill_address2);
        }
        if (!empty($billing['bill_city']) || !empty($billing['city'])) {
            $guest->bill_city = $billing['bill_city'] ?? ($billing['city'] ?? $guest->bill_city);
        }
        if (!empty($billing['bill_zip']) || !empty($billing['zip'])) {
            $guest->bill_zip = $billing['bill_zip'] ?? ($billing['zip'] ?? $guest->bill_zip);
        }
        if (!empty($billing['bill_country']) || !empty($billing['country'])) {
            $guest->bill_country = $billing['bill_country'] ?? ($billing['country'] ?? $guest->bill_country);
        }
        if (!empty($billing['bill_company']) || !empty($billing['company'])) {
            $guest->bill_company = $billing['bill_company'] ?? ($billing['company'] ?? $guest->bill_company);
        }

        if ($order) {
            $guest->total_orders = ($guest->total_orders ?? 0) + 1;
            $guest->last_order_at = $order->created_at ?? now();
        }

        $guest->save();
        return $guest;
    }

    /**
     * Backfill/Sync all guest orders from existing database records.
     */
    public static function syncFromExistingOrders()
    {
        self::ensureTableExists();

        $guestOrders = Order::where(function ($q) {
            $q->where('user_id', 0)->orWhereNull('user_id');
        })->orderBy('id', 'asc')->get();

        foreach ($guestOrders as $order) {
            $billing = json_decode($order->billing_info, true);
            if ($billing && is_array($billing)) {
                self::storeOrUpdateGuest($billing, $order);
            }
        }
    }
}
