@extends('master.front')
@section('title')
    {{__('Dashboard')}}
@endsection
@section('content')

<!-- Page Title-->
<div class="page-title">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <ul class="breadcrumbs">
                    <li><a href="{{ route('front.index') }}">{{__('Home')}}</a> </li>
                    <li class="separator"></li>
                    <li>{{__('My Account')}} </li>
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

            <!-- Welcome Greeting Banner -->
            <div class="user-dashboard-hero mb-4">
                <div class="d-flex align-items-center justify-content-between flex-wrap gap-3">
                    <div>
                        <h4 class="hero-title mb-1">{{ __('Hello') }}, {{ Auth::user()->first_name }} 👋</h4>
                        <p class="hero-subtitle mb-0">{{ __('Here is a quick overview of your orders and account activity.') }}</p>
                    </div>
                    <a href="{{ route('user.order.index') }}" class="btn btn-sm hero-action-btn">
                        <i class="icon-shopping-bag mr-1"></i> {{ __('View All Orders') }}
                    </a>
                </div>
            </div>

            <!-- Statistics Grid (2 columns on mobile, 3 on desktop) -->
            <div class="row g-3 modern-user-stats-grid mb-4">
                <!-- All Orders -->
                <div class="col-6 col-md-4 mb-3">
                    <a href="{{ route('user.order.index') }}" class="stat-card-link">
                        <div class="stat-card stat-all">
                            <div class="stat-icon-wrapper">
                                <i class="icon-shopping-bag"></i>
                            </div>
                            <div class="stat-content">
                                <h3 class="stat-number">{{ $allorders }}</h3>
                                <p class="stat-label">{{ __('All Orders') }}</p>
                            </div>
                        </div>
                    </a>
                </div>

                <!-- Completed Orders -->
                <div class="col-6 col-md-4 mb-3">
                    <a href="{{ route('user.order.index') }}" class="stat-card-link">
                        <div class="stat-card stat-delivered">
                            <div class="stat-icon-wrapper">
                                <i class="icon-check-circle"></i>
                            </div>
                            <div class="stat-content">
                                <h3 class="stat-number">{{ $delivered }}</h3>
                                <p class="stat-label">{{ __('Completed') }}</p>
                            </div>
                        </div>
                    </a>
                </div>

                <!-- Processing Orders -->
                <div class="col-6 col-md-4 mb-3">
                    <a href="{{ route('user.order.index') }}" class="stat-card-link">
                        <div class="stat-card stat-processing">
                            <div class="stat-icon-wrapper">
                                <i class="icon-truck"></i>
                            </div>
                            <div class="stat-content">
                                <h3 class="stat-number">{{ $progress }}</h3>
                                <p class="stat-label">{{ __('Processing') }}</p>
                            </div>
                        </div>
                    </a>
                </div>

                <!-- Pending Orders -->
                <div class="col-6 col-md-4 mb-3">
                    <a href="{{ route('user.order.index') }}" class="stat-card-link">
                        <div class="stat-card stat-pending">
                            <div class="stat-icon-wrapper">
                                <i class="icon-clock"></i>
                            </div>
                            <div class="stat-content">
                                <h3 class="stat-number">{{ $pending }}</h3>
                                <p class="stat-label">{{ __('Pending') }}</p>
                            </div>
                        </div>
                    </a>
                </div>

                <!-- Canceled Orders -->
                <div class="col-6 col-md-4 mb-3">
                    <a href="{{ route('user.order.index') }}" class="stat-card-link">
                        <div class="stat-card stat-canceled">
                            <div class="stat-icon-wrapper">
                                <i class="icon-x-circle"></i>
                            </div>
                            <div class="stat-content">
                                <h3 class="stat-number">{{ $canceled }}</h3>
                                <p class="stat-label">{{ __('Canceled') }}</p>
                            </div>
                        </div>
                    </a>
                </div>

                <!-- Wishlist Items -->
                <div class="col-6 col-md-4 mb-3">
                    <a href="{{ route('user.wishlist.index') }}" class="stat-card-link">
                        <div class="stat-card stat-wishlist">
                            <div class="stat-icon-wrapper">
                                <i class="icon-heart"></i>
                            </div>
                            <div class="stat-content">
                                <h3 class="stat-number">{{ Auth::user()->wishlists->count() }}</h3>
                                <p class="stat-label">{{ __('Wishlist') }}</p>
                            </div>
                        </div>
                    </a>
                </div>
            </div>

            <!-- Recent Orders Section -->
            <div class="card recent-orders-card border-0 shadow-sm rounded-4">
                <div class="card-header bg-white py-3 px-4 d-flex justify-content-between align-items-center border-bottom">
                    <h5 class="mb-0 fw-bold fs-6 text-dark">
                        <i class="icon-clock text-primary mr-2"></i> {{ __('Recent Orders') }}
                    </h5>
                    <a href="{{ route('user.order.index') }}" class="text-decoration-none small text-success fw-bold">
                        {{ __('View All') }} <i class="icon-chevron-right ml-1"></i>
                    </a>
                </div>
                <div class="card-body p-0">
                    @if(isset($recent_orders) && $recent_orders->count() > 0)
                        <div class="table-responsive">
                            <table class="table table-hover align-middle mb-0 custom-recent-table">
                                <thead class="table-light">
                                    <tr>
                                        <th class="ps-4">{{ __('Order ID') }}</th>
                                        <th>{{ __('Date') }}</th>
                                        <th>{{ __('Status') }}</th>
                                        <th>{{ __('Total') }}</th>
                                        <th class="text-end pe-4">{{ __('Action') }}</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($recent_orders as $order)
                                        <tr>
                                            <td class="ps-4">
                                                <span class="fw-bold text-dark">#{{ $order->transaction_number }}</span>
                                            </td>
                                            <td>
                                                <span class="text-muted small">{{ $order->created_at->format('M d, Y') }}</span>
                                            </td>
                                            <td>
                                                @if($order->order_status == 'Delivered')
                                                    <span class="badge bg-success-subtle text-success border border-success-subtle px-2 py-1 rounded-pill">{{ __('Delivered') }}</span>
                                                @elseif($order->order_status == 'In Progress')
                                                    <span class="badge bg-info-subtle text-info border border-info-subtle px-2 py-1 rounded-pill">{{ __('Processing') }}</span>
                                                @elseif($order->order_status == 'Canceled')
                                                    <span class="badge bg-danger-subtle text-danger border border-danger-subtle px-2 py-1 rounded-pill">{{ __('Canceled') }}</span>
                                                @else
                                                    <span class="badge bg-warning-subtle text-warning border border-warning-subtle px-2 py-1 rounded-pill">{{ __('Pending') }}</span>
                                                @endif
                                            </td>
                                            <td>
                                                <span class="fw-bold text-dark">{{ $order->currency_sign }}{{ \App\Helpers\PriceHelper::OrderTotal($order) }}</span>
                                            </td>
                                            <td class="text-end pe-4">
                                                <a href="{{ route('user.order.invoice', $order->id) }}" class="btn btn-sm btn-outline-success rounded-pill px-3 py-1">
                                                    {{ __('Invoice') }}
                                                </a>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    @else
                        <div class="text-center py-5">
                            <div class="mb-3 text-muted" style="font-size: 42px;">
                                <i class="icon-shopping-bag"></i>
                            </div>
                            <h6 class="text-dark">{{ __('No orders found yet') }}</h6>
                            <p class="text-muted small mb-3">{{ __('When you place orders, they will show up right here.') }}</p>
                            <a href="{{ route('front.catalog') }}" class="btn btn-sm btn-success rounded-pill px-4">
                                {{ __('Start Shopping') }}
                            </a>
                        </div>
                    @endif
                </div>
            </div>

        </div>
    </div>
</div>

<style>
/* Modern User Dashboard Styles */
.user-dashboard-hero {
    background: linear-gradient(135deg, #064e3b 0%, #047857 60%, #059669 100%) !important;
    border-radius: 18px !important;
    padding: 22px 24px !important;
    color: #ffffff !important;
    box-shadow: 0 10px 25px rgba(6, 78, 59, 0.15) !important;
}

.user-dashboard-hero .hero-title {
    color: #ffffff !important;
    font-size: 20px !important;
    font-weight: 700 !important;
}

.user-dashboard-hero .hero-subtitle {
    color: rgba(255, 255, 255, 0.85) !important;
    font-size: 13.5px !important;
}

.hero-action-btn {
    background: rgba(255, 255, 255, 0.2) !important;
    color: #ffffff !important;
    border: 1px solid rgba(255, 255, 255, 0.4) !important;
    border-radius: 999px !important;
    padding: 6px 18px !important;
    font-size: 13px !important;
    font-weight: 600 !important;
    transition: all 0.2s ease !important;
}

.hero-action-btn:hover {
    background: #ffffff !important;
    color: #065f46 !important;
}

.stat-card-link {
    text-decoration: none !important;
    color: inherit !important;
    display: block !important;
}

.modern-user-stats-grid .stat-card {
    background: #ffffff !important;
    border: 1px solid #e2e8f0 !important;
    border-radius: 16px !important;
    padding: 16px 14px !important;
    display: flex !important;
    align-items: center !important;
    gap: 14px !important;
    transition: all 0.25s cubic-bezier(0.16, 1, 0.3, 1) !important;
    box-shadow: 0 2px 8px rgba(0, 0, 0, 0.04) !important;
    height: 100% !important;
}

.modern-user-stats-grid .stat-card:hover {
    transform: translateY(-3px) !important;
    box-shadow: 0 8px 20px rgba(0, 0, 0, 0.08) !important;
    border-color: #cbd5e1 !important;
}

.modern-user-stats-grid .stat-icon-wrapper {
    width: 48px !important;
    height: 48px !important;
    min-width: 48px !important;
    border-radius: 13px !important;
    display: flex !important;
    align-items: center !important;
    justify-content: center !important;
    transition: all 0.2s ease !important;
}

.modern-user-stats-grid .stat-icon-wrapper i {
    width: auto !important;
    height: auto !important;
    line-height: 1 !important;
    background: transparent !important;
    display: inline-block !important;
    border-radius: 0 !important;
    font-size: 22px !important;
    color: inherit !important;
    margin: 0 !important;
    padding: 0 !important;
}

.modern-user-stats-grid .stat-content {
    flex: 1 !important;
    min-width: 0 !important;
}

.modern-user-stats-grid .stat-number {
    font-size: 22px !important;
    font-weight: 800 !important;
    line-height: 1.1 !important;
    margin: 0 0 3px 0 !important;
    color: #0f172a !important;
}

.modern-user-stats-grid .stat-label {
    font-size: 12.5px !important;
    font-weight: 600 !important;
    color: #64748b !important;
    margin: 0 !important;
    white-space: nowrap !important;
    overflow: hidden !important;
    text-overflow: ellipsis !important;
}

/* Individual Color Accents */
.modern-user-stats-grid .stat-all .stat-icon-wrapper {
    background: #ecfdf5 !important;
    color: #059669 !important;
}
.modern-user-stats-grid .stat-all:hover { border-color: #a7f3d0 !important; }

.modern-user-stats-grid .stat-delivered .stat-icon-wrapper {
    background: #f0fdf4 !important;
    color: #16a34a !important;
}
.modern-user-stats-grid .stat-delivered:hover { border-color: #bbf7d0 !important; }

.modern-user-stats-grid .stat-processing .stat-icon-wrapper {
    background: #eff6ff !important;
    color: #2563eb !important;
}
.modern-user-stats-grid .stat-processing:hover { border-color: #bfdbfe !important; }

.modern-user-stats-grid .stat-pending .stat-icon-wrapper {
    background: #fffbeb !important;
    color: #d97706 !important;
}
.modern-user-stats-grid .stat-pending:hover { border-color: #fde68a !important; }

.modern-user-stats-grid .stat-canceled .stat-icon-wrapper {
    background: #fef2f2 !important;
    color: #dc2626 !important;
}
.modern-user-stats-grid .stat-canceled:hover { border-color: #fecaca !important; }

.modern-user-stats-grid .stat-wishlist .stat-icon-wrapper {
    background: #fdf2f8 !important;
    color: #db2777 !important;
}
.modern-user-stats-grid .stat-wishlist:hover { border-color: #fbcfe8 !important; }

/* Recent Orders Table */
.recent-orders-card {
    border-radius: 18px !important;
    overflow: hidden !important;
    border: 1px solid #e2e8f0 !important;
}

.custom-recent-table th {
    font-size: 12px !important;
    font-weight: 700 !important;
    text-transform: uppercase !important;
    letter-spacing: 0.5px !important;
    color: #64748b !important;
    padding: 12px 14px !important;
    border-bottom: 1px solid #e2e8f0 !important;
}

.custom-recent-table td {
    padding: 14px !important;
    font-size: 13.5px !important;
    border-bottom: 1px solid #f1f5f9 !important;
}

.bg-success-subtle { background-color: #ecfdf5 !important; }
.bg-info-subtle { background-color: #eff6ff !important; }
.bg-warning-subtle { background-color: #fffbeb !important; }
.bg-danger-subtle { background-color: #fef2f2 !important; }

/* Mobile Optimizations */
@media (max-width: 767px) {
    .user-dashboard-hero {
        padding: 16px 18px !important;
        border-radius: 14px !important;
    }
    .user-dashboard-hero .hero-title {
        font-size: 18px !important;
    }
    .user-dashboard-hero .hero-subtitle {
        font-size: 12.5px !important;
    }
    .hero-action-btn {
        width: 100% !important;
        text-align: center !important;
        margin-top: 4px !important;
    }
    .modern-user-stats-grid .stat-card {
        padding: 12px 10px !important;
        border-radius: 14px !important;
        gap: 10px !important;
    }
    .modern-user-stats-grid .stat-icon-wrapper {
        width: 40px !important;
        height: 40px !important;
        min-width: 40px !important;
        font-size: 17px !important;
        border-radius: 10px !important;
    }
    .modern-user-stats-grid .stat-icon-wrapper i {
        font-size: 18px !important;
    }
    .modern-user-stats-grid .stat-number {
        font-size: 18px !important;
    }
    .modern-user-stats-grid .stat-label {
        font-size: 11px !important;
    }
}
</style>
@endsection

