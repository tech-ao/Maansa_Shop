@extends('master.back-login')

@section('content')
<div class="auth-card">
    <div class="auth-header">
        <div class="brand-badge" style="background: linear-gradient(135deg, #10b981, #059669);">
            <i class="fa-solid fa-lock-open"></i>
        </div>
        <h2>Change Password</h2>
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

        <button type="submit" class="btn-auth-submit" style="background: linear-gradient(135deg, #10b981, #059669); margin-top: 10px;">
            <span>{{ __('Update Password') }}</span>
            <i class="fa-solid fa-check"></i>
        </button>
    </form>
</div>
@endsection
