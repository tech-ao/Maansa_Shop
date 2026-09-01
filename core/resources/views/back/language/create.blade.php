@extends('master.back')

@section('content')

<div class="container-fluid">

    <!-- Page Header Banner -->
    <div class="dash-hero-banner mb-4">
        <div class="dash-hero-content">
            <div class="dash-hero-text">
                <h2><i class="fa-solid fa-plus-circle mr-2" style="font-size: 22px;"></i> {{ __('Add New Language') }}</h2>
                <p>{{ __('Create a new language translation package cloned from your primary dictionary.') }}</p>
                <ul class="profile-breadcrumb mt-2">
                    <li><a href="{{ route('back.dashboard') }}"><i class="fa-solid fa-house"></i> {{ __('Dashboard') }}</a></li>
                    <span class="divider">/</span>
                    <li><a href="{{ route('back.language.index') }}">{{ __('Languages') }}</a></li>
                    <span class="divider">/</span>
                    <li class="active">{{ __('Create') }}</li>
                </ul>
            </div>
            <div class="dash-hero-actions mt-2 mt-sm-0">
                <a class="btn btn-hero-action" href="{{ route('back.language.index') }}" style="font-size: 13px; font-weight: 600; padding: 9px 16px; background: rgba(255,255,255,0.15); color: #ffffff; border: 1px solid rgba(255,255,255,0.25);">
                    <i class="fa-solid fa-arrow-left mr-1"></i> {{ __('Back to Languages') }}
                </a>
            </div>
        </div>
    </div>

    <!-- Form Container -->
    <div class="row justify-content-center">
        <div class="col-xl-6 col-lg-8 col-12 mb-4">
            <div class="card-modern">
                <div class="card-modern-body p-4">
                    <div class="settings-tab-pane-title mb-4 pb-3 border-bottom d-flex align-items-center justify-content-between">
                        <div>
                            <i class="fa-solid fa-earth-americas text-primary mr-1"></i> {{ __('Language Information') }}
                        </div>
                        <span class="badge" style="background: #ecfdf5; color: #065f46; border: 1px solid #a7f3d0; font-size: 12px; font-weight: 600; padding: 5px 12px; border-radius: 999px;">
                            <i class="fa-solid fa-globe mr-1"></i> {{ __('Storefront') }}
                        </span>
                    </div>

                    @include('alerts.alerts')

                    <form class="geniusform" action="{{ route('back.language.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf

                        <div class="settings-section-card mb-4">
                            <div class="form-group mb-0">
                                <label for="language_name" class="form-label font-weight-bold">{{ __('Language Display Name') }} *</label>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="fa-solid fa-language"></i></span>
                                    </div>
                                    <input type="text" class="form-control" name="language" id="language_name" placeholder="{{ __('e.g. Spanish, French, German, Japanese') }}" value="{{ old('language') }}" required>
                                </div>
                                <small class="text-muted mt-2 d-block" style="font-size: 12.5px;">
                                    <i class="fa-solid fa-circle-info text-primary mr-1"></i> {{ __('A new JSON translation dictionary will be created automatically. You can translate strings and customize phrases right after adding.') }}
                                </small>
                            </div>
                        </div>

                        <div class="d-flex justify-content-end mt-4">
                            <button type="submit" class="btn btn-primary px-4 py-2" style="border-radius: 10px; font-weight: 700; background: linear-gradient(135deg, #10b981, #059669); border: none; box-shadow: 0 4px 12px rgba(16, 185, 129, 0.3);">
                                <i class="fa-solid fa-floppy-disk mr-1"></i> {{ __('Create Language') }}
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

</div>

@endsection
