@extends('master.front')
@section('meta')
<meta name="keywords" content="{{$category->meta_keywords}}">
<meta name="description" content="{{$category->meta_descriptions}}">
@endsection
@section('title')
    {{$category->name}} - {{__('FAQ')}}
@endsection

@section('content')

<style>
    /* -------------------------------------------------------------
       FAQ DETAILS / ACCORDION - MODERN REDESIGN
       Theme: Maansa Rajashahi (Emerald & Gold)
    ------------------------------------------------------------- */
    
    .faq-show-wrapper {
        background-color: #f8fafc;
        min-height: calc(100vh - 350px);
        padding-bottom: 70px;
    }

    /* Hero Banner */
    .faq-show-hero {
        position: relative;
        background: linear-gradient(135deg, #064e3b 0%, #065f46 55%, #047857 100%);
        padding: 55px 0 85px 0;
        color: #ffffff;
        overflow: hidden;
    }

    .faq-show-hero::before {
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

    .faq-show-hero::after {
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

    .faq-show-inner {
        position: relative;
        z-index: 2;
        max-width: 960px;
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
        max-width: 260px;
        white-space: nowrap;
        overflow: hidden;
        text-overflow: ellipsis;
    }

    /* Hero Typography */
    .faq-show-title {
        font-size: 36px;
        font-weight: 800;
        line-height: 1.25;
        letter-spacing: -0.5px;
        color: #ffffff;
        margin-bottom: 10px;
        text-shadow: 0 2px 8px rgba(0, 0, 0, 0.12);
    }

    .faq-show-meta {
        display: flex;
        align-items: center;
        flex-wrap: wrap;
        gap: 14px;
        font-size: 13.5px;
        color: #d1fae5;
    }

    .faq-badge-category {
        display: inline-flex;
        align-items: center;
        gap: 6px;
        background: rgba(255, 255, 255, 0.15);
        border-radius: 20px;
        padding: 4px 12px;
        font-weight: 600;
        color: #ffffff;
    }

    /* Main Accordion Container */
    .faq-accordion-container {
        max-width: 960px;
        margin: -48px auto 0 auto;
        position: relative;
        z-index: 10;
        padding: 0 16px;
    }

    /* Modern Accordion Items */
    .modern-accordion-item {
        background: #ffffff;
        border-radius: 18px;
        border: 1px solid #edf2f7;
        box-shadow: 0 14px 30px -10px rgba(6, 78, 59, 0.06), 0 1px 2px rgba(0, 0, 0, 0.04);
        margin-bottom: 18px;
        overflow: hidden;
        transition: all 0.25s ease;
    }

    .modern-accordion-item:hover {
        border-color: #bbf7d0;
        box-shadow: 0 18px 36px -10px rgba(6, 78, 59, 0.1);
    }

    .modern-accordion-header {
        margin: 0;
        padding: 0;
    }

    .modern-accordion-btn {
        width: 100%;
        background: #ffffff;
        border: none;
        outline: none;
        padding: 22px 26px;
        text-align: left;
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 16px;
        cursor: pointer;
        text-decoration: none !important;
        transition: all 0.2s ease;
    }

    .modern-accordion-btn .question-title {
        font-size: 16.5px;
        font-weight: 700;
        color: #0f172a;
        margin: 0;
        line-height: 1.45;
        display: flex;
        align-items: center;
        gap: 12px;
    }

    .modern-accordion-btn .question-icon {
        width: 32px;
        height: 32px;
        min-width: 32px;
        border-radius: 10px;
        background: #f0fdf4;
        color: #059669;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 14px;
        font-weight: 800;
    }

    .modern-accordion-btn .chevron-indicator {
        width: 32px;
        height: 32px;
        min-width: 32px;
        border-radius: 50%;
        background: #f8fafc;
        border: 1px solid #e2e8f0;
        display: flex;
        align-items: center;
        justify-content: center;
        color: #64748b;
        font-size: 13px;
        transition: all 0.25s ease;
    }

    /* Active / Expanded Accordion State */
    .modern-accordion-btn[aria-expanded="true"] {
        background: #f0fdf4;
        border-bottom: 1.5px solid #dcfce7;
    }

    .modern-accordion-btn[aria-expanded="true"] .question-title {
        color: #064e3b;
    }

    .modern-accordion-btn[aria-expanded="true"] .question-icon {
        background: #059669;
        color: #ffffff;
    }

    .modern-accordion-btn[aria-expanded="true"] .chevron-indicator {
        background: #059669;
        color: #ffffff;
        border-color: #059669;
        transform: rotate(180deg);
    }

    .modern-accordion-body {
        padding: 24px 28px 28px 28px;
        background: #ffffff;
        font-size: 15px;
        line-height: 1.8;
        color: #334155;
    }

    .modern-accordion-body p:last-child {
        margin-bottom: 0;
    }

    /* Empty FAQs State */
    .empty-faq-card {
        background: #ffffff;
        border-radius: 20px;
        border: 1px solid #edf2f7;
        box-shadow: 0 16px 35px -12px rgba(6, 78, 59, 0.07);
        padding: 50px 30px;
        text-align: center;
    }

    .empty-faq-icon {
        width: 64px;
        height: 64px;
        border-radius: 16px;
        background: #f0fdf4;
        color: #059669;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        font-size: 28px;
        margin-bottom: 16px;
    }

    .empty-faq-card h4 {
        font-size: 20px;
        font-weight: 800;
        color: #0f172a;
        margin-bottom: 8px;
    }

    .empty-faq-card p {
        color: #64748b;
        font-size: 14.5px;
        margin-bottom: 24px;
    }

    /* Navigation & Support Actions */
    .faq-nav-card {
        margin-top: 35px;
        padding: 24px 28px;
        background: #ffffff;
        border: 1px solid #e2e8f0;
        border-radius: 18px;
        box-shadow: 0 14px 30px -10px rgba(6, 78, 59, 0.06);
        display: flex;
        align-items: center;
        justify-content: space-between;
        flex-wrap: wrap;
        gap: 16px;
    }

    .btn-back-categories {
        display: inline-flex;
        align-items: center;
        gap: 7px;
        background: #f8fafc;
        color: #334155 !important;
        font-weight: 600;
        font-size: 14px;
        padding: 10px 18px;
        border-radius: 10px;
        border: 1px solid #cbd5e1;
        text-decoration: none !important;
        transition: all 0.2s ease;
    }

    .btn-back-categories:hover {
        background: #ffffff;
        color: #0f172a !important;
        border-color: #94a3b8;
    }

    .btn-ask-support {
        display: inline-flex;
        align-items: center;
        gap: 7px;
        background: #059669;
        color: #ffffff !important;
        font-weight: 700;
        font-size: 14px;
        padding: 10px 20px;
        border-radius: 10px;
        text-decoration: none !important;
        transition: all 0.2s ease;
        box-shadow: 0 3px 8px rgba(5, 150, 105, 0.25);
    }

    .btn-ask-support:hover {
        background: #047857;
        color: #ffffff !important;
        transform: translateY(-1px);
    }

    /* -------------------------------------------------------------
       RESPONSIVE BREAKPOINTS (Mobile & Tablet)
    ------------------------------------------------------------- */
    @media (max-width: 991px) {
        .faq-show-hero {
            padding: 42px 0 72px 0;
        }

        .faq-show-title {
            font-size: 30px;
        }
    }

    @media (max-width: 767px) {
        .faq-show-hero {
            padding: 32px 0 60px 0;
            text-align: left;
        }

        .faq-show-title {
            font-size: 24px;
            margin-bottom: 8px;
        }

        .faq-breadcrumb-pill {
            font-size: 12px;
            padding: 5px 12px;
            margin-bottom: 14px;
        }

        .faq-breadcrumb-pill .current {
            max-width: 150px;
        }

        .faq-accordion-container {
            margin-top: -36px;
            padding: 0 12px;
        }

        .modern-accordion-btn {
            padding: 18px 16px;
        }

        .modern-accordion-btn .question-title {
            font-size: 15px;
            gap: 10px;
        }

        .modern-accordion-btn .question-icon {
            width: 28px;
            height: 28px;
            min-width: 28px;
            font-size: 12px;
        }

        .modern-accordion-btn .chevron-indicator {
            width: 28px;
            height: 28px;
            min-width: 28px;
            font-size: 11px;
        }

        .modern-accordion-body {
            padding: 18px 18px 22px 18px;
            font-size: 14px;
            line-height: 1.7;
        }

        .faq-nav-card {
            flex-direction: column;
            align-items: stretch;
            padding: 20px 16px;
        }

        .btn-back-categories,
        .btn-ask-support {
            width: 100%;
            justify-content: center;
        }
    }
</style>

<div class="faq-show-wrapper">
    <!-- Hero Header Banner -->
    <section class="faq-show-hero">
        <div class="container">
            <div class="faq-show-inner">
                <!-- Breadcrumbs -->
                <ul class="faq-breadcrumb-pill">
                    <li>
                        <a href="{{ route('front.index') }}">
                            <i class="icon-home" style="font-size: 13px;"></i>
                            <span>{{ __('Home') }}</span>
                        </a>
                    </li>
                    <li class="sep"><i class="icon-chevron-right"></i></li>
                    <li>
                        <a href="{{ route('front.faq') }}">
                            <span>{{ __('Help & FAQ') }}</span>
                        </a>
                    </li>
                    <li class="sep"><i class="icon-chevron-right"></i></li>
                    <li class="current" title="{{ $category->name }}">{{ $category->name }}</li>
                </ul>

                <!-- Page Header Info -->
                <h1 class="faq-show-title">{{ $category->name }}</h1>
                <div class="faq-show-meta">
                    <span class="faq-badge-category">
                        <i class="icon-help-circle"></i>
                        <span>{{ count($category->faqs) }} {{ __('Questions Answered') }}</span>
                    </span>
                    <span>{{ __('Browse answers to common questions below') }}</span>
                </div>
            </div>
        </div>
    </section>

    <!-- Main Accordion List Container -->
    <div class="faq-accordion-container">
        @if(count($category->faqs) > 0)
            <div class="accordion" id="faqAccordion">
                @foreach ($category->faqs as $key => $faq)
                    <div class="modern-accordion-item">
                        <div class="modern-accordion-header" id="heading{{ $key }}">
                            <a class="modern-accordion-btn {{ $key == 0 ? '' : 'collapsed' }}"
                               data-toggle="collapse"
                               href="#collapse{{ $key }}"
                               role="button"
                               aria-expanded="{{ $key == 0 ? 'true' : 'false' }}"
                               aria-controls="collapse{{ $key }}">
                                <h6 class="question-title">
                                    <span class="question-icon">Q</span>
                                    <span>{{ $faq->title }}</span>
                                </h6>
                                <span class="chevron-indicator">
                                    <i class="icon-chevron-down"></i>
                                </span>
                            </a>
                        </div>
                        <div id="collapse{{ $key }}"
                             class="collapse {{ $key == 0 ? 'show' : '' }}"
                             aria-labelledby="heading{{ $key }}"
                             data-parent="#faqAccordion">
                            <div class="modern-accordion-body">
                                {!! nl2br(e($faq->details)) !!}
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        @else
            <!-- Empty State -->
            <div class="empty-faq-card">
                <div class="empty-faq-icon">
                    <i class="icon-help-circle"></i>
                </div>
                <h4>{{ __('No Questions Found') }}</h4>
                <p>{{ __('There are currently no published questions in this topic category.') }}</p>
                <a href="{{ route('front.faq') }}" class="btn-back-categories">
                    <i class="icon-arrow-left"></i>
                    <span>{{ __('View Other FAQ Categories') }}</span>
                </a>
            </div>
        @endif

        <!-- Bottom Navigation & Support -->
        <div class="faq-nav-card">
            <a href="{{ route('front.faq') }}" class="btn-back-categories">
                <i class="icon-arrow-left"></i>
                <span>{{ __('Back to All FAQ Categories') }}</span>
            </a>
            <a href="{{ route('front.contact') }}" class="btn-ask-support">
                <i class="icon-headphones"></i>
                <span>{{ __('Still Have Questions? Contact Support') }}</span>
            </a>
        </div>
    </div>
</div>

@endsection
