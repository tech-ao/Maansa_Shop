@extends('master.back')

@section('content')

<div class="container-fluid">

	<!-- Hero Banner -->
    <div class="dash-hero-banner mb-4">
        <div class="dash-hero-content">
            <div class="dash-hero-text">
                <h2>
                    <i class="fa-solid fa-pen-to-square mr-2" style="font-size: 22px;"></i> {{ __('Edit Attribute Group') }}
                </h2>
                <p>
                    {{ __('Update attribute category name for ') }}
                    <span class="badge badge-light text-dark font-weight-bold ml-1 px-2.5 py-1" style="font-size: 12.5px; border-radius: 6px;">{{ $item->name }}</span>
                </p>
            </div>
            <div class="dash-hero-actions">
                <a class="btn btn-hero-action btn-hero-primary" href="{{ route('back.attribute.index', $item->id) }}" style="font-size: 13.5px; font-weight: 700; padding: 10px 20px;">
                    <i class="fa-solid fa-arrow-left mr-1"></i> {{ __('Back to Attributes') }}
                </a>
            </div>
        </div>
    </div>

	<!-- Form Card -->
	<div class="row justify-content-center">
		<div class="col-lg-7 col-md-10">
			<div class="card-modern shadow-sm">
				<div class="card-modern-body p-4">
					@include('alerts.alerts')

                    <div class="d-flex align-items-center mb-4 pb-3 border-bottom">
                        <div class="d-inline-flex align-items-center justify-content-center bg-primary-light rounded-circle mr-3" style="width: 44px; height: 44px; background: #f0fdf4; color: #059669; font-size: 18px;">
                            <i class="fa-solid fa-sliders"></i>
                        </div>
                        <div>
                            <h5 class="font-weight-bold text-dark mb-0">{{ __('Update Attribute') }}</h5>
                            <p class="text-muted small mb-0">{{ __('Editing attribute group ') }}<span class="font-weight-bold text-primary">{{ $attribute->name }}</span></p>
                        </div>
                    </div>

					<form class="admin-form" action="{{ route('back.attribute.update', [$item->id, $attribute->id]) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')

                        <div class="form-group mb-4">
                            <label for="attr_name" class="form-label font-weight-bold text-dark">{{ __('Attribute Group Name') }} *</label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="fa-solid fa-sliders"></i></span>
                                </div>
                                <input type="text" name="name" class="form-control" id="attr_name"
                                    placeholder="{{ __('e.g., Size, Color, Capacity') }}" value="{{ $attribute->name }}" required>
                            </div>
                        </div>

                        <input type="hidden" id="attr_keyword" name="keyword" value="{{ $attribute->keyword }}">
                        <input type="hidden" name="item_id" value="{{ $item->id }}">

                        <div class="d-flex justify-content-end gap-2 pt-3 border-top">
                            <a href="{{ route('back.attribute.index', $item->id) }}" class="btn btn-secondary px-4 mr-2" style="border-radius: 10px; font-weight: 700;">{{ __('Cancel') }}</a>
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
