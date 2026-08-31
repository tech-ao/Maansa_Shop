@extends('vendor.installer.layouts.master')

@section('template_title')
    Server Requirements
@endsection

@section('container')
    <div class="page-title-box">
        <h2><i class="fa-solid fa-server"></i> Server Requirements</h2>
        <p>Maansa requires PHP {{ $phpSupportInfo['minimum'] }}+ and key extensions for database, payment gateways, and cryptography.</p>
    </div>

    @foreach($requirements['requirements'] as $type => $requirement)
        <div class="req-group">
            <div class="req-header">
                <div>
                    <i class="fa-brands fa-php" style="margin-right: 6px;"></i>
                    {{ ucfirst($type) }} Requirements
                    @if($type == 'php')
                        <span style="font-weight: 500; font-size: 12px; color: var(--text-muted); margin-left: 6px;">
                            (Min: PHP {{ $phpSupportInfo['minimum'] }})
                        </span>
                    @endif
                </div>
                @if($type == 'php')
                    <span class="badge-status {{ $phpSupportInfo['supported'] ? 'success' : 'error' }}">
                        <i class="fa-solid {{ $phpSupportInfo['supported'] ? 'fa-circle-check' : 'fa-circle-xmark' }}"></i>
                        Current: PHP {{ $phpSupportInfo['current'] }}
                    </span>
                @endif
            </div>

            <ul class="req-list">
                @foreach($requirements['requirements'][$type] as $extention => $enabled)
                    <li class="req-item {{ $enabled ? 'success' : 'error' }}">
                        <span><strong>{{ $extention }}</strong> extension</span>
                        <span class="badge-status {{ $enabled ? 'success' : 'error' }}">
                            <i class="fa-solid {{ $enabled ? 'fa-check' : 'fa-xmark' }}"></i>
                            {{ $enabled ? 'Enabled' : 'Missing' }}
                        </span>
                    </li>
                @endforeach
            </ul>
        </div>
    @endforeach

    <div class="buttons-group">
        <a href="{{ route('LaravelInstaller::welcome') }}" class="btn btn-secondary">
            <i class="fa-solid fa-arrow-left"></i>
            <span>Back</span>
        </a>

        @if ( ! isset($requirements['errors']) && $phpSupportInfo['supported'] )
            <a class="btn btn-primary" href="{{ route('LaravelInstaller::permissions') }}">
                <span>Check Permissions</span>
                <i class="fa-solid fa-arrow-right"></i>
            </a>
        @else
            <button class="btn btn-secondary" disabled style="opacity: 0.6; cursor: not-allowed;">
                <span>Fix Requirements to Proceed</span>
            </button>
        @endif
    </div>
@endsection
