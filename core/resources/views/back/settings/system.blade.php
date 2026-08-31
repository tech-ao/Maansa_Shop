@extends('master.back')

@section('styles')
    <link rel="stylesheet" href="{{ asset('assets/back/js/plugin/codemirror/codemirror.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/back/js/plugin/codemirror/monokai.css') }}">
@endsection


@section('content')
    <div class="container-fluid">

        <!-- Page Header -->
        <div class="profile-header-card">
            <div class="profile-header-content">
                <div class="profile-title-group">
                    <h3><i class="fa-solid fa-sliders text-primary"></i> {{ __('System & General Settings') }}</h3>
                    <p>{{ __('Configure platform identity, currency formats, theme styles, media branding, and integration scripts.') }}</p>
                </div>
                <ul class="profile-breadcrumb">
                    <li><a href="{{ route('back.dashboard') }}"><i class="fa-solid fa-house"></i> {{ __('Dashboard') }}</a></li>
                    <span class="divider">/</span>
                    <li>{{ __('Manage Site') }}</li>
                    <span class="divider">/</span>
                    <li class="active">{{ __('General Settings') }}</li>
                </ul>
            </div>
        </div>

        <div class="row">
            <div class="col-lg-12">
                @include('alerts.alerts')
            </div>
        </div>

        <div class="row">
            <div class="col-12">
                <form class="admin-form" action="{{ route('back.setting.update') }}" method="POST" enctype="multipart/form-data">
                    @csrf

                    <div class="row">
                        <!-- Navigation Tabs Column -->
                        <div class="col-xl-3 col-lg-4 col-12 mb-4">
                            <div class="nav settings-nav-pills" id="v-pills-tab" role="tablist">
                                <a class="nav-link active" data-toggle="pill" href="#basic">
                                    <i class="fa-solid fa-circle-info"></i>
                                    <span>{{ __('Basic Information') }}</span>
                                </a>
                                <a class="nav-link" data-toggle="pill" href="#theme">
                                    <i class="fa-solid fa-palette"></i>
                                    <span>{{ __('Home Page Themes') }}</span>
                                </a>
                                <a class="nav-link" data-toggle="pill" href="#media">
                                    <i class="fa-solid fa-photo-film"></i>
                                    <span>{{ __('Media & Branding') }}</span>
                                </a>
                                <a class="nav-link" data-toggle="pill" href="#seo">
                                    <i class="fa-solid fa-magnifying-glass-chart"></i>
                                    <span>{{ __('SEO Optimization') }}</span>
                                </a>
                                <a class="nav-link" data-toggle="pill" href="#custom_css" id="newcss">
                                    <i class="fa-solid fa-code"></i>
                                    <span>{{ __('Custom CSS') }}</span>
                                </a>
                                <a class="nav-link" data-toggle="pill" href="#google_recaptcha">
                                    <i class="fa-solid fa-puzzle-piece"></i>
                                    <span>{{ __('Scripts & Tracking') }}</span>
                                </a>
                                <a class="nav-link" data-toggle="pill" href="#shop">
                                    <i class="fa-solid fa-cart-shopping"></i>
                                    <span>{{ __('Shop & Checkout') }}</span>
                                </a>
                                <a class="nav-link" data-toggle="pill" href="#footer">
                                    <i class="fa-solid fa-envelope-open-text"></i>
                                    <span>{{ __('Footer & Contact') }}</span>
                                </a>
                            </div>
                        </div>

                        <!-- Settings Content Column -->
                        <div class="col-xl-9 col-lg-8 col-12 mb-4">
                            <div class="settings-card-body">
                                <input type="hidden" name="is_validate" value="1">

                                <div id="tabs">
                                    <!-- Tab panes -->
                                    <div class="tab-content">
                                        <div id="basic" class="tab-pane active">
                                            <div class="settings-tab-pane-title">
                                                <i class="fa-solid fa-circle-info text-primary"></i> {{ __('Platform Identity & Formatting') }}
                                            </div>

                                            <div class="row justify-content-center">
                                                <div class="col-lg-10">
                                                    <div class="modern-form-group">
                                                        <label for="title">{{ __('App Name / Platform Title') }} <span class="required-asterisk">*</span></label>
                                                        <div class="modern-input-box">
                                                            <i class="fa-solid fa-globe input-icon-prefix"></i>
                                                            <input type="text" name="title" id="title" placeholder="{{ __('Enter Website Title') }}" value="{{ $setting->title }}" required>
                                                        </div>
                                                    </div>

                                                    <div class="modern-form-group">
                                                        <label for="home_page_title">{{ __('Home Page Browser Title') }} <span class="required-asterisk">*</span></label>
                                                        <div class="modern-input-box">
                                                            <i class="fa-solid fa-heading input-icon-prefix"></i>
                                                            <input type="text" name="home_page_title" id="home_page_title" placeholder="{{ __('Enter Home Page Title') }}" value="{{ $setting->home_page_title }}" required>
                                                        </div>
                                                    </div>

                                                    <div class="modern-form-group">
                                                        <label for="primary_color">{{ __('Primary Theme Color Code') }} <span class="required-asterisk">*</span></label>
                                                        <div class="modern-input-box">
                                                            <i class="fa-solid fa-eye-dropper input-icon-prefix"></i>
                                                            <input type="text" data-jscolor="" name="primary_color" id="primary_color" placeholder="{{ __('e.g. #FF6A00') }}" value="{{ $setting->primary_color }}" required>
                                                        </div>
                                                    </div>

                                                    <div class="row">
                                                        <div class="col-md-6">
                                                            <div class="form-group px-0">
                                                                <label for="is_decimal" style="font-weight: 700; color: #1e293b; font-size: 13px;">
                                                                    <i class="fa-solid fa-calculator text-primary mr-1"></i> {{ __('Show Decimals') }} <span class="text-danger">*</span>
                                                                </label>
                                                                <select name="is_decimal" id="is_decimal" class="form-control" style="border-radius: 12px; height: 44px;">
                                                                    <option value="1" {{ $setting->is_decimal == 1 ? 'selected' : '' }}>{{ __('Enabled (On)') }}</option>
                                                                    <option value="0" {{ $setting->is_decimal == 0 ? 'selected' : '' }}>{{ __('Disabled (Off)') }}</option>
                                                                </select>
                                                            </div>
                                                        </div>

                                                        <div class="col-md-6">
                                                            <div class="form-group px-0">
                                                                <label for="currency_direction" style="font-weight: 700; color: #1e293b; font-size: 13px;">
                                                                    <i class="fa-solid fa-coins text-primary mr-1"></i> {{ __('Currency Symbol Position') }} <span class="text-danger">*</span>
                                                                </label>
                                                                <select name="currency_direction" id="currency_direction" class="form-control" style="border-radius: 12px; height: 44px;">
                                                                    <option value="1" {{ $setting->currency_direction == 1 ? 'selected' : '' }}>{{ __('Left ($100.00)') }}</option>
                                                                    <option value="0" {{ $setting->currency_direction == 0 ? 'selected' : '' }}>{{ __('Right (100.00$)') }}</option>
                                                                </select>
                                                            </div>
                                                        </div>

                                                        <div class="col-md-6">
                                                            <div class="form-group px-0">
                                                                <label for="decimal_separator" style="font-weight: 700; color: #1e293b; font-size: 13px;">
                                                                    <i class="fa-solid fa-divide text-primary mr-1"></i> {{ __('Decimal Separator Format') }} <span class="text-danger">*</span>
                                                                </label>
                                                                <select name="decimal_separator" id="decimal_separator" class="form-control" style="border-radius: 12px; height: 44px;">
                                                                    <option value="." {{ $setting->decimal_separator == '.' ? 'selected' : '' }}>{{ __('Dot (.)') }}</option>
                                                                    <option value="," {{ $setting->decimal_separator == ',' ? 'selected' : '' }}>{{ __('Comma (,)') }}</option>
                                                                </select>
                                                            </div>
                                                        </div>

                                                        <div class="col-md-6">
                                                            <div class="form-group px-0">
                                                                <label for="thousand_separator" style="font-weight: 700; color: #1e293b; font-size: 13px;">
                                                                    <i class="fa-solid fa-hashtag text-primary mr-1"></i> {{ __('Thousand Separator Format') }} <span class="text-danger">*</span>
                                                                </label>
                                                                <select name="thousand_separator" id="thousand_separator" class="form-control" style="border-radius: 12px; height: 44px;">
                                                                    <option value="," {{ $setting->thousand_separator == ',' ? 'selected' : '' }}>{{ __('Comma (,)') }}</option>
                                                                    <option value="." {{ $setting->thousand_separator == '.' ? 'selected' : '' }}>{{ __('Dot (.)') }}</option>
                                                                </select>
                                                            </div>
                                                        </div>
                                                    </div>

                                                </div>
                                            </div>
                                        </div>

                                        <div id="theme" class="tab-pane">
                                            <div class="settings-tab-pane-title">
                                                <i class="fa-solid fa-palette text-primary"></i> {{ __('Home Page Layout & Theme Selection') }}
                                            </div>

                                            <input type="hidden" name="theme" id="selectedThemeInput" value="{{ $setting->theme }}">

                                            <p style="color: #64748b; font-size: 13.5px; margin-bottom: 22px;">
                                                {{ __('Select your preferred storefront theme layout. Click on any theme card below to activate it for your website.') }}
                                            </p>

                                            <div class="theme-card-grid">
                                                <!-- Theme 1 -->
                                                <div class="theme-select-card {{ $setting->theme == 'theme1' ? 'selected' : '' }}" onclick="selectThemeCard('theme1', this)">
                                                    <div class="theme-card-mockup-header">
                                                        <div class="mockup-dot red"></div>
                                                        <div class="mockup-dot yellow"></div>
                                                        <div class="mockup-dot green"></div>
                                                        <div class="mockup-url-bar">https://yourstore.com/home-1</div>
                                                    </div>
                                                    <div class="theme-card-img-wrap">
                                                        <img src="{{ asset('assets/back/theme1.png') }}" class="theme-card-img" alt="Home Theme 1">
                                                    </div>
                                                    <div class="theme-card-footer">
                                                        <div class="theme-title-wrap">
                                                            <h5>{{ __('Home Theme 1') }}</h5>
                                                            <p>{{ __('Classic Multi-Vendor Marketplace') }}</p>
                                                        </div>
                                                        <div class="theme-status-btn {{ $setting->theme == 'theme1' ? 'active-badge' : 'select-badge' }}">
                                                            <i class="fa-solid {{ $setting->theme == 'theme1' ? 'fa-circle-check' : 'fa-circle' }}"></i>
                                                            <span>{{ $setting->theme == 'theme1' ? __('Active Theme') : __('Select Theme') }}</span>
                                                        </div>
                                                    </div>
                                                </div>

                                                <!-- Theme 2 -->
                                                <div class="theme-select-card {{ $setting->theme == 'theme2' ? 'selected' : '' }}" onclick="selectThemeCard('theme2', this)">
                                                    <div class="theme-card-mockup-header">
                                                        <div class="mockup-dot red"></div>
                                                        <div class="mockup-dot yellow"></div>
                                                        <div class="mockup-dot green"></div>
                                                        <div class="mockup-url-bar">https://yourstore.com/home-2</div>
                                                    </div>
                                                    <div class="theme-card-img-wrap">
                                                        <img src="{{ asset('assets/back/theme2.png') }}" class="theme-card-img" alt="Home Theme 2">
                                                    </div>
                                                    <div class="theme-card-footer">
                                                        <div class="theme-title-wrap">
                                                            <h5>{{ __('Home Theme 2') }}</h5>
                                                            <p>{{ __('Fashion, Apparel & Boutique') }}</p>
                                                        </div>
                                                        <div class="theme-status-btn {{ $setting->theme == 'theme2' ? 'active-badge' : 'select-badge' }}">
                                                            <i class="fa-solid {{ $setting->theme == 'theme2' ? 'fa-circle-check' : 'fa-circle' }}"></i>
                                                            <span>{{ $setting->theme == 'theme2' ? __('Active Theme') : __('Select Theme') }}</span>
                                                        </div>
                                                    </div>
                                                </div>

                                                <!-- Theme 3 -->
                                                <div class="theme-select-card {{ $setting->theme == 'theme3' ? 'selected' : '' }}" onclick="selectThemeCard('theme3', this)">
                                                    <div class="theme-card-mockup-header">
                                                        <div class="mockup-dot red"></div>
                                                        <div class="mockup-dot yellow"></div>
                                                        <div class="mockup-dot green"></div>
                                                        <div class="mockup-url-bar">https://yourstore.com/home-3</div>
                                                    </div>
                                                    <div class="theme-card-img-wrap">
                                                        <img src="{{ asset('assets/back/theme3.png') }}" class="theme-card-img" alt="Home Theme 3">
                                                    </div>
                                                    <div class="theme-card-footer">
                                                        <div class="theme-title-wrap">
                                                            <h5>{{ __('Home Theme 3') }}</h5>
                                                            <p>{{ __('Electronics, Digital & Gadgets') }}</p>
                                                        </div>
                                                        <div class="theme-status-btn {{ $setting->theme == 'theme3' ? 'active-badge' : 'select-badge' }}">
                                                            <i class="fa-solid {{ $setting->theme == 'theme3' ? 'fa-circle-check' : 'fa-circle' }}"></i>
                                                            <span>{{ $setting->theme == 'theme3' ? __('Active Theme') : __('Select Theme') }}</span>
                                                        </div>
                                                    </div>
                                                </div>

                                                <!-- Theme 4 -->
                                                <div class="theme-select-card {{ $setting->theme == 'theme4' ? 'selected' : '' }}" onclick="selectThemeCard('theme4', this)">
                                                    <div class="theme-card-mockup-header">
                                                        <div class="mockup-dot red"></div>
                                                        <div class="mockup-dot yellow"></div>
                                                        <div class="mockup-dot green"></div>
                                                        <div class="mockup-url-bar">https://yourstore.com/home-4</div>
                                                    </div>
                                                    <div class="theme-card-img-wrap">
                                                        <img src="{{ asset('assets/back/theme4.png') }}" class="theme-card-img" alt="Home Theme 4">
                                                    </div>
                                                    <div class="theme-card-footer">
                                                        <div class="theme-title-wrap">
                                                            <h5>{{ __('Home Theme 4') }}</h5>
                                                            <p>{{ __('Modern Minimalist Mega Store') }}</p>
                                                        </div>
                                                        <div class="theme-status-btn {{ $setting->theme == 'theme4' ? 'active-badge' : 'select-badge' }}">
                                                            <i class="fa-solid {{ $setting->theme == 'theme4' ? 'fa-circle-check' : 'fa-circle' }}"></i>
                                                            <span>{{ $setting->theme == 'theme4' ? __('Active Theme') : __('Select Theme') }}</span>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <!-- Media & Branding -->
                                        <div id="media" class="tab-pane">
                                            <div class="settings-tab-pane-title">
                                                <i class="fa-solid fa-photo-film text-primary"></i> {{ __('Branding & Media Assets') }}
                                            </div>

                                            <ul class="settings-sub-pills nav nav-pills">
                                                <li class="nav-item">
                                                    <a class="nav-link active" data-toggle="pill" href="#logo">
                                                        <i class="fa-solid fa-image"></i> <span>{{ __('Website Logo') }}</span>
                                                    </a>
                                                </li>
                                                <li class="nav-item">
                                                    <a class="nav-link" data-toggle="pill" href="#favicon">
                                                        <i class="fa-solid fa-bookmark"></i> <span>{{ __('Favicon Icon') }}</span>
                                                    </a>
                                                </li>
                                                <li class="nav-item">
                                                    <a class="nav-link" data-toggle="pill" href="#loader">
                                                        <i class="fa-solid fa-spinner"></i> <span>{{ __('Page Preloader') }}</span>
                                                    </a>
                                                </li>
                                            </ul>

                                            <div class="tab-content">
                                                <!-- Logo -->
                                                <div id="logo" class="tab-pane active">
                                                    <div class="media-upload-card">
                                                        <div class="media-preview-box">
                                                            <img id="logoPreview" class="admin-setting-img"
                                                                src="{{ $setting->logo ? url('/core/public/storage/images/' . $setting->logo) : url('/core/public/storage/images/placeholder.png') }}"
                                                                alt="Logo Preview">
                                                        </div>
                                                        <div class="media-size-tag">
                                                            <i class="fa-solid fa-ruler-combined mr-1"></i> {{ __('Recommended: 140 × 40 px (PNG / SVG / WebP)') }}
                                                        </div>
                                                        <div>
                                                            <label for="logoFileInput" class="avatar-upload-btn-label">
                                                                <i class="fa-solid fa-cloud-arrow-up mr-2"></i> {{ __('Choose New Logo') }}
                                                            </label>
                                                            <input type="file" accept="image/*" class="d-none" name="logo" id="logoFileInput" onchange="previewMediaImage(this, 'logoPreview')">
                                                        </div>
                                                    </div>
                                                </div>

                                                <!-- Favicon -->
                                                <div id="favicon" class="tab-pane">
                                                    <div class="media-upload-card">
                                                        <div class="media-preview-box" style="width: 120px; height: 120px;">
                                                            <img id="faviconPreview" class="admin-setting-img" style="max-height: 48px; max-width: 48px;"
                                                                src="{{ $setting->favicon ? url('/core/public/storage/images/' . $setting->favicon) : url('/core/public/storage/images/placeholder.png') }}"
                                                                alt="Favicon Preview">
                                                        </div>
                                                        <div class="media-size-tag">
                                                            <i class="fa-solid fa-ruler-combined mr-1"></i> {{ __('Recommended: 16 × 16 or 32 × 32 px (PNG / ICO)') }}
                                                        </div>
                                                        <div>
                                                            <label for="faviconFileInput" class="avatar-upload-btn-label">
                                                                <i class="fa-solid fa-cloud-arrow-up mr-2"></i> {{ __('Choose New Favicon') }}
                                                            </label>
                                                            <input type="file" accept="image/*" class="d-none" name="favicon" id="faviconFileInput" onchange="previewMediaImage(this, 'faviconPreview')">
                                                        </div>
                                                    </div>
                                                </div>

                                                <!-- Loader -->
                                                <div id="loader" class="tab-pane">
                                                    <div class="feature-toggle-card mb-4">
                                                        <div class="feature-toggle-info">
                                                            <h6>{{ __('Enable Page Preloader') }}</h6>
                                                            <p>{{ __('Show an animated loading indicator while store pages are loading') }}</p>
                                                        </div>
                                                        <label class="switch-primary mb-0">
                                                            <input type="checkbox" class="switch switch-bootstrap" name="is_loader" value="1"
                                                                {{ $setting->is_loader == 1 ? 'checked' : '' }}>
                                                            <span class="switch-body"></span>
                                                        </label>
                                                    </div>

                                                    <div class="media-upload-card">
                                                        <div class="media-preview-box" style="width: 140px; height: 140px;">
                                                            <img id="loaderPreview" class="admin-setting-img" style="max-height: 80px;"
                                                                src="{{ $setting->loader ? url('/core/public/storage/images/' . $setting->loader) : url('/core/public/storage/images/placeholder.png') }}"
                                                                alt="Loader Preview">
                                                        </div>
                                                        <div class="media-size-tag">
                                                            <i class="fa-solid fa-ruler-combined mr-1"></i> {{ __('Recommended: Animated GIF / SVG Preloader') }}
                                                        </div>
                                                        <div>
                                                            <label for="loaderFileInput" class="avatar-upload-btn-label">
                                                                <i class="fa-solid fa-cloud-arrow-up mr-2"></i> {{ __('Choose New Preloader') }}
                                                            </label>
                                                            <input type="file" accept="image/*" class="d-none" name="loader" id="loaderFileInput" onchange="previewMediaImage(this, 'loaderPreview')">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <!-- SEO Tab -->
                                        <div id="seo" class="tab-pane">
                                            <div class="settings-tab-pane-title">
                                                <i class="fa-solid fa-magnifying-glass text-primary"></i> {{ __('Search Engine Optimization (SEO)') }}
                                            </div>

                                            <div class="media-upload-card mb-4">
                                                <div class="media-preview-box" style="max-width: 480px; min-height: 160px;">
                                                    <img id="seoMetaPreview" class="admin-setting-img" style="max-height: 180px;"
                                                        src="{{ $setting->meta_image ? url('/core/public/storage/images/' . $setting->meta_image) : url('/core/public/storage/images/placeholder.png') }}"
                                                        alt="Social Meta Banner Preview">
                                                </div>
                                                <div class="media-size-tag">
                                                    <i class="fa-solid fa-ruler-combined mr-1"></i> {{ __('OpenGraph / Twitter Meta Image: 1200 × 627 px') }}
                                                </div>
                                                <div>
                                                    <label for="metaImageInput" class="avatar-upload-btn-label">
                                                        <i class="fa-solid fa-cloud-arrow-up mr-2"></i> {{ __('Choose Social Share Image') }}
                                                    </label>
                                                    <input type="file" accept="image/*" class="d-none" name="meta_image" id="metaImageInput" onchange="previewMediaImage(this, 'seoMetaPreview')">
                                                </div>
                                            </div>

                                            <div class="form-group mb-4">
                                                <label for="meta_keywords" class="form-label font-weight-bold">
                                                    <i class="fa-solid fa-tags text-primary mr-1"></i> {{ __('Site Meta Keywords') }} *
                                                </label>
                                                <input type="text" name="meta_keywords" class="tags" id="meta_keywords"
                                                    placeholder="{{ __('Enter keyword and press enter...') }}" value="{{ $setting->meta_keywords }}">
                                                <small class="form-text text-muted">{{ __('Type keywords separated by comma or enter key for search engines.') }}</small>
                                            </div>

                                            <div class="form-group mb-3">
                                                <label for="meta_description" class="form-label font-weight-bold">
                                                    <i class="fa-solid fa-align-left text-primary mr-1"></i> {{ __('Site Meta Description') }} *
                                                </label>
                                                <textarea name="meta_description" id="meta_description" class="form-control" rows="4"
                                                    placeholder="{{ __('Enter search engine snippet description (150-160 characters recommended)...') }}">{{ $setting->meta_description }}</textarea>
                                            </div>
                                        </div>

                                        <!-- Custom CSS Tab -->
                                        <div id="custom_css" class="tab-pane">
                                            <div class="settings-tab-pane-title">
                                                <i class="fa-solid fa-code text-primary"></i> {{ __('Custom CSS Code Editor') }}
                                            </div>

                                            <p style="color: #64748b; font-size: 13.5px; margin-bottom: 18px;">
                                                {{ __('Add custom CSS rules to customize or override storefront styling without modifying theme core files.') }}
                                            </p>

                                            <div class="code-editor-frame">
                                                <div class="code-editor-header">
                                                    <div style="display: flex; align-items: center; gap: 6px;">
                                                        <div class="mockup-dot red"></div>
                                                        <div class="mockup-dot yellow"></div>
                                                        <div class="mockup-dot green"></div>
                                                        <span class="file-title ml-2"><i class="fa-brands fa-css3-alt text-primary mr-1"></i> custom-storefront.css</span>
                                                    </div>
                                                    <span style="font-size: 11px; color: #64748b;">{{ __('Live Storefront CSS') }}</span>
                                                </div>
                                                <textarea name="custom_css" class="form-control" id="custom_css_area" placeholder="{{ __('/* Enter your custom CSS rules here */') }}">{{ $setting->custom_css }}</textarea>
                                            </div>
                                        </div>

                                        <!-- Display Links Tab -->
                                        <div id="links" class="tab-pane">
                                            <div class="settings-tab-pane-title">
                                                <i class="fa-solid fa-bars-staggered text-primary"></i> {{ __('Header & Navigation Menu Modules') }}
                                            </div>

                                            <p style="color: #64748b; font-size: 13.5px; margin-bottom: 20px;">
                                                {{ __('Enable or disable visible module navigation links in your storefront main menu.') }}
                                            </p>

                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="feature-toggle-card">
                                                        <div class="feature-toggle-info">
                                                            <h6><i class="fa-solid fa-bag-shopping text-primary mr-1"></i> {{ __('Display Shop') }}</h6>
                                                            <p>{{ __('Show all-products catalog in menu') }}</p>
                                                        </div>
                                                        <label class="switch-primary mb-0">
                                                            <input type="checkbox" class="switch switch-bootstrap status" name="is_shop" value="1"
                                                                {{ $setting->is_shop == 1 ? 'checked' : '' }}>
                                                            <span class="switch-body"></span>
                                                        </label>
                                                    </div>
                                                </div>

                                                <div class="col-md-6">
                                                    <div class="feature-toggle-card">
                                                        <div class="feature-toggle-info">
                                                            <h6><i class="fa-solid fa-newspaper text-info mr-1"></i> {{ __('Display Blog') }}</h6>
                                                            <p>{{ __('Show blog articles & news') }}</p>
                                                        </div>
                                                        <label class="switch-primary mb-0">
                                                            <input type="checkbox" class="switch switch-bootstrap status" name="is_blog" value="1"
                                                                {{ $setting->is_blog == 1 ? 'checked' : '' }}>
                                                            <span class="switch-body"></span>
                                                        </label>
                                                    </div>
                                                </div>

                                                <div class="col-md-6">
                                                    <div class="feature-toggle-card">
                                                        <div class="feature-toggle-info">
                                                            <h6><i class="fa-solid fa-bullhorn text-warning mr-1"></i> {{ __('Display Campaign') }}</h6>
                                                            <p>{{ __('Show flash sales & promotional deals') }}</p>
                                                        </div>
                                                        <label class="switch-primary mb-0">
                                                            <input type="checkbox" class="switch switch-bootstrap status" name="is_campaign" value="1"
                                                                {{ $setting->is_campaign == 1 ? 'checked' : '' }}>
                                                            <span class="switch-body"></span>
                                                        </label>
                                                    </div>
                                                </div>

                                                <div class="col-md-6">
                                                    <div class="feature-toggle-card">
                                                        <div class="feature-toggle-info">
                                                            <h6><i class="fa-solid fa-certificate text-success mr-1"></i> {{ __('Display Brands') }}</h6>
                                                            <p>{{ __('Show official brands catalog link') }}</p>
                                                        </div>
                                                        <label class="switch-primary mb-0">
                                                            <input type="checkbox" class="switch switch-bootstrap status" name="is_brands" value="1"
                                                                {{ $setting->is_brands == 1 ? 'checked' : '' }}>
                                                            <span class="switch-body"></span>
                                                        </label>
                                                    </div>
                                                </div>

                                                <div class="col-md-6">
                                                    <div class="feature-toggle-card">
                                                        <div class="feature-toggle-info">
                                                            <h6><i class="fa-solid fa-circle-question text-purple mr-1"></i> {{ __('Display FAQ') }}</h6>
                                                            <p>{{ __('Show frequently asked questions page') }}</p>
                                                        </div>
                                                        <label class="switch-primary mb-0">
                                                            <input type="checkbox" class="switch switch-bootstrap status" name="is_faq" value="1"
                                                                {{ $setting->is_faq == 1 ? 'checked' : '' }}>
                                                            <span class="switch-body"></span>
                                                        </label>
                                                    </div>
                                                </div>

                                                <div class="col-md-6">
                                                    <div class="feature-toggle-card">
                                                        <div class="feature-toggle-info">
                                                            <h6><i class="fa-solid fa-envelope-open-text text-danger mr-1"></i> {{ __('Display Contact') }}</h6>
                                                            <p>{{ __('Show contact us page in header menu') }}</p>
                                                        </div>
                                                        <label class="switch-primary mb-0">
                                                            <input type="checkbox" class="switch switch-bootstrap status" name="is_contact" value="1"
                                                                {{ $setting->is_contact == 1 ? 'checked' : '' }}>
                                                            <span class="switch-body"></span>
                                                        </label>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <!-- Third Party Tracking / Recaptcha Tab -->
                                        <div id="google_recaptcha" class="tab-pane">
                                            <div class="settings-tab-pane-title">
                                                <i class="fa-solid fa-code-branch text-primary"></i> {{ __('Third-Party Integrations & Tracking Scripts') }}
                                            </div>

                                            <!-- Google Analytics -->
                                            <div class="integration-card">
                                                <div class="integration-card-header">
                                                    <div class="integration-title-group">
                                                        <div class="integration-icon-wrap" style="background: #eef2ff; color: #4f46e5;">
                                                            <i class="fa-brands fa-google"></i>
                                                        </div>
                                                        <div>
                                                            <h5>{{ __('Google Analytics') }}</h5>
                                                            <p>{{ __('Track visitor traffic, page views, and eCommerce conversion events') }}</p>
                                                        </div>
                                                    </div>
                                                    <label class="switch-primary mb-0">
                                                        <input type="checkbox" class="switch switch-bootstrap status" name="is_google_analytics" value="1"
                                                            {{ $setting->is_google_analytics == 1 ? 'checked' : '' }}>
                                                        <span class="switch-body"></span>
                                                    </label>
                                                </div>
                                                <div class="form-group mb-0">
                                                    <label class="form-label font-weight-bold">{{ __('Google Analytics Tag / Tracking Script') }} *</label>
                                                    <textarea name="google_analytics" class="form-control" rows="3"
                                                        placeholder="{{ __('<!-- Google tag (gtag.js) --> ...') }}">{{ $setting->google_analytics }}</textarea>
                                                </div>
                                            </div>

                                            <!-- Google AdSense -->
                                            <div class="integration-card">
                                                <div class="integration-card-header">
                                                    <div class="integration-title-group">
                                                        <div class="integration-icon-wrap" style="background: #fef3c7; color: #d97706;">
                                                            <i class="fa-solid fa-rectangle-ad"></i>
                                                        </div>
                                                        <div>
                                                            <h5>{{ __('Google AdSense') }}</h5>
                                                            <p>{{ __('Display Google advertisements across your storefront') }}</p>
                                                        </div>
                                                    </div>
                                                    <label class="switch-primary mb-0">
                                                        <input type="checkbox" class="switch switch-bootstrap status" name="is_google_adsense" value="1"
                                                            {{ $setting->is_google_adsense == 1 ? 'checked' : '' }}>
                                                        <span class="switch-body"></span>
                                                    </label>
                                                </div>
                                                <div class="form-group mb-0">
                                                    <label class="form-label font-weight-bold">{{ __('Google AdSense Script Code') }} *</label>
                                                    <textarea name="google_adsense" class="form-control" rows="3"
                                                        placeholder="{{ __('Enter Google AdSense script tags...') }}">{{ $setting->google_adsense }}</textarea>
                                                </div>
                                            </div>

                                            <!-- Google reCAPTCHA -->
                                            <div class="integration-card">
                                                <div class="integration-card-header">
                                                    <div class="integration-title-group">
                                                        <div class="integration-icon-wrap" style="background: #e0f2fe; color: #0284c7;">
                                                            <i class="fa-solid fa-shield-halved"></i>
                                                        </div>
                                                        <div>
                                                            <h5>{{ __('Google reCAPTCHA v2 / v3') }}</h5>
                                                            <p>{{ __('Protect login, registration, and checkout from spam bots') }}</p>
                                                        </div>
                                                    </div>
                                                    <label class="switch-primary mb-0">
                                                        <input type="checkbox" class="switch switch-bootstrap status" name="recaptcha" value="1"
                                                            {{ $setting->recaptcha == 1 ? 'checked' : '' }}>
                                                        <span class="switch-body"></span>
                                                    </label>
                                                </div>
                                                <div class="row">
                                                    <div class="col-md-6 mb-3">
                                                        <label for="google_recaptcha_site_key" class="form-label font-weight-bold">{{ __('reCAPTCHA Site Key') }} *</label>
                                                        <div class="input-group">
                                                            <div class="input-group-prepend">
                                                                <span class="input-group-text bg-light"><i class="fa-solid fa-key text-muted"></i></span>
                                                            </div>
                                                            <input type="text" name="google_recaptcha_site_key" class="form-control" id="google_recaptcha_site_key"
                                                                placeholder="{{ __('Site Key') }}" value="{{ $setting->google_recaptcha_site_key }}">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6 mb-3">
                                                        <label for="google_recaptcha_secret_key" class="form-label font-weight-bold">{{ __('reCAPTCHA Secret Key') }}</label>
                                                        <div class="input-group">
                                                            <div class="input-group-prepend">
                                                                <span class="input-group-text bg-light"><i class="fa-solid fa-lock text-muted"></i></span>
                                                            </div>
                                                            <input type="text" name="google_recaptcha_secret_key" class="form-control" id="google_recaptcha_secret_key"
                                                                placeholder="{{ __('Secret Key') }}" value="{{ $setting->google_recaptcha_secret_key }}">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <!-- Facebook Pixel -->
                                            <div class="integration-card">
                                                <div class="integration-card-header">
                                                    <div class="integration-title-group">
                                                        <div class="integration-icon-wrap" style="background: #ede9fe; color: #7c3aed;">
                                                            <i class="fa-brands fa-facebook"></i>
                                                        </div>
                                                        <div>
                                                            <h5>{{ __('Facebook (Meta) Pixel') }}</h5>
                                                            <p>{{ __('Track conversions from Facebook and Instagram ads') }}</p>
                                                        </div>
                                                    </div>
                                                    <label class="switch-primary mb-0">
                                                        <input type="checkbox" class="switch switch-bootstrap status" name="is_facebook_pixel" value="1"
                                                            {{ $setting->is_facebook_pixel == 1 ? 'checked' : '' }}>
                                                        <span class="switch-body"></span>
                                                    </label>
                                                </div>
                                                <div class="form-group mb-0">
                                                    <label class="form-label font-weight-bold">{{ __('Facebook Pixel Code') }} *</label>
                                                    <textarea name="facebook_pixel" class="form-control" rows="3"
                                                        placeholder="{{ __('<!-- Meta Pixel Code --> ...') }}">{{ $setting->facebook_pixel }}</textarea>
                                                </div>
                                            </div>

                                            <!-- Facebook Messenger Live Chat -->
                                            <div class="integration-card">
                                                <div class="integration-card-header">
                                                    <div class="integration-title-group">
                                                        <div class="integration-icon-wrap" style="background: #e0e7ff; color: #4338ca;">
                                                            <i class="fa-brands fa-facebook-messenger"></i>
                                                        </div>
                                                        <div>
                                                            <h5>{{ __('Facebook Messenger Live Chat') }}</h5>
                                                            <p>{{ __('Enable real-time customer support chat on your storefront') }}</p>
                                                        </div>
                                                    </div>
                                                    <label class="switch-primary mb-0">
                                                        <input type="checkbox" class="switch switch-bootstrap status" name="is_facebook_messenger" value="1"
                                                            {{ $setting->is_facebook_messenger == 1 ? 'checked' : '' }}>
                                                        <span class="switch-body"></span>
                                                    </label>
                                                </div>
                                                <div class="form-group mb-0">
                                                    <label class="form-label font-weight-bold">{{ __('Facebook Page ID') }} *</label>
                                                    <div class="input-group">
                                                        <div class="input-group-prepend">
                                                            <span class="input-group-text bg-light"><i class="fa-brands fa-facebook-messenger text-muted"></i></span>
                                                        </div>
                                                        <input type="text" name="facebook_messenger" class="form-control"
                                                            placeholder="{{ __('Enter Facebook Page ID') }}" value="{{ $setting->facebook_messenger }}">
                                                    </div>
                                                </div>
                                            </div>

                                            <!-- Disqus Comments -->
                                            <div class="integration-card">
                                                <div class="integration-card-header">
                                                    <div class="integration-title-group">
                                                        <div class="integration-icon-wrap" style="background: #fee2e2; color: #dc2626;">
                                                            <i class="fa-solid fa-comments"></i>
                                                        </div>
                                                        <div>
                                                            <h5>{{ __('Disqus Blog Comments') }}</h5>
                                                            <p>{{ __('Enable community discussions on blog posts') }}</p>
                                                        </div>
                                                    </div>
                                                    <label class="switch-primary mb-0">
                                                        <input type="checkbox" class="switch switch-bootstrap status" name="is_disqus" value="1"
                                                            {{ $setting->is_disqus == 1 ? 'checked' : '' }}>
                                                        <span class="switch-body"></span>
                                                    </label>
                                                </div>
                                                <div class="form-group mb-0">
                                                    <label class="form-label font-weight-bold">{{ __('Disqus Embed Code / Shortname URL') }} *</label>
                                                    <textarea name="disqus" class="form-control" rows="2"
                                                        placeholder="{{ __('https://your-app.disqus.com/embed.js') }}">{{ $setting->disqus }}</textarea>
                                                </div>
                                            </div>
                                        </div>

                                        <!-- Shop & Checkout Tab -->
                                        <div id="shop" class="tab-pane">
                                            <div class="settings-tab-pane-title">
                                                <i class="fa-solid fa-cart-shopping text-primary"></i> {{ __('Shop, Product Filters & Checkout Settings') }}
                                            </div>

                                            <div class="row">
                                                <div class="col-12 mb-3">
                                                    <h6 class="font-weight-bold text-dark mb-2"><i class="fa-solid fa-store text-primary mr-1"></i> {{ __('Storefront Display & Filters') }}</h6>
                                                </div>

                                                <div class="col-md-4">
                                                    <div class="feature-toggle-card">
                                                        <div class="feature-toggle-info">
                                                            <h6>{{ __('Show Categories') }}</h6>
                                                            <p>{{ __('Header mega category menu') }}</p>
                                                        </div>
                                                        <label class="switch-primary mb-0">
                                                            <input type="checkbox" class="switch switch-bootstrap status" name="is_show_category" value="1"
                                                                {{ $setting->is_show_category == 1 ? 'checked' : '' }}>
                                                            <span class="switch-body"></span>
                                                        </label>
                                                    </div>
                                                </div>

                                                <div class="col-md-4">
                                                    <div class="feature-toggle-card">
                                                        <div class="feature-toggle-info">
                                                            <h6>{{ __('Attribute Filter') }}</h6>
                                                            <p>{{ __('Filter by size, color, etc.') }}</p>
                                                        </div>
                                                        <label class="switch-primary mb-0">
                                                            <input type="checkbox" class="switch switch-bootstrap status" name="is_attribute_search" value="1"
                                                                {{ $setting->is_attribute_search == 1 ? 'checked' : '' }}>
                                                            <span class="switch-body"></span>
                                                        </label>
                                                    </div>
                                                </div>

                                                <div class="col-md-4">
                                                    <div class="feature-toggle-card">
                                                        <div class="feature-toggle-info">
                                                            <h6>{{ __('Price Filter') }}</h6>
                                                            <p>{{ __('Filter by price slider') }}</p>
                                                        </div>
                                                        <label class="switch-primary mb-0">
                                                            <input type="checkbox" class="switch switch-bootstrap status" name="is_range_search" value="1"
                                                                {{ $setting->is_range_search == 1 ? 'checked' : '' }}>
                                                            <span class="switch-body"></span>
                                                        </label>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="row mt-3">
                                                <div class="col-md-4 mb-3">
                                                    <label for="attribute_type" class="form-label font-weight-bold">{{ __('Product Attribute Display') }} *</label>
                                                    <select name="attribute_type" class="form-control" id="attribute_type">
                                                        <option value="selectbox" {{ $setting->attribute_type == 'selectbox' ? 'selected' : '' }}>
                                                            {{ __('Dropdown Select Box') }}
                                                        </option>
                                                        <option value="radio" {{ $setting->attribute_type == 'radio' ? 'selected' : '' }}>
                                                            {{ __('Radio Buttons / Swatches') }}
                                                        </option>
                                                    </select>
                                                </div>

                                                <div class="col-md-4 mb-3">
                                                    <label for="view_product" class="form-label font-weight-bold">{{ __('Products Per Page') }} *</label>
                                                    <div class="input-group">
                                                        <div class="input-group-prepend">
                                                            <span class="input-group-text bg-light"><i class="fa-solid fa-list-ol text-muted"></i></span>
                                                        </div>
                                                        <input type="number" name="view_product" class="form-control" id="view_product"
                                                            placeholder="16" value="{{ $setting->view_product }}">
                                                    </div>
                                                </div>

                                                <div class="col-md-4 mb-3">
                                                    <label for="max_price" class="form-label font-weight-bold">{{ __('Maximum Price Filter Range') }} *</label>
                                                    <div class="input-group">
                                                        <div class="input-group-prepend">
                                                            <span class="input-group-text bg-light"><i class="fa-solid fa-money-bill-wave text-muted"></i></span>
                                                        </div>
                                                        <input type="number" name="max_price" class="form-control" id="max_price"
                                                            placeholder="10000" value="{{ $setting->max_price }}">
                                                    </div>
                                                </div>
                                            </div>

                                            <hr class="my-4">

                                            <!-- Checkout Toggles -->
                                            <div class="row">
                                                <div class="col-12 mb-3">
                                                    <h6 class="font-weight-bold text-dark mb-2"><i class="fa-solid fa-credit-card text-success mr-1"></i> {{ __('Checkout & Terms Policy') }}</h6>
                                                </div>

                                                <div class="col-md-4">
                                                    <div class="feature-toggle-card">
                                                        <div class="feature-toggle-info">
                                                            <h6>{{ __('Single Page Checkout') }}</h6>
                                                            <p>{{ __('One-step streamlined checkout') }}</p>
                                                        </div>
                                                        <label class="switch-primary mb-0">
                                                            <input type="checkbox" class="switch switch-bootstrap status" name="is_single_checkout" value="1"
                                                                {{ $setting->is_single_checkout == 1 ? 'checked' : '' }}>
                                                            <span class="switch-body"></span>
                                                        </label>
                                                    </div>
                                                </div>

                                                <div class="col-md-4">
                                                    <div class="feature-toggle-card">
                                                        <div class="feature-toggle-info">
                                                            <h6>{{ __('Guest Checkout') }}</h6>
                                                            <p>{{ __('Allow buy without account') }}</p>
                                                        </div>
                                                        <label class="switch-primary mb-0">
                                                            <input type="checkbox" class="switch switch-bootstrap status" name="is_guest_checkout" value="1"
                                                                {{ $setting->is_guest_checkout == 1 ? 'checked' : '' }}>
                                                            <span class="switch-body"></span>
                                                        </label>
                                                    </div>
                                                </div>

                                                <div class="col-md-4">
                                                    <div class="feature-toggle-card">
                                                        <div class="feature-toggle-info">
                                                            <h6>{{ __('Privacy & Terms Consent') }}</h6>
                                                            <p>{{ __('Require checkbox at checkout') }}</p>
                                                        </div>
                                                        <label class="switch-primary mb-0">
                                                            <input type="checkbox" class="switch switch-bootstrap status" name="is_privacy_trams" value="1"
                                                                {{ $setting->is_privacy_trams == 1 ? 'checked' : '' }}>
                                                            <span class="switch-body"></span>
                                                        </label>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="row mt-3">
                                                <div class="col-md-6 mb-3">
                                                    <label for="policy_link" class="form-label font-weight-bold">{{ __('Privacy Policy URL') }} *</label>
                                                    <div class="input-group">
                                                        <div class="input-group-prepend">
                                                            <span class="input-group-text bg-light"><i class="fa-solid fa-shield-halved text-muted"></i></span>
                                                        </div>
                                                        <input type="text" name="policy_link" class="form-control" id="policy_link"
                                                            placeholder="{{ __('https://yourstore.com/privacy-policy') }}" value="{{ $setting->policy_link }}">
                                                    </div>
                                                </div>

                                                <div class="col-md-6 mb-3">
                                                    <label for="terms_link" class="form-label font-weight-bold">{{ __('Terms of Service URL') }} *</label>
                                                    <div class="input-group">
                                                        <div class="input-group-prepend">
                                                            <span class="input-group-text bg-light"><i class="fa-solid fa-file-contract text-muted"></i></span>
                                                        </div>
                                                        <input type="text" name="terms_link" class="form-control" id="terms_link"
                                                            placeholder="{{ __('https://yourstore.com/terms-and-conditions') }}" value="{{ $setting->terms_link }}">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <!-- Footer & Contact Tab -->
                                        <div id="footer" class="tab-pane">
                                            <div class="settings-tab-pane-title">
                                                <i class="fa-solid fa-shoe-prints text-primary"></i> {{ __('Footer Information, Social Links & Hours') }}
                                            </div>

                                            <ul class="settings-sub-pills nav nav-pills">
                                                <li class="nav-item">
                                                    <a class="nav-link active" data-toggle="pill" href="#footer_basic">
                                                        <i class="fa-solid fa-circle-info"></i> <span>{{ __('Contact Information') }}</span>
                                                    </a>
                                                </li>
                                                <li class="nav-item">
                                                    <a class="nav-link" data-toggle="pill" href="#footer_link">
                                                        <i class="fa-solid fa-share-nodes"></i> <span>{{ __('Social Media Links') }}</span>
                                                    </a>
                                                </li>
                                                <li class="nav-item">
                                                    <a class="nav-link" data-toggle="pill" href="#working_days">
                                                        <i class="fa-solid fa-clock"></i> <span>{{ __('Working Days & Hours') }}</span>
                                                    </a>
                                                </li>
                                            </ul>

                                            <div class="tab-content">
                                                <!-- Footer Basic -->
                                                <div id="footer_basic" class="tab-pane active">
                                                    <div class="row">
                                                        <div class="col-md-12 mb-3">
                                                            <label for="footer_address" class="form-label font-weight-bold">{{ __('Store Physical Address') }} *</label>
                                                            <div class="input-group">
                                                                <div class="input-group-prepend">
                                                                    <span class="input-group-text bg-light"><i class="fa-solid fa-location-dot text-danger"></i></span>
                                                                </div>
                                                                <input type="text" name="footer_address" class="form-control" id="footer_address"
                                                                    placeholder="{{ __('123 Commerce Way, New York, NY') }}" value="{{ $setting->footer_address }}">
                                                            </div>
                                                        </div>

                                                        <div class="col-md-6 mb-3">
                                                            <label for="footer_phone" class="form-label font-weight-bold">{{ __('Store Phone Number') }} *</label>
                                                            <div class="input-group">
                                                                <div class="input-group-prepend">
                                                                    <span class="input-group-text bg-light"><i class="fa-solid fa-phone text-success"></i></span>
                                                                </div>
                                                                <input type="text" name="footer_phone" class="form-control" id="footer_phone"
                                                                    placeholder="{{ __('+1 (555) 123-4567') }}" value="{{ $setting->footer_phone }}">
                                                            </div>
                                                        </div>

                                                        <div class="col-md-6 mb-3">
                                                            <label for="footer_email" class="form-label font-weight-bold">{{ __('Store Support Email') }} *</label>
                                                            <div class="input-group">
                                                                <div class="input-group-prepend">
                                                                    <span class="input-group-text bg-light"><i class="fa-solid fa-envelope text-primary"></i></span>
                                                                </div>
                                                                <input type="email" name="footer_email" class="form-control" id="footer_email"
                                                                    placeholder="{{ __('support@yourstore.com') }}" value="{{ $setting->footer_email }}">
                                                            </div>
                                                        </div>

                                                        <div class="col-12 mb-3">
                                                            <label class="form-label font-weight-bold">{{ __('Payment Gateway Badge Banner') }}</label>
                                                            <div class="media-upload-card py-3">
                                                                <div class="media-preview-box" style="max-width: 400px; min-height: 60px;">
                                                                    <img id="footerGatewayPreview" class="admin-setting-img" style="max-height: 48px;"
                                                                        src="{{ $setting->footer_gateway_img ? url('/core/public/storage/images/' . $setting->footer_gateway_img) : url('/core/public/storage/images/placeholder.png') }}"
                                                                        alt="Payment Gateways Preview">
                                                                </div>
                                                                <div class="media-size-tag">
                                                                    <i class="fa-solid fa-ruler-combined mr-1"></i> {{ __('Recommended: 324 × 31 px (PNG / WebP)') }}
                                                                </div>
                                                                <div>
                                                                    <label for="footerGatewayInput" class="avatar-upload-btn-label">
                                                                        <i class="fa-solid fa-cloud-arrow-up mr-2"></i> {{ __('Choose Gateway Image') }}
                                                                    </label>
                                                                    <input type="file" accept="image/*" class="d-none" name="footer_gateway_img" id="footerGatewayInput" onchange="previewMediaImage(this, 'footerGatewayPreview')">
                                                                </div>
                                                            </div>
                                                        </div>

                                                        <div class="col-12 mb-3">
                                                            <label for="copy_right" class="form-label font-weight-bold">{{ __('Footer Copyright Text') }} *</label>
                                                            <div class="input-group">
                                                                <div class="input-group-prepend">
                                                                    <span class="input-group-text bg-light"><i class="fa-regular fa-copyright text-muted"></i></span>
                                                                </div>
                                                                <textarea name="copy_right" id="copy_right" class="form-control" rows="2"
                                                                    placeholder="{{ __('© 2026 OmniMart. All Rights Reserved.') }}">{{ $setting->copy_right }}</textarea>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                                <!-- Footer Social Links -->
                                                <div id="footer_link" class="tab-pane">
                                                    <div id="social-section">
                                                        <div class="d-flex justify-content-between align-items-center mb-3">
                                                            <h6 class="font-weight-bold text-dark mb-0"><i class="fa-solid fa-icons text-primary mr-1"></i> {{ __('Social Media Channels') }}</h6>
                                                            <button type="button" class="btn btn-sm btn-primary add-social" data-text="{{ __('Social Link') }}" style="border-radius: 8px; font-weight: 700;">
                                                                <i class="fa-solid fa-plus mr-1"></i> {{ __('Add Channel') }}
                                                            </button>
                                                        </div>
                                                        @php
                                                            $links = json_decode($setting->social_link, true)['links'] ?? [];
                                                            $icons = json_decode($setting->social_link, true)['icons'] ?? [];
                                                        @endphp
                                                        @foreach ($links as $link_key => $link)
                                                            <div class="d-flex align-items-center gap-2 mb-3" style="gap: 10px;">
                                                                <div>
                                                                    <button class="btn btn-secondary social-picker" name="social_icons[]" data-icon="{{ $icons[$link_key] ?? 'fa-brands fa-facebook' }}" style="border-radius: 10px; height: 42px; min-width: 48px;"></button>
                                                                </div>
                                                                <div class="flex-grow-1">
                                                                    <input type="text" class="form-control" name="social_links[]" placeholder="{{ __('https://facebook.com/yourpage') }}" value="{{ $link }}" style="height: 42px;">
                                                                </div>
                                                                <div>
                                                                    <button type="button" class="btn btn-outline-danger remove-social" data-text="{{ __('Social Link') }}" style="border-radius: 10px; height: 42px; width: 42px; padding: 0;">
                                                                        <i class="fa-solid fa-trash-can"></i>
                                                                    </button>
                                                                </div>
                                                            </div>
                                                        @endforeach
                                                    </div>
                                                </div>

                                                <!-- Footer Working Days -->
                                                <div id="working_days" class="tab-pane">
                                                    <div class="row">
                                                        <div class="col-md-12 mb-3">
                                                            <label for="working_days_from_to" class="form-label font-weight-bold">{{ __('Operating Days') }} *</label>
                                                            <div class="input-group">
                                                                <div class="input-group-prepend">
                                                                    <span class="input-group-text bg-light"><i class="fa-solid fa-calendar-days text-primary"></i></span>
                                                                </div>
                                                                <input type="text" name="working_days_from_to" class="form-control" id="working_days_from_to"
                                                                    placeholder="{{ __('Monday - Friday') }}" value="{{ $setting->working_days_from_to }}">
                                                            </div>
                                                        </div>

                                                        <div class="col-md-6 mb-3">
                                                            <label for="friday_start" class="form-label font-weight-bold">{{ __('Opening Time') }} *</label>
                                                            <div class="input-group">
                                                                <div class="input-group-prepend">
                                                                    <span class="input-group-text bg-light"><i class="fa-regular fa-clock text-success"></i></span>
                                                                </div>
                                                                <input type="text" name="friday_start" class="form-control timepicker" id="friday_start"
                                                                    placeholder="{{ __('09:00 AM') }}" value="{{ $setting->friday_start }}">
                                                            </div>
                                                        </div>

                                                        <div class="col-md-6 mb-3">
                                                            <label for="friday_end" class="form-label font-weight-bold">{{ __('Closing Time') }} *</label>
                                                            <div class="input-group">
                                                                <div class="input-group-prepend">
                                                                    <span class="input-group-text bg-light"><i class="fa-regular fa-clock text-danger"></i></span>
                                                                </div>
                                                                <input type="text" name="friday_end" class="form-control timepicker" id="friday_end"
                                                                    placeholder="{{ __('06:00 PM') }}" value="{{ $setting->friday_end }}">
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                            </div>
                                        </div>
                                    <div class="form-group d-flex justify-content-center mt-4 pt-3" style="border-top: 1px solid #f1f5f9;">
                                        <button type="submit" class="btn-save-profile" style="color: #ffffff !important;">
                                            <i class="fa-solid fa-floppy-disk" style="color: #ffffff !important;"></i>
                                            <span style="color: #ffffff !important;">{{ __('Save All Settings') }}</span>
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection


@section('scripts')
    <script src="{{ asset('assets/back/js/plugin/codemirror/codemirror.js') }}"></script>
    <script src="{{ asset('assets/back/js/plugin/codemirror/css.js') }}"></script>
    <script>
        $(document).ready(function() {
            var editor = null;
            var cssArea = document.getElementById("custom_css_area");
            if (cssArea) {
                editor = CodeMirror.fromTextArea(cssArea, {
                    mode: "text/css",
                    matchBrackets: true,
                    theme: "monokai"
                });
            }

            // Save active tab on pill change
            $('#v-pills-tab a[data-toggle="pill"]').on('shown.bs.tab', function(e) {
                var hash = $(e.target).attr('href');
                if (hash) {
                    sessionStorage.setItem('active_settings_tab', hash);
                    if (history.replaceState) {
                        history.replaceState(null, null, hash);
                    }
                }
                if (hash === '#custom_css' && editor) {
                    setTimeout(function() {
                        editor.refresh();
                    }, 100);
                }
            });

            // Ensure active tab is saved right before submitting form
            $('form.admin-form').on('submit', function() {
                var currentActive = $('#v-pills-tab a.active').attr('href');
                if (currentActive) {
                    sessionStorage.setItem('active_settings_tab', currentActive);
                }
            });

            // Restore active tab from URL hash or sessionStorage
            var activeTab = window.location.hash || sessionStorage.getItem('active_settings_tab');
            if (activeTab && activeTab.startsWith('#')) {
                var targetPill = $('#v-pills-tab a[href="' + activeTab + '"]');
                if (targetPill.length) {
                    targetPill.tab('show');
                    if (activeTab === '#custom_css' && editor) {
                        setTimeout(function() {
                            editor.refresh();
                        }, 150);
                    }
                }
            }
        });

        function selectThemeCard(themeValue, cardElement) {
            document.getElementById('selectedThemeInput').value = themeValue;
            document.querySelectorAll('.theme-select-card').forEach(function(card) {
                card.classList.remove('selected');
                var btn = card.querySelector('.theme-status-btn');
                if (btn) {
                    btn.className = 'theme-status-btn select-badge';
                    btn.innerHTML = '<i class="fa-regular fa-circle"></i> <span>{{ __("Select Theme") }}</span>';
                }
            });

            if (cardElement) {
                cardElement.classList.add('selected');
                var activeBtn = cardElement.querySelector('.theme-status-btn');
                if (activeBtn) {
                    activeBtn.className = 'theme-status-btn active-badge';
                    activeBtn.innerHTML = '<i class="fa-solid fa-circle-check"></i> <span>{{ __("Active Theme") }}</span>';
                }
            }
        }

        function previewMediaImage(input, previewId) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();
                reader.onload = function(e) {
                    var previewElem = document.getElementById(previewId);
                    if (previewElem) {
                        previewElem.src = e.target.result;
                    }
                };
                reader.readAsDataURL(input.files[0]);
            }
        }
    </script>
@endsection
