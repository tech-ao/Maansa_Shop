<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="icon" type="image/x-icon" href="{{ url('/core/public/storage/images/' . $setting->favicon) }}" />
    <title>{{ __('Invoice') }} #{{ $order->transaction_number }} - {{ $setting->title }}</title>
    <style>
        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
        }
        body {
            background-color: #f1f5f9;
            color: #1e293b;
            font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, "Helvetica Neue", Arial, sans-serif;
            font-size: 13px;
            line-height: 1.5;
            padding: 30px 15px;
        }
        .invoice-print-container {
            max-width: 820px;
            margin: 0 auto;
            padding: 36px 40px;
            background: #ffffff;
            border: 1px solid #e2e8f0;
            border-radius: 16px;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.05);
        }
        .no-print-bar {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 24px;
            padding-bottom: 16px;
            border-bottom: 1px solid #e2e8f0;
        }
        .btn-action {
            display: inline-flex;
            align-items: center;
            padding: 8px 18px;
            border-radius: 999px;
            font-size: 13px;
            font-weight: 600;
            text-decoration: none;
            cursor: pointer;
            transition: all 0.2s;
        }
        .btn-back {
            background: #f8fafc;
            color: #475569;
            border: 1px solid #cbd5e1;
        }
        .btn-back:hover {
            background: #e2e8f0;
            color: #0f172a;
        }
        .btn-print {
            background: #059669;
            color: #ffffff;
            border: 1px solid #059669;
        }
        .btn-print:hover {
            background: #047857;
        }
        .header-row {
            display: flex;
            justify-content: space-between;
            align-items: flex-start;
            padding-bottom: 20px;
            margin-bottom: 24px;
            border-bottom: 2px solid #e2e8f0;
        }
        .header-left {
            max-width: 50%;
        }
        .header-left img {
            max-height: 50px;
            width: auto;
            margin-bottom: 8px;
            display: block;
        }
        .header-left h1 {
            font-size: 17px;
            font-weight: 700;
            color: #047857;
            margin-bottom: 2px;
        }
        .header-left p {
            font-size: 12px;
            color: #64748b;
        }
        .header-right {
            text-align: right;
            max-width: 48%;
        }
        .header-right h2 {
            font-size: 24px;
            font-weight: 800;
            color: #0f172a;
            letter-spacing: -0.5px;
            text-transform: uppercase;
            margin-bottom: 4px;
        }
        .badge-invoice {
            display: inline-block;
            background: #ecfdf5;
            color: #047857;
            font-weight: 700;
            font-size: 13px;
            padding: 3px 10px;
            border-radius: 6px;
            border: 1px solid #a7f3d0;
            margin-bottom: 8px;
        }
        .meta-list {
            font-size: 12px;
            color: #475569;
            line-height: 1.6;
        }
        .meta-list strong {
            color: #1e293b;
        }
        .badge-status {
            display: inline-block;
            padding: 2px 7px;
            border-radius: 4px;
            font-size: 11px;
            font-weight: 700;
            text-transform: uppercase;
        }
        .badge-paid {
            background: #dcfce7;
            color: #15803d;
            border: 1px solid #bbf7d0;
        }
        .badge-unpaid {
            background: #fee2e2;
            color: #b91c1c;
            border: 1px solid #fecaca;
        }
        .two-column-grid {
            display: flex;
            gap: 20px;
            margin-bottom: 24px;
        }
        .column-box {
            flex: 1 1 0;
            width: 50%;
            background: #f8fafc;
            border: 1px solid #e2e8f0;
            border-radius: 10px;
            padding: 16px;
        }
        .column-box h3 {
            font-size: 11px;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            padding-bottom: 8px;
            margin-bottom: 10px;
            border-bottom: 1px solid #e2e8f0;
        }
        .store-header {
            color: #047857;
        }
        .customer-header {
            color: #334155;
        }
        .address-text {
            font-size: 12.5px;
            color: #334155;
            line-height: 1.6;
        }
        .address-text strong {
            color: #0f172a;
            font-size: 13.5px;
            display: block;
            margin-bottom: 2px;
        }
        .items-table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
            border-radius: 8px;
            overflow: hidden;
            border: 1px solid #e2e8f0;
        }
        .items-table th {
            background: #047857;
            color: #ffffff;
            font-size: 11px;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            padding: 10px 14px;
            text-align: left;
            border-right: 1px solid rgba(255, 255, 255, 0.15);
        }
        .items-table th.text-center { text-align: center; }
        .items-table th.text-right { text-align: right; }
        .items-table td {
            padding: 11px 14px;
            border-bottom: 1px solid #e2e8f0;
            font-size: 12.5px;
            color: #334155;
            vertical-align: top;
        }
        .items-table tr:nth-child(even) td {
            background: #f8fafc;
        }
        .items-table td.text-center { text-align: center; }
        .items-table td.text-right { text-align: right; }
        .item-name {
            font-weight: 700;
            color: #0f172a;
        }
        .item-variant {
            font-size: 11.5px;
            color: #64748b;
            margin-top: 2px;
        }
        .totals-wrapper {
            display: flex;
            justify-content: flex-end;
            margin-bottom: 28px;
        }
        .totals-table {
            width: 320px;
            border-collapse: collapse;
        }
        .totals-table td {
            padding: 6px 10px;
            font-size: 12.5px;
        }
        .totals-table .label {
            color: #64748b;
            text-align: left;
        }
        .totals-table .value {
            text-align: right;
            font-weight: 600;
            color: #0f172a;
        }
        .grand-total-row td {
            background: #ecfdf5;
            border-top: 2px solid #047857;
            border-bottom: 2px solid #047857;
            padding: 8px 10px !important;
        }
        .grand-total-row .label {
            font-size: 14px !important;
            font-weight: 800 !important;
            color: #065f46 !important;
        }
        .grand-total-row .value {
            font-size: 16px !important;
            font-weight: 800 !important;
            color: #047857 !important;
        }
        .footer-note {
            text-align: center;
            padding-top: 16px;
            border-top: 1px solid #e2e8f0;
            font-size: 11.5px;
            color: #64748b;
        }
        .footer-note strong {
            color: #0f172a;
        }
        @media print {
            body {
                background: #ffffff !important;
                padding: 0 !important;
                margin: 0 !important;
            }
            .no-print-bar {
                display: none !important;
            }
            .invoice-print-container {
                max-width: 100% !important;
                border: none !important;
                box-shadow: none !important;
                padding: 0 !important;
                margin: 0 !important;
            }
        }
    </style>
</head>

<body id="invoice-print" onload="window.print()" id="page-top">
    @php
        if ($order->state) {
            $state = json_decode($order->state, true);
        } else {
            $state = [];
        }
        $bill = json_decode($order->billing_info, true);
    @endphp

    <div class="invoice-print-container">
        <!-- Print / Action buttons (hidden when printing) -->
        <div class="no-print-bar">
            <a href="{{ route('back.order.index') }}" class="btn-action btn-back">
                &larr; {{ __('Back to Orders') }}
            </a>
            <button onclick="window.print()" class="btn-action btn-print">
                <svg style="width: 15px; height: 15px; margin-right: 6px; fill: currentColor;" viewBox="0 0 24 24"><path d="M19 8H5c-1.66 0-3 1.34-3 3v6h4v4h12v-4h4v-6c0-1.66-1.34-3-3-3zm-3 11H8v-5h8v5zm3-7c-.55 0-1-.45-1-1s.45-1 1-1 1 .45 1 1-.45 1-1 1zm-1-9H6v4h12V3z"/></svg> {{ __('Print Invoice') }}
            </button>
        </div>

        <!-- Header Row -->
        <div class="header-row">
            <div class="header-left">
                <img alt="{{ $setting->title }}" src="{{ url('/core/public/storage/images/' . $setting->logo) }}">
                <h1>{{ $setting->title }}</h1>
                <p>{{ __('Official Store Order Receipt') }}</p>
            </div>
            <div class="header-right">
                <h2>{{ __('TAX INVOICE') }}</h2>
                <div class="badge-invoice">#{{ $order->transaction_number }}</div>
                <div class="meta-list">
                    <div><strong>{{ __('Invoice Date') }}:</strong> {{ $order->created_at->format('M d, Y') }}</div>
                    <div><strong>{{ __('Transaction ID') }}:</strong> {{ $order->txnid }}</div>
                    <div><strong>{{ __('Payment Method') }}:</strong> {{ $order->payment_method }}</div>
                    <div>
                        <strong>{{ __('Payment Status') }}:</strong>
                        @if ($order->payment_status == 'Paid')
                            <span class="badge-status badge-paid">{{ __('Paid') }}</span>
                        @else
                            <span class="badge-status badge-unpaid">{{ __('Unpaid') }}</span>
                        @endif
                    </div>
                </div>
            </div>
        </div>

        <!-- Addresses Row (2 Columns: Left = Store, Right = Customer) -->
        <div class="two-column-grid">
            <!-- Left: Sold By -->
            <div class="column-box">
                <h3 class="store-header">{{ __('SOLD BY (STORE DETAILS)') }}</h3>
                <div class="address-text">
                    <strong style="color: #047857;">{{ $setting->title ?: 'Maansa Rajashahi' }}</strong>
                    <div>{{ $setting->footer_address ?: 'Bhatipura, Gram Kuchera, Nagaur, Rajasthan-341024.' }}</div>
                    @if($setting->footer_phone)
                        <div>{{ __('Phone') }}: {{ $setting->footer_phone }}</div>
                    @endif
                    <div>{{ __('Email') }}: {{ $setting->footer_email ?: ($setting->contact_email ?: 'maansarajashahi@gmail.com') }}</div>
                </div>
            </div>

            <!-- Right: Billed To -->
            <div class="column-box">
                <h3 class="customer-header">{{ __('BILLED TO (CUSTOMER DETAILS)') }}</h3>
                <div class="address-text">
                    <strong>{{ $bill['bill_first_name'] ?? '' }} {{ $bill['bill_last_name'] ?? '' }}</strong>
                    @if(isset($bill['bill_company']) && $bill['bill_company'])
                        <div style="font-weight: 600; color: #64748b;">{{ $bill['bill_company'] }}</div>
                    @endif
                    <div>
                        {{ $bill['bill_address1'] ?? '' }}{{ isset($bill['bill_address2']) && $bill['bill_address2'] ? ', ' . $bill['bill_address2'] : '' }}<br>
                        {{ $bill['bill_city'] ?? '' }}{{ isset($state['name']) ? ', ' . $state['name'] : '' }}{{ isset($bill['bill_zip']) ? ' - ' . $bill['bill_zip'] : '' }}, {{ $bill['bill_country'] ?? 'India' }}
                    </div>
                    <div>{{ __('Phone') }}: {{ $bill['bill_phone'] ?? '' }}</div>
                    <div>{{ __('Email') }}: {{ $bill['bill_email'] ?? '' }}</div>
                </div>
            </div>
        </div>

        <!-- Items Table -->
        <table class="items-table">
            <thead>
                <tr>
                    <th style="width: 48%;">{{ __('Product Details') }}</th>
                    <th style="width: 22%;">{{ __('Variant / Options') }}</th>
                    <th style="width: 8%;" class="text-center">{{ __('Qty') }}</th>
                    <th style="width: 11%;" class="text-right">{{ __('Unit Price') }}</th>
                    <th style="width: 11%;" class="text-right">{{ __('Total') }}</th>
                </tr>
            </thead>
            <tbody>
                @php
                    $option_price = 0;
                    $total = 0;
                @endphp
                @foreach (json_decode($order->cart, true) as $key => $item)
                    @php
                        $item_total = $item['main_price'] * $item['qty'];
                        $total += $item_total;
                        $option_price += $item['attribute_price'];
                    @endphp
                    <tr>
                        <td>
                            <div class="item-name">{{ $item['name'] }}</div>
                            @if (isset($item['item_type']) && $item['item_type'] == 'license' && $order->payment_status == 'Paid')
                                <div class="item-variant">{{ __('License') }}: {{ $item['item_l_n'] ?? '' }} - {{ $item['item_l_k'] ?? '' }}</div>
                            @endif
                        </td>
                        <td>
                            @if (isset($item['attribute']['option_name']) && $item['attribute']['option_name'])
                                @foreach ($item['attribute']['option_name'] as $optionkey => $option_name)
                                    <div class="item-variant">
                                        {{ $option_name }}:
                                        @if ($setting->currency_direction == 1)
                                            {{ $order->currency_sign }}{{ round($item['attribute']['option_price'][$optionkey] * $order->currency_value, 2) }}
                                        @else
                                            {{ round($item['attribute']['option_price'][$optionkey] * $order->currency_value, 2) }}{{ $order->currency_sign }}
                                        @endif
                                    </div>
                                @endforeach
                            @else
                                <span style="color: #94a3b8;">—</span>
                            @endif
                        </td>
                        <td class="text-center" style="font-weight: 700;">{{ $item['qty'] }}</td>
                        <td class="text-right" style="color: #64748b;">
                            @if ($setting->currency_direction == 1)
                                {{ $order->currency_sign }}{{ round($item['main_price'] * $order->currency_value, 2) }}
                            @else
                                {{ round($item['main_price'] * $order->currency_value, 2) }}{{ $order->currency_sign }}
                            @endif
                        </td>
                        <td class="text-right" style="font-weight: 700; color: #0f172a;">
                            @if ($setting->currency_direction == 1)
                                {{ $order->currency_sign }}{{ round($item_total * $order->currency_value, 2) }}
                            @else
                                {{ round($item_total * $order->currency_value, 2) }}{{ $order->currency_sign }}
                            @endif
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        <!-- Totals Table -->
        <div class="totals-wrapper">
            <table class="totals-table">
                <tr>
                    <td class="label">{{ __('Subtotal') }}:</td>
                    <td class="value">
                        @if ($setting->currency_direction == 1)
                            {{ $order->currency_sign }}{{ round($total * $order->currency_value, 2) }}
                        @else
                            {{ round($total * $order->currency_value, 2) }}{{ $order->currency_sign }}
                        @endif
                    </td>
                </tr>
                @if ($order->tax != 0)
                    <tr>
                        <td class="label">{{ __('Tax / GST') }}:</td>
                        <td class="value">
                            @if ($setting->currency_direction == 1)
                                {{ $order->currency_sign }}{{ round($order->tax * $order->currency_value, 2) }}
                            @else
                                {{ round($order->tax * $order->currency_value, 2) }}{{ $order->currency_sign }}
                            @endif
                        </td>
                    </tr>
                @endif
                @if (json_decode($order->discount, true))
                    @php $discount = json_decode($order->discount, true); @endphp
                    <tr>
                        <td class="label" style="color: #ef4444;">{{ __('Discount') }} ({{ $discount['code']['code_name'] }}):</td>
                        <td class="value" style="color: #ef4444;">
                            @if ($setting->currency_direction == 1)
                                -{{ $order->currency_sign }}{{ round($discount['discount'] * $order->currency_value, 2) }}
                            @else
                                -{{ round($discount['discount'] * $order->currency_value, 2) }}{{ $order->currency_sign }}
                            @endif
                        </td>
                    </tr>
                @endif
                @if (json_decode($order->shipping, true))
                    @php $shipping = json_decode($order->shipping, true); @endphp
                    <tr>
                        <td class="label">{{ __('Shipping') }}:</td>
                        <td class="value">
                            @if ($setting->currency_direction == 1)
                                {{ $order->currency_sign }}{{ round($shipping['price'] * $order->currency_value, 2) }}
                            @else
                                {{ round($shipping['price'] * $order->currency_value, 2) }}{{ $order->currency_sign }}
                            @endif
                        </td>
                    </tr>
                @endif
                @if (json_decode($order->state_price, true))
                    <tr>
                        <td class="label">{{ __('State Tax') }}:</td>
                        <td class="value">
                            @if ($setting->currency_direction == 1)
                                {{ $order->currency_sign }}{{ round($order['state_price'] * $order->currency_value, 2) }}
                            @else
                                {{ round($order['state_price'] * $order->currency_value, 2) }}{{ $order->currency_sign }}
                            @endif
                        </td>
                    </tr>
                @endif
                <tr class="grand-total-row">
                    <td class="label">{{ __('Grand Total') }}:</td>
                    <td class="value">
                        @if ($setting->currency_direction == 1)
                            {{ $order->currency_sign }}{{ PriceHelper::OrderTotal($order) }}
                        @else
                            {{ PriceHelper::OrderTotal($order) }}{{ $order->currency_sign }}
                        @endif
                    </td>
                </tr>
            </table>
        </div>

        <!-- Footer -->
        <div class="footer-note">
            {{ __('Thank you for shopping with') }} <strong>{{ $setting->title }}</strong>! &bull; {{ __('Support') }}: {{ $setting->footer_email ?: ($setting->contact_email ?: 'maansarajashahi@gmail.com') }}
        </div>
    </div>
</body>
</html>
