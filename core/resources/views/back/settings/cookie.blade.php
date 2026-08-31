@extends('master.back')

@section('content')

<div class="container-fluid">

    <!-- Page Header Banner -->
    <div class="dash-hero-banner mb-4">
        <div class="dash-hero-content">
            <div class="dash-hero-text">
                <h2><i class="fa-solid fa-cookie-bite mr-2" style="font-size: 22px;"></i> {{ __('GDPR Cookie Consent Alert') }}</h2>
                <p>{{ __('Configure storefront cookie compliance notices, GDPR consent banner messages, and privacy notifications.') }}</p>
                <ul class="profile-breadcrumb mt-2">
                    <li><a href="{{ route('back.dashboard') }}"><i class="fa-solid fa-house"></i> {{ __('Dashboard') }}</a></li>
                    <span class="divider">/</span>
                    <li><a href="{{ route('back.setting.system') }}">{{ __('Settings') }}</a></li>
                    <span class="divider">/</span>
                    <li class="active">{{ __('Cookie Alert') }}</li>
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
                            <i class="fa-solid fa-cookie-bite text-primary mr-1"></i> {{ __('Cookie Alert Configuration') }}
                        </div>
                        <span class="badge" style="background: #eff6ff; color: #1d4ed8; border: 1px solid #bfdbfe; font-size: 12px; font-weight: 600; padding: 5px 12px; border-radius: 999px;">
                            <i class="fa-solid fa-shield-halved mr-1"></i> {{ __('Privacy & GDPR') }}
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
                                        <i class="fa-solid fa-power-off text-primary mr-1"></i> {{ __('Enable Cookie Consent Banner') }}
                                    </h6>
                                    <span class="text-muted" style="font-size: 13px;">{{ __('Display a sticky cookie privacy notice bar on the storefront for first-time visitors.') }}</span>
                                </div>
                                <div>
                                    <label class="switch-primary mb-0">
                                        <input type="checkbox" class="switch switch-bootstrap status radio-check" name="is_cookie" value="1" {{ $setting->is_cookie == 1 ? 'checked' : '' }}>
                                        <span class="switch-body"></span>
                                    </label>
                                </div>
                            </div>
                        </div>

                        <!-- Settings Details Container -->
                        <div class="radio-show image-show {{ $setting->is_cookie == 1 ? '' : 'd-none' }}">

                            <!-- Cookie Banner Message Card -->
                            <div class="settings-section-card mb-4">
                                <h6 class="section-card-title mb-3">
                                    <i class="fa-solid fa-message text-primary mr-1"></i> {{ __('Cookie Notice Message') }}
                                </h6>

                                <div class="form-group mb-0">
                                    <label for="cookie_text" class="form-label font-weight-bold">{{ __('Consent Disclaimer Text') }} *</label>
                                    <textarea name="cookie_text" class="form-control" id="cookie_text" rows="3" placeholder="{{ __('e.g. Your experience on this site will be improved by allowing cookies.') }}">{{ $setting->cookie_text }}</textarea>
                                    <small class="text-muted mt-2 d-block" style="font-size: 12.5px;">
                                        <i class="fa-solid fa-circle-info text-primary mr-1"></i> {{ __('This message informs visitors about the use of cookies and provides them with an accept button.') }}
                                    </small>
                                </div>
                            </div>

                        </div>

                        <div class="d-flex justify-content-end mt-4">
                            <button type="submit" class="btn btn-primary px-4 py-2" style="border-radius: 10px; font-weight: 700; background: linear-gradient(135deg, #4f46e5, #3b82f6); border: none; box-shadow: 0 4px 12px rgba(79, 70, 229, 0.3);">
                                <i class="fa-solid fa-floppy-disk mr-1"></i> {{ __('Save Cookie Settings') }}
                            </button>
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </div>

</div>

@endsection
