@extends('master.back')

@section('content')

<div class="container-fluid">

    <!-- Page Header Banner -->
    <div class="dash-hero-banner mb-4">
        <div class="dash-hero-content">
            <div class="dash-hero-text">
                <h2><i class="fa-solid fa-plus-circle mr-2" style="font-size: 22px;"></i> {{ __('Create Service') }}</h2>
                <p>{{ __('Add a new service highlight, perk, or guarantee to showcase on your storefront.') }}</p>
                <ul class="profile-breadcrumb mt-2">
                    <li><a href="{{ route('back.dashboard') }}"><i class="fa-solid fa-house"></i> {{ __('Dashboard') }}</a></li>
                    <span class="divider">/</span>
                    <li><a href="{{ route('back.service.index') }}">{{ __('Services') }}</a></li>
                    <span class="divider">/</span>
                    <li class="active">{{ __('Create') }}</li>
                </ul>
            </div>
            <div class="dash-hero-actions mt-2 mt-sm-0">
                <a class="btn btn-hero-action" href="{{ route('back.service.index') }}" style="font-size: 13px; font-weight: 600; padding: 9px 16px; background: rgba(255,255,255,0.15); color: #ffffff; border: 1px solid rgba(255,255,255,0.25);">
                    <i class="fa-solid fa-arrow-left mr-1"></i> {{ __('Back to Services') }}
                </a>
            </div>
        </div>
    </div>

    <!-- Form -->
    <div class="row justify-content-center">
        <div class="col-xl-8 col-lg-9 col-12">
            <div class="card-modern">
                <div class="card-modern-body p-4">
                    <div class="settings-tab-pane-title mb-4 pb-3 border-bottom">
                        <i class="fa-solid fa-truck-fast text-primary mr-1"></i> {{ __('Service Information') }}
                    </div>

                    @include('alerts.alerts')

                    <form class="admin-form" action="{{ route('back.service.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf

                        <!-- Image Section -->
                        <div class="settings-section-card mb-4">
                            <h6 class="section-card-title"><i class="fa-solid fa-image text-primary mr-1"></i> {{ __('Service Icon / Image') }} *</h6>
                            <div class="row align-items-center mb-2">
                                <div class="col-auto mb-2 mb-sm-0">
                                    <div style="width: 80px; height: 80px; border-radius: 12px; overflow: hidden; background: #ffffff; border: 1px solid #cbd5e1; display: flex; align-items: center; justify-content: center; padding: 6px; box-shadow: 0 1px 3px rgba(0,0,0,0.04);">
                                        <img class="admin-img" style="max-width: 100%; max-height: 100%; object-fit: contain;" src="{{ url('/core/public/storage/images/placeholder.png') }}" alt="Service Icon">
                                    </div>
                                </div>
                                <div class="col-12 col-sm">
                                    <div class="position-relative mb-2">
                                        <label class="file">
                                            <input type="file" accept="image/*" class="upload-photo" name="photo" id="file_service" aria-label="Upload Service Image" required>
                                            <span class="file-custom text-left">{{ __('Upload Service Icon...') }}</span>
                                        </label>
                                    </div>
                                    <span class="text-muted d-block" style="font-size: 12px;"><i class="fa-solid fa-circle-info text-primary mr-1"></i> {{ __('Recommended Image Size: 65 x 65 pixels (PNG/SVG transparent recommended).') }}</span>
                                </div>
                            </div>
                        </div>

                        <!-- Content Section -->
                        <div class="settings-section-card mb-4">
                            <h6 class="section-card-title"><i class="fa-solid fa-pen text-primary mr-1"></i> {{ __('Service Content') }}</h6>
                            <div class="form-group mb-3">
                                <label for="title" class="form-label font-weight-bold">{{ __('Title') }} *</label>
                                <input type="text" name="title" class="form-control" id="title" placeholder="{{ __('e.g. Free Worldwide Shipping') }}" value="{{ old('title') }}" required>
                            </div>

                            <div class="form-group mb-0">
                                <label for="details" class="form-label font-weight-bold">{{ __('Details / Subtitle') }} *</label>
                                <textarea name="details" id="details" class="form-control" rows="4" placeholder="{{ __('e.g. On all orders over $100.00') }}" required>{{ old('details') }}</textarea>
                            </div>
                        </div>

                        <div class="d-flex justify-content-end mt-4">
                            <button type="submit" class="btn btn-primary px-4 py-2" style="border-radius: 10px; font-weight: 700; background: linear-gradient(135deg, #10b981, #059669); border: none; box-shadow: 0 4px 12px rgba(16, 185, 129, 0.3);">
                                <i class="fa-solid fa-floppy-disk mr-1"></i> {{ __('Save Service') }}
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

</div>

@endsection
