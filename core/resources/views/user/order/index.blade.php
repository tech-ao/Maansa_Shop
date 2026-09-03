@extends('master.front')
@section('title')
    {{__('My Orders')}}
@endsection

@section('content')
<!-- Page Title-->
<div class="page-title">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <ul class="breadcrumbs">
                    <li><a href="{{route('front.index')}}">{{__('Home')}}</a> </li>
                    <li class="separator"></li>
                    <li>{{__('My Account')}}</li>
                    <li class="separator"></li>
                    <li>{{__('Orders')}}</li>
                </ul>
            </div>
        </div>
    </div>
</div>

<!-- Page Content-->
<div class="container padding-bottom-3x mb-1">
    <div class="row">
        @include('includes.user_sitebar')
        
        <div class="col-lg-8">
            <div class="padding-top-2x mt-2 hidden-lg-up"></div>

            <div class="card modern-orders-card border-0 shadow-sm rounded-4">
                <!-- Header -->
                <div class="card-header bg-white px-4 py-3 border-bottom d-flex flex-wrap align-items-center justify-content-between gap-3">
                    <div>
                        <h4 class="mb-1 text-dark fw-bold fs-5">
                            <i class="icon-shopping-bag text-success mr-2"></i>{{ __('Order History') }}
                        </h4>
                        <p class="mb-0 text-muted small">
                            {{ __('Track past and current purchases, download invoices, and check shipping status.') }}
                        </p>
                    </div>
                    <span class="badge bg-light text-dark border px-3 py-2 rounded-pill fw-semibold">
                        {{ $orders->count() }} {{ __('Total Orders') }}
                    </span>
                </div>

                <!-- Body / Orders List -->
                <div class="card-body p-0">
                    @if($orders->count() > 0)
                        <!-- Desktop Table View -->
                        <div class="table-responsive d-none d-md-block">
                            <table class="table table-hover align-middle mb-0 custom-orders-table">
                                <thead class="table-light">
                                    <tr>
                                        <th class="ps-4">{{ __('Order #') }}</th>
                                        <th>{{ __('Date') }}</th>
                                        <th>{{ __('Total') }}</th>
                                        <th>{{ __('Order Status') }}</th>
                                        <th>{{ __('Payment') }}</th>
                                        <th class="text-end pe-4">{{ __('Action') }}</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($orders as $order)
                                        <tr>
                                            <td class="ps-4">
                                                <a href="{{ route('user.order.invoice', $order->id) }}" class="fw-bold text-dark text-decoration-none hover-primary">
                                                    {{ $order->transaction_number }}
                                                </a>
                                            </td>
                                            <td>
                                                <span class="text-muted small">
                                                    {{ $order->created_at->format('M d, Y') }}
                                                </span>
                                            </td>
                                            <td>
                                                <span class="fw-bold text-dark fs-6">
                                                    @if ($setting->currency_direction == 1)
                                                        {{ $order->currency_sign }}{{ PriceHelper::OrderTotal($order) }}
                                                    @else
                                                        {{ PriceHelper::OrderTotal($order) }}{{ $order->currency_sign }}
                                                    @endif
                                                </span>
                                            </td>
                                            <td>
                                                @if($order->order_status == 'Pending')
                                                    <span class="badge bg-warning-subtle text-warning border border-warning-subtle rounded-pill px-3 py-1">{{ $order->order_status }}</span>
                                                @elseif($order->order_status == 'In Progress')
                                                    <span class="badge bg-info-subtle text-info border border-info-subtle rounded-pill px-3 py-1">{{ $order->order_status }}</span>
                                                @elseif($order->order_status == 'Shipped')
                                                    <span class="badge bg-primary-subtle text-primary border border-primary-subtle rounded-pill px-3 py-1">{{ __('Shipped') }}</span>
                                                @elseif($order->order_status == 'Delivered')
                                                    <span class="badge bg-success-subtle text-success border border-success-subtle rounded-pill px-3 py-1">{{ $order->order_status }}</span>
                                                @else
                                                    <span class="badge bg-danger-subtle text-danger border border-danger-subtle rounded-pill px-3 py-1">{{ $order->order_status }}</span>
                                                @endif
                                            </td>
                                            <td>
                                                @if($order->payment_status == 'Paid')
                                                    <span class="badge bg-success-subtle text-success border border-success-subtle rounded-pill px-3 py-1">{{ __('Paid') }}</span>
                                                @else
                                                    <span class="badge bg-danger-subtle text-danger border border-danger-subtle rounded-pill px-3 py-1">{{ __('Unpaid') }}</span>
                                                @endif
                                            </td>
                                            <td class="text-end pe-4">
                                                <a href="{{ route('user.order.invoice', $order->id) }}" class="btn btn-sm btn-outline-success rounded-pill px-3 py-1">
                                                    <i class="icon-file-text mr-1"></i> {{ __('Invoice') }}
                                                </a>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>

                        <!-- Mobile Cards View -->
                        <div class="d-md-none p-3">
                            @foreach ($orders as $order)
                                <div class="order-mobile-card mb-3 p-3 bg-white rounded-3 border shadow-sm">
                                    <div class="d-flex justify-content-between align-items-start mb-2">
                                        <div>
                                            <a href="{{ route('user.order.invoice', $order->id) }}" class="fw-bold text-dark text-decoration-none fs-6 d-block">
                                                {{ $order->transaction_number }}
                                            </a>
                                            <span class="text-muted small">
                                                <i class="icon-calendar mr-1"></i>{{ $order->created_at->format('M d, Y') }}
                                            </span>
                                        </div>
                                        <div class="text-end">
                                            <span class="fw-bold text-success fs-6 d-block">
                                                @if ($setting->currency_direction == 1)
                                                    {{ $order->currency_sign }}{{ PriceHelper::OrderTotal($order) }}
                                                @else
                                                    {{ PriceHelper::OrderTotal($order) }}{{ $order->currency_sign }}
                                                @endif
                                            </span>
                                        </div>
                                    </div>

                                    <div class="d-flex justify-content-between align-items-center my-2 pt-2 border-top">
                                        <div class="d-flex align-items-center gap-2">
                                            @if($order->order_status == 'Pending')
                                                <span class="badge bg-warning-subtle text-warning border border-warning-subtle rounded-pill px-2 py-1 small">{{ $order->order_status }}</span>
                                            @elseif($order->order_status == 'In Progress')
                                                <span class="badge bg-info-subtle text-info border border-info-subtle rounded-pill px-2 py-1 small">{{ $order->order_status }}</span>
                                            @elseif($order->order_status == 'Shipped')
                                                <span class="badge bg-primary-subtle text-primary border border-primary-subtle rounded-pill px-2 py-1 small">{{ __('Shipped') }}</span>
                                            @elseif($order->order_status == 'Delivered')
                                                <span class="badge bg-success-subtle text-success border border-success-subtle rounded-pill px-2 py-1 small">{{ $order->order_status }}</span>
                                            @else
                                                <span class="badge bg-danger-subtle text-danger border border-danger-subtle rounded-pill px-2 py-1 small">{{ $order->order_status }}</span>
                                            @endif

                                            @if($order->payment_status == 'Paid')
                                                <span class="badge bg-success-subtle text-success border border-success-subtle rounded-pill px-2 py-1 small">{{ __('Paid') }}</span>
                                            @else
                                                <span class="badge bg-danger-subtle text-danger border border-danger-subtle rounded-pill px-2 py-1 small">{{ __('Unpaid') }}</span>
                                            @endif
                                        </div>

                                        <a href="{{ route('user.order.invoice', $order->id) }}" class="btn btn-sm btn-outline-success rounded-pill px-3 py-1">
                                            <i class="icon-file-text mr-1"></i> {{ __('Invoice') }}
                                        </a>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    @else
                        <!-- Clean Empty State -->
                        <div class="text-center py-5 px-3">
                            <div class="order-empty-icon mb-3">
                                <i class="icon-shopping-bag"></i>
                            </div>
                            <h5 class="text-dark fw-bold mb-1">{{ __('No Orders Found') }}</h5>
                            <p class="text-muted small mb-4" style="max-width: 360px; margin: 0 auto;">
                                {{ __('You have not placed any orders yet. Discover our fresh collection and start shopping today.') }}
                            </p>
                            <a href="{{ route('front.catalog') }}" class="btn btn-sm btn-primary-green rounded-pill px-4 py-2">
                                <i class="icon-shopping-cart mr-1"></i> {{ __('Explore Products') }}
                            </a>
                        </div>
                    @endif
                </div>
            </div>

        </div>
    </div>
</div>

<style>
.modern-orders-card {
    background: #ffffff !important;
    border-radius: 18px !important;
    overflow: hidden !important;
    border: 1px solid #e2e8f0 !important;
    box-shadow: 0 4px 20px rgba(0, 0, 0, 0.05) !important;
}

.custom-orders-table th {
    font-size: 12px !important;
    font-weight: 700 !important;
    text-transform: uppercase !important;
    letter-spacing: 0.5px !important;
    color: #64748b !important;
    padding: 14px 16px !important;
    border-bottom: 1px solid #e2e8f0 !important;
}

.custom-orders-table td {
    padding: 16px !important;
    font-size: 14px !important;
    border-bottom: 1px solid #f1f5f9 !important;
}

.order-mobile-card {
    border: 1px solid #e2e8f0 !important;
    border-radius: 14px !important;
    transition: all 0.2s ease !important;
}

.order-mobile-card:hover {
    border-color: #cbd5e1 !important;
    box-shadow: 0 4px 14px rgba(0, 0, 0, 0.06) !important;
}

.order-empty-icon {
    width: 72px;
    height: 72px;
    border-radius: 50%;
    background: #ecfdf5;
    color: #059669;
    font-size: 32px;
    display: inline-flex;
    align-items: center;
    justify-content: center;
    margin: 0 auto;
}

.btn-primary-green {
    background: linear-gradient(135deg, #059669 0%, #047857 100%) !important;
    color: #ffffff !important;
    border: none !important;
    box-shadow: 0 4px 12px rgba(5, 150, 105, 0.3) !important;
    transition: all 0.2s ease !important;
}

.btn-primary-green:hover {
    background: linear-gradient(135deg, #047857 0%, #065f46 100%) !important;
    color: #ffffff !important;
    transform: translateY(-2px) !important;
    box-shadow: 0 6px 18px rgba(5, 150, 105, 0.4) !important;
}

.bg-warning-subtle { background-color: #fffbeb !important; }
.bg-info-subtle { background-color: #eff6ff !important; }
.bg-success-subtle { background-color: #ecfdf5 !important; }
.bg-danger-subtle { background-color: #fef2f2 !important; }

.hover-primary:hover {
    color: #059669 !important;
}

@media (max-width: 767px) {
    .modern-orders-card {
        border-radius: 14px !important;
    }
}
</style>
@endsection


