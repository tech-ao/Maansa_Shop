@extends('master.back')

@section('content')
<div class="container-fluid">

    <!-- Welcome Hero Banner -->
    <div class="dash-hero-banner">
        <div class="dash-hero-content">
            <div class="dash-hero-text">
                <h2>Welcome back, {{ Auth::guard('admin')->check() ? Auth::guard('admin')->user()->name : 'Administrator' }}! 👋</h2>
                <p>{{ __('Here is an overview of your store performance, revenue, orders, and customer engagement.') }}</p>
            </div>
            <div class="dash-hero-actions">
                <a href="{{ route('back.item.add') }}" class="btn-hero-action btn-hero-primary">
                    <i class="fa-solid fa-plus"></i>
                    <span>{{ __('Add Product') }}</span>
                </a>
                <a href="{{ route('back.order.index') }}" class="btn-hero-action">
                    <i class="fa-solid fa-cart-shopping"></i>
                    <span>{{ __('View Orders') }}</span>
                </a>
                <a href="{{ route('front.index') }}" target="_blank" class="btn-hero-action">
                    <i class="fa-solid fa-arrow-up-right-from-square"></i>
                    <span>{{ __('Visit Store') }}</span>
                </a>
            </div>
        </div>
    </div>

    @include('alerts.alerts')

    <!-- Section 1: Financial & Revenue Metrics (Hero Gradient Cards) -->
    <div class="dash-section-header">
        <h4><i class="fa-solid fa-chart-line text-primary"></i> {{ __('Financial & Revenue Overview') }}</h4>
        <span class="badge-count">{{ __('Real-time Income') }}</span>
    </div>

    <div class="row">
        <!-- Total Earnings -->
        <div class="col-xl-3 col-lg-6 col-md-6 col-sm-6 col-12">
            <div class="hero-stat-card grad-emerald">
                <div class="hero-stat-top">
                    <span class="hero-stat-label">{{ __('Total Revenue') }}</span>
                    <div class="hero-stat-icon">
                        <i class="fa-solid fa-sack-dollar"></i>
                    </div>
                </div>
                <div>
                    <h3 class="hero-stat-value">{{ $totalEarning }}</h3>
                    <span class="hero-stat-sub">{{ __('All-Time Gross Income') }}</span>
                </div>
            </div>
        </div>

        <!-- This Month Earnings -->
        <div class="col-xl-3 col-lg-6 col-md-6 col-sm-6 col-12">
            <div class="hero-stat-card grad-indigo">
                <div class="hero-stat-top">
                    <span class="hero-stat-label">{{ __('This Month') }}</span>
                    <div class="hero-stat-icon">
                        <i class="fa-solid fa-calendar-days"></i>
                    </div>
                </div>
                <div>
                    <h3 class="hero-stat-value">{{ $totalMonthEarning }}</h3>
                    <span class="hero-stat-sub">{{ __('Current Month Revenue') }}</span>
                </div>
            </div>
        </div>

        <!-- This Year Earnings -->
        <div class="col-xl-3 col-lg-6 col-md-6 col-sm-6 col-12">
            <div class="hero-stat-card grad-sky">
                <div class="hero-stat-top">
                    <span class="hero-stat-label">{{ __('This Year') }}</span>
                    <div class="hero-stat-icon">
                        <i class="fa-solid fa-money-bill-trend-up"></i>
                    </div>
                </div>
                <div>
                    <h3 class="hero-stat-value">{{ $totalYearEarning }}</h3>
                    <span class="hero-stat-sub">{{ __('Annual Store Revenue') }}</span>
                </div>
            </div>
        </div>

        <!-- Pending Earnings -->
        <div class="col-xl-3 col-lg-6 col-md-6 col-sm-6 col-12">
            <div class="hero-stat-card grad-amber">
                <div class="hero-stat-top">
                    <span class="hero-stat-label">{{ __('Pending Revenue') }}</span>
                    <div class="hero-stat-icon">
                        <i class="fa-solid fa-clock-rotate-left"></i>
                    </div>
                </div>
                <div>
                    <h3 class="hero-stat-value">{{ $totalTodayEarning }}</h3>
                    <span class="hero-stat-sub">{{ __('Pending Orders Value') }}</span>
                </div>
            </div>
        </div>
    </div>

    <!-- Section 2: Order Fulfillment Pipeline -->
    <div class="dash-section-header mt-2">
        <h4><i class="fa-solid fa-truck-ramp-box text-primary"></i> {{ __('Order Fulfillment Pipeline') }}</h4>
        <span class="badge-count">{{ __('Order Status') }}</span>
    </div>

    <div class="row">
        <!-- Total Orders -->
        <div class="col-xl-3 col-lg-6 col-md-6 col-sm-6 col-12">
            <a href="{{ route('back.order.index') }}" style="text-decoration: none;">
                <div class="modern-stat-card">
                    <div class="stat-badge-icon blue">
                        <i class="fa-solid fa-bag-shopping"></i>
                    </div>
                    <div class="stat-info-wrap">
                        <p class="stat-name">{{ __('Total Orders') }}</p>
                        <h4 class="stat-num">{{ $totalOrders }}</h4>
                    </div>
                </div>
            </a>
        </div>

        <!-- Pending Orders -->
        <div class="col-xl-3 col-lg-6 col-md-6 col-sm-6 col-12">
            <a href="{{ route('back.order.index') }}?status=Pending" style="text-decoration: none;">
                <div class="modern-stat-card">
                    <div class="stat-badge-icon amber">
                        <i class="fa-solid fa-hourglass-half"></i>
                    </div>
                    <div class="stat-info-wrap">
                        <p class="stat-name">{{ __('Pending Orders') }}</p>
                        <h4 class="stat-num">{{ $totalPendingOrders }}</h4>
                    </div>
                </div>
            </a>
        </div>

        <!-- Delivered Orders -->
        <div class="col-xl-3 col-lg-6 col-md-6 col-sm-6 col-12">
            <a href="{{ route('back.order.index') }}?status=Delivered" style="text-decoration: none;">
                <div class="modern-stat-card">
                    <div class="stat-badge-icon emerald">
                        <i class="fa-solid fa-circle-check"></i>
                    </div>
                    <div class="stat-info-wrap">
                        <p class="stat-name">{{ __('Delivered Orders') }}</p>
                        <h4 class="stat-num">{{ $totalDeliveredOrders }}</h4>
                    </div>
                </div>
            </a>
        </div>

        <!-- Canceled Orders -->
        <div class="col-xl-3 col-lg-6 col-md-6 col-sm-6 col-12">
            <a href="{{ route('back.order.index') }}?status=Canceled" style="text-decoration: none;">
                <div class="modern-stat-card">
                    <div class="stat-badge-icon rose">
                        <i class="fa-solid fa-circle-xmark"></i>
                    </div>
                    <div class="stat-info-wrap">
                        <p class="stat-name">{{ __('Canceled Orders') }}</p>
                        <h4 class="stat-num">{{ $totalCanceledOrders }}</h4>
                    </div>
                </div>
            </a>
        </div>
    </div>

    <!-- Section 3: Catalog & Sales Performance -->
    <div class="dash-section-header mt-2">
        <h4><i class="fa-solid fa-boxes-stacked text-primary"></i> {{ __('Catalog & Customer Analytics') }}</h4>
        <span class="badge-count">{{ __('Inventory & Sales') }}</span>
    </div>

    <div class="row">
        <!-- Total Product Sales -->
        <div class="col-xl-3 col-lg-6 col-md-6 col-sm-6 col-12">
            <div class="modern-stat-card">
                <div class="stat-badge-icon indigo">
                    <i class="fa-solid fa-tags"></i>
                </div>
                <div class="stat-info-wrap">
                    <p class="stat-name">{{ __('Total Items Sold') }}</p>
                    <h4 class="stat-num">{{ $totalProductSale }}</h4>
                </div>
            </div>
        </div>

        <!-- Today Product Order -->
        <div class="col-xl-3 col-lg-6 col-md-6 col-sm-6 col-12">
            <div class="modern-stat-card">
                <div class="stat-badge-icon sky">
                    <i class="fa-solid fa-calendar-day"></i>
                </div>
                <div class="stat-info-wrap">
                    <p class="stat-name">{{ __('Today Items Sold') }}</p>
                    <h4 class="stat-num">{{ $totalTodayProductSale }}</h4>
                </div>
            </div>
        </div>

        <!-- This Month Sale -->
        <div class="col-xl-3 col-lg-6 col-md-6 col-sm-6 col-12">
            <div class="modern-stat-card">
                <div class="stat-badge-icon blue">
                    <i class="fa-solid fa-chart-simple"></i>
                </div>
                <div class="stat-info-wrap">
                    <p class="stat-name">{{ __('This Month Sales') }}</p>
                    <h4 class="stat-num">{{ $totalCurrentMonthProductSale }}</h4>
                </div>
            </div>
        </div>

        <!-- This Year Product Sale -->
        <div class="col-xl-3 col-lg-6 col-md-6 col-sm-6 col-12">
            <div class="modern-stat-card">
                <div class="stat-badge-icon teal">
                    <i class="fa-solid fa-calendar-check"></i>
                </div>
                <div class="stat-info-wrap">
                    <p class="stat-name">{{ __('This Year Sales') }}</p>
                    <h4 class="stat-num">{{ $totalLatYearProductSale }}</h4>
                </div>
            </div>
        </div>

        <!-- Total Products -->
        <div class="col-xl-3 col-lg-6 col-md-6 col-sm-6 col-12">
            <a href="{{ route('back.item.index') }}" style="text-decoration: none;">
                <div class="modern-stat-card">
                    <div class="stat-badge-icon emerald">
                        <i class="fa-solid fa-boxes-stacked"></i>
                    </div>
                    <div class="stat-info-wrap">
                        <p class="stat-name">{{ __('Total Products') }}</p>
                        <h4 class="stat-num">{{ $totalItems }}</h4>
                    </div>
                </div>
            </a>
        </div>

        <!-- Total Customers -->
        <div class="col-xl-3 col-lg-6 col-md-6 col-sm-6 col-12">
            <a href="{{ route('back.user.index') }}" style="text-decoration: none;">
                <div class="modern-stat-card">
                    <div class="stat-badge-icon violet">
                        <i class="fa-solid fa-users"></i>
                    </div>
                    <div class="stat-info-wrap">
                        <p class="stat-name">{{ __('Total Customers') }}</p>
                        <h4 class="stat-num">{{ $totalUsers }}</h4>
                    </div>
                </div>
            </a>
        </div>

        <!-- Total Categories -->
        <div class="col-xl-3 col-lg-6 col-md-6 col-sm-6 col-12">
            <a href="{{ route('back.category.index') }}" style="text-decoration: none;">
                <div class="modern-stat-card">
                    <div class="stat-badge-icon amber">
                        <i class="fa-solid fa-layer-group"></i>
                    </div>
                    <div class="stat-info-wrap">
                        <p class="stat-name">{{ __('Categories') }}</p>
                        <h4 class="stat-num">{{ $totalCategory }}</h4>
                    </div>
                </div>
            </a>
        </div>

        <!-- Total Brands -->
        <div class="col-xl-3 col-lg-6 col-md-6 col-sm-6 col-12">
            <a href="{{ route('back.brand.index') }}" style="text-decoration: none;">
                <div class="modern-stat-card">
                    <div class="stat-badge-icon rose">
                        <i class="fa-solid fa-copyright"></i>
                    </div>
                    <div class="stat-info-wrap">
                        <p class="stat-name">{{ __('Total Brands') }}</p>
                        <h4 class="stat-num">{{ $totalBrand }}</h4>
                    </div>
                </div>
            </a>
        </div>
    </div>

    <!-- Section 4: Support & Community Strip -->
    <div class="row">
        <!-- Reviews -->
        <div class="col-xl-3 col-lg-6 col-md-6 col-sm-6 col-12">
            <a href="{{ route('back.review.index') }}" style="text-decoration: none;">
                <div class="compact-metric-pill">
                    <div class="compact-metric-left">
                        <i class="fa-solid fa-star text-warning compact-metric-icon"></i>
                        <span class="compact-metric-name">{{ __('Customer Reviews') }}</span>
                    </div>
                    <span class="compact-metric-count">{{ $totalReview }}</span>
                </div>
            </a>
        </div>

        <!-- Support Tickets -->
        <div class="col-xl-3 col-lg-6 col-md-6 col-sm-6 col-12">
            <a href="{{ route('back.ticket.index') }}" style="text-decoration: none;">
                <div class="compact-metric-pill">
                    <div class="compact-metric-left">
                        <i class="fa-solid fa-headset text-info compact-metric-icon"></i>
                        <span class="compact-metric-name">{{ __('Support Tickets') }}</span>
                    </div>
                    <span class="compact-metric-count">
                        {{ $totalTicket }}
                        @if($totalPendingTicket > 0)
                            <span class="badge badge-warning" style="font-size: 11px; font-weight: 700; padding: 2px 7px; border-radius: 999px; margin-left: 4px;">{{ $totalPendingTicket }} pending</span>
                        @endif
                    </span>
                </div>
            </a>
        </div>

        <!-- Subscribers -->
        <div class="col-xl-3 col-lg-6 col-md-6 col-sm-6 col-12">
            <a href="{{ route('back.subscribers.index') }}" style="text-decoration: none;">
                <div class="compact-metric-pill">
                    <div class="compact-metric-left">
                        <i class="fa-solid fa-envelope-open-text text-primary compact-metric-icon"></i>
                        <span class="compact-metric-name">{{ __('Newsletter Subscribers') }}</span>
                    </div>
                    <span class="compact-metric-count">{{ $totalSubscriber }}</span>
                </div>
            </a>
        </div>

        <!-- Blogs -->
        <div class="col-xl-3 col-lg-6 col-md-6 col-sm-6 col-12">
            <a href="{{ route('back.post.index') }}" style="text-decoration: none;">
                <div class="compact-metric-pill">
                    <div class="compact-metric-left">
                        <i class="fa-solid fa-newspaper text-secondary compact-metric-icon"></i>
                        <span class="compact-metric-name">{{ __('Published Blogs') }}</span>
                    </div>
                    <span class="compact-metric-count">{{ $totalBlog }}</span>
                </div>
            </a>
        </div>
    </div>

    <!-- Section 5: Interactive Analytical Charts -->
    <div class="row mt-2">
        <div class="col-lg-6 mb-4">
            <div class="dash-chart-card">
                <div class="dash-chart-header">
                    <h4><i class="fa-solid fa-chart-area text-primary"></i> {{ __('Monthly Product Sales Trend') }}</h4>
                </div>
                <div class="dash-chart-body">
                    <div class="chart-container" style="min-height: 280px; position: relative;">
                        <canvas id="multipleLineChart"></canvas>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-lg-6 mb-4">
            <div class="dash-chart-card">
                <div class="dash-chart-header">
                    <h4><i class="fa-solid fa-chart-line text-danger"></i> {{ __('Monthly Earnings Growth') }}</h4>
                </div>
                <div class="dash-chart-body">
                    <div class="chart-container" style="min-height: 280px; position: relative;">
                        <canvas id="multipleLineChart2"></canvas>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Section 6: Recent Orders Table -->
    <div class="row">
        <div class="col-12 mb-4">
            <div class="dash-chart-card">
                <div class="dash-chart-header">
                    <h4><i class="fa-solid fa-clock-rotate-left text-primary"></i> {{ __('Recent Customer Orders') }}</h4>
                    <a href="{{ route('back.order.index') }}" class="btn btn-sm btn-outline-primary btn-round">
                        {{ __('View All Orders') }} <i class="fa-solid fa-arrow-right ml-1"></i>
                    </a>
                </div>
                <div class="dash-chart-body p-0">
                    @if ($recentOrders->count() > 0)
                        <div class="table-responsive">
                            <table class="table table-modern mb-0">
                                <thead>
                                    <tr>
                                        <th>{{ __('Customer') }}</th>
                                        <th>{{ __('Order Transaction #') }}</th>
                                        <th>{{ __('Payment Method') }}</th>
                                        <th>{{ __('Total Amount') }}</th>
                                        <th class="text-right">{{ __('Action') }}</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($recentOrders as $order)
                                    <tr>
                                        <td>
                                            <a href="{{ route('back.user.show', $order->user_id) }}" style="font-weight: 700; color: #0f172a; text-decoration: none;">
                                                <i class="fa-regular fa-user mr-1 text-muted"></i>
                                                {{ $order->user ? $order->user->displayName() : 'Guest Customer' }}
                                            </a>
                                        </td>
                                        <td>
                                            <a href="{{ route('back.order.invoice', $order->id) }}" class="order-badge-pill">
                                                <i class="fa-solid fa-receipt"></i>
                                                {{ $order->transaction_number }}
                                            </a>
                                        </td>
                                        <td>
                                            <span class="badge badge-light" style="font-size: 12px; font-weight: 600; padding: 4px 8px; border: 1px solid #e2e8f0;">
                                                {{ $order->payment_method ?? 'Cash On Delivery' }}
                                            </span>
                                        </td>
                                        <td>
                                            <strong style="color: #059669; font-size: 14px;">
                                                {{ $order->currency_sign }}{{ PriceHelper::OrderTotal($order) }}
                                            </strong>
                                        </td>
                                        <td class="text-right">
                                            <a href="{{ route('back.order.invoice', $order->id) }}" class="btn btn-xs btn-primary btn-round">
                                                <i class="fa-solid fa-eye"></i> {{ __('Invoice') }}
                                            </a>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    @else
                        <div class="text-center py-5">
                            <div style="font-size: 40px; color: #cbd5e1; margin-bottom: 10px;">
                                <i class="fa-solid fa-basket-shopping"></i>
                            </div>
                            <h5 style="color: #64748b; font-weight: 600;">{{ __('No Recent Orders Found') }}</h5>
                            <p style="font-size: 13px; color: #94a3b8;">{{ __('New incoming orders from customers will show up here.') }}</p>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>

</div>
@endsection

@section('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        var multipleLineChart = document.getElementById('multipleLineChart');
        var multipleLineChart2 = document.getElementById('multipleLineChart2');

        if (multipleLineChart) {
            var ctx1 = multipleLineChart.getContext('2d');
            var myMultipleLineChart = new Chart(ctx1, {
                type: 'line',
                data: {
                    labels: [{!! $order_days !!}],
                    datasets: [{
                        label: "Product Sales",
                        borderColor: "#10b981",
                        pointBorderColor: "#FFF",
                        pointBackgroundColor: "#10b981",
                        pointBorderWidth: 2,
                        pointHoverRadius: 5,
                        pointHoverBorderWidth: 2,
                        pointRadius: 4,
                        backgroundColor: 'rgba(79, 70, 229, 0.06)',
                        fill: true,
                        borderWidth: 2.5,
                        tension: 0.35,
                        data: [{!! $order_sales !!}]
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    legend: {
                        display: false
                    },
                    tooltips: {
                        bodySpacing: 6,
                        mode: "nearest",
                        intersect: 0,
                        position: "nearest",
                        xPadding: 12,
                        yPadding: 12,
                        cornerRadius: 8,
                        caretPadding: 10
                    },
                    layout: {
                        padding: { left: 10, right: 10, top: 15, bottom: 10 }
                    },
                    scales: {
                        yAxes: [{
                            gridLines: {
                                drawBorder: false,
                                color: '#f1f5f9'
                            },
                            ticks: {
                                fontColor: '#94a3b8',
                                beginAtZero: true
                            }
                        }],
                        xAxes: [{
                            gridLines: {
                                display: false
                            },
                            ticks: {
                                fontColor: '#94a3b8'
                            }
                        }]
                    }
                }
            });
        }

        if (multipleLineChart2) {
            var ctx2 = multipleLineChart2.getContext('2d');
            var myMultipleLineChart2 = new Chart(ctx2, {
                type: 'line',
                data: {
                    labels: [{!! $earning_days !!}],
                    datasets: [{
                        label: "Earnings ({!! PriceHelper::adminCurrency() !!})",
                        borderColor: "#10b981",
                        pointBorderColor: "#FFF",
                        pointBackgroundColor: "#10b981",
                        pointBorderWidth: 2,
                        pointHoverRadius: 5,
                        pointHoverBorderWidth: 2,
                        pointRadius: 4,
                        backgroundColor: 'rgba(16, 185, 129, 0.06)',
                        fill: true,
                        borderWidth: 2.5,
                        tension: 0.35,
                        data: [{!! $total_incomess !!}]
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    legend: {
                        display: false
                    },
                    tooltips: {
                        bodySpacing: 6,
                        mode: "nearest",
                        intersect: 0,
                        position: "nearest",
                        xPadding: 12,
                        yPadding: 12,
                        cornerRadius: 8,
                        caretPadding: 10
                    },
                    layout: {
                        padding: { left: 10, right: 10, top: 15, bottom: 10 }
                    },
                    scales: {
                        yAxes: [{
                            gridLines: {
                                drawBorder: false,
                                color: '#f1f5f9'
                            },
                            ticks: {
                                fontColor: '#94a3b8',
                                beginAtZero: true
                            }
                        }],
                        xAxes: [{
                            gridLines: {
                                display: false
                            },
                            ticks: {
                                fontColor: '#94a3b8'
                            }
                        }]
                    }
                }
            });
        }
    });
</script>
@endsection
