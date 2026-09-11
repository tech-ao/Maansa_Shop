@extends('master.front')
@section('meta')
<meta name="keywords" content="{{$setting->meta_keywords}}">
<meta name="description" content="{{$setting->meta_description}}">
@endsection
@section('title')
    {{__('Help & FAQ')}}
@endsection

@section('content')

<style>
    /* -------------------------------------------------------------
       FAQ INDEX - MODERN REDESIGN
       Theme: Maansa Rajashahi (Emerald & Gold)
    ------------------------------------------------------------- */
    
    .faq-page-wrapper {
        background-color: #f8fafc;
        min-height: calc(100vh - 350px);
        padding-bottom: 70px;
    }

    /* Hero Banner */
    .faq-hero-banner {
        position: relative;
        background: linear-gradient(135deg, #064e3b 0%, #065f46 55%, #047857 100%);
        padding: 55px 0 85px 0;
        color: #ffffff;
        overflow: hidden;
    }

    .faq-hero-banner::before {
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

    .faq-hero-banner::after {
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

    .faq-hero-content {
        position: relative;
        z-index: 2;
        max-width: 1140px;
        margin: 0 auto;
    }

    /* Glassmorphism Breadcrumbs */
    .faq-breadcrumb-pill {
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

    .faq-breadcrumb-pill li {
        display: inline-flex;
        align-items: center;
        color: #d1fae5;
    }

    .faq-breadcrumb-pill li a {
        color: #ffffff;
        text-decoration: none;
        font-weight: 500;
        transition: color 0.2s ease;
        display: inline-flex;
        align-items: center;
        gap: 5px;
    }

    .faq-breadcrumb-pill li a:hover {
        color: #a7f3d0;
    }

    .faq-breadcrumb-pill .sep {
        color: rgba(255, 255, 255, 0.45);
        font-size: 11px;
    }

    .faq-breadcrumb-pill .current {
        color: #a7f3d0;
        font-weight: 600;
    }

    /* Hero Typography */
    .faq-hero-title {
        font-size: 36px;
        font-weight: 800;
        line-height: 1.25;
        letter-spacing: -0.5px;
        color: #ffffff;
        margin-bottom: 10px;
        text-shadow: 0 2px 8px rgba(0, 0, 0, 0.12);
    }

    .faq-hero-subtitle {
        font-size: 15px;
        color: #d1fae5;
        max-width: 620px;
        margin-bottom: 0;
        line-height: 1.6;
    }

    /* Main Container Overlap */
    .faq-main-container {
        max-width: 1140px;
        margin: -48px auto 0 auto;
        position: relative;
        z-index: 10;
        padding: 0 16px;
    }

    /* FAQ Category Cards */
    .faq-category-card {
        background: #ffffff;
        border-radius: 20px;
        border: 1px solid #edf2f7;
        box-shadow: 0 16px 35px -12px rgba(6, 78, 59, 0.07), 0 1px 3px rgba(0, 0, 0, 0.05);
        padding: 30px 28px;
        height: 100%;
        display: flex;
        flex-direction: column;
        justify-content: space-between;
        text-decoration: none !important;
        transition: all 0.25s cubic-bezier(0.16, 1, 0.3, 1);
        position: relative;
        overflow: hidden;
    }

    .faq-category-card::before {
        content: "";
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 4px;
        background: linear-gradient(90deg, #059669 0%, #10b981 100%);
        opacity: 0;
        transition: opacity 0.25s ease;
    }

    .faq-category-card:hover {
        transform: translateY(-4px);
        box-shadow: 0 24px 45px -15px rgba(6, 78, 59, 0.12), 0 0 1px 1px rgba(5, 150, 105, 0.15);
        border-color: #bbf7d0;
    }

    .faq-category-card:hover::before {
        opacity: 1;
    }

    .faq-card-top {
        display: flex;
        align-items: center;
        justify-content: space-between;
        margin-bottom: 20px;
    }

    .faq-icon-box {
        width: 48px;
        height: 48px;
        min-width: 48px;
        border-radius: 14px;
        background: #f0fdf4;
        color: #059669;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 20px;
        transition: all 0.2s ease;
    }

    .faq-category-card:hover .faq-icon-box {
        background: #059669;
        color: #ffffff;
        transform: scale(1.05);
    }

    .faq-count-pill {
        display: inline-flex;
        align-items: center;
        gap: 5px;
        background: #f1f5f9;
        color: #475569;
        font-size: 12px;
        font-weight: 700;
        padding: 4px 10px;
        border-radius: 20px;
        transition: all 0.2s ease;
    }

    .faq-category-card:hover .faq-count-pill {
        background: #dcfce7;
        color: #15803d;
    }

    .faq-card-body {
        margin-bottom: 22px;
    }

    .faq-card-title {
        font-size: 18px;
        font-weight: 800;
        color: #0f172a;
        margin: 0 0 8px 0;
        line-height: 1.35;
        transition: color 0.15s ease;
    }

    .faq-category-card:hover .faq-card-title {
        color: #065f46;
    }

    .faq-card-text {
        font-size: 14px;
        line-height: 1.6;
        color: #64748b;
        margin: 0;
        display: -webkit-box;
        -webkit-line-clamp: 2;
        -webkit-box-orient: vertical;
        overflow: hidden;
    }

    .faq-card-action {
        display: flex;
        align-items: center;
        gap: 6px;
        font-size: 13.5px;
        font-weight: 700;
        color: #059669;
        transition: gap 0.2s ease, color 0.2s ease;
    }

    .faq-category-card:hover .faq-card-action {
        color: #047857;
        gap: 10px;
    }

    /* Bottom Support Callout */
    .faq-support-card {
        margin-top: 35px;
        padding: 26px 32px;
        background: #ffffff;
        border: 1px solid #e2e8f0;
        border-radius: 20px;
        box-shadow: 0 16px 35px -12px rgba(6, 78, 59, 0.06);
        display: flex;
        align-items: center;
        justify-content: space-between;
        flex-wrap: wrap;
        gap: 20px;
    }

    .faq-support-left {
        display: flex;
        align-items: center;
        gap: 16px;
        flex: 1;
        min-width: 260px;
    }

    .faq-support-icon {
        width: 52px;
        height: 52px;
        min-width: 52px;
        border-radius: 14px;
        background: #f0fdf4;
        color: #059669;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 24px;
    }

    .faq-support-text h5 {
        font-size: 17px;
        font-weight: 800;
        color: #0f172a;
        margin: 0 0 3px 0;
    }

    .faq-support-text p {
        font-size: 14px;
        color: #64748b;
        margin: 0;
    }

    .faq-support-actions {
        display: flex;
        align-items: center;
        gap: 10px;
        flex-wrap: wrap;
    }

    .btn-faq-contact {
        display: inline-flex;
        align-items: center;
        gap: 7px;
        background: linear-gradient(135deg, #059669 0%, #047857 100%);
        color: #ffffff !important;
        font-weight: 700;
        font-size: 14px;
        padding: 11px 22px;
        border-radius: 12px;
        text-decoration: none !important;
        transition: all 0.2s ease;
        box-shadow: 0 4px 12px rgba(5, 150, 105, 0.25);
    }

    .btn-faq-contact:hover {
        background: linear-gradient(135deg, #047857 0%, #065f46 100%);
        transform: translateY(-2px);
        box-shadow: 0 6px 18px rgba(5, 150, 105, 0.35);
        color: #ffffff !important;
    }

    .btn-faq-home {
        display: inline-flex;
        align-items: center;
        gap: 6px;
        background: #f8fafc;
        color: #334155 !important;
        font-weight: 600;
        font-size: 14px;
        padding: 11px 20px;
        border-radius: 12px;
        border: 1px solid #cbd5e1;
        text-decoration: none !important;
        transition: all 0.2s ease;
    }

    .btn-faq-home:hover {
        background: #ffffff;
        color: #0f172a !important;
        border-color: #94a3b8;
    }

    /* -------------------------------------------------------------
       RESPONSIVE BREAKPOINTS (Mobile & Tablet)
    ------------------------------------------------------------- */
    @media (max-width: 991px) {
        .faq-hero-banner {
            padding: 42px 0 72px 0;
        }

        .faq-hero-title {
            font-size: 30px;
        }

        .faq-category-card {
            padding: 24px 22px;
        }
    }

    @media (max-width: 767px) {
        .faq-hero-banner {
            padding: 32px 0 60px 0;
            text-align: left;
        }

        .faq-hero-title {
            font-size: 24px;
            margin-bottom: 8px;
        }

        .faq-hero-subtitle {
            font-size: 13.5px;
        }

        .faq-breadcrumb-pill {
            font-size: 12px;
            padding: 5px 12px;
            margin-bottom: 14px;
        }

        .faq-main-container {
            margin-top: -36px;
            padding: 0 12px;
        }

        .faq-category-card {
            padding: 22px 18px;
            border-radius: 16px;
        }

        .faq-card-title {
            font-size: 16.5px;
        }

        .faq-support-card {
            padding: 20px 18px;
            border-radius: 16px;
        }

        .faq-support-left {
            gap: 12px;
        }

        .faq-support-icon {
            width: 44px;
            height: 44px;
            min-width: 44px;
            font-size: 20px;
        }

        .faq-support-actions {
            width: 100%;
        }

        .btn-faq-contact,
        .btn-faq-home {
            width: 100%;
            justify-content: center;
            padding: 11px 16px;
        }
    }
</style>

<div class="faq-page-wrapper">
    <!-- Hero Header Banner -->
    <section class="faq-hero-banner">
        <div class="container">
            <div class="faq-hero-content">
                <!-- Breadcrumbs -->
                <ul class="faq-breadcrumb-pill">
                    <li>
                        <a href="{{ route('front.index') }}">
                            <i class="icon-home" style="font-size: 13px;"></i>
                            <span>{{ __('Home') }}</span>
                        </a>
                    </li>
                    <li class="sep"><i class="icon-chevron-right"></i></li>
                    <li class="current">{{ __('Help & FAQ') }}</li>
                </ul>

                <!-- Page Header Info -->
                <h1 class="faq-hero-title">{{ __('Frequently Asked Questions') }}</h1>
                <p class="faq-hero-subtitle">{{ __('Find clear and fast answers regarding our organic spices, ordering, shipping, discounts, and payments.') }}</p>
            </div>
        </div>
    </section>

    <!-- Main FAQ Grid -->
    <div class="faq-main-container">
        <div class="row">
            @foreach ($fcategories as $category)
                <div class="col-lg-4 col-md-6 mb-4">
                    <a href="{{ route('front.faq.details', $category->slug) }}" class="faq-category-card">
                        <div>
                            <!-- Top Icon & Count Badge -->
                            <div class="faq-card-top">
                                <div class="faq-icon-box">
                                    <i class="icon-help-circle"></i>
                                </div>
                                <span class="faq-count-pill">
                                    <i class="icon-list" style="font-size: 11px;"></i>
                                    {{ $category->faqs_count ?? count($category->faqs ?? []) }} {{ __('Topics') }}
                                </span>
                            </div>

                            <!-- Body Text -->
                            <div class="faq-card-body">
                                <h3 class="faq-card-title">{{ $category->name }}</h3>
                                <p class="faq-card-text">{{ $category->text ?: __('Click to explore common questions and answers in this category.') }}</p>
                            </div>
                        </div>

                        <!-- Explore Arrow Link -->
                        <div class="faq-card-action">
                            <span>{{ __('Explore Questions') }}</span>
                            <i class="icon-arrow-right"></i>
                        </div>
                    </a>
                </div>
            @endforeach
        </div>

        <!-- Help & Support Callout Card -->
        <div class="faq-support-card">
            <div class="faq-support-left">
                <div class="faq-support-icon">
                    <i class="icon-headphones"></i>
                </div>
                <div class="faq-support-text">
                    <h5>{{ __('Still Need Assistance?') }}</h5>
                    <p>{{ __('Cannot find the answer you are looking for? Our friendly customer support team is always ready to help.') }}</p>
                </div>
            </div>
            <div class="faq-support-actions">
                <a href="{{ route('front.contact') }}" class="btn-faq-contact">
                    <i class="icon-mail"></i>
                    <span>{{ __('Contact Support') }}</span>
                </a>
                <a href="{{ route('front.index') }}" class="btn-faq-home">
                    <i class="icon-arrow-left"></i>
                    <span>{{ __('Return to Store') }}</span>
                </a>
            </div>
        </div>
    </div>
</div>

@endsection
