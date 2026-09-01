@extends('master.front')

@section('title')
    {{ __('Shipping') }}
@endsection
@section('content')
    <!-- Page Title-->
    <div class="page-title">
        <div class="container">
            <div class="column">
                <ul class="breadcrumbs">
                    <li><a href="{{ route('front.index') }}">{{ __('Home') }}</a> </li>
                    <li class="separator"></li>
                    <li>{{ __('Shipping address') }}</li>
                </ul>
            </div>
        </div>
    </div>
    <!-- Page Content-->
    <div class="container padding-bottom-3x mb-1  checkut-page">
        <div class="row">
            <!-- Shipping Adress-->
            <div class="col-xl-9 col-lg-8">
                <div class="checkout-steps-bar mb-4">
                    <a class="checkout-step-item" href="{{ route('front.checkout.billing') }}">
                        <i class="icon-check-circle mr-1"></i> <span>1. {{ __('Billing') }}</span>
                    </a>
                    <a class="checkout-step-item active" href="javascript:;">
                        <span>2. {{ __('Shipping') }}</span>
                    </a>
                    <a class="checkout-step-item" href="{{ route('front.checkout.payment') }}">
                        <span>3. {{ __('Review & Pay') }}</span>
                    </a>
                </div>
                <div class="card border-0 shadow-sm checkout-card">
                    <div class="card-body">
                        <h6>{{ __('Shipping Address') }}</h6>

                        @php
                            $saved_ship = Session::get('shipping_address', []);
                            $current_ship_country = old('ship_country', $saved_ship['ship_country'] ?? (isset($user) && $user ? $user->ship_country : ''));
                        @endphp

                        <form id="checkoutShipping" action="{{ route('front.checkout.shipping.store') }}" method="POST">
                            @csrf
                            <div class="row">
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label for="checkout-fn">{{ __('First Name') }}*</label>
                                        <input class="form-control {{ $errors->has('ship_first_name') ? 'requireInput' : '' }}" name="ship_first_name" type="text" id="checkout-fn"
                                            value="{{ old('ship_first_name', $saved_ship['ship_first_name'] ?? (isset($user) && $user ? $user->first_name : '')) }}">
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label for="checkout-ln">{{ __('Last Name') }}*</label>
                                        <input class="form-control {{ $errors->has('ship_last_name') ? 'requireInput' : '' }}" name="ship_last_name" type="text" id="checkout-ln"
                                            value="{{ old('ship_last_name', $saved_ship['ship_last_name'] ?? (isset($user) && $user ? $user->last_name : '')) }}">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label for="checkout-email">{{ __('E-mail Address') }}*</label>
                                        <input class="form-control {{ $errors->has('ship_email') ? 'requireInput' : '' }}" name="ship_email" type="email" id="checkout-email"
                                            value="{{ old('ship_email', $saved_ship['ship_email'] ?? (isset($user) && $user ? $user->email : '')) }}">
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label for="checkout-phone">{{ __('Phone Number') }}*</label>
                                        <input class="form-control {{ $errors->has('ship_phone') ? 'requireInput' : '' }}" name="ship_phone" type="text" id="checkout-phone"
                                            value="{{ old('ship_phone', $saved_ship['ship_phone'] ?? (isset($user) && $user ? $user->phone : '')) }}">
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-sm-12">
                                    <div class="form-group">
                                        <label for="checkout-address1">{{ __('Address') }} *</label>
                                        <input class="form-control {{ $errors->has('ship_address1') ? 'requireInput' : '' }}" name="ship_address1"  type="text"
                                            id="checkout-address1" value="{{ old('ship_address1', $saved_ship['ship_address1'] ?? (isset($user) && $user ? $user->ship_address1 : '')) }}">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label for="checkout-zip">{{ __('Zip Code') }} *</label>
                                        <input class="form-control {{ $errors->has('ship_zip') ? 'requireInput' : '' }}" name="ship_zip" type="text" id="checkout-zip"
                                            value="{{ old('ship_zip', $saved_ship['ship_zip'] ?? (isset($user) && $user ? $user->ship_zip : '')) }}">
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label for="checkout-city">{{ __('City') }} *</label>
                                        <input class="form-control {{ $errors->has('ship_city') ? 'requireInput' : '' }}" name="ship_city" type="text"
                                            id="checkout-city" value="{{ old('ship_city', $saved_ship['ship_city'] ?? (isset($user) && $user ? $user->ship_city : '')) }}">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-12">
                                    <div class="form-group">
                                        <label for="checkout-country">{{ __('Country') }}</label>
                                        <select class="form-control" name="ship_country"  id="billing-country">
                                            <option disabled {{ empty($current_ship_country) ? 'selected' : '' }}>{{ __('Choose Country') }}</option>
                                            @foreach (DB::table('countries')->get() as $country)
                                                <option value="{{ $country->name }}"
                                                    {{ $current_ship_country == $country->name ? 'selected' : '' }}>
                                                    {{ $country->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>


                            <div class="d-flex justify-content-between align-items-center checkout-nav-buttons mt-4 pt-2">
                                <a class="btn btn-outline-secondary checkout-prev-btn" href="{{ route('front.checkout.billing') }}">
                                    <i class="icon-arrow-left mr-1"></i> <span>{{ __('Back') }}</span>
                                </a>
                                <button class="btn btn-primary checkout-next-btn" type="submit">
                                    <span>{{ __('Continue') }}</span> <i class="icon-arrow-right ml-1"></i>
                                </button>
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
