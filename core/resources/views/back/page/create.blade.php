@extends('master.back')

@section('content')

<div class="container-fluid">

    <!-- Page Header Banner -->
    <div class="dash-hero-banner mb-4">
        <div class="dash-hero-content">
            <div class="dash-hero-text">
                <h2><i class="fa-solid fa-plus-circle mr-2" style="font-size: 22px;"></i> {{ __('Create New Custom Page') }}</h2>
                <p>{{ __('Author a new content page, configure storefront navigation placement, and manage SEO meta tags.') }}</p>
            </div>
            <div class="dash-hero-actions">
                <a class="btn btn-hero-action btn-hero-primary" href="{{ route('back.page.index') }}" style="font-size: 13.5px; font-weight: 700; padding: 10px 20px;">
                    <i class="fa-solid fa-chevron-left mr-1"></i> {{ __('Back to Pages') }}
                </a>
            </div>
        </div>
    </div>

    <!-- Form Card -->
    <div class="row">
        <div class="col-lg-12">
            <div class="card-modern">
                <div class="card-modern-body">
                    <form class="admin-form" action="{{ route('back.page.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @include('alerts.alerts')

                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="title" class="form-label font-weight-bold">{{ __('Page Title') }} *</label>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="fa-solid fa-heading"></i></span>
                                    </div>
                                    <input type="text" name="title" class="form-control" id="title" placeholder="{{ __('e.g. Privacy Policy, FAQ, About Us') }}" value="{{ old('title') }}" required>
                                </div>
                            </div>

                            <div class="col-md-6 mb-3">
                                <label for="slug" class="form-label font-weight-bold">{{ __('Page Slug (URL Identifier)') }} *</label>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="fa-solid fa-link"></i></span>
                                    </div>
                                    <input type="text" name="slug" class="form-control" id="slug" placeholder="{{ __('e.g. privacy-policy') }}" value="{{ old('slug') }}" required>
                                </div>
                            </div>
                        </div>

                        <div class="form-group mb-4">
                            <label for="details" class="form-label font-weight-bold">{{ __('Page Content & Details') }} *</label>
                            <textarea name="details" id="details" class="form-control text-editor" rows="8" placeholder="{{ __('Enter page details here...') }}" required>{{ old('details') }}</textarea>
                        </div>

                        <div class="settings-section-card mb-4">
                            <h6 class="section-card-title"><i class="fa-solid fa-magnifying-glass text-primary mr-1"></i> {{ __('Search Engine Optimization (SEO) Settings') }}</h6>
                            
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label for="meta_keywords" class="form-label font-weight-bold">{{ __('Meta Keywords') }}</label>
                                    <input type="text" name="meta_keywords" class="form-control tags" id="meta_keywords" placeholder="{{ __('e.g. privacy, policy, security') }}" value="{{ old('meta_keywords') }}">
                                </div>

                                <div class="col-md-6 mb-3">
                                    <label for="meta_description" class="form-label font-weight-bold">{{ __('Meta Description') }}</label>
                                    <textarea name="meta_descriptions" id="meta_description" class="form-control" rows="3" placeholder="{{ __('Brief description for search engine result snippets...') }}">{{ old('meta_descriptions') }}</textarea>
                                </div>
                            </div>
                        </div>

                        <div class="d-flex justify-content-end gap-2">
                            <a href="{{ route('back.page.index') }}" class="btn btn-secondary px-4 mr-2" style="border-radius: 10px; font-weight: 700;">{{ __('Cancel') }}</a>
                            <button type="submit" class="btn btn-primary px-4" style="border-radius: 10px; font-weight: 700; background: linear-gradient(135deg, #10b981, #059669); border: none; box-shadow: 0 4px 12px rgba(16, 185, 129, 0.3);">
                                <i class="fa-solid fa-floppy-disk mr-1"></i> {{ __('Save & Publish Page') }}
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
