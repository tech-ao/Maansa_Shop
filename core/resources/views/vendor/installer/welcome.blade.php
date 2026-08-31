@extends('vendor.installer.layouts.master')

@section('template_title')
    Welcome
@endsection

@section('container')
    <div class="page-title-box">
        <h2><i class="fa-solid fa-hand-wave"></i> Welcome to Maansa</h2>
        <p>Follow the guided steps below to easily install, configure, and launch your online eCommerce marketplace.</p>
    </div>

    <div class="features-grid">
        <div class="feature-box">
            <div class="feat-icon feat-blue">
                <i class="fa-solid fa-shield-halved"></i>
            </div>
            <h4>System Check</h4>
            <p>Automatic verification of server compatibility & extensions.</p>
        </div>
        <div class="feature-box">
            <div class="feat-icon feat-cyan">
                <i class="fa-solid fa-database"></i>
            </div>
            <h4>Auto Database</h4>
            <p>Quick setup with sample products, categories, and settings.</p>
        </div>
        <div class="feature-box">
            <div class="feat-icon feat-green">
                <i class="fa-solid fa-bolt"></i>
            </div>
            <h4>Ready in 2 Mins</h4>
            <p>Instant activation to launch your admin panel and storefront.</p>
        </div>
    </div>

    <div class="alert alert-warning" style="margin-top: 10px;">
        <i class="fa-solid fa-circle-info" style="font-size: 18px; margin-top: 2px;"></i>
        <div>
            <strong>Before you begin:</strong> Ensure you have your MySQL database details (host, username, password, database name) ready.
        </div>
    </div>

    <div class="buttons-right">
        <a href="{{ route('LaravelInstaller::requirements') }}" class="btn btn-primary">
            <span>Check Requirements</span>
            <i class="fa-solid fa-arrow-right"></i>
        </a>
    </div>
@endsection
