@extends('master.back')

@section('content')

<div class="container-fluid">

	<!-- Page Header Banner -->
    <div class="dash-hero-banner mb-4">
        <div class="dash-hero-content">
            <div class="dash-hero-text">
                <h2><i class="fa-solid fa-arrow-up-right-from-square mr-2" style="font-size: 22px;"></i> {{ __('Update Affiliate Product') }}</h2>
                <p>{{ __('Edit details, update affiliate link, adjust pricing, and configure metadata.') }}</p>
            </div>
            <div class="dash-hero-actions">
                <a class="btn btn-hero-action btn-hero-primary" href="{{ route('back.item.index') }}" style="font-size: 13.5px; font-weight: 700; padding: 10px 20px;">
                    <i class="fa-solid fa-arrow-left mr-1"></i> {{ __('Back to Products') }}
                </a>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-12">
            @include('alerts.alerts')
        </div>
    </div>

    <!-- Main Form -->
    <form class="admin-form" action="{{ route('back.affiliate.update',$item->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div class="row">

            <!-- Left 8 Columns -->
            <div class="col-lg-8">
                <!-- Basic Info Card -->
                <div class="card-modern mb-4">
                    <div class="card-modern-header">
                        <h6 class="font-weight-bold text-dark mb-0 d-flex align-items-center">
                            <i class="fa-solid fa-cube text-primary mr-2"></i> {{ __('General Information') }}
                        </h6>
                    </div>
                    <div class="card-modern-body p-4">
                        <div class="form-group mb-3">
                            <label for="name" class="form-label font-weight-bold text-dark">{{ __('Product Name') }} *</label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text bg-light"><i class="fa-solid fa-heading text-muted"></i></span>
                                </div>
                                <input type="text" name="name" class="form-control item-name" id="name" placeholder="{{ __('Enter Product Name') }}" value="{{ $item->name }}" required>
                            </div>
                        </div>

                        <div class="form-group mb-3">
                            <label for="affiliate__link" class="form-label font-weight-bold text-dark">{{ __('Affiliate / Referral Link') }} *</label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text bg-light"><i class="fa-solid fa-arrow-up-right-from-square text-primary"></i></span>
                                </div>
                                <input type="text" name="affiliate_link" class="form-control font-weight-bold" id="affiliate__link" placeholder="https://external-store.com/ref/item-id" value="{{ $item->affiliate_link }}" required>
                            </div>
                            <small class="text-muted mt-1 d-block">{{ __('When customers click Buy Now, they will be redirected to this URL.') }}</small>
                        </div>

                        <div class="form-group mb-0">
                            <label for="slug" class="form-label font-weight-bold text-dark">{{ __('Product Slug') }} *</label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text bg-light"><i class="fa-solid fa-link text-muted"></i></span>
                                </div>
                                <input type="text" name="slug" class="form-control" id="slug" placeholder="{{ __('Enter URL Slug') }}" value="{{ $item->slug }}" required>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Featured Image Card -->
                <div class="card-modern mb-4">
                    <div class="card-modern-header">
                        <h6 class="font-weight-bold text-dark mb-0 d-flex align-items-center">
                            <i class="fa-solid fa-image text-info mr-2"></i> {{ __('Featured Thumbnail Image') }} *
                        </h6>
                    </div>
                    <div class="card-modern-body p-4">
                        <div class="d-flex flex-column align-items-start">
                            <div class="mb-3">
                                <img class="admin-img lg" src="{{ $item->photo ? url('/core/public/storage/images/'.$item->photo) : url('/core/public/storage/images/placeholder.png') }}" style="max-width: 140px; border-radius: 12px; border: 1px solid #e2e8f0; padding: 4px;">
                            </div>
                            <div class="w-100 position-relative">
                                <label class="file w-100">
                                    <input type="file" accept="image/*" class="upload-photo" name="photo" id="file" aria-label="File browser example">
                                    <span class="file-custom text-left">{{ __('Change Featured Image...') }}</span>
                                </label>
                                <small class="text-muted d-block mt-2 font-weight-bold">
                                    <i class="fa-solid fa-circle-info text-info mr-1"></i> {{ __('Recommended image size: 800 x 800 px (Square Aspect Ratio).') }}
                                </small>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Gallery Images Card -->
                <div class="card-modern mb-4">
                    <div class="card-modern-header">
                        <h6 class="font-weight-bold text-dark mb-0 d-flex align-items-center">
                            <i class="fa-solid fa-images text-warning mr-2"></i> {{ __('Gallery Images') }}
                        </h6>
                    </div>
                    <div class="card-modern-body p-4">
                        <div class="form-group pb-0 pt-0 mt-0 mb-3">
                            <div id="gallery-images" class="d-flex flex-wrap gap-2">
                                @if($item->galleries->count() > 0)
                                    @foreach($item->galleries as $gallery)
                                        <div class="single-g-item position-relative mb-2 mr-2" style="display: inline-block;">
                                            <a href="{{ route('back.item.gallery.delete', $gallery->id) }}" class="remove-gallery-img" style="position: absolute; top: 4px; right: 4px; background: rgba(239, 68, 68, 0.9); color: #fff; width: 22px; height: 22px; border-radius: 50%; display: flex; align-items: center; justify-content: center; font-size: 11px; text-decoration: none;">
                                                <i class="fa-solid fa-xmark"></i>
                                            </a>
                                            <img class="admin-gallery-img" src="{{ url('/core/public/storage/images/'.$gallery->photo) }}" style="width: 85px; height: 85px; object-fit: cover; border-radius: 8px; border: 1px solid #e2e8f0;">
                                        </div>
                                    @endforeach
                                @endif
                                <div class="d-block gallery_image_view"></div>
                            </div>
                        </div>
                        <div class="position-relative">
                            <label class="file w-100">
                                <input type="file" accept="image/*" name="galleries[]" id="gallery_file" aria-label="File browser example" multiple>
                                <span class="file-custom text-left">{{ __('Upload Additional Gallery Images...') }}</span>
                            </label>
                            <small class="text-muted d-block mt-2 font-weight-bold">
                                <i class="fa-solid fa-circle-info text-info mr-1"></i> {{ __('Recommended image size: 800 x 800 px (Upload multiple files).') }}
                            </small>
                        </div>
                    </div>
                </div>

                <!-- Descriptions Card -->
                <div class="card-modern mb-4">
                    <div class="card-modern-header">
                        <h6 class="font-weight-bold text-dark mb-0 d-flex align-items-center">
                            <i class="fa-solid fa-align-left text-primary mr-2"></i> {{ __('Product Descriptions') }}
                        </h6>
                    </div>
                    <div class="card-modern-body p-4">
                        <div class="form-group mb-4">
                            <label for="sort_details" class="form-label font-weight-bold text-dark">{{ __('Short Summary') }} *</label>
                            <textarea name="sort_details" id="sort_details" class="form-control" rows="3" placeholder="{{ __('Brief highlight summary of this affiliate product...') }}">{{ $item->sort_details }}</textarea>
                        </div>

                        <div class="form-group mb-0">
                            <label for="details" class="form-label font-weight-bold text-dark">{{ __('Full Detailed Description') }} *</label>
                            <textarea name="details" id="details" class="form-control text-editor" rows="6" placeholder="{{ __('Enter full product review, features, and details...') }}">{{ $item->details }}</textarea>
                        </div>
                    </div>
                </div>

                <!-- Tags & Specifications Card -->
                <div class="card-modern mb-4">
                    <div class="card-modern-header">
                        <h6 class="font-weight-bold text-dark mb-0 d-flex align-items-center">
                            <i class="fa-solid fa-sliders text-secondary mr-2"></i> {{ __('Tags & Technical Specifications') }}
                        </h6>
                    </div>
                    <div class="card-modern-body p-4">
                        <div class="form-group mb-4">
                            <label for="tags" class="form-label font-weight-bold text-dark">{{ __('Product Tags') }}</label>
                            <input type="text" name="tags" class="tags form-control" id="tags" placeholder="{{ __('Tags (Press enter after each tag)') }}" value="{{ $item->tags }}">
                        </div>

                        <div class="form-group mb-3">
                            <label class="switch-primary">
                                <input type="checkbox" class="switch switch-bootstrap status radio-check" name="is_specification" value="1" {{ $item->is_specification == 1 ? 'checked' : '' }}>
                                <span class="switch-body"></span>
                                <span class="switch-text font-weight-bold text-dark">{{ __('Enable Specifications') }}</span>
                            </label>
                        </div>

                        <div id="specifications-section" class="{{ $item->is_specification == 0 ? 'd-none' : '' }}">
                            @if(!empty($specification_name))
                                @foreach(array_combine($specification_name, $specification_description) as $name => $description)
                                    <div class="d-flex">
                                        <div class="flex-grow-1">
                                            <div class="form-group">
                                                <input type="text" class="form-control" name="specification_name[]" placeholder="{{ __('Specification Name') }}" value="{{ $name }}">
                                            </div>
                                        </div>
                                        <div class="flex-grow-1">
                                            <div class="form-group">
                                                <input type="text" class="form-control" name="specification_description[]" placeholder="{{ __('Specification description') }}" value="{{ $description }}">
                                            </div>
                                        </div>
                                        <div class="flex-btn">
                                            @if($loop->first)
                                                <button type="button" class="btn btn-success add-specification" data-text="{{ __('Specification Name') }}" data-text1="{{ __('Specification Description') }}" title="{{ __('Add Specification') }}">
                                                    <i class="fa fa-plus"></i>
                                                </button>
                                            @else
                                                <button type="button" class="btn btn-danger remove-spcification" data-text="{{ __('Specification Name') }}" data-text1="{{ __('Specification Description') }}" title="{{ __('Remove Specification') }}">
                                                    <i class="fa fa-minus"></i>
                                                </button>
                                            @endif
                                        </div>
                                    </div>
                                @endforeach
                            @else
                                <div class="d-flex">
                                    <div class="flex-grow-1">
                                        <div class="form-group">
                                            <input type="text" class="form-control" name="specification_name[]" placeholder="{{ __('Specification Name') }}" value="">
                                        </div>
                                    </div>
                                    <div class="flex-grow-1">
                                        <div class="form-group">
                                            <input type="text" class="form-control" name="specification_description[]" placeholder="{{ __('Specification description') }}" value="">
                                        </div>
                                    </div>
                                    <div class="flex-btn">
                                        <button type="button" class="btn btn-success add-specification" data-text="{{ __('Specification Name') }}" data-text1="{{ __('Specification Description') }}" title="{{ __('Add Specification') }}">
                                            <i class="fa fa-plus"></i>
                                        </button>
                                    </div>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>

                <!-- SEO Meta Card -->
                <div class="card-modern mb-4">
                    <div class="card-modern-header">
                        <h6 class="font-weight-bold text-dark mb-0 d-flex align-items-center">
                            <i class="fa-solid fa-magnifying-glass text-info mr-2"></i> {{ __('Search Engine Optimization (SEO)') }}
                        </h6>
                    </div>
                    <div class="card-modern-body p-4">
                        <div class="form-group mb-3">
                            <label for="meta_keywords" class="form-label font-weight-bold text-dark">{{ __('Meta Keywords') }}</label>
                            <input type="text" name="meta_keywords" class="tags form-control" id="meta_keywords" placeholder="{{ __('Enter Meta Keywords') }}" value="{{ $item->meta_keywords }}">
                        </div>

                        <div class="form-group mb-0">
                            <label for="meta_description" class="form-label font-weight-bold text-dark">{{ __('Meta Description') }}</label>
                            <textarea name="meta_description" id="meta_description" class="form-control" rows="4" placeholder="{{ __('Brief description for search engines snippet...') }}">{{ $item->meta_description }}</textarea>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Right 4 Columns Sidebar -->
            <div class="col-lg-4">
                <!-- Action / Save Card -->
                <div class="card-modern mb-4 sticky-action-card">
                    <div class="card-modern-header">
                        <h6 class="font-weight-bold text-dark mb-0 d-flex align-items-center">
                            <i class="fa-solid fa-rocket text-primary mr-2"></i> {{ __('Publish Actions') }}
                        </h6>
                    </div>
                    <div class="card-modern-body p-3">
                        <input type="hidden" class="check_button" name="is_button" value="0">
                        <div class="d-flex align-items-center" style="gap: 10px;">
                            <button type="submit" class="btn btn-primary flex-grow-1 font-weight-bold d-flex align-items-center justify-content-center" style="border-radius: 10px; background: linear-gradient(135deg, #10b981, #059669); border: none; padding: 10px 12px; font-size: 13.5px; box-shadow: 0 4px 12px rgba(79, 70, 229, 0.25); height: 42px;">
                                <i class="fa-solid fa-floppy-disk mr-1"></i> {{ __('Update') }}
                            </button>
                            <button type="submit" class="btn btn-info flex-grow-1 save__edit font-weight-bold d-flex align-items-center justify-content-center" style="border-radius: 10px; background: linear-gradient(135deg, #06b6d4, #0ea5e9); border: none; color: #ffffff; padding: 10px 12px; font-size: 13.5px; box-shadow: 0 4px 12px rgba(14, 165, 233, 0.25); height: 42px;">
                                <i class="fa-solid fa-pen-to-square mr-1"></i> {{ __('Save & Edit') }}
                            </button>
                        </div>
                    </div>
                </div>

                <!-- Pricing Card -->
                <div class="card-modern mb-4">
                    <div class="card-modern-header">
                        <h6 class="font-weight-bold text-dark mb-0 d-flex align-items-center">
                            <i class="fa-solid fa-tags text-success mr-2"></i> {{ __('Pricing Configuration') }}
                        </h6>
                    </div>
                    <div class="card-modern-body p-4">
                        <div class="form-group mb-3">
                            <label for="discount_price" class="form-label font-weight-bold text-dark">{{ __('Current Display Price') }} *</label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text bg-light font-weight-bold text-dark">{{ $curr->sign }}</span>
                                </div>
                                <input type="text" id="discount_price" name="discount_price" class="form-control font-weight-bold" placeholder="{{ __('0.00') }}" min="1" step="0.1" value="{{ round($item->discount_price * $curr->value, 2) }}" required>
                            </div>
                        </div>

                        <div class="form-group mb-0">
                            <label for="previous_price" class="form-label font-weight-bold text-dark">{{ __('Previous / Original Price') }}</label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text bg-light font-weight-bold text-dark">{{ $curr->sign }}</span>
                                </div>
                                <input type="text" id="previous_price" name="previous_price" class="form-control" placeholder="{{ __('0.00') }}" min="1" step="0.1" value="{{ round($item->previous_price * $curr->value, 2) }}">
                            </div>
                            <small class="text-muted mt-1 d-block">{{ __('Leave blank or 0 if no discount is running.') }}</small>
                        </div>
                    </div>
                </div>

                <!-- Categories & Brand Card -->
                <div class="card-modern mb-4">
                    <div class="card-modern-header">
                        <h6 class="font-weight-bold text-dark mb-0 d-flex align-items-center">
                            <i class="fa-solid fa-folder-tree text-warning mr-2"></i> {{ __('Category & Brand') }}
                        </h6>
                    </div>
                    <div class="card-modern-body p-4">
                        <div class="form-group mb-3">
                            <label for="category_id" class="form-label font-weight-bold text-dark">{{ __('Select Category') }} *</label>
                            <select name="category_id" id="category_id" data-href="{{route('back.get.subcategory')}}" class="form-control font-weight-bold" required>
                                @foreach(DB::table('categories')->whereStatus(1)->get() as $cat)
                                <option value="{{ $cat->id }}" {{ $cat->id == $item->category_id ? 'selected' : '' }}>{{ $cat->name }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group mb-3">
                            <label for="subcategory_id" class="form-label font-weight-bold text-dark">{{ __('Select Sub Category') }}</label>
                            <select name="subcategory_id" id="subcategory_id" class="form-control" data-href="{{route('back.get.childcategory')}}">
                                <option value="">{{__('Select Sub Category')}}</option>
                                @foreach(DB::table('subcategories')->where('category_id',$item->category_id)->whereStatus(1)->get() as $subcat)
                                <option value="{{ $subcat->id }}" {{ $subcat->id == $item->subcategory_id ? 'selected' : '' }}>{{ $subcat->name }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group mb-3">
                            <label for="childcategory_id" class="form-label font-weight-bold text-dark">{{ __('Select Child Category') }}</label>
                            <select name="childcategory_id" id="childcategory_id" class="form-control">
                                <option value="">{{__('Select Child Category')}}</option>
                                @foreach(DB::table('chield_categories')->where('category_id',$item->category_id)->whereStatus(1)->get() as $chieldcategory)
                                <option value="{{ $chieldcategory->id }}" {{ $chieldcategory->id == $item->childcategory_id ? 'selected' : '' }}>{{ $chieldcategory->name }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group mb-0">
                            <label for="brand_id" class="form-label font-weight-bold text-dark">{{ __('Select Brand') }}</label>
                            <select name="brand_id" id="brand_id" class="form-control">
                                <option value="" selected>{{__('Select Brand (Optional)')}}</option>
                                @foreach(DB::table('brands')->whereStatus(1)->get() as $brand)
                                <option value="{{ $brand->id }}" {{$brand->id == $item->brand_id ? 'selected' : ''}} >{{ $brand->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>

                <!-- Identifiers & Video Card -->
                <div class="card-modern mb-4">
                    <div class="card-modern-header">
                        <h6 class="font-weight-bold text-dark mb-0 d-flex align-items-center">
                            <i class="fa-solid fa-barcode text-danger mr-2"></i> {{ __('Product Identifiers & Media') }}
                        </h6>
                    </div>
                    <div class="card-modern-body p-4">
                        <div class="form-group mb-3">
                            <label for="sku" class="form-label font-weight-bold text-dark">{{ __('SKU / Product Code') }} *</label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text bg-light"><i class="fa-solid fa-fingerprint text-muted"></i></span>
                                </div>
                                <input type="text" name="sku" class="form-control font-weight-bold" id="sku" placeholder="{{ __('Enter SKU') }}" value="{{$item->sku}}" required style="font-family: monospace;">
                            </div>
                        </div>

                        <div class="form-group mb-0">
                            <label for="video" class="form-label font-weight-bold text-dark">{{ __('Video Link (YouTube / Vimeo)') }}</label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text bg-light"><i class="fa-brands fa-youtube text-danger"></i></span>
                                </div>
                                <input type="text" name="video" class="form-control" id="video" placeholder="https://youtube.com/watch?v=..." value="{{$item->video}}">
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </form>
</div>

@endsection
