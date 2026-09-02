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
            <!-- Shipping Address-->
            <div class="col-xl-8 col-lg-8 mb-4 mb-lg-0">
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
                            $fallback_country = $detected_country ?? 'India';
                            $current_ship_country = old('ship_country', $saved_ship['ship_country'] ?? (isset($user) && $user && $user->ship_country ? $user->ship_country : $fallback_country));
                        @endphp

                        <form id="checkoutShipping" action="{{ route('front.checkout.shipping.store') }}" method="POST" novalidate>
                            @csrf
                            <div class="row">
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label for="checkout-fn">{{ __('First Name') }}*</label>
                                        <input class="form-control {{ $errors->has('ship_first_name') ? 'is-invalid requireInput' : '' }}" name="ship_first_name" type="text" id="checkout-fn"
                                            required value="{{ old('ship_first_name', $saved_ship['ship_first_name'] ?? (isset($user) && $user ? $user->first_name : '')) }}">
                                        @error('ship_first_name')
                                            <small class="text-danger d-block mt-1 font-weight-bold">{{ $message }}</small>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label for="checkout-ln">{{ __('Last Name') }}*</label>
                                        <input class="form-control {{ $errors->has('ship_last_name') ? 'is-invalid requireInput' : '' }}" name="ship_last_name" type="text" id="checkout-ln"
                                            required value="{{ old('ship_last_name', $saved_ship['ship_last_name'] ?? (isset($user) && $user ? $user->last_name : '')) }}">
                                        @error('ship_last_name')
                                            <small class="text-danger d-block mt-1 font-weight-bold">{{ $message }}</small>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label for="checkout-email">{{ __('E-mail Address') }}*</label>
                                        <input class="form-control {{ $errors->has('ship_email') ? 'is-invalid requireInput' : '' }}" name="ship_email" type="email" id="checkout-email"
                                            placeholder="name@example.com" required
                                            pattern="[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}"
                                            value="{{ old('ship_email', $saved_ship['ship_email'] ?? (isset($user) && $user ? $user->email : '')) }}">
                                        @error('ship_email')
                                            <small class="text-danger d-block mt-1 font-weight-bold">{{ $message }}</small>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label for="checkout-phone">{{ __('Phone Number') }}*</label>
                                        <input class="form-control {{ $errors->has('ship_phone') ? 'is-invalid requireInput' : '' }}" name="ship_phone" type="tel" id="checkout-phone"
                                            inputmode="numeric" maxlength="15" placeholder="10-digit mobile number" required
                                            oninput="this.value = this.value.replace(/[^0-9]/g, '')"
                                            onkeypress="return (event.charCode >= 48 && event.charCode <= 57)"
                                            value="{{ old('ship_phone', $saved_ship['ship_phone'] ?? (isset($user) && $user ? $user->phone : '')) }}">
                                        @error('ship_phone')
                                            <small class="text-danger d-block mt-1 font-weight-bold">{{ $message }}</small>
                                        @enderror
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-sm-12">
                                    <div class="form-group">
                                        <label for="checkout-address1">{{ __('Address') }} *</label>
                                        <input class="form-control {{ $errors->has('ship_address1') ? 'is-invalid requireInput' : '' }}" name="ship_address1"  type="text"
                                            id="checkout-address1" required value="{{ old('ship_address1', $saved_ship['ship_address1'] ?? (isset($user) && $user ? $user->ship_address1 : '')) }}">
                                        @error('ship_address1')
                                            <small class="text-danger d-block mt-1 font-weight-bold">{{ $message }}</small>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label for="checkout-zip">{{ __('Zip Code') }} *</label>
                                        <input class="form-control {{ $errors->has('ship_zip') ? 'is-invalid requireInput' : '' }}" name="ship_zip" type="text" id="checkout-zip"
                                            inputmode="numeric" maxlength="10" placeholder="e.g. 600001" required
                                            oninput="this.value = this.value.replace(/[^0-9]/g, '')"
                                            onkeypress="return (event.charCode >= 48 && event.charCode <= 57)"
                                            value="{{ old('ship_zip', $saved_ship['ship_zip'] ?? (isset($user) && $user ? $user->ship_zip : '')) }}">
                                        @error('ship_zip')
                                            <small class="text-danger d-block mt-1 font-weight-bold">{{ $message }}</small>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label for="checkout-city">{{ __('City') }} *</label>
                                        <input class="form-control {{ $errors->has('ship_city') ? 'is-invalid requireInput' : '' }}" name="ship_city" type="text"
                                            id="checkout-city" required value="{{ old('ship_city', $saved_ship['ship_city'] ?? (isset($user) && $user ? $user->ship_city : '')) }}">
                                        @error('ship_city')
                                            <small class="text-danger d-block mt-1 font-weight-bold">{{ $message }}</small>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-12">
                                    <div class="form-group">
                                        <label for="checkout-country">{{ __('Country') }}</label>
                                        <select class="form-control {{ $errors->has('ship_country') ? 'is-invalid requireInput' : '' }}" name="ship_country" id="shipping-country">
                                            <option value="" disabled {{ empty($current_ship_country) ? 'selected' : '' }}>{{ __('Choose Country') }}</option>
                                            @foreach (DB::table('countries')->get() as $country)
                                                <option value="{{ $country->name }}"
                                                    {{ strtolower($current_ship_country) == strtolower($country->name) ? 'selected' : '' }}>
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
            <div class="col-xl-4 col-lg-4">
                @include('includes.checkout_sitebar', $cart)
            </div>
        </div>
    </div>
@endsection

@section('script')
<script>
document.addEventListener("DOMContentLoaded", function() {
    var form = document.getElementById("checkoutShipping");
    var emailInput = document.getElementById("checkout-email");
    var phoneInput = document.getElementById("checkout-phone");
    var zipInput = document.getElementById("checkout-zip");
    var countrySelect = document.getElementById("shipping-country");

    var emailRegex = /^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/;

    // Email live validate
    if (emailInput) {
        function validateEmail() {
            var val = emailInput.value.trim();
            var existingErr = document.getElementById("shipping-email-err");
            if (val.length > 0 && !emailRegex.test(val)) {
                emailInput.classList.add("is-invalid");
                emailInput.classList.add("requireInput");
                if (!existingErr) {
                    var err = document.createElement("small");
                    err.id = "shipping-email-err";
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
                if (!document.getElementById("shipping-email-err")) {
                    var err = document.createElement("small");
                    err.id = "shipping-email-err";
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
