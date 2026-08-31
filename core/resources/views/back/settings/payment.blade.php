@extends('master.back')

@section('content')
    <div class="container-fluid">

        <!-- Page Heading Banner -->
        <div class="dash-hero-banner mb-4">
            <div class="dash-hero-content">
                <div class="dash-hero-text">
                    <h2><i class="fa-solid fa-credit-card mr-2" style="font-size: 22px;"></i> {{ __('Payment Methods & Gateways') }}</h2>
                    <p>{{ __('Configure checkout payment processors, API credentials, offline bank transfers, and Cash on Delivery.') }}</p>
                </div>
            </div>
        </div>

        <!-- Form -->
        <div class="row">

            <div class="col-xl-12 col-lg-12 col-md-12">

                <div class="card-modern">
                    <div class="card-modern-body p-3 p-md-4">
                        <!-- Nested Row within Card Body -->
                        <div class="row">
                            <div class="col-lg-3 col-md-12 mb-4 mb-lg-0 border-right">
                                <div class="nav flex-column nav-pills payment-nav-pills" id="v-pills-tab" role="tablist"
                                    aria-orientation="vertical">

                                    <a class="nav-link active" data-toggle="pill"
                                        href="#cod"><i class="fa-solid fa-hand-holding-dollar mr-2"></i> {{ __('Cash On Delivery') }}</a>
                                    <a class="nav-link" data-toggle="pill" href="#stripe"><i class="fa-brands fa-stripe mr-2"></i> {{ __('Stripe') }}</a>
                                    <a class="nav-link" data-toggle="pill" href="#paypal"><i class="fa-brands fa-paypal mr-2"></i> {{ __('Paypal') }}</a>
                                    <a class="nav-link" data-toggle="pill" href="#molly"><i class="fa-solid fa-money-bill-transfer mr-2"></i> {{ __('Mollie') }}</a>
                                    <a class="nav-link" data-toggle="pill" href="#paytm"><i class="fa-solid fa-wallet mr-2"></i> {{ __('Paytm') }}</a>
                                    <a class="nav-link" data-toggle="pill" href="#razorpay"><i class="fa-solid fa-credit-card mr-2"></i> {{ __('Razorpay') }}</a>
                                    <a class="nav-link" data-toggle="pill" href="#sslcommerz"><i class="fa-solid fa-building-columns mr-2"></i> {{ __('SSL commerz') }}</a>
                                    <a class="nav-link" data-toggle="pill" href="#mercadopago"><i class="fa-solid fa-handshake mr-2"></i> {{ __('Mercadopago') }}</a>
                                    <a class="nav-link" data-toggle="pill" href="#authorize"><i class="fa-solid fa-shield-halved mr-2"></i> {{ __('Authorize.Net') }}</a>
                                    <a class="nav-link" data-toggle="pill" href="#paystack"><i class="fa-solid fa-layer-group mr-2"></i> {{ __('Paystack') }}</a>
                                    <a class="nav-link" data-toggle="pill" href="#flutterwave"><i class="fa-solid fa-wave-square mr-2"></i> {{ __('Flutterwave') }}</a>
                                    <a class="nav-link" data-toggle="pill" href="#paytabs"><i class="fa-solid fa-tags mr-2"></i> {{ __('Paytabs') }}</a>
                                    <a class="nav-link" data-toggle="pill" href="#cashfree"><i class="fa-solid fa-bolt mr-2"></i> {{ __('Cashfree') }}</a>
                                    <a class="nav-link" data-toggle="pill" href="#bank"><i class="fa-solid fa-building-columns mr-2"></i> {{ __('Bank Transfer') }}</a>

                                </div>
                            </div>
                            <div class="col-lg-9 col-md-12">
                                <div class="p-2 p-md-3">
                                    <div class="admin-form">

                                        @include('alerts.alerts')

                                        <div class="container pl-0 pr-0 ml-0 mr-0 w-100 mw-100">
                                            <div id="tabs">
                                                <!-- Tab panes -->
                                                <div class="tab-content">
                                                    <div id="cod" class="container tab-pane active"><br>

                                                        <div class="row justify-content-center">

                                                            <div class="col-lg-8">

                                                                <form action="{{ route('back.setting.payment.update') }}"
                                                                    method="POST" enctype="multipart/form-data">

                                                                    @csrf
                                                                    <div class="form-group">
                                                                        <label class="switch-primary">
                                                                            <input type="checkbox"
                                                                                class="switch switch-bootstrap "
                                                                                name="status" value="1"
                                                                                {{ $cod->status == 1 ? 'checked' : '' }}>
                                                                            <span class="switch-body"></span>
                                                                            <span
                                                                                class="switch-text">{{ __('Display Cash On Delivery') }}</span>
                                                                        </label>
                                                                    </div>

                                                                    <div
                                                                        class="image-show {{ $cod->status == 1 ? '' : 'd-none' }}">

                                                                        <div class="form-group">
                                                                            <label for="name">{{ __('Enter Name') }}
                                                                                *</label>
                                                                            <input type="text" class="form-control"
                                                                                name="name" id="name"
                                                                                value="{{ $cod->name }}">
                                                                        </div>

                                                                        <div class="form-group">
                                                                            <label
                                                                                for="name">{{ __('Current Image') }}</label>
                                                                            <div class="col-lg-12 pb-1">
                                                                                <img class="admin-setting-img"
                                                                                    src="{{ $cod->photo ? url('/core/public/storage/images/' . $cod->photo) : url('/core/public/storage/images/placeholder.png') }}"
                                                                                    alt="No Image Found">
                                                                            </div>
                                                                            <span>{{ __('Image Size Should Be 52 x 35.') }}</span>
                                                                        </div>

                                                                        <div class="form-group position-relative col-xl-12">
                                                                            <label class="file">
                                                                                <input type="file" accept="image/*"
                                                                                    class="upload-photo" name="photo"
                                                                                    id="file"
                                                                                    aria-label="File browser example">
                                                                                <span
                                                                                    class="file-custom text-left">{{ __('Upload Image...') }}</span>
                                                                            </label>
                                                                        </div>
                                                                        <div class="form-group">
                                                                            <label for="text">{{ __('Enter Text') }}
                                                                                *</label>
                                                                            <textarea name="text" id="text" class="form-control " rows="5" placeholder="{{ __('Enter Text') }}">{{ $cod->text }}</textarea>
                                                                        </div>

                                                                        <input type="hidden" name="unique_keyword"
                                                                            value="cod">

                                                                    </div>

                                                                    <div>

                                                                        <div
                                                                            class="form-group d-flex justify-content-center">
                                                                            <button type="submit"
                                                                                class="btn btn-secondary ">{{ __('Submit') }}</button>
                                                                        </div>

                                                                    </div>

                                                                </form>

                                                            </div>

                                                        </div>

                                                    </div>

                                                    <div id="stripe" class="container tab-pane"><br>

                                                        <div class="row justify-content-center">

                                                            <div class="col-lg-8">

                                                                <form action="{{ route('back.setting.payment.update') }}"
                                                                    method="POST" enctype="multipart/form-data">

                                                                    @csrf



                                                                    <div class="form-group">
                                                                        <label class="switch-primary">
                                                                            <input type="checkbox"
                                                                                class="switch switch-bootstrap "
                                                                                name="status" value="1"
                                                                                {{ $stripe->status == 1 ? 'checked' : '' }}>
                                                                            <span class="switch-body"></span>
                                                                            <span
                                                                                class="switch-text">{{ __('Display Stripe') }}</span>
                                                                        </label>
                                                                    </div>


                                                                    <div
                                                                        class="image-show {{ $stripe->status == 1 ? '' : 'd-none' }}">

                                                                        <div class="form-group">
                                                                            <label
                                                                                for="name">{{ __('Current Image') }}</label>
                                                                            <div class="col-lg-12 pb-1">
                                                                                <img class="admin-setting-img"
                                                                                    src="{{ $stripe->photo ? url('/core/public/storage/images/' . $stripe->photo) : url('/core/public/storage/images/placeholder.png') }}"
                                                                                    stripe="No Image Found">
                                                                            </div>
                                                                            <span>{{ __('Image Size Should Be 52 x 35.') }}</span>
                                                                        </div>

                                                                        <div
                                                                            class="form-group position-relative col-xl-12">
                                                                            <label class="file">
                                                                                <input type="file" accept="image/*"
                                                                                    class="upload-photo" name="photo"
                                                                                    id="file"
                                                                                    aria-label="File browser example">
                                                                                <span
                                                                                    class="file-custom text-left">{{ __('Upload Image...') }}</span>
                                                                            </label>
                                                                        </div>

                                                                        <div class="form-group">
                                                                            <label for="name">{{ __('Enter Name') }}
                                                                                *</label>
                                                                            <input type="text" class="form-control"
                                                                                name="name" id="name"
                                                                                value="{{ $stripe->name }}">
                                                                        </div>
                                                                        @foreach ($stripeData as $pkey => $pdata)
                                                                            <div class="form-group">
                                                                                <label
                                                                                    for="inp-{{ __($pkey) }}">{{ __($stripe->name . ' ' . ucwords(str_replace('_', ' ', $pkey))) }}</label>
                                                                                <input type="text" class="form-control"
                                                                                    id="inp-{{ __($pkey) }}"
                                                                                    name="pkey[{{ __($pkey) }}]"
                                                                                    placeholder="{{ __($stripe->name . ' ' . ucwords(str_replace('_', ' ', $pkey))) }}"
                                                                                    value="{{ $pdata }}">
                                                                            </div>
                                                                        @endforeach

                                                                        <div class="form-group">
                                                                            <label for="text">{{ __('Enter Text') }}
                                                                                *</label>
                                                                            <textarea name="text" id="text" class="form-control " rows="5" placeholder="{{ __('Enter Text') }}">{{ $stripe->text }}</textarea>
                                                                        </div>

                                                                        <input type="hidden" name="unique_keyword"
                                                                            value="stripe">

                                                                    </div>

                                                                    <div>

                                                                        <div
                                                                            class="form-group d-flex justify-content-center">
                                                                            <button type="submit"
                                                                                class="btn btn-secondary ">{{ __('Submit') }}</button>
                                                                        </div>

                                                                    </div>

                                                                </form>

                                                            </div>

                                                        </div>

                                                    </div>

                                                    <div id="paypal" class="container tab-pane"><br>

                                                        <div class="row justify-content-center">

                                                            <div class="col-lg-8">

                                                                <form action="{{ route('back.setting.payment.update') }}"
                                                                    method="POST" enctype="multipart/form-data">

                                                                    @csrf

                                                                    <div class="form-group">
                                                                        <label class="switch-primary">
                                                                            <input type="checkbox"
                                                                                class="switch switch-bootstrap "
                                                                                name="status" value="1"
                                                                                {{ $paypal->status == 1 ? 'checked' : '' }}>
                                                                            <span class="switch-body"></span>
                                                                            <span
                                                                                class="switch-text">{{ __('Display Paypal') }}</span>
                                                                        </label>
                                                                    </div>


                                                                    <div
                                                                        class="image-show {{ $paypal->status == 1 ? '' : 'd-none' }}">

                                                                        <div class="form-group">
                                                                            <label
                                                                                for="name">{{ __('Current Image') }}</label>
                                                                            <div class="col-lg-12 pb-1">
                                                                                <img class="admin-setting-img"
                                                                                    src="{{ $paypal->photo ? url('/core/public/storage/images/' . $paypal->photo) : url('/core/public/storage/images/placeholder.png') }}"
                                                                                    alt="No Image Found">
                                                                            </div>
                                                                            <span>{{ __('Image Size Should Be 52 x 35.') }}</span>
                                                                        </div>

                                                                        <div
                                                                            class="form-group position-relative col-xl-12">
                                                                            <label class="file">
                                                                                <input type="file" accept="image/*"
                                                                                    class="upload-photo" name="photo"
                                                                                    id="file"
                                                                                    aria-label="File browser example">
                                                                                <span
                                                                                    class="file-custom text-left">{{ __('Upload Image...') }}</span>
                                                                            </label>
                                                                        </div>


                                                                        <div class="form-group">
                                                                            <label for="name">{{ __('Enter Name') }}
                                                                                *</label>
                                                                            <input type="text" class="form-control"
                                                                                name="name" id="name"
                                                                                value="{{ $paypal->name }}">
                                                                        </div>

                                                                        @foreach ($paypalData as $pkey => $pdata)
                                                                            @if ($pkey == 'check_sandbox')
                                                                                <div class="form-group  col-xl-4 col-md-6">
                                                                                    <div
                                                                                        class="custom-control custom-checkbox">
                                                                                        <input type="checkbox"
                                                                                            name="pkey[{{ __($pkey) }}]"
                                                                                            class="custom-control-input"
                                                                                            {{ $pdata == 1 ? 'checked' : '' }}
                                                                                            id="{{ $pkey }}">
                                                                                        <label class="custom-control-label"
                                                                                            for="{{ $pkey }}">
                                                                                            {{ __($paypal->name . ' ' . ucwords(str_replace('_', ' ', $pkey))) }}
                                                                                        </label>
                                                                                    </div>
                                                                                </div>
                                                                            @else
                                                                                <div class="form-group">
                                                                                    <label
                                                                                        for="inp-{{ __($pkey) }}">{{ __($paypal->name . ' ' . ucwords(str_replace('_', ' ', $pkey))) }}</label>
                                                                                    <input type="text"
                                                                                        class="form-control"
                                                                                        id="inp-{{ __($pkey) }}"
                                                                                        name="pkey[{{ __($pkey) }}]"
                                                                                        placeholder="{{ __($paypal->name . ' ' . ucwords(str_replace('_', ' ', $pkey))) }}"
                                                                                        value="{{ $pdata }}">
                                                                                </div>
                                                                            @endif
                                                                        @endforeach

                                                                        <div class="form-group">
                                                                            <label for="text">{{ __('Enter Text') }}
                                                                                *</label>
                                                                            <textarea name="text" id="text" class="form-control " rows="5" placeholder="{{ __('Enter Text') }}">{{ $paypal->text }}</textarea>
                                                                        </div>

                                                                        <input type="hidden" name="unique_keyword"
                                                                            value="paypal">

                                                                    </div>

                                                                    <div>

                                                                        <div
                                                                            class="form-group d-flex justify-content-center">
                                                                            <button type="submit"
                                                                                class="btn btn-secondary ">{{ __('Submit') }}</button>
                                                                        </div>

                                                                    </div>

                                                                </form>

                                                            </div>

                                                        </div>

                                                    </div>
                                                    <div id="molly" class="container tab-pane"><br>

                                                        <div class="row justify-content-center">

                                                            <div class="col-lg-8">

                                                                <form action="{{ route('back.setting.payment.update') }}"
                                                                    method="POST" enctype="multipart/form-data">

                                                                    @csrf

                                                                    <div class="form-group">
                                                                        <label class="switch-primary">
                                                                            <input type="checkbox"
                                                                                class="switch switch-bootstrap "
                                                                                name="status" value="1"
                                                                                {{ $molly->status == 1 ? 'checked' : '' }}>
                                                                            <span class="switch-body"></span>
                                                                            <span
                                                                                class="switch-text">{{ __('Display Mollie') }}</span>
                                                                        </label>
                                                                    </div>



                                                                    <div
                                                                        class="image-show {{ $molly->status == 1 ? '' : 'd-none' }}">

                                                                        <div class="form-group">
                                                                            <label
                                                                                for="name">{{ __('Current Image') }}</label>
                                                                            <div class="col-lg-12 pb-1">
                                                                                <img class="admin-setting-img"
                                                                                    src="{{ $molly->photo ? url('/core/public/storage/images/' . $molly->photo) : url('/core/public/storage/images/placeholder.png') }}"
                                                                                    alt="No Image Found">
                                                                            </div>
                                                                            <span>{{ __('Image Size Should Be 52 x 35.') }}</span>
                                                                        </div>

                                                                        <div
                                                                            class="form-group position-relative col-xl-12">
                                                                            <label class="file">
                                                                                <input type="file" accept="image/*"
                                                                                    class="upload-photo" name="photo"
                                                                                    id="file"
                                                                                    aria-label="File browser example">
                                                                                <span
                                                                                    class="file-custom text-left">{{ __('Upload Image...') }}</span>
                                                                            </label>
                                                                        </div>

                                                                        <div class="form-group">
                                                                            <label for="name">{{ __('Enter Name') }}
                                                                                *</label>
                                                                            <input type="text" class="form-control"
                                                                                name="name" id="name"
                                                                                value="{{ $molly->name }}">
                                                                        </div>

                                                                        @foreach ($mollyData as $pkey => $pdata)
                                                                            <div class="form-group">
                                                                                <label
                                                                                    for="inp-{{ __($pkey) }}">{{ __($molly->name . ' ' . ucwords(str_replace('_', ' ', $pkey))) }}</label>
                                                                                <input type="text" class="form-control"
                                                                                    id="inp-{{ __($pkey) }}"
                                                                                    name="pkey[{{ __($pkey) }}]"
                                                                                    placeholder="{{ __($molly->name . ' ' . ucwords(str_replace('_', ' ', $pkey))) }}"
                                                                                    value="{{ $pdata }}">
                                                                            </div>
                                                                        @endforeach

                                                                        <input type="hidden" name="unique_keyword"
                                                                            value="mollie">

                                                                        <div class="form-group">
                                                                            <label for="text">{{ __('Enter Text') }}
                                                                                *</label>
                                                                            <textarea name="text" id="text" class="form-control " rows="5" placeholder="{{ __('Enter Text') }}">{{ $molly->text }}</textarea>
                                                                        </div>

                                                                    </div>

                                                                    <div>

                                                                        <div
                                                                            class="form-group d-flex justify-content-center">
                                                                            <button type="submit"
                                                                                class="btn btn-secondary ">{{ __('Submit') }}</button>
                                                                        </div>

                                                                    </div>

                                                                </form>

                                                            </div>

                                                        </div>

                                                    </div>

                                                    <div id="paytm" class="container tab-pane"><br>

                                                        <div class="row justify-content-center">

                                                            <div class="col-lg-8">

                                                                <form action="{{ route('back.setting.payment.update') }}"
                                                                    method="POST" enctype="multipart/form-data">

                                                                    @csrf

                                                                    <div class="form-group">
                                                                        <label class="switch-primary">
                                                                            <input type="checkbox"
                                                                                class="switch switch-bootstrap "
                                                                                name="status" value="1"
                                                                                {{ $paytm->status == 1 ? 'checked' : '' }}>
                                                                            <span class="switch-body"></span>
                                                                            <span
                                                                                class="switch-text">{{ __('Display Paytm') }}</span>
                                                                        </label>
                                                                    </div>



                                                                    <div
                                                                        class="image-show {{ $paytm->status == 1 ? '' : 'd-none' }}">

                                                                        <div class="form-group col-xl-12">
                                                                            <label
                                                                                for="name">{{ __('Current Image') }}</label>
                                                                            <div class="col-lg-12 pb-1">
                                                                                <img class="admin-setting-img"
                                                                                    src="{{ $paytm->photo ? url('/core/public/storage/images/' . $paytm->photo) : url('/core/public/storage/images/placeholder.png') }}"
                                                                                    stripe="No Image Found">
                                                                            </div>
                                                                            <span>{{ __('Image Size Should Be 52 x 35.') }}</span>
                                                                        </div>

                                                                        <div
                                                                            class="form-group position-relative col-xl-12">
                                                                            <label class="file">
                                                                                <input type="file" class="upload-photo"
                                                                                    name="photo" id="file"
                                                                                    aria-label="File browser example">
                                                                                <span
                                                                                    class="file-custom text-left">{{ __('Upload Image...') }}</span>
                                                                            </label>
                                                                        </div>

                                                                        <div class="form-group">
                                                                            <label for="name">{{ __('Enter Name') }}
                                                                                *</label>
                                                                            <input type="text" class="form-control"
                                                                                name="name" id="name"
                                                                                value="{{ $paytm->name }}">
                                                                        </div>

                                                                        @foreach ($paytmData as $pakey => $paytmDat)
                                                                            @if ($pakey == 'paytm_mode')
                                                                                <div class="form-group  col-xl-4 col-md-6">
                                                                                    <div
                                                                                        class="custom-control custom-checkbox">
                                                                                        <input type="checkbox"
                                                                                            name="pkey[{{ __($pakey) }}]"
                                                                                            class="custom-control-input"
                                                                                            {{ $paytmDat == 1 ? 'checked' : '' }}
                                                                                            id="{{ $pakey }}"
                                                                                            value="1">
                                                                                        <label class="custom-control-label"
                                                                                            for="{{ $pakey }}">
                                                                                            {{ __(ucwords(str_replace('_', ' ', $pakey))) }}
                                                                                        </label>
                                                                                    </div>
                                                                                </div>
                                                                            @else
                                                                                <div class="form-group">
                                                                                    <label
                                                                                        for="inp-{{ __($pakey) }}">{{ __($paytm->name . ' ' . ucwords(str_replace('_', ' ', $pakey))) }}</label>
                                                                                    <input type="text"
                                                                                        class="form-control"
                                                                                        id="inp-{{ __($pakey) }}"
                                                                                        name="pkey[{{ __($pakey) }}]"
                                                                                        placeholder="{{ __($paytm->name . ' ' . ucwords(str_replace('_', ' ', $pakey))) }}"
                                                                                        value="{{ $paytmDat }}">
                                                                                </div>
                                                                            @endif
                                                                        @endforeach

                                                                        <div class="form-group">
                                                                            <label for="text">{{ __('Enter Text') }}
                                                                                *</label>
                                                                            <textarea name="text" id="text" class="form-control " rows="5"
                                                                                placeholder="{{ __('Enter Text') }}">{{ $paytm->text }}</textarea>
                                                                        </div>

                                                                        <input type="hidden" name="unique_keyword"
                                                                            value="paytm">

                                                                    </div>

                                                                    <div>

                                                                        <div
                                                                            class="form-group d-flex justify-content-center">
                                                                            <button type="submit"
                                                                                class="btn btn-secondary btn-block w-50">{{ __('Submit') }}</button>
                                                                        </div>

                                                                    </div>

                                                                </form>

                                                            </div>

                                                        </div>

                                                    </div>

                                                    <div id="sslcommerz" class="container tab-pane"><br>

                                                        <div class="row justify-content-center">

                                                            <div class="col-lg-8">

                                                                <form action="{{ route('back.setting.payment.update') }}"
                                                                    method="POST" enctype="multipart/form-data">

                                                                    @csrf

                                                                    <div class="form-group">
                                                                        <label class="switch-primary">
                                                                            <input type="checkbox"
                                                                                class="switch switch-bootstrap "
                                                                                name="status" value="1"
                                                                                {{ $sslcommerz->status == 1 ? 'checked' : '' }}>
                                                                            <span class="switch-body"></span>
                                                                            <span
                                                                                class="switch-text">{{ __('Display sslcommerz') }}</span>
                                                                        </label>
                                                                    </div>


                                                                    <div
                                                                        class="image-show {{ $sslcommerz->status == 1 ? '' : 'd-none' }}">

                                                                        <div class="form-group col-xl-12">
                                                                            <label
                                                                                for="name">{{ __('Current Image') }}</label>
                                                                            <div class="col-lg-12 pb-1">
                                                                                <img class="admin-setting-img"
                                                                                    src="{{ $sslcommerz->photo ? url('/core/public/storage/images/' . $sslcommerz->photo) : url('/core/public/storage/images/placeholder.png') }}"
                                                                                    stripe="No Image Found">
                                                                            </div>
                                                                            <span>{{ __('Image Size Should Be 52 x 35.') }}</span>
                                                                        </div>

                                                                        <div
                                                                            class="form-group position-relative col-xl-12">
                                                                            <label class="file">
                                                                                <input type="file" class="upload-photo"
                                                                                    name="photo" id="file"
                                                                                    aria-label="File browser example">
                                                                                <span
                                                                                    class="file-custom text-left">{{ __('Upload Image...') }}</span>
                                                                            </label>
                                                                        </div>


                                                                        <div class="form-group">
                                                                            <label for="name">{{ __('Enter Name') }}
                                                                                *</label>
                                                                            <input type="text" class="form-control"
                                                                                name="name" id="name"
                                                                                value="{{ $sslcommerz->name }}">
                                                                        </div>

                                                                        @foreach ($sslcommerzData as $pkey => $sslcommerzData)
                                                                            @if ($pkey == 'check_sandbox')
                                                                                <div class="form-group  col-xl-4 col-md-6">
                                                                                    <div
                                                                                        class="custom-control custom-checkbox">
                                                                                        <input type="checkbox"
                                                                                            name="pkey[{{ __($pkey) }}]"
                                                                                            class="custom-control-input"
                                                                                            {{ $sslcommerzData == 1 ? 'checked' : '' }}
                                                                                            id="ssl{{ $pkey }}">
                                                                                        <label class="custom-control-label"
                                                                                            for="ssl{{ $pkey }}">
                                                                                            {{ __($sslcommerz->name . ' ' . ucwords(str_replace('_', ' ', $pkey))) }}
                                                                                        </label>
                                                                                    </div>
                                                                                </div>
                                                                            @else
                                                                                <div class="form-group col-xl-12">
                                                                                    <label
                                                                                        for="inp-{{ __($pkey) }}">{{ __($sslcommerz->name . ' ' . ucwords(str_replace('_', ' ', $pkey))) }}</label>
                                                                                    <input type="text"
                                                                                        class="form-control"
                                                                                        id="inp-{{ __($pkey) }}"
                                                                                        name="pkey[{{ __($pkey) }}]"
                                                                                        placeholder="{{ __($sslcommerz->name . ' ' . ucwords(str_replace('_', ' ', $pkey))) }}"
                                                                                        value="{{ $sslcommerzData }}"
                                                                                        required>
                                                                                </div>
                                                                            @endif
                                                                        @endforeach

                                                                        <div class="form-group">
                                                                            <label for="text">{{ __('Enter Text') }}
                                                                                *</label>
                                                                            <textarea name="text" id="text" class="form-control " rows="5"
                                                                                placeholder="{{ __('Enter Text') }}">{{ $sslcommerz->text }}</textarea>
                                                                        </div>

                                                                        <input type="hidden" name="unique_keyword"
                                                                            value="sslcommerz">

                                                                    </div>

                                                                    <div>

                                                                        <div
                                                                            class="form-group d-flex justify-content-center">
                                                                            <button type="submit"
                                                                                class="btn btn-secondary btn-block w-50">{{ __('Submit') }}</button>
                                                                        </div>

                                                                    </div>

                                                                </form>

                                                            </div>

                                                        </div>

                                                    </div>

                                                    <div id="mercadopago" class="container tab-pane"><br>

                                                        <div class="row justify-content-center">

                                                            <div class="col-lg-8">

                                                                <form action="{{ route('back.setting.payment.update') }}"
                                                                    method="POST" enctype="multipart/form-data">

                                                                    @csrf

                                                                    <div class="form-group">
                                                                        <label class="switch-primary">
                                                                            <input type="checkbox"
                                                                                class="switch switch-bootstrap "
                                                                                name="status" value="1"
                                                                                {{ $mercadopago->status == 1 ? 'checked' : '' }}>
                                                                            <span class="switch-body"></span>
                                                                            <span
                                                                                class="switch-text">{{ __('Display Mercadopago') }}</span>
                                                                        </label>
                                                                    </div>



                                                                    <div
                                                                        class="image-show {{ $mercadopago->status == 1 ? '' : 'd-none' }}">

                                                                        <div class="form-group col-xl-12">
                                                                            <label
                                                                                for="name">{{ __('Current Image') }}</label>
                                                                            <div class="col-lg-12 pb-1">
                                                                                <img class="admin-setting-img"
                                                                                    src="{{ $mercadopago->photo ? url('/core/public/storage/images/' . $mercadopago->photo) : url('/core/public/storage/images/placeholder.png') }}"
                                                                                    stripe="No Image Found">
                                                                            </div>
                                                                            <span>{{ __('Image Size Should Be 52 x 35.') }}</span>
                                                                        </div>

                                                                        <div
                                                                            class="form-group position-relative col-xl-12">
                                                                            <label class="file">
                                                                                <input type="file" class="upload-photo"
                                                                                    name="photo" id="file"
                                                                                    aria-label="File browser example">
                                                                                <span
                                                                                    class="file-custom text-left">{{ __('Upload Image...') }}</span>
                                                                            </label>
                                                                        </div>

                                                                        <div class="form-group">
                                                                            <label for="name">{{ __('Enter Name') }}
                                                                                *</label>
                                                                            <input type="text" class="form-control"
                                                                                name="name" id="name"
                                                                                value="{{ $mercadopago->name }}">
                                                                        </div>

                                                                        @foreach ($mercadopagoData as $pkey => $mercadopagoData)
                                                                            @if ($pkey == 'check_sandbox')
                                                                                <div class="form-group  col-xl-4 col-md-6">
                                                                                    <div
                                                                                        class="custom-control custom-checkbox">
                                                                                        <input type="checkbox"
                                                                                            name="pkey[{{ __($pkey) }}]"
                                                                                            class="custom-control-input"
                                                                                            {{ $mercadopagoData == 1 ? 'checked' : '' }}
                                                                                            id="authorize{{ $pkey }}">
                                                                                        <label class="custom-control-label"
                                                                                            for="authorize{{ $pkey }}">
                                                                                            {{ __($mercadopago->name . ' ' . ucwords(str_replace('_', ' ', $pkey))) }}
                                                                                        </label>
                                                                                    </div>
                                                                                </div>
                                                                            @else
                                                                                <div class="form-group col-xl-12">
                                                                                    <label
                                                                                        for="inp-{{ __($pkey) }}">{{ __($mercadopago->name . ' ' . ucwords(str_replace('_', ' ', $pkey))) }}</label>
                                                                                    <input type="text"
                                                                                        class="form-control"
                                                                                        id="inp-{{ __($pkey) }}"
                                                                                        name="pkey[{{ __($pkey) }}]"
                                                                                        placeholder="{{ __($mercadopago->name . ' ' . ucwords(str_replace('_', ' ', $pkey))) }}"
                                                                                        value="{{ $mercadopagoData }}"
                                                                                        required>
                                                                                </div>
                                                                            @endif
                                                                        @endforeach

                                                                        <div class="form-group">
                                                                            <label for="text">{{ __('Enter Text') }}
                                                                                *</label>
                                                                            <textarea name="text" id="text" class="form-control " rows="5"
                                                                                placeholder="{{ __('Enter Text') }}">{{ $mercadopago->text }}</textarea>
                                                                        </div>

                                                                        <input type="hidden" name="unique_keyword"
                                                                            value="mercadopago">

                                                                    </div>

                                                                    <div>

                                                                        <div
                                                                            class="form-group d-flex justify-content-center">
                                                                            <button type="submit"
                                                                                class="btn btn-secondary btn-block w-50">{{ __('Submit') }}</button>
                                                                        </div>

                                                                    </div>

                                                                </form>

                                                            </div>

                                                        </div>

                                                    </div>

                                                    <div id="authorize" class="container tab-pane"><br>

                                                        <div class="row justify-content-center">

                                                            <div class="col-lg-8">

                                                                <form action="{{ route('back.setting.payment.update') }}"
                                                                    method="POST" enctype="multipart/form-data">

                                                                    @csrf

                                                                    <div class="form-group">
                                                                        <label class="switch-primary">
                                                                            <input type="checkbox"
                                                                                class="switch switch-bootstrap "
                                                                                name="status" value="1"
                                                                                {{ $authorize->status == 1 ? 'checked' : '' }}>
                                                                            <span class="switch-body"></span>
                                                                            <span
                                                                                class="switch-text">{{ __('Display Authorize.Net') }}</span>
                                                                        </label>
                                                                    </div>


                                                                    <div
                                                                        class="image-show {{ $authorize->status == 1 ? '' : 'd-none' }}">

                                                                        <div class="form-group col-xl-12">
                                                                            <label
                                                                                for="name">{{ __('Current Image') }}</label>
                                                                            <div class="col-lg-12 pb-1">
                                                                                <img class="admin-setting-img"
                                                                                    src="{{ $authorize->photo ? url('/core/public/storage/images/' . $authorize->photo) : url('/core/public/storage/images/placeholder.png') }}"
                                                                                    stripe="No Image Found">
                                                                            </div>
                                                                            <span>{{ __('Image Size Should Be 52 x 35.') }}</span>
                                                                        </div>

                                                                        <div
                                                                            class="form-group position-relative col-xl-12">
                                                                            <label class="file">
                                                                                <input type="file" class="upload-photo"
                                                                                    name="photo" id="file"
                                                                                    aria-label="File browser example">
                                                                                <span
                                                                                    class="file-custom text-left">{{ __('Upload Image...') }}</span>
                                                                            </label>
                                                                        </div>

                                                                        <div class="form-group">
                                                                            <label for="name">{{ __('Enter Name') }}
                                                                                *</label>
                                                                            <input type="text" class="form-control"
                                                                                name="name" id="name"
                                                                                value="{{ $authorize->name }}">
                                                                        </div>

                                                                        @foreach ($authorizeData as $pkey => $authorizeData)
                                                                            @if ($pkey == 'check_sandbox')
                                                                                <div class="form-group  col-xl-4 col-md-6">
                                                                                    <div
                                                                                        class="custom-control custom-checkbox">
                                                                                        <input type="checkbox"
                                                                                            name="pkey[{{ __($pkey) }}]"
                                                                                            class="custom-control-input"
                                                                                            {{ $authorizeData == 1 ? 'checked' : '' }}
                                                                                            id="mer{{ $pkey }}">
                                                                                        <label class="custom-control-label"
                                                                                            for="mer{{ $pkey }}">
                                                                                            {{ __($authorize->name . ' ' . ucwords(str_replace('_', ' ', $pkey))) }}
                                                                                        </label>
                                                                                    </div>
                                                                                </div>
                                                                            @else
                                                                                <div class="form-group col-xl-12">
                                                                                    <label
                                                                                        for="inp-{{ __($pkey) }}">{{ __($authorize->name . ' ' . ucwords(str_replace('_', ' ', $pkey))) }}</label>
                                                                                    <input type="text"
                                                                                        class="form-control"
                                                                                        id="inp-{{ __($pkey) }}"
                                                                                        name="pkey[{{ __($pkey) }}]"
                                                                                        placeholder="{{ __($authorize->name . ' ' . ucwords(str_replace('_', ' ', $pkey))) }}"
                                                                                        value="{{ $authorizeData }}"
                                                                                        required>
                                                                                </div>
                                                                            @endif
                                                                        @endforeach

                                                                        <div class="form-group">
                                                                            <label for="text">{{ __('Enter Text') }}
                                                                                *</label>
                                                                            <textarea name="text" id="text" class="form-control " rows="5"
                                                                                placeholder="{{ __('Enter Text') }}">{{ $authorize->text }}</textarea>
                                                                        </div>

                                                                        <input type="hidden" name="unique_keyword"
                                                                            value="authorize">

                                                                    </div>

                                                                    <div>

                                                                        <div
                                                                            class="form-group d-flex justify-content-center">
                                                                            <button type="submit"
                                                                                class="btn btn-secondary btn-block w-50">{{ __('Submit') }}</button>
                                                                        </div>

                                                                    </div>

                                                                </form>

                                                            </div>

                                                        </div>

                                                    </div>

                                                    <div id="paystack" class="container tab-pane"><br>

                                                        <div class="row justify-content-center">

                                                            <div class="col-lg-8">

                                                                <form action="{{ route('back.setting.payment.update') }}"
                                                                    method="POST" enctype="multipart/form-data">

                                                                    @csrf

                                                                    <div class="form-group">
                                                                        <label class="switch-primary">
                                                                            <input type="checkbox"
                                                                                class="switch switch-bootstrap "
                                                                                name="status" value="1"
                                                                                {{ $paystack->status == 1 ? 'checked' : '' }}>
                                                                            <span class="switch-body"></span>
                                                                            <span
                                                                                class="switch-text">{{ __('Display Paystack') }}</span>
                                                                        </label>
                                                                    </div>



                                                                    <div
                                                                        class="image-show {{ $paystack->status == 1 ? '' : 'd-none' }}">

                                                                        <div class="form-group col-xl-12">
                                                                            <label
                                                                                for="name">{{ __('Current Image') }}</label>
                                                                            <div class="col-lg-12 pb-1">
                                                                                <img class="admin-setting-img"
                                                                                    src="{{ $paystack->photo ? url('/core/public/storage/images/' . $paystack->photo) : url('/core/public/storage/images/placeholder.png') }}"
                                                                                    stripe="No Image Found">
                                                                            </div>
                                                                            <span>{{ __('Image Size Should Be 52 x 35.') }}</span>
                                                                        </div>

                                                                        <div
                                                                            class="form-group position-relative col-xl-12">
                                                                            <label class="file">
                                                                                <input type="file" class="upload-photo"
                                                                                    name="photo" id="file"
                                                                                    aria-label="File browser example">
                                                                                <span
                                                                                    class="file-custom text-left">{{ __('Upload Image...') }}</span>
                                                                            </label>
                                                                        </div>

                                                                        <div class="form-group">
                                                                            <label for="name">{{ __('Enter Name') }}
                                                                                *</label>
                                                                            <input type="text" class="form-control"
                                                                                name="name" id="name"
                                                                                value="{{ $paystack->name }}">
                                                                        </div>

                                                                        @foreach ($paystackData as $pkey => $paystackData)
                                                                            @if ($pkey == 'check_sandbox')
                                                                                <div class="form-group  col-xl-4 col-md-6">
                                                                                    <div
                                                                                        class="custom-control custom-checkbox">
                                                                                        <input type="checkbox"
                                                                                            name="pkey[{{ __($pkey) }}]"
                                                                                            class="custom-control-input"
                                                                                            {{ $paystackData->status == 1 ? 'checked' : '' }}
                                                                                            id="mer{{ $pkey }}">
                                                                                        <label class="custom-control-label"
                                                                                            for="mer{{ $pkey }}">
                                                                                            {{ __($paystack->name . ' ' . ucwords(str_replace('_', ' ', $pkey))) }}
                                                                                        </label>
                                                                                    </div>
                                                                                </div>
                                                                            @else
                                                                                <div class="form-group col-xl-12">
                                                                                    <label
                                                                                        for="inp-{{ __($pkey) }}">{{ __($paystack->name . ' ' . ucwords(str_replace('_', ' ', $pkey))) }}</label>
                                                                                    <input type="text"
                                                                                        class="form-control"
                                                                                        id="inp-{{ __($pkey) }}"
                                                                                        name="pkey[{{ __($pkey) }}]"
                                                                                        placeholder="{{ __($paystack->name . ' ' . ucwords(str_replace('_', ' ', $pkey))) }}"
                                                                                        value="{{ $paystackData }}"
                                                                                        required>
                                                                                </div>
                                                                            @endif
                                                                        @endforeach

                                                                        <div class="form-group">
                                                                            <label for="text">{{ __('Enter Text') }}
                                                                                *</label>
                                                                            <textarea name="text" id="text" class="form-control " rows="5"
                                                                                placeholder="{{ __('Enter Text') }}">{{ $paystack->text }}</textarea>
                                                                        </div>

                                                                        <input type="hidden" name="unique_keyword"
                                                                            value="paystack">

                                                                    </div>

                                                                    <div>

                                                                        <div
                                                                            class="form-group d-flex justify-content-center">
                                                                            <button type="submit"
                                                                                class="btn btn-secondary btn-block w-50">{{ __('Submit') }}</button>
                                                                        </div>

                                                                    </div>

                                                                </form>

                                                            </div>

                                                        </div>

                                                    </div>

                                                    <div id="bank" class="container tab-pane"><br>
                                                        <div class="row justify-content-center">
                                                            <div class="col-lg-8">
                                                                <form action="{{ route('back.setting.payment.update') }}"
                                                                    method="POST" enctype="multipart/form-data">
                                                                    @csrf

                                                                    <div class="form-group">
                                                                        <label class="switch-primary">
                                                                            <input type="checkbox"
                                                                                class="switch switch-bootstrap "
                                                                                name="status" value="1"
                                                                                {{ $bank->status == 1 ? 'checked' : '' }}>
                                                                            <span class="switch-body"></span>
                                                                            <span
                                                                                class="switch-text">{{ __('Display Bank Transfer') }}</span>
                                                                        </label>
                                                                    </div>
                                                                    <div
                                                                        class="image-show {{ $bank->status == 1 ? '' : 'd-none' }}">
                                                                        <div class="form-group col-xl-12">
                                                                            <label
                                                                                for="name">{{ __('Current Image') }}</label>
                                                                            <div class="col-lg-12 pb-1">
                                                                                <img class="admin-setting-img"
                                                                                    src="{{ $bank->photo ? url('/core/public/storage/images/' . $bank->photo) : url('/core/public/storage/images/placeholder.png') }}"
                                                                                    stripe="No Image Found">
                                                                            </div>
                                                                            <span>{{ __('Image Size Should Be 52 x 35.') }}</span>
                                                                        </div>

                                                                        <div
                                                                            class="form-group position-relative col-xl-12">
                                                                            <label class="file">
                                                                                <input type="file" class="upload-photo"
                                                                                    name="photo" id="file"
                                                                                    aria-label="File browser example">
                                                                                <span
                                                                                    class="file-custom text-left">{{ __('Upload Image...') }}</span>
                                                                            </label>
                                                                        </div>

                                                                        <div class="form-group">
                                                                            <label for="name">{{ __('Enter Name') }}
                                                                                *</label>
                                                                            <input type="text" class="form-control"
                                                                                name="name" id="name"
                                                                                value="{{ $bank->name }}">
                                                                        </div>

                                                                        <div class="form-group">
                                                                            <label for="text">{{ __('Enter Text') }}
                                                                                *</label>
                                                                            <textarea name="text" id="text" class="form-control text-editor" rows="5"
                                                                                placeholder="{{ __('Enter Text') }}">{{ $bank->text }}</textarea>
                                                                        </div>

                                                                        <input type="hidden" name="unique_keyword"
                                                                            value="bank">

                                                                    </div>

                                                                    <div>

                                                                        <div
                                                                            class="form-group d-flex justify-content-center">
                                                                            <button type="submit"
                                                                                class="btn btn-secondary btn-block w-50">{{ __('Submit') }}</button>
                                                                        </div>

                                                                    </div>

                                                                </form>

                                                            </div>

                                                        </div>

                                                    </div>

                                                    <div id="razorpay" class="container tab-pane"><br>
                                                        <div class="row justify-content-center">
                                                            <div class="col-lg-8">
                                                                <form action="{{ route('back.setting.payment.update') }}"
                                                                    method="POST" enctype="multipart/form-data">

                                                                    @csrf

                                                                    <div class="form-group">
                                                                        <label class="switch-primary">
                                                                            <input type="checkbox"
                                                                                class="switch switch-bootstrap "
                                                                                name="status" value="1"
                                                                                {{ $razorpay->status == 1 ? 'checked' : '' }}>
                                                                            <span class="switch-body"></span>
                                                                            <span
                                                                                class="switch-text">{{ __('Display Razorpay') }}</span>
                                                                        </label>
                                                                    </div>

                                                                    <div
                                                                        class="image-show {{ $razorpay->status == 1 ? '' : 'd-none' }}">

                                                                        <div class="form-group col-xl-12">
                                                                            <label
                                                                                for="name">{{ __('Current Image') }}</label>
                                                                            <div class="col-lg-12 pb-1">
                                                                                <img class="admin-setting-img"
                                                                                    src="{{ $razorpay->photo ? url('/core/public/storage/images/' . $razorpay->photo) : url('/core/public/storage/images/placeholder.png') }}"
                                                                                    stripe="No Image Found">
                                                                            </div>
                                                                            <span>{{ __('Image Size Should Be 52 x 35.') }}</span>
                                                                        </div>

                                                                        <div
                                                                            class="form-group position-relative col-xl-12">
                                                                            <label class="file">
                                                                                <input type="file" class="upload-photo"
                                                                                    name="photo" id="file"
                                                                                    aria-label="File browser example">
                                                                                <span
                                                                                    class="file-custom text-left">{{ __('Upload Image...') }}</span>
                                                                            </label>
                                                                        </div>

                                                                        <div class="form-group">
                                                                            <label for="name">{{ __('Enter Name') }}
                                                                                *</label>
                                                                            <input type="text" class="form-control"
                                                                                name="name" id="name"
                                                                                value="{{ $razorpay->name }}">
                                                                        </div>

                                                                        @foreach ($razorpayData as $pkey => $razorpayData)
                                                                            @if ($pkey == 'check_sandbox')
                                                                                <div class="form-group  col-xl-4 col-md-6">
                                                                                    <div
                                                                                        class="custom-control custom-checkbox">
                                                                                        <input type="checkbox"
                                                                                            name="pkey[{{ __($pkey) }}]"
                                                                                            class="custom-control-input"
                                                                                            {{ $razorpayData->status == 1 ? 'checked' : '' }}
                                                                                            id="mer{{ $pkey }}">
                                                                                        <label class="custom-control-label"
                                                                                            for="mer{{ $pkey }}">
                                                                                            {{ __($razorpay->name . ' ' . ucwords(str_replace('_', ' ', $pkey))) }}
                                                                                        </label>
                                                                                    </div>
                                                                                </div>
                                                                            @else
                                                                                <div class="form-group col-xl-12">
                                                                                    <label
                                                                                        for="inp-{{ __($pkey) }}">{{ __($razorpay->name . ' ' . ucwords(str_replace('_', ' ', $pkey))) }}</label>
                                                                                    <input type="text"
                                                                                        class="form-control"
                                                                                        id="inp-{{ __($pkey) }}"
                                                                                        name="pkey[{{ __($pkey) }}]"
                                                                                        placeholder="{{ __($razorpay->name . ' ' . ucwords(str_replace('_', ' ', $pkey))) }}"
                                                                                        value="{{ $razorpayData }}"
                                                                                        required>
                                                                                </div>
                                                                            @endif
                                                                        @endforeach
                                                                        <div class="form-group">
                                                                            <label for="text">{{ __('Enter Text') }}
                                                                                *</label>
                                                                            <textarea name="text" id="text" class="form-control " rows="5"
                                                                                placeholder="{{ __('Enter Text') }}">{{ $razorpay->text }}</textarea>
                                                                        </div>
                                                                        <input type="hidden" name="unique_keyword"
                                                                            value="razorpay">
                                                                    </div>
                                                                    <div>
                                                                        <div
                                                                            class="form-group d-flex justify-content-center">
                                                                            <button type="submit"
                                                                                class="btn btn-secondary btn-block w-50">{{ __('Submit') }}</button>
                                                                        </div>
                                                                    </div>
                                                                </form>
                                                            </div>
                                                        </div>
                                                    </div>


                                                    <div id="flutterwave" class="container tab-pane"><br>
                                                        <div class="row justify-content-center">
                                                            <div class="col-lg-8">
                                                                <form action="{{ route('back.setting.payment.update') }}"
                                                                    method="POST" enctype="multipart/form-data">

                                                                    @csrf

                                                                    <div class="form-group">
                                                                        <label class="switch-primary">
                                                                            <input type="checkbox"
                                                                                class="switch switch-bootstrap "
                                                                                name="status" value="1"
                                                                                {{ $flutterwave->status == 1 ? 'checked' : '' }}>
                                                                            <span class="switch-body"></span>
                                                                            <span
                                                                                class="switch-text">{{ __('Display Flutterwave') }}</span>
                                                                        </label>
                                                                    </div>

                                                                    <div
                                                                        class="image-show {{ $flutterwave->status == 1 ? '' : 'd-none' }}">

                                                                        <div class="form-group col-xl-12">
                                                                            <label
                                                                                for="name">{{ __('Current Image') }}</label>
                                                                            <div class="col-lg-12 pb-1">
                                                                                <img class="admin-setting-img"
                                                                                    src="{{ $flutterwave->photo ? url('/core/public/storage/images/' . $flutterwave->photo) : url('/core/public/storage/images/placeholder.png') }}"
                                                                                    stripe="No Image Found">
                                                                            </div>
                                                                            <span>{{ __('Image Size Should Be 52 x 35.') }}</span>
                                                                        </div>

                                                                        <div
                                                                            class="form-group position-relative col-xl-12">
                                                                            <label class="file">
                                                                                <input type="file" class="upload-photo"
                                                                                    name="photo" id="file"
                                                                                    aria-label="File browser example">
                                                                                <span
                                                                                    class="file-custom text-left">{{ __('Upload Image...') }}</span>
                                                                            </label>
                                                                        </div>

                                                                        <div class="form-group">
                                                                            <label for="name">{{ __('Enter Name') }}
                                                                                *</label>
                                                                            <input type="text" class="form-control"
                                                                                name="name" id="name"
                                                                                value="{{ $flutterwave->name }}">
                                                                        </div>

                                                                        @foreach ($flutterwaveData as $pkey => $flutterwaveData)
                                                                            @if ($pkey == 'check_sandbox')
                                                                                <div class="form-group  col-xl-4 col-md-6">
                                                                                    <div
                                                                                        class="custom-control custom-checkbox">
                                                                                        <input type="checkbox"
                                                                                            name="pkey[{{ __($pkey) }}]"
                                                                                            class="custom-control-input"
                                                                                            {{ $flutterwaveData->status == 1 ? 'checked' : '' }}
                                                                                            id="mer{{ $pkey }}">
                                                                                        <label class="custom-control-label"
                                                                                            for="mer{{ $pkey }}">
                                                                                            {{ __($flutterwave->name . ' ' . ucwords(str_replace('_', ' ', $pkey))) }}
                                                                                        </label>
                                                                                    </div>
                                                                                </div>
                                                                            @else
                                                                                <div class="form-group col-xl-12">
                                                                                    <label
                                                                                        for="inp-{{ __($pkey) }}">{{ __($flutterwave->name . ' ' . ucwords(str_replace('_', ' ', $pkey))) }}</label>
                                                                                    <input type="text"
                                                                                        class="form-control"
                                                                                        id="inp-{{ __($pkey) }}"
                                                                                        name="pkey[{{ __($pkey) }}]"
                                                                                        placeholder="{{ __($flutterwave->name . ' ' . ucwords(str_replace('_', ' ', $pkey))) }}"
                                                                                        value="{{ $flutterwaveData }}"
                                                                                        required>
                                                                                </div>
                                                                            @endif
                                                                        @endforeach
                                                                        <div class="form-group">
                                                                            <label for="text">{{ __('Enter Text') }}
                                                                                *</label>
                                                                            <textarea name="text" id="text" class="form-control " rows="5"
                                                                                placeholder="{{ __('Enter Text') }}">{{ $flutterwave->text }}</textarea>
                                                                        </div>
                                                                        <input type="hidden" name="unique_keyword"
                                                                            value="flutterwave">
                                                                    </div>
                                                                    <div>
                                                                        <div
                                                                            class="form-group d-flex justify-content-center">
                                                                            <button type="submit"
                                                                                class="btn btn-secondary btn-block w-50">{{ __('Submit') }}</button>
                                                                        </div>
                                                                    </div>
                                                                </form>
                                                            </div>
                                                        </div>
                                                    </div>



                                                    <div id="paytabs" class="container tab-pane"><br>
                                                        <div class="row justify-content-center">
                                                            <div class="col-lg-8">
                                                                <form action="{{ route('back.setting.payment.update') }}"
                                                                    method="POST" enctype="multipart/form-data">

                                                                    @csrf

                                                                    <div class="form-group">
                                                                        <label class="switch-primary">
                                                                            <input type="checkbox"
                                                                                class="switch switch-bootstrap "
                                                                                name="status" value="1"
                                                                                {{ $paytabs->status == 1 ? 'checked' : '' }}>
                                                                            <span class="switch-body"></span>
                                                                            <span
                                                                                class="switch-text">{{ __('Display Paytabs') }}</span>
                                                                        </label>
                                                                    </div>

                                                                    <div
                                                                        class="image-show {{ $paytabs->status == 1 ? '' : 'd-none' }}">

                                                                        <div class="form-group col-xl-12">
                                                                            <label
                                                                                for="name">{{ __('Current Image') }}</label>
                                                                            <div class="col-lg-12 pb-1">
                                                                                <img class="admin-setting-img"
                                                                                    src="{{ $paytabs->photo ? url('/core/public/storage/images/' . $flutterwave->photo) : url('/core/public/storage/images/placeholder.png') }}"
                                                                                    stripe="No Image Found">
                                                                            </div>
                                                                            <span>{{ __('Image Size Should Be 52 x 35.') }}</span>
                                                                        </div>

                                                                        <div
                                                                            class="form-group position-relative col-xl-12">
                                                                            <label class="file">
                                                                                <input type="file" class="upload-photo"
                                                                                    name="photo" id="file"
                                                                                    aria-label="File browser example">
                                                                                <span
                                                                                    class="file-custom text-left">{{ __('Upload Image...') }}</span>
                                                                            </label>
                                                                        </div>

                                                                        <div class="form-group">
                                                                            <label for="name">{{ __('Enter Name') }}
                                                                                *</label>
                                                                            <input type="text" class="form-control"
                                                                                name="name" id="name"
                                                                                value="{{ $paytabs->name }}">
                                                                        </div>

                                                                        @foreach ($paytabsData as $pakey => $paytabsData)
                                                                            @if ($pakey == 'check_sandbox')
                                                                                <div class="form-group  col-xl-4 col-md-6">
                                                                                    <div
                                                                                        class="custom-control custom-checkbox">
                                                                                        <input type="checkbox"
                                                                                            name="pkey[{{ __($pakey) }}]"
                                                                                            class="custom-control-input"
                                                                                            {{ @$paytabsData == 1 ? 'checked' : '' }}
                                                                                            id="pay{{ $pakey }}">
                                                                                        <label class="custom-control-label"
                                                                                            for="pay{{ $pakey }}">
                                                                                            {{ __($paytabs->name . ' ' . ucwords(str_replace('_', ' ', $pakey))) }}
                                                                                        </label>
                                                                                    </div>
                                                                                </div>
                                                                            @else
                                                                                <div class="form-group col-xl-12">
                                                                                    <label
                                                                                        for="inp-{{ __($pakey) }}">{{ __($paytabs->name . ' ' . ucwords(str_replace('_', ' ', $pakey))) }}</label>
                                                                                    <input type="text"
                                                                                        class="form-control"
                                                                                        id="inp-{{ __($pakey) }}"
                                                                                        name="pkey[{{ __($pakey) }}]"
                                                                                        placeholder="{{ __($paytabs->name . ' ' . ucwords(str_replace('_', ' ', $pakey))) }}"
                                                                                        value="{{ $paytabsData }}"
                                                                                        required>
                                                                                </div>
                                                                            @endif
                                                                        @endforeach
                                                                        <div class="form-group">
                                                                            <label for="text">{{ __('Enter Text') }}
                                                                                *</label>
                                                                            <textarea name="text" id="text" class="form-control " rows="5"
                                                                                placeholder="{{ __('Enter Text') }}">{{ $paytabs->text }}</textarea>
                                                                        </div>
                                                                        <input type="hidden" name="unique_keyword"
                                                                            value="paytabs">
                                                                    </div>
                                                                    <div>
                                                                         <div
                                                                            class="form-group d-flex justify-content-center">
                                                                            <button type="submit"
                                                                                class="btn btn-secondary btn-block w-50">{{ __('Submit') }}</button>
                                                                        </div>
                                                                    </div>
                                                                </form>
                                                            </div>
                                                        </div>
                                                    </div>


                                                    {{-- CASHFREE TAB PANE --}}
                                                    <div id="cashfree" class="container tab-pane"><br>
                                                        <div class="row justify-content-center">
                                                            <div class="col-lg-8">
                                                                <form action="{{ route('back.setting.payment.update') }}"
                                                                    method="POST" enctype="multipart/form-data">
                                                                    @csrf

                                                                    <div class="form-group">
                                                                        <label class="switch-primary">
                                                                            <input type="checkbox"
                                                                                class="switch switch-bootstrap"
                                                                                name="status" value="1"
                                                                                {{ $cashfree->status == 1 ? 'checked' : '' }}>
                                                                            <span class="switch-body"></span>
                                                                            <span class="switch-text">{{ __('Display Cashfree') }}</span>
                                                                        </label>
                                                                    </div>

                                                                    <div class="image-show {{ $cashfree->status == 1 ? '' : 'd-none' }}">
                                                                        <div class="form-group col-xl-12">
                                                                            <label for="cashfree_name">{{ __('Current Image') }}</label>
                                                                            <div class="col-lg-12 pb-1">
                                                                                <img class="admin-setting-img"
                                                                                    src="{{ $cashfree->photo ? url('/core/public/storage/images/' . $cashfree->photo) : url('/core/public/storage/images/placeholder.png') }}"
                                                                                    alt="Cashfree Image">
                                                                            </div>
                                                                            <span>{{ __('Image Size Should Be 52 x 35.') }}</span>
                                                                        </div>

                                                                        <div class="form-group position-relative col-xl-12">
                                                                            <label class="file">
                                                                                <input type="file" class="upload-photo"
                                                                                    name="photo" id="cashfree_photo"
                                                                                    aria-label="File browser example">
                                                                                <span class="file-custom text-left">{{ __('Upload Image...') }}</span>
                                                                            </label>
                                                                        </div>

                                                                        <div class="form-group">
                                                                            <label for="cashfree_display_name">{{ __('Enter Name') }} *</label>
                                                                            <input type="text" class="form-control"
                                                                                name="name" id="cashfree_display_name"
                                                                                value="{{ $cashfree->name }}" required>
                                                                        </div>

                                                                        <div class="form-group col-xl-12">
                                                                            <label for="cashfree_app_id">{{ __('Cashfree App ID (Client ID)') }} *</label>
                                                                            <input type="text"
                                                                                class="form-control"
                                                                                id="cashfree_app_id"
                                                                                name="pkey[app_id]"
                                                                                placeholder="Enter your Cashfree App ID / Client ID"
                                                                                value="{{ $cashfreeData['app_id'] ?? '' }}"
                                                                                required>
                                                                        </div>

                                                                        <div class="form-group col-xl-12">
                                                                            <label for="cashfree_secret_key">{{ __('Cashfree Secret Key') }} *</label>
                                                                            <input type="text"
                                                                                class="form-control"
                                                                                id="cashfree_secret_key"
                                                                                name="pkey[secret_key]"
                                                                                placeholder="Enter your Cashfree Secret Key"
                                                                                value="{{ $cashfreeData['secret_key'] ?? '' }}"
                                                                                required>
                                                                        </div>

                                                                        <div class="form-group col-xl-12">
                                                                            <div class="custom-control custom-checkbox">
                                                                                <input type="checkbox"
                                                                                    name="pkey[check_sandbox]"
                                                                                    class="custom-control-input"
                                                                                    value="1"
                                                                                    {{ (!isset($cashfreeData['check_sandbox']) || $cashfreeData['check_sandbox'] == 1) ? 'checked' : '' }}
                                                                                    id="cashfree_sandbox">
                                                                                <label class="custom-control-label font-weight-bold"
                                                                                    for="cashfree_sandbox">
                                                                                    {{ __('Enable Sandbox / Test Mode') }}
                                                                                </label>
                                                                            </div>
                                                                            <small class="text-muted d-block mt-1">Uncheck when you are ready to process real transactions using Production API keys.</small>
                                                                        </div>

                                                                        <!-- API Connectivity Tester Widget -->
                                                                        <div class="col-xl-12 mb-3">
                                                                            <div class="p-3 border rounded-3 bg-light d-flex flex-column gap-2">
                                                                                <div class="d-flex align-items-center justify-content-between flex-wrap gap-2">
                                                                                    <div>
                                                                                        <h6 class="mb-0 font-weight-bold text-dark"><i class="fa-solid fa-satellite-dish text-primary mr-1"></i> {{ __('Verify API Connectivity') }}</h6>
                                                                                        <small class="text-muted">{{ __('Test if your App ID and Secret Key connect successfully to Cashfree servers.') }}</small>
                                                                                    </div>
                                                                                    <button type="button" class="btn btn-sm btn-outline-primary" id="btn_test_cashfree">
                                                                                        <i class="fa-solid fa-plug mr-1"></i> <span id="test_btn_text">{{ __('Test Connection') }}</span>
                                                                                    </button>
                                                                                </div>
                                                                                <div id="cashfree_test_result" class="d-none mt-2"></div>
                                                                            </div>
                                                                        </div>

                                                                        <div class="form-group">
                                                                            <label for="cashfree_text">{{ __('Enter Text') }} *</label>
                                                                            <textarea name="text" id="cashfree_text" class="form-control" rows="4"
                                                                                placeholder="{{ __('Enter Text') }}">{{ $cashfree->text }}</textarea>
                                                                        </div>

                                                                        <input type="hidden" name="unique_keyword" value="cashfree">
                                                                    </div>

                                                                    <div>
                                                                        <div class="form-group d-flex justify-content-center">
                                                                            <button type="submit"
                                                                                class="btn btn-secondary btn-block w-50">{{ __('Submit') }}</button>
                                                                        </div>
                                                                    </div>
                                                                </form>
                                                            </div>
                                                        </div>
                                                    </div>



                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>

        </div>
    @endsection

    @section('scripts')
    <script>
        $(document).on('click', '#btn_test_cashfree', function(e) {
            e.preventDefault();
            var $btn = $(this);
            var $btnText = $('#test_btn_text');
            var $resultBox = $('#cashfree_test_result');

            var appId = $('#cashfree_app_id').val();
            var secretKey = $('#cashfree_secret_key').val();
            var isSandbox = $('#cashfree_sandbox').is(':checked') ? 1 : 0;

            if (!appId || !secretKey) {
                $resultBox.removeClass('d-none alert-success').addClass('alert alert-warning').html('<i class="fa-solid fa-triangle-exclamation mr-1"></i> Please fill in both Cashfree App ID and Secret Key above before testing.');
                return;
            }

            $btn.prop('disabled', true);
            $btnText.text('Testing...');
            $resultBox.removeClass('d-none alert-success alert-danger alert-warning').addClass('alert alert-info').html('<i class="fa-solid fa-spinner fa-spin mr-1"></i> Connecting to Cashfree ' + (isSandbox ? 'Sandbox' : 'Production') + ' API...');

            $.ajax({
                url: "{{ route('back.setting.payment.cashfree.test') }}",
                type: "POST",
                data: {
                    _token: "{{ csrf_token() }}",
                    app_id: appId,
                    secret_key: secretKey,
                    check_sandbox: isSandbox
                },
                success: function(response) {
                    $btn.prop('disabled', false);
                    $btnText.text('Test Connection');
                    if (response.status) {
                        $resultBox.removeClass('alert-info alert-danger alert-warning').addClass('alert alert-success').html('<i class="fa-solid fa-circle-check mr-1"></i> ' + response.message);
                    } else {
                        $resultBox.removeClass('alert-info alert-success alert-warning').addClass('alert alert-danger').html('<i class="fa-solid fa-circle-xmark mr-1"></i> ' + response.message);
                    }
                },
                error: function(xhr) {
                    $btn.prop('disabled', false);
                    $btnText.text('Test Connection');
                    $resultBox.removeClass('alert-info alert-success alert-warning').addClass('alert alert-danger').html('<i class="fa-solid fa-triangle-exclamation mr-1"></i> Request failed with status ' + xhr.status + ': ' + (xhr.responseJSON ? xhr.responseJSON.message : xhr.statusText));
                }
            });
        });
    </script>
    @endsection
