<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>{{ __('Your Order Has Been Shipped') }}</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style>
        body {
            font-family: 'Helvetica Neue', Helvetica, Arial, sans-serif;
            background-color: #f1f5f9;
            margin: 0;
            padding: 0;
            -webkit-text-size-adjust: 100%;
            -ms-text-size-adjust: 100%;
            color: #334155;
        }
        .wrapper {
            width: 100%;
            table-layout: fixed;
            background-color: #f1f5f9;
            padding: 30px 0;
        }
        .main-container {
            max-width: 600px;
            margin: 0 auto;
            background-color: #ffffff;
            border-radius: 16px;
            overflow: hidden;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.05);
            border: 1px solid #e2e8f0;
        }
        .header {
            background: linear-gradient(135deg, #0f172a 0%, #1e293b 100%);
            padding: 35px 30px;
            text-align: center;
            color: #ffffff;
        }
        .header h1 {
            margin: 15px 0 5px 0;
            font-size: 22px;
            font-weight: 800;
            letter-spacing: -0.02em;
            color: #ffffff;
        }
        .header p {
            margin: 0;
            color: #94a3b8;
            font-size: 14px;
        }
        .content {
            padding: 35px 30px;
        }
        .greeting {
            font-size: 16px;
            font-weight: 700;
            color: #0f172a;
            margin-bottom: 12px;
        }
        .intro-text {
            font-size: 14.5px;
            line-height: 1.6;
            color: #475569;
            margin-bottom: 25px;
        }
        .tracking-card {
            background: #f8fafc;
            border: 2px dashed #cbd5e1;
            border-radius: 14px;
            padding: 24px;
            margin-bottom: 30px;
            text-align: center;
        }
        .tracking-card-title {
            font-size: 12px;
            font-weight: 800;
            text-transform: uppercase;
            letter-spacing: 0.05em;
            color: #64748b;
            margin-bottom: 15px;
        }
        .courier-info-row {
            margin-bottom: 16px;
        }
        .courier-name {
            font-size: 18px;
            font-weight: 800;
            color: #0f172a;
            margin-bottom: 4px;
        }
        .tracking-number {
            font-size: 14px;
            color: #475569;
        }
        .tracking-number strong {
            color: #0f172a;
            font-family: monospace;
            font-size: 15px;
            background: #e2e8f0;
            padding: 3px 8px;
            border-radius: 6px;
        }
        .btn-track {
            display: inline-block;
            background: linear-gradient(135deg, #10b981 0%, #059669 100%);
            color: #ffffff !important;
            text-decoration: none;
            padding: 13px 30px;
            border-radius: 10px;
            font-size: 14.5px;
            font-weight: 700;
            box-shadow: 0 4px 12px rgba(16, 185, 129, 0.35);
            margin-top: 10px;
        }
        .order-summary-title {
            font-size: 15px;
            font-weight: 700;
            color: #0f172a;
            border-bottom: 2px solid #f1f5f9;
            padding-bottom: 10px;
            margin-bottom: 15px;
        }
        .item-table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 25px;
        }
        .item-table td {
            padding: 10px 0;
            border-bottom: 1px solid #f1f5f9;
            font-size: 13.5px;
            vertical-align: middle;
        }
        .item-name {
            font-weight: 600;
            color: #0f172a;
        }
        .item-meta {
            font-size: 12px;
            color: #64748b;
        }
        .address-box {
            background: #fafbfc;
            border: 1px solid #e2e8f0;
            border-radius: 12px;
            padding: 18px;
            font-size: 13px;
            line-height: 1.5;
            color: #475569;
            margin-bottom: 25px;
        }
        .address-box strong {
            color: #0f172a;
            display: block;
            margin-bottom: 6px;
            font-size: 13.5px;
        }
        .footer {
            background-color: #f8fafc;
            padding: 25px 30px;
            text-align: center;
            border-top: 1px solid #e2e8f0;
            font-size: 12px;
            color: #94a3b8;
            line-height: 1.5;
        }
        .footer a {
            color: #059669;
            text-decoration: none;
        }
    </style>
</head>
<body>
    <div class="wrapper">
        <div class="main-container">
            <!-- Header -->
            <div class="header">
                @if(!empty($setting->logo))
                    <img src="{{ url('/core/public/storage/images/' . $setting->logo) }}" alt="{{ $setting->title }}" style="max-height: 48px; max-width: 180px; margin-bottom: 10px;">
                @endif
                <h1>{{ __('Your Product Has Been Shipped! 🚚') }}</h1>
                <p>{{ __('Order') }} #{{ $order->transaction_number }}</p>
            </div>

            <!-- Content -->
            <div class="content">
                @php
                    $bill = is_array($order->billing_info) ? $order->billing_info : json_decode($order->billing_info, true);
                    $ship = is_array($order->shipping_info) ? $order->shipping_info : json_decode($order->shipping_info, true);
                    $customerName = $bill['bill_first_name'] ?? ($order->user->displayName() ?? __('Customer'));
                @endphp

                <div class="greeting">
                    {{ __('Hello') }} {{ $customerName }},
                </div>
                <div class="intro-text">
                    {{ __('Great news! Your package has been packed, dispatched, and is on its way to you.') }}
                </div>

                <!-- Tracking Details Card -->
                <div class="tracking-card">
                    <div class="tracking-card-title">{{ __('Shipment & Tracking Information') }}</div>
                    
                    @if(!empty($order->courier_name))
                        <div class="courier-info-row">
                            <div class="courier-name">{{ $order->courier_name }}</div>
                            @if(!empty($order->tracking_number))
                                <div class="tracking-number">{{ __('Tracking / AWB Number:') }} <strong>{{ $order->tracking_number }}</strong></div>
                            @endif
                        </div>
                    @endif

                    @php
                        $trackUrl = !empty($order->tracking_link) ? $order->tracking_link : route('front.order.track') . '?order_number=' . $order->transaction_number;
                    @endphp

                    <a href="{{ $trackUrl }}" target="_blank" class="btn-track">
                        {{ __('Track Your Package →') }}
                    </a>
                </div>

                <!-- Order Items Summary -->
                <div class="order-summary-title">{{ __('Items in this Shipment') }}</div>
                <table class="item-table">
                    <tbody>
                        @foreach(json_decode($order->cart, true) as $item)
                            <tr>
                                <td>
                                    <div class="item-name">{{ $item['name'] }}</div>
                                    @if(!empty($item['attribute']['option_name']))
                                        <div class="item-meta">
                                            @foreach($item['attribute']['option_name'] as $okey => $oname)
                                                {{ $item['attribute']['names'][$okey] }}: {{ $oname }} &nbsp;
                                            @endforeach
                                        </div>
                                    @endif
                                </td>
                                <td style="text-align: right; white-space: nowrap; font-weight: 700; color: #0f172a;">
                                    x {{ $item['qty'] }}
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>

                <!-- Delivery Address -->
                <div class="address-box">
                    <strong>{{ __('Delivery Address:') }}</strong>
                    {{ $ship['ship_first_name'] ?? ($bill['bill_first_name'] ?? '') }} {{ $ship['ship_last_name'] ?? ($bill['bill_last_name'] ?? '') }}<br>
                    {{ $ship['ship_address1'] ?? ($bill['bill_address1'] ?? '') }}<br>
                    @if(!empty($ship['ship_address2'] ?? ($bill['bill_address2'] ?? '')))
                        {{ $ship['ship_address2'] ?? ($bill['bill_address2'] ?? '') }}<br>
                    @endif
                    {{ $ship['ship_city'] ?? ($bill['bill_city'] ?? '') }}, {{ $ship['ship_zip'] ?? ($bill['bill_zip'] ?? '') }}
                </div>
            </div>

            <!-- Footer -->
            <div class="footer">
                <p style="margin: 0 0 6px 0;">{{ __('Thank you for shopping with us!') }}</p>
                <p style="margin: 0;">&copy; {{ date('Y') }} {{ $setting->title }}. {{ __('All rights reserved.') }}</p>
            </div>
        </div>
    </div>
</body>
</html>
