<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<title>Invoice - {{ $order->transaction_number }}</title>
<style>
    * { box-sizing: border-box; margin: 0; padding: 0; font-family: 'DejaVu Sans', sans-serif; }
    body { font-size: 12px; color: #1e293b; background: #ffffff; padding: 24px; line-height: 1.5; }
    .invoice-header { width: 100%; margin-bottom: 20px; border-bottom: 2px solid #e2e8f0; padding-bottom: 14px; }
    .header-table { width: 100%; border-collapse: collapse; }
    .header-table td { vertical-align: top; }
    .logo-text { font-size: 24px; font-weight: bold; color: #047857; letter-spacing: -0.5px; }
    .store-tagline { font-size: 11px; color: #64748b; }
    .invoice-title { font-size: 20px; font-weight: bold; color: #0f172a; text-align: right; }
    .invoice-meta { font-size: 11px; color: #475569; text-align: right; margin-top: 4px; }
    .info-table { width: 100%; border-collapse: collapse; margin-bottom: 16px; }
    .info-table td { width: 50%; vertical-align: top; padding-right: 10px; }
    .info-card { background: #f8fafc; border: 1px solid #e2e8f0; border-radius: 6px; padding: 10px 12px; font-size: 11px; }
    .info-card strong { color: #0f172a; display: block; margin-bottom: 4px; font-size: 11.5px; text-transform: uppercase; letter-spacing: 0.5px; }
    .badge { display: inline-block; padding: 2px 7px; font-size: 10px; font-weight: bold; border-radius: 4px; text-transform: uppercase; }
    .badge-paid { background: #dcfce7; color: #15803d; }
    .badge-unpaid { background: #fee2e2; color: #b91c1c; }
    .items-table { width: 100%; border-collapse: collapse; margin-top: 10px; margin-bottom: 16px; }
    .items-table th { background: #047857; color: #ffffff; font-size: 11px; font-weight: bold; padding: 7px 9px; text-align: left; border: 1px solid #047857; }
    .items-table th.text-right { text-align: right; }
    .items-table th.text-center { text-align: center; }
    .items-table td { padding: 7px 9px; border: 1px solid #e2e8f0; font-size: 11px; vertical-align: top; }
    .items-table tr:nth-child(even) td { background: #f8fafc; }
    .items-table td.text-right { text-align: right; }
    .items-table td.text-center { text-align: center; }
    .attr-text { font-size: 10px; color: #64748b; margin-top: 2px; }
    .totals-table { width: 100%; border-collapse: collapse; margin-top: 10px; }
    .totals-table td { vertical-align: top; }
    .totals-right { width: 100%; border-collapse: collapse; }
    .totals-right td { padding: 4px 8px; font-size: 11px; }
    .totals-right .total-label { color: #64748b; text-align: right; }
    .totals-right .total-val { text-align: right; font-weight: 600; color: #0f172a; }
    .grand-total-row td { background: #ecfdf5; border-top: 2px solid #047857; font-size: 12.5px !important; font-weight: bold !important; color: #065f46 !important; padding: 7px 8px !important; }
    .footer-note { margin-top: 24px; padding-top: 12px; border-top: 1px solid #e2e8f0; font-size: 10px; color: #94a3b8; text-align: center; }
</style>
</head>
<body>

@php
    $currSign = $order->currency_sign ?: '₹';
    $currDir  = isset($setting->currency_direction) ? $setting->currency_direction : 1;
    function pdfMoney($val, $sign, $dir) {
        $formatted = number_format((float)$val, 2);
        return $dir == 1 ? $sign . $formatted : $formatted . $sign;
    }
@endphp

<div class="invoice-header">
    <table class="header-table">
        <tr>
            <td>
                @if(isset($logoBase64) && !empty($logoBase64))
                    <img src="{{ $logoBase64 }}" style="max-height: 44px; max-width: 180px; margin-bottom: 4px;" alt="Logo"><br>
                @else
                    <div class="logo-text">{{ $setting->title ?: 'MAANSA' }}</div>
                @endif
                <div class="store-tagline">{{ $setting->footer_address ?: 'Maansa Online Store' }}</div>
                <div class="store-tagline">{{ $setting->contact_email ?: 'help@techao.in' }}</div>
            </td>
            <td>
                <div class="invoice-title">TAX INVOICE</div>
                <div class="invoice-meta">
                    <strong>Invoice #:</strong> {{ $order->transaction_number }}<br>
                    <strong>Date:</strong> {{ $order->created_at ? $order->created_at->format('d M, Y') : date('d M, Y') }}<br>
                    <strong>Payment Method:</strong> {{ $order->payment_method ?: 'Online Payment' }}<br>
                    <strong>Payment Status:</strong> 
                    @if(strtolower($order->payment_status) == 'paid')
                        <span class="badge badge-paid">PAID</span>
                    @else
                        <span class="badge badge-unpaid">{{ strtoupper($order->payment_status ?: 'PENDING') }}</span>
                    @endif
                </div>
            </td>
        </tr>
    </table>
</div>

<table class="info-table">
    <tr>
        <td>
            <div class="info-card">
                <strong>SOLD BY (STORE DETAILS):</strong>
                <div style="font-weight: bold; color: #047857;">{{ $setting->title ?: 'Maansa Rajashahi' }}</div>
                <div>{{ $setting->footer_address ?: 'Bhatipura, Gram Kuchera, Nagaur, Rajasthan-341024.' }}</div>
                @if($setting->footer_phone)
                    <div>Phone: {{ $setting->footer_phone }}</div>
                @endif
                <div>Email: {{ $setting->footer_email ?: ($setting->contact_email ?: 'maansarajashahi@gmail.com') }}</div>
            </div>
        </td>
        <td>
            <div class="info-card">
                <strong>BILLED TO (CUSTOMER):</strong>
                <div style="font-weight: bold;">{{ $bill['bill_first_name'] ?? '' }} {{ $bill['bill_last_name'] ?? '' }}</div>
                @if(isset($bill['bill_company']) && $bill['bill_company'])
                    <div>{{ $bill['bill_company'] }}</div>
                @endif
                <div>{{ $bill['bill_address1'] ?? '' }}{{ isset($bill['bill_address2']) && $bill['bill_address2'] ? ', ' . $bill['bill_address2'] : '' }}</div>
                <div>{{ $bill['bill_city'] ?? '' }}{{ isset($state['name']) ? ', ' . $state['name'] : '' }}{{ isset($bill['bill_zip']) ? ' - ' . $bill['bill_zip'] : '' }}</div>
                <div>{{ $bill['bill_country'] ?? 'India' }}</div>
                <div>Phone: {{ $bill['bill_phone'] ?? '' }}</div>
                <div>Email: {{ $bill['bill_email'] ?? '' }}</div>
            </div>
        </td>
    </tr>
</table>

<table class="items-table">
    <thead>
        <tr>
            <th style="width: 45%;">Item Description</th>
            <th style="width: 20%;">Options / Variant</th>
            <th style="width: 10%;" class="text-center">Qty</th>
            <th style="width: 12%;" class="text-right">Unit Price</th>
            <th style="width: 13%;" class="text-right">Total</th>
        </tr>
    </thead>
    <tbody>
        @php
            $subtotal = 0;
        @endphp
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
                <td><strong>{{ $item['name'] ?? 'Product' }}</strong></td>
                <td>
                    @if(!empty($item['attribute']['option_name']))
                        @foreach($item['attribute']['option_name'] as $okey => $oname)
                            <div class="attr-text">• {{ $oname }}</div>
                        @endforeach
                    @else
                        <span style="color: #94a3b8;">—</span>
                    @endif
                </td>
                <td class="text-center">{{ $qty }}</td>
                <td class="text-right">{{ pdfMoney($unitPrice * $order->currency_value, $currSign, $currDir) }}</td>
                <td class="text-right">{{ pdfMoney($lineTotal * $order->currency_value, $currSign, $currDir) }}</td>
            </tr>
        @endforeach
    </tbody>
</table>

<table class="totals-table">
    <tr>
        <td style="width: 55%; padding-right: 18px;">
            <div style="background: #f8fafc; border: 1px solid #e2e8f0; border-radius: 6px; padding: 10px 12px; font-size: 11px;">
                <strong>Payment & Notes:</strong>
                <p style="color: #64748b; margin-top: 4px;">
                    Thank you for your order! This computer-generated invoice is valid without signature. For support, contact {{ $setting->contact_email ?: 'help@techao.in' }}.
                </p>
            </div>
        </td>
        <td style="width: 45%;">
            <table class="totals-right">
                <tr>
                    <td class="total-label">Subtotal:</td>
                    <td class="total-val">{{ pdfMoney($subtotal * $order->currency_value, $currSign, $currDir) }}</td>
                </tr>
                @if(isset($shipping['price']) && (float)$shipping['price'] > 0)
                    <tr>
                        <td class="total-label">Shipping ({{ $shipping['title'] ?? 'Standard' }}):</td>
                        <td class="total-val">{{ pdfMoney((float)$shipping['price'] * $order->currency_value, $currSign, $currDir) }}</td>
                    </tr>
                @else
                    <tr>
                        <td class="total-label">Shipping:</td>
                        <td class="total-val" style="color: #10b981;">FREE</td>
                    </tr>
                @endif
                @if((float)$order->tax > 0)
                    <tr>
                        <td class="total-label">Tax / GST:</td>
                        <td class="total-val">{{ pdfMoney((float)$order->tax * $order->currency_value, $currSign, $currDir) }}</td>
                    </tr>
                @endif
                @if(isset($discount['discount']) && (float)$discount['discount'] > 0)
                    <tr>
                        <td class="total-label">Discount:</td>
                        <td class="total-val" style="color: #ef4444;">-{{ pdfMoney((float)$discount['discount'] * $order->currency_value, $currSign, $currDir) }}</td>
                    </tr>
                @endif
                @if((float)$order->state_price > 0)
                    <tr>
                        <td class="total-label">State Delivery Fee:</td>
                        <td class="total-val">{{ pdfMoney((float)$order->state_price * $order->currency_value, $currSign, $currDir) }}</td>
                    </tr>
                @endif
                @php
                    $grandTotalCalc = ($subtotal + (isset($shipping['price']) ? (float)$shipping['price'] : 0) + (float)$order->tax + (float)$order->state_price) - (isset($discount['discount']) ? (float)$discount['discount'] : 0);
                    $finalOrderCost = round($grandTotalCalc * $order->currency_value, 2);
                @endphp
                <tr class="grand-total-row">
                    <td>Grand Total:</td>
                    <td class="total-val" style="color: #065f46;">{{ pdfMoney($finalOrderCost, $currSign, $currDir) }}</td>
                </tr>
            </table>
        </td>
    </tr>
</table>

<div class="footer-note">
    © {{ date('Y') }} {{ $setting->title ?: 'Maansa' }}. All Rights Reserved. • Generated on {{ date('d M, Y h:i A') }}
</div>

</body>
</html>