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
            <!-- Payment Method-->
            <div class="col-xl-8 col-lg-8 mb-4 mb-lg-0">
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
                        <h6 class="pb-2 widget-title2 mt-2">{{ __('Shipping & Delivery') }}</h6>
                        @endif
                        <div class="row">
                            <div class="col-sm-6 mb-3">
                                 @if (PriceHelper::CheckDigital() == true)
                                    @php
                                        $free_shipping = DB::table('shipping_services')->whereStatus(1)->whereIsCondition(1)->first();
                                        $is_free_eligible = ($free_shipping && $cart_total >= $free_shipping->minimum_price);
                                        $selected_shipping_id = isset($shipping) && $shipping ? $shipping->id : ($is_free_eligible ? ($free_shipping ? $free_shipping->id : 1) : (DB::table('shipping_services')->whereStatus(1)->where('id', '!=', 1)->first() ? DB::table('shipping_services')->whereStatus(1)->where('id', '!=', 1)->first()->id : 1));
                                        $selected_service = DB::table('shipping_services')->where('id', $selected_shipping_id)->first();
                                    @endphp

                                    <input type="hidden" name="shipping_id" id="shipping_id_select" value="{{ $selected_shipping_id }}" data-href="{{ route('front.shipping.setup') }}">

                                    <div class="auto-shipping-card p-3 rounded border bg-white shadow-sm d-flex align-items-center justify-content-between">
                                        <div class="d-flex align-items-center gap-2">
                                            <div class="shipping-icon-circle mr-2" style="width: 38px; height: 38px; border-radius: 50%; background: #ecfdf5; color: #10b981; display: inline-flex; align-items: center; justify-content: center; font-size: 16px;">
                                                <i class="fa fa-truck"></i>
                                            </div>
                                            <div>
                                                <span class="d-block font-weight-bold text-dark" style="font-size: 14.5px; line-height: 1.2;">
                                                    {{ $selected_service ? $selected_service->title : __('Delivery') }}
                                                </span>
                                                @if ($is_free_eligible)
                                                    <small class="text-success font-weight-bold d-block mt-1">
                                                        <i class="fa fa-check-circle mr-1"></i> {{ __('Eligible for Free Delivery!') }}
                                                    </small>
                                                @else
                                                    <small class="text-muted d-block mt-1">
                                                        {{ __('Standard shipping charge applied') }}
                                                    </small>
                                                @endif
                                            </div>
                                        </div>
                                        <div>
                                            @if ($is_free_eligible || ($selected_service && $selected_service->price == 0))
                                                <span class="badge badge-success px-3 py-1.5 font-weight-bold" style="font-size: 13px; border-radius: 8px;">{{ __('Free') }}</span>
                                            @elseif ($selected_service)
                                                <span class="badge badge-secondary px-3 py-1.5 font-weight-bold" style="font-size: 13px; border-radius: 8px;">{{ PriceHelper::setCurrencyPrice($selected_service->price) }}</span>
                                            @endif
                                        </div>
                                    </div>

                                    @error('shipping_id')
                                        <p class="text-danger shipping_message mt-1">{{ $message }}</p>
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
                                        $allowed_gateways = ['cod', 'stripe', 'razorpay', 'paypal', 'paytm', 'cashfree'];
                                        $gateways = DB::table('payment_settings')->whereStatus(1)->whereIn('unique_keyword', $allowed_gateways)->get();
                                    @endphp
                                    @foreach ($gateways as $gateway)
                                        @php
                                            $action_route = route('front.checkout.submit');
                                            $pay_method = ucfirst($gateway->unique_keyword);

                                            if ($gateway->unique_keyword == 'razorpay') {
                                                $action_route = route('front.razorpay.submit');
                                                $pay_method = 'Rezorpay';
                                            } elseif ($gateway->unique_keyword == 'cashfree') {
                                                $action_route = route('front.cashfree.submit');
                                                $pay_method = 'Cashfree';
                                            } elseif ($gateway->unique_keyword == 'paytm') {
                                                $action_route = route('front.paytm.submit');
                                                $pay_method = 'Paytm';
                                            } elseif ($gateway->unique_keyword == 'cod') {
                                                $action_route = route('front.checkout.submit');
                                                $pay_method = 'Cash On Delivery';
                                            } elseif ($gateway->unique_keyword == 'stripe') {
                                                $action_route = route('front.checkout.submit');
                                                $pay_method = 'Stripe';
                                            } elseif ($gateway->unique_keyword == 'paypal') {
                                                $action_route = route('front.checkout.submit');
                                                $pay_method = 'Paypal';
                                            }
                                        @endphp

                                        @if (PriceHelper::CheckDigitalPaymentGateway())
                                            @if ($gateway->unique_keyword != 'cod')
                                                <div class="payment-method-tile">
                                                    <form action="{{ $action_route }}" method="POST" class="w-100 h-100 m-0 p-0 direct-pay-form">
                                                        @csrf
                                                        <input type="hidden" name="payment_method" value="{{ $pay_method }}">
                                                        <input type="hidden" name="shipping_id" value="{{ $selected_shipping_id }}" class="shipping_id_setup">
                                                        <input type="hidden" name="state_id" value="{{ auth()->check() && auth()->user()->state_id ? auth()->user()->state_id : '' }}" class="state_id_setup">
                                                        
                                                        <button type="submit" class="payment-method-btn w-100 border-0 bg-transparent text-center p-3" style="cursor: pointer; display: flex; flex-direction: column; align-items: center; justify-content: center; width: 100%; height: 100%; text-decoration: none;" onclick="this.classList.add('disabled'); this.style.pointerEvents='none'; var t = this.querySelector('.gateway-title'); if(t) t.innerHTML='<i class=\'fa fa-spinner fa-spin mr-1\'></i> {{ __('Processing...') }}';">
                                                            <div class="gateway-icon-box">
                                                                <img src="{{ url('/core/public/storage/images/' . $gateway->photo) }}"
                                                                    alt="{{ $gateway->name }}" title="{{ $gateway->name }}">
                                                            </div>
                                                            <p class="gateway-title mb-0">{{ $gateway->name }}</p>
                                                        </button>
                                                    </form>
                                                </div>
                                            @endif
                                        @else
                                            <div class="payment-method-tile">
                                                <form action="{{ $action_route }}" method="POST" class="w-100 h-100 m-0 p-0 direct-pay-form">
                                                    @csrf
                                                    <input type="hidden" name="payment_method" value="{{ $pay_method }}">
                                                    <input type="hidden" name="shipping_id" value="{{ $selected_shipping_id }}" class="shipping_id_setup">
                                                    <input type="hidden" name="state_id" value="{{ auth()->check() && auth()->user()->state_id ? auth()->user()->state_id : '' }}" class="state_id_setup">
                                                    
                                                    <button type="submit" class="payment-method-btn w-100 border-0 bg-transparent text-center p-3" style="cursor: pointer; display: flex; flex-direction: column; align-items: center; justify-content: center; width: 100%; height: 100%; text-decoration: none;" onclick="this.classList.add('disabled'); this.style.pointerEvents='none'; var t = this.querySelector('.gateway-title'); if(t) t.innerHTML='<i class=\'fa fa-spinner fa-spin mr-1\'></i> {{ __('Processing...') }}';">
                                                        <div class="gateway-icon-box">
                                                            <img src="{{ url('/core/public/storage/images/' . $gateway->photo) }}"
                                                                alt="{{ $gateway->name }}" title="{{ $gateway->name }}">
                                                        </div>
                                                        <p class="gateway-title mb-0">{{ $gateway->name }}</p>
                                                    </button>
                                                </form>
                                            </div>
                                        @endif
                                    @endforeach

                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
            <!-- Sidebar  -->
            <div class="col-xl-4 col-lg-4">
                @include('includes.checkout_sitebar',$cart)
            </div>
        </div>
    </div>
@endsection

@section('script')
<script>
    // Sync state changes across all forms on the page
    $(document).on('change', '#state_id_select', function() {
        var stateId = $(this).val();
        $('.state_id_setup').val(stateId);
    });
</script>
@endsection
