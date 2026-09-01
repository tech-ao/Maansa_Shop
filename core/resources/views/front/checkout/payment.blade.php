@extends('master.front')
@section('title')
    {{ __('Payment') }}
@endsection
@section('content')
    <!-- Page Title-->
    <div class="page-title">
        <div class="container">
            <div class="column">
                <ul class="breadcrumbs">
                    <li><a href="{{ route('front.index') }}">{{ __('Home') }}</a> </li>
                    <li class="separator"></li>
                    <li>{{ __('Review your order and pay') }}</li>
                </ul>
            </div>
        </div>
    </div>
    <!-- Page Content-->
    <div class="container padding-bottom-3x mb-1 checkut-page">
        <div class="row">
            <!-- Payment Methode-->
            <div class="col-xl-9 col-lg-8">
                <div class="checkout-steps-bar mb-4">
                    <a class="checkout-step-item" href="{{ route('front.checkout.billing') }}">
                        <i class="icon-check-circle mr-1"></i> <span>1. {{ __('Billing') }}</span>
                    </a>
                    <a class="checkout-step-item" href="{{ route('front.checkout.shipping') }}">
                        <i class="icon-check-circle mr-1"></i> <span>2. {{ __('Shipping') }}</span>
                    </a>
                    <a class="checkout-step-item active" href="{{ route('front.checkout.payment') }}">
                        <span>3. {{ __('Review & Pay') }}</span>
                    </a>
                </div>
                <div class="card border-0 shadow-sm checkout-card">
                    <div class="card-body p-3 p-md-4">
                        <h6 class="pb-2 widget-title2 mb-3">{{ __('Review Your Order') }}</h6>
                        
                        <div class="row g-3 mb-3">
                            <div class="col-sm-6 mb-3">
                                <div class="checkout-address-card p-3">
                                    <h6 class="address-card-title mb-2"><i class="icon-file-text mr-1 text-success"></i> {{ __('Invoice address') }}</h6>
                                    @php
                                        $ship = Session::get('shipping_address');
                                        $bill = Session::get('billing_address');
                                    @endphp
                                    <ul class="list-unstyled mb-0">
                                        <li><span class="text-muted">{{ __('Name') }}: </span><strong>{{ $bill['bill_first_name'] ?? '' }} {{ $bill['bill_last_name'] ?? '' }}</strong></li>
                                        @if (PriceHelper::CheckDigital())
                                            <li><span class="text-muted">{{ __('Address') }}: </span>{{ $bill['bill_address1'] ?? '' }} {{ @$bill['bill_address2'] }}</li>
                                        @endif
                                        <li><span class="text-muted">{{ __('Phone') }}: </span>{{ $bill['bill_phone'] ?? '' }}</li>
                                    </ul>
                                </div>
                            </div>
                            <div class="col-sm-6 mb-3">
                                <div class="checkout-address-card p-3">
                                    <h6 class="address-card-title mb-2"><i class="icon-map-pin mr-1 text-success"></i> {{ __('Shipping address') }}</h6>
                                    <ul class="list-unstyled mb-0">
                                        <li><span class="text-muted">{{ __('Name') }}: </span><strong>{{ $ship['ship_first_name'] ?? '' }} {{ $ship['ship_last_name'] ?? '' }}</strong></li>
                                        @if (PriceHelper::CheckDigital())
                                            <li><span class="text-muted">{{ __('Address') }}: </span>{{ $ship['ship_address1'] ?? '' }} {{ @$ship['ship_address2'] }}</li>
                                        @endif
                                        <li><span class="text-muted">{{ __('Phone') }}: </span>{{ $ship['ship_phone'] ?? '' }}</li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        @if (PriceHelper::CheckDigital() == true)
                        <h6 class="pb-2 widget-title2 mt-2">{{ __('Shipping Options') }}</h6>
                        @endif
                        <div class="row">
                            <div class="col-sm-6 mb-3">
                                 @if (PriceHelper::CheckDigital() == true)
                                    @php
                                        $free_shipping = DB::table('shipping_services')->whereStatus(1)->whereIsCondition(1)->first();
                                        $is_free_eligible = ($free_shipping && $cart_total >= $free_shipping->minimum_price);
                                        $selected_shipping_id = isset($shipping) && $shipping ? $shipping->id : ($is_free_eligible ? ($free_shipping ? $free_shipping->id : 1) : (DB::table('shipping_services')->whereStatus(1)->where('id', '!=', 1)->first() ? DB::table('shipping_services')->whereStatus(1)->where('id', '!=', 1)->first()->id : null));
                                    @endphp

                                    <select name="shipping_id" class="form-control" id="shipping_id_select" required>
                                        @foreach (DB::table('shipping_services')->whereStatus(1)->get() as $service)
                                            @if ($service->id == 1 && $free_shipping && $free_shipping->minimum_price <= $cart_total)
                                                <option value="{{ $service->id }}"
                                                    {{ $selected_shipping_id == $service->id ? 'selected' : '' }}
                                                    data-href="{{ route('front.shipping.setup') }}">{{ $service->title }} ({{ __('Free') }})
                                                </option>
                                            @elseif ($service->id != 1)
                                                <option value="{{ $service->id }}"
                                                    {{ $selected_shipping_id == $service->id ? 'selected' : '' }}
                                                    data-href="{{ route('front.shipping.setup') }}">{{ $service->title }}
                                                    ({{ PriceHelper::setCurrencyPrice($service->price) }})
                                                </option>
                                            @endif
                                        @endforeach
                                    </select>

                                    @if ($is_free_eligible)
                                        <small class="text-success font-weight-bold d-block mt-1"><i class="fa fa-check-circle mr-1"></i> {{ __('Eligible for Free Delivery!') }}</small>
                                    @endif
                                    @error('shipping_id')
                                        <p class="text-danger shipping_message">{{ $message }}</p>
                                    @enderror
                                @endif
                            </div>
                            <div class="col-sm-6 mb-3">
                                @if (PriceHelper::CheckDigital() == true)
                                @if (DB::table('states')->whereStatus(1)->count() > 0)
                                    <select name="state_id" class="form-control" id="state_id_select" required>
                                        <option value="" selected disabled>{{ __('Select Shipping State') }}</option>
                                        @foreach (DB::table('states')->whereStatus(1)->get() as $state)
                                            <option value="{{ $state->id }}"
                                                data-href="{{ route('front.state.setup') }}"
                                                {{ Auth::check() && Auth::user()->state_id == $state->id ? 'selected' : '' }}>
                                                {{ $state->name }}
                                                @if ($state->type == 'fixed')
                                                    ({{ PriceHelper::setCurrencyPrice($state->price) }})
                                                @else
                                                    ({{ $state->price }}%)
                                                @endif

                                            </option>
                                        @endforeach
                                    </select>
                                    <small class="text-primary state_message">{{ __('Please select shipping state') }}</small>
                                    @error('state_id')
                                        <p class="text-danger state_message">{{ $message }}</p>
                                    @enderror
                                @endif
                            @endif
                            </div>
                        </div>
                        <h6 class="pb-2 widget-title2 mt-3">{{ __('Pay With') }}</h6>
                        <div class="row mt-2">
                            <div class="col-12">
                                <div class="payment-methods-grid">
                                    @php
                                        $gateways = DB::table('payment_settings')->whereStatus(1)->get();
                                    @endphp
                                    @foreach ($gateways as $gateway)
                                        @if (PriceHelper::CheckDigitalPaymentGateway())
                                            @if ($gateway->unique_keyword != 'cod')
                                                <div class="payment-method-tile">
                                                    <a class="payment-method-btn" href="#" data-bs-toggle="modal"
                                                        data-bs-target="#{{ $gateway->unique_keyword }}">
                                                        <div class="gateway-icon-box">
                                                            <img src="{{ url('/core/public/storage/images/' . $gateway->photo) }}"
                                                                alt="{{ $gateway->name }}" title="{{ $gateway->name }}">
                                                        </div>
                                                        <p class="gateway-title">{{ $gateway->name }}</p>
                                                    </a>
                                                </div>
                                            @endif
                                        @else
                                            <div class="payment-method-tile">
                                                <a class="payment-method-btn" href="#" data-bs-toggle="modal"
                                                    data-bs-target="#{{ $gateway->unique_keyword }}">
                                                    <div class="gateway-icon-box">
                                                        <img src="{{ url('/core/public/storage/images/' . $gateway->photo) }}"
                                                            alt="{{ $gateway->name }}" title="{{ $gateway->name }}">
                                                    </div>
                                                    <p class="gateway-title">{{ $gateway->name }}</p>
                                                </a>
                                            </div>
                                        @endif
                                    @endforeach

                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                @include('includes.checkout_modal')

            </div>
            <!-- Sidebar  -->
            <div class="col-xl-3 col-lg-4">
                @include('includes.checkout_sitebar',$cart)
            </div>
        </div>
    </div>
@endsection
