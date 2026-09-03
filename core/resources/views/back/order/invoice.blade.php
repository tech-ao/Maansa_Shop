@extends('master.back')

@section('content')

<!-- Start of Main Content -->
<div class="container-fluid">

    <!-- Page Header Banner -->
    <div class="dash-hero-banner mb-4">
        <div class="dash-hero-content">
            <div class="dash-hero-text">
                <h2><i class="fa-solid fa-file-invoice mr-2" style="font-size: 22px;"></i> {{ __('Order Invoice') }} #{{ $order->transaction_number }}</h2>
                <p>{{ __('Official receipt and itemized billing statement for Transaction') }} #{{ $order->txnid }}</p>
            </div>
            <div class="dash-hero-actions">
                <a class="btn btn-hero-action btn-hero-primary" href="{{ route('back.order.index') }}" style="font-size: 13.5px; font-weight: 700; padding: 10px 20px;">
                    <i class="fa-solid fa-chevron-left mr-1"></i> {{ __('Back to Orders') }}
                </a>
                <a class="btn btn-hero-action" href="{{ route('back.order.print', $order->id) }}" target="_blank" style="background: rgba(255,255,255,0.25); border: 1px solid rgba(255,255,255,0.35); font-size: 13.5px; font-weight: 700; padding: 10px 20px;">
                    <i class="fa-solid fa-print mr-1"></i> {{ __('Print Invoice') }}
                </a>
            </div>
        </div>
    </div>

    @php
        if ($order->state) {
            $state = json_decode($order->state, true);
        } else {
            $state = [];
        }
        $bill = json_decode($order->billing_info, true);
        $ship = json_decode($order->shipping_info, true);
    @endphp

    <!-- Modern Paper Invoice Card -->
    <div class="row">
        <div class="col-lg-12">
            <div class="invoice-paper-card">
                <!-- Header / Brand & Meta Row -->
                <div class="invoice-header-row">
                    <div>
                        <img class="invoice-brand-logo" alt="Logo" src="{{ url('/core/public/storage/images/' . $setting->logo) }}">
                        <p class="text-muted mb-0" style="font-size: 13px;">
                            <strong>{{ $setting->title }}</strong><br>
                            {{ __('Official Store Invoice Receipt') }}
                        </p>
                    </div>
                    <div class="text-md-right mt-3 mt-md-0">
                        <h2 class="font-weight-800 text-primary mb-1" style="font-size: 26px; letter-spacing: -0.02em;">{{ __('INVOICE') }}</h2>
                        <div class="mb-2">
                            <span class="badge-txn-code" style="font-size: 13px;">#{{ $order->transaction_number }}</span>
                        </div>
                        <p class="text-muted mb-1" style="font-size: 13px;">
                            <strong>{{ __('Transaction ID:') }}</strong> <span class="font-family-monospace text-dark">{{ $order->txnid }}</span><br>
                            <strong>{{ __('Order Date:') }}</strong> {{ $order->created_at->format('M d, Y') }}<br>
                            <strong>{{ __('Payment Method:') }}</strong> <span class="badge badge-light border text-dark">{{ $order->payment_method }}</span>
                        </p>
                        <div class="mt-2">
                            @if($order->payment_status == 'Paid')
                                <span class="badge-status badge-status-paid"><i class="fa-solid fa-circle-check mr-1"></i> {{ __('Payment Status: Paid') }}</span>
                            @else
                                <span class="badge-status badge-status-unpaid"><i class="fa-solid fa-circle-exclamation mr-1"></i> {{ __('Payment Status: Unpaid') }}</span>
                            @endif
                        </div>
                    </div>
                </div>

                <!-- Addresses 2-Col Cards: Sold By vs Billed To -->
                <div class="row mb-4">
                    <div class="col-md-6 mb-3 mb-md-0">
                        <div class="invoice-address-card">
                            <h6><i class="fa-solid fa-store text-success"></i> {{ __('Sold By (Store Details)') }}</h6>
                            <p class="invoice-address-text">
                                <strong class="text-success">{{ $setting->title ?: 'Maansa Rajashahi' }}</strong><br>
                                <i class="fa-solid fa-location-dot mr-1 text-muted"></i> {{ $setting->footer_address ?: 'Bhatipura, Gram Kuchera, Nagaur, Rajasthan-341024.' }}<br>
                                @if($setting->footer_phone)
                                    <i class="fa-solid fa-phone mr-1 text-muted"></i> {{ $setting->footer_phone }}<br>
                                @endif
                                <i class="fa-regular fa-envelope mr-1 text-muted"></i> {{ $setting->footer_email ?: ($setting->contact_email ?: 'maansarajashahi@gmail.com') }}
                            </p>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="invoice-address-card">
                            <h6><i class="fa-solid fa-user text-primary"></i> {{ __('Billed To (Customer Details)') }}</h6>
                            <p class="invoice-address-text">
                                <strong>{{ $bill['bill_first_name'] ?? '' }} {{ $bill['bill_last_name'] ?? '' }}</strong><br>
                                @if (isset($bill['bill_company']) && $bill['bill_company'])
                                    <span class="text-muted">{{ $bill['bill_company'] }}</span><br>
                                @endif
                                <i class="fa-solid fa-location-dot mr-1 text-muted"></i> {{ $bill['bill_address1'] ?? '' }}<br>
                                @if (isset($bill['bill_address2']) && $bill['bill_address2'])
                                    {{ $bill['bill_address2'] }}<br>
                                @endif
                                {{ $bill['bill_city'] ?? '' }}{{ isset($state['name']) ? ', ' . $state['name'] : '' }} {{ $bill['bill_zip'] ?? '' }}<br>
                                {{ $bill['bill_country'] ?? 'India' }}<br>
                                <i class="fa-solid fa-phone mr-1 text-muted"></i> {{ $bill['bill_phone'] ?? '' }}<br>
                                <i class="fa-regular fa-envelope mr-1 text-muted"></i> {{ $bill['bill_email'] ?? '' }}
                            </p>
                        </div>
                    </div>
                </div>

                @if(!empty($order->courier_name) || !empty($order->tracking_number))
                    <!-- Shipment Details Banner -->
                    <div class="p-3 mb-4 rounded-lg d-flex flex-wrap align-items-center justify-content-between" style="background: #f0fdf4; border: 1px solid #bbf7d0; border-radius: 12px;">
                        <div class="d-flex align-items-center mb-2 mb-md-0">
                            <div class="mr-3 d-inline-flex align-items-center justify-content-center rounded-circle" style="width: 40px; height: 40px; background: #dcfce7; color: #15803d; font-size: 18px;">
                                <i class="fa-solid fa-truck-fast"></i>
                            </div>
                            <div>
                                <span class="text-muted d-block small font-weight-bold" style="font-size: 11px; text-transform: uppercase;">{{ __('Shipment Details') }}</span>
                                <strong class="text-dark" style="font-size: 14px;">
                                    {{ $order->courier_name ? $order->courier_name : __('Courier Dispatched') }}
                                    @if($order->tracking_number)
                                        &bull; AWB: <span class="font-family-monospace text-primary">{{ $order->tracking_number }}</span>
                                    @endif
                                </strong>
                            </div>
                        </div>
                        @if(!empty($order->tracking_link))
                            <div>
                                <a href="{{ $order->tracking_link }}" target="_blank" class="btn btn-sm btn-success px-3 py-1.5 font-weight-bold text-white" style="border-radius: 8px; font-size: 12px;">
                                    <i class="fa-solid fa-arrow-up-right-from-square mr-1"></i> {{ __('Track Shipment') }}
                                </a>
                            </div>
                        @endif
                    </div>
                @endif

                <!-- Products Table -->
                <div class="table-responsive">
                    <table class="invoice-table">
                        <thead>
                            <tr>
                                <th width="48%">{{ __('Purchased Item') }}</th>
                                <th width="22%">{{ __('Attributes / Options') }}</th>
                                <th width="12%" class="text-center">{{ __('Qty') }}</th>
                                <th width="18%" class="text-right">{{ __('Price') }}</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php
                                $option_price = 0;
                                $total = 0;
                            @endphp
                            @foreach (json_decode($order->cart, true) as $item)
                                @php
                                    $total += $item['main_price'] * $item['qty'];
                                    $option_price += $item['attribute_price'];
                                    $grandSubtotal = $total + $option_price;
                                @endphp
                                <tr>
                                    <td>
                                        <span class="font-weight-bold text-dark" style="font-size: 14px;">{{ $item['name'] }}</span>
                                    </td>
                                    <td>
                                        @if(isset($item['attribute']['option_name']) && $item['attribute']['option_name'])
                                            @foreach ($item['attribute']['option_name'] as $optionkey => $option_name)
                                                <span class="badge badge-light border text-muted mr-1 mb-1">
                                                    {{ $option_name }}: 
                                                    @if ($setting->currency_direction == 1)
                                                        {{ $order->currency_sign }}{{ round($item['attribute']['option_price'][$optionkey] * $order->currency_value, 2) }}
                                                    @else
                                                        {{ round($item['attribute']['option_price'][$optionkey] * $order->currency_value, 2) }}{{ $order->currency_sign }}
                                                    @endif
                                                </span>
                                            @endforeach
                                        @else
                                            <span class="text-muted">--</span>
                                        @endif
                                    </td>
                                    <td class="text-center font-weight-bold">
                                        {{ $item['qty'] }}
                                    </td>
                                    <td class="text-right font-weight-bold text-dark">
                                        @if ($setting->currency_direction == 1)
                                            {{ $order->currency_sign }}{{ round($item['main_price'] * $order->currency_value, 2) }}
                                        @else
                                            {{ round($item['main_price'] * $order->currency_value, 2) }}{{ $order->currency_sign }}
                                        @endif
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                <!-- Financial Summary Box -->
                <div class="row mt-3">
                    <div class="col-md-6 d-none d-md-block">
                        <div class="p-3 text-muted" style="font-size: 12.5px; border-left: 3px solid #e2e8f0;">
                            <strong>{{ __('Important Note:') }}</strong><br>
                            {{ __('Thank you for your business. For any customer support or refund questions, please contact our support desk referencing your order number.') }}
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="invoice-summary-box">
                            @if($order->tax != 0)
                                <div class="invoice-summary-row">
                                    <span>{{ __('Tax / VAT') }}</span>
                                    <span class="font-weight-600 text-dark">
                                        @if ($setting->currency_direction == 1)
                                            {{ $order->currency_sign }}{{ round($order->tax * $order->currency_value, 2) }}
                                        @else
                                            {{ round($order->tax * $order->currency_value, 2) }}{{ $order->currency_sign }}
                                        @endif
                                    </span>
                                </div>
                            @endif

                            @if(json_decode($order->discount, true))
                                @php
                                    $discount = json_decode($order->discount, true);
                                @endphp
                                <div class="invoice-summary-row">
                                    <span>{{ __('Coupon Discount') }} ({{ $discount['code']['code_name'] ?? '' }})</span>
                                    <span class="font-weight-600 text-danger">
                                        @if ($setting->currency_direction == 1)
                                            -{{ $order->currency_sign }}{{ round($discount['discount'] * $order->currency_value, 2) }}
                                        @else
                                            -{{ round($discount['discount'] * $order->currency_value, 2) }}{{ $order->currency_sign }}
                                        @endif
                                    </span>
                                </div>
                            @endif

                            @if(json_decode($order->shipping, true))
                                @php
                                    $shipping = json_decode($order->shipping, true);
                                @endphp
                                <div class="invoice-summary-row">
                                    <span>{{ __('Shipping Fee') }}</span>
                                    <span class="font-weight-600 text-dark">
                                        @if ($setting->currency_direction == 1)
                                            {{ $order->currency_sign }}{{ round($shipping['price'] * $order->currency_value, 2) }}
                                        @else
                                            {{ round($shipping['price'] * $order->currency_value, 2) }}{{ $order->currency_sign }}
                                        @endif
                                    </span>
                                </div>
                            @endif

                            @if(json_decode($order->state_price, true))
                                <div class="invoice-summary-row">
                                    <span>{{ __('State Tax') }} {{ isset($state['type']) && $state['type'] == 'percentage' ? '(' . $state['price'] . '%)' : '' }}</span>
                                    <span class="font-weight-600 text-dark">
                                        @if ($setting->currency_direction == 1)
                                            {{ $order->currency_sign }}{{ round($order['state_price'] * $order->currency_value, 2) }}
                                        @else
                                            {{ round($order['state_price'] * $order->currency_value, 2) }}{{ $order->currency_sign }}
                                        @endif
                                    </span>
                                </div>
                            @endif

                            <div class="invoice-summary-row total-row">
                                <span>
                                    @if ($order->payment_method == 'Cash On Delivery')
                                        {{ __('Total Amount') }}
                                    @else
                                        {{ __('Total Amount Due') }}
                                    @endif
                                </span>
                                <span class="total-amount">
                                    @if ($setting->currency_direction == 1)
                                        {{ $order->currency_sign }}{{ PriceHelper::OrderTotal($order) }}
                                    @else
                                        {{ PriceHelper::OrderTotal($order) }}{{ $order->currency_sign }}
                                    @endif
                                </span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
