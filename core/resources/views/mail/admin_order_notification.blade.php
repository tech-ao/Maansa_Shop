<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>New Order Received - {{ $order->transaction_number }}</title>
<style>
    body { margin: 0; padding: 0; background-color: #f1f5f9; font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Helvetica, Arial, sans-serif; }
    .email-container { max-width: 640px; margin: 24px auto; background: #ffffff; border-radius: 16px; overflow: hidden; box-shadow: 0 4px 20px rgba(0,0,0,0.06); border: 1px solid #e2e8f0; }
    .email-header { background: linear-gradient(135deg, #1e293b 0%, #0f172a 100%); padding: 28px 24px; text-align: center; color: #ffffff; }
    .email-header h1 { margin: 0; font-size: 22px; font-weight: 800; }
    .email-header p { margin: 6px 0 0; font-size: 13.5px; opacity: 0.85; }
    .email-body { padding: 28px 24px; color: #334155; }
    .order-card { background: #f8fafc; border: 1px solid #e2e8f0; border-radius: 12px; padding: 16px 18px; margin-bottom: 20px; }
    .order-card-table { width: 100%; border-collapse: collapse; font-size: 13px; }
    .order-card-table td { padding: 4px 0; }
    .order-card-table .label { color: #64748b; font-weight: 500; width: 40%; }
    .order-card-table .value { color: #0f172a; font-weight: 700; text-align: right; }
    .badge { display: inline-block; padding: 3px 9px; font-size: 10.5px; font-weight: 700; border-radius: 9999px; text-transform: uppercase; }
    .badge-paid { background: #dcfce7; color: #15803d; }
    .badge-pending { background: #fef3c7; color: #b45309; }
    .section-heading { font-size: 14.5px; font-weight: 700; color: #0f172a; margin: 22px 0 10px; border-bottom: 2px solid #f1f5f9; padding-bottom: 6px; }
    .address-grid { width: 100%; border-collapse: collapse; margin-bottom: 20px; }
    .address-grid td { width: 50%; vertical-align: top; padding: 0 6px 0 0; }
    .address-grid td:last-child { padding: 0 0 0 6px; }
    .address-box { background: #f8fafc; border: 1px solid #e2e8f0; border-radius: 10px; padding: 12px 14px; font-size: 12px; line-height: 1.5; }
    .address-box strong { color: #0f172a; display: block; margin-bottom: 4px; font-size: 12.5px; }
    .items-table { width: 100%; border-collapse: collapse; margin-bottom: 20px; font-size: 12.5px; }
    .items-table th { background: #f1f5f9; color: #475569; font-weight: 700; font-size: 11px; text-transform: uppercase; padding: 8px 10px; text-align: left; }
    .items-table td { padding: 10px; border-bottom: 1px solid #f1f5f9; vertical-align: middle; }
    .item-title { font-weight: 700; color: #0f172a; }
    .item-attr { font-size: 11px; color: #64748b; }
    .totals-table { width: 100%; border-collapse: collapse; font-size: 13px; margin-bottom: 24px; }
    .totals-table td { padding: 5px 10px; }
    .totals-table .label { color: #64748b; text-align: right; }
    .totals-table .value { color: #0f172a; font-weight: 600; text-align: right; width: 35%; }
    .totals-table .grand-total td { font-size: 15px; font-weight: 800; color: #047857; border-top: 2px solid #e2e8f0; padding-top: 10px; }
    .btn-admin { display: inline-block; background: #0f172a; color: #ffffff !important; text-decoration: none; padding: 12px 28px; border-radius: 9999px; font-weight: 700; font-size: 13px; text-align: center; }
    .email-footer { background: #f8fafc; padding: 20px; text-align: center; border-top: 1px solid #e2e8f0; font-size: 11.5px; color: #94a3b8; }
</style>
</head>
<body>

@php
    $currSign = $order->currency_sign ?: '₹';
    $currDir  = isset($setting->currency_direction) ? $setting->currency_direction : 1;
    function adminMoney($val, $sign, $dir) {
        $formatted = number_format((float)$val, 2);
        return $dir == 1 ? $sign . $formatted : $formatted . $sign;
    }
@endphp

<div class="email-container">
    <div class="email-header">
        <h1>🛒 New Order Placed</h1>
        <p>Order #{{ $order->transaction_number }} requires fulfillment</p>
    </div>

    <div class="email-body">
        <div class="order-card">
            <table class="order-card-table">
                <tr>
                    <td class="label">Order Number:</td>
                    <td class="value">#{{ $order->transaction_number }}</td>
                </tr>
                <tr>
                    <td class="label">Transaction TxnID:</td>
                    <td class="value">{{ $order->txnid ?: 'N/A' }}</td>
                </tr>
                <tr>
                    <td class="label">Order Placed:</td>
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

        <div class="section-heading">Customer Information</div>
        <table class="address-grid">
            <tr>
                <td>
                    <div class="address-box">
                        <strong>Billing Details:</strong>
                        Name: {{ $bill['bill_first_name'] ?? '' }} {{ $bill['bill_last_name'] ?? '' }}<br>
                        Email: {{ $bill['bill_email'] ?? '' }}<br>
                        Phone: {{ $bill['bill_phone'] ?? '' }}<br>
                        Address: {{ $bill['bill_address1'] ?? '' }} {{ isset($bill['bill_address2']) ? $bill['bill_address2'] : '' }}<br>
                        {{ $bill['bill_city'] ?? '' }}{{ isset($state['name']) ? ', ' . $state['name'] : '' }} - {{ $bill['bill_zip'] ?? '' }}
                    </div>
                </td>
                <td>
                    <div class="address-box">
                        <strong>Shipping Destination:</strong>
                        Recipient: {{ $ship['ship_first_name'] ?? ($bill['bill_first_name'] ?? '') }} {{ $ship['ship_last_name'] ?? ($bill['bill_last_name'] ?? '') }}<br>
                        Email: {{ $ship['ship_email'] ?? ($bill['bill_email'] ?? '') }}<br>
                        Phone: {{ $ship['ship_phone'] ?? ($bill['bill_phone'] ?? '') }}<br>
                        Address: {{ $ship['ship_address1'] ?? ($bill['bill_address1'] ?? '') }} {{ isset($ship['ship_address2']) ? $ship['ship_address2'] : (isset($bill['bill_address2']) ? $bill['bill_address2'] : '') }}<br>
                        {{ $ship['ship_city'] ?? ($bill['bill_city'] ?? '') }}{{ isset($state['name']) ? ', ' . $state['name'] : '' }} - {{ $ship['ship_zip'] ?? ($bill['bill_zip'] ?? '') }}
                    </div>
                </td>
            </tr>
        </table>

        <div class="section-heading">Ordered Line Items</div>
        <table class="items-table">
            <thead>
                <tr>
                    <th style="width: 50%;">Product</th>
                    <th style="width: 15%; text-align: center;">Qty</th>
                    <th style="width: 17%; text-align: right;">Unit Price</th>
                    <th style="width: 18%; text-align: right;">Line Total</th>
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
                        <td style="text-align: right;">{{ adminMoney($unitPrice * $order->currency_value, $currSign, $currDir) }}</td>
                        <td style="text-align: right; font-weight: 700;">{{ adminMoney($lineTotal * $order->currency_value, $currSign, $currDir) }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        <table class="totals-table">
            <tr>
                <td class="label">Subtotal:</td>
                <td class="value">{{ adminMoney($subtotal * $order->currency_value, $currSign, $currDir) }}</td>
            </tr>
            @if(isset($shipping['price']) && (float)$shipping['price'] > 0)
                <tr>
                    <td class="label">Shipping Fee:</td>
                    <td class="value">{{ adminMoney((float)$shipping['price'] * $order->currency_value, $currSign, $currDir) }}</td>
                </tr>
            @else
                <tr>
                    <td class="label">Shipping:</td>
                    <td class="value" style="color: #10b981;">FREE</td>
                </tr>
            @endif
            @if((float)$order->tax > 0)
                <tr>
                    <td class="label">Tax:</td>
                    <td class="value">{{ adminMoney((float)$order->tax * $order->currency_value, $currSign, $currDir) }}</td>
                </tr>
            @endif
            @if(isset($discount['discount']) && (float)$discount['discount'] > 0)
                <tr>
                    <td class="label">Discount:</td>
                    <td class="value" style="color: #ef4444;">-{{ adminMoney((float)$discount['discount'] * $order->currency_value, $currSign, $currDir) }}</td>
                </tr>
            @endif
            @if((float)$order->state_price > 0)
                <tr>
                    <td class="label">State Fee:</td>
                    <td class="value">{{ adminMoney((float)$order->state_price * $order->currency_value, $currSign, $currDir) }}</td>
                </tr>
            @endif
            @php
                $grandTotalCalc = ($subtotal + (isset($shipping['price']) ? (float)$shipping['price'] : 0) + (float)$order->tax + (float)$order->state_price) - (isset($discount['discount']) ? (float)$discount['discount'] : 0);
                $finalOrderCost = round($grandTotalCalc * $order->currency_value, 2);
            @endphp
            <tr class="grand-total">
                <td class="label">Total Amount:</td>
                <td class="value">{{ adminMoney($finalOrderCost, $currSign, $currDir) }}</td>
            </tr>
        </table>

        <div style="text-align: center; margin-top: 24px;">
            <a href="{{ route('back.order.invoice', $order->id) }}" class="btn-admin">View Order in Admin Panel</a>
        </div>
    </div>

    <div class="email-footer">
        <p>Maansa Admin Notification • Automated Store Alert</p>
    </div>
</div>

</body>
</html>