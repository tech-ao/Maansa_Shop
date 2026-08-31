@extends('master.back')

@section('content')

<div class="container-fluid">

    <!-- Page Header Banner -->
    <div class="dash-hero-banner mb-4">
        <div class="dash-hero-content">
            <div class="dash-hero-text">
                <h2><i class="fa-solid fa-pen-to-square mr-2" style="font-size: 22px;"></i> {{ __('Update Child Category') }}: {{ $childcategory->name }}</h2>
                <p>{{ __('Edit tertiary child category details, parent associations, and routing slug.') }}</p>
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
                    <form class="admin-form" action="{{ route('back.childcategory.update', $childcategory->id) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        @include('alerts.alerts')

                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="category_id" class="form-label font-weight-bold">{{ __('Select Primary Category') }} *</label>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text bg-light"><i class="fa-solid fa-layer-group text-muted"></i></span>
                                    </div>
                                    <select name="category_id" id="category_id" class="form-control" required>
                                        <option value="" disabled>{{ __('Select Category...') }}</option>
                                        @foreach(DB::table('categories')->whereStatus(1)->get() as $cat)
                                            <option value="{{ $cat->id }}" {{ $childcategory->category_id == $cat->id ? 'selected' : '' }}>{{ $cat->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="col-md-6 mb-3">
                                <label for="subcategory_id" class="form-label font-weight-bold">{{ __('Select Subcategory') }} *</label>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text bg-light"><i class="fa-solid fa-sitemap text-muted"></i></span>
                                    </div>
                                    <select name="subcategory_id" id="subcategory_id" class="form-control" required>
                                        @foreach(DB::table('subcategories')->where('category_id', $childcategory->category_id)->whereStatus(1)->get() as $subcat)
                                            <option value="{{ $subcat->id }}" {{ $subcat->id == $childcategory->subcategory_id ? 'selected' : '' }}>{{ $subcat->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="name" class="form-label font-weight-bold">{{ __('Child Category Name') }} *</label>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text bg-light"><i class="fa-solid fa-tag text-muted"></i></span>
                                    </div>
                                    <input type="text" name="name" class="form-control item-name" id="name" placeholder="{{ __('Enter Name') }}" value="{{ $childcategory->name }}" required>
                                </div>
                            </div>

                            <div class="col-md-6 mb-3">
                                <label for="slug" class="form-label font-weight-bold">{{ __('Child Category Slug') }} *</label>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text bg-light"><i class="fa-solid fa-link text-muted"></i></span>
                                    </div>
                                    <input type="text" name="slug" class="form-control" id="slug" placeholder="{{ __('Enter Slug') }}" value="{{ $childcategory->slug }}" required>
                                </div>
                            </div>
                        </div>

                        <div class="d-flex justify-content-end gap-2 mt-3">
                            <a href="{{ route('back.childcategory.index') }}" class="btn btn-secondary px-4 mr-2" style="border-radius: 10px; font-weight: 700;">{{ __('Cancel') }}</a>
                            <button type="submit" class="btn btn-primary px-4" style="border-radius: 10px; font-weight: 700; background: linear-gradient(135deg, #10b981, #059669); border: none; box-shadow: 0 4px 12px rgba(16, 185, 129, 0.3);">
                                <i class="fa-solid fa-floppy-disk mr-1"></i> {{ __('Save & Update Child Category') }}
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
