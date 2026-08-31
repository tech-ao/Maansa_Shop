@extends('master.back-login')

@section('content')
<div class="auth-card">
    <div class="auth-header">
        <div class="brand-badge" style="background: linear-gradient(135deg, #0ea5e9, #06b6d4);">
            <i class="fa-solid fa-key"></i>
        </div>
        <h2>Reset Password</h2>
        <p>{{ __('Enter your registered email address to receive password reset instructions.') }}</p>
    </div>

    @include('alerts.alerts')

    <form action="{{ route('back.forgot.submit') }}" method="POST">
        @csrf

        <div class="auth-form-group">
            <label for="email">{{ __('Email Address') }}</label>
            <div class="auth-input-wrapper">
                <i class="fa-regular fa-envelope input-icon"></i>
                <input id="email" name="email" type="email" value="{{ old('email') }}" placeholder="admin@gmail.com" required autofocus>
            </div>
        </div>

        <div class="auth-options" style="justify-content: flex-end; margin-bottom: 20px;">
            <a href="{{ route('back.login') }}" class="auth-forgot-link">
                <i class="fa-solid fa-arrow-left"></i> {{ __('Back to Login') }}
            </a>
        </div>

        <button type="submit" class="btn-auth-submit" style="background: linear-gradient(135deg, #0ea5e9, #0284c7);">
            <span>{{ __('Send Password Reset Link') }}</span>
            <i class="fa-solid fa-paper-plane"></i>
        </button>
    </form>
</div>
@endsection
