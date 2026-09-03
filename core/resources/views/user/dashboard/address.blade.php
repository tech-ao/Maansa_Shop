@extends('master.front')
@section('title')
    {{__('Address Settings')}}
@endsection
@section('content')

<!-- Page Title-->
<div class="page-title">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <ul class="breadcrumbs">
                    <li><a href="{{route('front.index')}}">{{__('Home')}}</a> </li>
                    <li class="separator"></li>
                    <li>{{__('My Account')}}</li>
                    <li class="separator"></li>
                    <li>{{__('Addresses')}}</li>
                </ul>
            </div>
        </div>
    </div>
</div>

<!-- Page Content-->
<div class="container padding-bottom-3x mb-1">
    <div class="row">
        @include('includes.user_sitebar')
        
        <div class="col-lg-8">
            <div class="padding-top-2x mt-2 hidden-lg-up"></div>

            <!-- Billing Address Card -->
            <div class="card modern-address-card border-0 shadow-sm rounded-4 mb-4">
                <div class="card-header bg-white px-4 py-3 border-bottom d-flex align-items-center justify-content-between">
                    <div>
                        <h4 class="mb-1 text-dark fw-bold fs-5">
                            <i class="icon-file-text text-success mr-2"></i>{{ __('Billing Address') }}
                        </h4>
                        <p class="mb-0 text-muted small">
                            {{ __('Your primary invoice and billing details.') }}
                        </p>
                    </div>
                </div>

                <div class="card-body p-4">
                    <form id="billingForm" action="{{route('user.billing.submit')}}" method="POST">
                        @csrf
                        <div class="row g-3">
                            <!-- Address 1 -->
                            <div class="col-md-6 mb-3">
                                <label for="billing-address1" class="form-label-custom">{{__('Address Line 1')}} <span class="text-danger">*</span></label>
                                <div class="input-icon-wrapper">
                                    <i class="icon-map-pin input-icon"></i>
                                    <input class="form-control custom-input" type="text" name="bill_address1" id="billing-address1" value="{{$user->bill_address1}}" placeholder="{{ __('Street address, P.O. box') }}" required>
                                </div>
                                @error('bill_address1')
                                    <p class="text-danger small mt-1 mb-0">{{$message}}</p>
                                @enderror
                            </div>

                            <!-- Address 2 -->
                            <div class="col-md-6 mb-3">
                                <label for="billing-address2" class="form-label-custom">{{__('Address Line 2')}} <span class="text-muted fw-normal">({{ __('Optional') }})</span></label>
                                <div class="input-icon-wrapper">
                                    <i class="icon-home input-icon"></i>
                                    <input class="form-control custom-input" type="text" name="bill_address2" value="{{$user->bill_address2}}" id="billing-address2" placeholder="{{ __('Apartment, suite, unit, building, floor') }}">
                                </div>
                                @error('bill_address2')
                                    <p class="text-danger small mt-1 mb-0">{{$message}}</p>
                                @enderror
                            </div>

                            <!-- Zip Code -->
                            <div class="col-md-6 mb-3">
                                <label for="billing-zip" class="form-label-custom">{{__('Zip / Postal Code')}}</label>
                                <div class="input-icon-wrapper">
                                    <i class="icon-hash input-icon"></i>
                                    <input class="form-control custom-input" type="text" name="bill_zip" id="billing-zip" value="{{$user->bill_zip}}" placeholder="{{ __('Postal Code') }}">
                                </div>
                                @error('bill_zip')
                                    <p class="text-danger small mt-1 mb-0">{{$message}}</p>
                                @enderror
                            </div>

                            <!-- City -->
                            <div class="col-md-6 mb-3">
                                <label for="billing-city" class="form-label-custom">{{__('City')}} <span class="text-danger">*</span></label>
                                <div class="input-icon-wrapper">
                                    <i class="icon-navigation input-icon"></i>
                                    <input class="form-control custom-input" type="text" name="bill_city" id="billing-city" value="{{$user->bill_city}}" placeholder="{{ __('City') }}" required>
                                </div>
                                @error('bill_city')
                                    <p class="text-danger small mt-1 mb-0">{{$message}}</p>
                                @enderror
                            </div>

                            <!-- Company -->
                            <div class="col-md-6 mb-3">
                                <label for="billing-company" class="form-label-custom">{{__('Company')}} <span class="text-muted fw-normal">({{ __('Optional') }})</span></label>
                                <div class="input-icon-wrapper">
                                    <i class="icon-briefcase input-icon"></i>
                                    <input class="form-control custom-input" type="text" name="bill_company" id="billing-company" value="{{$user->bill_company}}" placeholder="{{ __('Company Name') }}">
                                </div>
                                @error('bill_company')
                                    <p class="text-danger small mt-1 mb-0">{{$message}}</p>
                                @enderror
                            </div>

                            <!-- Country -->
                            <div class="col-md-6 mb-3">
                                <label for="billing-country" class="form-label-custom">{{__('Country')}}</label>
                                <div class="input-icon-wrapper">
                                    <i class="icon-globe input-icon"></i>
                                    <select class="form-control custom-input custom-select-input" name="bill_country" id="billing-country">
                                        <option value="">{{__('Choose Country')}}</option>
                                        @foreach (DB::table('countries')->get() as $country)
                                            <option value="{{$country->name}}" {{$user->bill_country == $country->name ? 'selected' :''}} >{{$country->name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                                @error('bill_country')
                                    <p class="text-danger small mt-1 mb-0">{{$message}}</p>
                                @enderror
                            </div>
                        </div>

                        <div class="d-flex justify-content-end pt-3 border-top mt-2">
                            <button class="btn btn-save-profile px-4 py-2" type="submit">
                                <i class="icon-check mr-2"></i> <span>{{__('Update Billing Address')}}</span>
                            </button>
                        </div>
                    </form>
                </div>
            </div>

            <!-- Shipping Address Card -->
            <div class="card modern-address-card border-0 shadow-sm rounded-4">
                <div class="card-header bg-white px-4 py-3 border-bottom d-flex align-items-center justify-content-between">
                    <div>
                        <h4 class="mb-1 text-dark fw-bold fs-5">
                            <i class="icon-truck text-success mr-2"></i>{{ __('Shipping Address') }}
                        </h4>
                        <p class="mb-0 text-muted small">
                            {{ __('Your destination address for product deliveries.') }}
                        </p>
                    </div>
                </div>

                <div class="card-body p-4">
                    <form id="shippingForm" action="{{route('user.shipping.submit')}}" method="POST">
                        @csrf
                        <div class="row g-3">
                            <!-- Shipping Address 1 -->
                            <div class="col-md-6 mb-3">
                                <label for="shipping-address1" class="form-label-custom">{{__('Address Line 1')}} <span class="text-danger">*</span></label>
                                <div class="input-icon-wrapper">
                                    <i class="icon-map-pin input-icon"></i>
                                    <input class="form-control custom-input" name="ship_address1" value="{{$user->ship_address1}}" type="text" id="shipping-address1" placeholder="{{ __('Street address, P.O. box') }}" required>
                                </div>
                                @error('ship_address1')
                                    <p class="text-danger small mt-1 mb-0">{{$message}}</p>
                                @enderror
                            </div>

                            <!-- Shipping Address 2 -->
                            <div class="col-md-6 mb-3">
                                <label for="shipping-address2" class="form-label-custom">{{__('Address Line 2')}} <span class="text-muted fw-normal">({{ __('Optional') }})</span></label>
                                <div class="input-icon-wrapper">
                                    <i class="icon-home input-icon"></i>
                                    <input class="form-control custom-input" value="{{$user->ship_address2}}" name="ship_address2" type="text" id="shipping-address2" placeholder="{{ __('Apartment, suite, unit, building, floor') }}">
                                </div>
                                @error('ship_address2')
                                    <p class="text-danger small mt-1 mb-0">{{$message}}</p>
                                @enderror
                            </div>

                            <!-- Shipping Zip -->
                            <div class="col-md-6 mb-3">
                                <label for="shipping-zip" class="form-label-custom">{{__('Zip / Postal Code')}}</label>
                                <div class="input-icon-wrapper">
                                    <i class="icon-hash input-icon"></i>
                                    <input class="form-control custom-input" type="text" value="{{$user->ship_zip}}" name="ship_zip" id="shipping-zip" placeholder="{{ __('Postal Code') }}">
                                </div>
                                @error('ship_zip')
                                    <p class="text-danger small mt-1 mb-0">{{$message}}</p>
                                @enderror
                            </div>

                            <!-- Shipping City -->
                            <div class="col-md-6 mb-3">
                                <label for="shippingcity" class="form-label-custom">{{__('City')}} <span class="text-danger">*</span></label>
                                <div class="input-icon-wrapper">
                                    <i class="icon-navigation input-icon"></i>
                                    <input class="form-control custom-input" type="text" name="ship_city" id="shippingcity" value="{{$user->ship_city}}" placeholder="{{ __('City') }}" required>
                                </div>
                                @error('ship_city')
                                    <p class="text-danger small mt-1 mb-0">{{$message}}</p>
                                @enderror
                            </div>

                            <!-- Shipping Company -->
                            <div class="col-md-6 mb-3">
                                <label for="shipping-company" class="form-label-custom">{{__('Company')}} <span class="text-muted fw-normal">({{ __('Optional') }})</span></label>
                                <div class="input-icon-wrapper">
                                    <i class="icon-briefcase input-icon"></i>
                                    <input class="form-control custom-input" type="text" name="ship_company" id="shipping-company" value="{{$user->ship_company}}" placeholder="{{ __('Company Name') }}">
                                </div>
                                @error('ship_company')
                                    <p class="text-danger small mt-1 mb-0">{{$message}}</p>
                                @enderror
                            </div>

                            <!-- State (If configured) -->
                            @if (DB::table('states')->count() > 0)
                                <div class="col-md-6 mb-3">
                                    <label for="state_id" class="form-label-custom">{{__('State')}} <small class="text-muted">({{__('Includes tax rules')}})</small></label>
                                    <div class="input-icon-wrapper">
                                        <i class="icon-map input-icon"></i>
                                        <select class="form-control custom-input custom-select-input" name="state_id" id="state_id">
                                            <option value="">{{__('Select Shipping State')}}</option>
                                            @foreach (DB::table('states')->whereStatus(1)->get() as $state)
                                                <option value="{{$state->id}}" {{$user->state_id == $state->id ? 'selected' :''}} >{{$state->name}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    @error('state_id')
                                        <p class="text-danger small mt-1 mb-0">{{$message}}</p>
                                    @enderror
                                </div>
                            @endif

                            <!-- Shipping Country -->
                            <div class="{{DB::table('states')->count() > 0  ? 'col-md-12' : 'col-md-6'}} mb-3">
                                <label for="shipping-country" class="form-label-custom">{{__('Country')}}</label>
                                <div class="input-icon-wrapper">
                                    <i class="icon-globe input-icon"></i>
                                    <select class="form-control custom-input custom-select-input" name="ship_country" id="shipping-country">
                                        <option value="">{{__('Choose Country')}}</option>
                                        @foreach (DB::table('countries')->get() as $country)
                                            <option value="{{$country->name}}" {{$user->ship_country == $country->name ? 'selected' :''}} >{{$country->name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                                @error('ship_country')
                                    <p class="text-danger small mt-1 mb-0">{{$message}}</p>
                                @enderror
                            </div>
                        </div>

                        <div class="d-flex justify-content-end pt-3 border-top mt-2">
                            <button class="btn btn-save-profile px-4 py-2" type="submit">
                                <i class="icon-check mr-2"></i> <span>{{__('Update Shipping Address')}}</span>
                            </button>
                        </div>
                    </form>
                </div>
            </div>

        </div>
    </div>
</div>

<style>
.modern-address-card {
    background: #ffffff !important;
    border-radius: 18px !important;
    overflow: hidden !important;
    border: 1px solid #e2e8f0 !important;
    box-shadow: 0 4px 20px rgba(0, 0, 0, 0.05) !important;
}

.form-label-custom {
    font-size: 13px !important;
    font-weight: 600 !important;
    color: #334155 !important;
    margin-bottom: 6px !important;
    display: block !important;
}

.input-icon-wrapper {
    position: relative !important;
    display: flex !important;
    align-items: center !important;
}

.input-icon-wrapper .input-icon {
    position: absolute !important;
    left: 14px !important;
    color: #94a3b8 !important;
    font-size: 16px !important;
    pointer-events: none !important;
    z-index: 2 !important;
}

.custom-input {
    width: 100% !important;
    padding: 11px 16px 11px 40px !important;
    font-size: 14px !important;
    border-radius: 12px !important;
    border: 1px solid #cbd5e1 !important;
    background: #ffffff !important;
    color: #0f172a !important;
    transition: all 0.2s ease !important;
    height: auto !important;
}

.custom-input:focus {
    border-color: #059669 !important;
    box-shadow: 0 0 0 3px rgba(5, 150, 105, 0.15) !important;
    outline: none !important;
}

.custom-select-input {
    appearance: none !important;
    -webkit-appearance: none !important;
    background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='16' height='16' fill='%2364748b' viewBox='0 0 16 16'%3E%3Cpath d='M7.247 11.14 2.451 5.658C1.885 5.013 2.345 4 3.204 4h9.592a1 1 0 0 1 .753 1.659l-4.796 5.48a1 1 0 0 1-1.506 0z'/%3E%3C/svg%3E") !important;
    background-repeat: no-repeat !important;
    background-position: right 14px center !important;
    background-size: 12px !important;
    padding-right: 36px !important;
}

.btn-save-profile {
    background: linear-gradient(135deg, #059669 0%, #047857 100%) !important;
    color: #ffffff !important;
    border: none !important;
    border-radius: 999px !important;
    font-size: 14px !important;
    font-weight: 700 !important;
    padding: 10px 28px !important;
    box-shadow: 0 4px 14px rgba(5, 150, 105, 0.35) !important;
    transition: all 0.2s ease !important;
    display: inline-flex !important;
    align-items: center !important;
    justify-content: center !important;
}

.btn-save-profile:hover {
    transform: translateY(-2px) !important;
    box-shadow: 0 6px 20px rgba(5, 150, 105, 0.45) !important;
    background: linear-gradient(135deg, #047857 0%, #065f46 100%) !important;
    color: #ffffff !important;
}

@media (max-width: 767px) {
    .modern-address-card {
        border-radius: 14px !important;
    }
    .custom-input {
        padding: 10px 14px 10px 38px !important;
        font-size: 13.5px !important;
    }
    .btn-save-profile {
        width: 100% !important;
    }
}
</style>
@endsection

