@extends('master.back')

@section('content')

<div class="container-fluid">

    <!-- Page Header Banner -->
    <div class="dash-hero-banner mb-4">
        <div class="dash-hero-content">
            <div class="dash-hero-text">
                <h2><i class="fa-solid fa-message mr-2" style="font-size: 22px;"></i> {{ __('SMS Gateway & Notifications') }}</h2>
                <p>{{ __('Configure Twilio SMS gateway credentials, phone routing, and automated customer order SMS alerts.') }}</p>
                <ul class="profile-breadcrumb mt-2">
                    <li><a href="{{ route('back.dashboard') }}"><i class="fa-solid fa-house"></i> {{ __('Dashboard') }}</a></li>
                    <span class="divider">/</span>
                    <li><a href="{{ route('back.setting.system') }}">{{ __('Settings') }}</a></li>
                    <span class="divider">/</span>
                    <li class="active">{{ __('SMS Setting') }}</li>
                </ul>
            </div>
        </div>
    </div>

    <!-- Main Row -->
    <div class="row">
        <!-- Navigation Tabs Column -->
        <div class="col-xl-3 col-lg-4 col-12 mb-3 mb-lg-0">
            <div class="nav settings-nav-pills" id="v-pills-tab" role="tablist" aria-orientation="vertical">
                <a class="nav-link active" data-toggle="pill" href="#conf" role="tab" aria-selected="true">
                    <i class="fa-solid fa-sliders"></i>
                    <span>{{ __('Configuration') }}</span>
                </a>
                <a class="nav-link" data-toggle="pill" href="#template" role="tab" aria-selected="false">
                    <i class="fa-solid fa-comment-sms"></i>
                    <span>{{ __('SMS Notifications') }}</span>
                </a>
            </div>
        </div>

        <!-- Content Panes Column -->
        <div class="col-xl-9 col-lg-8 col-12 mb-4">
            <div class="card-modern">
                <div class="card-modern-body p-4">
                    @include('alerts.alerts')

                    <div class="tab-content" id="smsTabContent">

                        <!-- 1. CONFIGURATION TAB -->
                        <div id="conf" class="tab-pane fade show active" role="tabpanel">
                            <div class="settings-tab-pane-title mb-4 pb-3 border-bottom d-flex align-items-center justify-content-between">
                                <div>
                                    <i class="fa-solid fa-sliders text-primary mr-2" style="font-size: 18px;"></i>
                                    <span>{{ __('Twilio SMS Gateway Setup') }}</span>
                                </div>
                                <span class="badge" style="background: #eff6ff; color: #1d4ed8; border: 1px solid #bfdbfe; font-size: 12px; font-weight: 600; padding: 5px 12px; border-radius: 999px;">
                                    <i class="fa-solid fa-signal mr-1"></i> {{ __('Twilio API') }}
                                </span>
                            </div>

                            <form class="admin-form" action="{{ route('back.sms.update') }}" method="POST" enctype="multipart/form-data">
                                @csrf

                                <!-- Status Toggle -->
                                <div class="settings-section-card mb-4">
                                    <div class="d-flex align-items-center justify-content-between">
                                        <div>
                                            <h6 class="section-card-title mb-1">
                                                <i class="fa-solid fa-power-off text-primary mr-1"></i> {{ __('Enable SMS Service') }}
                                            </h6>
                                            <span class="text-muted" style="font-size: 13px;">{{ __('Turn on SMS text message notifications for customer order confirmations and tracking.') }}</span>
                                        </div>
                                        <div>
                                            <label class="switch-primary mb-0">
                                                <input type="checkbox" class="switch switch-bootstrap status radio-check" name="is_twilio" value="1" {{ $setting->is_twilio == 1 ? 'checked' : '' }}>
                                                <span class="switch-body"></span>
                                            </label>
                                        </div>
                                    </div>
                                </div>

                                <!-- Credentials Container -->
                                <div class="radio-show {{ $setting->is_twilio == 0 ? 'd-none' : '' }}">
                                    <div class="settings-section-card mb-4">
                                        <h6 class="section-card-title mb-3">
                                            <i class="fa-solid fa-key text-primary mr-1"></i> {{ __('Twilio Credentials & Phone Settings') }}
                                        </h6>

                                        <div class="alert alert-info py-2 px-3 mb-4" style="border-radius: 10px; font-size: 13px; border: 1px solid #bae6fd; background: #f0f9ff; color: #0369a1;">
                                            <i class="fa-solid fa-circle-info mr-1"></i>
                                            {{ __('Obtain your Account SID, Auth Token, and Active Phone Number from your') }} <a href="https://www.twilio.com/console" target="_blank" class="font-weight-bold text-primary" style="text-decoration: underline;">Twilio Console</a>.
                                        </div>

                                        <div class="row">
                                            <div class="col-md-6 mb-3">
                                                <label for="twilio_sid" class="form-label font-weight-bold">{{ __('Twilio SID') }} *</label>
                                                <div class="input-group">
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text"><i class="fa-solid fa-id-card"></i></span>
                                                    </div>
                                                    <input type="text" class="form-control font-monospace" id="twilio_sid" name="twilio_sid" placeholder="{{ __('e.g. AC73e54518487ad4e26da8b465a7614f1f0') }}" value="{{ $setting->twilio_sid }}" required>
                                                </div>
                                            </div>

                                            <div class="col-md-6 mb-3">
                                                <label for="twilio_token" class="form-label font-weight-bold">{{ __('Twilio Auth Token') }} *</label>
                                                <div class="input-group">
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text"><i class="fa-solid fa-lock"></i></span>
                                                    </div>
                                                    <input type="password" class="form-control" id="twilio_token" name="twilio_token" placeholder="{{ __('Enter Twilio Auth Token') }}" value="{{ $setting->twilio_token }}" required>
                                                </div>
                                            </div>

                                            <div class="col-md-6 mb-3">
                                                <label for="twilio_form_number" class="form-label font-weight-bold">{{ __('Twilio Sender Phone Number (From)') }} *</label>
                                                <div class="input-group">
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text"><i class="fa-solid fa-phone"></i></span>
                                                    </div>
                                                    <input type="text" class="form-control" id="twilio_form_number" name="twilio_form_number" placeholder="{{ __('e.g. +15612793758') }}" value="{{ $setting->twilio_form_number }}" required>
                                                </div>
                                                <small class="text-muted mt-1 d-block" style="font-size: 12px;">
                                                    <i class="fa-solid fa-circle-info text-primary mr-1"></i> {{ __('Include full international format starting with + (e.g. +1234567890)') }}
                                                </small>
                                            </div>

                                            <div class="col-md-6 mb-3">
                                                <label for="twilio_country_code" class="form-label font-weight-bold">{{ __('Default Country Calling Code') }} *</label>
                                                <div class="input-group">
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text"><i class="fa-solid fa-earth-americas"></i></span>
                                                    </div>
                                                    <input type="text" class="form-control" id="twilio_country_code" name="twilio_country_code" placeholder="{{ __('e.g. +1 or +880') }}" value="{{ $setting->twilio_country_code }}" required>
                                                </div>
                                                <small class="text-muted mt-1 d-block" style="font-size: 12px;">
                                                    <i class="fa-solid fa-circle-info text-primary mr-1"></i> {{ __('Prepend (+) sign before the country prefix (e.g. +880, +1, +44)') }}
                                                </small>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="d-flex justify-content-end mt-4">
                                    <button type="submit" class="btn btn-primary px-4 py-2" style="border-radius: 10px; font-weight: 700; background: linear-gradient(135deg, #10b981, #059669); border: none; box-shadow: 0 4px 12px rgba(16, 185, 129, 0.3);">
                                        <i class="fa-solid fa-floppy-disk mr-1"></i> {{ __('Save SMS Settings') }}
                                    </button>
                                </div>

                            </form>
                        </div>

                        <!-- 2. SMS NOTIFICATIONS TAB -->
                        <div id="template" class="tab-pane fade" role="tabpanel">
                            <div class="settings-tab-pane-title mb-4 pb-3 border-bottom d-flex align-items-center justify-content-between">
                                <div>
                                    <i class="fa-solid fa-comment-sms text-primary mr-2" style="font-size: 18px;"></i>
                                    <span>{{ __('Automated SMS Notifications') }}</span>
                                </div>
                                <span class="badge" style="background: #f0fdf4; color: #15803d; border: 1px solid #bbf7d0; font-size: 12px; font-weight: 600; padding: 5px 12px; border-radius: 999px;">
                                    <i class="fa-solid fa-mobile-screen mr-1"></i> {{ __('Customer Alerts') }}
                                </span>
                            </div>

                            @php
                                $sms_section = json_decode($setting->twilio_section, true);
                                $purchase_text = $sms_section["'purchase'"] ?? ($sms_section['purchase'] ?? '');
                                $order_status_text = $sms_section["'order_status'"] ?? ($sms_section['order_status'] ?? '');
                            @endphp

                            <form class="admin-form" action="{{ route('back.setting.update') }}" method="POST" enctype="multipart/form-data">
                                @csrf

                                <!-- Tag Helper Alert -->
                                <div class="alert alert-light border mb-4" style="border-radius: 12px; background: #f8fafc; border-color: #e2e8f0 !important;">
                                    <div class="d-flex align-items-center">
                                        <div style="width: 36px; height: 36px; border-radius: 8px; background: #eff6ff; color: #2563eb; display: flex; align-items: center; justify-content: center; font-size: 16px; margin-right: 12px;">
                                            <i class="fa-solid fa-code"></i>
                                        </div>
                                        <div>
                                            <span class="font-weight-bold text-dark" style="font-size: 13.5px;">{{ __('Available Shortcode Placeholder:') }}</span>
                                            <div class="mt-1">
                                                <code class="px-2 py-1 user-select-all" style="background: #ffffff; color: #1d4ed8; border: 1px solid #bfdbfe; border-radius: 6px; font-size: 13px;">{order_number}</code>
                                                <span class="text-muted ml-2" style="font-size: 12.5px;">— {{ __('Replaced dynamically with the actual customer order ID number.') }}</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!-- Purchase SMS -->
                                <div class="settings-section-card mb-4">
                                    <h6 class="section-card-title mb-2">
                                        <i class="fa-solid fa-cart-shopping text-primary mr-1"></i> {{ __('Order Purchase Confirmation Message') }}
                                    </h6>
                                    <p class="text-muted mb-3" style="font-size: 13px;">
                                        {{ __('Sent to the customer immediately after an order is successfully placed.') }}
                                    </p>
                                    <div class="form-group mb-0">
                                        <label for="order_purchase" class="form-label font-weight-bold">{{ __('SMS Message Text') }} *</label>
                                        <textarea name="twilio_section['purchase']" class="form-control" id="order_purchase" rows="4" placeholder="{{ __('e.g. Thank you for your purchase! Your order #{order_number} has been received.') }}">{{ $purchase_text }}</textarea>
                                    </div>
                                </div>

                                <!-- Status Update SMS -->
                                <div class="settings-section-card mb-4">
                                    <h6 class="section-card-title mb-2">
                                        <i class="fa-solid fa-truck text-primary mr-1"></i> {{ __('Order Status Update Message') }}
                                    </h6>
                                    <p class="text-muted mb-3" style="font-size: 13px;">
                                        {{ __('Sent to the customer when their order progress or shipping status is updated.') }}
                                    </p>
                                    <div class="form-group mb-0">
                                        <label for="order_status" class="form-label font-weight-bold">{{ __('SMS Message Text') }} *</label>
                                        <textarea name="twilio_section['order_status']" class="form-control" id="order_status" rows="4" placeholder="{{ __('e.g. Your order #{order_number} status has been updated.') }}">{{ $order_status_text }}</textarea>
                                    </div>
                                </div>

                                <div class="d-flex justify-content-end mt-4">
                                    <button type="submit" class="btn btn-primary px-4 py-2" style="border-radius: 10px; font-weight: 700; background: linear-gradient(135deg, #10b981, #059669); border: none; box-shadow: 0 4px 12px rgba(16, 185, 129, 0.3);">
                                        <i class="fa-solid fa-floppy-disk mr-1"></i> {{ __('Save SMS Notifications') }}
                                    </button>
                                </div>

                            </form>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>

</div>

@endsection
