@extends('vendor.installer.layouts.master')

@section('template_title')
    Folder Permissions
@endsection

@section('container')
    <div class="page-title-box">
        <h2><i class="fa-solid fa-folder-open"></i> Folder Permissions</h2>
        <p>Please ensure that the following system directories have write permissions (775/777) so files and cache can be saved.</p>
    </div>

    <div class="req-group">
        <div class="req-header">
            <div><i class="fa-solid fa-shield-halved" style="margin-right: 6px;"></i> Required Directory Permissions</div>
            <span style="font-size: 12px; font-weight: 500; color: var(--text-muted);">Recommended: 775</span>
        </div>

        <ul class="req-list" style="grid-template-columns: 1fr;">
            @foreach($permissions['permissions'] as $permission)
                @php
                    $folderName = $permission['folder'];
                    if ($folderName == '../assets/images/') $folderName = 'assets/images/';
                    elseif ($folderName == '../assets/sitemaps/') $folderName = 'assets/sitemaps/';
                    elseif ($folderName == '../assets/files/') $folderName = 'assets/files/';
                @endphp
                <li class="req-item {{ $permission['isSet'] ? 'success' : 'error' }}">
                    <div style="display: flex; align-items: center; gap: 8px;">
                        <i class="fa-regular fa-folder" style="color: var(--primary);"></i>
                        <code>{{ $folderName }}</code>
                    </div>
                    <span class="badge-status {{ $permission['isSet'] ? 'success' : 'error' }}">
                        <i class="fa-solid {{ $permission['isSet'] ? 'fa-check' : 'fa-xmark' }}"></i>
                        {{ $permission['permission'] }} ({{ $permission['isSet'] ? 'Writable' : 'Not Writable' }})
                    </span>
                </li>
            @endforeach
        </ul>
    </div>

    <div class="buttons-group">
        <a href="{{ route('LaravelInstaller::requirements') }}" class="btn btn-secondary">
            <i class="fa-solid fa-arrow-left"></i>
            <span>Back</span>
        </a>

        @if ( ! isset($permissions['errors']))
            <a href="{{ route('LaravelInstaller::environment') }}" class="btn btn-primary">
                <span>Configure Environment</span>
                <i class="fa-solid fa-arrow-right"></i>
            </a>
        @else
            <button class="btn btn-secondary" disabled style="opacity: 0.6; cursor: not-allowed;">
                <span>Fix Permissions to Proceed</span>
            </button>
        @endif
    </div>
@endsection
