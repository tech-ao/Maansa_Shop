@extends('master.back')

@section('content')

<div class="container-fluid">

    <!-- Page Header Banner -->
    <div class="dash-hero-banner mb-4">
        <div class="dash-hero-content">
            <div class="dash-hero-text">
                <h2><i class="fa-solid fa-toggle-on mr-2" style="font-size: 22px;"></i> {{ __('Homepage Section Visibility') }}</h2>
                <p>{{ __('Enable or disable specific sections, hero sliders, promo grids, and category blocks across each homepage layout.') }}</p>
            </div>
            <ul class="profile-breadcrumb">
                <li><a href="{{ route('back.dashboard') }}"><i class="fa-solid fa-house"></i> {{ __('Dashboard') }}</a></li>
                <span class="divider">/</span>
                <li>{{ __('Manage Site') }}</li>
                <span class="divider">/</span>
                <li class="active">{{ __('Section Visibility') }}</li>
            </ul>
        </div>
    </div>

    <!-- Main Form Layout -->
    <div class="row">
        <!-- Navigation Pills Column -->
        <div class="col-xl-3 col-lg-4 col-12 mb-4">
            <div class="nav settings-nav-pills theme_change" id="v-pills-tab" role="tablist" aria-orientation="vertical">
                <a class="nav-link active" data="theme1" data-toggle="pill" href="#hone" role="tab">
                    <i class="fa-solid fa-desktop"></i>
                    <span>{{ __('Home Layout 1 (Default)') }}</span>
                </a>
                <a class="nav-link" data="theme2" data-toggle="pill" href="#htwo" role="tab">
                    <i class="fa-solid fa-store"></i>
                    <span>{{ __('Home Layout 2 (Grocery / Modern)') }}</span>
                </a>
                <a class="nav-link" data="theme3" data-toggle="pill" href="#hthree" role="tab">
                    <i class="fa-solid fa-bag-shopping"></i>
                    <span>{{ __('Home Layout 3 (Fashion / Clean)') }}</span>
                </a>
                <a class="nav-link" data="theme4" data-toggle="pill" href="#hfour" role="tab">
                    <i class="fa-solid fa-laptop"></i>
                    <span>{{ __('Home Layout 4 (Electronics / Grid)') }}</span>
                </a>
            </div>
        </div>

        <!-- Content Column -->
        <div class="col-xl-9 col-lg-8 col-12 mb-4">
            <div class="card-modern">
                <div class="card-modern-body">
                    @include('alerts.alerts')

                    <form class="admin-form" action="{{ route('back.setting.visible.update') }}" method="POST" enctype="multipart/form-data">
                        @csrf

                        <div class="tab-content" id="v-pills-tabContent">
                            
                            {{-- THEME 1 --}}
                            <div id="hone" class="tab-pane fade show active" role="tabpanel">
                                <div class="settings-tab-pane-title mb-3">
                                    <i class="fa-solid fa-desktop text-primary mr-1"></i> {{ __('Home Layout 1 Section Toggles') }}
                                </div>
                                <p class="text-muted mb-4" style="font-size: 13px;">{{ __('Turn individual homepage sections on or off for the default storefront layout.') }}</p>

                                <div class="row">
                                    @php
                                        $t1_sections = [
                                            ['name' => 'is_slider', 'val' => $setting->is_slider, 'title' => __('Slider Section'), 'icon' => 'fa-panorama'],
                                            ['name' => 'is_three_c_b_first', 'val' => $setting->is_three_c_b_first, 'title' => __('3 Column Banner First'), 'icon' => 'fa-table-columns'],
                                            ['name' => 'is_popular_category', 'val' => $setting->is_popular_category, 'title' => __('Popular Categories'), 'icon' => 'fa-fire'],
                                            ['name' => 'is_three_c_b_second', 'val' => $setting->is_three_c_b_second, 'title' => __('3 Column Banner Second'), 'icon' => 'fa-table-cells'],
                                            ['name' => 'is_t1_falsh', 'val' => $extra_settings->is_t1_falsh, 'title' => __('Flash Deal Section'), 'icon' => 'fa-bolt'],
                                            ['name' => 'is_highlighted', 'val' => $setting->is_highlighted, 'title' => __('Product Tabs (Featured, Bestseller, Top Rated, New)'), 'icon' => 'fa-boxes-stacked'],
                                            ['name' => 'is_popular_brand', 'val' => $setting->is_popular_brand, 'title' => __('Popular Brands Showcase'), 'icon' => 'fa-copyright'],
                                            ['name' => 'is_featured_category', 'val' => $setting->is_featured_category, 'title' => __('Featured Categories'), 'icon' => 'fa-star'],
                                            ['name' => 'is_two_c_b', 'val' => $setting->is_two_c_b, 'title' => __('Two Column Banner'), 'icon' => 'fa-columns'],
                                            ['name' => 'is_two_column_category', 'val' => $setting->is_two_column_category, 'title' => __('Three Column Category Blocks'), 'icon' => 'fa-layer-group'],
                                            ['name' => 'is_blogs', 'val' => $setting->is_blogs, 'title' => __('Blog & News Section'), 'icon' => 'fa-newspaper'],
                                            ['name' => 'is_service', 'val' => $setting->is_service, 'title' => __('Service & Features Section'), 'icon' => 'fa-shield-halved'],
                                        ];
                                    @endphp

                                    @foreach($t1_sections as $sec)
                                    <div class="col-md-6 col-12 mb-3">
                                        <div class="feature-toggle-card p-3" style="background: #f8fafc; border: 1px solid #e2e8f0; border-radius: 12px; display: flex; align-items: center; justify-content: space-between;">
                                            <div class="d-flex align-items-center">
                                                <div style="width: 36px; height: 36px; border-radius: 8px; background: rgba(79, 70, 229, 0.08); color: #059669; display: flex; align-items: center; justify-content: center; margin-right: 12px; font-size: 15px;">
                                                    <i class="fa-solid {{ $sec['icon'] }}"></i>
                                                </div>
                                                <span class="font-weight-bold" style="color: #1e293b; font-size: 13.5px;">{{ $sec['title'] }}</span>
                                            </div>
                                            <label class="switch-primary mb-0">
                                                <input type="checkbox" class="switch switch-bootstrap" name="{{ $sec['name'] }}" value="1" {{ $sec['val'] == 1 ? 'checked' : '' }}>
                                                <span class="switch-body"></span>
                                            </label>
                                        </div>
                                    </div>
                                    @endforeach
                                </div>
                            </div>

                            {{-- THEME 2 --}}
                            <div id="htwo" class="tab-pane fade" role="tabpanel">
                                <div class="settings-tab-pane-title mb-3">
                                    <i class="fa-solid fa-store text-primary mr-1"></i> {{ __('Home Layout 2 Section Toggles') }}
                                </div>
                                <p class="text-muted mb-4" style="font-size: 13px;">{{ __('Turn individual homepage sections on or off for Home Layout 2.') }}</p>

                                <div class="row">
                                    @php
                                        $t2_sections = [
                                            ['name' => 'is_t2_slider', 'val' => $extra_settings->is_t2_slider, 'title' => __('Slider Section'), 'icon' => 'fa-panorama'],
                                            ['name' => 'is_t2_service_section', 'val' => $extra_settings->is_t2_service_section, 'title' => __('Service Section'), 'icon' => 'fa-shield-halved'],
                                            ['name' => 'is_t2_3_column_banner_first', 'val' => $extra_settings->is_t2_3_column_banner_first, 'title' => __('3 Column Banner First'), 'icon' => 'fa-table-columns'],
                                            ['name' => 'is_t2_new_product', 'val' => $extra_settings->is_t2_new_product, 'title' => __('New Product Section'), 'icon' => 'fa-sparkles'],
                                            ['name' => 'is_t2_3_column_banner_second', 'val' => $extra_settings->is_t2_3_column_banner_second, 'title' => __('3 Column Banner Second'), 'icon' => 'fa-table-cells'],
                                            ['name' => 'is_t2_falsh', 'val' => $extra_settings->is_t2_falsh, 'title' => __('Flash Deal Section'), 'icon' => 'fa-bolt'],
                                            ['name' => 'is_t2_featured_product', 'val' => $extra_settings->is_t2_featured_product, 'title' => __('Featured Product Section'), 'icon' => 'fa-star'],
                                            ['name' => 'is_t2_bestseller_product', 'val' => $extra_settings->is_t2_bestseller_product, 'title' => __('Bestseller Product Section'), 'icon' => 'fa-award'],
                                            ['name' => 'is_t2_toprated_product', 'val' => $extra_settings->is_t2_toprated_product, 'title' => __('Top Rated Product Section'), 'icon' => 'fa-thumbs-up'],
                                            ['name' => 'is_t2_2_column_banner', 'val' => $extra_settings->is_t2_2_column_banner, 'title' => __('2 Column Banner'), 'icon' => 'fa-columns'],
                                            ['name' => 'is_t2_three_column_category', 'val' => $extra_settings->is_t2_three_column_category, 'title' => __('Three Column Category Blocks'), 'icon' => 'fa-layer-group'],
                                            ['name' => 'is_t2_blog_section', 'val' => $extra_settings->is_t2_blog_section, 'title' => __('Blog & News Section'), 'icon' => 'fa-newspaper'],
                                            ['name' => 'is_t2_brand_section', 'val' => $extra_settings->is_t2_brand_section, 'title' => __('Brand Section'), 'icon' => 'fa-copyright'],
                                        ];
                                    @endphp

                                    @foreach($t2_sections as $sec)
                                    <div class="col-md-6 col-12 mb-3">
                                        <div class="feature-toggle-card p-3" style="background: #f8fafc; border: 1px solid #e2e8f0; border-radius: 12px; display: flex; align-items: center; justify-content: space-between;">
                                            <div class="d-flex align-items-center">
                                                <div style="width: 36px; height: 36px; border-radius: 8px; background: rgba(79, 70, 229, 0.08); color: #059669; display: flex; align-items: center; justify-content: center; margin-right: 12px; font-size: 15px;">
                                                    <i class="fa-solid {{ $sec['icon'] }}"></i>
                                                </div>
                                                <span class="font-weight-bold" style="color: #1e293b; font-size: 13.5px;">{{ $sec['title'] }}</span>
                                            </div>
                                            <label class="switch-primary mb-0">
                                                <input type="checkbox" class="switch switch-bootstrap" name="{{ $sec['name'] }}" value="1" {{ $sec['val'] == 1 ? 'checked' : '' }}>
                                                <span class="switch-body"></span>
                                            </label>
                                        </div>
                                    </div>
                                    @endforeach
                                </div>
                            </div>

                            {{-- THEME 3 --}}
                            <div id="hthree" class="tab-pane fade" role="tabpanel">
                                <div class="settings-tab-pane-title mb-3">
                                    <i class="fa-solid fa-bag-shopping text-primary mr-1"></i> {{ __('Home Layout 3 Section Toggles') }}
                                </div>
                                <p class="text-muted mb-4" style="font-size: 13px;">{{ __('Turn individual homepage sections on or off for Home Layout 3.') }}</p>

                                <div class="row">
                                    @php
                                        $t3_sections = [
                                            ['name' => 'is_t3_slider', 'val' => $extra_settings->is_t3_slider, 'title' => __('Slider Section'), 'icon' => 'fa-panorama'],
                                            ['name' => 'is_t3_service_section', 'val' => $extra_settings->is_t3_service_section, 'title' => __('Service Section'), 'icon' => 'fa-shield-halved'],
                                            ['name' => 'is_t3_3_column_banner_first', 'val' => $extra_settings->is_t3_3_column_banner_first, 'title' => __('3 Column Banner First'), 'icon' => 'fa-table-columns'],
                                            ['name' => 'is_t3_falsh', 'val' => $extra_settings->is_t3_falsh, 'title' => __('Flash Deal Section'), 'icon' => 'fa-bolt'],
                                            ['name' => 'is_t3_popular_category', 'val' => $extra_settings->is_t3_popular_category, 'title' => __('Popular Categories'), 'icon' => 'fa-fire'],
                                            ['name' => 'is_t3_3_column_banner_second', 'val' => $extra_settings->is_t3_3_column_banner_second, 'title' => __('3 Column Banner Second'), 'icon' => 'fa-table-cells'],
                                            ['name' => 'is_t3_pecialpick', 'val' => $extra_settings->is_t3_pecialpick, 'title' => __('Special Pick Showcase'), 'icon' => 'fa-gem'],
                                            ['name' => 'is_t3_brand_section', 'val' => $extra_settings->is_t3_brand_section, 'title' => __('Brand Section'), 'icon' => 'fa-copyright'],
                                            ['name' => 'is_t3_three_column_category', 'val' => $extra_settings->is_t3_three_column_category, 'title' => __('Three Column Category Blocks'), 'icon' => 'fa-layer-group'],
                                            ['name' => 'is_t3_2_column_banner', 'val' => $extra_settings->is_t3_2_column_banner, 'title' => __('2 Column Banner'), 'icon' => 'fa-columns'],
                                            ['name' => 'is_t3_blog_section', 'val' => $extra_settings->is_t3_blog_section, 'title' => __('Blog & News Section'), 'icon' => 'fa-newspaper'],
                                        ];
                                    @endphp

                                    @foreach($t3_sections as $sec)
                                    <div class="col-md-6 col-12 mb-3">
                                        <div class="feature-toggle-card p-3" style="background: #f8fafc; border: 1px solid #e2e8f0; border-radius: 12px; display: flex; align-items: center; justify-content: space-between;">
                                            <div class="d-flex align-items-center">
                                                <div style="width: 36px; height: 36px; border-radius: 8px; background: rgba(79, 70, 229, 0.08); color: #059669; display: flex; align-items: center; justify-content: center; margin-right: 12px; font-size: 15px;">
                                                    <i class="fa-solid {{ $sec['icon'] }}"></i>
                                                </div>
                                                <span class="font-weight-bold" style="color: #1e293b; font-size: 13.5px;">{{ $sec['title'] }}</span>
                                            </div>
                                            <label class="switch-primary mb-0">
                                                <input type="checkbox" class="switch switch-bootstrap" name="{{ $sec['name'] }}" value="1" {{ $sec['val'] == 1 ? 'checked' : '' }}>
                                                <span class="switch-body"></span>
                                            </label>
                                        </div>
                                    </div>
                                    @endforeach
                                </div>
                            </div>

                            {{-- THEME 4 --}}
                            <div id="hfour" class="tab-pane fade" role="tabpanel">
                                <div class="settings-tab-pane-title mb-3">
                                    <i class="fa-solid fa-laptop text-primary mr-1"></i> {{ __('Home Layout 4 Section Toggles') }}
                                </div>
                                <p class="text-muted mb-4" style="font-size: 13px;">{{ __('Turn individual homepage sections on or off for Home Layout 4.') }}</p>

                                <div class="row">
                                    @php
                                        $t4_sections = [
                                            ['name' => 'is_t4_slider', 'val' => $extra_settings->is_t4_slider, 'title' => __('Slider Section'), 'icon' => 'fa-panorama'],
                                            ['name' => 'is_t4_featured_banner', 'val' => $extra_settings->is_t4_featured_banner, 'title' => __('Featured Banner Grid'), 'icon' => 'fa-grip'],
                                            ['name' => 'is_t4_specialpick', 'val' => $extra_settings->is_t4_specialpick, 'title' => __('Special Pick Section'), 'icon' => 'fa-gem'],
                                            ['name' => 'is_t4_3_column_banner_first', 'val' => $extra_settings->is_t4_3_column_banner_first, 'title' => __('3 Column Banner First'), 'icon' => 'fa-table-columns'],
                                            ['name' => 'is_t4_flashdeal', 'val' => $extra_settings->is_t4_flashdeal, 'title' => __('Flash Deal Section'), 'icon' => 'fa-bolt'],
                                            ['name' => 'is_t4_3_column_banner_second', 'val' => $extra_settings->is_t4_3_column_banner_second, 'title' => __('3 Column Banner Second'), 'icon' => 'fa-table-cells'],
                                            ['name' => 'is_t4_popular_category', 'val' => $extra_settings->is_t4_popular_category, 'title' => __('Popular Categories'), 'icon' => 'fa-fire'],
                                            ['name' => 'is_t4_2_column_banner', 'val' => $extra_settings->is_t4_2_column_banner, 'title' => __('2 Column Banner'), 'icon' => 'fa-columns'],
                                            ['name' => 'is_t4_blog_section', 'val' => $extra_settings->is_t4_blog_section, 'title' => __('Blog & News Section'), 'icon' => 'fa-newspaper'],
                                            ['name' => 'is_t4_brand_section', 'val' => $extra_settings->is_t4_brand_section, 'title' => __('Brand Section'), 'icon' => 'fa-copyright'],
                                            ['name' => 'is_t4_service_section', 'val' => $extra_settings->is_t4_service_section, 'title' => __('Service Section'), 'icon' => 'fa-shield-halved'],
                                        ];
                                    @endphp

                                    @foreach($t4_sections as $sec)
                                    <div class="col-md-6 col-12 mb-3">
                                        <div class="feature-toggle-card p-3" style="background: #f8fafc; border: 1px solid #e2e8f0; border-radius: 12px; display: flex; align-items: center; justify-content: space-between;">
                                            <div class="d-flex align-items-center">
                                                <div style="width: 36px; height: 36px; border-radius: 8px; background: rgba(79, 70, 229, 0.08); color: #059669; display: flex; align-items: center; justify-content: center; margin-right: 12px; font-size: 15px;">
                                                    <i class="fa-solid {{ $sec['icon'] }}"></i>
                                                </div>
                                                <span class="font-weight-bold" style="color: #1e293b; font-size: 13.5px;">{{ $sec['title'] }}</span>
                                            </div>
                                            <label class="switch-primary mb-0">
                                                <input type="checkbox" class="switch switch-bootstrap" name="{{ $sec['name'] }}" value="1" {{ $sec['val'] == 1 ? 'checked' : '' }}>
                                                <span class="switch-body"></span>
                                            </label>
                                        </div>
                                    </div>
                                    @endforeach
                                </div>
                            </div>

                        </div>

                        <div class="d-flex justify-content-end mt-4">
                            <button type="submit" class="btn btn-primary px-4 py-2" style="border-radius: 10px; font-weight: 700; background: linear-gradient(135deg, #10b981, #059669); border: none; box-shadow: 0 4px 12px rgba(16, 185, 129, 0.3);">
                                <i class="fa-solid fa-floppy-disk mr-1"></i> {{ __('Save Section Visibility') }}
                            </button>
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </div>

</div>

@endsection
