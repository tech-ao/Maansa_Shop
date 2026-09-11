@extends('master.front')

@section('title')
    {{ $page->title }}
@endsection

@section('meta')
    <meta name="keywords" content="{{ $page->meta_keywords ?? $setting->meta_keywords }}">
    <meta name="description" content="{{ $page->meta_descriptions ?? $setting->meta_description }}">
@endsection

@section('content')

<style>
    /* -------------------------------------------------------------
       CUSTOM PAGE - MODERN REDESIGN
       Theme: Maansa Rajashahi (Emerald & Gold)
    ------------------------------------------------------------- */
    
    /* Page Background */
    .custom-page-wrapper {
        background-color: #f8fafc;
        min-height: calc(100vh - 350px);
        padding-bottom: 70px;
    }

    /* Hero Banner */
    .custom-page-hero {
        position: relative;
        background: linear-gradient(135deg, #064e3b 0%, #065f46 55%, #047857 100%);
        padding: 55px 0 85px 0;
        color: #ffffff;
        overflow: hidden;
    }

    .custom-page-hero::before {
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

    .custom-page-hero::after {
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

    .hero-inner-content {
        position: relative;
        z-index: 2;
        max-width: 960px;
        margin: 0 auto;
    }

    /* Glassmorphism Breadcrumb */
    .custom-breadcrumb-pill {
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

    .custom-breadcrumb-pill li {
        display: inline-flex;
        align-items: center;
        color: #d1fae5;
    }

    .custom-breadcrumb-pill li a {
        color: #ffffff;
        text-decoration: none;
        font-weight: 500;
        transition: color 0.2s ease;
        display: inline-flex;
        align-items: center;
        gap: 5px;
    }

    .custom-breadcrumb-pill li a:hover {
        color: #a7f3d0;
    }

    .custom-breadcrumb-pill .sep {
        color: rgba(255, 255, 255, 0.45);
        font-size: 11px;
    }

    .custom-breadcrumb-pill .current {
        color: #a7f3d0;
        font-weight: 600;
        max-width: 260px;
        white-space: nowrap;
        overflow: hidden;
        text-overflow: ellipsis;
    }

    /* Hero Page Title */
    .hero-page-title {
        font-size: 36px;
        font-weight: 800;
        line-height: 1.25;
        letter-spacing: -0.5px;
        color: #ffffff;
        margin-bottom: 14px;
        text-shadow: 0 2px 8px rgba(0, 0, 0, 0.12);
    }

    /* Hero Meta Info Bar */
    .hero-meta-bar {
        display: flex;
        align-items: center;
        flex-wrap: wrap;
        gap: 16px;
        font-size: 13.5px;
        color: #d1fae5;
    }

    .hero-meta-badge {
        display: inline-flex;
        align-items: center;
        gap: 6px;
        background: rgba(255, 255, 255, 0.15);
        border-radius: 20px;
        padding: 4px 12px;
        font-weight: 500;
        color: #ffffff;
    }

    .hero-print-btn {
        display: inline-flex;
        align-items: center;
        gap: 6px;
        background: rgba(255, 255, 255, 0.1);
        border: 1px solid rgba(255, 255, 255, 0.25);
        color: #ffffff;
        padding: 4px 14px;
        border-radius: 20px;
        font-size: 12.5px;
        font-weight: 600;
        cursor: pointer;
        transition: all 0.2s ease;
        text-decoration: none;
    }

    .hero-print-btn:hover {
        background: #ffffff;
        color: #064e3b;
        border-color: #ffffff;
    }

    /* Main Card Container */
    .custom-page-container {
        max-width: 960px;
        margin: -48px auto 0 auto;
        position: relative;
        z-index: 10;
        padding: 0 16px;
    }

    .custom-page-card {
        background: #ffffff;
        border-radius: 20px;
        border: 1px solid #edf2f7;
        box-shadow: 0 20px 40px -15px rgba(6, 78, 59, 0.07), 0 1px 3px rgba(0, 0, 0, 0.05);
        padding: 48px 52px;
        position: relative;
    }

    /* Content Typography */
    .custom-page-article {
        font-size: 15.5px;
        line-height: 1.85;
        color: #334155;
        word-break: break-word;
    }

    .custom-page-article h1,
    .custom-page-article h2,
    .custom-page-article h3,
    .custom-page-article h4,
    .custom-page-article h5,
    .custom-page-article h6 {
        color: #0f172a;
        font-weight: 700;
        letter-spacing: -0.3px;
        margin-top: 32px;
        margin-bottom: 14px;
        line-height: 1.4;
    }

    .custom-page-article h1 {
        font-size: 28px;
        border-bottom: 2px solid #f1f5f9;
        padding-bottom: 10px;
    }

    .custom-page-article h2 {
        font-size: 22px;
        color: #064e3b;
        border-bottom: 1.5px solid #ecfdf5;
        padding-bottom: 8px;
    }

    .custom-page-article h3 {
        font-size: 18.5px;
        color: #1e293b;
    }

    .custom-page-article h4 {
        font-size: 16.5px;
    }

    .custom-page-article p {
        margin-bottom: 20px;
        color: #334155;
    }

    .custom-page-article strong,
    .custom-page-article b {
        color: #0f172a;
        font-weight: 700;
    }

    .custom-page-article a {
        color: #059669;
        font-weight: 600;
        text-decoration: underline;
        text-underline-offset: 3px;
        transition: color 0.15s ease;
    }

    .custom-page-article a:hover {
        color: #047857;
    }

    .custom-page-article ul,
    .custom-page-article ol {
        margin-top: 8px;
        margin-bottom: 22px;
        padding-left: 26px;
    }

    .custom-page-article ul li,
    .custom-page-article ol li {
        margin-bottom: 9px;
        line-height: 1.75;
        color: #334155;
    }

    .custom-page-article ul li::marker {
        color: #059669;
    }

    .custom-page-article blockquote {
        background: #f0fdf4;
        border-left: 4px solid #059669;
        border-radius: 0 12px 12px 0;
        padding: 16px 22px;
        margin: 24px 0;
        color: #166534;
        font-style: italic;
    }

    .custom-page-article table {
        width: 100%;
        border-collapse: collapse;
        margin: 24px 0;
        border-radius: 10px;
        overflow: hidden;
        border: 1px solid #e2e8f0;
    }

    .custom-page-article table th,
    .custom-page-article table td {
        padding: 12px 16px;
        border: 1px solid #e2e8f0;
        font-size: 14px;
        text-align: left;
    }

    .custom-page-article table th {
        background: #f8fafc;
        font-weight: 700;
        color: #0f172a;
    }

    .custom-page-article table tr:nth-child(even) {
        background: #fbfcfe;
    }

    .custom-page-article img {
        max-width: 100%;
        height: auto;
        border-radius: 12px;
        margin: 18px 0;
    }

    /* Help & Support Footer Card */
    .page-support-card {
        margin-top: 45px;
        padding: 24px 28px;
        background: #f0fdf4;
        border: 1px solid #bbf7d0;
        border-radius: 16px;
        display: flex;
        align-items: center;
        justify-content: space-between;
        flex-wrap: wrap;
        gap: 18px;
    }

    .support-card-left {
        display: flex;
        align-items: center;
        gap: 16px;
        flex: 1;
        min-width: 250px;
    }

    .support-card-icon {
        width: 48px;
        height: 48px;
        min-width: 48px;
        border-radius: 12px;
        background: #dcfce7;
        color: #059669;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 22px;
    }

    .support-card-text h5 {
        font-size: 16px;
        font-weight: 700;
        color: #064e3b;
        margin: 0 0 3px 0;
    }

    .support-card-text p {
        font-size: 13.5px;
        color: #166534;
        margin: 0;
    }

    .support-card-actions {
        display: flex;
        align-items: center;
        gap: 10px;
        flex-wrap: wrap;
    }

    .btn-support-contact {
        display: inline-flex;
        align-items: center;
        gap: 7px;
        background: #059669;
        color: #ffffff !important;
        font-weight: 600;
        font-size: 13.5px;
        padding: 9px 18px;
        border-radius: 10px;
        text-decoration: none !important;
        transition: all 0.2s ease;
        box-shadow: 0 2px 6px rgba(5, 150, 105, 0.25);
    }

    .btn-support-contact:hover {
        background: #047857;
        transform: translateY(-1px);
        color: #ffffff !important;
    }

    .btn-support-home {
        display: inline-flex;
        align-items: center;
        gap: 6px;
        background: #ffffff;
        color: #334155 !important;
        font-weight: 600;
        font-size: 13.5px;
        padding: 9px 16px;
        border-radius: 10px;
        border: 1px solid #cbd5e1;
        text-decoration: none !important;
        transition: all 0.2s ease;
    }

    .btn-support-home:hover {
        background: #f8fafc;
        color: #0f172a !important;
        border-color: #94a3b8;
    }

    /* -------------------------------------------------------------
       RESPONSIVE BREAKPOINTS (Mobile & Tablet)
    ------------------------------------------------------------- */
    @media (max-width: 991px) {
        .custom-page-hero {
            padding: 42px 0 72px 0;
        }

        .hero-page-title {
            font-size: 30px;
        }

        .custom-page-card {
            padding: 36px 30px;
        }
    }

    @media (max-width: 767px) {
        .custom-page-hero {
            padding: 32px 0 60px 0;
            text-align: left;
        }

        .hero-page-title {
            font-size: 24px;
            margin-bottom: 12px;
        }

        .custom-breadcrumb-pill {
            font-size: 12px;
            padding: 5px 12px;
            margin-bottom: 16px;
        }

        .custom-breadcrumb-pill .current {
            max-width: 160px;
        }

        .hero-meta-bar {
            gap: 10px;
            font-size: 12.5px;
        }

        .custom-page-container {
            margin-top: -36px;
            padding: 0 12px;
        }

        .custom-page-card {
            padding: 24px 18px;
            border-radius: 16px;
        }

        .custom-page-article {
            font-size: 14.5px;
            line-height: 1.75;
        }

        .custom-page-article h1 { font-size: 22px; }
        .custom-page-article h2 { font-size: 19px; }
        .custom-page-article h3 { font-size: 17px; }

        .page-support-card {
            padding: 18px;
            border-radius: 14px;
        }

        .support-card-left {
            gap: 12px;
        }

        .support-card-icon {
            width: 40px;
            height: 40px;
            min-width: 40px;
            font-size: 18px;
        }

        .support-card-actions {
            width: 100%;
        }

        .btn-support-contact,
        .btn-support-home {
            width: 100%;
            justify-content: center;
            padding: 10px 14px;
        }
    }

    /* Print Optimization */
    @media print {
        @page {
            margin: 1.5cm;
            size: auto;
        }

        body, html, .custom-page-wrapper {
            background: #ffffff !important;
            color: #000000 !important;
            margin: 0 !important;
            padding: 0 !important;
            min-height: auto !important;
        }

        .site-header,
        .site-footer,
        .custom-page-hero::before,
        .custom-page-hero::after,
        .hero-print-btn,
        .hero-meta-bar,
        .page-support-card,
        .custom-breadcrumb-pill,
        #announcement-modal,
        .announcement-banner,
        .announcement-with-content,
        .mfp-hide,
        .mfp-bg,
        .mfp-wrap,
        .cookie-consent-modal,
        .cookie-alert,
        #cookie-alert,
        .scroll-to-top-btn,
        .sidebar-toggle,
        .whatsapp-btn,
        .floating-btn,
        #preloader {
            display: none !important;
            visibility: hidden !important;
            opacity: 0 !important;
            height: 0 !important;
            width: 0 !important;
            position: absolute !important;
            left: -9999px !important;
        }

        .custom-page-hero {
            background: none !important;
            color: #000000 !important;
            padding: 0 0 16px 0 !important;
            border-bottom: 2px solid #333333 !important;
            margin-bottom: 20px !important;
        }

        .hero-inner-content {
            max-width: 100% !important;
            margin: 0 !important;
        }

        .hero-page-title {
            color: #000000 !important;
            font-size: 22pt !important;
            font-weight: 700 !important;
            margin: 0 !important;
            text-shadow: none !important;
        }

        .custom-page-container {
            margin-top: 0 !important;
            max-width: 100% !important;
            padding: 0 !important;
        }

        .custom-page-card {
            box-shadow: none !important;
            border: none !important;
            padding: 0 !important;
            background: transparent !important;
        }

        .custom-page-article {
            font-size: 11pt !important;
            line-height: 1.6 !important;
            color: #111111 !important;
        }

        .custom-page-article p,
        .custom-page-article li {
            color: #111111 !important;
            font-size: 11pt !important;
        }

        .custom-page-article h1,
        .custom-page-article h2,
        .custom-page-article h3,
        .custom-page-article h4 {
            color: #000000 !important;
            page-break-after: avoid;
        }
    }
</style>

<div class="custom-page-wrapper">
    <!-- Hero Header Banner -->
    <section class="custom-page-hero">
        <div class="container">
            <div class="hero-inner-content">
                <!-- Breadcrumbs -->
                <ul class="custom-breadcrumb-pill">
                    <li>
                        <a href="{{ route('front.index') }}">
                            <i class="icon-home" style="font-size: 13px;"></i>
                            <span>{{ __('Home') }}</span>
                        </a>
                    </li>
                    <li class="sep"><i class="icon-chevron-right"></i></li>
                    <li class="current" title="{{ $page->title }}">{{ $page->title }}</li>
                </ul>

                <!-- Page Title -->
                <h1 class="hero-page-title">{{ $page->title }}</h1>

                <!-- Meta Info & Print Badge -->
                <div class="hero-meta-bar">
                    <span class="hero-meta-badge">
                        <i class="icon-file-text"></i>
                        <span>{{ __('Official Document') }}</span>
                    </span>

                    @php
                        $wordCount = str_word_count(strip_tags($page->details));
                        $readTime = max(1, ceil($wordCount / 200));
                    @endphp
                    <span class="hero-meta-badge">
                        <i class="icon-clock"></i>
                        <span>{{ $readTime }} {{ __('min read') }}</span>
                    </span>

                    <button type="button" class="hero-print-btn" onclick="window.print()" title="{{ __('Print this page') }}">
                        <i class="icon-printer"></i>
                        <span>{{ __('Print') }}</span>
                    </button>
                </div>
            </div>
        </div>
    </section>

    <!-- Main Page Content Card -->
    <div class="custom-page-container">
        <div class="custom-page-card">
            <article class="custom-page-article">
                {!! $page->details !!}
            </article>

            <!-- Help & Support Callout -->
            <div class="page-support-card">
                <div class="support-card-left">
                    <div class="support-card-icon">
                        <i class="icon-help-circle"></i>
                    </div>
                    <div class="support-card-text">
                        <h5>{{ __('Need Help or Have Questions?') }}</h5>
                        <p>{{ __('Feel free to contact our customer support team for any queries regarding our policies.') }}</p>
                    </div>
                </div>
                <div class="support-card-actions">
                    <a href="{{ route('front.contact') }}" class="btn-support-contact">
                        <i class="icon-mail"></i>
                        <span>{{ __('Contact Support') }}</span>
                    </a>
                    <a href="{{ route('front.index') }}" class="btn-support-home">
                        <i class="icon-arrow-left"></i>
                        <span>{{ __('Return to Store') }}</span>
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
