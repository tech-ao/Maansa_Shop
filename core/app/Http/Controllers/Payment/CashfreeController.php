<?php

namespace App\Http\Controllers\Payment;

use App\Helpers\EmailHelper;
use App\Helpers\PriceHelper;
use App\Helpers\SmsHelper;
use App\Http\Controllers\Controller;
use App\Jobs\EmailSendJob;
use App\Models\Currency;
use App\Models\Item;
use App\Models\Notification;
use App\Models\Order;
use App\Models\PaymentSetting;
use App\Models\PromoCode;
use App\Models\Setting;
use App\Models\ShippingService;
use App\Models\State;
use App\Models\TrackOrder;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Str;

class CashfreeController extends Controller
{
    public $app_id;
    public $secret_key;
    public $is_sandbox;
    public $api_url;
    public $api_version = '2023-08-01';

    public function __construct()
    {
        $data = PaymentSetting::whereUniqueKeyword('cashfree')->first();
        if ($data) {
            $paydata = $data->convertJsonData();
            $this->app_id = isset($paydata['app_id']) ? trim($paydata['app_id']) : '';
            $this->secret_key = isset($paydata['secret_key']) ? trim($paydata['secret_key']) : '';
            $this->is_sandbox = isset($paydata['check_sandbox']) ? (int)$paydata['check_sandbox'] : 1;
        } else {
            $this->app_id = '';
            $this->secret_key = '';
            $this->is_sandbox = 1;
        }

        $this->api_url = $this->is_sandbox == 1 
            ? 'https://sandbox.cashfree.com/pg' 
            : 'https://api.cashfree.com/pg';
    }

    /**
     * Initiate Cashfree Payment & Create Cashfree Order Session
     */
    public function store(Request $request)
    {
        if (PriceHelper::CheckDigital() && !$request->shipping_id) {
            $cart_total = 0;
            if (Session::has('cart')) {
                foreach (Session::get('cart') as $key => $item) {
                    $cart_total += ($item['main_price'] + $item['attribute_price']) * $item['qty'];
                }
            }
            $free_shipping = ShippingService::whereStatus(1)->whereIsCondition(1)->first();
            if ($free_shipping && $cart_total >= $free_shipping->minimum_price) {
                $shipping_id = $free_shipping->id;
            } else {
                $paid = ShippingService::whereStatus(1)->where('id', '!=', 1)->first();
                $shipping_id = $paid ? $paid->id : ($free_shipping ? $free_shipping->id : 1);
            }
            if ($shipping_id) {
                $request->merge(['shipping_id' => $shipping_id]);
            }
        }

        $state = State::whereStatus(1)->count() != 0 ? 'required' : '';
        $shipping = ShippingService::whereStatus(1)->count() == 0 || PriceHelper::CheckDigital() == true ? 'required' : '';

        if ($request->single_page_checkout == 1) {
            $request->validate([
                'state_id' => $state,
                'shipping_id' => $shipping,
                'bill_first_name' => 'required',
                'bill_last_name' => 'required',
                'bill_email' => 'required|email',
                'bill_phone' => 'required',
                'bill_address' => 'required',
                'bill_city' => 'required',
                'bill_zip' => 'required',
            ]);
        } else {
            $request->validate([
                'state_id' => $state,
                'shipping_id' => $shipping,
            ]);
        }

        PriceHelper::checkCheckout($request);

        if (Session::has('currency')) {
            $currency = Currency::findOrFail(Session::get('currency'));
        } else {
            $currency = Currency::where('is_default', 1)->first();
        }

        $supported = ['INR', 'USD'];
        if (!in_array($currency->name, $supported)) {
            Session::flash('error', __('Currency Not Supported. Cashfree supports INR transactions.'));
            return redirect()->back();
        }

        if (empty($this->app_id) || empty($this->secret_key)) {
            Session::flash('error', __('Cashfree credentials are not configured properly.'));
            return redirect()->back();
        }

        $cart = Session::get('cart');
        if (empty($cart)) {
            Session::flash('error', __('Your cart is empty!'));
            return redirect()->route('front.cart');
        }

        $user = Auth::user();
        $setting = Setting::first();

        // Calculate Cart Totals
        $total_tax = 0;
        $cart_total = 0;
        $total = 0;
        $option_price = 0;
        foreach ($cart as $key => $item) {
            $total += $item['main_price'] * $item['qty'];
            $option_price += $item['attribute_price'];
            $cart_total = $total + $option_price;
            $itemModel = Item::findOrFail($key);
            if ($itemModel->tax) {
                $total_tax += $itemModel::taxCalculate($itemModel);
            }
        }

        if (!PriceHelper::Digital()) {
            $shippingService = null;
        } else {
            $shippingService = isset($request['shipping_id']) ? ShippingService::find($request['shipping_id']) : null;
        }

        $discount = [];
        if (Session::has('coupon')) {
            $discount = Session::get('coupon');
        }

        $grand_total = ($cart_total + ($shippingService ? $shippingService->price : 0)) + $total_tax;
        $grand_total = $grand_total - ($discount ? $discount['discount'] : 0);
        $grand_total += PriceHelper::StatePrce($request->state_id, $cart_total);
        $total_amount = PriceHelper::setConvertPrice($grand_total);

        // Ensure minimum amount
        if ($total_amount < 1) {
            $total_amount = 1.00;
        }

        // Customer details extraction
        $bill_first = $request->bill_first_name ?? ($request->name ?? ($user ? $user->first_name : 'Guest'));
        $bill_last = $request->bill_last_name ?? ($user ? $user->last_name : 'User');
        $customer_name = trim($bill_first . ' ' . $bill_last);
        $customer_email = $request->bill_email ?? ($request->email ?? ($user ? $user->email : 'customer@example.com'));
        $raw_phone = $request->bill_phone ?? ($request->phone ?? ($user ? $user->phone : '9999999999'));
        
        // Sanitize phone number (remove non-digits)
        $clean_phone = preg_replace('/[^0-9]/', '', $raw_phone);
        if (strlen($clean_phone) > 10) {
            $clean_phone = substr($clean_phone, -10);
        }
        if (strlen($clean_phone) < 10) {
            $clean_phone = '9999999999';
        }

        $order_id = 'ORDER_' . strtoupper(Str::random(12));
        $customer_id = 'CUST_' . ($user ? $user->id : strtoupper(Str::random(8)));

        $postData = [
            'order_id' => $order_id,
            'order_amount' => round($total_amount, 2),
            'order_currency' => $currency->name == 'INR' ? 'INR' : 'INR',
            'customer_details' => [
                'customer_id' => $customer_id,
                'customer_name' => $customer_name,
                'customer_email' => $customer_email,
                'customer_phone' => $clean_phone,
            ],
            'order_meta' => [
                'return_url' => route('front.cashfree.notify') . '?order_id={order_id}',
                'notify_url' => route('front.cashfree.notify'),
            ],
            'order_note' => $setting->title . ' Order #' . $order_id,
        ];

        // Call Cashfree PG Orders API
        $ch = curl_init($this->api_url . '/orders');
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'POST');
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($postData));
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_HTTPHEADER, [
            'Content-Type: application/json',
            'x-api-version: ' . $this->api_version,
            'x-client-id: ' . $this->app_id,
            'x-client-secret: ' . $this->secret_key,
        ]);

        $response = curl_exec($ch);
        $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        $err = curl_error($ch);
        curl_close($ch);

        if ($err) {
            Session::flash('error', 'Cashfree Connection Error: ' . $err);
            return redirect()->route('front.checkout.redirect');
        }

        $resData = json_decode($response, true);

        if ($httpCode >= 200 && $httpCode < 300 && isset($resData['payment_session_id'])) {
            Session::put('requestData', $request->all());
            Session::put('cashfree_order_id', $order_id);
            Session::put('cashfree_cf_order_id', $resData['cf_order_id'] ?? '');

            $payment_session_id = $resData['payment_session_id'];
            $mode = $this->is_sandbox == 1 ? 'sandbox' : 'production';

            return view('front.cashfree-checkout', compact('payment_session_id', 'mode', 'order_id', 'total_amount'));
        }

        $errorMsg = isset($resData['message']) ? $resData['message'] : __('Failed to initiate Cashfree payment session.');
        if (isset($resData['code'])) {
            $errorMsg .= ' (' . $resData['code'] . ')';
        }

        Session::flash('error', $errorMsg);
        return redirect()->route('front.checkout.redirect');
    }

    /**
     * Cashfree Payment Callback & Order Verification
     */
    public function notify(Request $request)
    {
        $order_id = $request->get('order_id') ?? Session::get('cashfree_order_id');

        if (empty($order_id)) {
            Session::flash('error', __('Cashfree Order ID not found.'));
            return redirect()->route('front.checkout.redirect');
        }

        // Fetch Order Details from Cashfree
        $ch = curl_init($this->api_url . '/orders/' . $order_id);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'GET');
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_HTTPHEADER, [
            'Content-Type: application/json',
            'x-api-version: ' . $this->api_version,
            'x-client-id: ' . $this->app_id,
            'x-client-secret: ' . $this->secret_key,
        ]);

        $response = curl_exec($ch);
        $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        $err = curl_error($ch);
        curl_close($ch);

        if ($err) {
            Session::flash('error', 'Error verifying Cashfree order: ' . $err);
            return redirect()->route('front.checkout.redirect');
        }

        $resData = json_decode($response, true);

        if ($httpCode >= 200 && $httpCode < 300 && isset($resData['order_status'])) {
            if ($resData['order_status'] === 'PAID') {
                return $this->processOrderSuccess($order_id, $resData);
            } elseif ($resData['order_status'] === 'USER_DROPPED' || $resData['order_status'] === 'CANCELLED') {
                Session::flash('error', __('Payment was cancelled.'));
                return redirect()->route('front.checkout.redirect');
            } else {
                Session::flash('error', __('Payment status is ' . $resData['order_status'] . '. Transaction was not completed.'));
                return redirect()->route('front.checkout.redirect');
            }
        }

        Session::flash('error', __('Could not verify Cashfree payment status.'));
        return redirect()->route('front.checkout.redirect');
    }

    /**
     * Process Successful Order Placement in Shop Database
     */
    private function processOrderSuccess($order_id, $resData)
    {
        $user = Auth::user();
        $setting = Setting::first();
        $cart = Session::get('cart');

        if (empty($cart)) {
            return redirect()->route('front.checkout.success');
        }

        $total_tax = 0;
        $cart_total = 0;
        $total = 0;
        $option_price = 0;
        foreach ($cart as $key => $item) {
            $total += $item['main_price'] * $item['qty'];
            $option_price += $item['attribute_price'];
            $cart_total = $total + $option_price;
            $itemModel = Item::findOrFail($key);
            if ($itemModel->tax) {
                $total_tax += $itemModel::taxCalculate($itemModel);
            }
        }

        $requestData = Session::get('requestData') ?? [];

        if (!PriceHelper::Digital()) {
            $shipping = null;
        } else {
            $shipping = isset($requestData['shipping_id']) ? ShippingService::find($requestData['shipping_id']) : null;
        }
        if (!$shipping && PriceHelper::Digital()) {
            $shipping = ShippingService::whereStatus(1)->where('id', '!=', 1)->first();
        }

        $discount = [];
        if (Session::has('coupon')) {
            $discount = Session::get('coupon');
        }

        $state_id = $requestData['state_id'] ?? (Auth::check() ? Auth::user()->state_id : null);

        $orderData = [];
        $orderData['state'] = $state_id ? json_encode(State::find($state_id), true) : null;
        $orderData['cart'] = json_encode($cart, true);
        $orderData['discount'] = json_encode($discount, true);
        $orderData['shipping'] = json_encode($shipping, true);
        $orderData['tax'] = $total_tax;
        $orderData['state_price'] = $state_id ? PriceHelper::StatePrce($state_id, $cart_total) : 0;
        $orderData['shipping_info'] = json_encode(Session::get('shipping_address'), true);
        $orderData['billing_info'] = json_encode(Session::get('billing_address'), true);
        $orderData['payment_method'] = 'Cashfree';
        $orderData['user_id'] = isset($user) ? $user->id : 0;
        $orderData['transaction_number'] = $order_id;
        $orderData['order_id'] = $order_id;
        $orderData['currency_sign'] = PriceHelper::setCurrencySign();
        $orderData['currency_value'] = PriceHelper::setCurrencyValue();
        $orderData['payment_status'] = 'Paid';
        $orderData['order_status'] = 'Progress';
        $orderData['txnid'] = $resData['cf_order_id'] ?? $order_id;

        $order = Order::create($orderData);

        // Track Order Initial Record
        TrackOrder::create([
            'title' => 'Pending',
            'order_id' => $order->id,
            'text' => __('Your order has been placed and is currently in progress.'),
        ]);

        // Notification
        Notification::create([
            'order_id' => $order->id,
        ]);

        // Discount Coupon decrement if applicable
        if ($discount && isset($discount['code']['id'])) {
            $coupon = PromoCode::find($discount['code']['id']);
            if ($coupon && $coupon->no_of_times > 0) {
                $coupon->no_of_times = $coupon->no_of_times - 1;
                $coupon->save();
            }
        }

        // Email & SMS Notifications
        try {
            if ($setting->smtp_check == 1) {
                @EmailHelper::sendOrderEmail($order);
            }
        } catch (\Throwable $e) {
            Log::error('Cashfree Order Email Error: ' . $e->getMessage());
        }

        try {
            if ($setting->is_twilio == 1) {
                @SmsHelper::sendSms($order);
            }
        } catch (\Throwable $e) {
            Log::error('Cashfree Order SMS Error: ' . $e->getMessage());
        }

        // Clear Sessions
        Session::put('order_id', $order->id);
        Session::forget('cart');
        Session::forget('discount');
        Session::forget('coupon');
        Session::forget('shipping_address');
        Session::forget('billing_address');
        Session::forget('order_data');
        Session::forget('requestData');
        Session::forget('cashfree_order_id');
        Session::forget('cashfree_cf_order_id');

        return redirect()->route('front.checkout.success');
    }

    /**
     * Static Test API Connectivity method for Admin Setting panel
     */
    public static function testApiConnectivity($app_id, $secret_key, $is_sandbox = 1)
    {
        $app_id = trim($app_id);
        $secret_key = trim($secret_key);

        if (empty($app_id) || empty($secret_key)) {
            return [
                'status' => false,
                'message' => 'Please enter both Cashfree App ID (Client ID) and Secret Key.'
            ];
        }

        $apiUrl = $is_sandbox == 1 
            ? 'https://sandbox.cashfree.com/pg' 
            : 'https://api.cashfree.com/pg';

        // Check credentials by calling Cashfree Orders API with a test order lookup
        $ch = curl_init($apiUrl . '/orders/TEST_PING_' . time());
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'GET');
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_HTTPHEADER, [
            'Content-Type: application/json',
            'x-api-version: 2023-08-01',
            'x-client-id: ' . $app_id,
            'x-client-secret: ' . $secret_key,
        ]);

        $response = curl_exec($ch);
        $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        $err = curl_error($ch);
        curl_close($ch);

        if ($err) {
            return [
                'status' => false,
                'message' => 'Network/cURL error: ' . $err
            ];
        }

        $resData = json_decode($response, true);

        // If HTTP 404 (order not found) or 200, authentication was SUCCESSFUL!
        // If HTTP 401 (Unauthorized) or 403 (Forbidden), credentials are invalid.
        if ($httpCode == 404 || ($httpCode >= 200 && $httpCode < 300)) {
            $modeLabel = $is_sandbox == 1 ? 'Sandbox (Test Mode)' : 'Production (Live Mode)';
            return [
                'status' => true,
                'message' => "Successfully connected to Cashfree {$modeLabel} API! Credentials are valid and active."
            ];
        }

        if ($httpCode == 401 || $httpCode == 403) {
            $detail = $resData['message'] ?? 'Authentication failed. Please verify your App ID and Secret Key for the selected environment (' . ($is_sandbox == 1 ? 'Sandbox' : 'Production') . ').';
            return [
                'status' => false,
                'message' => 'Cashfree Authentication Error (HTTP ' . $httpCode . '): ' . $detail
            ];
        }

        return [
            'status' => false,
            'message' => 'Cashfree API responded with code ' . $httpCode . ': ' . ($resData['message'] ?? 'Unexpected response.')
        ];
    }
}
