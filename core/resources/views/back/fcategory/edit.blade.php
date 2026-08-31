@extends('master.back')

@section('content')

<div class="container-fluid">

    <!-- Page Header Banner -->
    <div class="dash-hero-banner mb-4">
        <div class="dash-hero-content">
            <div class="dash-hero-text">
                <h2><i class="fa-solid fa-pen-to-square mr-2" style="font-size: 22px;"></i> {{ __('Update FAQ Category') }}</h2>
                <p>{{ __('Edit topic details, slug URL, subtitle description, and SEO metadata for') }} <strong>{{ $fcategory->name }}</strong>.</p>
                <ul class="profile-breadcrumb mt-2">
                    <li><a href="{{ route('back.dashboard') }}"><i class="fa-solid fa-house"></i> {{ __('Dashboard') }}</a></li>
                    <span class="divider">/</span>
                    <li><a href="{{ route('back.fcategory.index') }}">{{ __('FAQ Categories') }}</a></li>
                    <span class="divider">/</span>
                    <li class="active">{{ $fcategory->name }}</li>
                </ul>
            </div>
            <div class="dash-hero-actions mt-2 mt-sm-0">
                <a class="btn btn-hero-action" href="{{ route('back.fcategory.index') }}" style="font-size: 13px; font-weight: 600; padding: 9px 16px; background: rgba(255,255,255,0.15); color: #ffffff; border: 1px solid rgba(255,255,255,0.25);">
                    <i class="fa-solid fa-arrow-left mr-1"></i> {{ __('Back to Categories') }}
                </a>
            </div>
        </div>
    </div>

    @include('alerts.alerts')

    <!-- Form Container -->
    <div class="row justify-content-center">
        <div class="col-xl-8 col-lg-10 col-12 mb-4">
            <div class="card-modern">
                <div class="card-modern-body p-4">
                    <form class="admin-form" action="{{ route('back.fcategory.update', $fcategory->id) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')

                        <!-- General Info Section -->
                        <div class="settings-section-card mb-4">
                            <div class="section-card-title">
                                <i class="fa-solid fa-folder-open text-primary"></i> {{ __('Category Information') }}
                            </div>

                            <div class="form-group mb-3">
                                <label for="name" class="form-label font-weight-bold">{{ __('Category Name') }} *</label>
                                <input type="text" name="name" class="form-control item-name" id="name" placeholder="{{ __('Enter Name') }}" value="{{ $fcategory->name }}" required>
                            </div>

                            <div class="form-group mb-3">
                                <label for="slug" class="form-label font-weight-bold">{{ __('Slug / URL Identifier') }} *</label>
                                <input type="text" name="slug" class="form-control" id="slug" placeholder="{{ __('Enter Slug') }}" value="{{ $fcategory->slug }}" required>
                            </div>

                            <div class="form-group mb-0">
                                <label for="text" class="form-label font-weight-bold">{{ __('Short Description / Subtitle') }} *</label>
                                <input type="text" name="text" class="form-control" id="text" placeholder="{{ __('Text') }}" value="{{ $fcategory->text }}" required>
                            </div>
                        </div>

                        <!-- SEO Section -->
                        <div class="settings-section-card mb-4">
                            <div class="section-card-title">
                                <i class="fa-solid fa-magnifying-glass text-primary"></i> {{ __('Search Engine Optimization (SEO)') }}
                            </div>

                            <div class="form-group mb-3">
                                <label for="meta_keywords" class="form-label font-weight-bold">{{ __('Meta Keywords') }}</label>
                                <input type="text" name="meta_keywords" class="tags form-control" id="meta_keywords" placeholder="{{ __('Enter Meta Keywords') }}" value="{{ $fcategory->meta_keywords }}">
                            </div>

                            <div class="form-group mb-0">
                                <label for="meta_descriptions" class="form-label font-weight-bold">{{ __('Meta Description') }}</label>
                                <textarea name="meta_descriptions" id="meta_descriptions" class="form-control" rows="4" placeholder="{{ __('Enter Meta Description') }}">{{ $fcategory->meta_descriptions }}</textarea>
                            </div>
                        </div>

                        <div class="d-flex justify-content-end mt-4 pt-3 border-top">
                            <button type="submit" class="btn btn-primary px-4 py-2" style="border-radius: 10px; font-weight: 700; background: linear-gradient(135deg, #4f46e5, #3b82f6); border: none; box-shadow: 0 4px 12px rgba(79, 70, 229, 0.3);">
                                <i class="fa-solid fa-floppy-disk mr-1"></i> {{ __('Save Changes') }}
                            </button>
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </div>

</div>

@endsection
