@extends('master.back')

@section('content')

<div class="container-fluid">

	<!-- Page Header Banner -->
    <div class="dash-hero-banner mb-4">
        <div class="dash-hero-content">
            <div class="dash-hero-text">
                <h2><i class="fa-solid fa-ticket-simple mr-2" style="font-size: 22px;"></i> {{ __('Create Discount Coupon') }}</h2>
                <p>{{ __('Configure discount rules, promotional code name, usage quotas, and monetary reductions.') }}</p>
            </div>
            <div class="dash-hero-actions">
                <a class="btn btn-hero-action btn-hero-primary" href="{{ route('back.code.index') }}" style="font-size: 13.5px; font-weight: 700; padding: 10px 20px;">
                    <i class="fa-solid fa-arrow-left mr-1"></i> {{ __('Back to Coupons') }}
                </a>
            </div>
        </div>
    </div>

	<!-- Form Card -->
	<div class="row justify-content-center">
		<div class="col-lg-8 col-md-10">
			<div class="card-modern">
				<div class="card-modern-body">
					@include('alerts.alerts')

                    <div class="d-flex align-items-center mb-4 pb-3 border-bottom">
                        <div class="d-inline-flex align-items-center justify-content-center bg-primary-light rounded-circle mr-3" style="width: 44px; height: 44px; background: #f0fdf4; color: #059669; font-size: 18px;">
                            <i class="fa-solid fa-plus"></i>
                        </div>
                        <div>
                            <h5 class="font-weight-bold text-dark mb-0">{{ __('New Coupon Information') }}</h5>
                            <p class="text-muted small mb-0">{{ __('Fill in the discount details to generate a promotional code') }}</p>
                        </div>
                    </div>

                    <form class="admin-form" action="{{ route('back.code.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf

                        <div class="form-group mb-3">
                            <label for="title" class="form-label font-weight-bold text-dark">{{ __('Coupon Title') }} *</label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text bg-light"><i class="fa-solid fa-heading text-muted"></i></span>
                                </div>
                                <input type="text" name="title" class="form-control" id="title"
                                    placeholder="{{ __('e.g., Summer Flash Sale, Halloween Special') }}" value="{{ old('title') }}" required>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <div class="col-md-6 mb-3 mb-md-0">
                                <label for="code" class="form-label font-weight-bold text-dark">{{ __('Promo Code') }} *</label>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text bg-light"><i class="fa-solid fa-ticket text-muted"></i></span>
                                    </div>
                                    <input type="text" name="code_name" class="form-control" id="code"
                                        placeholder="{{ __('e.g., SUMMER50, SAVE20') }}" value="{{ old('code_name') }}" required style="font-family: monospace; font-weight: 700; text-transform: uppercase;">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <label for="no_of_times" class="form-label font-weight-bold text-dark">{{ __('Usage Limit (Number Of Times)') }} *</label>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text bg-light"><i class="fa-solid fa-users text-muted"></i></span>
                                    </div>
                                    <input type="number" name="no_of_times" class="form-control" id="no_of_times"
                                        placeholder="{{ __('e.g., 100') }}" value="{{ old('no_of_times', 100) }}" min="1" required>
                                </div>
                            </div>
                        </div>

                        <div class="form-group mb-4">
                            <label for="discount" class="form-label font-weight-bold text-dark">{{ __('Discount Type & Value') }} *</label>
                            <div class="input-group">
                                <div class="input-group-prepend" style="width: 40%;">
                                    <select name="type" class="form-control" style="border-top-right-radius: 0; border-bottom-right-radius: 0; border-right: 0; font-weight: 600;">
                                        <option value="percentage">{{ __('Percentage') }} (%)</option>
                                        <option value="amount">{{ __('Fixed Amount') }} ({{ PriceHelper::adminCurrency() }})</option>
                                    </select>
                                </div>
                                <input type="number" id="discount" name="discount" class="form-control"
                                    placeholder="{{ __('Enter Discount Value') }}" min="0" step="0.1"
                                    value="{{ old('discount') }}" required style="font-weight: 700;">
                            </div>
                        </div>

                        <div class="d-flex justify-content-end gap-2 pt-3 border-top">
                            <a href="{{ route('back.code.index') }}" class="btn btn-secondary px-4 mr-2" style="border-radius: 10px; font-weight: 700;">{{ __('Cancel') }}</a>
                            <button type="submit" class="btn btn-primary px-4" style="border-radius: 10px; font-weight: 700; background: linear-gradient(135deg, #10b981, #059669); border: none; box-shadow: 0 4px 12px rgba(16, 185, 129, 0.3);">
                                <i class="fa-solid fa-plus mr-1"></i> {{ __('Create Coupon') }}
                            </button>
                        </div>
                    </form>
				</div>
			</div>
		</div>
	</div>

</div>

@endsection
