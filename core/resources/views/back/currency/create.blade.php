@extends('master.back')

@section('content')

<div class="container-fluid">

	<!-- Page Header Banner -->
    <div class="dash-hero-banner mb-4">
        <div class="dash-hero-content">
            <div class="dash-hero-text">
                <h2><i class="fa-solid fa-coins mr-2" style="font-size: 22px;"></i> {{ __('Create Currency') }}</h2>
                <p>{{ __('Add a new global currency, define exchange rate value against base currency, and assign symbol.') }}</p>
            </div>
            <div class="dash-hero-actions">
                <a class="btn btn-hero-action btn-hero-primary" href="{{ route('back.currency.index') }}" style="font-size: 13.5px; font-weight: 700; padding: 10px 20px;">
                    <i class="fa-solid fa-arrow-left mr-1"></i> {{ __('Back to Currencies') }}
                </a>
            </div>
        </div>
    </div>

	<!-- Form Card -->
	<div class="row justify-content-center">
		<div class="col-lg-7 col-md-10">
			<div class="card-modern">
				<div class="card-modern-body">
					@include('alerts.alerts')

                    <div class="d-flex align-items-center mb-4 pb-3 border-bottom">
                        <div class="d-inline-flex align-items-center justify-content-center bg-primary-light rounded-circle mr-3" style="width: 44px; height: 44px; background: #eef2ff; color: #4f46e5; font-size: 18px;">
                            <i class="fa-solid fa-coins"></i>
                        </div>
                        <div>
                            <h5 class="font-weight-bold text-dark mb-0">{{ __('Currency Details') }}</h5>
                            <p class="text-muted small mb-0">{{ __('Define currency code, symbol, and exchange conversion factor') }}</p>
                        </div>
                    </div>

                    <form class="admin-form" action="{{ route('back.currency.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf

                        <div class="form-group mb-3">
                            <label for="name" class="form-label font-weight-bold text-dark">{{ __('Currency Code / Name') }} *</label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text bg-light"><i class="fa-solid fa-globe text-muted"></i></span>
                                </div>
                                <input type="text" name="name" class="form-control" id="name"
                                    placeholder="{{ __('e.g., USD, EUR, GBP, NGN') }}" value="{{ old('name') }}" required style="font-family: monospace; font-weight: 700; text-transform: uppercase;">
                            </div>
                        </div>

                        <div class="form-group mb-3">
                            <label for="sign" class="form-label font-weight-bold text-dark">{{ __('Currency Sign / Symbol') }} *</label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text bg-light"><i class="fa-solid fa-dollar-sign text-muted"></i></span>
                                </div>
                                <input type="text" name="sign" class="form-control" id="sign"
                                    placeholder="{{ __('e.g., $, €, £, ₦') }}" value="{{ old('sign') }}" required style="font-weight: 700;">
                            </div>
                        </div>

                        <div class="form-group mb-4">
                            <label for="value" class="form-label font-weight-bold text-dark">{{ __('Exchange Rate Value') }} *</label>
                            <div class="input-group mb-1">
                                <div class="input-group-prepend">
                                    <span class="input-group-text bg-light"><i class="fa-solid fa-arrow-trend-up text-muted"></i></span>
                                </div>
                                <input type="text" name="value" class="form-control" id="value"
                                    placeholder="{{ __('e.g., 1 or 0.85') }}" value="{{ old('value') }}" required style="font-weight: 700;">
                            </div>
                            <small class="text-muted">{{ __('Base currency value is typically 1. Other currencies scale according to this exchange factor.') }}</small>
                        </div>

                        <div class="d-flex justify-content-end gap-2 pt-3 border-top">
                            <a href="{{ route('back.currency.index') }}" class="btn btn-secondary px-4 mr-2" style="border-radius: 10px; font-weight: 700;">{{ __('Cancel') }}</a>
                            <button type="submit" class="btn btn-primary px-4" style="border-radius: 10px; font-weight: 700; background: linear-gradient(135deg, #4f46e5, #3b82f6); border: none; box-shadow: 0 4px 12px rgba(79, 70, 229, 0.3);">
                                <i class="fa-solid fa-plus mr-1"></i> {{ __('Create Currency') }}
                            </button>
                        </div>
                    </form>
				</div>
			</div>
		</div>
	</div>

</div>

@endsection
