<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="icon" type="image/x-icon" href="{{ url('/core/public/storage/images/' . $setting->favicon) }}" />
    <title>{{ __('Invoice') }} - #{{ $order->transaction_number }} - {{ $setting->title }}</title>
    <link rel="stylesheet" media="screen" href="{{ asset('assets/front/css/vendor.min.css') }}">
    <link href="{{ asset('assets/front/css/main.css') }}" rel="stylesheet">
    <style>
        body {
            background-color: #ffffff;
            color: #1e293b;
            font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, "Helvetica Neue", Arial, sans-serif;
            font-size: 13px;
            line-height: 1.5;
        }
        .invoice-print-container {
            max-width: 850px;
            margin: 20px auto;
            padding: 30px;
            background: #ffffff;
            border: 1px solid #e2e8f0;
            border-radius: 12px;
        }
        .badge-invoice {
            background: #f1f5f9;
            color: #0f172a;
            font-weight: 700;
            padding: 4px 10px;
            border-radius: 6px;
            display: inline-block;
            border: 1px solid #cbd5e1;
        }
        .address-box {
            background: #f8fafc;
            border: 1px solid #e2e8f0;
            border-radius: 8px;
            padding: 16px;
            height: 100%;
        }
        .table-print th {
            background: #f1f5f9 !important;
            color: #475569 !important;
            font-size: 11.5px !important;
            font-weight: 700 !important;
            text-transform: uppercase !important;
            border-bottom: 2px solid #cbd5e1 !important;
            padding: 10px 12px !important;
        }
        .table-print td {
            padding: 10px 12px !important;
            border-bottom: 1px solid #e2e8f0 !important;
            font-size: 13px !important;
        }
        @media print {
            .no-print { display: none !important; }
            .invoice-print-container {
                border: none !important;
                padding: 0 !important;
                margin: 0 !important;
                max-width: 100% !important;
            }
            body { padding: 0 !important; margin: 0 !important; }
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
        <!-- Print / Action buttons -->
        <div class="no-print d-flex justify-content-between align-items-center mb-4 pb-3 border-bottom">
            <a href="{{ route('user.order.index') }}" class="btn btn-sm btn-outline-secondary rounded-pill px-3">
                &larr; {{ __('Back to Orders') }}
            </a>
            <button onclick="window.print()" class="btn btn-sm btn-success rounded-pill px-4" style="background: #059669; border-color: #059669;">
                <i class="icon-printer mr-1"></i> {{ __('Print Invoice') }}
            </button>
        </div>

        <!-- Header -->
        <div class="row align-items-start pb-4 border-bottom mb-4">
            <div class="col-7">
                <img class="img-fluid mb-2" style="max-height: 50px; width: auto;" alt="{{ $setting->title }}" src="{{ url('/core/public/storage/images/' . $setting->logo) }}">
                <h5 class="fw-bold text-dark mb-0">{{ $setting->title }}</h5>
                <p class="text-muted small mb-0">{{ __('Official Order Invoice & Receipt') }}</p>
            </div>
            <div class="col-5 text-end">
                <h3 class="fw-bold text-dark mb-1 text-uppercase">{{ __('TAX INVOICE') }}</h3>
                <div class="badge-invoice mb-2">#{{ $order->transaction_number }}</div>
                <div class="text-muted small">
                    <div><strong>{{ __('Date') }}:</strong> {{ $order->created_at->format('M d, Y') }}</div>
                    <div><strong>{{ __('Transaction ID') }}:</strong> {{ $order->txnid }}</div>
                    <div><strong>{{ __('Payment Method') }}:</strong> {{ $order->payment_method }}</div>
                    <div>
                        <strong>{{ __('Payment Status') }}:</strong>
                        <span class="badge {{ $order->payment_status == 'Paid' ? 'bg-success' : 'bg-danger' }}">
                            {{ $order->payment_status }}
                        </span>
                    </div>
                </div>
            </div>
        </div>

        <!-- Addresses Row: Sold By (Left) vs Bill To (Right) -->
        <div class="row mb-4">
            <!-- Left: Shop Address -->
            <div class="col-6">
                <div class="address-box">
                    <h6 class="fw-bold text-success text-uppercase mb-2 pb-1 border-bottom" style="font-size: 12px;">
                        {{ __('SOLD BY (STORE ADDRESS)') }}
                    </h6>
                    <div class="fw-bold text-dark mb-1">{{ $setting->title ?: 'Maansa Rajashahi' }}</div>
                    <div class="text-muted small mb-1">
                        {{ $setting->footer_address ?: 'Bhatipura, Gram Kuchera, Nagaur, Rajasthan-341024.' }}
                    </div>
                    @if($setting->footer_phone)
                        <div class="text-muted small mb-1">{{ __('Phone') }}: {{ $setting->footer_phone }}</div>
                    @endif
                    <div class="text-muted small">{{ __('Email') }}: {{ $setting->footer_email ?: ($setting->contact_email ?: 'maansarajashahi@gmail.com') }}</div>
                </div>
            </div>

            <!-- Right: Customer Billing Address -->
            <div class="col-6">
                <div class="address-box">
                    <h6 class="fw-bold text-dark text-uppercase mb-2 pb-1 border-bottom" style="font-size: 12px;">
                        {{ __('BILLED TO (CUSTOMER)') }}
                    </h6>
                    <div class="fw-bold text-dark mb-1">
                        {{ $bill['bill_first_name'] ?? '' }} {{ $bill['bill_last_name'] ?? '' }}
                    </div>
                    @if(isset($bill['bill_company']) && $bill['bill_company'])
                        <div class="text-muted small fw-bold mb-1">{{ $bill['bill_company'] }}</div>
                    @endif
                    <div class="text-muted small mb-1">
                        {{ $bill['bill_address1'] ?? '' }}{{ isset($bill['bill_address2']) && $bill['bill_address2'] ? ', ' . $bill['bill_address2'] : '' }}<br>
                        {{ $bill['bill_city'] ?? '' }}{{ isset($state['name']) ? ', ' . $state['name'] : '' }}{{ isset($bill['bill_zip']) ? ' - ' . $bill['bill_zip'] : '' }}, {{ $bill['bill_country'] ?? 'India' }}
                    </div>
                    <div class="text-muted small mb-1">{{ __('Phone') }}: {{ $bill['bill_phone'] ?? '' }}</div>
                    <div class="text-muted small">{{ __('Email') }}: {{ $bill['bill_email'] ?? '' }}</div>
                </div>
            </div>
        </div>

        <!-- Products Table -->
        <table class="table table-print table-bordered mb-4">
            <thead>
                <tr>
                    <th style="width: 50%;">{{ __('Product Details') }}</th>
                    <th style="width: 20%;">{{ __('Variant / Options') }}</th>
                    <th style="width: 10%;" class="text-center">{{ __('Qty') }}</th>
                    <th style="width: 10%;" class="text-end">{{ __('Unit Price') }}</th>
                    <th style="width: 10%;" class="text-end">{{ __('Total') }}</th>
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
                            <strong>{{ $item['name'] }}</strong>
                            @if (isset($item['item_type']) && $item['item_type'] == 'license' && $order->payment_status == 'Paid')
                                <div class="small text-muted mt-1">
                                    {{ __('License') }}: {{ $item['item_l_n'] ?? '' }} - {{ $item['item_l_k'] ?? '' }}
                                </div>
                            @endif
                        </td>
                        <td>
                            @if (isset($item['attribute']['option_name']) && $item['attribute']['option_name'])
                                @foreach ($item['attribute']['option_name'] as $optionkey => $option_name)
                                    <span class="small d-block text-muted">
                                        {{ $option_name }}:
                                        @if ($setting->currency_direction == 1)
                                            {{ $order->currency_sign }}{{ round($item['attribute']['option_price'][$optionkey] * $order->currency_value, 2) }}
                                        @else
                                            {{ round($item['attribute']['option_price'][$optionkey] * $order->currency_value, 2) }}{{ $order->currency_sign }}
                                        @endif
                                    </span>
                                @endforeach
                            @else
                                <span class="text-muted small">—</span>
                            @endif
                        </td>
                        <td class="text-center fw-bold">{{ $item['qty'] }}</td>
                        <td class="text-end text-muted">
                            @if ($setting->currency_direction == 1)
                                {{ $order->currency_sign }}{{ round($item['main_price'] * $order->currency_value, 2) }}
                            @else
                                {{ round($item['main_price'] * $order->currency_value, 2) }}{{ $order->currency_sign }}
                            @endif
                        </td>
                        <td class="text-end fw-bold">
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

        <!-- Totals Section -->
        <div class="row justify-content-end mb-4">
            <div class="col-5">
                <table class="table table-sm table-borderless">
                    <tr>
                        <td class="text-muted">{{ __('Subtotal') }}:</td>
                        <td class="text-end fw-bold">
                            @if ($setting->currency_direction == 1)
                                {{ $order->currency_sign }}{{ round($total * $order->currency_value, 2) }}
                            @else
                                {{ round($total * $order->currency_value, 2) }}{{ $order->currency_sign }}
                            @endif
                        </td>
                    </tr>
                    @if ($order->tax != 0)
                        <tr>
                            <td class="text-muted">{{ __('Tax / GST') }}:</td>
                            <td class="text-end fw-bold">
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
                        <tr class="text-danger">
                            <td>{{ __('Discount') }} ({{ $discount['code']['code_name'] }}):</td>
                            <td class="text-end fw-bold">
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
                            <td class="text-muted">{{ __('Shipping') }}:</td>
                            <td class="text-end fw-bold">
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
                            <td class="text-muted">{{ __('State Tax') }}:</td>
                            <td class="text-end fw-bold">
                                @if ($setting->currency_direction == 1)
                                    {{ $order->currency_sign }}{{ round($order['state_price'] * $order->currency_value, 2) }}
                                @else
                                    {{ round($order['state_price'] * $order->currency_value, 2) }}{{ $order->currency_sign }}
                                @endif
                            </td>
                        </tr>
                    @endif
                    <tr class="border-top border-dark border-2">
                        <td class="fw-bold fs-6 pt-2">{{ __('Grand Total') }}:</td>
                        <td class="text-end fw-bold fs-6 pt-2 text-success">
                            @if ($setting->currency_direction == 1)
                                {{ $order->currency_sign }}{{ PriceHelper::OrderTotal($order) }}
                            @else
                                {{ PriceHelper::OrderTotal($order) }}{{ $order->currency_sign }}
                            @endif
                        </td>
                    </tr>
                </table>
            </div>
        </div>

        <div class="text-center pt-3 border-top text-muted small">
            {{ __('Thank you for your purchase with') }} <strong>{{ $setting->title }}</strong>! {{ __('Support') }}: {{ $setting->footer_email ?: ($setting->contact_email ?: 'maansarajashahi@gmail.com') }}
        </div>
    </div>
    <script type="text/javascript" src="{{ asset('assets/front/js/myscript.js') }}"></script>

</body>

</html>
