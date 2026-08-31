@extends('vendor.installer.layouts.master')

@section('template_title')
    Classic .env Editor
@endsection

@section('container')
    <div class="page-title-box">
        <h2><i class="fa-solid fa-code"></i> Classic (.env) Manual Editor</h2>
        <p>Edit your application environment variables directly. Make sure your MySQL database credentials (<code>DB_DATABASE</code>, <code>DB_USERNAME</code>, <code>DB_PASSWORD</code>) are accurate.</p>
    </div>

    <form method="post" action="{{ route('LaravelInstaller::environmentSaveClassic') }}">
        {!! csrf_field() !!}
        
        <div class="editor-container">
            <div class="editor-header">
                <div class="editor-dots">
                    <span class="dot-red"></span>
                    <span class="dot-yellow"></span>
                    <span class="dot-green"></span>
                </div>
                <span><i class="fa-regular fa-file-code"></i> .env</span>
                <span>UTF-8</span>
            </div>
            <textarea class="textarea env-editor" name="envConfig" spellcheck="false">{{ $envConfig }}</textarea>
        </div>

        <div style="display: flex; justify-content: flex-end; margin-bottom: 20px;">
            <button class="btn btn-secondary" type="submit">
                <i class="fa-solid fa-floppy-disk"></i>
                <span>Save .env Changes</span>
            </button>
        </div>
    </form>

    <div class="buttons-group">
        <a class="btn btn-secondary" href="{{ route('LaravelInstaller::environment') }}">
            <i class="fa-solid fa-arrow-left"></i>
            <span>Back to Methods</span>
        </a>

        @if( ! isset($environment['errors']))
            <a class="btn btn-success" href="{{ route('LaravelInstaller::database') }}">
                <i class="fa-solid fa-circle-check"></i>
                <span>Install Database & Tables</span>
                <i class="fa-solid fa-arrow-right"></i>
            </a>
        @endif
    </div>
@endsection
