@extends('master.front')

@section('title')
    {{ __('Billing') }}
@endsection

@section('content')
    <!-- Page Title-->
    <div class="page-title">
        <div class="container">
            <div class="column">
                <ul class="breadcrumbs">
                    <li><a href="{{ route('front.index') }}">{{ __('Home') }}</a> </li>
                    <li class="separator"></li>
                    <li>{{ __('Billing address') }}</li>
                </ul>
            </div>
        </div>
    </div>

    <!-- Page Content-->
    <div class="container padding-bottom-3x mb-1 checkut-page">
        <div class="row">
            <!-- Billing Adress-->
            <div class="col-xl-9 col-lg-8">
                <div class="checkout-steps-bar mb-4">
                    <a class="checkout-step-item active" href="{{ route('front.checkout.billing') }}">
                        <span>1. {{ __('Billing') }}</span>
                    </a>
                    <a class="checkout-step-item" href="javascript:;">
                        <span>2. {{ __('Shipping') }}</span>
                    </a>
                    <a class="checkout-step-item" href="{{ route('front.checkout.payment') }}">
                        <span>3. {{ __('Review & Pay') }}</span>
                    </a>
                </div>
                <div class="card border-0 shadow-sm checkout-card">
                    <div class="card-body">
                        <h6>{{ __('Billing Address') }}</h6>

                        @php
                            $saved_bill = Session::get('billing_address', []);
                            $current_country = old('bill_country', $saved_bill['bill_country'] ?? (isset($user) && $user ? $user->bill_country : ''));
                            $same_checked = Session::has('billing_address') ? (!empty($saved_bill['same_ship_address'])) : true;
                        @endphp

                        <form id="checkoutBilling" action="{{ route('front.checkout.store') }}" method="POST">
                            @csrf
                            <div class="row">
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label for="checkout-fn">{{ __('First Name') }}*</label>
                                        <input class="form-control {{ $errors->has('bill_first_name') ? 'requireInput' : '' }}" name="bill_first_name" type="text" 
                                            id="checkout-fn" value="{{ old('bill_first_name', $saved_bill['bill_first_name'] ?? (isset($user) && $user ? $user->first_name : '')) }}">
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label for="checkout-ln">{{ __('Last Name') }}*</label>
                                        <input class="form-control {{ $errors->has('bill_last_name') ? 'requireInput' : '' }}" name="bill_last_name" type="text" 
                                            id="checkout-ln" value="{{ old('bill_last_name', $saved_bill['bill_last_name'] ?? (isset($user) && $user ? $user->last_name : '')) }}">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label for="checkout_email_billing">{{ __('E-mail Address') }}*</label>
                                        <input class="form-control {{ $errors->has('bill_email') ? 'requireInput' : '' }}" name="bill_email" type="email" 
                                            id="checkout_email_billing" value="{{ old('bill_email', $saved_bill['bill_email'] ?? (isset($user) && $user ? $user->email : '')) }}">
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label for="checkout-phone">{{ __('Phone Number') }}*</label>
                                        <input class="form-control {{ $errors->has('bill_phone') ? 'requireInput' : '' }}" name="bill_phone" type="text" id="checkout-phone"
                                             value="{{ old('bill_phone', $saved_bill['bill_phone'] ?? (isset($user) && $user ? $user->phone : '')) }}">
                                    </div>
                                </div>
                            </div>
                            @if (PriceHelper::CheckDigital())
                                
                                <div class="row">
                                    <div class="col-sm-12">
                                        <div class="form-group">
                                            <label for="checkout-address1">{{ __('Address') }}*</label>
                                            <input class="form-control {{ $errors->has('bill_address1') ? 'requireInput' : '' }}" name="bill_address1"  type="text"
                                                id="checkout-address1"
                                                value="{{ old('bill_address1', $saved_bill['bill_address1'] ?? (isset($user) && $user ? $user->bill_address1 : '')) }}">
                                        </div>
                                    </div>
                                    
                                </div>
                                <div class="row">
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label for="checkout-zip">{{ __('Zip Code') }}*</label>
                                            <input class="form-control {{ $errors->has('bill_zip') ? 'requireInput' : '' }}" name="bill_zip" type="text" id="checkout-zip"
                                                value="{{ old('bill_zip', $saved_bill['bill_zip'] ?? (isset($user) && $user ? $user->bill_zip : '')) }}">
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label for="checkout-city">{{ __('City') }}*</label>
                                            <input class="form-control {{ $errors->has('bill_city') ? 'requireInput' : '' }}" name="bill_city" type="text" 
                                                id="checkout-city" value="{{ old('bill_city', $saved_bill['bill_city'] ?? (isset($user) && $user ? $user->bill_city : '')) }}">
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-sm-12">
                                        <div class="form-group">
                                            <label for="checkout-country">{{ __('Country') }}</label>
                                            <select class="form-control {{ $errors->has('bill_country') ? 'requireInput' : '' }}"  name="bill_country"
                                                id="billing-country">
                                                <option disabled {{ empty($current_country) ? 'selected' : '' }}>{{ __('Choose Country') }}</option>
                                                @foreach (DB::table('countries')->get() as $country)
                                                    <option value="{{ $country->name }}"
                                                        {{ $current_country == $country->name ? 'selected' : '' }}>
                                                        {{ $country->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            @endif

                            <div class="form-group">
                                <div class="custom-control custom-checkbox">
                                    <input class="custom-control-input" type="checkbox" id="same_address"
                                        name="same_ship_address" {{ $same_checked ? 'checked' : '' }}>
                                    <label class="custom-control-label font-weight-500"
                                        for="same_address">{{ __('Same as billing address') }}</label>
                                </div>
                            </div>

                            @if ($setting->is_privacy_trams == 1)
                                <div class="form-group">
                                    <div class="custom-control custom-checkbox">
                                        <input class="custom-control-input" type="checkbox" id="trams__condition">
                                        <label class="custom-control-label" for="trams__condition">This site is protected
                                            by reCAPTCHA and the <a href="{{ $setting->policy_link }}"
                                                target="_blank">Privacy Policy</a> and <a
                                                href="{{ $setting->terms_link }}" target="_blank">Terms of Service</a>
                                            apply.</label>
                                    </div>
                                </div>
                            @endif

                            <div class="d-flex justify-content-between align-items-center checkout-nav-buttons mt-4 pt-2">
                                <a class="btn btn-outline-secondary checkout-prev-btn" href="{{ route('front.cart') }}">
                                    <i class="icon-arrow-left mr-1"></i> <span>{{ __('Back To Cart') }}</span>
                                </a>
                                @if ($setting->is_privacy_trams == 1)
                                    <button disabled id="continue__button" class="btn btn-primary checkout-next-btn"
                                        type="button"><span>{{ __('Continue') }}</span> <i
                                            class="icon-arrow-right ml-1"></i></button>
                                @else
                                    <button class="btn btn-primary checkout-next-btn" type="submit"><span>{{ __('Continue') }}</span> <i
                                            class="icon-arrow-right ml-1"></i></button>
                                @endif
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <!-- Sidebar  -->
            <div class="col-xl-3 col-lg-4">
                @include('includes.checkout_sitebar', $cart)
            </div>
        </div>
    </div>
@endsection
