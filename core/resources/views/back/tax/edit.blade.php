@extends('master.back')

@section('content')
<div class="container-fluid">

	<!-- Page Header Banner -->
    <div class="dash-hero-banner mb-4">
        <div class="dash-hero-content">
            <div class="dash-hero-text">
                <h2><i class="fa-solid fa-pen-to-square mr-2" style="font-size: 22px;"></i> {{ __('Edit Tax Rate') }}</h2>
                <p>{{ __('Update tax bracket title or adjust percentage rates for store calculations.') }}</p>
            </div>
            <div class="dash-hero-actions">
                <a class="btn btn-hero-action btn-hero-primary" href="{{ route('back.tax.index') }}" style="font-size: 13.5px; font-weight: 700; padding: 10px 20px;">
                    <i class="fa-solid fa-arrow-left mr-1"></i> {{ __('Back to Taxes') }}
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
                            <i class="fa-solid fa-percent"></i>
                        </div>
                        <div>
                            <h5 class="font-weight-bold text-dark mb-0">{{ __('Update Tax Information') }}</h5>
                            <p class="text-muted small mb-0">{{ __('Editing parameters for ') }}<span class="font-weight-bold text-primary">{{ $tax->name }}</span></p>
                        </div>
                    </div>

                    <form class="admin-form" action="{{ route('back.tax.update', $tax->id) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')

                        <div class="form-group mb-3">
                            <label for="title" class="form-label font-weight-bold text-dark">{{ __('Tax Bracket Title') }} *</label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="fa-solid fa-heading"></i></span>
                                </div>
                                <input type="text" name="name" class="form-control" id="title"
                                    placeholder="{{ __('Enter Title') }}" value="{{ $tax->name }}" required>
                            </div>
                        </div>

                        <div class="form-group mb-4">
                            <label for="price" class="form-label font-weight-bold text-dark">{{ __('Tax Percentage (%)') }} *</label>
                            <div class="input-group mb-1">
                                <div class="input-group-prepend">
                                    <span class="input-group-text bg-light font-weight-bold text-dark">%</span>
                                </div>
                                <input type="number" id="price" name="value" class="form-control"
                                    placeholder="{{ __('Enter Price') }}" min="0" step="0.01"
                                    value="{{ $tax->value }}" required style="font-weight: 700;">
                            </div>
                            <small class="text-muted">{{ __('Set to 0 to make this tax rate zero-rated (0%).') }}</small>
                        </div>

                        <div class="d-flex justify-content-end gap-2 pt-3 border-top">
                            <a href="{{ route('back.tax.index') }}" class="btn btn-secondary px-4 mr-2" style="border-radius: 10px; font-weight: 700;">{{ __('Cancel') }}</a>
                            <button type="submit" class="btn btn-primary px-4" style="border-radius: 10px; font-weight: 700; background: linear-gradient(135deg, #10b981, #059669); border: none; box-shadow: 0 4px 12px rgba(16, 185, 129, 0.3);">
                                <i class="fa-solid fa-floppy-disk mr-1"></i> {{ __('Save Changes') }}
                            </button>
                        </div>
                    </form>
				</div>
			</div>
		</div>
	</div>

</div>
@endsection
