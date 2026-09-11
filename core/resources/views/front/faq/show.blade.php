@extends('master.front')
@section('meta')
<meta name="keywords" content="{{$category->meta_keywords}}">
<meta name="description" content="{{$category->meta_descriptions}}">
@endsection
@section('title')
    {{$category->name}} - {{__('FAQ')}}
@endsection

@section('content')

@php
    $allCategories = \App\Models\Fcategory::whereStatus(1)->withCount('faqs')->latest('id')->get();
@endphp

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

    /* Main Container Overlap */
    .faq-accordion-container {
        max-width: 960px;
        margin: -48px auto 0 auto;
        position: relative;
        z-index: 10;
        padding: 0 16px;
    }

    /* Strict suppression of any theme/bootstrap pseudo icons */
    .faq-accordion-container [data-toggle="collapse"]::before,
    .faq-accordion-container [data-toggle="collapse"]::after,
    .faq-accordion-container .accordion-toggle::before,
    .faq-accordion-container .accordion-toggle::after,
    .modern-faq-btn::before,
    .modern-faq-btn::after,
    .modern-faq-card::before,
    .modern-faq-card::after {
        content: none !important;
        display: none !important;
        width: 0 !important;
        height: 0 !important;
        opacity: 0 !important;
        visibility: hidden !important;
    }

    /* Category Quick Switcher */
    .faq-category-pills-bar {
        background: #ffffff;
        border: 1px solid #edf2f7;
        border-radius: 16px;
        padding: 10px 14px;
        margin-bottom: 20px;
        box-shadow: 0 6px 20px -6px rgba(6, 78, 59, 0.05);
        display: flex;
        align-items: center;
        gap: 8px;
        overflow-x: auto;
        white-space: nowrap;
        -webkit-overflow-scrolling: touch;
        scrollbar-width: thin;
    }

    .faq-cat-pill-item {
        display: inline-flex;
        align-items: center;
        gap: 6px;
        padding: 7px 14px;
        border-radius: 10px;
        font-size: 13px;
        font-weight: 600;
        color: #475569;
        text-decoration: none !important;
        transition: all 0.2s ease;
        background: #f8fafc;
        border: 1px solid #e2e8f0;
        flex-shrink: 0;
    }

    .faq-cat-pill-item:hover {
        background: #ecfdf5;
        color: #059669;
        border-color: #a7f3d0;
    }

    .faq-cat-pill-item.active {
        background: #059669;
        color: #ffffff !important;
        border-color: #059669;
        box-shadow: 0 2px 8px rgba(5, 150, 105, 0.25);
    }

    .faq-cat-pill-item .badge-count {
        font-size: 11px;
        padding: 2px 6px;
        border-radius: 20px;
        background: rgba(0, 0, 0, 0.06);
    }

    .faq-cat-pill-item.active .badge-count {
        background: rgba(255, 255, 255, 0.25);
        color: #ffffff;
    }

    /* Live Search Box */
    .faq-search-box-wrapper {
        margin-bottom: 20px;
    }

    .faq-search-input-group {
        position: relative;
        display: flex;
        align-items: center;
        background: #ffffff;
        border: 1.5px solid #e2e8f0;
        border-radius: 14px;
        box-shadow: 0 4px 16px -4px rgba(6, 78, 59, 0.04);
        padding: 4px 16px;
        transition: all 0.2s ease;
    }

    .faq-search-input-group:focus-within {
        border-color: #059669;
        box-shadow: 0 0 0 3px rgba(5, 150, 105, 0.12);
    }

    .faq-search-input-group .search-icon {
        color: #94a3b8;
        font-size: 16px;
        margin-right: 12px;
    }

    .faq-search-input {
        width: 100%;
        border: none;
        outline: none;
        background: transparent;
        font-size: 14.5px;
        color: #1e293b;
        padding: 10px 0;
    }

    .faq-search-input::placeholder {
        color: #94a3b8;
    }

    .faq-search-clear {
        background: transparent;
        border: none;
        color: #94a3b8;
        cursor: pointer;
        padding: 4px;
        font-size: 14px;
        border-radius: 50%;
        transition: color 0.15s ease;
    }

    .faq-search-clear:hover {
        color: #ef4444;
    }

    .faq-search-count {
        font-size: 13px;
        color: #64748b;
        margin-top: 8px;
        padding-left: 4px;
        font-weight: 500;
    }

    /* Modern Accordion Cards */
    .modern-faq-card {
        background: #ffffff !important;
        border-radius: 16px !important;
        border: 1.5px solid #edf2f7 !important;
        box-shadow: 0 6px 20px -6px rgba(6, 78, 59, 0.05), 0 1px 2px rgba(0, 0, 0, 0.02) !important;
        margin-bottom: 14px !important;
        overflow: hidden !important;
        transition: all 0.25s ease !important;
    }

    .modern-faq-card:hover {
        border-color: #a7f3d0 !important;
        box-shadow: 0 12px 28px -8px rgba(6, 78, 59, 0.09) !important;
    }

    .modern-faq-header {
        margin: 0 !important;
        padding: 0 !important;
        background: transparent !important;
        border: none !important;
    }

    .modern-faq-btn {
        width: 100% !important;
        background: #ffffff !important;
        border: none !important;
        outline: none !important;
        box-shadow: none !important;
        padding: 18px 22px !important;
        text-align: left !important;
        display: flex !important;
        flex-direction: row !important;
        align-items: center !important;
        justify-content: space-between !important;
        gap: 16px !important;
        cursor: pointer !important;
        text-decoration: none !important;
        transition: background-color 0.2s ease, color 0.2s ease !important;
        position: relative !important;
        border-radius: 16px !important;
    }

    .faq-q-left {
        display: flex !important;
        flex-direction: row !important;
        align-items: center !important;
        gap: 14px !important;
        flex: 1 1 auto !important;
        min-width: 0 !important;
    }

    .faq-q-badge {
        width: 32px !important;
        height: 32px !important;
        min-width: 32px !important;
        max-width: 32px !important;
        border-radius: 9px !important;
        background: #ecfdf5 !important;
        color: #059669 !important;
        display: inline-flex !important;
        align-items: center !important;
        justify-content: center !important;
        font-size: 14px !important;
        font-weight: 800 !important;
        flex-shrink: 0 !important;
        transition: all 0.25s ease !important;
    }

    .faq-q-text {
        font-size: 15.5px !important;
        font-weight: 700 !important;
        color: #0f172a !important;
        line-height: 1.45 !important;
        margin: 0 !important;
        flex: 1 1 auto !important;
        transition: color 0.2s ease !important;
    }

    .faq-arrow-circle {
        width: 32px !important;
        height: 32px !important;
        min-width: 32px !important;
        max-width: 32px !important;
        border-radius: 50% !important;
        background: #f8fafc !important;
        border: 1px solid #e2e8f0 !important;
        display: inline-flex !important;
        align-items: center !important;
        justify-content: center !important;
        color: #64748b !important;
        font-size: 12px !important;
        flex-shrink: 0 !important;
        margin-left: auto !important;
        transition: all 0.25s cubic-bezier(0.4, 0, 0.2, 1) !important;
    }

    /* Active / Expanded State */
    .modern-faq-btn[aria-expanded="true"]:not(.collapsed) {
        background: #f0fdf4 !important;
        border-bottom-left-radius: 0 !important;
        border-bottom-right-radius: 0 !important;
    }

    .modern-faq-btn[aria-expanded="true"]:not(.collapsed) .faq-q-badge {
        background: #059669 !important;
        color: #ffffff !important;
    }

    .modern-faq-btn[aria-expanded="true"]:not(.collapsed) .faq-q-text {
        color: #064e3b !important;
    }

    .modern-faq-btn[aria-expanded="true"]:not(.collapsed) .faq-arrow-circle {
        background: #059669 !important;
        color: #ffffff !important;
        border-color: #059669 !important;
        transform: rotate(180deg) !important;
    }

    .modern-faq-answer {
        padding: 18px 24px 22px 68px !important;
        background: #ffffff !important;
        border-top: 1px dashed #e2e8f0 !important;
    }

    .faq-answer-inner {
        font-size: 15px !important;
        line-height: 1.8 !important;
        color: #334155 !important;
    }

    .faq-answer-inner p {
        margin-bottom: 12px !important;
    }

    .faq-answer-inner p:last-child {
        margin-bottom: 0 !important;
    }

    /* Helpful Feedback Strip */
    .faq-helpful-bar {
        display: flex;
        align-items: center;
        justify-content: space-between;
        margin-top: 18px;
        padding-top: 14px;
        border-top: 1px solid #f1f5f9;
        font-size: 12.5px;
        color: #64748b;
    }

    .faq-feedback-btns {
        display: inline-flex;
        gap: 6px;
    }

    .btn-feedback {
        background: #f8fafc;
        border: 1px solid #e2e8f0;
        border-radius: 6px;
        padding: 3px 10px;
        font-size: 12px;
        color: #475569;
        cursor: pointer;
        transition: all 0.2s ease;
    }

    .btn-feedback:hover {
        background: #ecfdf5;
        border-color: #a7f3d0;
        color: #059669;
    }

    .btn-feedback.active-yes {
        background: #059669;
        color: #ffffff;
        border-color: #059669;
    }

    .btn-feedback.active-no {
        background: #64748b;
        color: #ffffff;
        border-color: #64748b;
    }

    /* Empty State */
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

    /* Navigation & Support */
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

        .faq-category-pills-bar {
            padding: 8px 10px;
            border-radius: 12px;
            margin-bottom: 14px;
        }

        .faq-cat-pill-item {
            padding: 6px 12px;
            font-size: 12px;
        }

        .modern-faq-btn {
            padding: 14px 14px !important;
            gap: 12px !important;
        }

        .faq-q-left {
            gap: 10px !important;
        }

        .faq-q-text {
            font-size: 14px !important;
        }

        .faq-q-badge {
            width: 28px !important;
            height: 28px !important;
            min-width: 28px !important;
            max-width: 28px !important;
            font-size: 12px !important;
            border-radius: 8px !important;
        }

        .faq-arrow-circle {
            width: 28px !important;
            height: 28px !important;
            min-width: 28px !important;
            max-width: 28px !important;
            font-size: 11px !important;
        }

        .modern-faq-answer {
            padding: 14px 14px 18px 14px !important;
        }

        .faq-answer-inner {
            font-size: 14px !important;
            line-height: 1.65 !important;
        }

        .faq-helpful-bar {
            flex-direction: column;
            align-items: flex-start;
            gap: 8px;
        }

        .faq-nav-card {
            flex-direction: column;
            align-items: stretch;
            padding: 18px 14px;
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
        
        <!-- Category Pill Switcher Bar -->
        @if(count($allCategories) > 1)
            <div class="faq-category-pills-bar">
                <a href="{{ route('front.faq') }}" class="faq-cat-pill-item">
                    <i class="icon-grid" style="font-size: 12px;"></i>
                    <span>{{ __('All Categories') }}</span>
                </a>
                @foreach($allCategories as $cat)
                    <a href="{{ route('front.faq.show', $cat->slug) }}" class="faq-cat-pill-item {{ $cat->id == $category->id ? 'active' : '' }}">
                        <span>{{ $cat->name }}</span>
                        <span class="badge-count">{{ $cat->faqs_count ?? count($cat->faqs) }}</span>
                    </a>
                @endforeach
            </div>
        @endif

        @if(count($category->faqs) > 0)
            <!-- Live Search Bar within this topic -->
            <div class="faq-search-box-wrapper">
                <div class="faq-search-input-group">
                    <i class="icon-search search-icon"></i>
                    <input type="text" id="faqSearchInput" class="faq-search-input" placeholder="{{ __('Type keywords to search within this category...') }}" autocomplete="off">
                    <button type="button" id="faqSearchClear" class="faq-search-clear d-none" title="{{ __('Clear search') }}">
                        <i class="icon-x"></i>
                    </button>
                </div>
                <div id="faqSearchResultsCount" class="faq-search-count d-none"></div>
            </div>

            <!-- FAQ Questions List Accordion -->
            <div id="faqAccordion">
                @foreach ($category->faqs as $key => $faq)
                    <div class="modern-faq-card" data-faq-title="{{ strtolower($faq->title) }}" data-faq-content="{{ strtolower(strip_tags($faq->details)) }}">
                        <div class="modern-faq-header" id="heading{{ $key }}">
                            <button class="modern-faq-btn {{ $key == 0 ? '' : 'collapsed' }}"
                                    type="button"
                                    data-toggle="collapse"
                                    data-target="#collapse{{ $key }}"
                                    aria-expanded="{{ $key == 0 ? 'true' : 'false' }}"
                                    aria-controls="collapse{{ $key }}">
                                <div class="faq-q-left">
                                    <span class="faq-q-badge">Q</span>
                                    <h6 class="faq-q-text">{{ $faq->title }}</h6>
                                </div>
                                <span class="faq-arrow-circle">
                                    <i class="icon-chevron-down"></i>
                                </span>
                            </button>
                        </div>
                        <div id="collapse{{ $key }}"
                             class="collapse {{ $key == 0 ? 'show' : '' }}"
                             aria-labelledby="heading{{ $key }}"
                             data-parent="#faqAccordion">
                            <div class="modern-faq-answer">
                                <div class="faq-answer-inner">
                                    {!! nl2br(e($faq->details)) !!}
                                </div>
                                <div class="faq-helpful-bar">
                                    <span>{{ __('Was this answer helpful?') }}</span>
                                    <div class="faq-feedback-btns">
                                        <button type="button" class="btn-feedback" onclick="handleFeedback(this, 'yes')">
                                            <i class="icon-thumbs-up" style="font-size: 11px;"></i> {{ __('Yes') }}
                                        </button>
                                        <button type="button" class="btn-feedback" onclick="handleFeedback(this, 'no')">
                                            <i class="icon-thumbs-down" style="font-size: 11px;"></i> {{ __('No') }}
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>

            <!-- No search matches feedback -->
            <div id="faqNoMatchCard" class="empty-faq-card d-none" style="padding: 35px 20px;">
                <div class="empty-faq-icon" style="width: 48px; height: 48px; font-size: 22px;">
                    <i class="icon-search"></i>
                </div>
                <h5>{{ __('No Matching Questions Found') }}</h5>
                <p>{{ __('Try searching with different keywords or browse the questions directly.') }}</p>
                <button type="button" class="btn-back-categories" onclick="clearFaqSearch()">
                    <i class="icon-refresh-cw"></i>
                    <span>{{ __('Reset Search') }}</span>
                </button>
            </div>
        @else
            <!-- Empty Category State -->
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

<script>
    // Live Search Filter in FAQ Questions
    document.addEventListener('DOMContentLoaded', function() {
        var searchInput = document.getElementById('faqSearchInput');
        var clearBtn = document.getElementById('faqSearchClear');
        var resultsCount = document.getElementById('faqSearchResultsCount');
        var faqCards = document.querySelectorAll('.modern-faq-card');
        var noMatchCard = document.getElementById('faqNoMatchCard');

        if (!searchInput) return;

        searchInput.addEventListener('input', function() {
            var query = this.value.trim().toLowerCase();
            
            if (query.length > 0) {
                clearBtn.classList.remove('d-none');
            } else {
                clearBtn.classList.add('d-none');
            }

            var visibleCount = 0;

            faqCards.forEach(function(card) {
                var title = card.getAttribute('data-faq-title') || '';
                var content = card.getAttribute('data-faq-content') || '';

                if (query === '' || title.indexOf(query) !== -1 || content.indexOf(query) !== -1) {
                    card.style.display = '';
                    visibleCount++;
                    
                    // If searching and there is a match, open the collapse so user sees answer immediately
                    if (query.length > 1) {
                        var collapseEl = card.querySelector('.collapse');
                        var btnEl = card.querySelector('.modern-faq-btn');
                        if (collapseEl && !collapseEl.classList.contains('show')) {
                            collapseEl.classList.add('show');
                            if (btnEl) {
                                btnEl.classList.remove('collapsed');
                                btnEl.setAttribute('aria-expanded', 'true');
                            }
                        }
                    }
                } else {
                    card.style.display = 'none';
                }
            });

            if (query.length > 0) {
                resultsCount.classList.remove('d-none');
                resultsCount.textContent = 'Found ' + visibleCount + ' matching question' + (visibleCount === 1 ? '' : 's');
                
                if (visibleCount === 0 && noMatchCard) {
                    noMatchCard.classList.remove('d-none');
                } else if (noMatchCard) {
                    noMatchCard.classList.add('d-none');
                }
            } else {
                resultsCount.classList.add('d-none');
                if (noMatchCard) noMatchCard.classList.add('d-none');
            }
        });

        if (clearBtn) {
            clearBtn.addEventListener('click', clearFaqSearch);
        }
    });

    function clearFaqSearch() {
        var searchInput = document.getElementById('faqSearchInput');
        var clearBtn = document.getElementById('faqSearchClear');
        var resultsCount = document.getElementById('faqSearchResultsCount');
        var faqCards = document.querySelectorAll('.modern-faq-card');
        var noMatchCard = document.getElementById('faqNoMatchCard');

        if (searchInput) searchInput.value = '';
        if (clearBtn) clearBtn.classList.add('d-none');
        if (resultsCount) resultsCount.classList.add('d-none');
        if (noMatchCard) noMatchCard.classList.add('d-none');

        faqCards.forEach(function(card) {
            card.style.display = '';
        });
    }

    function handleFeedback(button, type) {
        var parent = button.closest('.faq-feedback-btns');
        if (!parent) return;
        var buttons = parent.querySelectorAll('.btn-feedback');
        buttons.forEach(function(b) {
            b.disabled = true;
            b.style.opacity = '0.7';
        });
        button.style.opacity = '1';
        if (type === 'yes') {
            button.classList.add('active-yes');
            button.innerHTML = '<i class="icon-check" style="font-size: 11px;"></i> ' + '{{ __("Thank you!") }}';
        } else {
            button.classList.add('active-no');
            button.innerHTML = '<i class="icon-check" style="font-size: 11px;"></i> ' + '{{ __("Feedback noted") }}';
        }
    }
</script>

@endsection
