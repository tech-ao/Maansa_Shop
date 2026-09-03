@if (!isset($error))
    @php
        $pending_track = null;
        $progress_track = null;
        $shipped_track = null;
        $delivered_track = null;
        $canceled_track = null;

        if (!empty($track_orders)) {
            foreach ($track_orders as $t) {
                if ($t['title'] == 'Pending') $pending_track = $t;
                if ($t['title'] == 'In Progress') $progress_track = $t;
                if ($t['title'] == 'Shipped') $shipped_track = $t;
                if ($t['title'] == 'Delivered') $delivered_track = $t;
                if ($t['title'] == 'Canceled') $canceled_track = $t;
            }
        }

        $is_canceled = !empty($canceled_track) || (isset($order) && $order->order_status == 'Canceled');
        $is_delivered = !empty($delivered_track) || (isset($order) && $order->order_status == 'Delivered');
        $is_shipped = !empty($shipped_track) || (isset($order) && in_array($order->order_status, ['Shipped', 'Delivered'])) || $is_delivered;
        $is_in_progress = !empty($progress_track) || (isset($order) && in_array($order->order_status, ['In Progress', 'Shipped', 'Delivered'])) || $is_shipped;
        $is_pending = true;

        $current_status_label = 'Pending Approval';
        $status_bg = '#fef3c7';
        $status_color = '#d97706';
        $status_border = '#fde68a';

        if ($is_canceled) {
            $current_status_label = 'Order Cancelled';
            $status_bg = '#fee2e2';
            $status_color = '#dc2626';
            $status_border = '#fecaca';
        } elseif ($is_delivered) {
            $current_status_label = 'Delivered';
            $status_bg = '#d1fae5';
            $status_color = '#059669';
            $status_border = '#a7f3d0';
        } elseif (isset($order) && $order->order_status == 'Shipped') {
            $current_status_label = 'Shipped / In Transit';
            $status_bg = '#e0f2fe';
            $status_color = '#0284c7';
            $status_border = '#bae6fd';
        } elseif ($is_in_progress) {
            $current_status_label = 'Processing & Packed';
            $status_bg = '#f0fdf4';
            $status_color = '#166534';
            $status_border = '#bbf7d0';
        }
    @endphp

    <style>
        .tracking-result-box {
            background: #ffffff;
            border-radius: 20px;
            border: 1px solid #e2e8f0;
            box-shadow: 0 10px 30px -5px rgba(0, 0, 0, 0.06);
            overflow: hidden;
            animation: trackFadeIn 0.3s ease-out;
        }
        @keyframes trackFadeIn {
            from { opacity: 0; transform: translateY(10px); }
            to { opacity: 1; transform: translateY(0); }
        }
        .tracking-header-bar {
            padding: 22px 26px;
            background: #fafbfc;
            border-bottom: 1px solid #f1f5f9;
        }
        .status-pill-badge {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            padding: 6px 14px;
            border-radius: 999px;
            font-size: 13px;
            font-weight: 700;
        }
        .status-pill-dot {
            width: 7px;
            height: 7px;
            min-width: 7px;
            border-radius: 50%;
            background-color: currentColor;
            display: inline-block;
        }
        .timeline-wrapper {
            padding: 30px 26px;
        }
        .v-step {
            display: flex;
            position: relative;
            padding-bottom: 30px;
        }
        .v-step:last-child {
            padding-bottom: 0;
        }
        .v-step-indicator {
            position: relative;
            display: flex;
            flex-direction: column;
            align-items: center;
            margin-right: 20px;
            width: 40px;
            min-width: 40px;
        }
        .v-step-icon {
            width: 40px;
            height: 40px;
            min-width: 40px;
            border-radius: 50%;
            background: #f8fafc;
            color: #94a3b8;
            border: 2px solid #e2e8f0;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 15px;
            z-index: 2;
            transition: all 0.25s ease;
        }
        .v-step.completed .v-step-icon {
            background: #10b981;
            border-color: #10b981;
            color: #ffffff;
            box-shadow: 0 0 0 4px rgba(16, 185, 129, 0.2);
        }
        .v-step.active .v-step-icon {
            background: #ecfdf5;
            border-color: #10b981;
            color: #059669;
            box-shadow: 0 0 0 4px rgba(16, 185, 129, 0.25);
        }
        .v-step-line {
            position: absolute;
            top: 40px;
            bottom: 0;
            left: 19px;
            width: 2px;
            background: #e2e8f0;
            z-index: 1;
        }
        .v-step.completed .v-step-line {
            background: #10b981;
        }
        .v-step-body {
            flex: 1;
            min-width: 0;
            padding-top: 2px;
        }
        .v-step-head {
            display: flex;
            align-items: center;
            justify-content: space-between;
            flex-wrap: wrap;
            gap: 8px;
            margin-bottom: 4px;
        }
        .v-step-title {
            font-size: 15px;
            font-weight: 700;
            color: #0f172a;
            margin: 0;
        }
        .v-step.completed .v-step-title {
            color: #059669;
        }
        .v-step-time {
            font-size: 12.5px;
            font-weight: 600;
            color: #64748b;
        }
        .v-step-desc {
            font-size: 13px;
            color: #64748b;
            line-height: 1.45;
            margin: 0;
        }
        .tracking-meta-grid {
            background: #f8fafc;
            border-top: 1px solid #e2e8f0;
            padding: 20px 24px;
        }
        .meta-stat-item {
            background: #ffffff;
            border: 1px solid #e2e8f0;
            border-radius: 12px;
            padding: 12px 16px;
            height: 100%;
        }
        .meta-stat-label {
            font-size: 11.5px;
            font-weight: 600;
            color: #64748b;
            text-transform: uppercase;
            letter-spacing: 0.03em;
            margin-bottom: 4px;
            display: block;
        }
        .meta-stat-val {
            font-size: 13.5px;
            font-weight: 700;
            color: #0f172a;
            display: block;
        }
        .meta-stat-price {
            font-size: 16px;
            font-weight: 800;
            color: #059669;
        }
    </style>

    <div class="tracking-result-box">
        <!-- Card Header with Order Meta -->
        <div class="tracking-header-bar d-flex flex-wrap align-items-center justify-content-between gap-3">
            <div>
                <span class="text-muted d-block" style="font-size: 11.5px; font-weight: 700; text-transform: uppercase; letter-spacing: 0.05em;">
                    {{ __('Order Tracking Details') }}
                </span>
                <h4 class="mb-0 font-weight-bold" style="font-size: 17px; color: #0f172a;">
                    {{ isset($order) ? $order->transaction_number : request('order_number') }}
                </h4>
            </div>
            <div>
                <div class="status-pill-badge" style="background: {{ $status_bg }}; color: {{ $status_color }}; border: 1px solid {{ $status_border }};">
                    <span class="status-pill-dot"></span>
                    <span>{{ __($current_status_label) }}</span>
                </div>
            </div>
        </div>

        @if ($is_canceled)
            <!-- Canceled State Banner -->
            <div class="p-4">
                <div class="p-4 rounded-xl d-flex align-items-center" style="background: #fef2f2; border: 1px solid #fecaca; border-radius: 14px;">
                    <div class="mr-3" style="width: 44px; height: 44px; min-width: 44px; border-radius: 50%; background: #fee2e2; color: #dc2626; display: flex; align-items: center; justify-content: center; font-size: 20px;">
                        <i class="fas fa-times-circle"></i>
                    </div>
                    <div>
                        <h5 class="mb-1 text-danger font-weight-bold" style="font-size: 15px;">{{ __('This order has been cancelled/rejected') }}</h5>
                        <p class="text-muted mb-0" style="font-size: 13px;">
                            @if ($canceled_track)
                                {{ __('Cancelled on') }} {{ date('l, d M, Y - h:i A', strtotime($canceled_track['created_at'])) }}
                            @else
                                {{ __('Order delivery has been cancelled.') }}
                            @endif
                        </p>
                    </div>
                </div>
            </div>
        @else
            <!-- Modern Responsive Timeline -->
            <div class="timeline-wrapper">
                <!-- Step 1: Order Placed / Pending -->
                <div class="v-step {{ $is_pending ? 'completed' : '' }}">
                    <div class="v-step-indicator">
                        <div class="v-step-icon">
                            <i class="fas fa-check"></i>
                        </div>
                        <div class="v-step-line"></div>
                    </div>
                    <div class="v-step-body">
                        <div class="v-step-head">
                            <h5 class="v-step-title">{{ __('Order Placed') }}</h5>
                            <span class="v-step-time">
                                @if ($pending_track)
                                    {{ date('d M, Y • h:i A', strtotime($pending_track['created_at'])) }}
                                @elseif (isset($order))
                                    {{ date('d M, Y • h:i A', strtotime($order->created_at)) }}
                                @else
                                    {{ __('Completed') }}
                                @endif
                            </span>
                        </div>
                        <p class="v-step-desc">
                            {{ __('Your order has been received and is pending approval.') }}
                        </p>
                    </div>
                </div>

                <!-- Step 2: Processing & Packaging -->
                <div class="v-step {{ $is_in_progress ? 'completed' : ($is_pending && !$is_in_progress ? 'active' : '') }}">
                    <div class="v-step-indicator">
                        <div class="v-step-icon">
                            @if ($is_in_progress)
                                <i class="fas fa-check"></i>
                            @else
                                <i class="fas fa-box-open"></i>
                            @endif
                        </div>
                        <div class="v-step-line"></div>
                    </div>
                    <div class="v-step-body">
                        <div class="v-step-head">
                            <h5 class="v-step-title">{{ __('Processing & Packed') }}</h5>
                            <span class="v-step-time">
                                @if ($progress_track)
                                    {{ date('d M, Y • h:i A', strtotime($progress_track['created_at'])) }}
                                @elseif ($is_in_progress)
                                    {{ __('In Progress') }}
                                @else
                                    {{ __('Expected Soon') }}
                                @endif
                            </span>
                        </div>
                        <p class="v-step-desc">
                            @if ($is_in_progress)
                                {{ __('Your items have been verified and packaged for delivery.') }}
                            @else
                                {{ __('Items will be verified and packed by our fulfillment center.') }}
                            @endif
                        </p>
                    </div>
                </div>

                <!-- Step 3: Out for Delivery / Shipped -->
                <div class="v-step {{ $is_delivered ? 'completed' : ($is_shipped ? 'completed' : ($is_in_progress ? 'active' : '')) }}">
                    <div class="v-step-indicator">
                        <div class="v-step-icon">
                            @if ($is_delivered || $is_shipped)
                                <i class="fas fa-check"></i>
                            @else
                                <i class="fas fa-shipping-fast"></i>
                            @endif
                        </div>
                        <div class="v-step-line"></div>
                    </div>
                    <div class="v-step-body">
                        <div class="v-step-head">
                            <h5 class="v-step-title">{{ __('Shipped / On The Way') }}</h5>
                            <span class="v-step-time">
                                @if ($shipped_track)
                                    {{ date('d M, Y • h:i A', strtotime($shipped_track['created_at'])) }}
                                @elseif ($is_delivered)
                                    {{ __('Completed') }}
                                @elseif ($is_shipped)
                                    {{ __('In Transit') }}
                                @else
                                    {{ __('Expected Soon') }}
                                @endif
                            </span>
                        </div>
                        <p class="v-step-desc">
                            @if ($is_delivered || $is_shipped)
                                {{ __('Your parcel has been dispatched and is on its way to your delivery address.') }}
                            @else
                                {{ __('Courier pickup will be scheduled once packaging is completed.') }}
                            @endif
                        </p>

                        @if(isset($order) && (!empty($order->courier_name) || !empty($order->tracking_number)))
                            <!-- Live Courier Tracking Details Card -->
                            <div class="courier-badge-box mt-3 p-3" style="background: #f0fdf4; border: 1.5px dashed #86efac; border-radius: 12px;">
                                <div class="d-flex flex-wrap align-items-center justify-content-between gap-2">
                                    <div>
                                        @if(!empty($order->courier_name))
                                            <div class="text-dark font-weight-bold" style="font-size: 14px;">
                                                <i class="fas fa-truck text-success mr-1.5"></i> {{ __('Courier Partner:') }} <span class="text-success">{{ $order->courier_name }}</span>
                                            </div>
                                        @endif
                                        @if(!empty($order->tracking_number))
                                            <div class="text-muted small mt-1" style="font-size: 12.5px;">
                                                {{ __('AWB / Tracking Number:') }} <strong class="text-dark" style="font-family: monospace; font-size: 13.5px; background: #ffffff; padding: 2px 8px; border-radius: 6px; border: 1px solid #cbd5e1;">{{ $order->tracking_number }}</strong>
                                            </div>
                                        @endif
                                    </div>
                                    @if(!empty($order->tracking_link))
                                        <div class="mt-2 mt-sm-0">
                                            <a href="{{ $order->tracking_link }}" target="_blank" class="btn btn-sm btn-success px-3 py-2 text-white" style="border-radius: 8px; font-weight: 700; font-size: 12px; box-shadow: 0 3px 8px rgba(16, 185, 129, 0.3); text-decoration: none !important;">
                                                <i class="fas fa-external-link-alt mr-1"></i> {{ __('Track Courier') }}
                                            </a>
                                        </div>
                                    @endif
                                </div>
                            </div>
                        @endif
                    </div>
                </div>

                <!-- Step 4: Delivered -->
                <div class="v-step {{ $is_delivered ? 'completed' : '' }}">
                    <div class="v-step-indicator">
                        <div class="v-step-icon">
                            <i class="fas fa-home"></i>
                        </div>
                    </div>
                    <div class="v-step-body">
                        <div class="v-step-head">
                            <h5 class="v-step-title">{{ __('Delivered') }}</h5>
                            <span class="v-step-time">
                                @if ($delivered_track)
                                    {{ date('d M, Y • h:i A', strtotime($delivered_track['created_at'])) }}
                                @elseif ($is_delivered)
                                    {{ __('Delivered') }}
                                @else
                                    {{ __('Pending Delivery') }}
                                @endif
                            </span>
                        </div>
                        <p class="v-step-desc">
                            @if ($is_delivered)
                                {{ __('Product has been successfully delivered. Enjoy your purchase!') }}
                            @else
                                {{ __('Package will be handed over to you upon arrival.') }}
                            @endif
                        </p>
                    </div>
                </div>
            </div>
        @endif

        @if (isset($order))
            <!-- Order Snapshot Summary 4-Column Responsive Grid -->
            <div class="tracking-meta-grid">
                <div class="row g-3">
                    <div class="col-6 col-md-3 mb-2 mb-md-0">
                        <div class="meta-stat-item">
                            <span class="meta-stat-label">{{ __('Order Date') }}</span>
                            <span class="meta-stat-val">{{ date('d M, Y', strtotime($order->created_at)) }}</span>
                        </div>
                    </div>
                    <div class="col-6 col-md-3 mb-2 mb-md-0">
                        <div class="meta-stat-item">
                            <span class="meta-stat-label">{{ __('Payment Method') }}</span>
                            <span class="meta-stat-val">{{ $order->payment_method ?? 'Online' }}</span>
                        </div>
                    </div>
                    <div class="col-6 col-md-3">
                        <div class="meta-stat-item">
                            <span class="meta-stat-label">{{ __('Payment Status') }}</span>
                            @if ($order->payment_status == 'Paid')
                                <span class="badge badge-success px-2.5 py-1 font-weight-bold" style="border-radius: 6px; font-size: 11.5px;">{{ __('Paid') }}</span>
                            @else
                                <span class="badge badge-warning px-2.5 py-1 font-weight-bold" style="border-radius: 6px; font-size: 11.5px;">{{ __('Unpaid') }}</span>
                            @endif
                        </div>
                    </div>
                    <div class="col-6 col-md-3">
                        <div class="meta-stat-item">
                            <span class="meta-stat-label">{{ __('Total Amount') }}</span>
                            <span class="meta-stat-price">
                                @php
                                    $setting = App\Models\Setting::first();
                                @endphp
                                @if ($setting && $setting->currency_direction == 1)
                                    {{ $order->currency_sign }}{{ PriceHelper::OrderTotal($order) }}
                                @else
                                    {{ PriceHelper::OrderTotal($order) }}{{ $order->currency_sign }}
                                @endif
                            </span>
                        </div>
                    </div>
                </div>
            </div>
        @endif
    </div>
@else
    <!-- Order Not Found State -->
    <div class="order-not-found-card text-center p-5">
        <div class="not-found-icon-box mx-auto mb-3">
            <i class="fas fa-search-minus"></i>
        </div>
        <h4 class="font-weight-bold text-dark mb-2" style="font-size: 18px;">{{ __('Order Not Found') }}</h4>
        <p class="text-muted mb-0 mx-auto" style="max-width: 400px; font-size: 13.5px; line-height: 1.5;">
            {{ __('We could not find any order matching that number. Please verify the order ID from your confirmation email/SMS and try again.') }}
        </p>
    </div>
@endif

