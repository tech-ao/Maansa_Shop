@extends('master.back-login')

@section('content')
<div class="auth-card">
    <div class="auth-header">
        <div class="brand-badge">
            <i class="fa-solid fa-shield-halved"></i>
        </div>
        <h2>Maan<span class="gradient-text">sa</span> Admin</h2>
        <p>{{ __('Sign in to access your administrative dashboard') }}</p>
    </div>

    @include('alerts.alerts')

    <form action="{{ route('back.login.submit') }}" method="POST" id="adminLoginForm">
        @csrf

        <div class="auth-form-group">
            <label for="login_email">{{ __('Email Address') }}</label>
            <div class="auth-input-wrapper">
                <i class="fa-regular fa-envelope input-icon"></i>
                <input id="login_email" name="login_email" type="email" value="{{ old('login_email') }}" placeholder="admin@gmail.com" required autocomplete="email" autofocus>
            </div>
        </div>

        <div class="auth-form-group">
            <label for="login_password">{{ __('Password') }}</label>
            <div class="auth-input-wrapper">
                <i class="fa-solid fa-lock input-icon"></i>
                <input id="login_password" name="login_password" type="password" placeholder="••••••••" required autocomplete="current-password">
                <button type="button" class="toggle-password-btn" id="togglePasswordBtn" title="Toggle password visibility" tabindex="-1">
                    <i class="fa-regular fa-eye" id="togglePasswordIcon"></i>
                </button>
            </div>
        </div>

        <div class="auth-options">
            <label class="auth-remember" for="remember">
                <input type="checkbox" name="remember" id="remember">
                <span>{{ __('Remember Me') }}</span>
            </label>
            <a href="{{ route('back.forgot') }}" class="auth-forgot-link">{{ __('Forgot Password?') }}</a>
        </div>

        <button type="submit" class="btn-auth-submit">
            <span>{{ __('Sign In to Dashboard') }}</span>
            <i class="fa-solid fa-arrow-right"></i>
        </button>

        <div class="demo-credentials-box">
            <div class="demo-credentials-info">
                <strong>Default Credentials:</strong><br>
                <span>admin@gmail.com &bull; password</span>
            </div>
            <button type="button" class="btn-fill-demo" id="fillDemoBtn">
                <i class="fa-solid fa-wand-magic-sparkles"></i> Auto Fill
            </button>
        </div>
    </form>
</div>
@endsection

@section('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Password toggle
        const toggleBtn = document.getElementById('togglePasswordBtn');
        const passwordInput = document.getElementById('login_password');
        const toggleIcon = document.getElementById('togglePasswordIcon');

        if (toggleBtn && passwordInput && toggleIcon) {
            toggleBtn.addEventListener('click', function() {
                const isPassword = passwordInput.type === 'password';
                passwordInput.type = isPassword ? 'text' : 'password';
                toggleIcon.className = isPassword ? 'fa-regular fa-eye-slash' : 'fa-regular fa-eye';
            });
        }

        // Demo credentials auto-fill
        const fillDemoBtn = document.getElementById('fillDemoBtn');
        const emailInput = document.getElementById('login_email');

        if (fillDemoBtn && emailInput && passwordInput) {
            fillDemoBtn.addEventListener('click', function() {
                emailInput.value = 'admin@gmail.com';
                passwordInput.value = 'password';
                emailInput.focus();
            });
        }
    });
</script>
@endsection
