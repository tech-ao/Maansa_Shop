@extends('master.back')

@section('content')

<div class="container-fluid">

    <!-- Page Header Banner -->
    <div class="dash-hero-banner mb-4">
        <div class="dash-hero-content">
            <div class="dash-hero-text">
                <h2><i class="fa-solid fa-plus-circle mr-2" style="font-size: 22px;"></i> {{ __('Generate New Sitemap') }}</h2>
                <p>{{ __('Enter your website address to crawl URLs and generate a new XML search engine sitemap.') }}</p>
                <ul class="profile-breadcrumb mt-2">
                    <li><a href="{{ route('back.dashboard') }}"><i class="fa-solid fa-house"></i> {{ __('Dashboard') }}</a></li>
                    <span class="divider">/</span>
                    <li><a href="{{ route('admin.sitemap.index') }}">{{ __('Sitemaps') }}</a></li>
                    <span class="divider">/</span>
                    <li class="active">{{ __('Create') }}</li>
                </ul>
            </div>
            <div class="dash-hero-actions mt-2 mt-sm-0">
                <a class="btn btn-hero-action" href="{{ route('admin.sitemap.index') }}" style="font-size: 13px; font-weight: 600; padding: 9px 16px; background: rgba(255,255,255,0.15); color: #ffffff; border: 1px solid rgba(255,255,255,0.25);">
                    <i class="fa-solid fa-arrow-left mr-1"></i> {{ __('Back to Sitemaps') }}
                </a>
            </div>
        </div>
    </div>

    <!-- Form Container -->
    <div class="row justify-content-center">
        <div class="col-xl-7 col-lg-8 col-12 mb-4">
            <div class="card-modern">
                <div class="card-modern-body p-4">
                    <div class="settings-tab-pane-title mb-4 pb-3 border-bottom d-flex align-items-center justify-content-between">
                        <div>
                            <i class="fa-solid fa-globe text-primary mr-1"></i> {{ __('Sitemap Parameters') }}
                        </div>
                        <span class="badge" style="background: #eff6ff; color: #1d4ed8; border: 1px solid #bfdbfe; font-size: 12px; font-weight: 600; padding: 5px 12px; border-radius: 999px;">
                            <i class="fa-solid fa-robot mr-1"></i> {{ __('Crawler') }}
                        </span>
                    </div>

                    @include('alerts.alerts')

                    <form class="admin-form" action="{{ route('admin.sitemap.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <input type="hidden" name="filename">

                        <div class="settings-section-card mb-4">
                            <h6 class="section-card-title mb-3">
                                <i class="fa-solid fa-link text-primary mr-1"></i> {{ __('Target Domain / URL') }}
                            </h6>

                            <div class="form-group mb-0">
                                <label for="sitemap_url" class="form-label font-weight-bold">{{ __('Website URL to Crawl') }} *</label>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text bg-light"><i class="fa-solid fa-globe text-muted"></i></span>
                                    </div>
                                    <input type="url" name="sitemap_url" class="form-control" id="sitemap_url" placeholder="{{ __('e.g. https://yourdomain.com') }}" value="{{ old('sitemap_url', url('/')) }}" required>
                                </div>
                                <small class="text-muted mt-2 d-block" style="font-size: 12.5px;">
                                    <i class="fa-solid fa-circle-info text-primary mr-1"></i> {{ __('The crawler will index all internal links starting from this root URL and produce a downloadable .xml file.') }}
                                </small>
                            </div>
                        </div>

                        <div class="d-flex justify-content-end mt-4">
                            <button type="submit" class="btn btn-primary px-4 py-2" style="border-radius: 10px; font-weight: 700; background: linear-gradient(135deg, #4f46e5, #3b82f6); border: none; box-shadow: 0 4px 12px rgba(79, 70, 229, 0.3);">
                                <i class="fa-solid fa-wand-magic-sparkles mr-1"></i> {{ __('Generate Sitemap Now') }}
                            </button>
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </div>

</div>

@endsection
