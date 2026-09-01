@extends('master.back')

@section('content')

<div class="container-fluid">

    <!-- Page Header Banner -->
    <div class="dash-hero-banner mb-4">
        <div class="dash-hero-content">
            <div class="dash-hero-text">
                <h2><i class="fa-solid fa-folder-plus mr-2" style="font-size: 22px;"></i> {{ __('Create Child Category') }}</h2>
                <p>{{ __('Add a 3rd-level product category branch linked to a primary and secondary category.') }}</p>
            </div>
            <div class="dash-hero-actions">
                <a class="btn btn-hero-action btn-hero-primary" href="{{ route('back.childcategory.index') }}" style="font-size: 13.5px; font-weight: 700; padding: 10px 20px;">
                    <i class="fa-solid fa-chevron-left mr-1"></i> {{ __('Back to Child Categories') }}
                </a>
            </div>
        </div>
    </div>

    <!-- Form Card -->
    <div class="row">
        <div class="col-lg-12">
            <div class="card-modern">
                <div class="card-modern-body">
                    <form class="admin-form" action="{{ route('back.childcategory.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @include('alerts.alerts')

                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="category_id" class="form-label font-weight-bold">{{ __('Select Primary Category') }} *</label>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="fa-solid fa-layer-group"></i></span>
                                    </div>
                                    <select name="category_id" id="category_id" data-href="{{ route('back.get.subcategory') }}" class="form-control" required>
                                        <option value="" selected disabled>{{ __('Select Category First...') }}</option>
                                        @foreach(DB::table('categories')->whereStatus(1)->get() as $cat)
                                            <option value="{{ $cat->id }}">{{ $cat->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="col-md-6 mb-3">
                                <label for="subcategory_id" class="form-label font-weight-bold">{{ __('Select Subcategory') }} *</label>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="fa-solid fa-sitemap"></i></span>
                                    </div>
                                    <select name="subcategory_id" id="subcategory_id" class="form-control" required>
                                        <option value="">{{ __('Select Subcategory...') }}</option>
                                    </select>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="name" class="form-label font-weight-bold">{{ __('Child Category Name') }} *</label>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="fa-solid fa-tag"></i></span>
                                    </div>
                                    <input type="text" name="name" class="form-control item-name" id="name" placeholder="{{ __('e.g. Screen Protectors, Running Shoes') }}" value="{{ old('name') }}" required>
                                </div>
                            </div>

                            <div class="col-md-6 mb-3">
                                <label for="slug" class="form-label font-weight-bold">{{ __('Child Category Slug') }} *</label>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="fa-solid fa-link"></i></span>
                                    </div>
                                    <input type="text" name="slug" class="form-control" id="slug" placeholder="{{ __('e.g. screen-protectors, running-shoes') }}" value="{{ old('slug') }}" required>
                                </div>
                            </div>
                        </div>

                        <div class="d-flex justify-content-end gap-2 mt-3">
                            <a href="{{ route('back.childcategory.index') }}" class="btn btn-secondary px-4 mr-2" style="border-radius: 10px; font-weight: 700;">{{ __('Cancel') }}</a>
                            <button type="submit" class="btn btn-primary px-4" style="border-radius: 10px; font-weight: 700; background: linear-gradient(135deg, #10b981, #059669); border: none; box-shadow: 0 4px 12px rgba(16, 185, 129, 0.3);">
                                <i class="fa-solid fa-floppy-disk mr-1"></i> {{ __('Save Child Category') }}
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
