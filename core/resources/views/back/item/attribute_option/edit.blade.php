@extends('master.back')

@section('content')

<div class="container-fluid">

	<!-- Hero Banner -->
    <div class="dash-hero-banner mb-4">
        <div class="dash-hero-content">
            <div class="dash-hero-text">
                <h2>
                    <i class="fa-solid fa-pen-to-square mr-2" style="font-size: 22px;"></i> {{ __('Edit Attribute Option') }}
                </h2>
                <p>
                    {{ __('Update variation option details, pricing delta, and stock allocation for ') }}
                    <span class="badge badge-light text-dark font-weight-bold ml-1 px-2.5 py-1" style="font-size: 12.5px; border-radius: 6px;">{{ $item->name }}</span>
                </p>
            </div>
            <div class="dash-hero-actions">
                <a class="btn btn-hero-action btn-hero-primary" href="{{ route('back.option.index', $item->id) }}" style="font-size: 13.5px; font-weight: 700; padding: 10px 20px;">
                    <i class="fa-solid fa-arrow-left mr-1"></i> {{ __('Back to Options') }}
                </a>
            </div>
        </div>
    </div>

	<!-- Form Card -->
	<div class="row justify-content-center">
		<div class="col-lg-8 col-md-10">
			<div class="card-modern shadow-sm">
				<div class="card-modern-body p-4">
					@include('alerts.alerts')

                    <div class="d-flex align-items-center mb-4 pb-3 border-bottom">
                        <div class="d-inline-flex align-items-center justify-content-center bg-primary-light rounded-circle mr-3" style="width: 44px; height: 44px; background: #f0fdf4; color: #059669; font-size: 18px;">
                            <i class="fa-solid fa-shapes"></i>
                        </div>
                        <div>
                            <h5 class="font-weight-bold text-dark mb-0">{{ __('Update Option Details') }}</h5>
                            <p class="text-muted small mb-0">{{ __('Editing parameters for option ') }}<span class="font-weight-bold text-primary">{{ $option->name }}</span></p>
                        </div>
                    </div>

					<form class="admin-form" action="{{ route('back.option.update', [$item->id, $option->id]) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')

                        <div class="form-group mb-3">
                            <label for="attribute_id" class="form-label font-weight-bold text-dark">{{ __('Attribute Type') }} *</label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="fa-solid fa-sliders"></i></span>
                                </div>
                                <select name="attribute_id" class="form-control" id="attribute_id" required>
                                    <option value="" disabled>{{ __('Select Attribute (e.g. Size, Color, Storage)...') }}</option>
                                    @foreach($attributes as $attribute)
                                        <option value="{{ $attribute->id }}" {{ $attribute->id == $option->attribute_id ? 'selected' : '' }}>{{ $attribute->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="form-group mb-3">
                            <label for="attr_name" class="form-label font-weight-bold text-dark">{{ __('Option Name / Value') }} *</label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="fa-solid fa-tag"></i></span>
                                </div>
                                <input type="text" name="name" class="form-control" id="attr_name"
                                    placeholder="{{ __('e.g., XXL, 128GB, Midnight Blue') }}" value="{{ $option->name }}" required>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <div class="col-md-6 mb-3 mb-md-0">
                                <label for="stock" class="form-label font-weight-bold text-dark">{{ __('Stock Quantity') }} *</label>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="fa-solid fa-boxes-stacked"></i></span>
                                    </div>
                                    <input type="text" name="stock" class="form-control" id="stock"
                                        placeholder="{{ __('Enter Stock or type unlimited') }}" value="{{ $option->stock }}" required>
                                </div>
                                <div class="custom-control custom-checkbox mt-2">
                                    <input type="checkbox" class="custom-control-input" id="unlimited" {{ $option->stock == 'unlimited' ? 'checked' : '' }}>
                                    <label class="custom-control-label font-weight-600 text-dark" for="unlimited" style="cursor: pointer;">
                                        <i class="fa-solid fa-infinity text-primary mr-1"></i> {{ __('Unlimited Stock Available') }}
                                    </label>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <label for="price" class="form-label font-weight-bold text-dark">{{ __('Price Delta (+ Price)') }} *</label>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text font-weight-bold">{{ PriceHelper::adminCurrency() }}</span>
                                    </div>
                                    <input type="number" id="price" name="price" class="form-control"
                                        placeholder="{{ __('0 for no price change') }}" min="0" step="0.01"
                                        value="{{ PriceHelper::setPrice($option->price) }}" required style="font-weight: 700;">
                                </div>
                                <small class="text-muted d-block mt-2">{{ __('Set 0 to make it free or match base product price.') }}</small>
                            </div>
                        </div>

                        <input type="hidden" id="attr_keyword" name="keyword" value="{{ $option->keyword }}">

                        <div class="d-flex justify-content-end gap-2 pt-3 border-top mt-4">
                            <a href="{{ route('back.option.index', $item->id) }}" class="btn btn-secondary px-4 mr-2" style="border-radius: 10px; font-weight: 700;">{{ __('Cancel') }}</a>
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

@section('scripts')
<script>
    $(document).ready(function() {
        $('#unlimited').on('change', function() {
            if ($(this).is(':checked')) {
                $('#stock').val('unlimited').prop('readonly', true);
            } else {
                $('#stock').val('10').prop('readonly', false).focus();
            }
        });
        if ($('#stock').val() === 'unlimited') {
            $('#unlimited').prop('checked', true);
            $('#stock').prop('readonly', true);
        } else {
            $('#unlimited').prop('checked', false);
        }
    });
</script>
@endsection
