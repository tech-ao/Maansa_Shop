@extends('master.back')

@section('content')

<div class="container-fluid">

    <!-- Page Header Banner -->
    <div class="dash-hero-banner mb-4">
        <div class="dash-hero-content">
            <div class="dash-hero-text">
                <h2><i class="fa-solid fa-folder-plus mr-2" style="font-size: 22px;"></i> {{ __('Create New Category') }}</h2>
                <p>{{ __('Add a top-level product category, upload thumbnail icon, and configure display order.') }}</p>
            </div>
            <div class="dash-hero-actions">
                <a class="btn btn-hero-action btn-hero-primary" href="{{ route('back.category.index') }}" style="font-size: 13.5px; font-weight: 700; padding: 10px 20px;">
                    <i class="fa-solid fa-chevron-left mr-1"></i> {{ __('Back to Categories') }}
                </a>
            </div>
        </div>
    </div>

    <!-- Form Card -->
    <div class="row">
        <div class="col-lg-12">
            <div class="card-modern">
                <div class="card-modern-body">
                    <form class="admin-form" action="{{ route('back.category.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @include('alerts.alerts')

                        <!-- Media / Thumbnail Upload Area -->
                        <div class="settings-section-card mb-4">
                            <h6 class="section-card-title"><i class="fa-solid fa-image text-primary mr-1"></i> {{ __('Category Thumbnail / Icon') }} *</h6>
                            <div class="row align-items-center">
                                <div class="col-auto">
                                    <div style="width: 80px; height: 80px; border-radius: 14px; overflow: hidden; background: #ffffff; border: 2px dashed #cbd5e1; display: flex; align-items: center; justify-content: center;">
                                        <img class="admin-img" src="{{ url('/core/public/storage/images/placeholder.png') }}" alt="Category Thumbnail" style="width: 100%; height: 100%; object-fit: cover;">
                                    </div>
                                </div>
                                <div class="col">
                                    <div class="position-relative mb-2">
                                        <label class="file">
                                            <input type="file" accept="image/*" class="upload-photo" name="photo" id="file" aria-label="Upload Category Image" required>
                                            <span class="file-custom text-left">{{ __('Choose Category Image...') }}</span>
                                        </label>
                                    </div>
                                    <span class="text-muted" style="font-size: 12.5px;"><i class="fa-solid fa-circle-info text-primary mr-1"></i> {{ __('Recommended image size: 60 x 60 pixels (PNG or JPG).') }}</span>
                                </div>
                            </div>
                        </div>

                        <!-- Basic Information -->
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="name" class="form-label font-weight-bold">{{ __('Category Name') }} *</label>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text bg-light"><i class="fa-solid fa-tag text-muted"></i></span>
                                    </div>
                                    <input type="text" name="name" class="form-control item-name" id="name" placeholder="{{ __('e.g. Electronics, Fashion, Home Decor') }}" value="{{ old('name') }}" required>
                                </div>
                            </div>

                            <div class="col-md-6 mb-3">
                                <label for="slug" class="form-label font-weight-bold">{{ __('Category Slug') }} *</label>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text bg-light"><i class="fa-solid fa-link text-muted"></i></span>
                                    </div>
                                    <input type="text" name="slug" class="form-control" id="slug" placeholder="{{ __('e.g. electronics, fashion') }}" value="{{ old('slug') }}" required>
                                </div>
                            </div>
                        </div>

                        <div class="form-group mb-4">
                            <label for="serial" class="form-label font-weight-bold">{{ __('Display Sorting Serial Number') }} *</label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text bg-light"><i class="fa-solid fa-arrow-down-1-9 text-muted"></i></span>
                                </div>
                                <input type="number" name="serial" class="form-control" id="serial" placeholder="{{ __('0') }}" value="0" style="max-width: 250px;">
                            </div>
                        </div>

                        <!-- SEO Metadata -->
                        <div class="settings-section-card mb-4">
                            <h6 class="section-card-title"><i class="fa-solid fa-magnifying-glass text-primary mr-1"></i> {{ __('Search Engine Optimization (SEO) Settings') }}</h6>
                            
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label for="meta_keywords" class="form-label font-weight-bold">{{ __('Meta Keywords') }}</label>
                                    <input type="text" name="meta_keywords" class="form-control tags" id="meta_keywords" placeholder="{{ __('e.g. fashion, clothes, apparel') }}" value="{{ old('meta_keywords') }}">
                                </div>

                                <div class="col-md-6 mb-3">
                                    <label for="meta_description" class="form-label font-weight-bold">{{ __('Meta Description') }}</label>
                                    <textarea name="meta_descriptions" id="meta_description" class="form-control" rows="3" placeholder="{{ __('Brief description of this category for search engines...') }}">{{ old('meta_descriptions') }}</textarea>
                                </div>
                            </div>
                        </div>

                        <div class="d-flex justify-content-end gap-2">
                            <a href="{{ route('back.category.index') }}" class="btn btn-secondary px-4 mr-2" style="border-radius: 10px; font-weight: 700;">{{ __('Cancel') }}</a>
                            <button type="submit" class="btn btn-primary px-4" style="border-radius: 10px; font-weight: 700; background: linear-gradient(135deg, #4f46e5, #3b82f6); border: none; box-shadow: 0 4px 12px rgba(79, 70, 229, 0.3);">
                                <i class="fa-solid fa-floppy-disk mr-1"></i> {{ __('Save Category') }}
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
