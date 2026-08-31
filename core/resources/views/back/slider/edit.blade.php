@extends('master.back')

@section('content')

<div class="container-fluid">

    <!-- Page Header Banner -->
    <div class="dash-hero-banner mb-4">
        <div class="dash-hero-content">
            <div class="dash-hero-text">
                <h2><i class="fa-solid fa-pen-to-square mr-2" style="font-size: 22px;"></i> {{ __('Update Slider') }}</h2>
                <p>{{ __('Update slider image, logo, link destination, and promotional content.') }}</p>
                <ul class="profile-breadcrumb mt-2">
                    <li><a href="{{ route('back.dashboard') }}"><i class="fa-solid fa-house"></i> {{ __('Dashboard') }}</a></li>
                    <span class="divider">/</span>
                    <li><a href="{{ route('back.slider.index') }}">{{ __('Sliders') }}</a></li>
                    <span class="divider">/</span>
                    <li class="active">{{ __('Edit') }}</li>
                </ul>
            </div>
            <div class="dash-hero-actions">
                <a class="btn btn-hero-action" href="{{ route('back.slider.index') }}" style="font-size: 13px; font-weight: 600; padding: 10px 18px; background: rgba(255,255,255,0.15); color: #ffffff; border: 1px solid rgba(255,255,255,0.25);">
                    <i class="fa-solid fa-arrow-left mr-1"></i> {{ __('Back to Sliders') }}
                </a>
            </div>
        </div>
    </div>

    @include('alerts.alerts')

    <!-- Form -->
    <div class="row justify-content-center">
        <div class="col-xl-9 col-lg-10 col-12">
            <div class="card-modern">
                <div class="card-modern-body p-4">
                    <div class="d-flex align-items-center justify-content-between mb-4 pb-3 border-bottom">
                        <div class="settings-tab-pane-title mb-0">
                            <i class="fa-solid fa-sliders text-primary mr-1"></i> {{ __('Slider Details') }}
                        </div>
                        <div>
                            @php
                                $theme = strtolower($slider->home_page ?? 'theme1');
                            @endphp
                            @if($theme == 'theme1')
                                <span class="badge" style="background: #eff6ff; color: #1d4ed8; border: 1px solid #bfdbfe; font-size: 12px; font-weight: 700; padding: 6px 14px; border-radius: 999px;">
                                    <i class="fa-solid fa-store mr-1"></i> {{ __('Home 1 Theme') }}
                                </span>
                            @elseif($theme == 'theme2')
                                <span class="badge" style="background: #f0fdf4; color: #15803d; border: 1px solid #bbf7d0; font-size: 12px; font-weight: 700; padding: 6px 14px; border-radius: 999px;">
                                    <i class="fa-solid fa-bag-shopping mr-1"></i> {{ __('Home 2 Theme') }}
                                </span>
                            @elseif($theme == 'theme3')
                                <span class="badge" style="background: #fff7ed; color: #c2410c; border: 1px solid #fed7aa; font-size: 12px; font-weight: 700; padding: 6px 14px; border-radius: 999px;">
                                    <i class="fa-solid fa-bolt mr-1"></i> {{ __('Home 3 Theme') }}
                                </span>
                            @elseif($theme == 'theme4')
                                <span class="badge" style="background: #faf5ff; color: #7e22ce; border: 1px solid #e9d5ff; font-size: 12px; font-weight: 700; padding: 6px 14px; border-radius: 999px;">
                                    <i class="fa-solid fa-gem mr-1"></i> {{ __('Home 4 Theme') }}
                                </span>
                            @endif
                        </div>
                    </div>

                    <form class="admin-form" action="{{ route('back.slider.update', $slider->id) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <input type="hidden" name="home_page" value="{{ $slider->home_page }}">

                        @if ($slider->home_page != 'theme4')
                            <!-- Logo / Feature Image Section -->
                            <div class="settings-section-card mb-4">
                                <h6 class="section-card-title">
                                    <i class="fa-solid {{ $slider->home_page == 'theme3' ? 'fa-star' : 'fa-tag' }} text-primary mr-1"></i> 
                                    {{ $slider->home_page == 'theme3' ? __('Feature Product Image') : __('Brand Logo') }}
                                </h6>
                                <div class="row align-items-center mb-2">
                                    <div class="col-12 col-sm-auto mb-2 mb-sm-0">
                                        <div style="{{ $slider->home_page == 'theme3' ? 'width: 80px; height: 80px;' : 'width: 140px; height: 50px;' }} border-radius: 10px; overflow: hidden; background: #ffffff; border: 1px solid #cbd5e1; display: flex; align-items: center; justify-content: center; padding: 4px;">
                                            <img class="admin-img" 
                                                 style="max-width: 100%; max-height: 100%; object-fit: contain;"
                                                 src="{{ $slider->logo ? url('/core/public/storage/images/'.$slider->logo) : url('/core/public/storage/images/placeholder.png') }}"
                                                 alt="Logo"
                                                 onerror="this.onerror=null; this.src='{{ url('/core/public/storage/images/placeholder.png') }}';">
                                        </div>
                                    </div>
                                    <div class="col-12 col-sm">
                                        <div class="position-relative mb-2">
                                            <label class="file">
                                                <input type="file" accept="image/*" class="upload-photo" name="logo" id="file_logo" aria-label="Upload Image">
                                                <span class="file-custom text-left">{{ __('Change Logo / Image...') }}</span>
                                            </label>
                                        </div>
                                        <span class="text-muted d-block" style="font-size: 12px;">
                                            <i class="fa-solid fa-circle-info text-primary mr-1"></i>
                                            {{ $slider->home_page == 'theme3' ? __('Image Size Should Be 320 x 320 pixels.') : __('Image Size Should Be 130 x 40 pixels.') }}
                                        </span>
                                    </div>
                                </div>
                            </div>

                            <!-- Text Content Section -->
                            <div class="settings-section-card mb-4">
                                <h6 class="section-card-title"><i class="fa-solid fa-pen text-primary mr-1"></i> {{ __('Slider Content & Links') }}</h6>
                                <div class="row">
                                    <div class="col-md-6 mb-3">
                                        <label for="title" class="form-label font-weight-bold">{{ __('Title') }} *</label>
                                        <input type="text" name="title" class="form-control" id="title" placeholder="{{ __('Enter Title') }}" value="{{ $slider->title }}" required>
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <label for="slider-link" class="form-label font-weight-bold">{{ __('Target URL / Link') }} *</label>
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text bg-light"><i class="fa-solid fa-link text-muted"></i></span>
                                            </div>
                                            <input type="text" name="link" class="form-control" id="slider-link" placeholder="{{ __('e.g. https://... or /products') }}" value="{{ $slider->link }}" required>
                                        </div>
                                    </div>
                                    <div class="col-12 mb-2">
                                        <label for="details" class="form-label font-weight-bold">{{ __('Details') }} *</label>
                                        <textarea name="details" id="details" class="form-control" rows="4" placeholder="{{ __('Enter Description / Subtitle Details') }}" required>{{ $slider->details }}</textarea>
                                    </div>
                                </div>
                            </div>

                            <!-- Main Slider Image Section -->
                            <div class="settings-section-card mb-4">
                                <h6 class="section-card-title"><i class="fa-solid fa-image text-primary mr-1"></i> {{ $slider->home_page == 'theme3' ? __('Main Background Slider Image') : __('Main Slider Image') }} *</h6>
                                <div class="row align-items-center mb-2">
                                    <div class="col-12 col-sm-auto mb-2 mb-sm-0">
                                        <div style="width: 160px; height: 80px; border-radius: 10px; overflow: hidden; background: #ffffff; border: 1px solid #cbd5e1; display: flex; align-items: center; justify-content: center;">
                                            <img class="admin-img" 
                                                 style="width: 100%; height: 100%; object-fit: cover;"
                                                 src="{{ $slider->photo ? url('/core/public/storage/images/'.$slider->photo) : url('/core/public/storage/images/placeholder.png') }}"
                                                 alt="Slider Photo"
                                                 onerror="this.onerror=null; this.src='{{ url('/core/public/storage/images/placeholder.png') }}';">
                                        </div>
                                    </div>
                                    <div class="col-12 col-sm">
                                        <div class="position-relative mb-2">
                                            <label class="file">
                                                <input type="file" accept="image/*" class="upload-photo" name="photo" id="file_photo" aria-label="Upload Slider Image">
                                                <span class="file-custom text-left">{{ __('Change Slider Image...') }}</span>
                                            </label>
                                        </div>
                                        <span class="text-muted d-block" style="font-size: 12px;">
                                            <i class="fa-solid fa-circle-info text-primary mr-1"></i>
                                            @if($slider->home_page == 'theme1')
                                                {{ __('Image Size Should Be 968 x 530 pixels.') }}
                                            @elseif($slider->home_page == 'theme2')
                                                {{ __('Image Size Should Be 1296 x 530 pixels.') }}
                                            @elseif($slider->home_page == 'theme3')
                                                {{ __('Image Size Should Be 1903 x 570 pixels.') }}
                                            @endif
                                        </span>
                                    </div>
                                </div>
                            </div>

                        @else
                            {{-- Theme 4 --}}
                            <input name="details" type="hidden" id="details" value="theme4">
                            <input type="hidden" name="title" id="title" value="theme 4">

                            <!-- Target Link Section -->
                            <div class="settings-section-card mb-4">
                                <h6 class="section-card-title"><i class="fa-solid fa-link text-primary mr-1"></i> {{ __('Target Link') }}</h6>
                                <div class="form-group mb-0">
                                    <label for="slider-link" class="form-label font-weight-bold">{{ __('Target URL / Link') }} *</label>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text bg-light"><i class="fa-solid fa-link text-muted"></i></span>
                                        </div>
                                        <input type="text" name="link" class="form-control" id="slider-link" placeholder="{{ __('e.g. https://... or /products') }}" value="{{ $slider->link }}" required>
                                    </div>
                                </div>
                            </div>

                            <!-- Main Slider Image Section -->
                            <div class="settings-section-card mb-4">
                                <h6 class="section-card-title"><i class="fa-solid fa-image text-primary mr-1"></i> {{ __('Main Slider Image') }} *</h6>
                                <div class="row align-items-center mb-2">
                                    <div class="col-12 col-sm-auto mb-2 mb-sm-0">
                                        <div style="width: 160px; height: 80px; border-radius: 10px; overflow: hidden; background: #ffffff; border: 1px solid #cbd5e1; display: flex; align-items: center; justify-content: center;">
                                            <img class="admin-img" 
                                                 style="width: 100%; height: 100%; object-fit: cover;"
                                                 src="{{ $slider->photo ? url('/core/public/storage/images/'.$slider->photo) : url('/core/public/storage/images/placeholder.png') }}"
                                                 alt="Slider Photo"
                                                 onerror="this.onerror=null; this.src='{{ url('/core/public/storage/images/placeholder.png') }}';">
                                        </div>
                                    </div>
                                    <div class="col-12 col-sm">
                                        <div class="position-relative mb-2">
                                            <label class="file">
                                                <input type="file" accept="image/*" class="upload-photo" name="photo" id="file_photo" aria-label="Upload Slider Image">
                                                <span class="file-custom text-left">{{ __('Change Slider Image...') }}</span>
                                            </label>
                                        </div>
                                        <span class="text-muted d-block" style="font-size: 12px;">
                                            <i class="fa-solid fa-circle-info text-primary mr-1"></i> {{ __('Image Size Should Be 1000 x 530 pixels.') }}
                                        </span>
                                    </div>
                                </div>
                            </div>
                        @endif

                        <div class="d-flex justify-content-end mt-4">
                            <button type="submit" class="btn btn-primary px-4 py-2" style="border-radius: 10px; font-weight: 700; background: linear-gradient(135deg, #4f46e5, #3b82f6); border: none; box-shadow: 0 4px 12px rgba(79, 70, 229, 0.3);">
                                <i class="fa-solid fa-floppy-disk mr-1"></i> {{ __('Update Slider') }}
                            </button>
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </div>

</div>

@endsection
