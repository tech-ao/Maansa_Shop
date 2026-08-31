@extends('master.back')

@section('content')

<div class="container-fluid">

    <!-- Page Header Banner -->
    <div class="dash-hero-banner mb-4">
        <div class="dash-hero-content">
            <div class="dash-hero-text">
                <h2><i class="fa-solid fa-plus-circle mr-2" style="font-size: 22px;"></i> {{ __('Create FAQ Question') }}</h2>
                <p>{{ __('Add a new frequently asked question and detailed resolution for your storefront help center.') }}</p>
                <ul class="profile-breadcrumb mt-2">
                    <li><a href="{{ route('back.dashboard') }}"><i class="fa-solid fa-house"></i> {{ __('Dashboard') }}</a></li>
                    <span class="divider">/</span>
                    <li><a href="{{ route('back.faq.index') }}">{{ __('FAQs') }}</a></li>
                    <span class="divider">/</span>
                    <li class="active">{{ __('Create') }}</li>
                </ul>
            </div>
            <div class="dash-hero-actions mt-2 mt-sm-0">
                <a class="btn btn-hero-action" href="{{ route('back.faq.index') }}" style="font-size: 13px; font-weight: 600; padding: 9px 16px; background: rgba(255,255,255,0.15); color: #ffffff; border: 1px solid rgba(255,255,255,0.25);">
                    <i class="fa-solid fa-arrow-left mr-1"></i> {{ __('Back to FAQs') }}
                </a>
            </div>
        </div>
    </div>

    @include('alerts.alerts')

    <!-- Form Container -->
    <div class="row justify-content-center">
        <div class="col-xl-8 col-lg-10 col-12 mb-4">
            <div class="card-modern">
                <div class="card-modern-body p-4">
                    <form class="admin-form" action="{{ route('back.faq.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf

                        <div class="settings-section-card mb-4">
                            <div class="section-card-title">
                                <i class="fa-solid fa-circle-question text-primary"></i> {{ __('Question Details') }}
                            </div>

                            <div class="form-group mb-3">
                                <label for="title" class="form-label font-weight-bold">{{ __('Question Title') }} *</label>
                                <input type="text" name="title" class="form-control" id="title" placeholder="{{ __('e.g. How can I track my order?') }}" value="{{ old('title') }}" required>
                            </div>

                            <div class="form-group mb-3">
                                <label for="category_id" class="form-label font-weight-bold">{{ __('Select Category') }} *</label>
                                <select name="category_id" id="category_id" class="form-control" required>
                                    <option value="" selected disabled>{{ __('Select Category') }}</option>
                                    @foreach(DB::table('fcategories')->whereStatus(1)->get() as $category)
                                        <option value="{{ $category->id }}">{{ $category->name }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="form-group mb-0">
                                <label for="details" class="form-label font-weight-bold">{{ __('Answer / Details') }} *</label>
                                <textarea name="details" id="details" class="form-control" rows="6" placeholder="{{ __('Provide a clear, detailed answer or instructions...') }}" required>{{ old('details') }}</textarea>
                            </div>
                        </div>

                        <div class="d-flex justify-content-end mt-4 pt-3 border-top">
                            <button type="submit" class="btn btn-primary px-4 py-2" style="border-radius: 10px; font-weight: 700; background: linear-gradient(135deg, #10b981, #059669); border: none; box-shadow: 0 4px 12px rgba(16, 185, 129, 0.3);">
                                <i class="fa-solid fa-floppy-disk mr-1"></i> {{ __('Save FAQ') }}
                            </button>
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </div>

</div>

@endsection
