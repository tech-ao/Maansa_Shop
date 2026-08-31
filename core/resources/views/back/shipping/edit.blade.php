@extends('master.back')

@section('content')
<div class="container-fluid">

	<!-- Page Header Banner -->
    <div class="dash-hero-banner mb-4">
        <div class="dash-hero-content">
            <div class="dash-hero-text">
                <h2><i class="fa-solid fa-pen-to-square mr-2" style="font-size: 22px;"></i> {{ __('Edit Shipping Method') }}</h2>
                <p>{{ __('Update delivery method title, flat price, or conditional free shipping thresholds.') }}</p>
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
                            <h5 class="font-weight-bold text-dark mb-0">{{ __('Update Delivery Method') }}</h5>
                            <p class="text-muted small mb-0">{{ __('Editing parameters for ') }}<span class="font-weight-bold text-primary">{{ $shipping->title }}</span></p>
                        </div>
                    </div>

                    <form class="admin-form" action="{{ route('back.shipping.update', $shipping->id) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')

                        <div class="form-group mb-3">
                            <label for="title" class="form-label font-weight-bold text-dark">{{ __('Shipping Method Title') }} *</label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text bg-light"><i class="fa-solid fa-truck-fast text-muted"></i></span>
                                </div>
                                <input type="text" name="title" class="form-control" id="title"
                                    placeholder="{{ __('Enter Title') }}" value="{{ $shipping->title }}" required>
                            </div>
                        </div>

                        @if ($shipping->id == 1)
                            <div class="form-group mb-4">
                                <label for="price" class="form-label font-weight-bold text-dark">{{ __('Minimum Order Amount For Free Shipping') }} *</label>
                                <div class="input-group mb-2">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text bg-light font-weight-bold text-dark">{{ PriceHelper::adminCurrency() }}</span>
                                    </div>
                                    <input type="text" id="price" name="minimum_price" class="form-control"
                                        placeholder="{{ __('Enter Minimum Order Amount') }}"
                                        value="{{ PriceHelper::setPrice($shipping->minimum_price) }}" required style="font-weight: 700;">
                                </div>
                                <div class="p-3 bg-light rounded border mt-3 d-flex align-items-center" style="border-radius: 10px;">
                                    <input type="checkbox" name="is_condition" {{ $shipping->is_condition == 1 ? 'checked' : '' }} id="is_condition" style="width: 18px; height: 18px; cursor: pointer;" class="mr-2">
                                    <label for="is_condition" class="mb-0 font-weight-bold text-dark cursor-pointer" style="font-size: 13.5px;">
                                        {{ __('Enable Conditional Free Shipping based on Minimum Order Amount') }}
                                    </label>
                                </div>
                            </div>
                        @else
                            <div class="form-group mb-4">
                                <label for="price" class="form-label font-weight-bold text-dark">{{ __('Shipping Cost / Price') }} *</label>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text bg-light font-weight-bold text-dark">{{ PriceHelper::adminCurrency() }}</span>
                                    </div>
                                    <input type="text" id="price" name="price" class="form-control"
                                        placeholder="{{ __('Enter Price') }}"
                                        value="{{ PriceHelper::setPrice($shipping->price) }}" required style="font-weight: 700;">
                                </div>
                            </div>
                        @endif

                        <div class="d-flex justify-content-end gap-2 pt-3 border-top">
                            <a href="{{ route('back.shipping.index') }}" class="btn btn-secondary px-4 mr-2" style="border-radius: 10px; font-weight: 700;">{{ __('Cancel') }}</a>
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
