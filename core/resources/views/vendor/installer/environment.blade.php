@extends('vendor.installer.layouts.master')

@section('template_title')
    Environment Configuration
@endsection

@section('container')
    <div class="page-title-box">
        <h2><i class="fa-solid fa-database"></i> Environment Configuration</h2>
        <p>Choose how you want to configure your database connection, application URL, and environment parameters.</p>
    </div>

    <div class="env-choice-grid">
        <a href="{{ route('LaravelInstaller::environmentWizard') }}" class="env-choice-card">
            <div class="env-choice-icon" style="background: var(--primary-light); color: var(--primary);">
                <i class="fa-solid fa-sliders"></i>
            </div>
            <h3>Form Wizard</h3>
            <p>Guided step-by-step graphical form to input database and application settings with instant connection testing.</p>
            <span class="env-choice-btn">
                <span>Configure with Wizard</span>
                <i class="fa-solid fa-arrow-right"></i>
            </span>
        </a>

        <a href="{{ route('LaravelInstaller::environmentClassic') }}" class="env-choice-card">
            <div class="env-choice-icon" style="background: var(--secondary-light); color: var(--secondary);">
                <i class="fa-solid fa-code"></i>
            </div>
            <h3>Classic / Manual Editor</h3>
            <p>Direct raw text editor to customize your <code>.env</code> file directly. Best for advanced setups & power users.</p>
            <span class="env-choice-btn" style="background: var(--secondary);">
                <span>Edit .env Manually</span>
                <i class="fa-solid fa-arrow-right"></i>
            </span>
        </a>
    </div>

    <div class="buttons-group">
        <a href="{{ route('LaravelInstaller::permissions') }}" class="btn btn-secondary">
            <i class="fa-solid fa-arrow-left"></i>
            <span>Back to Permissions</span>
        </a>
    </div>
@endsection
