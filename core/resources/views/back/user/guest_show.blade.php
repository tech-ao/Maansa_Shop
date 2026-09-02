@extends('master.back')

@section('content')

<div class="container-fluid">

    <!-- Page Header Banner -->
    <div class="dash-hero-banner mb-4">
        <div class="dash-hero-content">
            <div class="dash-hero-text">
                <h2><i class="fa-solid fa-user-clock mr-2" style="font-size: 22px;"></i> {{ $guest->name() }}</h2>
                <p>{{ __('Guest Customer Profile & Order History') }} &bull; <span class="text-white">{{ $guest->email ?: __('No email provided') }}</span></p>
            </div>
            <div class="dash-hero-actions">
                <a class="btn btn-hero-action btn-hero-primary" href="{{ route('back.user.guest') }}" style="font-size: 13.5px; font-weight: 700; padding: 10px 20px;">
                    <i class="fa-solid fa-chevron-left mr-1"></i> {{ __('Back to Guest Customers') }}
                </a>
            </div>
        </div>
    </div>

    <!-- Quick Stat Badges -->
    <div class="row mb-4">
        <div class="col-md-4 mb-3 mb-md-0">
            <div class="feature-toggle-card" style="margin-bottom: 0;">
                <div class="d-flex align-items-center" style="gap: 16px;">
                    <div class="ticket-user-avatar" style="width: 48px; height: 48px; background: #e0f2fe; color: #0284c7; font-size: 20px;">
                        <i class="fa-solid fa-bag-shopping"></i>
                    </div>
                    <div>
                        <h6 style="font-size: 13px; color: #64748b; margin-bottom: 2px;">{{ __('Total Orders') }}</h6>
                        <span style="font-size: 22px; font-weight: 800; color: #0f172a;">{{ count($orders) }}</span>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-4 mb-3 mb-md-0">
            <div class="feature-toggle-card" style="margin-bottom: 0;">
                <div class="d-flex align-items-center" style="gap: 16px;">
                    <div class="ticket-user-avatar" style="width: 48px; height: 48px; background: #ecfdf5; color: #059669; font-size: 20px;">
                        <i class="fa-solid fa-phone"></i>
                    </div>
                    <div>
                        <h6 style="font-size: 13px; color: #64748b; margin-bottom: 2px;">{{ __('Phone Number') }}</h6>
                        <span style="font-size: 16px; font-weight: 800; color: #0f172a;">{{ $guest->phone ?: __('N/A') }}</span>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="feature-toggle-card" style="margin-bottom: 0;">
                <div class="d-flex align-items-center" style="gap: 16px;">
                    <div class="ticket-user-avatar" style="width: 48px; height: 48px; background: #fef3c7; color: #d97706; font-size: 20px;">
                        <i class="fa-solid fa-calendar-check"></i>
                    </div>
                    <div>
                        <h6 style="font-size: 13px; color: #64748b; margin-bottom: 2px;">{{ __('Last Order Placed') }}</h6>
                        <span style="font-size: 15px; font-weight: 800; color: #0f172a;">
                            {{ $guest->last_order_at ? $guest->last_order_at->format('M d, Y') . ' (' . $guest->last_order_at->diffForHumans() . ')' : ($guest->created_at ? $guest->created_at->format('M d, Y') : __('N/A')) }}
                        </span>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row mb-4">
        <!-- Guest Details Card -->
        <div class="col-lg-6 mb-4 mb-lg-0">
            <div class="card-modern h-100">
                <div class="card-modern-header d-flex justify-content-between align-items-center p-3 border-bottom">
                    <h5 class="mb-0 font-weight-bold" style="font-size: 15px; color: #0f172a;">
                        <i class="fa-solid fa-id-card text-primary mr-2"></i>{{ __('Contact & Billing Details') }}
                    </h5>
                </div>
                <div class="card-modern-body p-4">
                    <table class="table table-bordered mb-0" style="font-size: 13.5px;">
                        <tr>
                            <th width="35%" class="bg-light">{{ __('Full Name') }}</th>
                            <td>{{ $guest->name() }}</td>
                        </tr>
                        <tr>
                            <th class="bg-light">{{ __('Email Address') }}</th>
                            <td>
                                @if($guest->email)
                                    <a href="mailto:{{ $guest->email }}" class="text-primary font-weight-600">
                                        <i class="fa-regular fa-envelope mr-1"></i> {{ $guest->email }}
                                    </a>
                                @else
                                    <span class="text-muted">{{ __('Not Provided') }}</span>
                                @endif
                            </td>
                        </tr>
                        <tr>
                            <th class="bg-light">{{ __('Phone Number') }}</th>
                            <td>
                                @if($guest->phone)
                                    <a href="tel:{{ $guest->phone }}" class="text-dark font-weight-600">
                                        <i class="fa-solid fa-phone text-success mr-1"></i> {{ $guest->phone }}
                                    </a>
                                @else
                                    <span class="text-muted">{{ __('Not Provided') }}</span>
                                @endif
                            </td>
                        </tr>
                        <tr>
                            <th class="bg-light">{{ __('Address') }}</th>
                            <td>
                                {{ $guest->bill_address1 }}
                                @if($guest->bill_address2)
                                    <br>{{ $guest->bill_address2 }}
                                @endif
                            </td>
                        </tr>
                        <tr>
                            <th class="bg-light">{{ __('City / Postal Code') }}</th>
                            <td>{{ $guest->bill_city }}{{ $guest->bill_city && $guest->bill_zip ? ' - ' : '' }}{{ $guest->bill_zip }}</td>
                        </tr>
                        <tr>
                            <th class="bg-light">{{ __('Country') }}</th>
                            <td>{{ $guest->bill_country ?: __('N/A') }}</td>
                        </tr>
                        @if($guest->bill_company)
                        <tr>
                            <th class="bg-light">{{ __('Company') }}</th>
                            <td>{{ $guest->bill_company }}</td>
                        </tr>
                        @endif
                    </table>
                </div>
            </div>
        </div>

        <!-- Quick Contact Actions -->
        <div class="col-lg-6">
            <div class="card-modern h-100">
                <div class="card-modern-header d-flex justify-content-between align-items-center p-3 border-bottom">
                    <h5 class="mb-0 font-weight-bold" style="font-size: 15px; color: #0f172a;">
                        <i class="fa-solid fa-paper-plane text-primary mr-2"></i>{{ __('Quick Customer Reach') }}
                    </h5>
                </div>
                <div class="card-modern-body p-4 d-flex flex-column justify-content-center" style="gap: 14px;">
                    @if($guest->email)
                    <a href="mailto:{{ $guest->email }}" class="btn btn-outline-primary d-flex align-items-center p-3" style="border-radius: 12px; text-decoration: none;">
                        <div class="ticket-user-avatar mr-3" style="background: #e0f2fe; color: #0284c7;">
                            <i class="fa-solid fa-envelope"></i>
                        </div>
                        <div class="text-left">
                            <strong class="d-block text-dark">{{ __('Send Email') }}</strong>
                            <small class="text-muted">{{ $guest->email }}</small>
                        </div>
                    </a>
                    @endif

                    @if($guest->phone)
                    <a href="tel:{{ $guest->phone }}" class="btn btn-outline-success d-flex align-items-center p-3" style="border-radius: 12px; text-decoration: none;">
                        <div class="ticket-user-avatar mr-3" style="background: #ecfdf5; color: #059669;">
                            <i class="fa-solid fa-phone"></i>
                        </div>
                        <div class="text-left">
                            <strong class="d-block text-dark">{{ __('Direct Call') }}</strong>
                            <small class="text-muted">{{ $guest->phone }}</small>
                        </div>
                    </a>

                    @php
                        $cleanPhone = preg_replace('/[^0-9]/', '', $guest->phone);
                    @endphp
                    <a href="https://wa.me/{{ $cleanPhone }}" target="_blank" class="btn btn-outline-info d-flex align-items-center p-3" style="border-radius: 12px; text-decoration: none;">
                        <div class="ticket-user-avatar mr-3" style="background: #dcfce7; color: #16a34a;">
                            <i class="fa-brands fa-whatsapp" style="font-size: 20px;"></i>
                        </div>
                        <div class="text-left">
                            <strong class="d-block text-dark">{{ __('Chat on WhatsApp') }}</strong>
                            <small class="text-muted">{{ $guest->phone }}</small>
                        </div>
                    </a>
                    @endif
                </div>
            </div>
        </div>
    </div>

    <!-- Orders History Table -->
    <div class="card-modern">
        <div class="card-modern-header d-flex justify-content-between align-items-center p-3 border-bottom">
            <h5 class="mb-0 font-weight-bold" style="font-size: 15px; color: #0f172a;">
                <i class="fa-solid fa-clock-rotate-left text-primary mr-2"></i>{{ __('Guest Order History') }} ({{ count($orders) }})
            </h5>
        </div>
        <div class="card-modern-body">
            <div class="table-responsive">
                <table class="table-modern" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>{{ __('Order Number') }}</th>
                            <th>{{ __('Order Date') }}</th>
                            <th>{{ __('Order Status') }}</th>
                            <th>{{ __('Payment Status') }}</th>
                            <th>{{ __('Payment Method') }}</th>
                            <th>{{ __('Total Amount') }}</th>
                            <th class="text-right">{{ __('Action') }}</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($orders as $order)
                        <tr>
                            <td>
                                <a href="{{ route('back.order.invoice', $order->id) }}" class="font-weight-bold text-primary" style="text-decoration: none;">
                                    {{ $order->transaction_number }}
                                </a>
                            </td>
                            <td>
                                <span style="font-size: 13px;">{{ date('d M, Y', strtotime($order->created_at)) }}</span>
                            </td>
                            <td>
                                @if($order->order_status == 'Pending')
                                    <span class="badge badge-warning">{{ __('Pending') }}</span>
                                @elseif($order->order_status == 'In Progress')
                                    <span class="badge badge-info">{{ __('In Progress') }}</span>
                                @elseif($order->order_status == 'Delivered')
                                    <span class="badge badge-success">{{ __('Delivered') }}</span>
                                @elseif($order->order_status == 'Canceled')
                                    <span class="badge badge-danger">{{ __('Canceled') }}</span>
                                @else
                                    <span class="badge badge-secondary">{{ $order->order_status }}</span>
                                @endif
                            </td>
                            <td>
                                @if($order->payment_status == 'Paid')
                                    <span class="badge badge-success">{{ __('Paid') }}</span>
                                @else
                                    <span class="badge badge-warning">{{ __('Unpaid') }}</span>
                                @endif
                            </td>
                            <td>
                                <span style="font-size: 13px;">{{ $order->payment_method ?: 'Online' }}</span>
                            </td>
                            <td>
                                <strong class="text-dark" style="font-size: 14px;">
                                    {{ PriceHelper::OrderTotal($order) }}
                                </strong>
                            </td>
                            <td class="text-right">
                                <a href="{{ route('back.order.invoice', $order->id) }}" class="btn btn-sm btn-primary" title="{{ __('View Invoice & Details') }}" style="border-radius: 8px; font-weight: 600; font-size: 12.5px;">
                                    <i class="fa-solid fa-eye mr-1"></i> {{ __('View') }}
                                </a>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="7" class="text-center py-4 text-muted">
                                <i class="fa-solid fa-inbox mr-1"></i> {{ __('No orders found for this guest customer.') }}
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>

</div>

@endsection
