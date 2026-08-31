@extends('master.back')

@section('content')
<div class="container-fluid">

    <!-- Page Header -->
    <div class="profile-header-card">
        <div class="profile-header-content">
            <div class="profile-title-group">
                <h3><i class="fa-solid fa-key text-primary"></i> {{ __('Change Password') }}</h3>
                <p>{{ __('Update and secure your administrative login credentials.') }}</p>
            </div>
            <ul class="profile-breadcrumb">
                <li><a href="{{ route('back.dashboard') }}"><i class="fa-solid fa-house"></i> {{ __('Dashboard') }}</a></li>
                <span class="divider">/</span>
                <li><a href="{{ route('back.profile') }}">{{ __('Profile') }}</a></li>
                <span class="divider">/</span>
                <li class="active">{{ __('Security') }}</li>
            </ul>
        </div>
    </div>

    @include('alerts.alerts')

    <div class="row justify-content-center">
        <div class="col-xl-8 col-lg-9">
            <div class="profile-box-card">
                <div class="profile-box-header">
                    <h4><i class="fa-solid fa-lock text-primary"></i> {{ __('Update Password Credentials') }}</h4>
                </div>
                <div class="profile-box-body">
                    <form class="admin-form" action="{{ route('back.password.update') }}" method="POST">
                        @csrf

                        <div class="modern-form-group">
                            <label for="current_password">{{ __('Current Password') }} <span class="required-asterisk">*</span></label>
                            <div class="modern-input-box">
                                <i class="fa-solid fa-lock-open input-icon-prefix"></i>
                                <input type="password" name="current_password" id="current_password" placeholder="{{ __('Enter your current password') }}" required>
                            </div>
                        </div>

                        <div class="modern-form-group">
                            <label for="new_password">{{ __('New Password') }} <span class="required-asterisk">*</span></label>
                            <div class="modern-input-box">
                                <i class="fa-solid fa-lock input-icon-prefix"></i>
                                <input type="password" name="new_password" id="new_password" placeholder="{{ __('Enter your new password') }}" required>
                            </div>
                        </div>

                        <div class="modern-form-group">
                            <label for="renew_password">{{ __('Confirm New Password') }} <span class="required-asterisk">*</span></label>
                            <div class="modern-input-box">
                                <i class="fa-solid fa-shield-halved input-icon-prefix"></i>
                                <input type="password" name="renew_password" id="renew_password" placeholder="{{ __('Re-enter your new password') }}" required>
                            </div>
                        </div>

                        <hr style="margin: 28px 0; border: 0; border-top: 1px solid #f1f5f9;">

                        <div class="d-flex align-items-center justify-content-between flex-wrap gap-2">
                            <button type="submit" class="btn-save-profile" style="color: #ffffff !important;">
                                <i class="fa-solid fa-shield-check" style="color: #ffffff !important;"></i>
                                <span style="color: #ffffff !important;">{{ __('Update Password') }}</span>
                            </button>
                            <a href="{{ route('back.profile') }}" class="btn btn-outline-secondary btn-round btn-sm">
                                <i class="fa-solid fa-arrow-left mr-1"></i> {{ __('Back to Profile') }}
                            </a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

</div>
@endsection
