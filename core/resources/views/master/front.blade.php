<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    @if (url()->current() == route('front.index'))
        <title>@yield('hometitle')</title>
    @else
        <title>{{ $setting->title }} -@yield('title')</title>
    @endif

    <!-- SEO Meta Tags-->
    @if (url()->current() == route('front.index'))
        <meta name="author" content="GeniusDevs">
        <meta name="distribution" content="web">
        <meta name="description" content="{{ $setting->meta_description }}">
        <meta name="keywords" content="{{ $setting->meta_keywords }}">
        <meta name="image" content="{{ url('/core/public/storage/images/' . $setting->meta_image) }}">
        <meta property="og:title" content="{{ $setting->title}}">
        <meta property="og:description" content="{{ $setting->meta_description }}">
        <meta property="og:image" content="{{ url('/core/public/storage/images/' . $setting->meta_image) }}">
        <meta property="og:image:secure_url" content="{{ url('/core/public/storage/images/' . $setting->meta_image) }}" />
        <meta property="og:image:type" content="image/jpeg" />
        <meta property="og:image:width" content="1200" />
        <meta property="og:image:height" content="627" />
        <meta property="og:url" content="{{ url()->current() }}">
        <meta property="og:site_name" content="{{ $setting->title }}">
        <meta property="og:type" content="website">
    @else
        @yield('meta')
    @endif

    <!-- Mobile Specific Meta Tag-->
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">

    <!-- Favicon Icons-->
    <link rel="icon" type="image/png" href="{{ url('/core/public/storage/images/' . $setting->favicon) }}">
    <link rel="apple-touch-icon" href="{{ url('/core/public/storage/images/' . $setting->favicon) }}">
    <link rel="apple-touch-icon" sizes="152x152" href="{{ url('/core/public/storage/images/' . $setting->favicon) }}">
    <link rel="apple-touch-icon" sizes="180x180" href="{{ url('/core/public/storage/images/' . $setting->favicon) }}">
    <link rel="apple-touch-icon" sizes="167x167" href="{{ url('/core/public/storage/images/' . $setting->favicon) }}">

    <!-- Vendor Styles including: Bootstrap, Font Icons, Plugins, etc.-->
    <link rel="stylesheet" media="screen" href="{{ asset('assets/front/css/plugins.min.css') }}">

    @yield('styleplugins')

    <link id="mainStyles" rel="stylesheet" media="screen" href="{{ asset('assets/front/css/styles.min.css') }}">

    <link id="mainStyles" rel="stylesheet" media="screen" href="{{ asset('assets/front/css/responsive.css') }}">
    <!-- Color css -->
    <link
        href="{{ asset('assets/front/css/color.php?primary_color=') . str_replace('#', '', $setting->primary_color) }}"
        rel="stylesheet">

    <!-- Modernizr-->
    <script src="{{ asset('assets/front/js/modernizr.min.js') }}"></script>

    @if (DB::table('languages')->where('is_default', 1)->first()->rtl == 1)
        <link rel="stylesheet" href="{{ asset('assets/front/css/rtl.css') }}">
    @endif
    <style>
        {{ $setting->custom_css }}
    </style>
    {{-- Google AdSense Start --}}
    @if ($setting->is_google_adsense == '1')
        {!! $setting->google_adsense !!}
    @endif
    {{-- Google AdSense End --}}

    {{-- Google AnalyTics Start --}}
    @if ($setting->is_google_analytics == '1')
        {!! $setting->google_analytics !!}
    @endif
    {{-- Google AnalyTics End --}}

    {{-- Facebook pixel  Start --}}
    @if ($setting->is_facebook_pixel == '1')
        {!! $setting->facebook_pixel !!}
    @endif
    {{-- Facebook pixel End --}}

</head>
<!-- Body-->

<body
    class="
@if ($setting->theme == 'theme1') body_theme1
@elseif($setting->theme == 'theme2')
body_theme2
@elseif($setting->theme == 'theme3')
body_theme3
@elseif($setting->theme == 'theme4')
body_theme4 @endif
">
    @if ($setting->is_loader == 1)
        <!-- Preloader Start -->
        @if ($setting->is_loader == 1)
            <div id="preloader">
                <img src="{{ url('/core/public/storage/images/' . $setting->loader) }}" alt="{{ __('Loading...') }}">
            </div>
        @endif

        <!-- Preloader endif -->
    @endif

    <!-- Header-->

    <header class="site-header navbar-sticky">
        <div class="menu-top-area">
            <div class="container px-2 px-sm-3">
                <div class="top-nav-flex-wrapper">
                    <!-- Left: Track Order & Compare -->
                    <div class="top-nav-left">
                        <a class="top-nav-link" href="{{ route('front.order.track') }}">
                            <i class="icon-map-pin"></i> <span>{{ __('Track Order') }}</span>
                        </a>
                        <a class="top-nav-link compare-mobile d-none d-md-inline-flex" href="{{ route('fornt.compare.index') }}">
                            <i class="icon-repeat"></i> <span>{{ __('Compare') }}</span>
                        </a>
                        <a class="top-nav-link wishlist-mobile d-none d-lg-inline-flex" href="{{ route('user.wishlist.index') }}">
                            <i class="icon-heart"></i> <span>{{ __('Wishlist') }}</span>
                        </a>
                    </div>

                    <!-- Right: Wishlist, Currency & User Login -->
                    <div class="top-nav-right">
                        <div class="t-h-dropdown">
                            <a class="main-link top-nav-link" href="javascript:;">
                                <i class="fa-solid fa-coins"></i> <span>{{ __('Currency') }}</span> <i class="icon-chevron-down ml-1"></i>
                            </a>
                            <div class="t-h-dropdown-menu">
                                @foreach (DB::table('currencies')->get() as $currency)
                                    <a class="{{ Session::get('currency') == $currency->id ? 'active' : ($currency->is_default == 1 && !Session::has('currency') ? 'active' : '') }}"
                                        href="{{ route('front.currency.setup', $currency->id) }}"><i
                                            class="icon-chevron-right pr-2"></i>{{ $currency->name }}</a>
                                @endforeach
                            </div>
                        </div>

                        <div class="login-register">
                            @if (!Auth::user())
                                <a class="top-nav-link top-nav-login-pill" href="{{ route('user.login') }}">
                                    <i class="icon-user"></i> <span>{{ __('Login') }}</span>
                                </a>
                            @else
                                <div class="t-h-dropdown">
                                    <div class="main-link top-nav-link top-nav-login-pill">
                                        <i class="icon-user"></i> <span class="text-label">{{ Auth::user()->first_name }}</span> <i class="icon-chevron-down ml-1"></i>
                                    </div>
                                    <div class="t-h-dropdown-menu">
                                        <a href="{{ route('user.dashboard') }}"><i class="icon-chevron-right pr-2"></i>{{ __('Dashboard') }}</a>
                                        <a href="{{ route('user.logout') }}"><i class="icon-chevron-right pr-2"></i>{{ __('Logout') }}</a>
                                    </div>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <style>
        .menu-top-area {
            background: linear-gradient(135deg, #064e3b 0%, #047857 60%, #059669 100%) !important;
            padding: 6px 0 !important;
            border-bottom: 1px solid rgba(255, 255, 255, 0.12) !important;
            width: 100% !important;
        }

        .top-nav-flex-wrapper {
            display: flex !important;
            align-items: center !important;
            justify-content: space-between !important;
            width: 100% !important;
            gap: 8px !important;
        }

        .top-nav-left,
        .top-nav-right {
            display: flex !important;
            align-items: center !important;
            gap: 12px !important;
        }

        .top-nav-link,
        .menu-top-area .main-link {
            color: rgba(255, 255, 255, 0.95) !important;
            font-size: 13px !important;
            font-weight: 600 !important;
            display: inline-flex !important;
            align-items: center !important;
            gap: 6px !important;
            text-decoration: none !important;
            transition: all 0.2s ease !important;
            padding: 4px 8px !important;
            border-radius: 6px !important;
            line-height: 1.2 !important;
            white-space: nowrap !important;
        }

        .top-nav-link:hover,
        .menu-top-area .main-link:hover {
            color: #ffffff !important;
            background: rgba(255, 255, 255, 0.18) !important;
        }

        .top-nav-link i,
        .menu-top-area i {
            font-size: 12.5px !important;
            color: #a7f3d0 !important;
            vertical-align: middle !important;
        }

        .top-nav-login-pill {
            background: rgba(255, 255, 255, 0.2) !important;
            color: #ffffff !important;
            border: 1px solid rgba(255, 255, 255, 0.35) !important;
            padding: 4px 14px !important;
            border-radius: 999px !important;
            font-size: 12.5px !important;
            font-weight: 700 !important;
            display: inline-flex !important;
            align-items: center !important;
            gap: 5px !important;
            white-space: nowrap !important;
        }

        .top-nav-login-pill:hover {
            background: #ffffff !important;
            color: #065f46 !important;
        }

        .top-nav-login-pill:hover i {
            color: #065f46 !important;
        }

        .menu-top-area .t-h-dropdown {
            position: relative !important;
            display: inline-block !important;
        }

        .menu-top-area .t-h-dropdown-menu {
            border-radius: 12px !important;
            border: 1px solid #e2e8f0 !important;
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.12) !important;
            padding: 6px 0 !important;
            min-width: 140px !important;
            background: #ffffff !important;
            top: 100% !important;
            z-index: 9999 !important;
        }

        .menu-top-area .t-h-dropdown-menu a {
            color: #334155 !important;
            font-size: 13px !important;
            padding: 8px 16px !important;
            display: flex !important;
            align-items: center !important;
            gap: 6px !important;
            border-radius: 0 !important;
        }

        .menu-top-area .t-h-dropdown-menu a:hover,
        .menu-top-area .t-h-dropdown-menu a.active {
            background: #ecfdf5 !important;
            color: #059669 !important;
        }

        @media (max-width: 767px) {
            .menu-top-area {
                padding: 6px 0 !important;
            }
            .menu-top-area .container {
                padding-left: 10px !important;
                padding-right: 10px !important;
            }
            .top-nav-flex-wrapper {
                justify-content: space-between !important;
                align-items: center !important;
                gap: 6px !important;
                width: 100% !important;
            }
            .top-nav-left,
            .top-nav-right {
                gap: 8px !important;
                align-items: center !important;
            }
            .top-nav-link,
            .menu-top-area .main-link {
                font-size: 12px !important;
                padding: 4px 6px !important;
                gap: 4px !important;
            }
            .top-nav-link i,
            .menu-top-area i {
                font-size: 12px !important;
            }
            .top-nav-login-pill {
                padding: 4px 11px !important;
                font-size: 12px !important;
            }
        }

        @media (max-width: 420px) {
            .menu-top-area {
                padding: 5px 0 !important;
            }
            .menu-top-area .container {
                padding-left: 8px !important;
                padding-right: 8px !important;
            }
            .top-nav-flex-wrapper {
                gap: 4px !important;
            }
            .top-nav-left,
            .top-nav-right {
                gap: 6px !important;
            }
            .top-nav-link,
            .menu-top-area .main-link {
                font-size: 11.5px !important;
                padding: 3px 5px !important;
                gap: 3px !important;
            }
            .top-nav-link i,
            .menu-top-area i {
                font-size: 11.5px !important;
            }
            .top-nav-login-pill {
                padding: 3px 9px !important;
                font-size: 11.5px !important;
            }
        }
        </style>
        <!-- Topbar-->
        <div class="topbar">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="d-flex justify-content-between">
                            <!-- Logo-->
                            <div class="site-branding"><a class="site-logo align-self-center"
                                    href="{{ route('front.index') }}"><img
                                        src="{{ url('/core/public/storage/images/' . $setting->logo) }}"
                                        alt="{{ $setting->title }}"></a></div>
                            <!-- Search / Categories-->
                            <div class="search-box-wrap d-none d-lg-block d-flex">
                                <div class="search-box-inner align-self-center">
                                    <div class="search-box d-flex">
                                        <select name="category" id="category_select" class="categoris">
                                            <option value="">{{ __('All') }}</option>
                                            @foreach (DB::table('categories')->whereStatus(1)->get() as $category)
                                                <option value="{{ $category->slug }}">{{ $category->name }}</option>
                                            @endforeach
                                        </select>
                                        <form class="input-group" id="header_search_form"
                                            action="{{ route('front.catalog') }}" method="get">
                                            <input type="hidden" name="category" value=""
                                                id="search__category">
                                            <span class="input-group-btn">
                                                <button type="submit"><i class="icon-search"></i></button>
                                            </span>
                                            <input class="form-control" type="text"
                                                data-target="{{ route('front.search.suggest') }}"
                                                id="__product__search" name="search"
                                                placeholder="{{ __('Search by product name') }}">
                                            <div class="serch-result d-none">
                                                {{-- search result --}}
                                            </div>
                                        </form>
                                    </div>
                                </div>
                                <span class="d-block d-lg-none close-m-serch"><i class="icon-x"></i></span>
                            </div>
                            <!-- Toolbar-->
                            <div class="toolbar d-flex">

                                <div class="toolbar-item close-m-serch visible-on-mobile"><a href="#">
                                        <div>
                                            <i class="icon-search"></i>
                                        </div>
                                    </a>
                                </div>
                                <div class="toolbar-item visible-on-mobile mobile-menu-toggle"><a href="#">
                                        <div><i class="icon-menu"></i><span
                                                class="text-label">{{ __('Menu') }}</span></div>
                                    </a>
                                </div>

                                <div class="toolbar-item hidden-on-mobile"><a
                                        href="{{ route('fornt.compare.index') }}">
                                        <div><span class="compare-icon"><i class="icon-repeat"></i><span
                                                    class="count-label compare_count">{{ Session::has('compare') ? count(Session::get('compare')) : '0' }}</span></span><span
                                                class="text-label">{{ __('Compare') }}</span></div>
                                    </a>
                                </div>
                                @if (Auth::check())
                                    <div class="toolbar-item hidden-on-mobile"><a
                                            href="{{ route('user.wishlist.index') }}">
                                            <div><span class="compare-icon"><i class="icon-heart"></i><span
                                                        class="count-label wishlist_count">{{ Auth::user()->wishlists->count() }}</span></span><span
                                                    class="text-label">{{ __('Wishlist') }}</span></div>
                                        </a>
                                    </div>
                                @else
                                    <div class="toolbar-item hidden-on-mobile"><a
                                            href="{{ route('user.wishlist.index') }}">
                                            <div><span class="compare-icon"><i class="icon-heart"></i></span><span
                                                    class="text-label">{{ __('Wishlist') }}</span></div>
                                        </a>
                                    </div>
                                @endif
                                <div class="toolbar-item"><a href="{{ route('front.cart') }}">
                                        <div><span class="cart-icon"><i class="icon-shopping-cart"></i><span
                                                    class="count-label cart_count">{{ Session::has('cart') ? count(Session::get('cart')) : '0' }}
                                                </span></span><span class="text-label">{{ __('Cart') }}</span>
                                        </div>
                                    </a>
                                    <div class="toolbar-dropdown cart-dropdown widget-cart  cart_view_header"
                                        id="header_cart_load" data-target="{{ route('front.header.cart') }}">
                                        @include('includes.header_cart')
                                    </div>
                                </div>
                            </div>

                            <!-- Mobile Menu-->
                            <div class="mobile-menu">
                                <!-- Slideable (Mobile) Menu-->
                                <div class="mm-heading-area">
                                    <h4>{{ __('Navigation') }}</h4>
                                    <div class="toolbar-item visible-on-mobile mobile-menu-toggle mm-t-two">
                                        <a href="#">
                                            <div> <i class="icon-x"></i></div>
                                        </a>
                                    </div>
                                </div>
                                <ul class="nav nav-tabs" role="tablist">
                                    <li class="nav-item" role="presentation99">
                                        <span class="active" id="mmenu-tab" data-bs-toggle="tab"
                                            data-bs-target="#mmenu" role="tab" aria-controls="mmenu"
                                            aria-selected="true">{{ __('Menu') }}</span>
                                    </li>
                                    <li class="nav-item" role="presentation99">
                                        <span class="" id="mcat-tab" data-bs-toggle="tab"
                                            data-bs-target="#mcat" role="tab" aria-controls="mcat"
                                            aria-selected="false">{{ __('Category') }}</span>
                                    </li>

                                </ul>
                                <div class="tab-content p-0">
                                    <div class="tab-pane fade show active" id="mmenu" role="tabpanel"
                                        aria-labelledby="mmenu-tab">
                                        <nav class="slideable-menu">
                                            <ul>
                                                <li class="{{ request()->routeIs('front.index') ? 'active' : '' }}"><a
                                                        href="{{ route('front.index') }}"><i
                                                            class="icon-chevron-right"></i>{{ __('Home') }}</a>
                                                </li>
                                                @if ($setting->is_shop == 1)
                                                    <li
                                                        class="{{ request()->routeIs('front.catalog*') ? 'active' : '' }}">
                                                        <a href="{{ route('front.catalog') }}"><i
                                                                class="icon-chevron-right"></i>{{ __('Shop') }}</a>
                                                    </li>
                                                @endif
                                                @if ($setting->is_campaign == 1)
                                                    <li
                                                        class="{{ request()->routeIs('front.campaign') ? 'active' : '' }}">
                                                        <a href="{{ route('front.campaign') }}"><i
                                                                class="icon-chevron-right"></i>{{ __('Campaign') }}</a>
                                                    </li>
                                                @endif
                                                @if ($setting->is_brands == 1)
                                                    <li
                                                        class="{{ request()->routeIs('front.brand') ? 'active' : '' }}">
                                                        <a href="{{ route('front.brand') }}"><i
                                                                class="icon-chevron-right"></i>{{ __('Brand') }}</a>
                                                    </li>
                                                @endif

                                                @if ($setting->is_blog == 1)
                                                    <li
                                                        class="{{ request()->routeIs('front.blog*') ? 'active' : '' }}">
                                                        <a href="{{ route('front.blog') }}"><i
                                                                class="icon-chevron-right"></i>{{ __('Blog') }}</a>
                                                    </li>
                                                @endif
                                                <li class="t-h-dropdown">
                                                    <a class="" href="#"><i
                                                            class="icon-chevron-right"></i>{{ __('Pages') }} <i
                                                            class="icon-chevron-down"></i></a>
                                                    <div class="t-h-dropdown-menu">
                                                        @if ($setting->is_faq == 1)
                                                            <a class="{{ request()->routeIs('front.faq*') ? 'active' : '' }}"
                                                                href="{{ route('front.faq') }}"><i
                                                                    class="icon-chevron-right pr-2"></i>{{ __('Faq') }}</a>
                                                        @endif
                                                        @foreach (DB::table('pages')->wherePos(0)->orwhere('pos', 2)->get() as $page)
                                                            <a class="{{ request()->url() == route('front.page', $page->slug) ? 'active' : '' }} "
                                                                href="{{ route('front.page', $page->slug) }}"><i
                                                                    class="icon-chevron-right pr-2"></i>{{ $page->title }}</a>
                                                        @endforeach
                                                    </div>
                                                </li>

                                                @if ($setting->is_contact == 1)
                                                    <li
                                                        class="{{ request()->routeIs('front.contact') ? 'active' : '' }}">
                                                        <a href="{{ route('front.contact') }}"><i
                                                                class="icon-chevron-right"></i>{{ __('Contact') }}</a>
                                                    </li>
                                                @endif
                                            </ul>
                                        </nav>
                                    </div>
                                    <div class="tab-pane fade" id="mcat" role="tabpanel"
                                        aria-labelledby="mcat-tab">
                                        <nav class="slideable-menu">
                                            @include('includes.mobile-category')

                                        </nav>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Navbar-->
        <div class="navbar">
            <div class="container">
                <div class="row g-3 w-100">
                    @if ($setting->is_show_category == 1)
                        <div class="col-lg-3">
                            @include('includes.categories')
                        </div>
                    @endif
                    <div class="col-lg-9 d-flex justify-content-between">
                        <div class="nav-inner">
                            @include('master.inc.site-menu')
                        </div>
                        @php
                            $free_shipping = DB::table('shipping_services')
                                ->whereStatus(1)
                                ->whereIsCondition(1)
                                ->first();
                        @endphp

                    </div>
                </div>
            </div>
        </div>

    </header>
    <!-- Page Content-->
    @yield('content')

    <!--    announcement banner section start   -->
    <a class="announcement-banner" href="#announcement-modal"></a>
    <div id="announcement-modal" class="mfp-hide white-popup">
        @if ($setting->announcement_type == 'newletter')
            <div class="announcement-with-content">
                <div class="left-area">
                    <img src="{{ url('/core/public/storage/images/' . $setting->announcement) }}" alt="">
                </div>
                <div class="right-area">
                    <h3 class="">{{ $setting->announcement_title }}</h3>
                    <p>{{ $setting->announcement_details }}</p>
                    <form class="subscriber-form" action="{{ route('front.subscriber.submit') }}" method="post">
                        @csrf
                        <div class="input-group">
                            <input class="form-control" type="email" name="email"
                                placeholder="{{ __('Your e-mail') }}">
                            <span class="input-group-addon"><i class="icon-mail"></i></span>
                        </div>
                        <div aria-hidden="true">
                            <input type="hidden" name="b_c7103e2c981361a6639545bd5_1194bb7544" tabindex="-1">
                        </div>

                        <button class="btn btn-primary btn-block mt-2" type="submit">
                            <span>{{ __('Subscribe') }}</span>
                        </button>
                    </form>
                </div>
            </div>
        @else
            <a href="{{ $setting->announcement_link }}">
                <img src="{{ url('/core/public/storage/images/' . $setting->announcement) }}" alt="">
            </a>
        @endif


    </div>
    <!--    announcement banner section end   -->

    <!-- Site Footer-->
    <footer class="site-footer">
        <div class="container">
            <div class="row">
                <div class="col-lg-4 col-md-6">
                    <!-- Contact Info-->
                    <section class="widget widget-light-skin">
                        <h3 class="widget-title">{{ __('Get In Touch') }}</h3>
                        <p class="mb-1"><strong>{{ __('Address') }}: </strong> {{ $setting->footer_address }}</p>
                        <p class="mb-1"><strong>{{ __('Phone') }}: </strong> {{ $setting->footer_phone }}</p>
                        <p class="mb-1"><strong>{{ __('Email') }}: </strong> {{ $setting->footer_email }}</p>
                        <ul class="list-unstyled text-sm">
                            <li><span class=""><strong>{{ $setting->working_days_from_to }}:
                                    </strong></span>{{ $setting->friday_start }} - {{ $setting->friday_end }}</li>
                        </ul>
                        @php
                            $links = json_decode($setting->social_link, true)['links'];
                            $icons = json_decode($setting->social_link, true)['icons'];

                        @endphp
                        <div class="footer-social-links">
                            @foreach ($links as $link_key => $link)
                                <a href="{{ $link }}"><span><i
                                            class="{{ $icons[$link_key] }}"></i></span></a>
                            @endforeach
                        </div>
                    </section>
                </div>
                <div class="col-lg-4 col-sm-6">
                    <!-- Customer Info-->
                    <div class="widget widget-links widget-light-skin">
                        <h3 class="widget-title">{{ __('Usefull Links') }}</h3>
                        <ul>
                            @if ($setting->is_faq == 1)
                                <li>
                                    <a class="" href="{{ route('front.faq') }}">{{ __('Faq') }}</a>
                                </li>
                            @endif
                            @foreach (DB::table('pages')->wherePos(2)->orwhere('pos', 1)->get() as $page)
                                <li><a href="{{ route('front.page', $page->slug) }}">{{ $page->title }}</a></li>
                            @endforeach

                        </ul>
                    </div>
                </div>
                <div class="col-lg-4">
                    <!-- Subscription-->
                    <section class="widget">
                        <h3 class="widget-title">{{ __('Newsletter') }}</h3>
                        <form class="row subscriber-form" action="{{ route('front.subscriber.submit') }}"
                            method="post">
                            @csrf
                            <div class="col-sm-12">
                                <div class="newsletter-input-wrapper">
                                    <i class="icon-mail newsletter-mail-icon"></i>
                                    <input class="form-control" type="email" name="email"
                                        placeholder="{{ __('Your e-mail') }}" required>
                                </div>
                                <div aria-hidden="true">
                                    <input type="hidden" name="b_c7103e2c981361a6639545bd5_1194bb7544"
                                        tabindex="-1">
                                </div>

                            </div>
                            <div class="col-sm-12">
                                <button class="btn btn-primary btn-block mt-2" type="submit">
                                    <span>{{ __('Subscribe') }}</span>
                                </button>
                            </div>
                            <div class="col-lg-12">
                                <p class="text-sm opacity-80 pt-2">
                                    {{ __('Subscribe to our Newsletter to receive early discount offers, latest news, sales and promo information.') }}
                                </p>
                            </div>
                        </form>
                        <div class="pt-3"><img class="d-block gateway_image"
                                src="{{ $setting->footer_gateway_img ? url('/core/public/storage/images/' . $setting->footer_gateway_img) : asset('system/resources/assets/images/placeholder.png') }}">
                        </div>
                    </section>
                </div>
            </div>
            <!-- Copyright-->
            <p class="footer-copyright"> {{ $setting->copy_right }}</p>
        </div>
    </footer>

    <!-- Back To Top Button-->
    <a class="scroll-to-top-btn" href="#">
        <i class="icon-chevron-up"></i>
    </a>

    <style>
    /* Hide Sidebar Toggle on Desktop (>= 992px) */
    @media (min-width: 992px) {
        .sidebar-toggle {
            display: none !important;
        }
    }

    /* Floating Catalog Filter Button - ONLY on Mobile & Tablet (< 992px) */
    @media (max-width: 991.98px) {
        .sidebar-toggle {
            position: fixed !important;
            bottom: 80px !important;
            left: 16px !important;
            top: auto !important;
            margin-top: 0 !important;
            width: 44px !important;
            height: 44px !important;
            border-radius: 50% !important;
            background: #ffffff !important;
            color: #059669 !important;
            border: 2px solid #10b981 !important;
            box-shadow: 0 6px 18px rgba(0, 0, 0, 0.15) !important;
            display: flex !important;
            align-items: center !important;
            justify-content: center !important;
            z-index: 99999 !important;
            cursor: pointer !important;
            transition: all 0.25s ease !important;
        }
        .sidebar-toggle:hover {
            background: #10b981 !important;
            color: #ffffff !important;
            transform: scale(1.05) !important;
        }
        .sidebar-toggle.sidebar-open {
            left: -50px !important;
        }
    }

    /* Scroll To Top Button */
    .scroll-to-top-btn {
        width: 42px !important;
        height: 42px !important;
        border-radius: 50% !important;
        background: linear-gradient(135deg, #10b981, #059669) !important;
        color: #ffffff !important;
        box-shadow: 0 4px 14px rgba(16, 185, 129, 0.38) !important;
        border: none !important;
        display: flex !important;
        align-items: center !important;
        justify-content: center !important;
        z-index: 99998 !important;
        right: 18px !important;
        bottom: -70px !important;
        transition: bottom 0.35s ease, opacity 0.3s ease, transform 0.2s ease !important;
        text-decoration: none !important;
    }
    .scroll-to-top-btn.visible {
        bottom: 24px !important;
        opacity: 1 !important;
    }
    .scroll-to-top-btn:hover {
        background: linear-gradient(135deg, #059669, #047857) !important;
        color: #ffffff !important;
        transform: translateY(-2px) !important;
    }
    .scroll-to-top-btn > i {
        line-height: 1 !important;
        font-size: 16px !important;
        color: #ffffff !important;
    }

    /* Footer Modern Styling */
    .site-footer {
        background: #ffffff !important;
        border-top: 1px solid #e2e8f0 !important;
        padding-top: 48px !important;
        padding-bottom: 24px !important;
    }
    .site-footer .widget-title {
        font-size: 16px !important;
        font-weight: 700 !important;
        color: #0f172a !important;
        margin-bottom: 16px !important;
        position: relative !important;
        padding-bottom: 8px !important;
    }
    .site-footer .widget-title::after {
        content: '' !important;
        position: absolute !important;
        bottom: 0 !important;
        left: 0 !important;
        width: 32px !important;
        height: 3px !important;
        background: #10b981 !important;
        border-radius: 2px !important;
    }
    .site-footer p {
        color: #64748b !important;
        font-size: 13.5px !important;
        line-height: 1.6 !important;
    }
    .site-footer p strong {
        color: #334155 !important;
    }
    .footer-social-links {
        display: flex !important;
        align-items: center !important;
        gap: 8px !important;
        margin-top: 16px !important;
        flex-wrap: wrap !important;
    }
    .footer-social-links a {
        width: 36px !important;
        height: 36px !important;
        border-radius: 10px !important;
        background: #ecfdf5 !important;
        color: #059669 !important;
        display: inline-flex !important;
        align-items: center !important;
        justify-content: center !important;
        font-size: 14px !important;
        transition: all 0.2s ease !important;
        text-decoration: none !important;
        border: 1px solid #a7f3d0 !important;
    }
    .footer-social-links a:hover {
        background: #10b981 !important;
        color: #ffffff !important;
        transform: translateY(-2px) !important;
    }
    .footer-social-links a i {
        color: inherit !important;
    }
    .widget-links ul {
        list-style: none !important;
        padding-left: 0 !important;
        margin: 0 !important;
    }
    .widget-links ul li {
        margin-bottom: 10px !important;
        padding-left: 0 !important;
    }
    .widget-links ul li::before {
        display: none !important;
        content: '' !important;
    }
    .widget-links ul li a {
        color: #64748b !important;
        font-size: 13.5px !important;
        text-decoration: none !important;
        display: inline-flex !important;
        align-items: center !important;
        gap: 8px !important;
        transition: all 0.2s ease !important;
    }
    .widget-links ul li a::before {
        content: '\e92e' !important;
        font-family: feather !important;
        font-size: 13px !important;
        color: #10b981 !important;
        display: inline-block !important;
        transition: transform 0.2s ease !important;
    }
    .widget-links ul li a:hover {
        color: #059669 !important;
        padding-left: 3px !important;
    }
    .widget-links ul li a:hover::before {
        transform: translateX(3px) !important;
    }

    /* Newsletter Form Clean Input */
    .newsletter-input-wrapper {
        position: relative !important;
        width: 100% !important;
        display: flex !important;
        align-items: center !important;
    }
    .newsletter-mail-icon {
        position: absolute !important;
        left: 14px !important;
        top: 50% !important;
        transform: translateY(-50%) !important;
        font-size: 15px !important;
        color: #94a3b8 !important;
        pointer-events: none !important;
        z-index: 5 !important;
    }
    .site-footer .subscriber-form .form-control {
        width: 100% !important;
        height: 46px !important;
        border-radius: 10px !important;
        border: 1px solid #cbd5e1 !important;
        background: #ffffff !important;
        font-size: 13.5px !important;
        padding-left: 40px !important;
        padding-right: 14px !important;
        color: #1e293b !important;
        box-shadow: none !important;
        transition: all 0.2s ease !important;
    }
    .site-footer .subscriber-form .form-control:focus {
        border-color: #10b981 !important;
        box-shadow: 0 0 0 3px rgba(16, 185, 129, 0.15) !important;
    }
    .site-footer .subscriber-form .btn-primary {
        height: 44px !important;
        border-radius: 10px !important;
        background: linear-gradient(135deg, #10b981 0%, #059669 100%) !important;
        color: #ffffff !important;
        font-size: 14px !important;
        font-weight: 700 !important;
        border: none !important;
        box-shadow: 0 4px 14px rgba(16, 185, 129, 0.3) !important;
        transition: all 0.2s ease !important;
        cursor: pointer !important;
    }
    .site-footer .subscriber-form .btn-primary:hover {
        box-shadow: 0 6px 18px rgba(16, 185, 129, 0.45) !important;
        transform: translateY(-1px) !important;
    }
    .site-footer .footer-copyright {
        border-top: 1px solid #f1f5f9 !important;
        padding-top: 20px !important;
        margin-top: 32px !important;
        color: #94a3b8 !important;
        font-size: 13px !important;
        text-align: center !important;
    }

    @media (max-width: 768px) {
        .site-footer {
            padding-top: 32px !important;
            padding-bottom: 20px !important;
        }
        .site-footer .widget {
            margin-bottom: 28px !important;
            padding-bottom: 20px !important;
            border-bottom: 1px solid #f1f5f9 !important;
        }
        .site-footer .col-lg-4:last-child .widget {
            border-bottom: none !important;
            margin-bottom: 0 !important;
            padding-bottom: 0 !important;
        }
    }

    /* Modern Deals of the Week & Countdown Banner */
    .deal-of-day-section .section-title,
    .deal-of-day-section .section-title.deal-header-flex {
        display: flex !important;
        align-items: center !important;
        justify-content: space-between !important;
        gap: 16px !important;
        margin-bottom: 24px !important;
        border-bottom: 2px solid #f1f5f9 !important;
        padding-bottom: 14px !important;
        width: 100% !important;
    }

    .deal-of-day-section .deal-title,
    .deal-of-day-section .section-title h2 {
        font-size: 22px !important;
        font-weight: 800 !important;
        color: #0f172a !important;
        margin: 0 !important;
        display: inline-flex !important;
        align-items: center !important;
        gap: 8px !important;
        white-space: nowrap !important;
        flex-shrink: 0 !important;
    }

    .deal-of-day-section .section-title .right-area {
        display: inline-flex !important;
        align-items: center !important;
        gap: 16px !important;
        flex-wrap: wrap !important;
    }

    /* Modern Digital Countdown Tiles */
    .deal-of-day-section .countdown,
    .deal-of-day-section .deal-countdown,
    .campaign-section .countdown,
    .countdown.countdown-alt {
        display: inline-flex !important;
        align-items: center !important;
        justify-content: center !important;
        gap: 8px !important;
        background: transparent !important;
        padding: 0 !important;
        margin: 0 !important;
        border-radius: 0 !important;
    }

    .deal-of-day-section .countdown span,
    .deal-of-day-section .deal-countdown span,
    .campaign-section .countdown span,
    .countdown.countdown-alt span {
        display: inline-flex !important;
        flex-direction: column !important;
        align-items: center !important;
        justify-content: center !important;
        min-width: 48px !important;
        height: 46px !important;
        padding: 4px 6px !important;
        border-radius: 10px !important;
        background: linear-gradient(135deg, #064e3b 0%, #047857 55%, #059669 100%) !important;
        color: #ffffff !important;
        box-shadow: 0 4px 12px rgba(4, 120, 87, 0.28) !important;
        font-size: 16px !important;
        font-weight: 800 !important;
        line-height: 1.1 !important;
        margin: 0 !important;
        text-align: center !important;
    }

    .deal-of-day-section .countdown span small,
    .deal-of-day-section .deal-countdown span small,
    .campaign-section .countdown span small,
    .countdown.countdown-alt span small {
        display: block !important;
        font-size: 9.5px !important;
        font-weight: 700 !important;
        text-transform: uppercase !important;
        color: #a7f3d0 !important;
        letter-spacing: 0.5px !important;
        margin-top: 2px !important;
        line-height: 1 !important;
        background: transparent !important;
        padding: 0 !important;
    }

    /* Deals View All Pill Button */
    .deal-of-day-section .right_link,
    .deal-of-day-section .deal-view-all {
        display: inline-flex !important;
        align-items: center !important;
        gap: 6px !important;
        padding: 7px 18px !important;
        border-radius: 20px !important;
        background: #ecfdf5 !important;
        color: #059669 !important;
        font-size: 13px !important;
        font-weight: 700 !important;
        border: 1px solid #a7f3d0 !important;
        text-decoration: none !important;
        white-space: nowrap !important;
        flex-shrink: 0 !important;
        transition: all 0.2s ease !important;
    }

    .deal-of-day-section .right_link:hover,
    .deal-of-day-section .deal-view-all:hover {
        background: #10b981 !important;
        color: #ffffff !important;
        border-color: #10b981 !important;
        transform: translateY(-1px) !important;
    }

    /* Deals Header on Mobile (<= 768px): Title on LEFT, Countdown in CENTER, View All on RIGHT */
    @media (max-width: 768px) {
        .deal-of-day-section .section-title,
        .deal-of-day-section .section-title.deal-header-flex {
            display: flex !important;
            flex-direction: row !important;
            align-items: center !important;
            justify-content: space-between !important;
            gap: 6px !important;
            flex-wrap: nowrap !important;
            padding-bottom: 12px !important;
            margin-bottom: 16px !important;
            width: 100% !important;
            text-align: left !important;
        }

        .deal-of-day-section .deal-title,
        .deal-of-day-section .section-title h2 {
            font-size: 13px !important;
            font-weight: 800 !important;
            margin: 0 !important;
            white-space: nowrap !important;
            flex-shrink: 0 !important;
            color: #0f172a !important;
            line-height: 1.2 !important;
        }

        .deal-of-day-section .deal-countdown,
        .deal-of-day-section .countdown {
            display: inline-flex !important;
            align-items: center !important;
            justify-content: center !important;
            gap: 3px !important;
            flex: 1 !important;
            margin: 0 auto !important;
        }

        .deal-of-day-section .deal-countdown span,
        .deal-of-day-section .countdown span,
        .countdown.countdown-alt span {
            min-width: 32px !important;
            height: 34px !important;
            padding: 2px 1px !important;
            border-radius: 6px !important;
            font-size: 11.5px !important;
            box-shadow: 0 2px 6px rgba(4, 120, 87, 0.2) !important;
            line-height: 1 !important;
        }

        .deal-of-day-section .deal-countdown span small,
        .deal-of-day-section .countdown span small,
        .countdown.countdown-alt span small {
            font-size: 7px !important;
            letter-spacing: 0 !important;
            margin-top: 1px !important;
        }

        .deal-of-day-section .right_link,
        .deal-of-day-section .deal-view-all {
            font-size: 11px !important;
            padding: 4px 10px !important;
            border-radius: 14px !important;
            white-space: nowrap !important;
            flex-shrink: 0 !important;
            gap: 3px !important;
        }

        .deal-of-day-section .deal-view-all i,
        .deal-of-day-section .right_link i {
            font-size: 9px !important;
        }
    }

    @media (max-width: 420px) {
        .deal-of-day-section .deal-title,
        .deal-of-day-section .section-title h2 {
            font-size: 11.5px !important;
        }
        .deal-of-day-section .deal-countdown span,
        .deal-of-day-section .countdown span {
            min-width: 27px !important;
            height: 30px !important;
            font-size: 10px !important;
            border-radius: 5px !important;
        }
        .deal-of-day-section .deal-countdown span small,
        .deal-of-day-section .countdown span small {
            font-size: 6.5px !important;
        }
        .deal-of-day-section .right_link,
        .deal-of-day-section .deal-view-all {
            font-size: 10px !important;
            padding: 3px 6px !important;
        }
    }

    /* Modern Service Badges Section (2x2 on Mobile) */
    .service-section {
        padding: 24px 0 10px !important;
    }

    .single-service.single-service2 {
        background: #ffffff !important;
        border: 1px solid #e2e8f0 !important;
        border-radius: 14px !important;
        padding: 16px 18px !important;
        display: flex !important;
        align-items: center !important;
        gap: 14px !important;
        height: 100% !important;
        box-shadow: 0 2px 8px rgba(0, 0, 0, 0.03) !important;
        transition: all 0.25s ease !important;
    }

    .single-service.single-service2:hover {
        transform: translateY(-2px) !important;
        box-shadow: 0 8px 20px rgba(0, 0, 0, 0.06) !important;
        border-color: #a7f3d0 !important;
    }

    .single-service.single-service2 img {
        width: 44px !important;
        height: 44px !important;
        object-fit: contain !important;
        margin: 0 !important;
        flex-shrink: 0 !important;
    }

    .single-service.single-service2 .content {
        flex: 1 !important;
        text-align: left !important;
        min-width: 0 !important;
    }

    .single-service.single-service2 .content h6 {
        font-size: 14px !important;
        font-weight: 700 !important;
        color: #0f172a !important;
        margin-bottom: 4px !important;
        line-height: 1.3 !important;
    }

    .single-service.single-service2 .content p {
        font-size: 12px !important;
        color: #64748b !important;
        line-height: 1.35 !important;
        margin: 0 !important;
    }

    /* Mobile 2x2 Grid Styling (<= 768px) */
    @media (max-width: 768px) {
        .service-section {
            padding: 14px 0 4px !important;
        }

        .single-service.single-service2 {
            padding: 12px 10px !important;
            border-radius: 12px !important;
            gap: 10px !important;
            box-shadow: 0 1px 4px rgba(0, 0, 0, 0.04) !important;
        }

        .single-service.single-service2 img {
            width: 32px !important;
            height: 32px !important;
        }

        .single-service.single-service2 .content h6 {
            font-size: 12px !important;
            font-weight: 700 !important;
            margin-bottom: 2px !important;
            line-height: 1.25 !important;
        }

        .single-service.single-service2 .content p {
            font-size: 10px !important;
            line-height: 1.3 !important;
            display: -webkit-box !important;
            -webkit-line-clamp: 2 !important;
            -webkit-box-orient: vertical !important;
            overflow: hidden !important;
        }
    }

    @media (max-width: 420px) {
        .single-service.single-service2 {
            padding: 10px 8px !important;
            gap: 8px !important;
        }
        .single-service.single-service2 img {
            width: 26px !important;
            height: 26px !important;
        }
        .single-service.single-service2 .content h6 {
            font-size: 11px !important;
        }
        .single-service.single-service2 .content p {
            font-size: 9px !important;
        }
    }

    /* Checkout Page Navigation Buttons & Form Controls */
    .checkout-nav-buttons {
        display: flex !important;
        align-items: center !important;
        justify-content: space-between !important;
        gap: 12px !important;
        width: 100% !important;
    }

    .checkout-prev-btn {
        display: inline-flex !important;
        align-items: center !important;
        justify-content: center !important;
        gap: 6px !important;
        height: 42px !important;
        padding: 0 16px !important;
        border-radius: 10px !important;
        background: #ffffff !important;
        border: 1px solid #cbd5e1 !important;
        color: #475569 !important;
        font-size: 13.5px !important;
        font-weight: 600 !important;
        text-decoration: none !important;
        transition: all 0.2s ease !important;
        white-space: nowrap !important;
    }

    .checkout-prev-btn:hover {
        background: #f1f5f9 !important;
        color: #0f172a !important;
        border-color: #94a3b8 !important;
    }

    .checkout-next-btn {
        display: inline-flex !important;
        align-items: center !important;
        justify-content: center !important;
        gap: 6px !important;
        height: 42px !important;
        padding: 0 20px !important;
        border-radius: 10px !important;
        background: linear-gradient(135deg, #10b981 0%, #059669 100%) !important;
        border: none !important;
        color: #ffffff !important;
        font-size: 13.5px !important;
        font-weight: 700 !important;
        box-shadow: 0 4px 12px rgba(16, 185, 129, 0.3) !important;
        transition: all 0.2s ease !important;
        cursor: pointer !important;
        white-space: nowrap !important;
    }

    .checkout-next-btn:hover:not(:disabled) {
        box-shadow: 0 6px 18px rgba(16, 185, 129, 0.45) !important;
        transform: translateY(-1px) !important;
        color: #ffffff !important;
    }

    .checkout-next-btn:disabled {
        opacity: 0.55 !important;
        cursor: not-allowed !important;
        box-shadow: none !important;
    }

    /* Custom Checkbox Emerald Theme */
    .custom-control-input:checked ~ .custom-control-label::before {
        border-color: #10b981 !important;
        background-color: #10b981 !important;
    }

    .custom-control-input:focus ~ .custom-control-label::before {
        box-shadow: 0 0 0 1px #fff, 0 0 0 3px rgba(16, 185, 129, 0.25) !important;
    }

    @media (max-width: 480px) {
        .checkout-prev-btn {
            height: 38px !important;
            padding: 0 12px !important;
            font-size: 12.5px !important;
        }
        .checkout-next-btn {
            height: 38px !important;
            padding: 0 14px !important;
            font-size: 12.5px !important;
        }
    }

    /* Modern Shopping Cart Styling */
    .cart-main-card,
    .cart-summary-card {
        background: #ffffff !important;
        border: 1px solid #e2e8f0 !important;
        border-radius: 14px !important;
    }

    .shopping-cart .product-item {
        display: flex !important;
        align-items: center !important;
        gap: 12px !important;
    }

    .shopping-cart .product-thumb {
        width: 64px !important;
        height: 64px !important;
        border-radius: 10px !important;
        border: 1px solid #f1f5f9 !important;
        overflow: hidden !important;
        flex-shrink: 0 !important;
        display: inline-block !important;
    }

    .shopping-cart .product-thumb img {
        width: 100% !important;
        height: 100% !important;
        object-fit: cover !important;
    }

    .shopping-cart .product-title {
        font-size: 14px !important;
        font-weight: 700 !important;
        margin-bottom: 4px !important;
    }

    .shopping-cart .product-title a {
        color: #0f172a !important;
        text-decoration: none !important;
        transition: color 0.2s ease !important;
    }

    .shopping-cart .product-title a:hover {
        color: #059669 !important;
    }

    .modern-coupon-form .input-group {
        display: flex !important;
        align-items: center !important;
        width: 100% !important;
        max-width: 360px !important;
    }

    .modern-coupon-form input.form-control {
        height: 42px !important;
        border-radius: 10px 0 0 10px !important;
        border: 1px solid #cbd5e1 !important;
        border-right: none !important;
        font-size: 13.5px !important;
        padding-left: 14px !important;
        background: #ffffff !important;
    }

    .modern-coupon-form input.form-control:focus {
        border-color: #10b981 !important;
        box-shadow: 0 0 0 3px rgba(16, 185, 129, 0.15) !important;
    }

    .modern-coupon-form button.btn-primary {
        height: 42px !important;
        border-radius: 0 10px 10px 0 !important;
        background: linear-gradient(135deg, #10b981 0%, #059669 100%) !important;
        border: none !important;
        color: #ffffff !important;
        font-size: 13.5px !important;
        font-weight: 700 !important;
        padding: 0 18px !important;
        white-space: nowrap !important;
        box-shadow: 0 4px 12px rgba(16, 185, 129, 0.3) !important;
    }

    .cart-subtotal-amount {
        font-size: 20px !important;
        font-weight: 800 !important;
        color: #059669 !important;
    }

    .cart-back-btn {
        display: inline-flex !important;
        align-items: center !important;
        justify-content: center !important;
        gap: 6px !important;
        height: 44px !important;
        padding: 0 20px !important;
        border-radius: 10px !important;
        background: #ffffff !important;
        border: 1px solid #cbd5e1 !important;
        color: #475569 !important;
        font-size: 13.5px !important;
        font-weight: 600 !important;
        text-decoration: none !important;
        transition: all 0.2s ease !important;
    }

    .cart-back-btn:hover {
        background: #f1f5f9 !important;
        color: #0f172a !important;
        border-color: #94a3b8 !important;
    }

    .cart-checkout-btn {
        display: inline-flex !important;
        align-items: center !important;
        justify-content: center !important;
        gap: 6px !important;
        height: 44px !important;
        padding: 0 24px !important;
        border-radius: 10px !important;
        background: linear-gradient(135deg, #10b981 0%, #059669 100%) !important;
        border: none !important;
        color: #ffffff !important;
        font-size: 14px !important;
        font-weight: 700 !important;
        box-shadow: 0 4px 14px rgba(16, 185, 129, 0.35) !important;
        text-decoration: none !important;
        transition: all 0.2s ease !important;
    }

    .cart-checkout-btn:hover {
        box-shadow: 0 6px 18px rgba(16, 185, 129, 0.5) !important;
        transform: translateY(-1px) !important;
        color: #ffffff !important;
    }

    /* Cart on Mobile (<= 768px): Card transformation */
    @media (max-width: 768px) {
        .shopping-cart thead {
            display: none !important;
        }
        .shopping-cart table,
        .shopping-cart tbody,
        .shopping-cart tr {
            display: block !important;
            width: 100% !important;
            border: none !important;
        }
        .shopping-cart tr {
            background: #ffffff !important;
            border: 1px solid #e2e8f0 !important;
            border-radius: 14px !important;
            padding: 14px !important;
            margin-bottom: 14px !important;
            position: relative !important;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.03) !important;
        }
        .shopping-cart td {
            display: flex !important;
            align-items: center !important;
            justify-content: space-between !important;
            padding: 6px 0 !important;
            border: none !important;
            text-align: left !important;
        }
        .shopping-cart td:first-child {
            display: block !important;
            padding-bottom: 10px !important;
            border-bottom: 1px solid #f1f5f9 !important;
            margin-bottom: 8px !important;
            padding-right: 32px !important;
        }
        .shopping-cart td.product-action-col {
            position: absolute !important;
            top: 12px !important;
            right: 12px !important;
            padding: 0 !important;
            margin: 0 !important;
        }
        .shopping-cart td.product-action-col .remove-from-cart {
            width: 28px !important;
            height: 28px !important;
            border-radius: 50% !important;
            background: #fee2e2 !important;
            color: #ef4444 !important;
            display: inline-flex !important;
            align-items: center !important;
            justify-content: center !important;
            font-size: 13px !important;
            text-decoration: none !important;
        }
        .shopping-cart td.product-price-col::before {
            content: 'Unit Price:' !important;
            font-size: 12.5px !important;
            color: #64748b !important;
            font-weight: 500 !important;
        }
        .shopping-cart td.product-qty-col::before {
            content: 'Quantity:' !important;
            font-size: 12.5px !important;
            color: #64748b !important;
            font-weight: 500 !important;
        }
        .shopping-cart td.product-subtotal-col::before {
            content: 'Subtotal:' !important;
            font-size: 13px !important;
            color: #334155 !important;
            font-weight: 700 !important;
        }
        .shopping-cart td.product-subtotal-col {
            font-weight: 800 !important;
            color: #059669 !important;
            font-size: 15px !important;
            border-top: 1px dashed #f1f5f9 !important;
            padding-top: 8px !important;
            margin-top: 4px !important;
        }
        .modern-cart-footer {
            display: flex !important;
            flex-direction: column !important;
            gap: 16px !important;
        }
        .modern-coupon-form .input-group {
            max-width: 100% !important;
        }
        .total-summary-col {
            text-align: center !important;
            background: #f8fafc !important;
            padding: 12px !important;
            border-radius: 10px !important;
            border: 1px solid #e2e8f0 !important;
        }
        .total-summary-col .subtotal-line,
        .total-summary-col .discount-line {
            text-align: center !important;
        }
        .cart-actions-row {
            flex-direction: column-reverse !important;
            gap: 10px !important;
        }
        .cart-actions-row .cart-back-btn,
        .cart-actions-row .cart-checkout-btn {
            width: 100% !important;
            height: 44px !important;
        }
    }

    /* Modern Checkout Steps Indicator Bar */
    .checkout-steps-bar {
        display: flex !important;
        align-items: center !important;
        justify-content: space-between !important;
        background: #ffffff !important;
        border: 1px solid #e2e8f0 !important;
        border-radius: 12px !important;
        padding: 5px !important;
        gap: 6px !important;
    }

    .checkout-step-item {
        display: flex !important;
        align-items: center !important;
        justify-content: center !important;
        flex: 1 !important;
        padding: 10px 8px !important;
        border-radius: 8px !important;
        text-decoration: none !important;
        color: #64748b !important;
        font-size: 13.5px !important;
        font-weight: 600 !important;
        gap: 6px !important;
        text-align: center !important;
        transition: all 0.2s ease !important;
        white-space: nowrap !important;
    }

    .checkout-step-item.active {
        background: #ecfdf5 !important;
        color: #059669 !important;
        border: 1px solid #a7f3d0 !important;
        font-weight: 700 !important;
    }

    .checkout-step-item:hover:not(.active) {
        color: #0f172a !important;
        background: #f8fafc !important;
    }

    /* Checkout Address Cards */
    .checkout-address-card {
        background: #f8fafc !important;
        border: 1px solid #e2e8f0 !important;
        border-radius: 12px !important;
        height: 100% !important;
    }

    .address-card-title {
        font-size: 14px !important;
        font-weight: 700 !important;
        color: #0f172a !important;
        padding-bottom: 6px !important;
        border-bottom: 1px dashed #cbd5e1 !important;
    }

    .checkout-address-card ul li {
        font-size: 13px !important;
        color: #334155 !important;
        line-height: 1.6 !important;
    }

    /* Payment Gateways Grid */
    .payment-methods-grid {
        display: grid !important;
        grid-template-columns: repeat(auto-fill, minmax(180px, 1fr)) !important;
        gap: 14px !important;
        width: 100% !important;
    }

    .payment-method-tile {
        width: 100% !important;
    }

    .payment-method-btn {
        display: flex !important;
        flex-direction: column !important;
        align-items: center !important;
        justify-content: center !important;
        background: #ffffff !important;
        border: 1.5px solid #e2e8f0 !important;
        border-radius: 14px !important;
        padding: 16px 12px !important;
        min-height: 105px !important;
        text-decoration: none !important;
        transition: all 0.2s cubic-bezier(0.4, 0, 0.2, 1) !important;
        box-shadow: 0 2px 8px rgba(0, 0, 0, 0.02) !important;
        cursor: pointer !important;
    }

    .payment-method-btn:hover {
        border-color: #10b981 !important;
        background: #f0fdf4 !important;
        box-shadow: 0 6px 18px rgba(16, 185, 129, 0.18) !important;
        transform: translateY(-3px) !important;
    }

    .gateway-icon-box {
        height: 42px !important;
        display: flex !important;
        align-items: center !important;
        justify-content: center !important;
        margin-bottom: 8px !important;
    }

    .gateway-icon-box img {
        max-height: 38px !important;
        max-width: 100% !important;
        object-fit: contain !important;
    }

    .gateway-title {
        font-size: 13px !important;
        font-weight: 700 !important;
        color: #1e293b !important;
        margin: 0 !important;
        text-align: center !important;
        line-height: 1.25 !important;
    }

    @media (max-width: 767.98px) {
        .checkout-step-item {
            font-size: 11px !important;
            padding: 7px 4px !important;
            gap: 3px !important;
        }
        .payment-methods-grid {
            grid-template-columns: repeat(2, 1fr) !important;
            gap: 10px !important;
        }
        .payment-method-btn {
            min-height: 88px !important;
            padding: 10px 6px !important;
        }
        .gateway-icon-box {
            height: 32px !important;
        }
        .gateway-icon-box img {
            max-height: 28px !important;
        }
        .gateway-title {
            font-size: 11.5px !important;
        }
    }

    /* Sticky Desktop Sidebar */
    @media (min-width: 992px) {
        .checkout-sidebar-wrapper {
            position: sticky !important;
            top: 24px !important;
            z-index: 10 !important;
        }
    }

    /* Modern Checkout Sidebar: Order Summary & Cart Items */
    .checkout-summary-card,
    .checkout-cart-items-card {
        background: #ffffff !important;
        border: 1px solid #e2e8f0 !important;
        border-radius: 16px !important;
        padding: 22px !important;
        box-shadow: 0 4px 16px rgba(0, 0, 0, 0.03) !important;
        margin-bottom: 20px !important;
    }

    .summary-header-icon,
    .cart-items-header-icon {
        width: 36px !important;
        min-width: 36px !important;
        height: 36px !important;
        border-radius: 10px !important;
        background: #ecfdf5 !important;
        display: inline-flex !important;
        align-items: center !important;
        justify-content: center !important;
        font-size: 16px !important;
        margin-right: 12px !important;
    }

    .order-total-highlight-card {
        background: #f0fdf4 !important;
        border: 1.5px solid #bbf7d0 !important;
        border-radius: 12px !important;
        padding: 14px 16px !important;
    }

    .checkout-item-card {
        display: flex !important;
        align-items: flex-start !important;
        gap: 14px !important;
    }

    .checkout-item-thumb-wrapper {
        position: relative !important;
        width: 58px !important;
        min-width: 58px !important;
        height: 58px !important;
        border-radius: 12px !important;
        background: #f8fafc !important;
        border: 1px solid #e2e8f0 !important;
        display: flex !important;
        align-items: center !important;
        justify-content: center !important;
        margin-right: 14px !important;
    }

    .checkout-item-thumb {
        width: 100% !important;
        height: 100% !important;
        object-fit: cover !important;
        border-radius: 11px !important;
    }

    .checkout-item-qty-badge {
        position: absolute !important;
        top: -5px !important;
        right: -5px !important;
        background: #10b981 !important;
        color: #ffffff !important;
        font-size: 10.5px !important;
        font-weight: 700 !important;
        padding: 1px 6px !important;
        border-radius: 999px !important;
        box-shadow: 0 2px 6px rgba(16, 185, 129, 0.4) !important;
        line-height: 1.3 !important;
        z-index: 2 !important;
    }

    .checkout-item-info {
        flex: 1 1 auto !important;
        min-width: 0 !important;
        padding-top: 2px !important;
    }

    .checkout-item-name {
        font-size: 13.5px !important;
        line-height: 1.35 !important;
        margin: 0 0 4px !important;
    }

    .checkout-item-name a {
        color: #0f172a !important;
        text-decoration: none !important;
        display: -webkit-box !important;
        -webkit-line-clamp: 2 !important;
        -webkit-box-orient: vertical !important;
        overflow: hidden !important;
    }

    .checkout-item-name a:hover {
        color: #10b981 !important;
    }

    .variant-pill-tag {
        font-size: 11px !important;
        font-weight: 600 !important;
        color: #475569 !important;
        background: #f1f5f9 !important;
        border: 1px solid #e2e8f0 !important;
        padding: 1px 7px !important;
        border-radius: 6px !important;
        display: inline-block !important;
        margin-right: 4px !important;
        margin-bottom: 2px !important;
    }

    @media (max-width: 767.98px) {
        .checkout-summary-card,
        .checkout-cart-items-card {
            padding: 16px !important;
            border-radius: 14px !important;
            margin-bottom: 16px !important;
        }
        .checkout-item-thumb-wrapper {
            width: 52px !important;
            height: 52px !important;
        }
    }

    /* Track Order Search Card */
    .track-order-search-card {
        background: #ffffff !important;
        border: 1px solid #e2e8f0 !important;
        border-radius: 18px !important;
        box-shadow: 0 4px 16px rgba(0, 0, 0, 0.04) !important;
    }

    .track-icon-badge {
        width: 58px;
        height: 58px;
        border-radius: 16px;
        background: #ecfdf5;
        color: #059669;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 24px;
        box-shadow: 0 2px 8px rgba(5, 150, 105, 0.15);
    }

    .track-search-title {
        font-size: 22px !important;
        font-weight: 700 !important;
        color: #0f172a !important;
    }

    .track-search-subtitle {
        font-size: 13.5px !important;
        max-width: 480px;
        margin-left: auto;
        margin-right: auto;
    }

    .track-input-group {
        display: flex !important;
        align-items: center !important;
        background: #f8fafc !important;
        border: 1.5px solid #cbd5e1 !important;
        border-radius: 14px !important;
        padding: 5px 6px 5px 14px !important;
        transition: all 0.2s ease !important;
    }

    .track-input-group:focus-within {
        border-color: #10b981 !important;
        background: #ffffff !important;
        box-shadow: 0 0 0 3px rgba(16, 185, 129, 0.15) !important;
    }

    .track-input-icon {
        font-size: 16px !important;
        margin-right: 10px !important;
        color: #94a3b8 !important;
    }

    .track-input-field {
        border: none !important;
        background: transparent !important;
        height: 44px !important;
        font-size: 14px !important;
        font-weight: 600 !important;
        color: #0f172a !important;
        padding: 0 !important;
        outline: none !important;
        box-shadow: none !important;
        flex: 1 !important;
    }

    .track-input-field:focus {
        border: none !important;
        box-shadow: none !important;
    }

    .track-submit-btn {
        border-radius: 10px !important;
        height: 44px !important;
        padding: 0 22px !important;
        font-weight: 600 !important;
        font-size: 13.5px !important;
        white-space: nowrap !important;
        display: flex !important;
        align-items: center !important;
        justify-content: center !important;
    }

    /* Track Results Card */
    .order-tracking-result-card,
    .order-not-found-card {
        background: #ffffff !important;
        border: 1px solid #e2e8f0 !important;
        border-radius: 18px !important;
        box-shadow: 0 4px 16px rgba(0, 0, 0, 0.04) !important;
        overflow: hidden !important;
    }

    .not-found-icon-box {
        width: 64px;
        height: 64px;
        border-radius: 50%;
        background: #f1f5f9;
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .canceled-order-alert {
        background: #fef2f2 !important;
        border: 1px solid #fecaca !important;
    }

    /* Vertical Timeline */
    .tracking-vertical-timeline {
        position: relative;
        padding: 10px 0;
    }

    .timeline-step {
        display: flex;
        position: relative;
        padding-bottom: 26px;
    }

    .timeline-step:last-child {
        padding-bottom: 0;
    }

    .step-indicator {
        position: relative;
        display: flex;
        flex-direction: column;
        align-items: center;
        margin-right: 18px;
        flex-shrink: 0;
    }

    .step-icon {
        width: 38px;
        height: 38px;
        border-radius: 50%;
        background: #f1f5f9;
        color: #94a3b8;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 14px;
        z-index: 2;
        border: 2px solid #e2e8f0;
        transition: all 0.3s ease;
    }

    .timeline-step.step-completed .step-icon {
        background: #10b981 !important;
        color: #ffffff !important;
        border-color: #10b981 !important;
        box-shadow: 0 2px 8px rgba(16, 185, 129, 0.35) !important;
    }

    .timeline-step.step-active .step-icon {
        background: #3b82f6 !important;
        color: #ffffff !important;
        border-color: #bfdbfe !important;
        box-shadow: 0 0 0 4px rgba(59, 130, 246, 0.2) !important;
    }

    .step-line {
        position: absolute;
        top: 38px;
        bottom: 0;
        width: 2px;
        background: #e2e8f0;
        z-index: 1;
    }

    .timeline-step.step-completed .step-line {
        background: #10b981 !important;
    }

    .step-content {
        flex-grow: 1;
        padding-top: 6px;
    }

    .step-title {
        font-size: 14.5px !important;
        color: #0f172a !important;
    }

    .step-time {
        font-size: 12px !important;
        font-weight: 500 !important;
    }

    .step-desc {
        font-size: 12.5px !important;
        line-height: 1.4 !important;
    }

    @media (max-width: 576px) {
        .track-order-search-card {
            padding: 20px 16px !important;
            border-radius: 14px !important;
        }
        .track-search-title {
            font-size: 18px !important;
        }
        .track-icon-badge {
            width: 48px;
            height: 48px;
            font-size: 20px;
        }
        .track-input-group {
            flex-direction: column !important;
            padding: 10px !important;
            border-radius: 12px !important;
            gap: 8px !important;
        }
        .track-input-icon {
            display: none !important;
        }
        .track-input-field {
            width: 100% !important;
            text-align: center !important;
            height: 38px !important;
        }
        .track-submit-btn {
            width: 100% !important;
            height: 42px !important;
        }
        .step-icon {
            width: 32px;
            height: 32px;
            font-size: 12px;
        }
        .step-line {
            top: 32px;
        }
        .step-indicator {
            margin-right: 12px;
        }
        .step-title {
            font-size: 13.5px !important;
        }
    }
    </style>
    <!-- Backdrop-->
    <div class="site-backdrop"></div>

    <!-- Cookie alert dialog  -->
    @if ($setting->is_cookie == 1)
        @include('cookie-consent::index')
    @endif
    <!-- Cookie alert dialog  -->


    @php
        $mainbs = [];
        $mainbs['is_announcement'] = $setting->is_announcement;
        $mainbs['announcement_delay'] = $setting->announcement_delay;
        $mainbs['overlay'] = $setting->overlay;
        $mainbs = json_encode($mainbs);
    @endphp

    <script>
        var mainbs = {!! $mainbs !!};
        var decimal_separator = '{!! $setting->decimal_separator !!}';
        var thousand_separator = '{!! $setting->thousand_separator !!}';
    </script>

    <script>
        let language = {
            Days: '{{ __('Days') }}',
            Hrs: '{{ __('Hrs') }}',
            Min: '{{ __('Min') }}',
            Sec: '{{ __('Sec') }}',
        }
    </script>



    <!-- JavaScript (jQuery) libraries, plugins and custom scripts-->
    <script type="text/javascript" src="{{ asset('assets/front/js/plugins.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('assets/back/js/plugin/bootstrap-notify/bootstrap-notify.min.js') }}">
    </script>
    <script type="text/javascript" src="{{ asset('assets/front/js/scripts.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('assets/front/js/lazy.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('assets/front/js/lazy.plugin.js') }}"></script>
    <script type="text/javascript" src="{{ asset('assets/front/js/myscript.js') }}"></script>
    @yield('script')

    @if ($setting->is_facebook_messenger == '1')
        <!-- Messenger Chat Plugin Code -->
        <div id="fb-root"></div>

        <!-- Your Chat Plugin code -->
        <div id="fb-customer-chat" class="fb-customerchat">
        </div>

        <script>
            var chatbox = document.getElementById('fb-customer-chat');
            chatbox.setAttribute("page_id", "{{ $setting->facebook_messenger }}");
            chatbox.setAttribute("attribution", "biz_inbox");
            window.fbAsyncInit = function() {
                FB.init({
                    xfbml: true,
                    version: 'v11.0'
                });
            };

            (function(d, s, id) {
                var js, fjs = d.getElementsByTagName(s)[0];
                if (d.getElementById(id)) return;
                js = d.createElement(s);
                js.id = id;
                js.src = 'https://connect.facebook.net/en_US/sdk/xfbml.customerchat.js';
                fjs.parentNode.insertBefore(js, fjs);
            }(document, 'script', 'facebook-jssdk'));
        </script>
    @endif



    <script type="text/javascript">
        let mainurl = '{{ route('front.index') }}';

        let view_extra_index = 0;
        // Notifications
        function SuccessNotification(title) {
            $.notify({
                title: ` <strong>${title}</strong>`,
                message: '',
                icon: 'fas fa-check-circle'
            }, {
                element: 'body',
                position: null,
                type: "success",
                allow_dismiss: true,
                newest_on_top: false,
                showProgressbar: false,
                placement: {
                    from: "top",
                    align: "right"
                },
                offset: 20,
                spacing: 10,
                z_index: 1031,
                delay: 5000,
                timer: 1000,
                url_target: '_blank',
                mouse_over: null,
                animate: {
                    enter: 'animated fadeInDown',
                    exit: 'animated fadeOutUp'
                },
                onShow: null,
                onShown: null,
                onClose: null,
                onClosed: null,
                icon_type: 'class'
            });
        }

        function DangerNotification(title) {
            $.notify({
                // options
                title: ` <strong>${title}</strong>`,
                message: '',
                icon: 'fas fa-exclamation-triangle'
            }, {
                // settings
                element: 'body',
                position: null,
                type: "danger",
                allow_dismiss: true,
                newest_on_top: false,
                showProgressbar: false,
                placement: {
                    from: "top",
                    align: "right"
                },
                offset: 20,
                spacing: 10,
                z_index: 1031,
                delay: 5000,
                timer: 1000,
                url_target: '_blank',
                mouse_over: null,
                animate: {
                    enter: 'animated fadeInDown',
                    exit: 'animated fadeOutUp'
                },
                onShow: null,
                onShown: null,
                onClose: null,
                onClosed: null,
                icon_type: 'class'
            });
        }
        // Notifications Ends
    </script>

    @if (Session::has('error'))
        <script>
            $(document).ready(function() {
                DangerNotification('{{ Session::get('error') }}')
            })
        </script>
    @endif
    @if (Session::has('success'))
        <script>
            $(document).ready(function() {
                SuccessNotification('{{ Session::get('success') }}');
            })
        </script>
    @endif

</body>

</html>
