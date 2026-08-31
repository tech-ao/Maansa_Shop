@extends('master.back')

@section('content')

<div class="container-fluid">

	<!-- Page Header Banner -->
    <div class="dash-hero-banner mb-4">
        <div class="dash-hero-content">
            <div class="dash-hero-text">
                <h2><i class="fa-solid fa-certificate mr-2" style="font-size: 22px;"></i> {{ __('Edit License Product') }}</h2>
                <p>{{ __('Update downloadable digital software, activation licenses, media assets, and pricing for: ') }}<span class="font-weight-bold text-white">{{ $item->name }}</span></p>
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
    <form class="admin-form" action="{{ route('back.item.update', $item->id) }}" method="POST" enctype="multipart/form-data">
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
                                    <span class="file-custom text-left">{{ __('Upload Image...') }}</span>
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
                        <div class="form-group pb-0 pt-0 mt-0 mb-2">
                            <div id="gallery-images">
                                <div class="d-block gallery_image_view">
                                    @forelse($item->galleries as $gallery)
                                        <div class="single-g-item d-inline-block m-2 position-relative" style="border-radius: 10px; overflow: hidden; box-shadow: 0 2px 6px rgba(0,0,0,0.06); border: 1px solid #e2e8f0;">
                                            <span data-toggle="modal" data-target="#confirm-delete" href="javascript:;" data-href="{{ route('back.item.gallery.delete', $gallery->id) }}" class="remove-gallery-img" style="cursor: pointer;">
                                                <i class="fas fa-trash"></i>
                                            </span>
                                            <a class="popup-link" href="{{ $gallery->photo ? url('/core/public/storage/images/'.$gallery->photo) : url('/core/public/storage/images/placeholder.png') }}">
                                                <img class="admin-gallery-img" src="{{ $gallery->photo ? url('/core/public/storage/images/'.$gallery->photo) : url('/core/public/storage/images/placeholder.png') }}" alt="Gallery Image" style="width: 85px; height: 85px; object-fit: cover;">
                                            </a>
                                        </div>
                                    @empty
                                        <h6 class="text-muted mb-0 font-weight-bold"><i class="fa-solid fa-image mr-1"></i> {{ __('No additional gallery images added.') }}</h6>
                                    @endforelse
                                </div>
                            </div>
                        </div>
                        <div class="position-relative">
                            <label class="file w-100">
                                <input type="file" accept="image/*" name="galleries[]" id="gallery_file" aria-label="File browser example" multiple>
                                <span class="file-custom text-left">{{ __('Upload Gallery Images...') }}</span>
                            </label>
                            <small class="text-muted d-block mt-2 font-weight-bold">
                                <i class="fa-solid fa-circle-info text-info mr-1"></i> {{ __('Recommended image size: 800 x 800 px (Upload multiple files).') }}
                            </small>
                        </div>
                    </div>
                </div>

                <!-- Download Deliverable Card -->
                <div class="card-modern mb-4">
                    <div class="card-modern-header">
                        <h6 class="font-weight-bold text-dark mb-0 d-flex align-items-center">
                            <i class="fa-solid fa-file-zipper text-purple mr-2"></i> {{ __('Downloadable Deliverable') }} *
                        </h6>
                    </div>
                    <div class="card-modern-body p-4">
                        <div class="form-group mb-3">
                            <label for="file_type" class="form-label font-weight-bold text-dark">{{ __('Deliverable Delivery Method') }} *</label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text bg-light"><i class="fa-solid fa-boxes-packing text-muted"></i></span>
                                </div>
                                <select class="form-control font-weight-bold" id="file_type" name="file_type">
                                    <option value="file" {{ $item->file_type == 'file' ? 'selected' : '' }}>{{ __('Upload File (.ZIP)') }}</option>
                                    <option value="link" {{ $item->file_type == 'link' ? 'selected' : '' }}>{{ __('External Direct Link (URL)') }}</option>
                                </select>
                            </div>
                        </div>

                        <div class="form-group view_file mb-0 {{ $item->file_type == 'file' ? '' : 'd-none' }}">
                            <label for="file" class="form-label font-weight-bold text-dark">{{ __('Upload Zip Package') }}</label>
                            <div class="input-group mb-2">
                                <input type="file" class="form-control" id="file" name="file">
                            </div>
                            @if (file_exists('assets/files/'.$item->file) && $item->file)
                                <div class="mb-2">
                                    <a download href="{{ asset('assets/files/'.$item->file) }}" class="btn btn-sm btn-outline-primary" style="border-radius: 8px;">
                                        <i class="fa-solid fa-cloud-arrow-down mr-1"></i> {{ __('Download Current File') }}
                                    </a>
                                </div>
                            @endif
                            <small class="text-warning font-weight-bold"><i class="fa-solid fa-file-zipper mr-1"></i> {{ __('File package format must be .zip') }}</small>
                        </div>

                        <div class="form-group view_link mb-0 {{ $item->file_type == 'link' ? '' : 'd-none' }}">
                            <label for="link" class="form-label font-weight-bold text-dark">{{ __('External Download Link URL') }} *</label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text bg-light"><i class="fa-solid fa-globe text-muted"></i></span>
                                </div>
                                <input type="text" id="link" name="link" class="form-control" value="{{ $item->link }}" placeholder="https://example.com/download/software.zip">
                            </div>
                        </div>
                    </div>
                </div>

                <!-- License Keys Card -->
                <div class="card-modern mb-4">
                    <div class="card-modern-header d-flex justify-content-between align-items-center">
                        <h6 class="font-weight-bold text-dark mb-0 d-flex align-items-center">
                            <i class="fa-solid fa-key text-success mr-2"></i> {{ __('License / Activation Keys') }} *
                        </h6>
                    </div>
                    <div class="card-modern-body p-4">
                        <div id="license-section">
                            @if(!empty($license_name))
                                @foreach(array_combine($license_name, $license_key) as $name => $key)
                                    <div class="d-flex">
                                        <div class="flex-grow-1">
                                            <div class="form-group">
                                                <input type="text" class="form-control" name="license_name[]" placeholder="{{ __('License Name') }}" value="{{ $name }}">
                                            </div>
                                        </div>
                                        <div class="flex-grow-1">
                                            <div class="form-group">
                                                <input type="text" class="form-control" name="license_key[]" placeholder="{{ __('License Key') }}" value="{{ $key }}" style="font-family: monospace;">
                                            </div>
                                        </div>
                                        <div class="flex-btn">
                                            @if($loop->first)
                                                <button type="button" class="btn btn-success add-license" data-text="{{ __('License Name') }}" data-text1="{{ __('License Key') }}" title="{{ __('Add Row') }}">
                                                    <i class="fa fa-plus"></i>
                                                </button>
                                            @else
                                                <button type="button" class="btn btn-danger remove-license" title="{{ __('Remove Row') }}">
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
                                            <input type="text" class="form-control" name="license_name[]" placeholder="{{ __('License Name (e.g., Personal License, Pro Key)') }}" value="">
                                        </div>
                                    </div>
                                    <div class="flex-grow-1">
                                        <div class="form-group">
                                            <input type="text" class="form-control" name="license_key[]" placeholder="{{ __('License Key (e.g., XXXX-XXXX-XXXX)') }}" value="" style="font-family: monospace;">
                                        </div>
                                    </div>
                                    <div class="flex-btn">
                                        <button type="button" class="btn btn-success add-license" data-text="{{ __('License Name') }}" data-text1="{{ __('License Key') }}" title="{{ __('Add Row') }}">
                                            <i class="fa fa-plus"></i>
                                        </button>
                                    </div>
                                </div>
                            @endif
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
                            <textarea name="sort_details" id="sort_details" class="form-control" rows="3" placeholder="{{ __('Brief highlight summary of this license product...') }}">{{ $item->sort_details }}</textarea>
                        </div>

                        <div class="form-group mb-0">
                            <label for="details" class="form-label font-weight-bold text-dark">{{ __('Full Detailed Description') }} *</label>
                            <textarea name="details" id="details" class="form-control text-editor" rows="6" placeholder="{{ __('Enter full product description, features, and requirements...') }}">{{ $item->details }}</textarea>
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
                                                <input type="text" class="form-control" name="specification_description[]" placeholder="{{ __('Specification Description') }}" value="{{ $description }}">
                                            </div>
                                        </div>
                                        <div class="flex-btn">
                                            @if($loop->first)
                                                <button type="button" class="btn btn-success add-specification" data-text="{{ __('Specification Name') }}" data-text1="{{ __('Specification Description') }}" title="{{ __('Add Row') }}">
                                                    <i class="fa fa-plus"></i>
                                                </button>
                                            @else
                                                <button type="button" class="btn btn-danger remove-spcification" title="{{ __('Remove Row') }}">
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
                                            <input type="text" class="form-control" name="specification_name[]" placeholder="{{ __('Specification Name (e.g., Compatible OS)') }}" value="">
                                        </div>
                                    </div>
                                    <div class="flex-grow-1">
                                        <div class="form-group">
                                            <input type="text" class="form-control" name="specification_description[]" placeholder="{{ __('Specification Value (e.g., Windows 10/11, macOS)') }}" value="">
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
                            <button type="submit" class="btn btn-primary flex-grow-1 font-weight-bold d-flex align-items-center justify-content-center" style="border-radius: 10px; background: linear-gradient(135deg, #4f46e5, #3b82f6); border: none; padding: 10px 12px; font-size: 13.5px; box-shadow: 0 4px 12px rgba(79, 70, 229, 0.25); height: 42px;">
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
                            <label for="discount_price" class="form-label font-weight-bold text-dark">{{ __('Current Sale Price') }} *</label>
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
                                @foreach(DB::table('subcategories')->where('category_id', $item->category_id)->whereStatus(1)->get() as $subcat)
                                <option value="{{ $subcat->id }}" {{ $subcat->id == $item->subcategory_id ? 'selected' : '' }}>{{ $subcat->name }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group mb-3">
                            <label for="childcategory_id" class="form-label font-weight-bold text-dark">{{ __('Select Child Category') }}</label>
                            <select name="childcategory_id" id="childcategory_id" class="form-control">
                                <option value="">{{__('Select Child Category')}}</option>
                                @foreach(DB::table('chield_categories')->where('category_id', $item->category_id)->whereStatus(1)->get() as $chieldcategory)
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

                <!-- Tax, SKU & Video Card -->
                <div class="card-modern mb-4">
                    <div class="card-modern-header">
                        <h6 class="font-weight-bold text-dark mb-0 d-flex align-items-center">
                            <i class="fa-solid fa-barcode text-danger mr-2"></i> {{ __('Tax & Identifiers') }}
                        </h6>
                    </div>
                    <div class="card-modern-body p-4">
                        <div class="form-group mb-3">
                            <label for="tax_id" class="form-label font-weight-bold text-dark">{{ __('Select Tax Bracket') }} *</label>
                            <select name="tax_id" id="tax_id" class="form-control font-weight-bold" required>
                                <option value="">{{__('Select Tax Rate')}}</option>
                                @foreach(DB::table('taxes')->whereStatus(1)->get() as $tax)
                                <option value="{{ $tax->id }}" {{$item->tax_id == $tax->id ? 'selected' : ''}} >{{ $tax->name }} ({{ $tax->value }}%)</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group mb-3">
                            <label for="sku" class="form-label font-weight-bold text-dark">{{ __('SKU / Product Code') }} *</label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text bg-light"><i class="fa-solid fa-fingerprint text-muted"></i></span>
                                </div>
                                <input type="text" name="sku" class="form-control font-weight-bold" id="sku" placeholder="{{ __('Enter SKU') }}" value="{{ $item->sku }}" required style="font-family: monospace;">
                            </div>
                        </div>

                        <div class="form-group mb-0">
                            <label for="video" class="form-label font-weight-bold text-dark">{{ __('Video Link (YouTube / Vimeo)') }}</label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text bg-light"><i class="fa-brands fa-youtube text-danger"></i></span>
                                </div>
                                <input type="text" name="video" class="form-control" id="video" placeholder="https://youtube.com/watch?v=..." value="{{ $item->video }}">
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </form>

</div>

{{-- DELETE MODAL FOR GALLERY IMAGES --}}
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
                <div class="mb-3">
                    <div class="d-inline-flex align-items-center justify-content-center bg-danger-light text-danger rounded-circle" style="width: 60px; height: 60px; font-size: 24px; background: #fee2e2;">
                        <i class="fas fa-trash-can text-danger"></i>
                    </div>
                </div>
                <h5 class="font-weight-bold text-dark mb-2">{{ __('Delete This Gallery Image?') }}</h5>
                <p class="text-muted mb-0">
                    {{ __('You are going to delete this gallery image permanently.') }}
                </p>
            </div>
            <div class="modal-footer bg-light border-0 py-3 d-flex justify-content-center">
                <button type="button" class="btn btn-secondary px-4" style="border-radius: 10px; font-weight: 700;" data-dismiss="modal">{{ __('Cancel') }}</button>
                <a class="btn btn-danger btn-ok px-4" style="border-radius: 10px; font-weight: 700;">{{ __('Delete Image') }}</a>
            </div>
        </div>
    </div>
</div>
{{-- DELETE MODAL ENDS --}}

@endsection

@section('scripts')
    <script>
        $(document).on('change','#file_type',function(){
            let type = $(this).val();
            if(type == 'file'){
                $('.view_link').addClass('d-none');
                $('.view_file').removeClass('d-none');
                $('.view_file input').prop('required',true);
                $('.view_link input').prop('required',false);
            }else{
                $('.view_link').removeClass('d-none');
                $('.view_file').addClass('d-none');
                $('.view_file input').prop('required',false);
                $('.view_link input').prop('required',true);
            }
        })
    </script>
@endsection