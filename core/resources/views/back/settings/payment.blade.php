@extends('master.back')

@section('styles')
<style>
    /* Payment Page Redesign Styles */
    .payment-header-card {
        background: #ffffff;
        border: 1px solid #e2e8f0;
        border-radius: 16px;
        padding: 20px 24px;
        box-shadow: 0 2px 10px rgba(0, 0, 0, 0.03);
        margin-bottom: 24px;
        display: flex;
        align-items: center;
        justify-content: space-between;
        flex-wrap: wrap;
        gap: 16px;
    }

    .payment-header-left {
        display: flex;
        align-items: center;
        gap: 16px;
    }

    .payment-header-icon {
        width: 48px;
        height: 48px;
        border-radius: 14px;
        background: #f0fdf4;
        border: 1px solid #dcfce7;
        color: #10b981;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        font-size: 22px;
        flex-shrink: 0;
    }

    .payment-header-title {
        font-size: 20px;
        font-weight: 800;
        color: #0f172a;
        margin: 0 0 4px;
        line-height: 1.2;
    }

    .payment-header-desc {
        font-size: 13.5px;
        color: #64748b;
        margin: 0;
    }

    /* Gateway Nav Pills */
    .gateway-nav-card {
        background: #ffffff;
        border: 1px solid #e2e8f0;
        border-radius: 16px;
        padding: 14px;
        box-shadow: 0 2px 10px rgba(0, 0, 0, 0.03);
    }

    .gateway-nav-title {
        font-size: 11px;
        font-weight: 800;
        text-transform: uppercase;
        letter-spacing: 0.08em;
        color: #94a3b8;
        padding: 6px 12px 10px;
        margin: 0;
    }

    .gateway-nav-pills .nav-link {
        display: flex !important;
        align-items: center !important;
        justify-content: space-between !important;
        padding: 12px 14px !important;
        border-radius: 12px !important;
        margin-bottom: 6px !important;
        background: transparent !important;
        border: 1px solid transparent !important;
        transition: all 0.22s cubic-bezier(0.4, 0, 0.2, 1) !important;
        text-decoration: none !important;
    }

    .gateway-nav-pills .nav-link:hover {
        background: #f0fdf4 !important;
        border-color: #dcfce7 !important;
        transform: translateX(3px);
    }

    .gateway-nav-pills .nav-link.active {
        background: linear-gradient(135deg, #10b981 0%, #059669 100%) !important;
        border-color: transparent !important;
        box-shadow: 0 6px 18px -2px rgba(16, 185, 129, 0.4) !important;
        transform: translateX(3px);
    }

    .gateway-nav-pills .nav-link .pill-left {
        display: flex;
        align-items: center;
        gap: 12px;
        min-width: 0;
    }

    .gateway-nav-pills .nav-link .pill-icon {
        width: 36px;
        height: 36px;
        min-width: 36px;
        border-radius: 10px;
        background: #f8fafc;
        border: 1px solid #e2e8f0;
        color: #059669;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        font-size: 15px;
        transition: all 0.2s ease;
    }

    .gateway-nav-pills .nav-link:hover .pill-icon {
        background: #ffffff;
        color: #047857;
        border-color: #bbf7d0;
    }

    .gateway-nav-pills .nav-link.active .pill-icon {
        background: rgba(255, 255, 255, 0.25);
        border-color: rgba(255, 255, 255, 0.35);
        color: #ffffff;
    }

    .gateway-nav-pills .nav-link .pill-info {
        display: flex;
        flex-direction: column;
        text-align: left;
        min-width: 0;
    }

    .gateway-nav-pills .nav-link .pill-name {
        font-size: 13.5px;
        font-weight: 700;
        color: #1e293b;
        line-height: 1.25;
        white-space: nowrap;
        overflow: hidden;
        text-overflow: ellipsis;
    }

    .gateway-nav-pills .nav-link .pill-desc {
        font-size: 11px;
        color: #64748b;
        font-weight: 500;
        margin-top: 2px;
        white-space: nowrap;
        overflow: hidden;
        text-overflow: ellipsis;
    }

    .gateway-nav-pills .nav-link:hover .pill-name {
        color: #0f172a;
    }

    .gateway-nav-pills .nav-link.active .pill-name {
        color: #ffffff;
    }

    .gateway-nav-pills .nav-link.active .pill-desc {
        color: rgba(255, 255, 255, 0.85);
    }

    .gateway-nav-pills .nav-link .pill-status-dot {
        width: 8px;
        height: 8px;
        min-width: 8px;
        border-radius: 50%;
        background: #cbd5e1;
        transition: all 0.2s ease;
    }

    .gateway-nav-pills .nav-link.is-enabled .pill-status-dot {
        background: #10b981;
        box-shadow: 0 0 6px rgba(16, 185, 129, 0.6);
    }

    .gateway-nav-pills .nav-link.active .pill-status-dot {
        background: #ffffff;
        box-shadow: 0 0 8px rgba(255, 255, 255, 0.8);
    }

    /* Gateway Content Form Card */
    .gateway-content-card {
        background: #ffffff;
        border: 1px solid #e2e8f0;
        border-radius: 16px;
        padding: 24px;
        box-shadow: 0 2px 10px rgba(0, 0, 0, 0.03);
    }

    .gateway-card-top {
        display: flex;
        align-items: center;
        justify-content: space-between;
        flex-wrap: wrap;
        gap: 16px;
        padding-bottom: 20px;
        margin-bottom: 22px;
        border-bottom: 1px solid #f1f5f9;
    }

    .gateway-card-brand {
        display: flex;
        align-items: center;
        gap: 14px;
    }

    .gateway-brand-badge {
        width: 44px;
        height: 44px;
        border-radius: 12px;
        background: #f0fdf4;
        border: 1px solid #dcfce7;
        color: #10b981;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        font-size: 20px;
    }

    .gateway-brand-title {
        font-size: 18px;
        font-weight: 800;
        color: #0f172a;
        margin: 0 0 2px;
    }

    .gateway-brand-subtitle {
        font-size: 12.5px;
        color: #64748b;
        margin: 0;
    }

    /* Toggle Status Box */
    .gateway-toggle-box {
        display: inline-flex;
        align-items: center;
        background: #f8fafc;
        border: 1px solid #e2e8f0;
        border-radius: 12px;
        padding: 8px 14px;
        gap: 12px;
    }

    .gateway-toggle-box .switch-primary {
        margin-bottom: 0;
        display: inline-flex;
        align-items: center;
        height: 26px;
        position: relative;
    }

    .gateway-toggle-box .switch-primary .switch-body {
        margin: 0 !important;
        float: none !important;
        background: transparent !important;
        border: none !important;
        box-shadow: none !important;
    }

    .gateway-toggle-label {
        font-size: 13px;
        font-weight: 700;
        color: #1e293b;
        user-select: none;
    }

    /* Form Section Block */
    .gateway-form-section {
        background: #f8fafc;
        border: 1px solid #e2e8f0;
        border-radius: 14px;
        padding: 18px 20px;
        margin-bottom: 20px;
    }

    .gateway-section-title {
        font-size: 13.5px;
        font-weight: 700;
        color: #0f172a;
        margin-bottom: 14px;
        display: flex;
        align-items: center;
        gap: 8px;
    }

    .gateway-section-title i {
        color: #10b981;
    }

    .gateway-image-preview-wrapper {
        display: flex;
        align-items: center;
        gap: 16px;
        flex-wrap: wrap;
    }

    .gateway-image-box {
        width: 80px;
        height: 52px;
        background: #ffffff;
        border: 1px solid #cbd5e1;
        border-radius: 10px;
        padding: 4px;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        box-shadow: 0 1px 3px rgba(0, 0, 0, 0.05);
    }

    .gateway-image-box img {
        max-width: 100%;
        max-height: 100%;
        object-fit: contain;
    }

    .gateway-helper-pill {
        font-size: 12px;
        color: #64748b;
        background: #ffffff;
        border: 1px solid #e2e8f0;
        border-radius: 8px;
        padding: 4px 10px;
        display: inline-flex;
        align-items: center;
        gap: 6px;
    }

    .sandbox-toggle-card {
        background: #ffffff;
        border: 1px solid #e2e8f0;
        border-radius: 12px;
        padding: 12px 16px;
        display: flex;
        align-items: center;
        justify-content: space-between;
        margin-top: 10px;
    }
</style>
@endsection

@section('content')
<div class="container-fluid">

    <!-- Payment Settings Top Banner -->
    <div class="payment-header-card">
        <div class="payment-header-left">
            <div class="payment-header-icon">
                <i class="fa-solid fa-credit-card"></i>
            </div>
            <div>
                <h1 class="payment-header-title">{{ __('Payment Methods & Gateways') }}</h1>
                <p class="payment-header-desc">{{ __('Manage active checkout gateways, API keys, and Cash on Delivery settings.') }}</p>
            </div>
        </div>
        <div>
            @php
                $activeCount = 0;
                if(isset($cod) && $cod->status == 1) $activeCount++;
                if(isset($stripe) && $stripe->status == 1) $activeCount++;
                if(isset($razorpay) && $razorpay->status == 1) $activeCount++;
                if(isset($paypal) && $paypal->status == 1) $activeCount++;
                if(isset($paytm) && $paytm->status == 1) $activeCount++;
                if(isset($cashfree) && $cashfree->status == 1) $activeCount++;
            @endphp
            <span class="badge badge-success px-3 py-2" style="font-size: 12.5px; border-radius: 999px;">
                <i class="fa-solid fa-circle-check mr-1"></i> {{ $activeCount }} {{ __('of 6 Gateways Enabled') }}
            </span>
        </div>
    </div>

    @include('alerts.alerts')

    <!-- Main Payment Settings Layout -->
    <div class="row">

        <!-- Left Navigation: 6 Selected Gateways Only -->
        <div class="col-lg-4 col-xl-3 mb-4 mb-lg-0">
            <div class="gateway-nav-card">
                <h6 class="gateway-nav-title">{{ __('Available Gateways') }}</h6>
                <div class="nav flex-column gateway-nav-pills" id="payment-gateways-tab" role="tablist" aria-orientation="vertical">

                    <!-- 1. Cash on Delivery -->
                    <a class="nav-link active {{ ($cod && $cod->status == 1) ? 'is-enabled' : '' }}" data-toggle="pill" href="#cod" role="tab">
                        <div class="pill-left">
                            <div class="pill-icon"><i class="fa-solid fa-hand-holding-dollar"></i></div>
                            <div class="pill-info">
                                <span class="pill-name">{{ __('Cash On Delivery') }}</span>
                                <span class="pill-desc">{{ __('Pay upon receipt') }}</span>
                            </div>
                        </div>
                        <span class="pill-status-dot" title="{{ ($cod && $cod->status == 1) ? 'Active' : 'Disabled' }}"></span>
                    </a>

                    <!-- 2. Stripe -->
                    <a class="nav-link {{ ($stripe && $stripe->status == 1) ? 'is-enabled' : '' }}" data-toggle="pill" href="#stripe" role="tab">
                        <div class="pill-left">
                            <div class="pill-icon"><i class="fa-brands fa-stripe"></i></div>
                            <div class="pill-info">
                                <span class="pill-name">{{ __('Stripe') }}</span>
                                <span class="pill-desc">{{ __('Cards & Wallets') }}</span>
                            </div>
                        </div>
                        <span class="pill-status-dot" title="{{ ($stripe && $stripe->status == 1) ? 'Active' : 'Disabled' }}"></span>
                    </a>

                    <!-- 3. Razorpay -->
                    <a class="nav-link {{ ($razorpay && $razorpay->status == 1) ? 'is-enabled' : '' }}" data-toggle="pill" href="#razorpay" role="tab">
                        <div class="pill-left">
                            <div class="pill-icon"><i class="fa-solid fa-credit-card"></i></div>
                            <div class="pill-info">
                                <span class="pill-name">{{ __('Razorpay') }}</span>
                                <span class="pill-desc">{{ __('UPI, Cards & NetBanking') }}</span>
                            </div>
                        </div>
                        <span class="pill-status-dot" title="{{ ($razorpay && $razorpay->status == 1) ? 'Active' : 'Disabled' }}"></span>
                    </a>

                    <!-- 4. PayPal -->
                    <a class="nav-link {{ ($paypal && $paypal->status == 1) ? 'is-enabled' : '' }}" data-toggle="pill" href="#paypal" role="tab">
                        <div class="pill-left">
                            <div class="pill-icon"><i class="fa-brands fa-paypal"></i></div>
                            <div class="pill-info">
                                <span class="pill-name">{{ __('PayPal') }}</span>
                                <span class="pill-desc">{{ __('Global PayPal Payments') }}</span>
                            </div>
                        </div>
                        <span class="pill-status-dot" title="{{ ($paypal && $paypal->status == 1) ? 'Active' : 'Disabled' }}"></span>
                    </a>

                    <!-- 5. Paytm -->
                    <a class="nav-link {{ ($paytm && $paytm->status == 1) ? 'is-enabled' : '' }}" data-toggle="pill" href="#paytm" role="tab">
                        <div class="pill-left">
                            <div class="pill-icon"><i class="fa-solid fa-wallet"></i></div>
                            <div class="pill-info">
                                <span class="pill-name">{{ __('Paytm') }}</span>
                                <span class="pill-desc">{{ __('Paytm Wallet & Indian UPI') }}</span>
                            </div>
                        </div>
                        <span class="pill-status-dot" title="{{ ($paytm && $paytm->status == 1) ? 'Active' : 'Disabled' }}"></span>
                    </a>

                    <!-- 6. Cashfree -->
                    <a class="nav-link {{ ($cashfree && $cashfree->status == 1) ? 'is-enabled' : '' }}" data-toggle="pill" href="#cashfree" role="tab">
                        <div class="pill-left">
                            <div class="pill-icon"><i class="fa-solid fa-bolt"></i></div>
                            <div class="pill-info">
                                <span class="pill-name">{{ __('Cashfree') }}</span>
                                <span class="pill-desc">{{ __('Instant PG, UPI & Cards') }}</span>
                            </div>
                        </div>
                        <span class="pill-status-dot" title="{{ ($cashfree && $cashfree->status == 1) ? 'Active' : 'Disabled' }}"></span>
                    </a>

                </div>
            </div>
        </div>

        <!-- Right Side: Active Gateway Form Panels -->
        <div class="col-lg-8 col-xl-9">
            <div class="tab-content" id="payment-gateways-content">

                {{-- 1. CASH ON DELIVERY TAB --}}
                <div id="cod" class="tab-pane fade show active" role="tabpanel">
                    <div class="gateway-content-card">
                        <form action="{{ route('back.setting.payment.update') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <input type="hidden" name="unique_keyword" value="cod">

                            <div class="gateway-card-top">
                                <div class="gateway-card-brand">
                                    <div class="gateway-brand-badge">
                                        <i class="fa-solid fa-hand-holding-dollar"></i>
                                    </div>
                                    <div>
                                        <h3 class="gateway-brand-title">{{ __('Cash On Delivery') }}</h3>
                                        <p class="gateway-brand-subtitle">{{ __('Allow customers to pay in cash upon package delivery.') }}</p>
                                    </div>
                                </div>
                                <div class="gateway-toggle-box">
                                    <span class="gateway-toggle-label">{{ __('Display on Checkout') }}</span>
                                    <label class="switch-primary">
                                        <input type="checkbox" class="switch switch-bootstrap" name="status" value="1" {{ ($cod && $cod->status == 1) ? 'checked' : '' }}>
                                        <span class="switch-body"></span>
                                    </label>
                                </div>
                            </div>

                            <div class="image-show {{ ($cod && $cod->status == 1) ? '' : 'd-none' }}">
                                <div class="gateway-form-section">
                                    <h6 class="gateway-section-title"><i class="fa-solid fa-image"></i> {{ __('Gateway Image & Logo') }}</h6>
                                    <div class="gateway-image-preview-wrapper mb-3">
                                        <div class="gateway-image-box">
                                            <img src="{{ ($cod && $cod->photo) ? url('/core/public/storage/images/' . $cod->photo) : url('/core/public/storage/images/placeholder.png') }}" alt="COD Logo">
                                        </div>
                                        <div>
                                            <label class="file mb-2">
                                                <input type="file" accept="image/*" class="upload-photo" name="photo" id="cod_photo">
                                                <span class="file-custom">{{ __('Choose New Image...') }}</span>
                                            </label>
                                            <div class="gateway-helper-pill">
                                                <i class="fa-solid fa-circle-info"></i> {{ __('Recommended Size: 52 x 35 px (PNG, SVG, JPG)') }}
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="gateway-form-section">
                                    <h6 class="gateway-section-title"><i class="fa-solid fa-pen-to-square"></i> {{ __('General Information') }}</h6>
                                    <div class="form-group mb-3">
                                        <label for="cod_name" class="font-weight-bold">{{ __('Display Name on Checkout') }} <span class="text-danger">*</span></label>
                                        <input type="text" class="form-control" name="name" id="cod_name" value="{{ $cod->name ?? 'Cash On Delivery' }}" required>
                                    </div>

                                    <div class="form-group mb-0">
                                        <label for="cod_text" class="font-weight-bold">{{ __('Customer Instructions / Description') }}</label>
                                        <textarea name="text" id="cod_text" class="form-control" rows="4" placeholder="{{ __('Enter checkout instructions for customers...') }}">{{ $cod->text ?? '' }}</textarea>
                                    </div>
                                </div>
                            </div>

                            <div class="mt-4 text-right">
                                <button type="submit" class="btn btn-primary px-4 py-2" style="border-radius: 10px; font-weight: 700;">
                                    <i class="fa-solid fa-floppy-disk mr-2"></i> {{ __('Save COD Settings') }}
                                </button>
                            </div>
                        </form>
                    </div>
                </div>

                {{-- 2. STRIPE TAB --}}
                <div id="stripe" class="tab-pane fade" role="tabpanel">
                    <div class="gateway-content-card">
                        <form action="{{ route('back.setting.payment.update') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <input type="hidden" name="unique_keyword" value="stripe">

                            <div class="gateway-card-top">
                                <div class="gateway-card-brand">
                                    <div class="gateway-brand-badge">
                                        <i class="fa-brands fa-stripe"></i>
                                    </div>
                                    <div>
                                        <h3 class="gateway-brand-title">{{ __('Stripe Payment Gateway') }}</h3>
                                        <p class="gateway-brand-subtitle">{{ __('Accept credit cards, Apple Pay, Google Pay, and global payments.') }}</p>
                                    </div>
                                </div>
                                <div class="gateway-toggle-box">
                                    <span class="gateway-toggle-label">{{ __('Display on Checkout') }}</span>
                                    <label class="switch-primary">
                                        <input type="checkbox" class="switch switch-bootstrap" name="status" value="1" {{ ($stripe && $stripe->status == 1) ? 'checked' : '' }}>
                                        <span class="switch-body"></span>
                                    </label>
                                </div>
                            </div>

                            <div class="image-show {{ ($stripe && $stripe->status == 1) ? '' : 'd-none' }}">
                                <div class="gateway-form-section">
                                    <h6 class="gateway-section-title"><i class="fa-solid fa-image"></i> {{ __('Gateway Image & Logo') }}</h6>
                                    <div class="gateway-image-preview-wrapper mb-3">
                                        <div class="gateway-image-box">
                                            <img src="{{ ($stripe && $stripe->photo) ? url('/core/public/storage/images/' . $stripe->photo) : url('/core/public/storage/images/placeholder.png') }}" alt="Stripe Logo">
                                        </div>
                                        <div>
                                            <label class="file mb-2">
                                                <input type="file" accept="image/*" class="upload-photo" name="photo" id="stripe_photo">
                                                <span class="file-custom">{{ __('Choose New Image...') }}</span>
                                            </label>
                                            <div class="gateway-helper-pill">
                                                <i class="fa-solid fa-circle-info"></i> {{ __('Recommended Size: 52 x 35 px (PNG, SVG, JPG)') }}
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="gateway-form-section">
                                    <h6 class="gateway-section-title"><i class="fa-solid fa-key"></i> {{ __('Stripe API Credentials') }}</h6>
                                    <div class="form-group mb-3">
                                        <label for="stripe_name" class="font-weight-bold">{{ __('Display Name on Checkout') }} <span class="text-danger">*</span></label>
                                        <input type="text" class="form-control" name="name" id="stripe_name" value="{{ $stripe->name ?? 'Stripe' }}" required>
                                    </div>

                                    @foreach ($stripeData as $pkey => $pdata)
                                        <div class="form-group mb-3">
                                            <label for="inp-stripe-{{ $pkey }}" class="font-weight-bold">
                                                {{ ($pkey == 'key') ? __('Stripe Publishable Key') : (($pkey == 'secret') ? __('Stripe Secret Key') : ucwords(str_replace('_', ' ', $pkey))) }}
                                                <span class="text-danger">*</span>
                                            </label>
                                            <input type="text" class="form-control" id="inp-stripe-{{ $pkey }}" name="pkey[{{ $pkey }}]" placeholder="{{ ($pkey == 'key') ? 'pk_live_...' : 'sk_live_...' }}" value="{{ $pdata }}" required>
                                        </div>
                                    @endforeach

                                    <div class="form-group mb-0">
                                        <label for="stripe_text" class="font-weight-bold">{{ __('Customer Instructions / Description') }}</label>
                                        <textarea name="text" id="stripe_text" class="form-control" rows="3" placeholder="{{ __('Enter checkout instructions...') }}">{{ $stripe->text ?? '' }}</textarea>
                                    </div>
                                </div>
                            </div>

                            <div class="mt-4 text-right">
                                <button type="submit" class="btn btn-primary px-4 py-2" style="border-radius: 10px; font-weight: 700;">
                                    <i class="fa-solid fa-floppy-disk mr-2"></i> {{ __('Save Stripe Settings') }}
                                </button>
                            </div>
                        </form>
                    </div>
                </div>

                {{-- 3. RAZORPAY TAB --}}
                <div id="razorpay" class="tab-pane fade" role="tabpanel">
                    <div class="gateway-content-card">
                        <form action="{{ route('back.setting.payment.update') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <input type="hidden" name="unique_keyword" value="razorpay">

                            <div class="gateway-card-top">
                                <div class="gateway-card-brand">
                                    <div class="gateway-brand-badge">
                                        <i class="fa-solid fa-credit-card"></i>
                                    </div>
                                    <div>
                                        <h3 class="gateway-brand-title">{{ __('Razorpay Payment Gateway') }}</h3>
                                        <p class="gateway-brand-subtitle">{{ __('Accept UPI (GPay, PhonePe, Paytm), Cards, NetBanking & Wallets in India.') }}</p>
                                    </div>
                                </div>
                                <div class="gateway-toggle-box">
                                    <span class="gateway-toggle-label">{{ __('Display on Checkout') }}</span>
                                    <label class="switch-primary">
                                        <input type="checkbox" class="switch switch-bootstrap" name="status" value="1" {{ ($razorpay && $razorpay->status == 1) ? 'checked' : '' }}>
                                        <span class="switch-body"></span>
                                    </label>
                                </div>
                            </div>

                            <div class="image-show {{ ($razorpay && $razorpay->status == 1) ? '' : 'd-none' }}">
                                <div class="gateway-form-section">
                                    <h6 class="gateway-section-title"><i class="fa-solid fa-image"></i> {{ __('Gateway Image & Logo') }}</h6>
                                    <div class="gateway-image-preview-wrapper mb-3">
                                        <div class="gateway-image-box">
                                            <img src="{{ ($razorpay && $razorpay->photo) ? url('/core/public/storage/images/' . $razorpay->photo) : url('/core/public/storage/images/placeholder.png') }}" alt="Razorpay Logo">
                                        </div>
                                        <div>
                                            <label class="file mb-2">
                                                <input type="file" accept="image/*" class="upload-photo" name="photo" id="razorpay_photo">
                                                <span class="file-custom">{{ __('Choose New Image...') }}</span>
                                            </label>
                                            <div class="gateway-helper-pill">
                                                <i class="fa-solid fa-circle-info"></i> {{ __('Recommended Size: 52 x 35 px (PNG, SVG, JPG)') }}
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="gateway-form-section">
                                    <h6 class="gateway-section-title"><i class="fa-solid fa-key"></i> {{ __('Razorpay API Credentials') }}</h6>
                                    <div class="form-group mb-3">
                                        <label for="razorpay_name" class="font-weight-bold">{{ __('Display Name on Checkout') }} <span class="text-danger">*</span></label>
                                        <input type="text" class="form-control" name="name" id="razorpay_name" value="{{ $razorpay->name ?? 'Razorpay' }}" required>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-6 mb-3">
                                            <label for="inp-razorpay-key" class="font-weight-bold">{{ __('Razorpay Key ID') }} <span class="text-danger">*</span></label>
                                            <input type="text" class="form-control" id="inp-razorpay-key" name="pkey[key]" placeholder="rzp_live_..." value="{{ $razorpayData['key'] ?? '' }}" required>
                                        </div>
                                        <div class="col-md-6 mb-3">
                                            <label for="inp-razorpay-secret" class="font-weight-bold">{{ __('Razorpay Key Secret') }} <span class="text-danger">*</span></label>
                                            <input type="text" class="form-control" id="inp-razorpay-secret" name="pkey[secret]" placeholder="Enter Razorpay Key Secret" value="{{ $razorpayData['secret'] ?? '' }}" required>
                                        </div>
                                    </div>

                                    <div class="form-group mb-0">
                                        <label for="razorpay_text" class="font-weight-bold">{{ __('Customer Instructions / Description') }}</label>
                                        <textarea name="text" id="razorpay_text" class="form-control" rows="3" placeholder="{{ __('Enter checkout instructions...') }}">{{ $razorpay->text ?? '' }}</textarea>
                                    </div>
                                </div>
                            </div>

                            <div class="mt-4 text-right">
                                <button type="submit" class="btn btn-primary px-4 py-2" style="border-radius: 10px; font-weight: 700;">
                                    <i class="fa-solid fa-floppy-disk mr-2"></i> {{ __('Save Razorpay Settings') }}
                                </button>
                            </div>
                        </form>
                    </div>
                </div>

                {{-- 4. PAYPAL TAB --}}
                <div id="paypal" class="tab-pane fade" role="tabpanel">
                    <div class="gateway-content-card">
                        <form action="{{ route('back.setting.payment.update') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <input type="hidden" name="unique_keyword" value="paypal">

                            <div class="gateway-card-top">
                                <div class="gateway-card-brand">
                                    <div class="gateway-brand-badge">
                                        <i class="fa-brands fa-paypal"></i>
                                    </div>
                                    <div>
                                        <h3 class="gateway-brand-title">{{ __('PayPal Payment Gateway') }}</h3>
                                        <p class="gateway-brand-subtitle">{{ __('Enable global PayPal balance, credit cards, and Pay in 4 checkout.') }}</p>
                                    </div>
                                </div>
                                <div class="gateway-toggle-box">
                                    <span class="gateway-toggle-label">{{ __('Display on Checkout') }}</span>
                                    <label class="switch-primary">
                                        <input type="checkbox" class="switch switch-bootstrap" name="status" value="1" {{ ($paypal && $paypal->status == 1) ? 'checked' : '' }}>
                                        <span class="switch-body"></span>
                                    </label>
                                </div>
                            </div>

                            <div class="image-show {{ ($paypal && $paypal->status == 1) ? '' : 'd-none' }}">
                                <div class="gateway-form-section">
                                    <h6 class="gateway-section-title"><i class="fa-solid fa-image"></i> {{ __('Gateway Image & Logo') }}</h6>
                                    <div class="gateway-image-preview-wrapper mb-3">
                                        <div class="gateway-image-box">
                                            <img src="{{ ($paypal && $paypal->photo) ? url('/core/public/storage/images/' . $paypal->photo) : url('/core/public/storage/images/placeholder.png') }}" alt="PayPal Logo">
                                        </div>
                                        <div>
                                            <label class="file mb-2">
                                                <input type="file" accept="image/*" class="upload-photo" name="photo" id="paypal_photo">
                                                <span class="file-custom">{{ __('Choose New Image...') }}</span>
                                            </label>
                                            <div class="gateway-helper-pill">
                                                <i class="fa-solid fa-circle-info"></i> {{ __('Recommended Size: 52 x 35 px (PNG, SVG, JPG)') }}
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="gateway-form-section">
                                    <h6 class="gateway-section-title"><i class="fa-solid fa-key"></i> {{ __('PayPal API Credentials') }}</h6>
                                    <div class="form-group mb-3">
                                        <label for="paypal_name" class="font-weight-bold">{{ __('Display Name on Checkout') }} <span class="text-danger">*</span></label>
                                        <input type="text" class="form-control" name="name" id="paypal_name" value="{{ $paypal->name ?? 'PayPal' }}" required>
                                    </div>

                                    <div class="form-group mb-3">
                                        <label for="paypal_client_id" class="font-weight-bold">{{ __('PayPal Client ID') }} <span class="text-danger">*</span></label>
                                        <input type="text" class="form-control" id="paypal_client_id" name="pkey[client_id]" placeholder="Enter PayPal Client ID" value="{{ $paypalData['client_id'] ?? '' }}" required>
                                    </div>

                                    <div class="form-group mb-3">
                                        <label for="paypal_client_secret" class="font-weight-bold">{{ __('PayPal Client Secret') }} <span class="text-danger">*</span></label>
                                        <input type="text" class="form-control" id="paypal_client_secret" name="pkey[client_secret]" placeholder="Enter PayPal Client Secret" value="{{ $paypalData['client_secret'] ?? '' }}" required>
                                    </div>

                                    <div class="sandbox-toggle-card mb-3">
                                        <div>
                                            <h6 class="mb-0 font-weight-bold text-dark">{{ __('Enable Sandbox / Test Mode') }}</h6>
                                            <small class="text-muted">{{ __('Toggle off when you are ready to accept real payments with Live API credentials.') }}</small>
                                        </div>
                                        <div class="custom-control custom-checkbox">
                                            <input type="checkbox" name="pkey[check_sandbox]" class="custom-control-input" value="1" {{ (isset($paypalData['check_sandbox']) && $paypalData['check_sandbox'] == 1) ? 'checked' : '' }} id="paypal_sandbox">
                                            <label class="custom-control-label font-weight-bold" for="paypal_sandbox">{{ __('Sandbox Mode') }}</label>
                                        </div>
                                    </div>

                                    <div class="form-group mb-0">
                                        <label for="paypal_text" class="font-weight-bold">{{ __('Customer Instructions / Description') }}</label>
                                        <textarea name="text" id="paypal_text" class="form-control" rows="3" placeholder="{{ __('Enter checkout instructions...') }}">{{ $paypal->text ?? '' }}</textarea>
                                    </div>
                                </div>
                            </div>

                            <div class="mt-4 text-right">
                                <button type="submit" class="btn btn-primary px-4 py-2" style="border-radius: 10px; font-weight: 700;">
                                    <i class="fa-solid fa-floppy-disk mr-2"></i> {{ __('Save PayPal Settings') }}
                                </button>
                            </div>
                        </form>
                    </div>
                </div>

                {{-- 5. PAYTM TAB --}}
                <div id="paytm" class="tab-pane fade" role="tabpanel">
                    <div class="gateway-content-card">
                        <form action="{{ route('back.setting.payment.update') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <input type="hidden" name="unique_keyword" value="paytm">

                            <div class="gateway-card-top">
                                <div class="gateway-card-brand">
                                    <div class="gateway-brand-badge">
                                        <i class="fa-solid fa-wallet"></i>
                                    </div>
                                    <div>
                                        <h3 class="gateway-brand-title">{{ __('Paytm Payment Gateway') }}</h3>
                                        <p class="gateway-brand-subtitle">{{ __('Accept payments via Paytm Wallet, UPI, Cards and NetBanking.') }}</p>
                                    </div>
                                </div>
                                <div class="gateway-toggle-box">
                                    <span class="gateway-toggle-label">{{ __('Display on Checkout') }}</span>
                                    <label class="switch-primary">
                                        <input type="checkbox" class="switch switch-bootstrap" name="status" value="1" {{ ($paytm && $paytm->status == 1) ? 'checked' : '' }}>
                                        <span class="switch-body"></span>
                                    </label>
                                </div>
                            </div>

                            <div class="image-show {{ ($paytm && $paytm->status == 1) ? '' : 'd-none' }}">
                                <div class="gateway-form-section">
                                    <h6 class="gateway-section-title"><i class="fa-solid fa-image"></i> {{ __('Gateway Image & Logo') }}</h6>
                                    <div class="gateway-image-preview-wrapper mb-3">
                                        <div class="gateway-image-box">
                                            <img src="{{ ($paytm && $paytm->photo) ? url('/core/public/storage/images/' . $paytm->photo) : url('/core/public/storage/images/placeholder.png') }}" alt="Paytm Logo">
                                        </div>
                                        <div>
                                            <label class="file mb-2">
                                                <input type="file" accept="image/*" class="upload-photo" name="photo" id="paytm_photo">
                                                <span class="file-custom">{{ __('Choose New Image...') }}</span>
                                            </label>
                                            <div class="gateway-helper-pill">
                                                <i class="fa-solid fa-circle-info"></i> {{ __('Recommended Size: 52 x 35 px (PNG, SVG, JPG)') }}
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="gateway-form-section">
                                    <h6 class="gateway-section-title"><i class="fa-solid fa-key"></i> {{ __('Paytm Merchant Credentials') }}</h6>
                                    <div class="form-group mb-3">
                                        <label for="paytm_name" class="font-weight-bold">{{ __('Display Name on Checkout') }} <span class="text-danger">*</span></label>
                                        <input type="text" class="form-control" name="name" id="paytm_name" value="{{ $paytm->name ?? 'Paytm' }}" required>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-6 mb-3">
                                            <label for="paytm_merchant_id" class="font-weight-bold">{{ __('Merchant ID (MID)') }} <span class="text-danger">*</span></label>
                                            <input type="text" class="form-control" id="paytm_merchant_id" name="pkey[mercent]" placeholder="Enter Paytm Merchant ID" value="{{ $paytmData['mercent'] ?? '' }}" required>
                                        </div>
                                        <div class="col-md-6 mb-3">
                                            <label for="paytm_client_secret" class="font-weight-bold">{{ __('Merchant Key (Secret)') }} <span class="text-danger">*</span></label>
                                            <input type="text" class="form-control" id="paytm_client_secret" name="pkey[client_secret]" placeholder="Enter Paytm Merchant Key" value="{{ $paytmData['client_secret'] ?? '' }}" required>
                                        </div>
                                        <div class="col-md-6 mb-3">
                                            <label for="paytm_website" class="font-weight-bold">{{ __('Website Name') }} <span class="text-danger">*</span></label>
                                            <input type="text" class="form-control" id="paytm_website" name="pkey[website]" placeholder="WEBSTAGING / DEFAULT" value="{{ $paytmData['website'] ?? 'DEFAULT' }}" required>
                                        </div>
                                        <div class="col-md-6 mb-3">
                                            <label for="paytm_industry" class="font-weight-bold">{{ __('Industry Type ID') }} <span class="text-danger">*</span></label>
                                            <input type="text" class="form-control" id="paytm_industry" name="pkey[industry]" placeholder="Retail" value="{{ $paytmData['industry'] ?? 'Retail' }}" required>
                                        </div>
                                    </div>

                                    <div class="sandbox-toggle-card mb-3">
                                        <div>
                                            <h6 class="mb-0 font-weight-bold text-dark">{{ __('Enable Staging / Sandbox Mode') }}</h6>
                                            <small class="text-muted">{{ __('Check for test transactions with Paytm test credentials.') }}</small>
                                        </div>
                                        <div class="custom-control custom-checkbox">
                                            <input type="checkbox" name="pkey[paytm_mode]" class="custom-control-input" value="1" {{ (isset($paytmData['paytm_mode']) && $paytmData['paytm_mode'] == 1) ? 'checked' : '' }} id="paytm_mode">
                                            <label class="custom-control-label font-weight-bold" for="paytm_mode">{{ __('Staging Mode') }}</label>
                                        </div>
                                    </div>

                                    <div class="form-group mb-0">
                                        <label for="paytm_text" class="font-weight-bold">{{ __('Customer Instructions / Description') }}</label>
                                        <textarea name="text" id="paytm_text" class="form-control" rows="3" placeholder="{{ __('Enter checkout instructions...') }}">{{ $paytm->text ?? '' }}</textarea>
                                    </div>
                                </div>
                            </div>

                            <div class="mt-4 text-right">
                                <button type="submit" class="btn btn-primary px-4 py-2" style="border-radius: 10px; font-weight: 700;">
                                    <i class="fa-solid fa-floppy-disk mr-2"></i> {{ __('Save Paytm Settings') }}
                                </button>
                            </div>
                        </form>
                    </div>
                </div>

                {{-- 6. CASHFREE TAB --}}
                <div id="cashfree" class="tab-pane fade" role="tabpanel">
                    <div class="gateway-content-card">
                        <form action="{{ route('back.setting.payment.update') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <input type="hidden" name="unique_keyword" value="cashfree">

                            <div class="gateway-card-top">
                                <div class="gateway-card-brand">
                                    <div class="gateway-brand-badge">
                                        <i class="fa-solid fa-bolt"></i>
                                    </div>
                                    <div>
                                        <h3 class="gateway-brand-title">{{ __('Cashfree Payment Gateway') }}</h3>
                                        <p class="gateway-brand-subtitle">{{ __('Seamless checkout with UPI, QR, Instant NetBanking, EMI & Cards.') }}</p>
                                    </div>
                                </div>
                                <div class="gateway-toggle-box">
                                    <span class="gateway-toggle-label">{{ __('Display on Checkout') }}</span>
                                    <label class="switch-primary">
                                        <input type="checkbox" class="switch switch-bootstrap" name="status" value="1" {{ ($cashfree && $cashfree->status == 1) ? 'checked' : '' }}>
                                        <span class="switch-body"></span>
                                    </label>
                                </div>
                            </div>

                            <div class="image-show {{ ($cashfree && $cashfree->status == 1) ? '' : 'd-none' }}">
                                <div class="gateway-form-section">
                                    <h6 class="gateway-section-title"><i class="fa-solid fa-image"></i> {{ __('Gateway Image & Logo') }}</h6>
                                    <div class="gateway-image-preview-wrapper mb-3">
                                        <div class="gateway-image-box">
                                            <img src="{{ ($cashfree && $cashfree->photo) ? url('/core/public/storage/images/' . $cashfree->photo) : url('/core/public/storage/images/placeholder.png') }}" alt="Cashfree Logo">
                                        </div>
                                        <div>
                                            <label class="file mb-2">
                                                <input type="file" accept="image/*" class="upload-photo" name="photo" id="cashfree_photo">
                                                <span class="file-custom">{{ __('Choose New Image...') }}</span>
                                            </label>
                                            <div class="gateway-helper-pill">
                                                <i class="fa-solid fa-circle-info"></i> {{ __('Recommended Size: 52 x 35 px (PNG, SVG, JPG)') }}
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="gateway-form-section">
                                    <h6 class="gateway-section-title"><i class="fa-solid fa-key"></i> {{ __('Cashfree API Credentials') }}</h6>
                                    <div class="form-group mb-3">
                                        <label for="cashfree_display_name" class="font-weight-bold">{{ __('Display Name on Checkout') }} <span class="text-danger">*</span></label>
                                        <input type="text" class="form-control" name="name" id="cashfree_display_name" value="{{ $cashfree->name ?? 'Cashfree' }}" required>
                                    </div>

                                    <div class="form-group mb-3">
                                        <label for="cashfree_app_id" class="font-weight-bold">{{ __('Cashfree App ID (Client ID)') }} <span class="text-danger">*</span></label>
                                        <input type="text" class="form-control" id="cashfree_app_id" name="pkey[app_id]" placeholder="Enter your Cashfree App ID / Client ID" value="{{ $cashfreeData['app_id'] ?? '' }}" required>
                                    </div>

                                    <div class="form-group mb-3">
                                        <label for="cashfree_secret_key" class="font-weight-bold">{{ __('Cashfree Secret Key') }} <span class="text-danger">*</span></label>
                                        <input type="text" class="form-control" id="cashfree_secret_key" name="pkey[secret_key]" placeholder="Enter your Cashfree Secret Key" value="{{ $cashfreeData['secret_key'] ?? '' }}" required>
                                    </div>

                                    <div class="sandbox-toggle-card mb-3">
                                        <div>
                                            <h6 class="mb-0 font-weight-bold text-dark">{{ __('Enable Sandbox / Test Mode') }}</h6>
                                            <small class="text-muted">{{ __('Uncheck when you are ready to process real transactions using Production API keys.') }}</small>
                                        </div>
                                        <div class="custom-control custom-checkbox">
                                            <input type="checkbox" name="pkey[check_sandbox]" class="custom-control-input" value="1" {{ (!isset($cashfreeData['check_sandbox']) || $cashfreeData['check_sandbox'] == 1) ? 'checked' : '' }} id="cashfree_sandbox">
                                            <label class="custom-control-label font-weight-bold" for="cashfree_sandbox">{{ __('Sandbox Mode') }}</label>
                                        </div>
                                    </div>

                                    <div class="p-3 border rounded-3 bg-white mb-3" style="border-radius: 12px !important; border-color: #e2e8f0 !important;">
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

                                    <div class="form-group mb-0">
                                        <label for="cashfree_text" class="font-weight-bold">{{ __('Customer Instructions / Description') }}</label>
                                        <textarea name="text" id="cashfree_text" class="form-control" rows="3" placeholder="{{ __('Enter checkout instructions...') }}">{{ $cashfree->text ?? '' }}</textarea>
                                    </div>
                                </div>
                            </div>

                            <div class="mt-4 text-right">
                                <button type="submit" class="btn btn-primary px-4 py-2" style="border-radius: 10px; font-weight: 700;">
                                    <i class="fa-solid fa-floppy-disk mr-2"></i> {{ __('Save Cashfree Settings') }}
                                </button>
                            </div>
                        </form>
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script>
    $(document).ready(function() {
        // Activate tab from URL hash if present
        var hash = window.location.hash;
        if (hash) {
            var $targetTab = $('#payment-gateways-tab a[href="' + hash + '"]');
            if ($targetTab.length) {
                $targetTab.tab('show');
            }
        }

        // Update URL hash when clicking tabs without jumping
        $('#payment-gateways-tab a').on('shown.bs.tab', function(e) {
            var targetHash = $(e.target).attr('href');
            if (history.replaceState) {
                history.replaceState(null, null, targetHash);
            } else {
                window.location.hash = targetHash;
            }
        });

        // File upload custom label update
        $(document).on('change', '.upload-photo', function(e) {
            var fileName = e.target.files[0] ? e.target.files[0].name : 'Choose New Image...';
            $(this).siblings('.file-custom').text(fileName);
        });

        // Live Toggle Switch visibility
        $(document).on('change', '.gateway-toggle-box input[name="status"]', function() {
            var $tabPane = $(this).closest('.tab-pane');
            var $imageShow = $tabPane.find('.image-show');
            if ($(this).is(':checked')) {
                $imageShow.removeClass('d-none');
            } else {
                $imageShow.addClass('d-none');
            }
        });

        // Cashfree API Connectivity Tester AJAX
        $(document).on('click', '#btn_test_cashfree', function(e) {
            e.preventDefault();
            var $btn = $(this);
            var $btnText = $('#test_btn_text');
            var $resultBox = $('#cashfree_test_result');

            var appId = $('#cashfree_app_id').val();
            var secretKey = $('#cashfree_secret_key').val();
            var isSandbox = $('#cashfree_sandbox').is(':checked') ? 1 : 0;

            if (!appId || !secretKey) {
                $resultBox.removeClass('d-none alert-success alert-info').addClass('alert alert-warning').html('<i class="fa-solid fa-triangle-exclamation mr-1"></i> Please enter both Cashfree App ID and Secret Key above before testing.');
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
                    $resultBox.removeClass('alert-info alert-success alert-warning').addClass('alert alert-danger').html('<i class="fa-solid fa-triangle-exclamation mr-1"></i> Connection failed with status ' + xhr.status + ': ' + (xhr.responseJSON ? xhr.responseJSON.message : xhr.statusText));
                }
            });
        });
    });
</script>
@endsection