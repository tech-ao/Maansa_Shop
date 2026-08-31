@extends('vendor.installer.layouts.master')

@section('template_title')
    Installation Complete
@endsection

@section('container')
    <div class="finished-hero">
        <div class="finished-icon-badge">
            <i class="fa-solid fa-check"></i>
        </div>
        <h3>Maansa Installed Successfully!</h3>
        <p>Congratulations! Your eCommerce application has been configured and the database has been imported and initialized.</p>
    </div>

    <div class="req-group" style="margin-bottom: 24px;">
        <div class="req-header">
            <div><i class="fa-solid fa-terminal" style="margin-right: 6px;"></i> Installation Summary</div>
            <span class="badge-status success"><i class="fa-solid fa-check"></i> Completed</span>
        </div>
        <div style="padding: 16px; background: #ffffff;">
            @if(isset($finalStatusMessage))
                <div class="alert alert-success" style="margin-bottom: 12px;">
                    <i class="fa-solid fa-circle-check"></i>
                    <div>{{ $finalStatusMessage }}</div>
                </div>
            @endif

            <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 14px; margin-top: 10px;">
                <div class="feature-box" style="margin: 0; background: #f8fafc;">
                    <h4 style="color: var(--primary);"><i class="fa-solid fa-user-shield"></i> Admin Panel</h4>
                    <p style="margin-top: 4px;">Default admin credentials available in the documentation.</p>
                    <a href="{{ url('/admin/login') }}" class="btn btn-primary" style="margin-top: 12px; font-size: 12px; padding: 8px 16px;">
                        <span>Admin Login</span>
                        <i class="fa-solid fa-arrow-right"></i>
                    </a>
                </div>
                <div class="feature-box" style="margin: 0; background: #f8fafc;">
                    <h4 style="color: var(--secondary);"><i class="fa-solid fa-store"></i> Storefront</h4>
                    <p style="margin-top: 4px;">Explore your live eCommerce catalog and customer experience.</p>
                    <a href="{{ url('/') }}" class="btn btn-secondary" style="margin-top: 12px; font-size: 12px; padding: 8px 16px;">
                        <span>Visit Store</span>
                        <i class="fa-solid fa-arrow-right"></i>
                    </a>
                </div>
            </div>
        </div>
    </div>

    <div class="buttons-right">
        <a href="{{ url('/') }}" class="btn btn-primary">
            <i class="fa-solid fa-house"></i>
            <span>Go to Homepage</span>
        </a>
    </div>
@endsection
