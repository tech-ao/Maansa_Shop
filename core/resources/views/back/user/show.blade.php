@extends('master.back')

@section('content')

<div class="container-fluid">

    <!-- Page Header Banner -->
    <div class="dash-hero-banner mb-4">
        <div class="dash-hero-content">
            <div class="dash-hero-text">
                <h2><i class="fa-solid fa-user-gear mr-2" style="font-size: 22px;"></i> {{ $user->first_name }} {{ $user->last_name }}</h2>
                <p>{{ __('Customer Account Profile & Information Management') }} &bull; <span class="text-white">{{ $user->email }}</span></p>
            </div>
            <div class="dash-hero-actions">
                <a class="btn btn-hero-action btn-hero-primary" href="{{ route('back.user.index') }}" style="font-size: 13.5px; font-weight: 700; padding: 10px 20px;">
                    <i class="fa-solid fa-chevron-left mr-1"></i> {{ __('Back to Customers') }}
                </a>
            </div>
        </div>
    </div>

    <!-- Quick Stat Badges -->
    <div class="row mb-4">
        <div class="col-md-6 mb-3 mb-md-0">
            <div class="feature-toggle-card" style="margin-bottom: 0;">
                <div class="d-flex align-items-center" style="gap: 16px;">
                    <div class="ticket-user-avatar" style="width: 48px; height: 48px; background: #e0f2fe; color: #0284c7; font-size: 20px;">
                        <i class="fa-solid fa-bag-shopping"></i>
                    </div>
                    <div>
                        <h6 style="font-size: 13px; color: #64748b; margin-bottom: 2px;">{{ __('Total Lifetime Orders') }}</h6>
                        <span style="font-size: 22px; font-weight: 800; color: #0f172a;">{{ count($user->orders) }}</span>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-6">
            <div class="feature-toggle-card" style="margin-bottom: 0;">
                <div class="d-flex align-items-center" style="gap: 16px;">
                    <div class="ticket-user-avatar" style="width: 48px; height: 48px; background: #fef3c7; color: #d97706; font-size: 20px;">
                        <i class="fa-solid fa-calendar-check"></i>
                    </div>
                    <div>
                        <h6 style="font-size: 13px; color: #64748b; margin-bottom: 2px;">{{ __('Registration Date') }}</h6>
                        <span style="font-size: 16px; font-weight: 800; color: #0f172a;">{{ $user->created_at ? $user->created_at->format('M d, Y') . ' (' . $user->created_at->diffForHumans() . ')' : __('N/A') }}</span>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Profile Edit Form -->
    <div class="row">
        <div class="col-lg-12">
            <div class="card-modern">
                <div class="card-modern-body">
                    <form action="{{ route('back.user.update', $user->id) }}" method="POST">
                        @csrf
                        @method('PUT')
                        @include('alerts.alerts')
                        <input type="hidden" name="user_id" value="{{ $user->id }}">

                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="first_name" class="form-label font-weight-bold">{{ __('First Name') }} *</label>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="fa-solid fa-user"></i></span>
                                    </div>
                                    <input type="text" name="first_name" class="form-control" id="first_name" value="{{ $user->first_name }}" required>
                                </div>
                            </div>

                            <div class="col-md-6 mb-3">
                                <label for="last_name" class="form-label font-weight-bold">{{ __('Last Name') }} *</label>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="fa-solid fa-user"></i></span>
                                    </div>
                                    <input type="text" name="last_name" class="form-control" id="last_name" value="{{ $user->last_name }}" required>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="email" class="form-label font-weight-bold">{{ __('Email Address') }} *</label>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="fa-solid fa-envelope"></i></span>
                                    </div>
                                    <input type="email" name="email" class="form-control" id="email" value="{{ $user->email }}" required>
                                </div>
                            </div>

                            <div class="col-md-6 mb-3">
                                <label for="phone" class="form-label font-weight-bold">{{ __('Phone Number') }}</label>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="fa-solid fa-phone"></i></span>
                                    </div>
                                    <input type="text" name="phone" class="form-control" id="phone" value="{{ $user->phone }}" placeholder="{{ __('e.g. +1 234 567 8900') }}">
                                </div>
                            </div>
                        </div>

                        <div class="form-group mb-4">
                            <label for="password" class="form-label font-weight-bold">{{ __('New Password (Leave blank to keep unchanged)') }}</label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="fa-solid fa-lock"></i></span>
                                </div>
                                <input type="password" name="password" class="form-control" id="password" placeholder="{{ __('Enter new password if updating') }}">
                            </div>
                        </div>

                        <div class="d-flex justify-content-end gap-2">
                            <a href="{{ route('back.user.index') }}" class="btn btn-secondary px-4 mr-2" style="border-radius: 10px; font-weight: 700;">{{ __('Cancel') }}</a>
                            <button type="submit" class="btn btn-primary px-4" style="border-radius: 10px; font-weight: 700; background: linear-gradient(135deg, #10b981, #059669); border: none; box-shadow: 0 4px 12px rgba(16, 185, 129, 0.3);">
                                <i class="fa-solid fa-floppy-disk mr-1"></i> {{ __('Save Customer Changes') }}
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
