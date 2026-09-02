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
                            $fallback_country = $detected_country ?? 'India';
                            $current_country = old('bill_country', $saved_bill['bill_country'] ?? (isset($user) && $user && $user->bill_country ? $user->bill_country : $fallback_country));
                            $same_checked = Session::has('billing_address') ? (!empty($saved_bill['same_ship_address'])) : true;
                        @endphp

                        <form id="checkoutBilling" action="{{ route('front.checkout.store') }}" method="POST" novalidate>
                            @csrf
                            <div class="row">
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label for="checkout-fn">{{ __('First Name') }}*</label>
                                        <input class="form-control {{ $errors->has('bill_first_name') ? 'is-invalid requireInput' : '' }}" name="bill_first_name" type="text" 
                                            id="checkout-fn" required value="{{ old('bill_first_name', $saved_bill['bill_first_name'] ?? (isset($user) && $user ? $user->first_name : '')) }}">
                                        @error('bill_first_name')
                                            <small class="text-danger d-block mt-1 font-weight-bold">{{ $message }}</small>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label for="checkout-ln">{{ __('Last Name') }}*</label>
                                        <input class="form-control {{ $errors->has('bill_last_name') ? 'is-invalid requireInput' : '' }}" name="bill_last_name" type="text" 
                                            id="checkout-ln" required value="{{ old('bill_last_name', $saved_bill['bill_last_name'] ?? (isset($user) && $user ? $user->last_name : '')) }}">
                                        @error('bill_last_name')
                                            <small class="text-danger d-block mt-1 font-weight-bold">{{ $message }}</small>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label for="checkout_email_billing">{{ __('E-mail Address') }}*</label>
                                        <input class="form-control {{ $errors->has('bill_email') ? 'is-invalid requireInput' : '' }}" name="bill_email" type="email" 
                                            id="checkout_email_billing" placeholder="name@example.com" required
                                            pattern="[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}"
                                            value="{{ old('bill_email', $saved_bill['bill_email'] ?? (isset($user) && $user ? $user->email : '')) }}">
                                        @error('bill_email')
                                            <small class="text-danger d-block mt-1 font-weight-bold">{{ $message }}</small>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label for="checkout-phone">{{ __('Phone Number') }}*</label>
                                        <input class="form-control {{ $errors->has('bill_phone') ? 'is-invalid requireInput' : '' }}" name="bill_phone" type="tel" id="checkout-phone"
                                            inputmode="numeric" maxlength="15" placeholder="10-digit mobile number" required
                                            oninput="this.value = this.value.replace(/[^0-9]/g, '')"
                                            onkeypress="return (event.charCode >= 48 && event.charCode <= 57)"
                                            value="{{ old('bill_phone', $saved_bill['bill_phone'] ?? (isset($user) && $user ? $user->phone : '')) }}">
                                        @error('bill_phone')
                                            <small class="text-danger d-block mt-1 font-weight-bold">{{ $message }}</small>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            @if (PriceHelper::CheckDigital())
                                
                                <div class="row">
                                    <div class="col-sm-12">
                                        <div class="form-group">
                                            <label for="checkout-address1">{{ __('Address') }}*</label>
                                            <input class="form-control {{ $errors->has('bill_address1') ? 'is-invalid requireInput' : '' }}" name="bill_address1"  type="text"
                                                id="checkout-address1" required
                                                value="{{ old('bill_address1', $saved_bill['bill_address1'] ?? (isset($user) && $user ? $user->bill_address1 : '')) }}">
                                            @error('bill_address1')
                                                <small class="text-danger d-block mt-1 font-weight-bold">{{ $message }}</small>
                                            @enderror
                                        </div>
                                    </div>
                                    
                                </div>
                                <div class="row">
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label for="checkout-zip">{{ __('Zip Code') }}*</label>
                                            <input class="form-control {{ $errors->has('bill_zip') ? 'is-invalid requireInput' : '' }}" name="bill_zip" type="text" id="checkout-zip"
                                                inputmode="numeric" maxlength="10" placeholder="e.g. 600001" required
                                                oninput="this.value = this.value.replace(/[^0-9]/g, '')"
                                                onkeypress="return (event.charCode >= 48 && event.charCode <= 57)"
                                                value="{{ old('bill_zip', $saved_bill['bill_zip'] ?? (isset($user) && $user ? $user->bill_zip : '')) }}">
                                            @error('bill_zip')
                                                <small class="text-danger d-block mt-1 font-weight-bold">{{ $message }}</small>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label for="checkout-city">{{ __('City') }}*</label>
                                            <input class="form-control {{ $errors->has('bill_city') ? 'is-invalid requireInput' : '' }}" name="bill_city" type="text" 
                                                id="checkout-city" required value="{{ old('bill_city', $saved_bill['bill_city'] ?? (isset($user) && $user ? $user->bill_city : '')) }}">
                                            @error('bill_city')
                                                <small class="text-danger d-block mt-1 font-weight-bold">{{ $message }}</small>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-sm-12">
                                        <div class="form-group">
                                            <label for="checkout-country">{{ __('Country') }}</label>
                                            <select class="form-control {{ $errors->has('bill_country') ? 'is-invalid requireInput' : '' }}"  name="bill_country"
                                                id="billing-country">
                                                <option value="" disabled {{ empty($current_country) ? 'selected' : '' }}>{{ __('Choose Country') }}</option>
                                                @foreach (DB::table('countries')->get() as $country)
                                                    <option value="{{ $country->name }}"
                                                        {{ strtolower($current_country) == strtolower($country->name) ? 'selected' : '' }}>
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

@section('script')
<script>
document.addEventListener("DOMContentLoaded", function() {
    var form = document.getElementById("checkoutBilling");
    var emailInput = document.getElementById("checkout_email_billing");
    var phoneInput = document.getElementById("checkout-phone");
    var zipInput = document.getElementById("checkout-zip");
    var countrySelect = document.getElementById("billing-country");

    var emailRegex = /^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/;

    // Email live validate
    if (emailInput) {
        function validateEmail() {
            var val = emailInput.value.trim();
            var existingErr = document.getElementById("billing-email-err");
            if (val.length > 0 && !emailRegex.test(val)) {
                emailInput.classList.add("is-invalid");
                emailInput.classList.add("requireInput");
                if (!existingErr) {
                    var err = document.createElement("small");
                    err.id = "billing-email-err";
                    err.className = "text-danger d-block mt-1 font-weight-bold";
                    err.innerText = "Please enter a valid e-mail address (e.g. name@example.com).";
                    emailInput.parentNode.appendChild(err);
                }
                return false;
            } else {
                emailInput.classList.remove("is-invalid");
                emailInput.classList.remove("requireInput");
                if (existingErr) existingErr.remove();
                return true;
            }
        }
        emailInput.addEventListener("blur", validateEmail);
        emailInput.addEventListener("input", function() {
            if (emailInput.classList.contains("is-invalid")) {
                validateEmail();
            }
        });
    }

    // Phone numbers only
    if (phoneInput) {
        phoneInput.addEventListener("input", function() {
            this.value = this.value.replace(/[^0-9]/g, '');
        });
    }

    // Zip numbers only
    if (zipInput) {
        zipInput.addEventListener("input", function() {
            this.value = this.value.replace(/[^0-9]/g, '');
        });
    }

    // Client-side GeoIP auto-fill fallback if country select has no selected country
    if (countrySelect && (!countrySelect.value || countrySelect.selectedIndex <= 0)) {
        fetch('https://ipapi.co/json/')
            .then(function(res) { return res.json(); })
            .then(function(data) {
                if (data && data.country_name) {
                    for (var i = 0; i < countrySelect.options.length; i++) {
                        if (countrySelect.options[i].text.toLowerCase() === data.country_name.toLowerCase()) {
                            countrySelect.selectedIndex = i;
                            break;
                        }
                    }
                }
            })
            .catch(function() {});
    }

    // Form submit validation check
    if (form) {
        form.addEventListener("submit", function(e) {
            if (emailInput && !emailRegex.test(emailInput.value.trim())) {
                e.preventDefault();
                emailInput.focus();
                emailInput.classList.add("is-invalid");
                emailInput.classList.add("requireInput");
                if (!document.getElementById("billing-email-err")) {
                    var err = document.createElement("small");
                    err.id = "billing-email-err";
                    err.className = "text-danger d-block mt-1 font-weight-bold";
                    err.innerText = "Please enter a valid e-mail address (e.g. name@example.com).";
                    emailInput.parentNode.appendChild(err);
                }
                return false;
            }

            if (phoneInput && (phoneInput.value.trim().length < 10 || !/^[0-9]+$/.test(phoneInput.value.trim()))) {
                e.preventDefault();
                phoneInput.focus();
                phoneInput.classList.add("is-invalid");
                phoneInput.classList.add("requireInput");
                return false;
            }
        });
    }
});
</script>
@endsection
