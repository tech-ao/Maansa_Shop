@extends('master.back')

@section('content')

<div class="container-fluid">

    <!-- Page Header Banner -->
    <div class="dash-hero-banner mb-4">
        <div class="dash-hero-content">
            <div class="dash-hero-text">
                <h2><i class="fa-solid fa-plus-circle mr-2" style="font-size: 22px;"></i> {{ __('Create Homepage Slider') }}</h2>
                <p>{{ __('Select a store theme and configure slider visuals, branding logos, text details, and target links.') }}</p>
                <ul class="profile-breadcrumb mt-2">
                    <li><a href="{{ route('back.dashboard') }}"><i class="fa-solid fa-house"></i> {{ __('Dashboard') }}</a></li>
                    <span class="divider">/</span>
                    <li><a href="{{ route('back.slider.index') }}">{{ __('Sliders') }}</a></li>
                    <span class="divider">/</span>
                    <li class="active">{{ __('Create') }}</li>
                </ul>
            </div>
            <div class="dash-hero-actions mt-2 mt-sm-0">
                <a class="btn btn-hero-action" href="{{ route('back.slider.index') }}" style="font-size: 13px; font-weight: 600; padding: 9px 16px; background: rgba(255,255,255,0.15); color: #ffffff; border: 1px solid rgba(255,255,255,0.25);">
                    <i class="fa-solid fa-arrow-left mr-1"></i> {{ __('Back to Sliders') }}
                </a>
            </div>
        </div>
    </div>

    <!-- Settings Row -->
    <div class="row">
        <!-- Navigation Tabs Column -->
        <div class="col-xl-3 col-lg-4 col-12 mb-3 mb-lg-0">
            <div class="nav settings-nav-pills" id="v-pills-tab" role="tablist" aria-orientation="vertical">
                <a class="nav-link active" id="pills-home-tab" data-toggle="pill" href="#pills-home" role="tab" aria-controls="pills-home" aria-selected="true">
                    <i class="fa-solid fa-store"></i>
                    <span>{{ __('Home 1 Theme') }}</span>
                </a>
                <a class="nav-link" id="pills-profile-tab" data-toggle="pill" href="#pills-profile" role="tab" aria-controls="pills-profile" aria-selected="false">
                    <i class="fa-solid fa-bag-shopping"></i>
                    <span>{{ __('Home 2 Theme') }}</span>
                </a>
                <a class="nav-link" id="pills-contact-tab" data-toggle="pill" href="#pills-contact" role="tab" aria-controls="pills-contact" aria-selected="false">
                    <i class="fa-solid fa-bolt"></i>
                    <span>{{ __('Home 3 Theme') }}</span>
                </a>
                <a class="nav-link" id="pills-home4-tab" data-toggle="pill" href="#pills-home4" role="tab" aria-controls="pills-home4" aria-selected="false">
                    <i class="fa-solid fa-gem"></i>
                    <span>{{ __('Home 4 Theme') }}</span>
                </a>
            </div>
        </div>

        <!-- Forms Container Column -->
        <div class="col-xl-9 col-lg-8 col-12 mb-4">
            <div class="card-modern">
                <div class="card-modern-body">
                    @include('alerts.alerts')

                    <div class="tab-content" id="pills-tabContent">
                        
                        {{-- 1. THEME 1 --}}
                        <div class="tab-pane fade show active" id="pills-home" role="tabpanel" aria-labelledby="pills-home-tab">
                            <div class="settings-tab-pane-title mb-4">
                                <i class="fa-solid fa-store text-primary mr-1"></i> {{ __('Home 1 Slider Setup') }}
                            </div>
                            <form action="{{ route('back.slider.store') }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                <input type="hidden" name="home_page" value="theme1">

                                <!-- Logo Section -->
                                <div class="settings-section-card mb-4">
                                    <h6 class="section-card-title"><i class="fa-solid fa-tag text-primary mr-1"></i> {{ __('Brand Logo') }}</h6>
                                    <div class="row align-items-center mb-2">
                                        <div class="col-auto mb-2 mb-sm-0">
                                            <div style="width: 140px; height: 55px; border-radius: 10px; overflow: hidden; background: #ffffff; border: 1px solid #cbd5e1; display: flex; align-items: center; justify-content: center; padding: 4px; box-shadow: 0 1px 3px rgba(0,0,0,0.04);">
                                                <img class="admin-img" style="max-width: 100%; max-height: 100%; object-fit: contain;" src="{{ url('/core/public/storage/images/placeholder.png') }}" alt="Brand Logo">
                                            </div>
                                        </div>
                                        <div class="col-12 col-sm">
                                            <div class="position-relative mb-2">
                                                <label class="file">
                                                    <input type="file" accept="image/*" class="upload-photo" name="logo" id="file_logo_1" aria-label="Upload Logo">
                                                    <span class="file-custom text-left">{{ __('Upload Brand Logo...') }}</span>
                                                </label>
                                            </div>
                                            <span class="text-muted d-block" style="font-size: 12px;"><i class="fa-solid fa-circle-info text-primary mr-1"></i> {{ __('Recommended Image Size: 130 x 40 pixels.') }}</span>
                                        </div>
                                    </div>
                                </div>

                                <!-- Text Content Section -->
                                <div class="settings-section-card mb-4">
                                    <h6 class="section-card-title"><i class="fa-solid fa-pen text-primary mr-1"></i> {{ __('Slider Content & Links') }}</h6>
                                    <div class="row">
                                        <div class="col-md-6 mb-3">
                                            <label for="title_1" class="form-label font-weight-bold">{{ __('Title') }} *</label>
                                            <input type="text" name="title" class="form-control" id="title_1" placeholder="{{ __('Enter Title') }}" value="{{ old('title') }}" required>
                                        </div>
                                        <div class="col-md-6 mb-3">
                                            <label for="link_1" class="form-label font-weight-bold">{{ __('Target URL / Link') }} *</label>
                                            <div class="input-group">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text"><i class="fa-solid fa-link"></i></span>
                                                </div>
                                                <input type="text" name="link" class="form-control" id="link_1" placeholder="{{ __('e.g. https://... or /products') }}" value="{{ old('link') }}" required>
                                            </div>
                                        </div>
                                        <div class="col-12 mb-2">
                                            <label for="details_1" class="form-label font-weight-bold">{{ __('Details') }} *</label>
                                            <textarea name="details" id="details_1" class="form-control" rows="4" placeholder="{{ __('Enter Description / Subtitle Details') }}" required>{{ old('details') }}</textarea>
                                        </div>
                                    </div>
                                </div>

                                <!-- Main Slider Image Section -->
                                <div class="settings-section-card mb-4">
                                    <h6 class="section-card-title"><i class="fa-solid fa-image text-primary mr-1"></i> {{ __('Main Slider Image') }} *</h6>
                                    <div class="row align-items-center mb-2">
                                        <div class="col-auto mb-2 mb-sm-0">
                                            <div style="width: 160px; height: 85px; border-radius: 10px; overflow: hidden; background: #ffffff; border: 1px solid #cbd5e1; display: flex; align-items: center; justify-content: center; box-shadow: 0 1px 3px rgba(0,0,0,0.04);">
                                                <img class="admin-img" style="width: 100%; height: 100%; object-fit: cover;" src="{{ url('/core/public/storage/images/placeholder.png') }}" alt="Slider Image">
                                            </div>
                                        </div>
                                        <div class="col-12 col-sm">
                                            <div class="position-relative mb-2">
                                                <label class="file">
                                                    <input type="file" accept="image/*" class="upload-photo" name="photo" id="file_photo_1" aria-label="Upload Slider Image" required>
                                                    <span class="file-custom text-left">{{ __('Upload Slider Image...') }}</span>
                                                </label>
                                            </div>
                                            <span class="text-muted d-block" style="font-size: 12px;"><i class="fa-solid fa-circle-info text-primary mr-1"></i> {{ __('Recommended Image Size: 968 x 530 pixels.') }}</span>
                                        </div>
                                    </div>
                                </div>

                                <div class="d-flex justify-content-end mt-4">
                                    <button type="submit" class="btn btn-primary px-4 py-2" style="border-radius: 10px; font-weight: 700; background: linear-gradient(135deg, #10b981, #059669); border: none; box-shadow: 0 4px 12px rgba(16, 185, 129, 0.3);">
                                        <i class="fa-solid fa-floppy-disk mr-1"></i> {{ __('Save Slider') }}
                                    </button>
                                </div>
                            </form>
                        </div>

                        {{-- 2. THEME 2 --}}
                        <div class="tab-pane fade" id="pills-profile" role="tabpanel" aria-labelledby="pills-profile-tab">
                            <div class="settings-tab-pane-title mb-4">
                                <i class="fa-solid fa-bag-shopping text-primary mr-1"></i> {{ __('Home 2 Slider Setup') }}
                            </div>
                            <form action="{{ route('back.slider.store') }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                <input type="hidden" name="home_page" value="theme2">

                                <!-- Logo Section -->
                                <div class="settings-section-card mb-4">
                                    <h6 class="section-card-title"><i class="fa-solid fa-tag text-primary mr-1"></i> {{ __('Brand Logo') }}</h6>
                                    <div class="row align-items-center mb-2">
                                        <div class="col-auto mb-2 mb-sm-0">
                                            <div style="width: 140px; height: 55px; border-radius: 10px; overflow: hidden; background: #ffffff; border: 1px solid #cbd5e1; display: flex; align-items: center; justify-content: center; padding: 4px; box-shadow: 0 1px 3px rgba(0,0,0,0.04);">
                                                <img class="admin-img" style="max-width: 100%; max-height: 100%; object-fit: contain;" src="{{ url('/core/public/storage/images/placeholder.png') }}" alt="Brand Logo">
                                            </div>
                                        </div>
                                        <div class="col-12 col-sm">
                                            <div class="position-relative mb-2">
                                                <label class="file">
                                                    <input type="file" accept="image/*" class="upload-photo" name="logo" id="file_logo_2" aria-label="Upload Logo">
                                                    <span class="file-custom text-left">{{ __('Upload Brand Logo...') }}</span>
                                                </label>
                                            </div>
                                            <span class="text-muted d-block" style="font-size: 12px;"><i class="fa-solid fa-circle-info text-primary mr-1"></i> {{ __('Recommended Image Size: 130 x 40 pixels.') }}</span>
                                        </div>
                                    </div>
                                </div>

                                <!-- Text Content Section -->
                                <div class="settings-section-card mb-4">
                                    <h6 class="section-card-title"><i class="fa-solid fa-pen text-primary mr-1"></i> {{ __('Slider Content & Links') }}</h6>
                                    <div class="row">
                                        <div class="col-md-6 mb-3">
                                            <label for="title_2" class="form-label font-weight-bold">{{ __('Title') }} *</label>
                                            <input type="text" name="title" class="form-control" id="title_2" placeholder="{{ __('Enter Title') }}" value="{{ old('title') }}" required>
                                        </div>
                                        <div class="col-md-6 mb-3">
                                            <label for="link_2" class="form-label font-weight-bold">{{ __('Target URL / Link') }} *</label>
                                            <div class="input-group">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text"><i class="fa-solid fa-link"></i></span>
                                                </div>
                                                <input type="text" name="link" class="form-control" id="link_2" placeholder="{{ __('e.g. https://... or /products') }}" value="{{ old('link') }}" required>
                                            </div>
                                        </div>
                                        <div class="col-12 mb-2">
                                            <label for="details_2" class="form-label font-weight-bold">{{ __('Details') }} *</label>
                                            <textarea name="details" id="details_2" class="form-control" rows="4" placeholder="{{ __('Enter Description / Subtitle Details') }}" required>{{ old('details') }}</textarea>
                                        </div>
                                    </div>
                                </div>

                                <!-- Main Slider Image Section -->
                                <div class="settings-section-card mb-4">
                                    <h6 class="section-card-title"><i class="fa-solid fa-image text-primary mr-1"></i> {{ __('Main Slider Image') }} *</h6>
                                    <div class="row align-items-center mb-2">
                                        <div class="col-auto mb-2 mb-sm-0">
                                            <div style="width: 160px; height: 85px; border-radius: 10px; overflow: hidden; background: #ffffff; border: 1px solid #cbd5e1; display: flex; align-items: center; justify-content: center; box-shadow: 0 1px 3px rgba(0,0,0,0.04);">
                                                <img class="admin-img" style="width: 100%; height: 100%; object-fit: cover;" src="{{ url('/core/public/storage/images/placeholder.png') }}" alt="Slider Image">
                                            </div>
                                        </div>
                                        <div class="col-12 col-sm">
                                            <div class="position-relative mb-2">
                                                <label class="file">
                                                    <input type="file" accept="image/*" class="upload-photo" name="photo" id="file_photo_2" aria-label="Upload Slider Image" required>
                                                    <span class="file-custom text-left">{{ __('Upload Slider Image...') }}</span>
                                                </label>
                                            </div>
                                            <span class="text-muted d-block" style="font-size: 12px;"><i class="fa-solid fa-circle-info text-primary mr-1"></i> {{ __('Recommended Image Size: 1296 x 530 pixels.') }}</span>
                                        </div>
                                    </div>
                                </div>

                                <div class="d-flex justify-content-end mt-4">
                                    <button type="submit" class="btn btn-primary px-4 py-2" style="border-radius: 10px; font-weight: 700; background: linear-gradient(135deg, #10b981, #059669); border: none; box-shadow: 0 4px 12px rgba(16, 185, 129, 0.3);">
                                        <i class="fa-solid fa-floppy-disk mr-1"></i> {{ __('Save Slider') }}
                                    </button>
                                </div>
                            </form>
                        </div>

                        {{-- 3. THEME 3 --}}
                        <div class="tab-pane fade" id="pills-contact" role="tabpanel" aria-labelledby="pills-contact-tab">
                            <div class="settings-tab-pane-title mb-4">
                                <i class="fa-solid fa-bolt text-primary mr-1"></i> {{ __('Home 3 Slider Setup') }}
                            </div>
                            <form action="{{ route('back.slider.store') }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                <input type="hidden" name="home_page" value="theme3">

                                <!-- Feature Image Section -->
                                <div class="settings-section-card mb-4">
                                    <h6 class="section-card-title"><i class="fa-solid fa-star text-primary mr-1"></i> {{ __('Feature Product Image') }}</h6>
                                    <div class="row align-items-center mb-2">
                                        <div class="col-auto mb-2 mb-sm-0">
                                            <div style="width: 80px; height: 80px; border-radius: 10px; overflow: hidden; background: #ffffff; border: 1px solid #cbd5e1; display: flex; align-items: center; justify-content: center; padding: 4px; box-shadow: 0 1px 3px rgba(0,0,0,0.04);">
                                                <img class="admin-img" style="max-width: 100%; max-height: 100%; object-fit: contain;" src="{{ url('/core/public/storage/images/placeholder.png') }}" alt="Feature Image">
                                            </div>
                                        </div>
                                        <div class="col-12 col-sm">
                                            <div class="position-relative mb-2">
                                                <label class="file">
                                                    <input type="file" accept="image/*" class="upload-photo" name="logo" id="file_logo_3" aria-label="Upload Feature Image">
                                                    <span class="file-custom text-left">{{ __('Upload Feature Image...') }}</span>
                                                </label>
                                            </div>
                                            <span class="text-muted d-block" style="font-size: 12px;"><i class="fa-solid fa-circle-info text-primary mr-1"></i> {{ __('Recommended Image Size: 320 x 320 pixels.') }}</span>
                                        </div>
                                    </div>
                                </div>

                                <!-- Text Content Section -->
                                <div class="settings-section-card mb-4">
                                    <h6 class="section-card-title"><i class="fa-solid fa-pen text-primary mr-1"></i> {{ __('Slider Content & Links') }}</h6>
                                    <div class="row">
                                        <div class="col-md-6 mb-3">
                                            <label for="title_3" class="form-label font-weight-bold">{{ __('Title') }} *</label>
                                            <input type="text" name="title" class="form-control" id="title_3" placeholder="{{ __('Enter Title') }}" value="{{ old('title') }}" required>
                                        </div>
                                        <div class="col-md-6 mb-3">
                                            <label for="link_3" class="form-label font-weight-bold">{{ __('Target URL / Link') }} *</label>
                                            <div class="input-group">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text"><i class="fa-solid fa-link"></i></span>
                                                </div>
                                                <input type="text" name="link" class="form-control" id="link_3" placeholder="{{ __('e.g. https://... or /products') }}" value="{{ old('link') }}" required>
                                            </div>
                                        </div>
                                        <div class="col-12 mb-2">
                                            <label for="details_3" class="form-label font-weight-bold">{{ __('Details') }} *</label>
                                            <textarea name="details" id="details_3" class="form-control" rows="4" placeholder="{{ __('Enter Description / Subtitle Details') }}" required>{{ old('details') }}</textarea>
                                        </div>
                                    </div>
                                </div>

                                <!-- Main Slider Image Section -->
                                <div class="settings-section-card mb-4">
                                    <h6 class="section-card-title"><i class="fa-solid fa-image text-primary mr-1"></i> {{ __('Main Background Slider Image') }} *</h6>
                                    <div class="row align-items-center mb-2">
                                        <div class="col-auto mb-2 mb-sm-0">
                                            <div style="width: 160px; height: 85px; border-radius: 10px; overflow: hidden; background: #ffffff; border: 1px solid #cbd5e1; display: flex; align-items: center; justify-content: center; box-shadow: 0 1px 3px rgba(0,0,0,0.04);">
                                                <img class="admin-img" style="width: 100%; height: 100%; object-fit: cover;" src="{{ url('/core/public/storage/images/placeholder.png') }}" alt="Slider Image">
                                            </div>
                                        </div>
                                        <div class="col-12 col-sm">
                                            <div class="position-relative mb-2">
                                                <label class="file">
                                                    <input type="file" accept="image/*" class="upload-photo" name="photo" id="file_photo_3" aria-label="Upload Slider Image" required>
                                                    <span class="file-custom text-left">{{ __('Upload Slider Image...') }}</span>
                                                </label>
                                            </div>
                                            <span class="text-muted d-block" style="font-size: 12px;"><i class="fa-solid fa-circle-info text-primary mr-1"></i> {{ __('Recommended Image Size: 1903 x 570 pixels.') }}</span>
                                        </div>
                                    </div>
                                </div>

                                <div class="d-flex justify-content-end mt-4">
                                    <button type="submit" class="btn btn-primary px-4 py-2" style="border-radius: 10px; font-weight: 700; background: linear-gradient(135deg, #10b981, #059669); border: none; box-shadow: 0 4px 12px rgba(16, 185, 129, 0.3);">
                                        <i class="fa-solid fa-floppy-disk mr-1"></i> {{ __('Save Slider') }}
                                    </button>
                                </div>
                            </form>
                        </div>

                        {{-- 4. THEME 4 --}}
                        <div class="tab-pane fade" id="pills-home4" role="tabpanel" aria-labelledby="pills-home4-tab">
                            <div class="settings-tab-pane-title mb-4">
                                <i class="fa-solid fa-gem text-primary mr-1"></i> {{ __('Home 4 Slider Setup') }}
                            </div>
                            <form action="{{ route('back.slider.store') }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                <input type="hidden" name="home_page" value="theme4">
                                <input type="hidden" name="title" value="theme 4">
                                <input type="hidden" name="details" value="theme4">

                                <!-- Link Section -->
                                <div class="settings-section-card mb-4">
                                    <h6 class="section-card-title"><i class="fa-solid fa-link text-primary mr-1"></i> {{ __('Target Link') }}</h6>
                                    <div class="form-group mb-0">
                                        <label for="link_4" class="form-label font-weight-bold">{{ __('Target URL / Link') }} *</label>
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text"><i class="fa-solid fa-link"></i></span>
                                            </div>
                                            <input type="text" name="link" class="form-control" id="link_4" placeholder="{{ __('e.g. https://... or /products') }}" value="{{ old('link') }}" required>
                                        </div>
                                    </div>
                                </div>

                                <!-- Main Slider Image Section -->
                                <div class="settings-section-card mb-4">
                                    <h6 class="section-card-title"><i class="fa-solid fa-image text-primary mr-1"></i> {{ __('Main Slider Image') }} *</h6>
                                    <div class="row align-items-center mb-2">
                                        <div class="col-auto mb-2 mb-sm-0">
                                            <div style="width: 160px; height: 85px; border-radius: 10px; overflow: hidden; background: #ffffff; border: 1px solid #cbd5e1; display: flex; align-items: center; justify-content: center; box-shadow: 0 1px 3px rgba(0,0,0,0.04);">
                                                <img class="admin-img" style="width: 100%; height: 100%; object-fit: cover;" src="{{ url('/core/public/storage/images/placeholder.png') }}" alt="Slider Image">
                                            </div>
                                        </div>
                                        <div class="col-12 col-sm">
                                            <div class="position-relative mb-2">
                                                <label class="file">
                                                    <input type="file" accept="image/*" class="upload-photo" name="photo" id="file_photo_4" aria-label="Upload Slider Image" required>
                                                    <span class="file-custom text-left">{{ __('Upload Slider Image...') }}</span>
                                                </label>
                                            </div>
                                            <span class="text-muted d-block" style="font-size: 12px;"><i class="fa-solid fa-circle-info text-primary mr-1"></i> {{ __('Recommended Image Size: 1000 x 530 pixels.') }}</span>
                                        </div>
                                    </div>
                                </div>

                                <div class="d-flex justify-content-end mt-4">
                                    <button type="submit" class="btn btn-primary px-4 py-2" style="border-radius: 10px; font-weight: 700; background: linear-gradient(135deg, #10b981, #059669); border: none; box-shadow: 0 4px 12px rgba(16, 185, 129, 0.3);">
                                        <i class="fa-solid fa-floppy-disk mr-1"></i> {{ __('Save Slider') }}
                                    </button>
                                </div>
                            </form>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>

</div>

@endsection
