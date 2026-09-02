<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Order Confirmation - {{ $order->transaction_number }}</title>
<style>
    body { margin: 0; padding: 0; background-color: #f1f5f9; font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Helvetica, Arial, sans-serif; -webkit-font-smoothing: antialiased; }
    .email-container { max-width: 640px; margin: 24px auto; background: #ffffff; border-radius: 16px; overflow: hidden; box-shadow: 0 4px 20px rgba(0,0,0,0.06); border: 1px solid #e2e8f0; }
    .email-header { background: linear-gradient(135deg, #059669 0%, #047857 100%); padding: 32px 28px; text-align: center; color: #ffffff; }
    .email-header h1 { margin: 0; font-size: 24px; font-weight: 800; letter-spacing: -0.5px; }
    .email-header p { margin: 8px 0 0; font-size: 14px; opacity: 0.92; }
    .email-body { padding: 30px 28px; color: #334155; }
    .welcome-text { font-size: 15px; line-height: 1.6; margin-bottom: 24px; color: #1e293b; }
    .order-card { background: #f8fafc; border: 1px solid #e2e8f0; border-radius: 12px; padding: 18px 20px; margin-bottom: 24px; }
    .order-card-table { width: 100%; border-collapse: collapse; font-size: 13px; }
    .order-card-table td { padding: 4px 0; }
    .order-card-table .label { color: #64748b; font-weight: 500; width: 40%; }
    .order-card-table .value { color: #0f172a; font-weight: 700; text-align: right; }
    .badge { display: inline-block; padding: 3px 10px; font-size: 11px; font-weight: 700; border-radius: 9999px; text-transform: uppercase; }
    .badge-paid { background: #dcfce7; color: #15803d; }
    .badge-pending { background: #fef3c7; color: #b45309; }
    .section-heading { font-size: 15px; font-weight: 700; color: #0f172a; margin: 24px 0 12px; display: flex; align-items: center; gap: 8px; border-bottom: 2px solid #f1f5f9; padding-bottom: 8px; }
    .address-grid { width: 100%; border-collapse: collapse; margin-bottom: 24px; }
    .address-grid td { width: 50%; vertical-align: top; padding: 0 8px 0 0; }
    .address-grid td:last-child { padding: 0 0 0 8px; }
    .address-box { background: #f8fafc; border: 1px solid #e2e8f0; border-radius: 10px; padding: 14px; font-size: 12.5px; line-height: 1.5; }
    .address-box strong { color: #0f172a; display: block; margin-bottom: 6px; font-size: 13px; }
    .items-table { width: 100%; border-collapse: collapse; margin-bottom: 24px; font-size: 13px; }
    .items-table th { background: #f1f5f9; color: #475569; font-weight: 700; font-size: 11px; text-transform: uppercase; letter-spacing: 0.5px; padding: 10px 12px; text-align: left; }
    .items-table td { padding: 12px; border-bottom: 1px solid #f1f5f9; vertical-align: middle; }
    .item-title { font-weight: 700; color: #0f172a; margin-bottom: 2px; }
    .item-attr { font-size: 11.5px; color: #64748b; }
    .totals-table { width: 100%; border-collapse: collapse; margin-top: 10px; margin-bottom: 24px; font-size: 13.5px; }
    .totals-table td { padding: 6px 12px; }
    .totals-table .label { color: #64748b; text-align: right; }
    .totals-table .value { color: #0f172a; font-weight: 600; text-align: right; width: 35%; }
    .totals-table .grand-total td { font-size: 16px; font-weight: 800; color: #047857; border-top: 2px solid #e2e8f0; padding-top: 12px; }
    .invoice-attached-alert { background: #ecfdf5; border: 1px solid #a7f3d0; border-radius: 10px; padding: 14px 18px; margin: 24px 0; display: flex; align-items: center; gap: 12px; font-size: 13px; color: #065f46; }
    .btn-track { display: inline-block; background: linear-gradient(135deg, #059669 0%, #047857 100%); color: #ffffff !important; text-decoration: none; padding: 12px 28px; border-radius: 9999px; font-weight: 700; font-size: 13.5px; text-align: center; }
    .email-footer { background: #f8fafc; padding: 24px 28px; text-align: center; border-top: 1px solid #e2e8f0; font-size: 12px; color: #94a3b8; }
    .email-footer a { color: #059669; text-decoration: none; }
</style>
</head>
<body>

@php
    $currSign = $order->currency_sign ?: '₹';
    $currDir  = isset($setting->currency_direction) ? $setting->currency_direction : 1;
    function emailMoney($val, $sign, $dir) {
        $formatted = number_format((float)$val, 2);
        return $dir == 1 ? $sign . $formatted : $formatted . $sign;
    }
    $userName = $bill['bill_first_name'] ?? 'Valued Customer';
@endphp

<div class="email-container">
    <!-- Header -->
    <div class="email-header">
        <h1>{{ $setting->title ?: 'Maansa' }}</h1>
        <p>Order Confirmation & Invoice Details</p>
    </div>

    <!-- Body -->
    <div class="email-body">
        <div class="welcome-text">
            Hello <strong>{{ $userName }}</strong>,<br>
            Thank you for shopping with us! We have received your order <strong>#{{ $order->transaction_number }}</strong> and are currently preparing it for dispatch.
        </div>

        <!-- Order Summary Box -->
        <div class="order-card">
            <table class="order-card-table">
                <tr>
                    <td class="label">Order Number:</td>
                    <td class="value">{{ $order->transaction_number }}</td>
                </tr>
                <tr>
                    <td class="label">Order Date:</td>
                    <td class="value">{{ $order->created_at ? $order->created_at->format('d M, Y • h:i A') : date('d M, Y') }}</td>
                </tr>
                <tr>
                    <td class="label">Payment Method:</td>
                    <td class="value">{{ $order->payment_method ?: 'Online Payment' }}</td>
                </tr>
                <tr>
                    <td class="label">Payment Status:</td>
                    <td class="value">
                        @if(strtolower($order->payment_status) == 'paid')
                            <span class="badge badge-paid">PAID</span>
                        @else
                            <span class="badge badge-pending">{{ strtoupper($order->payment_status ?: 'PENDING') }}</span>
                        @endif
                    </td>
                </tr>
            </table>
        </div>

        <!-- Addresses -->
        <div class="section-heading">Billing & Shipping Information</div>
        <table class="address-grid">
            <tr>
                <td>
                    <div class="address-box">
                        <strong>Billing Address:</strong>
                        {{ $bill['bill_first_name'] ?? '' }} {{ $bill['bill_last_name'] ?? '' }}<br>
                        {{ $bill['bill_address1'] ?? '' }} {{ isset($bill['bill_address2']) ? $bill['bill_address2'] : '' }}<br>
                        {{ $bill['bill_city'] ?? '' }}{{ isset($state['name']) ? ', ' . $state['name'] : '' }} - {{ $bill['bill_zip'] ?? '' }}<br>
                        Phone: {{ $bill['bill_phone'] ?? '' }}
                    </div>
                </td>
                <td>
                    <div class="address-box">
                        <strong>Shipping Address:</strong>
                        {{ $ship['ship_first_name'] ?? ($bill['bill_first_name'] ?? '') }} {{ $ship['ship_last_name'] ?? ($bill['bill_last_name'] ?? '') }}<br>
                        {{ $ship['ship_address1'] ?? ($bill['bill_address1'] ?? '') }} {{ isset($ship['ship_address2']) ? $ship['ship_address2'] : (isset($bill['bill_address2']) ? $bill['bill_address2'] : '') }}<br>
                        {{ $ship['ship_city'] ?? ($bill['bill_city'] ?? '') }}{{ isset($state['name']) ? ', ' . $state['name'] : '' }} - {{ $ship['ship_zip'] ?? ($bill['bill_zip'] ?? '') }}<br>
                        Phone: {{ $ship['ship_phone'] ?? ($bill['bill_phone'] ?? '') }}
                    </div>
                </td>
            </tr>
        </table>

        <!-- Purchased Items Table -->
        <div class="section-heading">Items Ordered</div>
        <table class="items-table">
            <thead>
                <tr>
                    <th style="width: 50%;">Product</th>
                    <th style="width: 15%; text-align: center;">Qty</th>
                    <th style="width: 17%; text-align: right;">Price</th>
                    <th style="width: 18%; text-align: right;">Total</th>
                </tr>
            </thead>
            <tbody>
                @php $subtotal = 0; @endphp
                @foreach($cart as $item)
                    @php
                        $itemMainPrice = (float)($item['main_price'] ?? 0);
                        $itemAttrPrice = (float)($item['attribute_price'] ?? 0);
                        $unitPrice = $itemMainPrice + $itemAttrPrice;
                        $qty = (int)($item['qty'] ?? 1);
                        $lineTotal = $unitPrice * $qty;
                        $subtotal += $lineTotal;
                    @endphp
                    <tr>
                        <td>
                            <div class="item-title">{{ $item['name'] ?? 'Product' }}</div>
                            @if(!empty($item['attribute']['option_name']))
                                @foreach($item['attribute']['option_name'] as $oname)
                                    <div class="item-attr">• {{ $oname }}</div>
                                @endforeach
                            @endif
                        </td>
                        <td style="text-align: center; font-weight: 700;">{{ $qty }}</td>
                        <td style="text-align: right;">{{ emailMoney($unitPrice * $order->currency_value, $currSign, $currDir) }}</td>
                        <td style="text-align: right; font-weight: 700;">{{ emailMoney($lineTotal * $order->currency_value, $currSign, $currDir) }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        <!-- Price Breakdown -->
        <table class="totals-table">
            <tr>
                <td class="label">Subtotal:</td>
                <td class="value">{{ emailMoney($subtotal * $order->currency_value, $currSign, $currDir) }}</td>
            </tr>
            @if(isset($shipping['price']) && (float)$shipping['price'] > 0)
                <tr>
                    <td class="label">Shipping ({{ $shipping['title'] ?? 'Standard' }}):</td>
                    <td class="value">{{ emailMoney((float)$shipping['price'] * $order->currency_value, $currSign, $currDir) }}</td>
                </tr>
            @else
                <tr>
                    <td class="label">Shipping:</td>
                    <td class="value" style="color: #10b981;">FREE</td>
                </tr>
            @endif
            @if((float)$order->tax > 0)
                <tr>
                    <td class="label">Tax / GST:</td>
                    <td class="value">{{ emailMoney((float)$order->tax * $order->currency_value, $currSign, $currDir) }}</td>
                </tr>
            @endif
            @if(isset($discount['discount']) && (float)$discount['discount'] > 0)
                <tr>
                    <td class="label">Discount:</td>
                    <td class="value" style="color: #ef4444;">-{{ emailMoney((float)$discount['discount'] * $order->currency_value, $currSign, $currDir) }}</td>
                </tr>
            @endif
            @if((float)$order->state_price > 0)
                <tr>
                    <td class="label">State Fee:</td>
                    <td class="value">{{ emailMoney((float)$order->state_price * $order->currency_value, $currSign, $currDir) }}</td>
                </tr>
            @endif
            @php
                $grandTotalCalc = ($subtotal + (isset($shipping['price']) ? (float)$shipping['price'] : 0) + (float)$order->tax + (float)$order->state_price) - (isset($discount['discount']) ? (float)$discount['discount'] : 0);
                $finalOrderCost = round($grandTotalCalc * $order->currency_value, 2);
            @endphp
            <tr class="grand-total">
                <td class="label" style="color: #047857;">Grand Total:</td>
                <td class="value" style="color: #047857;">{{ emailMoney($finalOrderCost, $currSign, $currDir) }}</td>
            </tr>
        </table>

        <!-- Invoice Attached Alert -->
        <div class="invoice-attached-alert">
            📄 <div><strong>PDF Invoice Attached:</strong> An official Tax Invoice PDF for order <strong>#{{ $order->transaction_number }}</strong> has been attached to this email for your download and tax records.</div>
        </div>

        <!-- Track Button -->
        <div style="text-align: center; margin-top: 28px;">
            <a href="{{ route('user.order.index') }}" class="btn-track">Track Your Order</a>
        </div>
    </div>

    <!-- Footer -->
    <div class="email-footer">
        <p>If you have any questions, feel free to contact us at <a href="mailto:{{ $setting->contact_email ?: 'help@techao.in' }}">{{ $setting->contact_email ?: 'help@techao.in' }}</a>.</p>
        <p>© {{ date('Y') }} {{ $setting->title ?: 'Maansa' }}. All rights reserved.</p>
    </div>
</div>

</body>
</html>