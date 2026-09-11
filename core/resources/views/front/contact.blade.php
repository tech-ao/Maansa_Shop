@extends('master.front')
@section('meta')
<meta name="keywords" content="{{$setting->meta_keywords}}">
<meta name="description" content="{{$setting->meta_description}}">
@endsection
@section('title')
    {{__('Contact Us')}}
@endsection

@section('content')

<style>
    /* -------------------------------------------------------------
       CONTACT US PAGE - MODERN REDESIGN
       Theme: Maansa Rajashahi (Emerald & Gold)
    ------------------------------------------------------------- */
    
    .contact-page-wrapper {
        background-color: #f8fafc;
        min-height: calc(100vh - 350px);
        padding-bottom: 70px;
    }

    /* Hero Banner */
    .contact-hero-banner {
        position: relative;
        background: linear-gradient(135deg, #064e3b 0%, #065f46 55%, #047857 100%);
        padding: 55px 0 85px 0;
        color: #ffffff;
        overflow: hidden;
    }

    .contact-hero-banner::before {
        content: "";
        position: absolute;
        top: -60px;
        right: -60px;
        width: 320px;
        height: 320px;
        border-radius: 50%;
        background: radial-gradient(circle, rgba(16, 185, 129, 0.25) 0%, rgba(6, 78, 59, 0) 70%);
        pointer-events: none;
    }

    .contact-hero-banner::after {
        content: "";
        position: absolute;
        bottom: -40px;
        left: -40px;
        width: 240px;
        height: 240px;
        border-radius: 50%;
        background: radial-gradient(circle, rgba(217, 119, 6, 0.15) 0%, rgba(6, 78, 59, 0) 70%);
        pointer-events: none;
    }

    .contact-hero-content {
        position: relative;
        z-index: 2;
        max-width: 1140px;
        margin: 0 auto;
    }

    /* Glassmorphism Breadcrumbs */
    .contact-breadcrumb-pill {
        display: inline-flex;
        align-items: center;
        flex-wrap: wrap;
        gap: 8px;
        background: rgba(255, 255, 255, 0.12);
        backdrop-filter: blur(10px);
        -webkit-backdrop-filter: blur(10px);
        border: 1px solid rgba(255, 255, 255, 0.2);
        border-radius: 30px;
        padding: 6px 16px;
        margin-bottom: 20px;
        font-size: 13px;
        list-style: none;
    }

    .contact-breadcrumb-pill li {
        display: inline-flex;
        align-items: center;
        color: #d1fae5;
    }

    .contact-breadcrumb-pill li a {
        color: #ffffff;
        text-decoration: none;
        font-weight: 500;
        transition: color 0.2s ease;
        display: inline-flex;
        align-items: center;
        gap: 5px;
    }

    .contact-breadcrumb-pill li a:hover {
        color: #a7f3d0;
    }

    .contact-breadcrumb-pill .sep {
        color: rgba(255, 255, 255, 0.45);
        font-size: 11px;
    }

    .contact-breadcrumb-pill .current {
        color: #a7f3d0;
        font-weight: 600;
    }

    /* Hero Typography */
    .contact-hero-title {
        font-size: 36px;
        font-weight: 800;
        line-height: 1.25;
        letter-spacing: -0.5px;
        color: #ffffff;
        margin-bottom: 10px;
        text-shadow: 0 2px 8px rgba(0, 0, 0, 0.12);
    }

    .contact-hero-subtitle {
        font-size: 15px;
        color: #d1fae5;
        max-width: 600px;
        margin-bottom: 0;
        line-height: 1.6;
    }

    /* Main Container Overlap */
    .contact-main-container {
        max-width: 1140px;
        margin: -48px auto 0 auto;
        position: relative;
        z-index: 10;
        padding: 0 16px;
    }

    /* Info Sidebar Cards */
    .contact-info-card {
        background: #ffffff;
        border-radius: 20px;
        border: 1px solid #edf2f7;
        box-shadow: 0 18px 35px -12px rgba(6, 78, 59, 0.07), 0 1px 3px rgba(0, 0, 0, 0.05);
        padding: 28px;
        margin-bottom: 24px;
        transition: transform 0.2s ease, box-shadow 0.2s ease;
    }

    .contact-info-card:hover {
        transform: translateY(-2px);
        box-shadow: 0 22px 40px -12px rgba(6, 78, 59, 0.1);
    }

    .contact-card-title {
        font-size: 17px;
        font-weight: 700;
        color: #0f172a;
        margin-bottom: 20px;
        display: flex;
        align-items: center;
        gap: 10px;
        padding-bottom: 12px;
        border-bottom: 1.5px solid #f1f5f9;
    }

    .contact-card-title i {
        color: #059669;
        font-size: 18px;
    }

    /* Contact Channel Items */
    .contact-channel-item {
        display: flex;
        align-items: flex-start;
        gap: 14px;
        margin-bottom: 20px;
    }

    .contact-channel-item:last-child {
        margin-bottom: 0;
    }

    .channel-icon-box {
        width: 44px;
        height: 44px;
        min-width: 44px;
        border-radius: 12px;
        background: #f0fdf4;
        color: #059669;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 18px;
        transition: all 0.2s ease;
    }

    .contact-channel-item:hover .channel-icon-box {
        background: #059669;
        color: #ffffff;
    }

    .channel-content h6 {
        font-size: 13px;
        font-weight: 600;
        text-transform: uppercase;
        letter-spacing: 0.5px;
        color: #64748b;
        margin: 0 0 3px 0;
    }

    .channel-content a,
    .channel-content p {
        font-size: 14.5px;
        font-weight: 600;
        color: #1e293b;
        margin: 0;
        text-decoration: none;
        line-height: 1.5;
        transition: color 0.15s ease;
    }

    .channel-content a:hover {
        color: #059669;
    }

    .channel-content span {
        display: block;
        font-size: 12.5px;
        color: #94a3b8;
        font-weight: 400;
        margin-top: 2px;
    }

    /* Schedule List */
    .schedule-list {
        list-style: none;
        padding: 0;
        margin: 0;
    }

    .schedule-item {
        display: flex;
        align-items: center;
        justify-content: space-between;
        padding: 11px 0;
        border-bottom: 1px dashed #e2e8f0;
        font-size: 14px;
    }

    .schedule-item:last-child {
        border-bottom: none;
        padding-bottom: 0;
    }

    .schedule-day {
        color: #475569;
        font-weight: 500;
        display: flex;
        align-items: center;
        gap: 6px;
    }

    .schedule-time {
        font-weight: 700;
        color: #0f172a;
        background: #f1f5f9;
        padding: 3px 10px;
        border-radius: 20px;
        font-size: 12.5px;
    }

    .schedule-time.active {
        background: #dcfce7;
        color: #15803d;
    }

    /* Social Icons Modern */
    .contact-social-grid {
        display: flex;
        align-items: center;
        flex-wrap: wrap;
        gap: 10px;
    }

    .contact-social-btn {
        width: 40px;
        height: 40px;
        border-radius: 10px;
        background: #f8fafc;
        border: 1px solid #e2e8f0;
        color: #475569;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        font-size: 15px;
        text-decoration: none;
        transition: all 0.2s ease;
    }

    .contact-social-btn:hover {
        background: #059669;
        border-color: #059669;
        color: #ffffff;
        transform: translateY(-2px);
        box-shadow: 0 4px 10px rgba(5, 150, 105, 0.25);
    }

    /* Contact Form Card */
    .contact-form-card {
        background: #ffffff;
        border-radius: 20px;
        border: 1px solid #edf2f7;
        box-shadow: 0 20px 40px -15px rgba(6, 78, 59, 0.08), 0 1px 3px rgba(0, 0, 0, 0.05);
        padding: 44px 48px;
    }

    .form-header-area {
        margin-bottom: 28px;
    }

    .form-badge-pill {
        display: inline-flex;
        align-items: center;
        gap: 6px;
        background: #f0fdf4;
        color: #059669;
        font-weight: 700;
        font-size: 12.5px;
        padding: 4px 12px;
        border-radius: 20px;
        margin-bottom: 10px;
        border: 1px solid #dcfce7;
    }

    .form-main-heading {
        font-size: 26px;
        font-weight: 800;
        color: #0f172a;
        letter-spacing: -0.3px;
        margin-bottom: 6px;
    }

    .form-sub-heading {
        font-size: 14.5px;
        color: #64748b;
        margin: 0;
    }

    /* Form Fields */
    .contact-input-group {
        margin-bottom: 22px;
    }

    .contact-input-group label {
        display: block;
        font-size: 13.5px;
        font-weight: 700;
        color: #334155;
        margin-bottom: 7px;
    }

    .contact-input-group label .required-star {
        color: #ef4444;
        margin-left: 2px;
    }

    .modern-contact-input {
        width: 100%;
        height: 48px;
        background: #f8fafc;
        border: 1.5px solid #e2e8f0;
        border-radius: 12px;
        padding: 10px 16px;
        font-size: 14.5px;
        color: #1e293b;
        transition: all 0.2s ease;
        outline: none;
    }

    .modern-contact-input:focus {
        background: #ffffff;
        border-color: #059669;
        box-shadow: 0 0 0 3px rgba(5, 150, 105, 0.12);
    }

    .modern-contact-input::placeholder {
        color: #94a3b8;
        font-size: 14px;
    }

    textarea.modern-contact-input {
        height: auto;
        min-height: 140px;
        resize: vertical;
        padding: 14px 16px;
        line-height: 1.6;
    }

    .field-error-text {
        color: #ef4444;
        font-size: 12.5px;
        font-weight: 600;
        margin-top: 5px;
        margin-bottom: 0;
        display: flex;
        align-items: center;
        gap: 4px;
    }

    /* Submit Button Area */
    .form-submit-footer {
        display: flex;
        align-items: center;
        justify-content: space-between;
        flex-wrap: wrap;
        gap: 16px;
        margin-top: 10px;
        padding-top: 18px;
        border-top: 1.5px solid #f1f5f9;
    }

    .privacy-notice-text {
        font-size: 12.5px;
        color: #64748b;
        display: flex;
        align-items: center;
        gap: 6px;
        margin: 0;
    }

    .privacy-notice-text i {
        color: #059669;
        font-size: 14px;
    }

    .btn-contact-submit {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        gap: 8px;
        background: linear-gradient(135deg, #059669 0%, #047857 100%);
        color: #ffffff !important;
        font-weight: 700;
        font-size: 15px;
        padding: 13px 28px;
        border-radius: 12px;
        border: none;
        cursor: pointer;
        transition: all 0.2s ease;
        box-shadow: 0 4px 12px rgba(5, 150, 105, 0.3);
    }

    .btn-contact-submit:hover {
        background: linear-gradient(135deg, #047857 0%, #065f46 100%);
        transform: translateY(-2px);
        box-shadow: 0 6px 18px rgba(5, 150, 105, 0.35);
        color: #ffffff !important;
    }

    .btn-contact-submit:active {
        transform: translateY(0);
    }

    /* -------------------------------------------------------------
       RESPONSIVE BREAKPOINTS (Mobile & Tablet)
    ------------------------------------------------------------- */
    @media (max-width: 991px) {
        .contact-hero-banner {
            padding: 42px 0 72px 0;
        }

        .contact-hero-title {
            font-size: 30px;
        }

        .contact-form-card {
            padding: 34px 28px;
        }
    }

    @media (max-width: 767px) {
        .contact-hero-banner {
            padding: 32px 0 60px 0;
            text-align: left;
        }

        .contact-hero-title {
            font-size: 24px;
            margin-bottom: 8px;
        }

        .contact-hero-subtitle {
            font-size: 13.5px;
        }

        .contact-breadcrumb-pill {
            font-size: 12px;
            padding: 5px 12px;
            margin-bottom: 14px;
        }

        .contact-main-container {
            margin-top: -36px;
            padding: 0 12px;
        }

        .contact-form-card {
            padding: 24px 18px;
            border-radius: 16px;
            margin-bottom: 24px;
        }

        .form-main-heading {
            font-size: 21px;
        }

        .contact-info-card {
            padding: 22px 18px;
            border-radius: 16px;
        }

        .form-submit-footer {
            flex-direction: column;
            align-items: stretch;
            gap: 14px;
        }

        .btn-contact-submit {
            width: 100%;
            padding: 13px 20px;
        }

        .privacy-notice-text {
            text-align: center;
            justify-content: center;
        }
    }
</style>

<div class="contact-page-wrapper">
    <!-- Hero Header Banner -->
    <section class="contact-hero-banner">
        <div class="container">
            <div class="contact-hero-content">
                <!-- Breadcrumbs -->
                <ul class="contact-breadcrumb-pill">
                    <li>
                        <a href="{{ route('front.index') }}">
                            <i class="icon-home" style="font-size: 13px;"></i>
                            <span>{{ __('Home') }}</span>
                        </a>
                    </li>
                    <li class="sep"><i class="icon-chevron-right"></i></li>
                    <li class="current">{{ __('Contact Us') }}</li>
                </ul>

                <!-- Page Header Info -->
                <h1 class="contact-hero-title">{{ __('We’d Love to Hear From You') }}</h1>
                <p class="contact-hero-subtitle">{{ __('Have questions about our spices, your orders, or custom requirements? Reach out to us anytime!') }}</p>
            </div>
        </div>
    </section>

    <!-- Main Content Area -->
    <div class="contact-main-container">
        <div class="row">
            <!-- Left Column: Store Details & Timings -->
            <div class="col-lg-4 col-md-5 order-lg-1 order-2">
                <!-- Channel Details Card -->
                <div class="contact-info-card">
                    <h4 class="contact-card-title">
                        <i class="icon-map-pin"></i>
                        <span>{{ __('Store Address & Info') }}</span>
                    </h4>

                    <!-- Address -->
                    <div class="contact-channel-item">
                        <div class="channel-icon-box">
                            <i class="icon-map-pin"></i>
                        </div>
                        <div class="channel-content">
                            <h6>{{ __('Visit Our Store') }}</h6>
                            <p>{{ $setting->footer_address }}</p>
                            <span>{{ __('Nagaur, Rajasthan, India') }}</span>
                        </div>
                    </div>

                    <!-- Phone -->
                    @if($setting->footer_phone)
                    <div class="contact-channel-item">
                        <div class="channel-icon-box">
                            <i class="icon-phone"></i>
                        </div>
                        <div class="channel-content">
                            <h6>{{ __('Call Support') }}</h6>
                            <a href="tel:{{ preg_replace('/[^0-9+]/', '', $setting->footer_phone) }}">{{ $setting->footer_phone }}</a>
                            <span>{{ __('Mon - Sat, 9:30 AM - 6:30 PM') }}</span>
                        </div>
                    </div>
                    @endif

                    <!-- Email -->
                    @if($setting->contact_email)
                    <div class="contact-channel-item">
                        <div class="channel-icon-box">
                            <i class="icon-mail"></i>
                        </div>
                        <div class="channel-content">
                            <h6>{{ __('Email Inquiries') }}</h6>
                            <a href="mailto:{{ $setting->contact_email }}">{{ $setting->contact_email }}</a>
                            <span>{{ __('Online support & queries') }}</span>
                        </div>
                    </div>
                    @endif
                </div>

                <!-- Operating Hours Card -->
                <div class="contact-info-card">
                    <h4 class="contact-card-title">
                        <i class="icon-clock"></i>
                        <span>{{ __('Working Schedule') }}</span>
                    </h4>

                    <ul class="schedule-list">
                        <li class="schedule-item">
                            <span class="schedule-day">
                                <i class="icon-calendar text-muted"></i> {{ __('Monday - Friday') }}
                            </span>
                            <span class="schedule-time active">{{ $setting->friday_start }} - {{ $setting->friday_end }}</span>
                        </li>
                        <li class="schedule-item">
                            <span class="schedule-day">
                                <i class="icon-calendar text-muted"></i> {{ __('Saturday') }}
                            </span>
                            <span class="schedule-time active">{{ $setting->satureday_start }} - {{ $setting->satureday_end }}</span>
                        </li>
                        <li class="schedule-item">
                            <span class="schedule-day">
                                <i class="icon-calendar text-muted"></i> {{ __('Sunday') }}
                            </span>
                            <span class="schedule-time">{{ __('Email Support') }}</span>
                        </li>
                    </ul>
                </div>

                <!-- Social Connect Card -->
                @php
                    $socialLinks = json_decode($setting->social_link, true)['links'] ?? [];
                    $socialIcons = json_decode($setting->social_link, true)['icons'] ?? [];
                @endphp

                @if(!empty($socialLinks))
                <div class="contact-info-card">
                    <h4 class="contact-card-title">
                        <i class="icon-share-2"></i>
                        <span>{{ __('Connect With Us') }}</span>
                    </h4>
                    <p class="text-muted" style="font-size: 13.5px; margin-bottom: 14px;">{{ __('Follow our social channels for updates and fresh spice recipes:') }}</p>
                    <div class="contact-social-grid">
                        @foreach ($socialLinks as $link_key => $link)
                            @if(!empty($link))
                            <a class="contact-social-btn" href="{{ $link }}" target="_blank" rel="noopener noreferrer" title="Follow Us">
                                <i class="{{ $socialIcons[$link_key] ?? 'icon-globe' }}"></i>
                            </a>
                            @endif
                        @endforeach
                    </div>
                </div>
                @endif
            </div>

            <!-- Right Column: Contact Form -->
            <div class="col-lg-8 col-md-7 order-lg-2 order-1 mb-4">
                <div class="contact-form-card">
                    <!-- Form Header -->
                    <div class="form-header-area">
                        <span class="form-badge-pill">
                            <i class="icon-message-square"></i>
                            <span>{{ __('Send Us a Message') }}</span>
                        </span>
                        <h2 class="form-main-heading">{{ __('How Can We Help You?') }}</h2>
                        <p class="form-sub-heading">{{ __('Fill out the details below and our customer care team will respond promptly.') }}</p>
                    </div>

                    <form method="POST" action="{{ route('front.contact.submit') }}">
                        @csrf
                        <div class="row">
                            <!-- First Name -->
                            <div class="col-md-6">
                                <div class="contact-input-group">
                                    <label for="first-name">{{ __('First Name') }} <span class="required-star">*</span></label>
                                    <input class="modern-contact-input" name="first_name" type="text" id="first-name" value="{{ old('first_name') }}" placeholder="{{ __('e.g. Rahul') }}" required>
                                    @error('first_name')
                                    <p class="field-error-text"><i class="icon-alert-circle"></i> {{ $message }}</p>
                                    @enderror
                                </div>
                            </div>

                            <!-- Last Name -->
                            <div class="col-md-6">
                                <div class="contact-input-group">
                                    <label for="last-name">{{ __('Last Name') }} <span class="required-star">*</span></label>
                                    <input class="modern-contact-input" name="last_name" type="text" id="last-name" value="{{ old('last_name') }}" placeholder="{{ __('e.g. Sharma') }}" required>
                                    @error('last_name')
                                    <p class="field-error-text"><i class="icon-alert-circle"></i> {{ $message }}</p>
                                    @enderror
                                </div>
                            </div>

                            <!-- Email Address -->
                            <div class="col-md-6">
                                <div class="contact-input-group">
                                    <label for="contact-email">{{ __('Email Address') }} <span class="required-star">*</span></label>
                                    <input class="modern-contact-input" type="email" name="email" id="contact-email" value="{{ old('email') }}" placeholder="{{ __('e.g. rahul@example.com') }}" required>
                                    @error('email')
                                    <p class="field-error-text"><i class="icon-alert-circle"></i> {{ $message }}</p>
                                    @enderror
                                </div>
                            </div>

                            <!-- Phone Number -->
                            <div class="col-md-6">
                                <div class="contact-input-group">
                                    <label for="contact-tel">{{ __('Phone Number') }} <span class="required-star">*</span></label>
                                    <input class="modern-contact-input" type="tel" name="phone" id="contact-tel" value="{{ old('phone') }}" placeholder="{{ __('e.g. +91 98765 43210') }}" required>
                                    @error('phone')
                                    <p class="field-error-text"><i class="icon-alert-circle"></i> {{ $message }}</p>
                                    @enderror
                                </div>
                            </div>

                            <!-- Message -->
                            <div class="col-12">
                                <div class="contact-input-group">
                                    <label for="message-text">{{ __('Your Message') }} <span class="required-star">*</span></label>
                                    <textarea class="modern-contact-input" name="message" id="message-text" rows="5" placeholder="{{ __('Please write your questions, bulk requirements, or order details here...') }}" required>{{ old('message') }}</textarea>
                                    @error('message')
                                    <p class="field-error-text"><i class="icon-alert-circle"></i> {{ $message }}</p>
                                    @enderror
                                </div>
                            </div>

                            <!-- Anti-Spam Honeypot -->
                            <input type="text" name="honeypot" id="honeypot" value="" style="display:none;">

                            <!-- Google reCAPTCHA -->
                            @if ($setting->recaptcha == 1)
                            <div class="col-12 mb-3">
                                {!! NoCaptcha::renderJs() !!}
                                {!! NoCaptcha::display() !!}
                                @if ($errors->has('g-recaptcha-response'))
                                @php
                                    $errmsg = $errors->first('g-recaptcha-response');
                                @endphp
                                <p class="field-error-text"><i class="icon-alert-circle"></i> {{ __("$errmsg") }}</p>
                                @endif
                            </div>
                            @endif

                            <!-- Submit Footer -->
                            <div class="col-12">
                                <div class="form-submit-footer">
                                    <p class="privacy-notice-text">
                                        <i class="icon-shield"></i>
                                        <span>{{ __('Your information is strictly protected and secure.') }}</span>
                                    </p>
                                    <button class="btn-contact-submit" type="submit">
                                        <i class="icon-send"></i>
                                        <span>{{ __('Send Message') }}</span>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
