@extends('vendor.installer.layouts.master')

@section('template_title')
    Environment Wizard
@endsection

@section('container')
    <div class="page-title-box">
        <h2><i class="fa-solid fa-sliders"></i> Environment Wizard</h2>
        <p>Fill in your basic application configuration and MySQL database credentials below.</p>
    </div>

    <form method="post" action="{{ route('LaravelInstaller::environmentSaveWizard') }}">
        <input type="hidden" name="_token" value="{{ csrf_token() }}">

        <h3 style="font-size: 15px; font-weight: 700; color: var(--text-dark); margin-bottom: 14px; display: flex; align-items: center; gap: 8px;">
            <i class="fa-solid fa-globe" style="color: var(--primary);"></i> 1. Application Settings
        </h3>

        <div class="form-grid">
            <div class="form-group {{ $errors->has('app_name') ? ' has-error ' : '' }}">
                <label for="app_name">App Name</label>
                <div class="input-wrapper">
                    <i class="fa-solid fa-tag"></i>
                    <input type="text" name="app_name" id="app_name" value="{{ old('app_name', 'Maansa') }}" placeholder="Maansa" required />
                </div>
                @if ($errors->has('app_name'))
                    <span class="error-block">
                        <i class="fa-solid fa-triangle-exclamation"></i>
                        {{ $errors->first('app_name') }}
                    </span>
                @endif
            </div>

            <div class="form-group {{ $errors->has('app_url') ? ' has-error ' : '' }}">
                <label for="app_url">App URL</label>
                <div class="input-wrapper">
                    <i class="fa-solid fa-link"></i>
                    <input type="url" name="app_url" id="app_url" value="{{ old('app_url', 'http://127.0.0.1:8000') }}" placeholder="http://127.0.0.1:8000" required />
                </div>
                @if ($errors->has('app_url'))
                    <span class="error-block">
                        <i class="fa-solid fa-triangle-exclamation"></i>
                        {{ $errors->first('app_url') }}
                    </span>
                @endif
            </div>

            <div class="form-group full-width {{ $errors->has('app_debug') ? ' has-error ' : '' }}">
                <label>Debug Mode</label>
                <div class="radio-group">
                    <label class="radio-label" for="app_debug_false">
                        <input type="radio" name="app_debug" id="app_debug_false" value="false" checked />
                        <span>False (Production / Recommended)</span>
                    </label>
                    <label class="radio-label" for="app_debug_true">
                        <input type="radio" name="app_debug" id="app_debug_true" value="true" />
                        <span>True (Development Only)</span>
                    </label>
                </div>
                @if ($errors->has('app_debug'))
                    <span class="error-block">
                        <i class="fa-solid fa-triangle-exclamation"></i>
                        {{ $errors->first('app_debug') }}
                    </span>
                @endif
            </div>
        </div>

        <h3 style="font-size: 15px; font-weight: 700; color: var(--text-dark); margin: 24px 0 14px; display: flex; align-items: center; gap: 8px;">
            <i class="fa-solid fa-database" style="color: var(--secondary);"></i> 2. MySQL Database Settings
        </h3>

        <div class="form-grid">
            <div class="form-group {{ $errors->has('database_hostname') ? ' has-error ' : '' }}">
                <label for="database_hostname">Database Host</label>
                <div class="input-wrapper">
                    <i class="fa-solid fa-server"></i>
                    <input type="text" name="database_hostname" id="database_hostname" value="{{ old('database_hostname', '127.0.0.1') }}" placeholder="127.0.0.1" required />
                </div>
                @if ($errors->has('database_hostname'))
                    <span class="error-block">
                        <i class="fa-solid fa-triangle-exclamation"></i>
                        {{ $errors->first('database_hostname') }}
                    </span>
                @endif
            </div>

            <div class="form-group {{ $errors->has('database_name') ? ' has-error ' : '' }}">
                <label for="database_name">Database Name</label>
                <div class="input-wrapper">
                    <i class="fa-solid fa-table"></i>
                    <input type="text" name="database_name" id="database_name" value="{{ old('database_name', 'maansa') }}" placeholder="maansa" required />
                </div>
                @if ($errors->has('database_name'))
                    <span class="error-block">
                        <i class="fa-solid fa-triangle-exclamation"></i>
                        {{ $errors->first('database_name') }}
                    </span>
                @endif
            </div>

            <div class="form-group {{ $errors->has('database_username') ? ' has-error ' : '' }}">
                <label for="database_username">Database User</label>
                <div class="input-wrapper">
                    <i class="fa-regular fa-user"></i>
                    <input type="text" name="database_username" id="database_username" value="{{ old('database_username', 'root') }}" placeholder="root" required />
                </div>
                @if ($errors->has('database_username'))
                    <span class="error-block">
                        <i class="fa-solid fa-triangle-exclamation"></i>
                        {{ $errors->first('database_username') }}
                    </span>
                @endif
            </div>

            <div class="form-group {{ $errors->has('database_password') ? ' has-error ' : '' }}">
                <label for="database_password">Database Password</label>
                <div class="input-wrapper">
                    <i class="fa-solid fa-lock"></i>
                    <input type="password" name="database_password" id="database_password" value="{{ old('database_password') }}" placeholder="Leave blank if no password" />
                </div>
                @if ($errors->has('database_password'))
                    <span class="error-block">
                        <i class="fa-solid fa-triangle-exclamation"></i>
                        {{ $errors->first('database_password') }}
                    </span>
                @endif
            </div>
        </div>

        <div class="buttons-group">
            <a href="{{ route('LaravelInstaller::environment') }}" class="btn btn-secondary">
                <i class="fa-solid fa-arrow-left"></i>
                <span>Back</span>
            </a>

            <button class="btn btn-success" type="submit">
                <i class="fa-solid fa-circle-check"></i>
                <span>Save & Install Database</span>
                <i class="fa-solid fa-arrow-right"></i>
            </button>
        </div>
    </form>
@endsection
