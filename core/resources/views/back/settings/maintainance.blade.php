@extends('master.back')

@section('content')

<div class="container-fluid">

    <!-- Page Header Banner -->
    <div class="dash-hero-banner mb-4">
        <div class="dash-hero-content">
            <div class="dash-hero-text">
                <h2><i class="fa-solid fa-screwdriver-wrench mr-2" style="font-size: 22px;"></i> {{ __('Maintenance Mode Settings') }}</h2>
                <p>{{ __('Temporarily put your storefront in maintenance mode while updating catalog, themes, or performing system upgrades.') }}</p>
                <ul class="profile-breadcrumb mt-2">
                    <li><a href="{{ route('back.dashboard') }}"><i class="fa-solid fa-house"></i> {{ __('Dashboard') }}</a></li>
                    <span class="divider">/</span>
                    <li><a href="{{ route('back.setting.system') }}">{{ __('Settings') }}</a></li>
                    <span class="divider">/</span>
                    <li class="active">{{ __('Maintenance') }}</li>
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
                            <i class="fa-solid fa-screwdriver-wrench text-primary mr-1"></i> {{ __('Maintenance Configuration') }}
                        </div>
                        <span class="badge" style="background: {{ $setting->is_maintainance == 1 ? '#fef2f2' : '#f0fdf4' }}; color: {{ $setting->is_maintainance == 1 ? '#b91c1c' : '#15803d' }}; border: 1px solid {{ $setting->is_maintainance == 1 ? '#fecaca' : '#bbf7d0' }}; font-size: 12px; font-weight: 600; padding: 5px 12px; border-radius: 999px;">
                            <i class="fa-solid fa-circle-dot mr-1"></i> {{ $setting->is_maintainance == 1 ? __('Active (Under Maintenance)') : __('Live (Store Active)') }}
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
                                        <i class="fa-solid fa-power-off text-primary mr-1"></i> {{ __('Enable Maintenance Mode') }}
                                    </h6>
                                    <span class="text-muted" style="font-size: 13px;">{{ __('When active, public visitors see a maintenance page while admins can still log in and browse.') }}</span>
                                </div>
                                <div>
                                    <label class="switch-primary mb-0">
                                        <input type="checkbox" class="switch switch-bootstrap status radio-check" name="is_maintainance" value="1" {{ $setting->is_maintainance == 1 ? 'checked' : '' }}>
                                        <span class="switch-body"></span>
                                    </label>
                                </div>
                            </div>
                        </div>

                        <!-- Settings Details Container -->
                        <div class="radio-show image-show {{ $setting->is_maintainance == 1 ? '' : 'd-none' }}">

                            <!-- Maintenance Image Card -->
                            <div class="settings-section-card mb-4">
                                <h6 class="section-card-title mb-3">
                                    <i class="fa-solid fa-image text-primary mr-1"></i> {{ __('Maintenance Cover Graphic') }}
                                </h6>
                                <div class="row align-items-center mb-2">
                                    <div class="col-auto mb-2 mb-sm-0">
                                        <div style="width: 140px; height: 140px; border-radius: 12px; overflow: hidden; background: #ffffff; border: 1px solid #cbd5e1; display: flex; align-items: center; justify-content: center; padding: 4px; box-shadow: 0 1px 3px rgba(0,0,0,0.05);">
                                            <img class="admin-img" 
                                                 style="max-width: 100%; max-height: 100%; object-fit: contain;" 
                                                 src="{{ $setting->maintainance_image ? url('/core/public/storage/images/'.$setting->maintainance_image) : url('/core/public/storage/images/placeholder.png') }}" 
                                                 alt="Maintenance Graphic"
                                                 onerror="this.onerror=null; this.src='{{ url('/core/public/storage/images/placeholder.png') }}';">
                                        </div>
                                    </div>
                                    <div class="col-12 col-sm">
                                        <div class="position-relative mb-2">
                                            <label class="file">
                                                <input type="file" accept="image/*" class="upload-photo" name="maintainance_image" id="file_maintainance" aria-label="Upload Image">
                                                <span class="file-custom text-left">{{ __('Change Graphic Image...') }}</span>
                                            </label>
                                        </div>
                                        <span class="text-muted d-block" style="font-size: 12px;">
                                            <i class="fa-solid fa-circle-info text-primary mr-1"></i> {{ __('Recommended Image Size: 520 x 529 pixels (JPG, PNG, WebP).') }}
                                        </span>
                                    </div>
                                </div>
                            </div>

                            <!-- Maintenance Text Card -->
                            <div class="settings-section-card mb-4">
                                <h6 class="section-card-title mb-3">
                                    <i class="fa-solid fa-pen text-primary mr-1"></i> {{ __('Maintenance Message Content') }}
                                </h6>

                                <div class="form-group mb-0">
                                    <label for="maintainance_text" class="form-label font-weight-bold">{{ __('Public Notice Text') }} *</label>
                                    <textarea name="maintainance_text" id="maintainance_text" class="form-control" rows="5" placeholder="{{ __('e.g. We are currently performing scheduled maintenance. We will be back online shortly!') }}">{{ $setting->maintainance_text }}</textarea>
                                    <small class="text-muted mt-2 d-block" style="font-size: 12.5px;">
                                        <i class="fa-solid fa-circle-info text-primary mr-1"></i> {{ __('This message is displayed prominently on the maintenance landing page.') }}
                                    </small>
                                </div>
                            </div>

                        </div>

                        <div class="d-flex justify-content-end mt-4">
                            <button type="submit" class="btn btn-primary px-4 py-2" style="border-radius: 10px; font-weight: 700; background: linear-gradient(135deg, #10b981, #059669); border: none; box-shadow: 0 4px 12px rgba(16, 185, 129, 0.3);">
                                <i class="fa-solid fa-floppy-disk mr-1"></i> {{ __('Save Maintenance Settings') }}
                            </button>
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </div>

</div>

@endsection
