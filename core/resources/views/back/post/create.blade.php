@extends('master.back')

@section('content')

<div class="container-fluid">

	<!-- Page Header Banner -->
    <div class="dash-hero-banner mb-4">
        <div class="dash-hero-content">
            <div class="dash-hero-text">
                <h2><i class="fa-solid fa-folder-plus mr-2" style="font-size: 22px;"></i> {{ __('Create Blog Post') }}</h2>
                <p>{{ __('Publish an informative article, story, or announcement with rich media and SEO tags.') }}</p>
            </div>
            <div class="dash-hero-actions">
                <a class="btn btn-hero-action btn-hero-primary" href="{{ route('back.post.index') }}" style="font-size: 13.5px; font-weight: 700; padding: 10px 20px;">
                    <i class="fa-solid fa-chevron-left mr-1"></i> {{ __('Back to Blogs') }}
                </a>
            </div>
        </div>
    </div>

	<!-- Form -->
	<div class="row">
		<div class="col-lg-12">
			<div class="card-modern">
				<div class="card-modern-body">
					<form class="admin-form" action="{{ route('back.post.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
						@include('alerts.alerts')

                        <!-- Photo Upload Section -->
                        <div class="staff-avatar-upload-wrap mb-4">
                            <img src="{{ url('/core/public/storage/images/placeholder.png') }}"
                                id="blog-preview-img"
                                alt="Preview"
                                style="width: 140px; height: 80px; object-fit: cover; border-radius: 10px; border: 2px solid #ffffff; box-shadow: 0 4px 12px rgba(0, 0, 0, 0.08);">
                            <div>
                                <h6 class="font-weight-bold text-dark mb-1">{{ __('Featured Images') }} <span class="text-danger">*</span></h6>
                                <p class="text-muted small mb-2">{{ __('Recommended image dimensions: 708 x 277 px (Multiple image selection supported).') }}</p>
                                <label class="btn btn-outline-primary btn-sm mb-0 cursor-pointer" style="border-radius: 8px; font-weight: 600;">
                                    <i class="fas fa-images mr-1"></i> {{ __('Choose Images...') }}
                                    <input type="file" accept="image/*" class="upload-photo d-none" name="photo[]" multiple id="blog-photo-input" required>
                                </label>
                            </div>
                        </div>

						<div class="row">
							<div class="col-md-8 mb-3">
								<label for="title" class="form-label font-weight-bold">{{ __('Blog Title') }} *</label>
								<div class="input-group">
									<div class="input-group-prepend">
										<span class="input-group-text"><i class="fa-solid fa-heading"></i></span>
									</div>
									<input type="text" name="title" class="form-control item-name" id="title"
										placeholder="{{ __('e.g., Top 10 Fashion Trends in 2026') }}" value="{{ old('title') }}" required>
								</div>
							</div>

							<div class="col-md-4 mb-3">
								<label for="category_id" class="form-label font-weight-bold">{{ __('Select Category') }} *</label>
								<div class="input-group">
									<div class="input-group-prepend">
										<span class="input-group-text"><i class="fa-solid fa-folder-open"></i></span>
									</div>
									<select name="category_id" id="category_id" class="form-control" required>
										<option value="" selected disabled>{{ __('Select Category...') }}</option>
										@foreach(DB::table('bcategories')->whereStatus(1)->get() as $category)
											<option value="{{ $category->id }}">{{ $category->name }}</option>
										@endforeach
									</select>
								</div>
							</div>
						</div>

						<div class="form-group mb-4">
							<label for="details" class="form-label font-weight-bold">{{ __('Article Content / Details') }} *</label>
							<textarea name="details" id="details" class="form-control text-editor" rows="6"
								placeholder="{{ __('Write article details here...') }}">{{ old('details') }}</textarea>
						</div>

						<div class="row">
							<div class="col-md-6 mb-3">
								<label for="tags" class="form-label font-weight-bold">{{ __('Article Tags') }}</label>
								<input type="text" name="tags" class="tags form-control" id="tags"
									placeholder="{{ __('e.g., fashion, trends, summer') }}" value="{{ old('tags') }}">
							</div>

							<div class="col-md-6 mb-3">
								<label for="meta_keywords" class="form-label font-weight-bold">{{ __('Meta Keywords') }}</label>
								<input type="text" name="meta_keywords" class="tags form-control" id="meta_keywords"
									placeholder="{{ __('Enter SEO keywords') }}" value="{{ old('meta_keywords') }}">
							</div>
						</div>

						<div class="form-group mb-4">
							<label for="meta_description" class="form-label font-weight-bold">{{ __('Meta Description (SEO)') }}</label>
							<textarea name="meta_descriptions" id="meta_description" class="form-control" rows="3"
								placeholder="{{ __('Brief summary for search engines...') }}">{{ old('meta_descriptions') }}</textarea>
						</div>

						<div class="d-flex justify-content-end gap-2 mt-4 pt-3 border-top">
                            <a href="{{ route('back.post.index') }}" class="btn btn-secondary px-4 mr-2" style="border-radius: 10px; font-weight: 700;">{{ __('Cancel') }}</a>
							<button type="submit" class="btn btn-primary px-4" style="border-radius: 10px; font-weight: 700; background: linear-gradient(135deg, #10b981, #059669); border: none; box-shadow: 0 4px 12px rgba(16, 185, 129, 0.3);">
                                <i class="fa-solid fa-floppy-disk mr-1"></i> {{ __('Save Blog Post') }}
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
        $('#blog-photo-input').on('change', function(e) {
            const file = e.target.files[0];
            if (file) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    $('#blog-preview-img').attr('src', e.target.result);
                }
                reader.readAsDataURL(file);
            }
        });
    });
</script>
@endpush

@endsection
