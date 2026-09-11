@extends('master.back-login')

@section('content')
<div class="auth-card">
    <div class="auth-header">
        @if(isset($setting->logo) && $setting->logo)
            <div class="auth-brand-logo-wrap">
                <img src="{{ url('/core/public/storage/images/' . $setting->logo) }}" alt="{{ $setting->title ?? 'Maansa' }}" class="auth-brand-logo">
            </div>
        @else
            <div class="brand-badge-emerald">
                <i class="fa-solid fa-lock-open"></i>
            </div>
        @endif
        <h2>{{ __('Change Password') }}</h2>
        <p>{{ __('Enter your new password below.') }}</p>
    </div>

    @include('alerts.alerts')

    <form action="{{ route('back.change.password') }}" method="POST">
        @csrf

        <div class="auth-form-group">
            <label for="new_password">{{ __('New Password') }}</label>
            <div class="auth-input-wrapper">
                <i class="fa-solid fa-lock input-icon"></i>
                <input id="new_password" name="new_password" type="password" placeholder="••••••••" required>
            </div>
        </div>

        <div class="auth-form-group">
            <label for="renew_password">{{ __('Re-Type New Password') }}</label>
            <div class="auth-input-wrapper">
                <i class="fa-solid fa-lock input-icon"></i>
                <input id="renew_password" name="renew_password" type="password" placeholder="••••••••" required>
            </div>
        </div>

        <input type="hidden" name="file_token" value="{{ $token }}">

        <button type="submit" class="btn-auth-submit" style="margin-top: 10px;">
            <span>{{ __('Update Password') }}</span>
            <i class="fa-solid fa-check ml-1"></i>
        </button>
    </form>
</div>
@endsection
