@extends('master.back')

@section('content')

<div class="container-fluid">

    <!-- Page Header Banner -->
    <div class="dash-hero-banner mb-4">
        <div class="dash-hero-content">
            <div class="dash-hero-text">
                <h2><i class="fa-solid fa-paper-plane mr-2" style="font-size: 22px;"></i> {{ __('Broadcast Email Campaign') }}</h2>
                <p>{{ __('Compose and send announcements, promotions, or newsletter updates to all active subscribers.') }}</p>
            </div>
            <div class="dash-hero-actions">
                <a class="btn btn-hero-action btn-hero-primary" href="{{ route('back.subscribers.index') }}" style="font-size: 13.5px; font-weight: 700; padding: 10px 20px;">
                    <i class="fa-solid fa-chevron-left mr-1"></i> {{ __('Back to Subscribers') }}
                </a>
            </div>
        </div>
    </div>

    <!-- Form Card -->
    <div class="row">
        <div class="col-lg-12">
            <div class="card-modern">
                <div class="card-modern-body">
                    <form class="admin-form" action="{{ route('back.subscribers.mail.submit') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @include('alerts.alerts')

                        <div class="feature-toggle-card mb-4" style="background: #eef2ff; border: 1px solid #c7d2fe; border-radius: 14px; padding: 16px 20px;">
                            <div class="d-flex align-items-center" style="gap: 12px;">
                                <i class="fa-solid fa-circle-info text-primary" style="font-size: 18px;"></i>
                                <span style="font-size: 13.5px; color: #3730a3; font-weight: 600;">
                                    {{ __('This broadcast message will be automatically delivered to all users currently subscribed to your store newsletter.') }}
                                </span>
                            </div>
                        </div>

                        <div class="form-group mb-3">
                            <label for="subject" class="form-label font-weight-bold">{{ __('Campaign Subject') }} *</label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text bg-light"><i class="fa-solid fa-heading text-muted"></i></span>
                                </div>
                                <input type="text" name="subject" class="form-control" id="subject" placeholder="{{ __('e.g. Exclusive Weekend Sale & Store Updates!') }}" value="" required>
                            </div>
                        </div>

                        <div class="form-group mb-4">
                            <label for="details" class="form-label font-weight-bold">{{ __('Email Message / Content') }} *</label>
                            <textarea name="details" id="details" class="form-control text-editor" rows="8" placeholder="{{ __('Write your newsletter campaign message here...') }}" required></textarea>
                        </div>

                        <div class="d-flex justify-content-end gap-2">
                            <a href="{{ route('back.subscribers.index') }}" class="btn btn-secondary px-4 mr-2" style="border-radius: 10px; font-weight: 700;">{{ __('Cancel') }}</a>
                            <button type="submit" class="btn btn-primary px-4" style="border-radius: 10px; font-weight: 700; background: linear-gradient(135deg, #4f46e5, #3b82f6); border: none; box-shadow: 0 4px 12px rgba(79, 70, 229, 0.3);">
                                <i class="fa-solid fa-paper-plane mr-1"></i> {{ __('Send Broadcast Email') }}
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
