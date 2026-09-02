@extends('master.back')

@section('content')

<!-- Start of Main Content -->
<div class="container-fluid">

    <!-- Page Header Banner -->
    <div class="dash-hero-banner mb-4">
        <div class="dash-hero-content">
            <div class="dash-hero-text">
                <h2><i class="fa-solid fa-user-clock mr-2" style="font-size: 22px;"></i> {{ __('Guest Customers') }}</h2>
                <p>{{ __('Review guest customer contact details, phone numbers, emails, and order histories from non-registered checkouts.') }}</p>
            </div>
        </div>
    </div>

    <!-- Quick Stat Cards -->
    <div class="row mb-4">
        <div class="col-md-6 mb-3 mb-md-0">
            <div class="feature-toggle-card" style="margin-bottom: 0;">
                <div class="d-flex align-items-center" style="gap: 16px;">
                    <div class="ticket-user-avatar" style="width: 48px; height: 48px; background: #e0f2fe; color: #0284c7; font-size: 20px;">
                        <i class="fa-solid fa-user-tag"></i>
                    </div>
                    <div>
                        <h6 style="font-size: 13px; color: #64748b; margin-bottom: 2px;">{{ __('Total Guest Customers') }}</h6>
                        <span style="font-size: 22px; font-weight: 800; color: #0f172a;">{{ $totalGuestCount ?? count($datas) }}</span>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-6">
            <div class="feature-toggle-card" style="margin-bottom: 0;">
                <div class="d-flex align-items-center" style="gap: 16px;">
                    <div class="ticket-user-avatar" style="width: 48px; height: 48px; background: #ecfdf5; color: #059669; font-size: 20px;">
                        <i class="fa-solid fa-bag-shopping"></i>
                    </div>
                    <div>
                        <h6 style="font-size: 13px; color: #64748b; margin-bottom: 2px;">{{ __('Total Guest Orders Placed') }}</h6>
                        <span style="font-size: 22px; font-weight: 800; color: #0f172a;">{{ $totalGuestOrders ?? 0 }}</span>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- DataTales -->
    <div class="card-modern">
        <div class="card-modern-body">
            @include('alerts.alerts')
            <div class="table-responsive">
                <table class="table-modern" id="admin-table" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th width="25%">{{ __('Customer Name') }}</th>
                            <th width="25%">{{ __('Email Address') }}</th>
                            <th width="20%">{{ __('Mobile / Phone') }}</th>
                            <th width="15%">{{ __('Location') }}</th>
                            <th width="15%" class="text-right">{{ __('Actions') }}</th>
                        </tr>
                    </thead>

                    <tbody>
                        @foreach($datas as $data)
                        <tr>
                            <td>
                                <div class="d-flex align-items-center" style="gap: 12px;">
                                    <div class="ticket-user-avatar" style="background: #f1f5f9; color: #64748b;">
                                        <i class="fa-solid fa-user-clock"></i>
                                    </div>
                                    <div>
                                        <a href="javascript:;" data-toggle="modal" data-target="#guestModal-{{ $data->id }}" class="ticket-user-name" style="text-decoration: none;">
                                            {{ $data->name() }}
                                        </a>
                                        <span class="ticket-user-email">
                                            <i class="fa-regular fa-clock mr-1"></i> {{ $data->created_at ? $data->created_at->diffForHumans() : __('N/A') }}
                                        </span>
                                    </div>
                                </div>
                            </td>

                            <td>
                                @if($data->email)
                                    <a href="mailto:{{ $data->email }}" class="text-dark font-weight-600" style="font-size: 13.5px; text-decoration: none;">
                                        <i class="fa-regular fa-envelope text-primary mr-1"></i> {{ $data->email }}
                                    </a>
                                @else
                                    <span class="text-muted" style="font-size: 12.5px;">{{ __('Not Provided') }}</span>
                                @endif
                            </td>

                            <td>
                                @if($data->phone)
                                    <a href="tel:{{ $data->phone }}" class="text-muted font-weight-600" style="font-size: 13.5px; text-decoration: none;">
                                        <i class="fa-solid fa-phone text-success mr-1"></i> {{ $data->phone }}
                                    </a>
                                @else
                                    <span class="text-muted" style="font-size: 12.5px;">{{ __('Not Provided') }}</span>
                                @endif
                            </td>

                            <td>
                                @if($data->bill_city || $data->bill_country)
                                    <span class="text-dark" style="font-size: 13px;">
                                        <i class="fa-solid fa-location-dot text-danger mr-1"></i>
                                        {{ $data->bill_city }}{{ $data->bill_city && $data->bill_country ? ', ' : '' }}{{ $data->bill_country }}
                                    </span>
                                @else
                                    <span class="text-muted" style="font-size: 12px;">{{ __('N/A') }}</span>
                                @endif
                            </td>

                            <td class="text-right">
                                <div class="action-btn-group justify-content-end">
                                    <a class="btn-action-icon btn-action-view" href="javascript:;" data-toggle="modal" data-target="#guestModal-{{ $data->id }}" title="{{ __('View Purchased Products & Orders') }}">
                                        <i class="fa-solid fa-eye"></i>
                                    </a>
                                    <a class="btn-action-icon btn-action-delete" data-toggle="modal" data-target="#confirm-delete" href="javascript:;" data-href="{{ route('back.user.guest.destroy', $data->id) }}" title="{{ __('Delete') }}">
                                        <i class="fa-solid fa-trash-can"></i>
                                    </a>
                                </div>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

</div>


{{-- GUEST CUSTOMER DETAILS POP-UP MODALS --}}
@foreach($datas as $data)
<div class="modal fade" id="guestModal-{{ $data->id }}" tabindex="-1" role="dialog" aria-labelledby="guestModalLabel-{{ $data->id }}" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
        <div class="modal-content" style="border-radius: 16px; border: none; box-shadow: 0 10px 40px rgba(0,0,0,0.15); overflow: hidden;">
            
            <!-- Modal Header -->
            <div class="modal-header" style="background: linear-gradient(135deg, #0f172a 0%, #1e293b 100%); color: #ffffff; padding: 18px 24px;">
                <div class="d-flex align-items-center" style="gap: 12px;">
                    <div class="ticket-user-avatar" style="width: 44px; height: 44px; background: rgba(255,255,255,0.15); color: #38bdf8; font-size: 18px;">
                        <i class="fa-solid fa-user-clock"></i>
                    </div>
                    <div>
                        <h5 class="modal-title font-weight-bold mb-0" id="guestModalLabel-{{ $data->id }}" style="font-size: 17px; color: #ffffff;">
                            {{ $data->name() }} <span class="badge badge-info ml-1" style="font-size: 11px; font-weight: 600;">{{ __('Guest Customer') }}</span>
                        </h5>
                        <span style="font-size: 12.5px; color: #94a3b8;">
                            @if($data->email)<i class="fa-regular fa-envelope mr-1"></i> {{ $data->email }}@endif
                            @if($data->email && $data->phone) &bull; @endif
                            @if($data->phone)<i class="fa-solid fa-phone mr-1"></i> {{ $data->phone }}@endif
                        </span>
                    </div>
                </div>
                <button class="close text-white" type="button" data-dismiss="modal" aria-label="Close" style="opacity: 0.8; outline: none; font-size: 24px;">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <!-- Modal Body -->
            <div class="modal-body p-4" style="background: #f8fafc; max-height: 75vh; overflow-y: auto;">
                @php
                    $guestOrders = $data->getOrders();
                @endphp

                @forelse($guestOrders as $order)
                    @php
                        $cart = json_decode($order->cart, true) ?: [];
                        $discount = json_decode($order->discount, true);
                        $shipping = json_decode($order->shipping, true);
                    @endphp

                    <div class="card mb-3 shadow-sm" style="border-radius: 12px; border: 1px solid #e2e8f0; overflow: hidden; background: #ffffff;">
                        <!-- Order Header Bar -->
                        <div class="card-header d-flex flex-wrap align-items-center justify-content-between p-3" style="background: #f1f5f9; border-bottom: 1px solid #e2e8f0;">
                            <div>
                                <strong class="text-dark" style="font-size: 14.5px;">#{{ $order->transaction_number }}</strong>
                                <span class="text-muted ml-2" style="font-size: 12.5px;">
                                    <i class="fa-regular fa-calendar-days mr-1"></i> {{ date('d M, Y - h:i A', strtotime($order->created_at)) }}
                                </span>
                            </div>
                            <div class="mt-2 mt-sm-0" style="display: flex; gap: 6px; align-items: center;">
                                @if($order->order_status == 'Pending')
                                    <span class="badge badge-warning font-weight-bold px-2 py-1">{{ __('Pending') }}</span>
                                @elseif($order->order_status == 'In Progress')
                                    <span class="badge badge-info font-weight-bold px-2 py-1">{{ __('In Progress') }}</span>
                                @elseif($order->order_status == 'Delivered')
                                    <span class="badge badge-success font-weight-bold px-2 py-1">{{ __('Delivered') }}</span>
                                @elseif($order->order_status == 'Canceled')
                                    <span class="badge badge-danger font-weight-bold px-2 py-1">{{ __('Canceled') }}</span>
                                @else
                                    <span class="badge badge-secondary font-weight-bold px-2 py-1">{{ $order->order_status }}</span>
                                @endif

                                @if($order->payment_status == 'Paid')
                                    <span class="badge badge-success font-weight-bold px-2 py-1">{{ __('Paid') }}</span>
                                @else
                                    <span class="badge badge-warning font-weight-bold px-2 py-1">{{ __('Unpaid') }}</span>
                                @endif
                            </div>
                        </div>

                        <div class="card-body p-3">
                            <!-- Purchased Products Table -->
                            <h6 class="font-weight-bold text-dark mb-2" style="font-size: 13.5px;">
                                <i class="fa-solid fa-boxes-stacked text-primary mr-1"></i> {{ __('Purchased Products') }} ({{ count($cart) }})
                            </h6>
                            <div class="table-responsive mb-3">
                                <table class="table table-sm table-bordered mb-0" style="font-size: 13px;">
                                    <thead class="bg-light">
                                        <tr>
                                            <th>{{ __('Product') }}</th>
                                            <th>{{ __('Options / Attributes') }}</th>
                                            <th class="text-center">{{ __('Qty') }}</th>
                                            <th class="text-right">{{ __('Price') }}</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($cart as $item)
                                        <tr>
                                            <td>
                                                <div class="d-flex align-items-center" style="gap: 10px;">
                                                    @if(!empty($item['photo']))
                                                        <img src="{{ url('/core/public/storage/images/' . $item['photo']) }}" alt="{{ $item['name'] }}" style="width: 38px; height: 38px; object-fit: cover; border-radius: 6px; border: 1px solid #e2e8f0;">
                                                    @endif
                                                    <span class="font-weight-600 text-dark">{{ $item['name'] }}</span>
                                                </div>
                                            </td>
                                            <td>
                                                @if(isset($item['attribute']['option_name']) && $item['attribute']['option_name'])
                                                    @foreach ($item['attribute']['option_name'] as $optionkey => $option_name)
                                                        <span class="badge badge-light border text-muted mr-1">
                                                            {{ $option_name }}@if(!empty($item['attribute']['option_price'][$optionkey])): {{ $order->currency_sign }}{{ $item['attribute']['option_price'][$optionkey] }}@endif
                                                        </span>
                                                    @endforeach
                                                @else
                                                    <span class="text-muted">--</span>
                                                @endif
                                            </td>
                                            <td class="text-center font-weight-bold">{{ $item['qty'] }}</td>
                                            <td class="text-right font-weight-bold text-dark">
                                                {{ $order->currency_sign }}{{ round(($item['main_price'] + ($item['attribute_price'] ?? 0)) * $item['qty'] * $order->currency_value, 2) }}
                                            </td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>

                            <!-- Promo Code & Total Amount Box -->
                            <div class="row pt-2 border-top align-items-center">
                                <div class="col-md-6 mb-2 mb-md-0">
                                    @if(!empty($discount))
                                        <div class="p-2 rounded d-flex align-items-center justify-content-between" style="background: #ecfdf5; border: 1px solid #a7f3d0; font-size: 13px;">
                                            <span>
                                                <i class="fa-solid fa-tag mr-1 text-success"></i> {{ __('Promo Code:') }}
                                                <strong class="text-success">{{ $discount['code']['code_name'] ?? $discount['code_name'] ?? ($discount['code'] ?? 'COUPON') }}</strong>
                                            </span>
                                            <strong class="text-danger">
                                                -{{ $order->currency_sign }}{{ round($discount['discount'] * $order->currency_value, 2) }}
                                            </strong>
                                        </div>
                                    @else
                                        <div class="p-2 rounded text-muted" style="background: #f8fafc; border: 1px dashed #cbd5e1; font-size: 12.5px;">
                                            <i class="fa-solid fa-tag mr-1 text-muted"></i> {{ __('No promo code used') }}
                                        </div>
                                    @endif
                                </div>

                                <div class="col-md-6 text-md-right">
                                    <div class="d-inline-block text-right">
                                        <span class="text-muted d-block" style="font-size: 12px;">{{ __('Total Amount Paid / Due') }}</span>
                                        <span class="font-weight-800 text-primary" style="font-size: 18px; letter-spacing: -0.01em;">
                                            {{ PriceHelper::OrderTotal($order) }}
                                        </span>
                                        <small class="text-muted d-block" style="font-size: 11px;">({{ $order->payment_method ?: 'Online' }})</small>
                                    </div>
                                </div>
                            </div>

                            <div class="mt-2 text-right">
                                <a href="{{ route('back.order.invoice', $order->id) }}" target="_blank" class="btn btn-sm btn-outline-secondary" style="border-radius: 8px; font-size: 12px;">
                                    <i class="fa-solid fa-file-invoice mr-1"></i> {{ __('View Full Invoice') }}
                                </a>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="text-center py-5 text-muted">
                        <i class="fa-solid fa-box-open mb-2" style="font-size: 36px; color: #cbd5e1;"></i>
                        <p class="mb-0">{{ __('No orders found for this guest customer.') }}</p>
                    </div>
                @endforelse
            </div>

            <!-- Modal Footer -->
            <div class="modal-footer p-3" style="background: #f1f5f9; border-top: 1px solid #e2e8f0;">
                <button type="button" class="btn btn-secondary px-4 font-weight-bold" data-dismiss="modal" style="border-radius: 8px;">
                    {{ __('Close') }}
                </button>
            </div>

        </div>
    </div>
</div>
@endforeach


{{-- DELETE MODAL --}}
<div class="modal fade" id="confirm-delete" tabindex="-1" role="dialog" aria-labelledby="confirm-deleteModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">

        <!-- Modal Header -->
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">{{ __('Confirm Delete?') }}</h5>
          <button class="close" type="button" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
          </button>
        </div>

        <!-- Modal Body -->
        <div class="modal-body">
            {{ __('Are you sure you want to delete this guest customer record?') }}
        </div>

        <!-- Modal footer -->
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">{{ __('Cancel') }}</button>
            <form action="" class="d-inline btn-ok" method="POST">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-danger">{{ __('Delete') }}</button>
            </form>
        </div>

      </div>
    </div>
</div>
{{-- DELETE MODAL ENDS --}}

@endsection
