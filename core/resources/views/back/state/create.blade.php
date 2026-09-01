@extends('master.back')

@section('content')

<div class="container-fluid">

	<!-- Page Header Banner -->
    <div class="dash-hero-banner mb-4">
        <div class="dash-hero-content">
            <div class="dash-hero-text">
                <h2><i class="fa-solid fa-map-location-dot mr-2" style="font-size: 22px;"></i> {{ __('Create State Tax / Delivery Rule') }}</h2>
                <p>{{ __('Set up regional tax rates or state-wise flat/percentage delivery surcharges.') }}</p>
            </div>
            <div class="dash-hero-actions">
                <a class="btn btn-hero-action btn-hero-primary" href="{{ route('back.state.index') }}" style="font-size: 13.5px; font-weight: 700; padding: 10px 20px;">
                    <i class="fa-solid fa-arrow-left mr-1"></i> {{ __('Back to States') }}
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
                        <div class="d-inline-flex align-items-center justify-content-center bg-primary-light rounded-circle mr-3" style="width: 44px; height: 44px; background: #f0fdf4; color: #059669; font-size: 18px;">
                            <i class="fa-solid fa-location-dot"></i>
                        </div>
                        <div>
                            <h5 class="font-weight-bold text-dark mb-0">{{ __('State / Region Information') }}</h5>
                            <p class="text-muted small mb-0">{{ __('Specify the region name and tax or surcharge amount') }}</p>
                        </div>
                    </div>

                    <form class="admin-form" action="{{ route('back.state.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf

                        <div class="form-group mb-3">
                            <label for="title" class="form-label font-weight-bold text-dark">{{ __('State / Region Name') }} *</label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="fa-solid fa-map-pin"></i></span>
                                </div>
                                <input type="text" name="name" class="form-control" id="title"
                                    placeholder="{{ __('e.g., California, New York, Texas') }}" value="{{ old('name') }}" required>
                            </div>
                        </div>

                        <div class="form-group mb-4">
                            <label for="price" class="form-label font-weight-bold text-dark">{{ __('Tax / Surcharge Rate') }} *</label>
                            <div class="input-group">
                                <div class="input-group-prepend" style="width: 35%;">
                                    <select name="type" class="form-control" style="border-top-right-radius: 0; border-bottom-right-radius: 0; border-right: 0; font-weight: 600;">
                                        <option value="percentage">{{ __('Percentage') }} (%)</option>
                                        <option value="fixed">{{ __('Fixed') }} ({{ PriceHelper::adminCurrency() }})</option>
                                    </select>
                                </div>
                                <input type="number" id="price" name="price" class="form-control"
                                    placeholder="{{ __('Enter Tax/Charge Value (e.g. 5)') }}" min="0" step="0.01"
                                    value="{{ old('price', 0) }}" required style="font-weight: 700;">
                            </div>
                            <small class="text-muted">{{ __('Choose percentage rate (%) or fixed monetary surcharge applied to orders in this region.') }}</small>
                        </div>

                        <div class="d-flex justify-content-end gap-2 pt-3 border-top">
                            <a href="{{ route('back.state.index') }}" class="btn btn-secondary px-4 mr-2" style="border-radius: 10px; font-weight: 700;">{{ __('Cancel') }}</a>
                            <button type="submit" class="btn btn-primary px-4" style="border-radius: 10px; font-weight: 700; background: linear-gradient(135deg, #10b981, #059669); border: none; box-shadow: 0 4px 12px rgba(16, 185, 129, 0.3);">
                                <i class="fa-solid fa-plus mr-1"></i> {{ __('Create State Rule') }}
                            </button>
                        </div>
                    </form>
				</div>
			</div>
		</div>
	</div>

</div>

@endsection
