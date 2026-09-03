@extends('master.front')
@section('title')
    {{ __('Invoice') }} - #{{ $order->transaction_number }}
@endsection
@section('content')

    <!-- Page Title-->
    <div class="page-title">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <ul class="breadcrumbs">
                        <li><a href="{{ route('front.index') }}">{{ __('Home') }}</a></li>
                        <li class="separator"></li>
                        <li><a href="{{ route('user.order.index') }}">{{ __('Orders') }}</a></li>
                        <li class="separator"></li>
                        <li>{{ __('Invoice') }} #{{ $order->transaction_number }}</li>
                    </ul>
                </div>
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
    @endphp

    <!-- Page Content-->
    <div class="container padding-bottom-3x mb-4 print_invoice">
        <div class="card modern-invoice-wrapper border-0 shadow-sm rounded-4 overflow-hidden bg-white">
            
            <!-- Top Actions Toolbar -->
            <div class="invoice-toolbar px-4 py-3 bg-light border-bottom d-flex flex-wrap align-items-center justify-content-between gap-2">
                <a href="{{ route('user.order.index') }}" class="btn btn-sm btn-outline-secondary rounded-pill px-3">
                    <i class="icon-arrow-left mr-1"></i> {{ __('Back to Orders') }}
                </a>
                <a href="{{ route('user.order.print', $order->id) }}" target="_blank" class="btn btn-sm btn-print-emerald rounded-pill px-4">
                    <i class="icon-printer mr-1"></i> {{ __('Print Invoice') }}
                </a>
            </div>

            <div class="card-body p-4 p-md-5">
                <!-- Header: Logo & Invoice Meta -->
                <div class="row align-items-start pb-4 border-bottom mb-4">
                    <div class="col-md-6 mb-3 mb-md-0">
                        <img class="img-fluid mb-2" style="max-height: 55px; width: auto;" alt="{{ $setting->title }}" src="{{ url('/core/public/storage/images/' . $setting->logo) }}">
                        <h5 class="fw-bold text-dark mb-0 fs-6">{{ $setting->title }}</h5>
                        <p class="text-muted small mb-0">{{ __('Official Order Invoice & Receipt') }}</p>
                    </div>

                    <div class="col-md-6 text-md-end">
                        <h3 class="fw-bold text-dark mb-1 text-uppercase" style="letter-spacing: 0.5px;">{{ __('Invoice') }}</h3>
                        <div class="badge-invoice-num mb-2">#{{ $order->transaction_number }}</div>
                        <div class="text-muted small">
                            <div><strong>{{ __('Date') }}:</strong> {{ $order->created_at->format('M d, Y') }}</div>
                            <div><strong>{{ __('Transaction ID') }}:</strong> <span class="text-dark fw-bold">{{ $order->txnid }}</span></div>
                            <div><strong>{{ __('Payment Method') }}:</strong> <span class="badge bg-light text-dark border">{{ $order->payment_method }}</span></div>
                            <div class="mt-1">
                                <strong>{{ __('Status') }}:</strong>
                                @if ($order->payment_status == 'Paid')
                                    <span class="badge bg-success-subtle text-success border border-success-subtle rounded-pill px-2 py-1">{{ __('Paid') }}</span>
                                @else
                                    <span class="badge bg-danger-subtle text-danger border border-danger-subtle rounded-pill px-2 py-1">{{ __('Unpaid') }}</span>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Addresses Row: Sold By (Left) vs Bill To (Right) -->
                <div class="row mb-4">
                    <!-- Left: Shop Address -->
                    <div class="col-md-6 mb-3 mb-md-0">
                        <div class="address-box p-3 rounded-3 bg-light border h-100">
                            <div class="d-flex align-items-center gap-2 mb-2 pb-2 border-bottom">
                                <i class="icon-briefcase text-success fs-5"></i>
                                <h6 class="mb-0 fw-bold text-dark text-uppercase small" style="letter-spacing: 0.5px;">{{ __('Sold By (Store Address)') }}</h6>
                            </div>
                            <div class="address-content text-dark small lh-base">
                                <div class="fw-bold fs-6 text-success mb-1">{{ $setting->title ?: 'Maansa Rajashahi' }}</div>
                                <div class="text-muted mb-1">
                                    <i class="icon-map-pin mr-1 text-secondary"></i> {{ $setting->footer_address ?: 'Bhatipura, Gram Kuchera, Nagaur, Rajasthan-341024.' }}
                                </div>
                                @if($setting->footer_phone)
                                    <div class="text-muted mb-1">
                                        <i class="icon-phone mr-1 text-secondary"></i> {{ $setting->footer_phone }}
                                    </div>
                                @endif
                                <div class="text-muted">
                                    <i class="icon-mail mr-1 text-secondary"></i> {{ $setting->footer_email ?: ($setting->contact_email ?: 'maansarajashahi@gmail.com') }}
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Right: Customer Billing Address -->
                    <div class="col-md-6">
                        <div class="address-box p-3 rounded-3 bg-light border h-100">
                            <div class="d-flex align-items-center gap-2 mb-2 pb-2 border-bottom">
                                <i class="icon-user text-primary fs-5"></i>
                                <h6 class="mb-0 fw-bold text-dark text-uppercase small" style="letter-spacing: 0.5px;">{{ __('Billed To (Customer Details)') }}</h6>
                            </div>
                            <div class="address-content text-dark small lh-base">
                                <div class="fw-bold fs-6 text-dark mb-1">
                                    {{ $bill['bill_first_name'] ?? '' }} {{ $bill['bill_last_name'] ?? '' }}
                                </div>
                                @if(isset($bill['bill_company']) && $bill['bill_company'])
                                    <div class="text-muted mb-1 fw-bold">{{ $bill['bill_company'] }}</div>
                                @endif
                                <div class="text-muted mb-1">
                                    <i class="icon-map-pin mr-1 text-secondary"></i>
                                    {{ $bill['bill_address1'] ?? '' }}{{ isset($bill['bill_address2']) && $bill['bill_address2'] ? ', ' . $bill['bill_address2'] : '' }}<br>
                                    {{ $bill['bill_city'] ?? '' }}{{ isset($state['name']) ? ', ' . $state['name'] : '' }}{{ isset($bill['bill_zip']) ? ' - ' . $bill['bill_zip'] : '' }}, {{ $bill['bill_country'] ?? 'India' }}
                                </div>
                                <div class="text-muted mb-1">
                                    <i class="icon-phone mr-1 text-secondary"></i> {{ $bill['bill_phone'] ?? '' }}
                                </div>
                                <div class="text-muted">
                                    <i class="icon-mail mr-1 text-secondary"></i> {{ $bill['bill_email'] ?? '' }}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                @if(!empty($order->courier_name) || !empty($order->tracking_number))
                    <!-- Shipment Details Banner -->
                    <div class="p-3 mb-4 rounded-3 d-flex flex-wrap align-items-center justify-content-between gap-3" style="background: #f0fdf4; border: 1px solid #bbf7d0;">
                        <div class="d-flex align-items-center gap-3">
                            <div class="d-inline-flex align-items-center justify-content-center rounded-circle" style="width: 44px; height: 44px; background: #dcfce7; color: #15803d; font-size: 20px;">
                                <i class="fas fa-truck-fast"></i>
                            </div>
                            <div>
                                <span class="text-muted d-block small fw-bold text-uppercase" style="font-size: 11px;">{{ __('Shipment & Tracking') }}</span>
                                <strong class="text-dark fs-6">
                                    {{ $order->courier_name ? $order->courier_name : __('Courier Dispatched') }}
                                    @if($order->tracking_number)
                                        &bull; AWB: <span class="font-monospace text-primary">{{ $order->tracking_number }}</span>
                                    @endif
                                </strong>
                            </div>
                        </div>
                        @if(!empty($order->tracking_link))
                            <div>
                                <a href="{{ $order->tracking_link }}" target="_blank" class="btn btn-sm btn-success rounded-pill px-4 py-2 fw-bold text-white shadow-sm" style="font-size: 13px; text-decoration: none !important;">
                                    <i class="fas fa-external-link-alt mr-1"></i> {{ __('Track Shipment') }}
                                </a>
                            </div>
                        @endif
                    </div>
                @endif

                <!-- Products Table -->
                <div class="table-responsive mb-4 rounded-3 border">
                    <table class="table table-hover align-middle mb-0 custom-invoice-table">
                        <thead class="table-light">
                            <tr>
                                <th class="ps-3 py-3" style="width: 45%;">{{ __('Product Details') }}</th>
                                <th class="py-3" style="width: 25%;">{{ __('Attribute / Variant') }}</th>
                                <th class="py-3 text-center" style="width: 10%;">{{ __('Qty') }}</th>
                                <th class="py-3 text-end" style="width: 10%;">{{ __('Unit Price') }}</th>
                                <th class="py-3 text-end pe-3" style="width: 10%;">{{ __('Total') }}</th>
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
                                    if (App\Models\Item::where('id', $key)->exists()) {
                                        $main_item = App\Models\Item::findOrFail($key);
                                    } else {
                                        $main_item = null;
                                    }
                                @endphp
                                <tr>
                                    <td class="ps-3 py-3">
                                        <div class="fw-bold text-dark fs-6">{{ $item['name'] }}</div>
                                        @if ($main_item)
                                            @if ($item['item_type'] == 'digital' && $order->payment_status == 'Paid')
                                                <div class="mt-1">
                                                    @if ($main_item['file_type'] == 'link')
                                                        <a href="{{ $main_item->link }}" target="_blank" class="btn btn-xs btn-success rounded-pill px-2 py-1 small">{{ __('Access Link') }}</a>
                                                    @else
                                                        <a href="{{ asset('assets/files/' . $main_item->file) }}" class="btn btn-xs btn-success rounded-pill px-2 py-1 small">{{ __('Download File') }}</a>
                                                    @endif
                                                </div>
                                            @endif

                                            @if ($item['item_type'] == 'license' && $order->payment_status == 'Paid')
                                                <div class="mt-1 p-2 bg-light border rounded small">
                                                    <strong>{{ __('License') }}:</strong> {{ $item['item_l_n'] ?? '' }} - {{ $item['item_l_k'] ?? '' }}
                                                </div>
                                            @endif
                                        @endif
                                    </td>
                                    <td class="py-3">
                                        @if (isset($item['attribute']['option_name']) && $item['attribute']['option_name'])
                                            @foreach ($item['attribute']['option_name'] as $optionkey => $option_name)
                                                <span class="badge bg-light text-dark border small me-1">
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
                                    <td class="py-3 text-center fw-bold">{{ $item['qty'] }}</td>
                                    <td class="py-3 text-end text-muted">
                                        @if ($setting->currency_direction == 1)
                                            {{ $order->currency_sign }}{{ round($item['main_price'] * $order->currency_value, 2) }}
                                        @else
                                            {{ round($item['main_price'] * $order->currency_value, 2) }}{{ $order->currency_sign }}
                                        @endif
                                    </td>
                                    <td class="py-3 text-end pe-3 fw-bold text-dark">
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
                </div>

                <!-- Totals Section -->
                <div class="row justify-content-end">
                    <div class="col-lg-5 col-md-6">
                        <div class="card border-0 bg-light rounded-3 p-3">
                            <div class="d-flex justify-content-between py-1 small">
                                <span class="text-muted">{{ __('Subtotal') }}:</span>
                                <span class="fw-bold text-dark">
                                    @if ($setting->currency_direction == 1)
                                        {{ $order->currency_sign }}{{ round($total * $order->currency_value, 2) }}
                                    @else
                                        {{ round($total * $order->currency_value, 2) }}{{ $order->currency_sign }}
                                    @endif
                                </span>
                            </div>

                            @if ($order->tax != 0)
                                <div class="d-flex justify-content-between py-1 small">
                                    <span class="text-muted">{{ __('Tax / GST') }}:</span>
                                    <span class="fw-bold text-dark">
                                        @if ($setting->currency_direction == 1)
                                            {{ $order->currency_sign }}{{ round($order->tax * $order->currency_value, 2) }}
                                        @else
                                            {{ round($order->tax * $order->currency_value, 2) }}{{ $order->currency_sign }}
                                        @endif
                                    </span>
                                </div>
                            @endif

                            @if (json_decode($order->discount, true))
                                @php
                                    $discount = json_decode($order->discount, true);
                                @endphp
                                <div class="d-flex justify-content-between py-1 small text-danger">
                                    <span>{{ __('Coupon Discount') }} ({{ $discount['code']['code_name'] }}):</span>
                                    <span class="fw-bold">
                                        @if ($setting->currency_direction == 1)
                                            -{{ $order->currency_sign }}{{ round($discount['discount'] * $order->currency_value, 2) }}
                                        @else
                                            -{{ round($discount['discount'] * $order->currency_value, 2) }}{{ $order->currency_sign }}
                                        @endif
                                    </span>
                                </div>
                            @endif

                            @if (json_decode($order->shipping, true))
                                @php
                                    $shipping = json_decode($order->shipping, true);
                                @endphp
                                <div class="d-flex justify-content-between py-1 small">
                                    <span class="text-muted">{{ __('Shipping Fee') }}:</span>
                                    <span class="fw-bold text-dark">
                                        @if ($setting->currency_direction == 1)
                                            {{ $order->currency_sign }}{{ round($shipping['price'] * $order->currency_value, 2) }}
                                        @else
                                            {{ round($shipping['price'] * $order->currency_value, 2) }}{{ $order->currency_sign }}
                                        @endif
                                    </span>
                                </div>
                            @endif

                            @if (json_decode($order->state_price, true))
                                <div class="d-flex justify-content-between py-1 small">
                                    <span class="text-muted">{{ __('State Tax') }}{{ isset($state['type']) && $state['type'] == 'percentage' ? ' (' . $state['price'] . '%)' : '' }}:</span>
                                    <span class="fw-bold text-dark">
                                        @if ($setting->currency_direction == 1)
                                            {{ $order->currency_sign }}{{ round($order['state_price'] * $order->currency_value, 2) }}
                                        @else
                                            {{ round($order['state_price'] * $order->currency_value, 2) }}{{ $order->currency_sign }}
                                        @endif
                                    </span>
                                </div>
                            @endif

                            <div class="d-flex justify-content-between py-2 mt-2 border-top border-2 border-dark align-items-center">
                                <span class="fw-bold text-dark fs-6">{{ __('Grand Total') }}:</span>
                                <span class="fw-bold text-success fs-5">
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

                <!-- Footer Note -->
                <div class="text-center pt-4 border-top mt-5">
                    <p class="text-muted small mb-0">
                        {{ __('Thank you for shopping with') }} <strong>{{ $setting->title }}</strong>! {{ __('For any queries regarding this order, please contact our support team at') }} <a href="mailto:{{ $setting->footer_email ?: ($setting->contact_email ?: 'maansarajashahi@gmail.com') }}" class="text-success text-decoration-none">{{ $setting->footer_email ?: ($setting->contact_email ?: 'maansarajashahi@gmail.com') }}</a>.
                    </p>
                </div>

            </div>
        </div>
    </div>

<style>
.modern-invoice-wrapper {
    background: #ffffff !important;
    border: 1px solid #e2e8f0 !important;
}

.badge-invoice-num {
    display: inline-block;
    background: #f1f5f9;
    color: #0f172a;
    font-weight: 700;
    font-size: 13px;
    padding: 3px 12px;
    border-radius: 6px;
    border: 1px solid #e2e8f0;
}

.btn-print-emerald {
    background: linear-gradient(135deg, #059669 0%, #047857 100%) !important;
    color: #ffffff !important;
    border: none !important;
    font-weight: 700 !important;
    box-shadow: 0 4px 12px rgba(5, 150, 105, 0.25) !important;
    transition: all 0.2s ease !important;
}

.btn-print-emerald:hover {
    background: linear-gradient(135deg, #047857 0%, #065f46 100%) !important;
    color: #ffffff !important;
    transform: translateY(-1px) !important;
    box-shadow: 0 6px 16px rgba(5, 150, 105, 0.35) !important;
}

.custom-invoice-table th {
    font-size: 12px !important;
    font-weight: 700 !important;
    text-transform: uppercase !important;
    letter-spacing: 0.5px !important;
    color: #64748b !important;
    border-bottom: 1px solid #e2e8f0 !important;
}

.custom-invoice-table td {
    font-size: 13.5px !important;
    border-bottom: 1px solid #f1f5f9 !important;
}

.address-box {
    transition: all 0.2s ease;
}

.bg-success-subtle { background-color: #ecfdf5 !important; }
.bg-danger-subtle { background-color: #fef2f2 !important; }
</style>
@endsection

