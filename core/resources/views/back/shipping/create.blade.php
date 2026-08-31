@extends('master.back')

@section('content')

<div class="container-fluid">

	<!-- Page Header Banner -->
    <div class="dash-hero-banner mb-4">
        <div class="dash-hero-content">
            <div class="dash-hero-text">
                <h2><i class="fa-solid fa-truck-fast mr-2" style="font-size: 22px;"></i> {{ __('Create Shipping Method') }}</h2>
                <p>{{ __('Configure delivery rates, method title, and pricing rules for orders.') }}</p>
            </div>
            <div class="dash-hero-actions">
                <a class="btn btn-hero-action btn-hero-primary" href="{{ route('back.shipping.index') }}" style="font-size: 13.5px; font-weight: 700; padding: 10px 20px;">
                    <i class="fa-solid fa-arrow-left mr-1"></i> {{ __('Back to Shipping') }}
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
                            <i class="fa-solid fa-truck"></i>
                        </div>
                        <div>
                            <h5 class="font-weight-bold text-dark mb-0">{{ __('Delivery Method Information') }}</h5>
                            <p class="text-muted small mb-0">{{ __('Specify the title and flat shipping cost') }}</p>
                        </div>
                    </div>

                    <form class="admin-form" action="{{ route('back.shipping.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf

                        <div class="form-group mb-3">
                            <label for="title" class="form-label font-weight-bold text-dark">{{ __('Shipping Method Title') }} *</label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text bg-light"><i class="fa-solid fa-truck-fast text-muted"></i></span>
                                </div>
                                <input type="text" name="title" class="form-control" id="title"
                                    placeholder="{{ __('e.g., Express Courier Delivery, Standard Ground Shipping') }}" value="{{ old('title') }}" required>
                            </div>
                        </div>

                        <div class="form-group mb-4">
                            <label for="price" class="form-label font-weight-bold text-dark">{{ __('Shipping Cost / Price') }} *</label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text bg-light font-weight-bold text-dark">{{ PriceHelper::adminCurrency() }}</span>
                                </div>
                                <input type="number" id="price" name="price" class="form-control"
                                    placeholder="{{ __('0.00 (Enter 0 for Free Shipping)') }}" min="0" step="0.01"
                                    value="{{ old('price') }}" required style="font-weight: 700;">
                            </div>
                            <small class="text-muted">{{ __('Set to 0 for Free Shipping or specify a flat delivery rate.') }}</small>
                        </div>

                        <div class="d-flex justify-content-end gap-2 pt-3 border-top">
                            <a href="{{ route('back.shipping.index') }}" class="btn btn-secondary px-4 mr-2" style="border-radius: 10px; font-weight: 700;">{{ __('Cancel') }}</a>
                            <button type="submit" class="btn btn-primary px-4" style="border-radius: 10px; font-weight: 700; background: linear-gradient(135deg, #4f46e5, #3b82f6); border: none; box-shadow: 0 4px 12px rgba(79, 70, 229, 0.3);">
                                <i class="fa-solid fa-plus mr-1"></i> {{ __('Create Method') }}
                            </button>
                        </div>
                    </form>
				</div>
			</div>
		</div>
	</div>

</div>

@endsection
