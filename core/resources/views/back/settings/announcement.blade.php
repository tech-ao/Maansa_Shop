@extends('master.back')

@section('content')

<div class="container-fluid">

    <!-- Page Header Banner -->
    <div class="dash-hero-banner mb-4">
        <div class="dash-hero-content">
            <div class="dash-hero-text">
                <h2><i class="fa-solid fa-bullhorn mr-2" style="font-size: 22px;"></i> {{ __('Announcement & Newsletter Popup') }}</h2>
                <p>{{ __('Configure promotional banner popups, newsletter subscriptions, delay timers, and redirect links.') }}</p>
                <ul class="profile-breadcrumb mt-2">
                    <li><a href="{{ route('back.dashboard') }}"><i class="fa-solid fa-house"></i> {{ __('Dashboard') }}</a></li>
                    <span class="divider">/</span>
                    <li><a href="{{ route('back.setting.system') }}">{{ __('Settings') }}</a></li>
                    <span class="divider">/</span>
                    <li class="active">{{ __('Announcement') }}</li>
                </ul>
            </div>
        </div>
    </div>

    <!-- Form Container -->
    <div class="row justify-content-center">
        <div class="col-xl-8 col-lg-9 col-12 mb-4">
            <div class="card-modern">
                <div class="card-modern-body p-4">
                    <div class="settings-tab-pane-title mb-4 pb-3 border-bottom d-flex align-items-center justify-content-between">
                        <div>
                            <i class="fa-solid fa-bullhorn text-primary mr-1"></i> {{ __('Popup Configuration') }}
                        </div>
                        <span class="badge" style="background: #ecfdf5; color: #065f46; border: 1px solid #a7f3d0; font-size: 12px; font-weight: 600; padding: 5px 12px; border-radius: 999px;">
                            <i class="fa-solid fa-window-restore mr-1"></i> {{ __('Storefront Modal') }}
                        </span>
                    </div>

                    @include('alerts.alerts')

                    <form class="admin-form" action="{{ route('back.setting.update') }}" method="POST" enctype="multipart/form-data">
                        @csrf

                        <!-- Enable/Disable Switch Card -->
                        <div class="settings-section-card mb-4">
                            <div class="d-flex align-items-center justify-content-between">
                                <div>
                                    <h6 class="section-card-title mb-1">
                                        <i class="fa-solid fa-power-off text-primary mr-1"></i> {{ __('Enable Announcement Popup') }}
                                    </h6>
                                    <span class="text-muted" style="font-size: 13px;">{{ __('Display an automatic promotional popup or newsletter signup modal when visitors load your website.') }}</span>
                                </div>
                                <div>
                                    <label class="switch-primary mb-0">
                                        <input type="checkbox" class="switch switch-bootstrap status radio-check" name="is_announcement" value="1" {{ $setting->is_announcement == 1 ? 'checked' : '' }}>
                                        <span class="switch-body"></span>
                                    </label>
                                </div>
                            </div>
                        </div>

                        <!-- Settings Details Container -->
                        <div class="radio-show image-show {{ $setting->is_announcement == 1 ? '' : 'd-none' }}">

                            <!-- Popup Type & Timing Card -->
                            <div class="settings-section-card mb-4">
                                <h6 class="section-card-title mb-3">
                                    <i class="fa-solid fa-sliders text-primary mr-1"></i> {{ __('Popup Type & Timing') }}
                                </h6>
                                <div class="row">
                                    <div class="col-md-6 mb-3">
                                        <label for="announcement_type" class="form-label font-weight-bold">{{ __('Popup Type') }} *</label>
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text"><i class="fa-solid fa-layer-group"></i></span>
                                            </div>
                                            <select name="announcement_type" id="announcement_type" class="form-control" required>
                                                <option value="banner" {{ $setting->announcement_type == 'banner' ? 'selected' : '' }}>{{ __('Announcement Banner Popup') }}</option>
                                                <option value="newletter" {{ $setting->announcement_type == 'newletter' ? 'selected' : '' }}>{{ __('Newsletter Subscription Popup') }}</option>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="col-md-6 mb-3">
                                        <label for="announcement_delay" class="form-label font-weight-bold">{{ __('Popup Delay (Seconds)') }} *</label>
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text"><i class="fa-solid fa-clock"></i></span>
                                            </div>
                                            <input type="number" min="0" step="1" name="announcement_delay" class="form-control" id="announcement_delay" placeholder="{{ __('e.g. 3') }}" value="{{ $setting->announcement_delay }}" required>
                                        </div>
                                        <small class="text-muted mt-1 d-block" style="font-size: 12px;">{{ __('Number of seconds to wait before opening popup after page load.') }}</small>
                                    </div>
                                </div>
                            </div>

                            <!-- Popup Visual Image Card -->
                            <div class="settings-section-card mb-4">
                                <h6 class="section-card-title mb-3">
                                    <i class="fa-solid fa-image text-primary mr-1"></i> {{ __('Popup Promotional Graphic') }}
                                </h6>
                                <div class="row align-items-center mb-2">
                                    <div class="col-auto mb-2 mb-sm-0">
                                        <div style="width: 140px; height: 140px; border-radius: 12px; overflow: hidden; background: #ffffff; border: 1px solid #cbd5e1; display: flex; align-items: center; justify-content: center; padding: 4px; box-shadow: 0 1px 3px rgba(0,0,0,0.05);">
                                            <img class="admin-img" 
                                                 style="max-width: 100%; max-height: 100%; object-fit: contain;" 
                                                 src="{{ $setting->announcement ? url('/core/public/storage/images/'.$setting->announcement) : url('/core/public/storage/images/placeholder.png') }}" 
                                                 alt="Announcement Popup"
                                                 onerror="this.onerror=null; this.src='{{ url('/core/public/storage/images/placeholder.png') }}';">
                                        </div>
                                    </div>
                                    <div class="col-12 col-sm">
                                        <div class="position-relative mb-2">
                                            <label class="file">
                                                <input type="file" accept="image/*" class="upload-photo" name="announcement" id="file_announcement" aria-label="Upload Image">
                                                <span class="file-custom text-left">{{ __('Change Popup Image...') }}</span>
                                            </label>
                                        </div>
                                        <span class="text-muted d-block mb-1" style="font-size: 12px;">
                                            <i class="fa-solid fa-circle-info text-primary mr-1"></i> {{ __('Recommended Image Size for Announcement: 520 x 529 pixels.') }}
                                        </span>
                                        <span class="text-muted d-block" style="font-size: 12px;">
                                            <i class="fa-solid fa-circle-info text-primary mr-1"></i> {{ __('Recommended Image Size for Newsletter: 300 x 400 pixels.') }}
                                        </span>
                                    </div>
                                </div>
                            </div>

                            <!-- Content & Link Card -->
                            <div class="settings-section-card mb-4">
                                <h6 class="section-card-title mb-3">
                                    <i class="fa-solid fa-pen text-primary mr-1"></i> {{ __('Text Content & Target Destination') }}
                                </h6>

                                <div class="form-group mb-3">
                                    <label for="announcement_title" class="form-label font-weight-bold">{{ __('Headline / Title') }} *</label>
                                    <input type="text" name="announcement_title" class="form-control" id="announcement_title" placeholder="{{ __('e.g. Subscribe to our newsletter & get 20% off') }}" value="{{ $setting->announcement_title }}">
                                </div>

                                <div class="form-group mb-3">
                                    <label for="announcement_details" class="form-label font-weight-bold">{{ __('Description / Subtitle Details') }}</label>
                                    <textarea name="announcement_details" class="form-control" id="announcement_details" rows="4" placeholder="{{ __('e.g. Sign up today and receive exclusive deals straight to your inbox.') }}">{{ $setting->announcement_details }}</textarea>
                                </div>

                                <div class="form-group mb-0">
                                    <label for="announcement_link" class="form-label font-weight-bold">{{ __('Action / Banner Target Link') }} *</label>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="fa-solid fa-link"></i></span>
                                        </div>
                                        <input type="text" name="announcement_link" class="form-control" id="announcement_link" placeholder="{{ __('e.g. https://... or /shop') }}" value="{{ $setting->announcement_link }}">
                                    </div>
                                    <small class="text-muted mt-1 d-block" style="font-size: 12px;">{{ __('The URL opened when visitors click on the banner image or action button.') }}</small>
                                </div>
                            </div>

                        </div>

                        <div class="d-flex justify-content-end mt-4">
                            <button type="submit" class="btn btn-primary px-4 py-2" style="border-radius: 10px; font-weight: 700; background: linear-gradient(135deg, #10b981, #059669); border: none; box-shadow: 0 4px 12px rgba(16, 185, 129, 0.3);">
                                <i class="fa-solid fa-floppy-disk mr-1"></i> {{ __('Save Announcement Settings') }}
                            </button>
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </div>

</div>

@endsection
