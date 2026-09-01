@extends('master.back')

@section('content')

<div class="container-fluid">

	<!-- Page Header Banner -->
    <div class="dash-hero-banner mb-4">
        <div class="dash-hero-content">
            <div class="dash-hero-text">
                <h2><i class="fa-solid fa-folder-plus mr-2" style="font-size: 22px;"></i> {{ __('Create Blog Category') }}</h2>
                <p>{{ __('Add a new blog topic or editorial category to categorize articles and posts.') }}</p>
            </div>
            <div class="dash-hero-actions">
                <a class="btn btn-hero-action btn-hero-primary" href="{{ route('back.bcategory.index') }}" style="font-size: 13.5px; font-weight: 700; padding: 10px 20px;">
                    <i class="fa-solid fa-chevron-left mr-1"></i> {{ __('Back to Categories') }}
                </a>
            </div>
        </div>
    </div>

	<!-- Form -->
	<div class="row">
		<div class="col-lg-12">
			<div class="card-modern">
				<div class="card-modern-body">
					<form class="admin-form" action="{{ route('back.bcategory.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
						@include('alerts.alerts')

						<div class="row">
							<div class="col-md-6 mb-3">
								<label for="name" class="form-label font-weight-bold">{{ __('Category Name') }} *</label>
								<div class="input-group">
									<div class="input-group-prepend">
										<span class="input-group-text"><i class="fa-solid fa-tag"></i></span>
									</div>
									<input type="text" name="name" class="form-control item-name" id="name"
										placeholder="{{ __('e.g., Technology, Lifestyle, Fashion') }}" value="{{ old('name') }}" required>
								</div>
							</div>

							<div class="col-md-6 mb-3">
								<label for="slug" class="form-label font-weight-bold">{{ __('Category Slug') }} *</label>
								<div class="input-group">
									<div class="input-group-prepend">
										<span class="input-group-text"><i class="fa-solid fa-link"></i></span>
									</div>
									<input type="text" name="slug" class="form-control" id="slug"
										placeholder="{{ __('e.g., technology, lifestyle, fashion') }}" value="{{ old('slug') }}" required>
								</div>
							</div>
						</div>

						<div class="d-flex justify-content-end gap-2 mt-4 pt-3 border-top">
                            <a href="{{ route('back.bcategory.index') }}" class="btn btn-secondary px-4 mr-2" style="border-radius: 10px; font-weight: 700;">{{ __('Cancel') }}</a>
							<button type="submit" class="btn btn-primary px-4" style="border-radius: 10px; font-weight: 700; background: linear-gradient(135deg, #10b981, #059669); border: none; box-shadow: 0 4px 12px rgba(16, 185, 129, 0.3);">
                                <i class="fa-solid fa-floppy-disk mr-1"></i> {{ __('Save Category') }}
                            </button>
						</div>

					</form>
				</div>
			</div>
		</div>
	</div>

</div>

@endsection
