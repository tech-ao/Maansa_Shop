@extends('master.back')

@section('content')

<div class="container-fluid">

	<!-- Page Header Banner -->
    <div class="dash-hero-banner mb-4">
        <div class="dash-hero-content">
            <div class="dash-hero-text">
                <h2><i class="fa-solid fa-folder-plus mr-2" style="font-size: 22px;"></i> {{ __('Create Brand') }}</h2>
                <p>{{ __('Add a new product brand, vendor, or manufacturer with logo and slug.') }}</p>
            </div>
            <div class="dash-hero-actions">
                <a class="btn btn-hero-action btn-hero-primary" href="{{ route('back.brand.index') }}" style="font-size: 13.5px; font-weight: 700; padding: 10px 20px;">
                    <i class="fa-solid fa-chevron-left mr-1"></i> {{ __('Back to Brands') }}
                </a>
            </div>
        </div>
    </div>

	<!-- Form -->
	<div class="row">
		<div class="col-lg-12">
			<div class="card-modern">
				<div class="card-modern-body">
					<form class="admin-form" action="{{ route('back.brand.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
						@include('alerts.alerts')

                        <!-- Logo Upload Section -->
                        <div class="staff-avatar-upload-wrap mb-4">
                            <div style="width: 110px; height: 81px; border-radius: 10px; overflow: hidden; background: #ffffff; border: 2px solid #ffffff; box-shadow: 0 4px 12px rgba(0, 0, 0, 0.08); display: flex; align-items: center; justify-content: center; padding: 4px;">
                                <img src="{{ url('/core/public/storage/images/placeholder.png') }}"
                                    id="brand-preview-img"
                                    alt="Brand Logo Preview"
                                    style="max-width: 100%; max-height: 100%; object-fit: contain;">
                            </div>
                            <div>
                                <h6 class="font-weight-bold text-dark mb-1">{{ __('Brand Logo') }} <span class="text-danger">*</span></h6>
                                <p class="text-muted small mb-2">{{ __('Recommended image dimensions: 110 x 81 px (PNG or JPG).') }}</p>
                                <label class="btn btn-outline-primary btn-sm mb-0 cursor-pointer" style="border-radius: 8px; font-weight: 600;">
                                    <i class="fas fa-image mr-1"></i> {{ __('Upload Logo...') }}
                                    <input type="file" accept="image/*" class="upload-photo d-none" name="photo" id="brand-photo-input" required>
                                </label>
                            </div>
                        </div>

						<div class="row">
							<div class="col-md-6 mb-3">
								<label for="name" class="form-label font-weight-bold">{{ __('Brand Name') }} *</label>
								<div class="input-group">
									<div class="input-group-prepend">
										<span class="input-group-text"><i class="fa-solid fa-tag"></i></span>
									</div>
									<input type="text" name="name" class="form-control item-name" id="name"
										placeholder="{{ __('e.g., Nike, Apple, Sony') }}" value="{{ old('name') }}" required>
								</div>
							</div>

							<div class="col-md-6 mb-3">
								<label for="slug" class="form-label font-weight-bold">{{ __('Brand Slug') }} *</label>
								<div class="input-group">
									<div class="input-group-prepend">
										<span class="input-group-text"><i class="fa-solid fa-link"></i></span>
									</div>
									<input type="text" name="slug" class="form-control" id="slug"
										placeholder="{{ __('e.g., nike, apple, sony') }}" value="{{ old('slug') }}" required>
								</div>
							</div>
						</div>

						<div class="d-flex justify-content-end gap-2 mt-4 pt-3 border-top">
                            <a href="{{ route('back.brand.index') }}" class="btn btn-secondary px-4 mr-2" style="border-radius: 10px; font-weight: 700;">{{ __('Cancel') }}</a>
							<button type="submit" class="btn btn-primary px-4" style="border-radius: 10px; font-weight: 700; background: linear-gradient(135deg, #10b981, #059669); border: none; box-shadow: 0 4px 12px rgba(16, 185, 129, 0.3);">
                                <i class="fa-solid fa-floppy-disk mr-1"></i> {{ __('Save Brand') }}
                            </button>
						</div>

					</form>
				</div>
			</div>
		</div>
	</div>

</div>

@push('scripts')
<script>
    $(document).ready(function() {
        $('#brand-photo-input').on('change', function(e) {
            const file = e.target.files[0];
            if (file) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    $('#brand-preview-img').attr('src', e.target.result);
                }
                reader.readAsDataURL(file);
            }
        });
    });
</script>
@endpush

@endsection
