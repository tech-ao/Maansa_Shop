@extends('master.back')

@section('content')
<div class="container-fluid">

    <!-- Page Header Banner -->
    <div class="dash-hero-banner mb-4">
        <div class="dash-hero-content">
            <div class="dash-hero-text">
                <h2><i class="fa-solid fa-pen-to-square mr-2" style="font-size: 22px;"></i> {{ __('Update Blog Post') }}</h2>
                <p>{{ __('Edit post content, category classification, multimedia images, and SEO settings.') }}</p>
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
                    <form class="admin-form" action="{{ route('back.post.update', $post->id) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        @include('alerts.alerts')

                        <!-- Photo Gallery Section -->
                        <div class="mb-4 p-3 bg-light rounded" style="border: 1px solid #e2e8f0; border-radius: 12px;">
                            <h6 class="font-weight-bold text-dark mb-2">
                                <i class="fas fa-images text-primary mr-1"></i> {{ __('Current Featured & Gallery Images') }}
                            </h6>
                            <p class="text-muted small mb-3">{{ __('Multiple images are allowed. Click the red trash icon to delete specific images.') }}</p>

                            <div class="d-flex flex-wrap align-items-center mb-3" style="gap: 12px;">
                                @forelse(json_decode($post->photo, true) ?? [] as $key => $photo)
                                    <div class="position-relative" style="display: inline-block;">
                                        @if ($key != 0)
                                            <span data-toggle="modal" data-target="#confirm-delete" href="javascript:;"
                                                data-href="{{ route('back.post.photo.delete', [$key, $post->id]) }}"
                                                class="remove-gallery-img"
                                                style="position: absolute; top: -6px; right: -6px; background: #ef4444; color: #fff; width: 22px; height: 22px; border-radius: 50%; display: flex; align-items: center; justify-content: center; font-size: 10px; cursor: pointer; z-index: 5; box-shadow: 0 2px 6px rgba(0,0,0,0.2);">
                                                <i class="fas fa-times"></i>
                                            </span>
                                        @endif
                                        <a class="popup-link" href="{{ $photo ? url('/core/public/storage/images/' . $photo) : url('/core/public/storage/images/placeholder.png') }}">
                                            <img src="{{ $photo ? url('/core/public/storage/images/' . $photo) : url('/core/public/storage/images/placeholder.png') }}"
                                                onerror="this.onerror=null; this.src='{{ url('/core/public/storage/images/placeholder.png') }}';"
                                                alt="Blog Image"
                                                style="width: 100px; height: 65px; object-fit: cover; border-radius: 8px; border: 2px solid #ffffff; box-shadow: 0 2px 8px rgba(0,0,0,0.08);">
                                        </a>
                                    </div>
                                @empty
                                    <span class="text-muted small">{{ __('No images added.') }}</span>
                                @endforelse
                            </div>

                            <label class="btn btn-outline-primary btn-sm mb-0 cursor-pointer" style="border-radius: 8px; font-weight: 600;">
                                <i class="fas fa-upload mr-1"></i> {{ __('Upload Additional Images...') }}
                                <input type="file" accept="image/*" name="photo[]" id="file" class="upload-photo d-none" multiple>
                            </label>
                        </div>

                        <div class="row">
                            <div class="col-md-8 mb-3">
                                <label for="title" class="form-label font-weight-bold">{{ __('Blog Title') }} *</label>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text bg-light"><i class="fa-solid fa-heading text-muted"></i></span>
                                    </div>
                                    <input type="text" name="title" class="form-control item-name" id="title"
                                        placeholder="{{ __('Enter Title') }}" value="{{ $post->title }}" required>
                                </div>
                            </div>

                            <div class="col-md-4 mb-3">
                                <label for="category_id" class="form-label font-weight-bold">{{ __('Select Category') }} *</label>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text bg-light"><i class="fa-solid fa-folder-open text-muted"></i></span>
                                    </div>
                                    <select name="category_id" id="category_id" class="form-control" required>
                                        <option value="" disabled>{{ __('Select Category...') }}</option>
                                        @foreach (DB::table('bcategories')->whereStatus(1)->get() as $category)
                                            <option value="{{ $category->id }}" {{ $post->category_id == $category->id ? 'selected' : '' }}>
                                                {{ $category->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>

                        <div class="form-group mb-4">
                            <label for="details" class="form-label font-weight-bold">{{ __('Article Content / Details') }} *</label>
                            <textarea name="details" id="details" class="form-control text-editor" rows="6"
                                placeholder="{{ __('Enter Details') }}">{{ $post->details }}</textarea>
                        </div>

                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="tags" class="form-label font-weight-bold">{{ __('Article Tags') }}</label>
                                <input type="text" name="tags" class="tags form-control" id="tags"
                                    placeholder="{{ __('Tags') }}" value="{{ $post->tags }}">
                            </div>

                            <div class="col-md-6 mb-3">
                                <label for="meta_keywords" class="form-label font-weight-bold">{{ __('Meta Keywords') }}</label>
                                <input type="text" name="meta_keywords" class="tags form-control" id="meta_keywords"
                                    placeholder="{{ __('Enter Meta Keywords') }}" value="{{ $post->meta_keywords }}">
                            </div>
                        </div>

                        <div class="form-group mb-4">
                            <label for="meta_description" class="form-label font-weight-bold">{{ __('Meta Description (SEO)') }}</label>
                            <textarea name="meta_descriptions" id="meta_descriptions" class="form-control" rows="3"
                                placeholder="{{ __('Enter Meta Description') }}">{{ $post->meta_descriptions }}</textarea>
                        </div>

                        <div class="d-flex justify-content-end gap-2 mt-4 pt-3 border-top">
                            <a href="{{ route('back.post.index') }}" class="btn btn-secondary px-4 mr-2" style="border-radius: 10px; font-weight: 700;">{{ __('Cancel') }}</a>
                            <button type="submit" class="btn btn-primary px-4" style="border-radius: 10px; font-weight: 700; background: linear-gradient(135deg, #10b981, #059669); border: none; box-shadow: 0 4px 12px rgba(16, 185, 129, 0.3);">
                                <i class="fa-solid fa-floppy-disk mr-1"></i> {{ __('Update Blog Post') }}
                            </button>
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </div>

</div>

{{-- DELETE MODAL --}}
<div class="modal fade" id="confirm-delete" tabindex="-1" role="dialog" aria-labelledby="confirm-deleteModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content border-0 shadow-lg" style="border-radius: 16px; overflow: hidden;">
            <div class="modal-header bg-danger text-white border-0 py-3">
                <h5 class="modal-title d-flex align-items-center font-weight-bold" id="exampleModalLabel">
                    <i class="fas fa-exclamation-triangle mr-2"></i> {{ __('Confirm Image Deletion') }}
                </h5>
                <button class="close text-white opacity-8" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body p-4 text-center">
                <p class="text-muted mb-0">
                    {{ __('Do you want to remove this gallery image?') }}
                </p>
            </div>
            <div class="modal-footer bg-light border-0 py-3 d-flex justify-content-center">
                <button type="button" class="btn btn-secondary px-4" style="border-radius: 10px; font-weight: 700;" data-dismiss="modal">{{ __('Cancel') }}</button>
                <a class="btn btn-danger btn-ok px-4" style="border-radius: 10px; font-weight: 700;">{{ __('Delete Image') }}</a>
            </div>
        </div>
</div>
{{-- DELETE MODAL ENDS --}}

@endsection
