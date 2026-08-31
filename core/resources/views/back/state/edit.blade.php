@extends('master.back')

@section('content')
<div class="container-fluid">

	<!-- Page Header Banner -->
    <div class="dash-hero-banner mb-4">
        <div class="dash-hero-content">
            <div class="dash-hero-text">
                <h2><i class="fa-solid fa-pen-to-square mr-2" style="font-size: 22px;"></i> {{ __('Edit State Tax / Delivery Rule') }}</h2>
                <p>{{ __('Update regional tax calculation parameters or location delivery surcharge rates.') }}</p>
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
                        <div class="d-inline-flex align-items-center justify-content-center bg-primary-light rounded-circle mr-3" style="width: 44px; height: 44px; background: #eef2ff; color: #4f46e5; font-size: 18px;">
                            <i class="fa-solid fa-location-dot"></i>
                        </div>
                        <div>
                            <h5 class="font-weight-bold text-dark mb-0">{{ __('Update Region Details') }}</h5>
                            <p class="text-muted small mb-0">{{ __('Editing tax/surcharge rules for ') }}<span class="font-weight-bold text-primary">{{ $state->name }}</span></p>
                        </div>
                    </div>

                    <form class="admin-form" action="{{ route('back.state.update', $state->id) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')

                        <div class="form-group mb-3">
                            <label for="title" class="form-label font-weight-bold text-dark">{{ __('State / Region Name') }} *</label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text bg-light"><i class="fa-solid fa-map-pin text-muted"></i></span>
                                </div>
                                <input type="text" name="name" class="form-control" id="title"
                                    placeholder="{{ __('Enter Name') }}" value="{{ $state->name }}" required>
                            </div>
                        </div>

                        <div class="form-group mb-4">
                            <label for="price" class="form-label font-weight-bold text-dark">{{ __('Tax / Surcharge Rate') }} *</label>
                            <div class="input-group">
                                <div class="input-group-prepend" style="width: 35%;">
                                    <select name="type" class="form-control" style="border-top-right-radius: 0; border-bottom-right-radius: 0; border-right: 0; font-weight: 600;">
                                        <option value="percentage" {{ $state->type == 'percentage' ? 'selected' : '' }}>{{ __('Percentage') }} (%)</option>
                                        <option value="fixed" {{ $state->type == 'fixed' ? 'selected' : '' }}>{{ __('Fixed') }} ({{ PriceHelper::adminCurrency() }})</option>
                                    </select>
                                </div>
                                <input type="number" id="price" name="price" class="form-control"
                                    placeholder="{{ __('Enter Price') }}" min="0" step="0.01"
                                    value="{{ $state->price }}" required style="font-weight: 700;">
                            </div>
                        </div>

                        <div class="d-flex justify-content-end gap-2 pt-3 border-top">
                            <a href="{{ route('back.state.index') }}" class="btn btn-secondary px-4 mr-2" style="border-radius: 10px; font-weight: 700;">{{ __('Cancel') }}</a>
                            <button type="submit" class="btn btn-primary px-4" style="border-radius: 10px; font-weight: 700; background: linear-gradient(135deg, #4f46e5, #3b82f6); border: none; box-shadow: 0 4px 12px rgba(79, 70, 229, 0.3);">
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
