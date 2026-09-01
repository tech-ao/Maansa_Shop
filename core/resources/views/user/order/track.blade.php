@if (!isset($error))
    @php
        $pending_track = null;
        $progress_track = null;
        $delivered_track = null;
        $canceled_track = null;

        if (!empty($track_orders)) {
            foreach ($track_orders as $t) {
                if ($t['title'] == 'Pending') $pending_track = $t;
                if ($t['title'] == 'In Progress') $progress_track = $t;
                if ($t['title'] == 'Delivered') $delivered_track = $t;
                if ($t['title'] == 'Canceled') $canceled_track = $t;
            }
        }

        $is_canceled = !empty($canceled_track) || (isset($order) && $order->order_status == 'Canceled');
        $is_delivered = !empty($delivered_track) || (isset($order) && $order->order_status == 'Delivered');
        $is_in_progress = !empty($progress_track) || (isset($order) && $order->order_status == 'In Progress') || $is_delivered;
        $is_pending = true;

        $current_status_label = 'Pending Approval';
        $current_status_badge_class = 'badge-warning';

        if ($is_canceled) {
            $current_status_label = 'Order Cancelled';
            $current_status_badge_class = 'badge-danger';
        } elseif ($is_delivered) {
            $current_status_label = 'Delivered';
            $current_status_badge_class = 'badge-success';
        } elseif ($is_in_progress) {
            $current_status_label = 'Processing & Shipped';
            $current_status_badge_class = 'badge-info';
        }
    @endphp

    <div class="order-tracking-result-card">
        <!-- Card Header with Order Meta -->
        <div class="tracking-card-header d-flex flex-wrap align-items-center justify-content-between p-3.5 p-md-4 border-bottom">
            <div>
                <span class="text-muted d-block" style="font-size: 11.5px; font-weight: 600; text-transform: uppercase; letter-spacing: 0.04em;">
                    {{ __('Order Tracking Details') }}
                </span>
                <h4 class="mb-0 font-weight-bold tracking-order-id" style="font-size: 16.5px; color: #0f172a;">
                    {{ isset($order) ? $order->transaction_number : request('order_number') }}
                </h4>
            </div>
            <div class="mt-2 mt-sm-0">
                <span class="badge {{ $current_status_badge_class }} px-3 py-1.5" style="border-radius: 999px; font-size: 12.5px; font-weight: 700;">
                    <i class="fa fa-circle mr-1" style="font-size: 8px; vertical-align: middle;"></i>
                    {{ __($current_status_label) }}
                </span>
            </div>
        </div>

        @if ($is_canceled)
            <!-- Canceled State Banner -->
            <div class="p-4">
                <div class="canceled-order-alert p-3.5 rounded d-flex align-items-center">
                    <div class="alert-icon-box mr-3">
                        <i class="fa fa-times-circle text-danger" style="font-size: 28px;"></i>
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
            <div class="p-3.5 p-md-4">
                <div class="tracking-vertical-timeline">
                    <!-- Step 1: Order Placed / Pending -->
                    <div class="timeline-step {{ $is_pending ? 'step-completed' : '' }}">
                        <div class="step-indicator">
                            <div class="step-icon">
                                <i class="fa fa-check"></i>
                            </div>
                            <div class="step-line"></div>
                        </div>
                        <div class="step-content">
                            <div class="d-flex flex-wrap justify-content-between align-items-center mb-1">
                                <h5 class="step-title mb-0 font-weight-bold">{{ __('Order Placed') }}</h5>
                                <span class="step-time text-muted">
                                    @if ($pending_track)
                                        {{ date('d M, Y • h:i A', strtotime($pending_track['created_at'])) }}
                                    @elseif (isset($order))
                                        {{ date('d M, Y • h:i A', strtotime($order->created_at)) }}
                                    @else
                                        {{ __('Completed') }}
                                    @endif
                                </span>
                            </div>
                            <p class="step-desc text-muted mb-0">
                                {{ __('Your order has been received and is pending approval.') }}
                            </p>
                        </div>
                    </div>

                    <!-- Step 2: Processing & Packaging -->
                    <div class="timeline-step {{ $is_in_progress ? 'step-completed' : ($is_pending && !$is_in_progress ? 'step-active' : '') }}">
                        <div class="step-indicator">
                            <div class="step-icon">
                                @if ($is_in_progress)
                                    <i class="fa fa-check"></i>
                                @else
                                    <i class="fa fa-box-open"></i>
                                @endif
                            </div>
                            <div class="step-line"></div>
                        </div>
                        <div class="step-content">
                            <div class="d-flex flex-wrap justify-content-between align-items-center mb-1">
                                <h5 class="step-title mb-0 font-weight-bold">{{ __('Processing & Packed') }}</h5>
                                <span class="step-time text-muted">
                                    @if ($progress_track)
                                        {{ date('d M, Y • h:i A', strtotime($progress_track['created_at'])) }}
                                    @elseif ($is_in_progress)
                                        {{ __('In Progress') }}
                                    @else
                                        {{ __('Expected Soon') }}
                                    @endif
                                </span>
                            </div>
                            <p class="step-desc text-muted mb-0">
                                @if ($is_in_progress)
                                    {{ __('Your items have been verified and packaged for delivery.') }}
                                @else
                                    {{ __('Items will be verified and packed by our fulfillment center.') }}
                                @endif
                            </p>
                        </div>
                    </div>

                    <!-- Step 3: Out for Delivery / Shipped -->
                    <div class="timeline-step {{ $is_delivered ? 'step-completed' : ($is_in_progress && !$is_delivered ? 'step-active' : '') }}">
                        <div class="step-indicator">
                            <div class="step-icon">
                                @if ($is_delivered)
                                    <i class="fa fa-check"></i>
                                @else
                                    <i class="fa fa-truck-fast"></i>
                                @endif
                            </div>
                            <div class="step-line"></div>
                        </div>
                        <div class="step-content">
                            <div class="d-flex flex-wrap justify-content-between align-items-center mb-1">
                                <h5 class="step-title mb-0 font-weight-bold">{{ __('Out For Delivery') }}</h5>
                                <span class="step-time text-muted">
                                    @if ($is_delivered)
                                        {{ __('Completed') }}
                                    @elseif ($is_in_progress)
                                        {{ __('Dispatched') }}
                                    @else
                                        {{ __('Expected Soon') }}
                                    @endif
                                </span>
                            </div>
                            <p class="step-desc text-muted mb-0">
                                @if ($is_delivered || $is_in_progress)
                                    {{ __('Your parcel is on its way to your delivery address.') }}
                                @else
                                    {{ __('Courier pickup will be scheduled upon packaging.') }}
                                @endif
                            </p>
                        </div>
                    </div>

                    <!-- Step 4: Delivered -->
                    <div class="timeline-step {{ $is_delivered ? 'step-completed' : '' }}">
                        <div class="step-indicator">
                            <div class="step-icon">
                                <i class="fa fa-home"></i>
                            </div>
                        </div>
                        <div class="step-content">
                            <div class="d-flex flex-wrap justify-content-between align-items-center mb-1">
                                <h5 class="step-title mb-0 font-weight-bold">{{ __('Delivered') }}</h5>
                                <span class="step-time text-muted">
                                    @if ($delivered_track)
                                        {{ date('d M, Y • h:i A', strtotime($delivered_track['created_at'])) }}
                                    @elseif ($is_delivered)
                                        {{ __('Delivered') }}
                                    @else
                                        {{ __('Pending Delivery') }}
                                    @endif
                                </span>
                            </div>
                            <p class="step-desc text-muted mb-0">
                                @if ($is_delivered)
                                    {{ __('Product has been successfully delivered. Enjoy your purchase!') }}
                                @else
                                    {{ __('Package will be handed over to you upon arrival.') }}
                                @endif
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        @endif

        @if (isset($order))
            <!-- Order Snapshot Summary -->
            <div class="tracking-order-summary-box p-3.5 p-md-4 border-top bg-light" style="border-bottom-left-radius: 16px; border-bottom-right-radius: 16px;">
                <div class="row g-3">
                    <div class="col-6 col-md-3">
                        <span class="text-muted d-block" style="font-size: 11.5px;">{{ __('Order Date') }}</span>
                        <strong class="text-dark" style="font-size: 13px;">{{ date('d M, Y', strtotime($order->created_at)) }}</strong>
                    </div>
                    <div class="col-6 col-md-3">
                        <span class="text-muted d-block" style="font-size: 11.5px;">{{ __('Payment Method') }}</span>
                        <strong class="text-dark" style="font-size: 13px;">{{ $order->payment_method ?? 'Online' }}</strong>
                    </div>
                    <div class="col-6 col-md-3">
                        <span class="text-muted d-block" style="font-size: 11.5px;">{{ __('Payment Status') }}</span>
                        @if ($order->payment_status == 'Paid')
                            <span class="badge badge-success px-2 py-0.5" style="border-radius: 6px; font-size: 11px;">{{ __('Paid') }}</span>
                        @else
                            <span class="badge badge-warning px-2 py-0.5" style="border-radius: 6px; font-size: 11px;">{{ __('Unpaid') }}</span>
                        @endif
                    </div>
                    <div class="col-6 col-md-3">
                        <span class="text-muted d-block" style="font-size: 11.5px;">{{ __('Total Amount') }}</span>
                        <strong class="text-primary font-weight-bold" style="font-size: 14.5px;">{{ PriceHelper::OrderTotal($order) }}</strong>
                    </div>
                </div>
            </div>
        @endif
    </div>
@else
    <!-- Order Not Found State -->
    <div class="order-not-found-card text-center p-5">
        <div class="not-found-icon-box mx-auto mb-3">
            <i class="fa fa-search text-muted" style="font-size: 32px;"></i>
        </div>
        <h4 class="font-weight-bold text-dark mb-2" style="font-size: 17px;">{{ __('Order Not Found') }}</h4>
        <p class="text-muted mb-0 mx-auto" style="max-width: 380px; font-size: 13.5px;">
            {{ __('We could not find any order with that ID. Please check your order number from your email/SMS and try again.') }}
        </p>
    </div>
@endif
