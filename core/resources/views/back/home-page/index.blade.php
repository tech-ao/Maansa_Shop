@extends('master.back')
@section('styles')
    <link rel="stylesheet" href="{{asset('assets/back/css/select2.css')}}">
@endsection
@section('content')

<!-- Start of Main Content -->
<div class="container-fluid">

    <!-- Page Header Banner -->
    <div class="dash-hero-banner mb-4">
        <div class="dash-hero-content">
            <div class="dash-hero-text">
                <h2><i class="fa-solid fa-images mr-2" style="font-size: 22px;"></i> {{ __('Homepage Banners & Layouts') }}</h2>
                <p>{{ __('Customize homepage promo banners, hero sliders, category blocks, and featured display sections.') }}</p>
            </div>
            <ul class="profile-breadcrumb">
                <li><a href="{{ route('back.dashboard') }}"><i class="fa-solid fa-house"></i> {{ __('Dashboard') }}</a></li>
                <span class="divider">/</span>
                <li>{{ __('Manage Site') }}</li>
                <span class="divider">/</span>
                <li class="active">{{ __('Homepage Banners') }}</li>
            </ul>
        </div>
    </div>

    <!-- Main Layout Row -->
    <div class="row">
        <!-- Navigation Pills Column -->
        <div class="col-xl-3 col-lg-4 col-12 mb-4">
            <div class="nav settings-nav-pills" id="v-pills-tab" role="tablist" aria-orientation="vertical">
                <a class="nav-link active" id="v-pills-t9-tab" data-toggle="pill" href="#v-pills-t9" role="tab" aria-controls="v-pills-t9" aria-selected="true">
                    <i class="fa-solid fa-panorama"></i>
                    <span>{{ __('Hero Section Banner') }}</span>
                </a>
                <a class="nav-link" id="v-pills-t1-tab" data-toggle="pill" href="#v-pills-t1" role="tab" aria-controls="v-pills-t1" aria-selected="false">
                    <i class="fa-solid fa-table-columns"></i>
                    <span>{{ __('3 Column Banner First') }}</span>
                </a>
                <a class="nav-link" id="v-pills-t2-tab" data-toggle="pill" href="#v-pills-t2" role="tab" aria-controls="v-pills-t2" aria-selected="false">
                    <i class="fa-solid fa-fire"></i>
                    <span>{{ __('Popular Categories') }}</span>
                </a>
                <a class="nav-link" id="v-pills-t5-tab" data-toggle="pill" href="#v-pills-t5" role="tab" aria-controls="v-pills-t5" aria-selected="false">
                    <i class="fa-solid fa-table-cells"></i>
                    <span>{{ __('3 Column Banner Second') }}</span>
                </a>
                <a class="nav-link" id="v-pills-t3-tab" data-toggle="pill" href="#v-pills-t3" role="tab" aria-controls="v-pills-t3" aria-selected="false">
                    <i class="fa-solid fa-layer-group"></i>
                    <span>{{ __('Three Column Category') }}</span>
                </a>
                <a class="nav-link" id="v-pills-t4-tab" data-toggle="pill" href="#v-pills-t4" role="tab" aria-controls="v-pills-t4" aria-selected="false">
                    <i class="fa-solid fa-star"></i>
                    <span>{{ __('Featured Categories') }}</span>
                </a>
                <a class="nav-link" id="v-pills-t6-tab" data-toggle="pill" href="#v-pills-t6" role="tab" aria-controls="v-pills-t6" aria-selected="false">
                    <i class="fa-solid fa-columns"></i>
                    <span>{{ __('2 Column Banner') }}</span>
                </a>
                <a class="nav-link" id="v-pills-t7-tab" data-toggle="pill" href="#v-pills-t7" role="tab" aria-controls="v-pills-t7" aria-selected="false">
                    <i class="fa-solid fa-grip"></i>
                    <span>{{ __('Home 4 Banner (5 Col)') }}</span>
                </a>
                <a class="nav-link" id="v-pills-t8-tab" data-toggle="pill" href="#v-pills-t8" role="tab" aria-controls="v-pills-t8" aria-selected="false">
                    <i class="fa-solid fa-cubes"></i>
                    <span>{{ __('Home 4 Popular Categories') }}</span>
                </a>
            </div>
        </div>

        <!-- Content Panes Column -->
        <div class="col-xl-9 col-lg-8 col-12 mb-4">
            <div class="card-modern">
                <div class="card-modern-body">
                    @include('alerts.alerts')

                    <div class="tab-content" id="v-pills-tabContent">
                        
                        {{-- 1. HERO SECTION BANNER --}}
                        <div class="tab-pane fade show active" id="v-pills-t9" role="tabpanel" aria-labelledby="v-pills-t9-tab">
                            <div class="settings-tab-pane-title mb-4">
                                <i class="fa-solid fa-panorama text-primary mr-1"></i> {{ __('Hero Section Promo Banners') }}
                            </div>
                            <form class="admin-form" action="{{route('back.hero.banner.update')}}" method="POST" enctype="multipart/form-data">
                                @csrf

                                <!-- Banner 1 -->
                                <div class="settings-section-card mb-4">
                                    <h6 class="section-card-title"><i class="fa-solid fa-image text-primary mr-1"></i> {{ __('Banner 1 (Top / Primary)') }}</h6>
                                    <div class="row align-items-center mb-3">
                                        <div class="col-12 col-sm-auto mb-2 mb-sm-0">
                                            <div style="width: 140px; height: 75px; border-radius: 10px; overflow: hidden; background: #ffffff; border: 1px solid #cbd5e1; display: flex; align-items: center; justify-content: center;">
                                                <img class="admin-img" style="width: 100%; height: 100%; object-fit: cover;"
                                                    src="{{isset($hero_banner['img1']) ? url('/core/public/storage/images/'.$hero_banner['img1']) : url('/core/public/storage/images/placeholder.png') }}"
                                                    alt="Banner 1" onerror="this.onerror=null; this.src='{{ url('/core/public/storage/images/placeholder.png') }}';">
                                            </div>
                                        </div>
                                        <div class="col-12 col-sm">
                                            <div class="position-relative mb-2">
                                                <label class="file">
                                                    <input type="file" accept="image/*" class="upload-photo" name="img1" id="file_h1" aria-label="Upload Image">
                                                    <span class="file-custom text-left">{{ __('Choose Image 1...') }}</span>
                                                </label>
                                            </div>
                                            <span class="text-muted d-block" style="font-size: 12px;"><i class="fa-solid fa-circle-info text-primary mr-1"></i> {{ __('Recommended Image Size: 496 x 204 pixels.') }}</span>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-6 mb-3">
                                            <label for="title1" class="form-label font-weight-bold">{{ __('Banner Title') }} *</label>
                                            <input type="text" name="title1" class="form-control" id="title1" placeholder="{{ __('Enter Title') }}" value="{{isset($hero_banner['title1']) ? $hero_banner['title1'] : ''}}">
                                        </div>
                                        <div class="col-md-6 mb-3">
                                            <label for="subtitle1" class="form-label font-weight-bold">{{ __('Banner Subtitle') }}</label>
                                            <input type="text" name="subtitle1" class="form-control" id="subtitle1" placeholder="{{ __('Enter Subtitle') }}" value="{{isset($hero_banner['subtitle1']) ? $hero_banner['subtitle1'] : ''}}">
                                        </div>
                                        <div class="col-12 mb-2">
                                            <label for="url1" class="form-label font-weight-bold">{{ __('Target URL / Link') }} *</label>
                                            <div class="input-group">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text bg-light"><i class="fa-solid fa-link text-muted"></i></span>
                                                </div>
                                                <input type="text" name="url1" class="form-control" id="url1" placeholder="{{ __('e.g. https://... or /products') }}" value="{{isset($hero_banner['url1']) ? $hero_banner['url1'] : ''}}">
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!-- Banner 2 -->
                                <div class="settings-section-card mb-4">
                                    <h6 class="section-card-title"><i class="fa-solid fa-image text-primary mr-1"></i> {{ __('Banner 2 (Bottom / Secondary)') }}</h6>
                                    <div class="row align-items-center mb-3">
                                        <div class="col-12 col-sm-auto mb-2 mb-sm-0">
                                            <div style="width: 140px; height: 75px; border-radius: 10px; overflow: hidden; background: #ffffff; border: 1px solid #cbd5e1; display: flex; align-items: center; justify-content: center;">
                                                <img class="admin-img" style="width: 100%; height: 100%; object-fit: cover;"
                                                    src="{{isset($hero_banner['img2']) ? url('/core/public/storage/images/'.$hero_banner['img2']) : url('/core/public/storage/images/placeholder.png') }}"
                                                    alt="Banner 2" onerror="this.onerror=null; this.src='{{ url('/core/public/storage/images/placeholder.png') }}';">
                                            </div>
                                        </div>
                                        <div class="col-12 col-sm">
                                            <div class="position-relative mb-2">
                                                <label class="file">
                                                    <input type="file" accept="image/*" class="upload-photo" name="img2" id="file_h2" aria-label="Upload Image">
                                                    <span class="file-custom text-left">{{ __('Choose Image 2...') }}</span>
                                                </label>
                                            </div>
                                            <span class="text-muted d-block" style="font-size: 12px;"><i class="fa-solid fa-circle-info text-primary mr-1"></i> {{ __('Recommended Image Size: 496 x 204 pixels.') }}</span>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-6 mb-3">
                                            <label for="title2" class="form-label font-weight-bold">{{ __('Banner Title') }} *</label>
                                            <input type="text" name="title2" class="form-control" id="title2" placeholder="{{ __('Enter Title') }}" value="{{isset($hero_banner['title2']) ? $hero_banner['title2'] : ''}}">
                                        </div>
                                        <div class="col-md-6 mb-3">
                                            <label for="subtitle2" class="form-label font-weight-bold">{{ __('Banner Subtitle') }}</label>
                                            <input type="text" name="subtitle2" class="form-control" id="subtitle2" placeholder="{{ __('Enter Subtitle') }}" value="{{isset($hero_banner['subtitle2']) ? $hero_banner['subtitle2'] : ''}}">
                                        </div>
                                        <div class="col-12 mb-2">
                                            <label for="url2" class="form-label font-weight-bold">{{ __('Target URL / Link') }} *</label>
                                            <div class="input-group">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text bg-light"><i class="fa-solid fa-link text-muted"></i></span>
                                                </div>
                                                <input type="text" name="url2" class="form-control" id="url2" placeholder="{{ __('e.g. https://... or /products') }}" value="{{isset($hero_banner['url2']) ? $hero_banner['url2'] : ''}}">
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="d-flex justify-content-end mt-4">
                                    <button type="submit" class="btn btn-primary px-4 py-2" style="border-radius: 10px; font-weight: 700; background: linear-gradient(135deg, #4f46e5, #3b82f6); border: none; box-shadow: 0 4px 12px rgba(79, 70, 229, 0.3);">
                                        <i class="fa-solid fa-floppy-disk mr-1"></i> {{ __('Save Hero Banners') }}
                                    </button>
                                </div>
                            </form>
                        </div>

                        {{-- 2. THREE COLUMN BANNER FIRST --}}
                        <div class="tab-pane fade" id="v-pills-t1" role="tabpanel" aria-labelledby="v-pills-t1-tab">
                            <div class="settings-tab-pane-title mb-4">
                                <i class="fa-solid fa-table-columns text-primary mr-1"></i> {{ __('3 Column Promo Banner (First Section)') }}
                            </div>
                            <form class="admin-form" action="{{route('back.first.banner.update')}}" method="POST" enctype="multipart/form-data">
                                @csrf

                                @for($i = 1; $i <= 3; $i++)
                                <div class="settings-section-card mb-4">
                                    <h6 class="section-card-title"><i class="fa-solid fa-image text-primary mr-1"></i> {{ __('Banner Column :i', ['i' => $i]) }}</h6>
                                    <div class="row align-items-center mb-3">
                                        <div class="col-12 col-sm-auto mb-2 mb-sm-0">
                                            <div style="width: 140px; height: 75px; border-radius: 10px; overflow: hidden; background: #ffffff; border: 1px solid #cbd5e1; display: flex; align-items: center; justify-content: center;">
                                                <img class="admin-img" style="width: 100%; height: 100%; object-fit: cover;"
                                                    src="{{ isset($first_banner['img'.$i]) ? url('/core/public/storage/images/'.$first_banner['img'.$i]) : url('/core/public/storage/images/placeholder.png') }}"
                                                    alt="Banner {{ $i }}" onerror="this.onerror=null; this.src='{{ url('/core/public/storage/images/placeholder.png') }}';">
                                            </div>
                                        </div>
                                        <div class="col-12 col-sm">
                                            <div class="position-relative mb-2">
                                                <label class="file">
                                                    <input type="file" accept="image/*" class="upload-photo" name="img{{ $i }}" id="file_f{{ $i }}" aria-label="Upload Image">
                                                    <span class="file-custom text-left">{{ __('Choose Image :i...', ['i' => $i]) }}</span>
                                                </label>
                                            </div>
                                            <span class="text-muted d-block" style="font-size: 12px;"><i class="fa-solid fa-circle-info text-primary mr-1"></i> {{ __('Recommended Image Size: 496 x 204 pixels.') }}</span>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-6 mb-3">
                                            <label for="title_f{{ $i }}" class="form-label font-weight-bold">{{ __('Banner Title') }} *</label>
                                            <input type="text" name="title{{ $i }}" class="form-control" id="title_f{{ $i }}" placeholder="{{ __('Enter Title') }}" value="{{isset($first_banner['title'.$i]) ? $first_banner['title'.$i] : ''}}">
                                        </div>
                                        <div class="col-md-6 mb-3">
                                            <label for="subtitle_f{{ $i }}" class="form-label font-weight-bold">{{ __('Banner Subtitle') }} *</label>
                                            <input type="text" name="subtitle{{ $i }}" class="form-control" id="subtitle_f{{ $i }}" placeholder="{{ __('Enter Subtitle') }}" value="{{isset($first_banner['subtitle'.$i]) ? $first_banner['subtitle'.$i] : ''}}">
                                        </div>
                                        <div class="col-12 mb-2">
                                            <label for="firsturl{{ $i }}" class="form-label font-weight-bold">{{ __('Target URL / Link') }} *</label>
                                            <div class="input-group">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text bg-light"><i class="fa-solid fa-link text-muted"></i></span>
                                                </div>
                                                <input type="text" name="firsturl{{ $i }}" class="form-control" id="firsturl{{ $i }}" placeholder="{{ __('Enter Banner Url') }}" value="{{isset($first_banner['firsturl'.$i]) ? $first_banner['firsturl'.$i] : ''}}">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                @endfor

                                <div class="d-flex justify-content-end mt-4">
                                    <button type="submit" class="btn btn-primary px-4 py-2" style="border-radius: 10px; font-weight: 700; background: linear-gradient(135deg, #4f46e5, #3b82f6); border: none; box-shadow: 0 4px 12px rgba(79, 70, 229, 0.3);">
                                        <i class="fa-solid fa-floppy-disk mr-1"></i> {{ __('Save 3 Column Banner (First)') }}
                                    </button>
                                </div>
                            </form>
                        </div>

                        {{-- 3. POPULAR CATEGORIES --}}
                        <div class="tab-pane fade" id="v-pills-t2" role="tabpanel" aria-labelledby="v-pills-t2-tab">
                            <div class="settings-tab-pane-title mb-4">
                                <i class="fa-solid fa-fire text-primary mr-1"></i> {{ __('Popular Categories Showcase') }}
                            </div>
                            <form class="admin-form" action="{{route('back.popular.category.update')}}" method="POST">
                                @csrf

                                <div class="settings-section-card mb-4">
                                    <h6 class="section-card-title"><i class="fa-solid fa-heading text-primary mr-1"></i> {{ __('Section Header') }}</h6>
                                    <div class="form-group mb-0">
                                        <label for="popular_title" class="form-label font-weight-bold">{{ __('Section Heading Title') }} *</label>
                                        <input type="text" name="popular_title" class="form-control" id="popular_title" placeholder="{{ __('e.g. Popular Categories') }}" value="{{$popular_category['popular_title'] ?? ''}}" required>
                                    </div>
                                </div>

                                @for($i = 1; $i <= 4; $i++)
                                <div class="settings-section-card mb-4">
                                    <h6 class="section-card-title"><i class="fa-solid fa-layer-group text-primary mr-1"></i> {{ __('Category Slot :i', ['i' => $i]) }}</h6>
                                    <div class="row">
                                        <div class="col-md-4 mb-3">
                                            <label for="category_id{{ $i }}" class="form-label font-weight-bold">{{ __('Primary Category') }} *</label>
                                            <select name="category_id{{ $i }}" id="category_id{{ $i }}" data-href="{{route('back.get.subcategory')}}" class="form-control">
                                                <option value="">{{__('Select Primary Category')}}</option>
                                                @foreach(DB::table('categories')->whereStatus(1)->get() as $cat)
                                                    <option value="{{ $cat->id }}" {{isset($popular_category['category_id'.$i]) && $cat->id == $popular_category['category_id'.$i] ? 'selected' : ''}} >{{ $cat->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>

                                        <div class="col-md-4 mb-3">
                                            <label for="subcategory_id{{ $i }}" class="form-label font-weight-bold">{{ __('Sub Category') }}</label>
                                            <select name="subcategory_id{{ $i }}" id="subcategory_id{{ $i }}" class="form-control" data-href="{{route('back.get.childcategory')}}">
                                                <option value="">{{__('Select Sub Category')}}</option>
                                                @if(isset($popular_category['category_id'.$i]))
                                                    @foreach(DB::table('subcategories')->where('category_id', $popular_category['category_id'.$i])->whereStatus(1)->get() as $subcat)
                                                        <option value="{{ $subcat->id }}" {{ isset($popular_category['subcategory_id'.$i]) && $subcat->id == $popular_category['subcategory_id'.$i] ? 'selected' : '' }}>{{ $subcat->name }}</option>
                                                    @endforeach
                                                @endif
                                            </select>
                                        </div>

                                        <div class="col-md-4 mb-3">
                                            <label for="childcategory_id{{ $i }}" class="form-label font-weight-bold">{{ __('Child Category') }}</label>
                                            <select name="childcategory_id{{ $i }}" id="childcategory_id{{ $i }}" class="form-control">
                                                <option value="">{{__('Select Child Category')}}</option>
                                                @if(isset($popular_category['category_id'.$i]))
                                                    @foreach(DB::table('chield_categories')->where('category_id', $popular_category['category_id'.$i])->whereStatus(1)->get() as $chieldcategory)
                                                        <option value="{{ $chieldcategory->id }}" {{ isset($popular_category['childcategory_id'.$i]) && $chieldcategory->id == $popular_category['childcategory_id'.$i] ? 'selected' : '' }}>{{ $chieldcategory->name }}</option>
                                                    @endforeach
                                                @endif
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                @endfor

                                <div class="d-flex justify-content-end mt-4">
                                    <button type="submit" class="btn btn-primary px-4 py-2" style="border-radius: 10px; font-weight: 700; background: linear-gradient(135deg, #4f46e5, #3b82f6); border: none; box-shadow: 0 4px 12px rgba(79, 70, 229, 0.3);">
                                        <i class="fa-solid fa-floppy-disk mr-1"></i> {{ __('Save Popular Categories') }}
                                    </button>
                                </div>
                            </form>
                        </div>

                        {{-- 4. THREE COLUMN BANNER SECOND --}}
                        <div class="tab-pane fade" id="v-pills-t5" role="tabpanel" aria-labelledby="v-pills-t5-tab">
                            <div class="settings-tab-pane-title mb-4">
                                <i class="fa-solid fa-table-cells text-primary mr-1"></i> {{ __('3 Column Promo Banner (Second Section)') }}
                            </div>
                            <form class="admin-form" action="{{route('back.secend.banner.update')}}" method="POST" enctype="multipart/form-data">
                                @csrf

                                @for($i = 1; $i <= 3; $i++)
                                <div class="settings-section-card mb-4">
                                    <h6 class="section-card-title"><i class="fa-solid fa-image text-primary mr-1"></i> {{ __('Banner Column :i', ['i' => $i]) }}</h6>
                                    <div class="row align-items-center mb-3">
                                        <div class="col-12 col-sm-auto mb-2 mb-sm-0">
                                            <div style="width: 140px; height: 75px; border-radius: 10px; overflow: hidden; background: #ffffff; border: 1px solid #cbd5e1; display: flex; align-items: center; justify-content: center;">
                                                <img class="admin-img" style="width: 100%; height: 100%; object-fit: cover;"
                                                    src="{{ isset($secend_banner['img'.$i]) ? url('/core/public/storage/images/'.$secend_banner['img'.$i]) : url('/core/public/storage/images/placeholder.png') }}"
                                                    alt="Banner {{ $i }}" onerror="this.onerror=null; this.src='{{ url('/core/public/storage/images/placeholder.png') }}';">
                                            </div>
                                        </div>
                                        <div class="col-12 col-sm">
                                            <div class="position-relative mb-2">
                                                <label class="file">
                                                    <input type="file" accept="image/*" class="upload-photo" name="img{{ $i }}" id="file_s{{ $i }}" aria-label="Upload Image">
                                                    <span class="file-custom text-left">{{ __('Choose Image :i...', ['i' => $i]) }}</span>
                                                </label>
                                            </div>
                                            <span class="text-muted d-block" style="font-size: 12px;"><i class="fa-solid fa-circle-info text-primary mr-1"></i> {{ __('Recommended Image Size: 496 x 204 pixels.') }}</span>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-6 mb-3">
                                            <label for="title_s{{ $i }}" class="form-label font-weight-bold">{{ __('Banner Title') }} *</label>
                                            <input type="text" name="title{{ $i }}" class="form-control" id="title_s{{ $i }}" placeholder="{{ __('Enter Title') }}" value="{{isset($secend_banner['title'.$i]) ? $secend_banner['title'.$i] : ''}}">
                                        </div>
                                        <div class="col-md-6 mb-3">
                                            <label for="subtitle_s{{ $i }}" class="form-label font-weight-bold">{{ __('Banner Subtitle') }} *</label>
                                            <input type="text" name="subtitle{{ $i }}" class="form-control" id="subtitle_s{{ $i }}" placeholder="{{ __('Enter Subtitle') }}" value="{{isset($secend_banner['subtitle'.$i]) ? $secend_banner['subtitle'.$i] : ''}}">
                                        </div>
                                        <div class="col-12 mb-2">
                                            <label for="url_s{{ $i }}" class="form-label font-weight-bold">{{ __('Target URL / Link') }} *</label>
                                            <div class="input-group">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text bg-light"><i class="fa-solid fa-link text-muted"></i></span>
                                                </div>
                                                <input type="text" name="url{{ $i }}" class="form-control" id="url_s{{ $i }}" placeholder="{{ __('Enter Banner Url') }}" value="{{isset($secend_banner['url'.$i]) ? $secend_banner['url'.$i] : ''}}">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                @endfor

                                <div class="d-flex justify-content-end mt-4">
                                    <button type="submit" class="btn btn-primary px-4 py-2" style="border-radius: 10px; font-weight: 700; background: linear-gradient(135deg, #4f46e5, #3b82f6); border: none; box-shadow: 0 4px 12px rgba(79, 70, 229, 0.3);">
                                        <i class="fa-solid fa-floppy-disk mr-1"></i> {{ __('Save 3 Column Banner (Second)') }}
                                    </button>
                                </div>
                            </form>
                        </div>

                        {{-- 5. THREE COLUMN CATEGORY --}}
                        <div class="tab-pane fade" id="v-pills-t3" role="tabpanel" aria-labelledby="v-pills-t3-tab">
                            <div class="settings-tab-pane-title mb-4">
                                <i class="fa-solid fa-layer-group text-primary mr-1"></i> {{ __('Three Column Category Blocks') }}
                            </div>
                            <form class="admin-form" action="{{route('back.tree.column.category.update')}}" method="POST">
                                @csrf

                                @for($i = 1; $i <= 3; $i++)
                                <div class="settings-section-card mb-4">
                                    <h6 class="section-card-title"><i class="fa-solid fa-table-columns text-primary mr-1"></i> {{ __('Column :i Category', ['i' => $i]) }}</h6>
                                    <div class="row">
                                        <div class="col-md-4 mb-3">
                                            <label for="column_category_id{{ $i }}" class="form-label font-weight-bold">{{ __('Primary Category') }} *</label>
                                            <select name="category_id{{ $i }}" id="column_category_id{{ $i }}" data-href="{{route('back.get.subcategory')}}" class="form-control">
                                                <option value="">{{__('Select Primary Category')}}</option>
                                                @foreach(DB::table('categories')->whereStatus(1)->get() as $cat)
                                                    <option value="{{ $cat->id }}" {{isset($three_column_category['category_id'.$i]) && $cat->id == $three_column_category['category_id'.$i] ? 'selected' : ''}}>{{ $cat->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>

                                        <div class="col-md-4 mb-3">
                                            <label for="cloumn_subcategory_id{{ $i }}" class="form-label font-weight-bold">{{ __('Sub Category') }}</label>
                                            <select name="subcategory_id{{ $i }}" id="cloumn_subcategory_id{{ $i }}" class="form-control" data-href="{{route('back.get.childcategory')}}">
                                                <option value="">{{__('Select Sub Category')}}</option>
                                                @php
                                                    $subcategories_tc = isset($three_column_category['category_id'.$i]) ? DB::table('subcategories')->where('category_id', $three_column_category['category_id'.$i])->whereStatus(1)->get() : [];
                                                @endphp
                                                @foreach($subcategories_tc as $subcat)
                                                    <option value="{{ $subcat->id }}" {{ isset($three_column_category['subcategory_id'.$i]) && $subcat->id == $three_column_category['subcategory_id'.$i] ? 'selected' : '' }}>{{ $subcat->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>

                                        <div class="col-md-4 mb-3">
                                            <label for="cloumn_childcategory_id{{ $i }}" class="form-label font-weight-bold">{{ __('Child Category') }}</label>
                                            <select name="childcategory_id{{ $i }}" id="cloumn_childcategory_id{{ $i }}" class="form-control">
                                                <option value="">{{__('Select Child Category')}}</option>
                                                @php
                                                    $childcategories_tc = isset($three_column_category['category_id'.$i]) ? DB::table('chield_categories')->where('category_id', $three_column_category['category_id'.$i])->whereStatus(1)->get() : [];
                                                @endphp
                                                @foreach($childcategories_tc as $chieldcategory)
                                                    <option value="{{ $chieldcategory->id }}" {{ isset($three_column_category['childcategory_id'.$i]) && $chieldcategory->id == $three_column_category['childcategory_id'.$i] ? 'selected' : '' }}>{{ $chieldcategory->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                @endfor

                                <div class="d-flex justify-content-end mt-4">
                                    <button type="submit" class="btn btn-primary px-4 py-2" style="border-radius: 10px; font-weight: 700; background: linear-gradient(135deg, #4f46e5, #3b82f6); border: none; box-shadow: 0 4px 12px rgba(79, 70, 229, 0.3);">
                                        <i class="fa-solid fa-floppy-disk mr-1"></i> {{ __('Save Three Column Category') }}
                                    </button>
                                </div>
                            </form>
                        </div>

                        {{-- 6. FEATURED CATEGORIES --}}
                        <div class="tab-pane fade" id="v-pills-t4" role="tabpanel" aria-labelledby="v-pills-t4-tab">
                            <div class="settings-tab-pane-title mb-4">
                                <i class="fa-solid fa-star text-primary mr-1"></i> {{ __('Featured Categories Grid') }}
                            </div>
                            <form class="admin-form" action="{{route('back.feature.category.update')}}" method="POST">
                                @csrf

                                <div class="settings-section-card mb-4">
                                    <h6 class="section-card-title"><i class="fa-solid fa-heading text-primary mr-1"></i> {{ __('Section Header') }}</h6>
                                    <div class="form-group mb-0">
                                        <label for="feature_title" class="form-label font-weight-bold">{{ __('Section Heading Title') }} *</label>
                                        <input type="text" name="feature_title" class="form-control" id="feature_title" placeholder="{{ __('e.g. Featured Categories') }}" value="{{$feature_category['feature_title'] ?? ''}}" required>
                                    </div>
                                </div>

                                @for($i = 1; $i <= 4; $i++)
                                <div class="settings-section-card mb-4">
                                    <h6 class="section-card-title"><i class="fa-solid fa-star text-primary mr-1"></i> {{ __('Featured Slot :i', ['i' => $i]) }}</h6>
                                    <div class="row">
                                        <div class="col-md-4 mb-3">
                                            <label for="feature_category_id{{ $i }}" class="form-label font-weight-bold">{{ __('Primary Category') }} *</label>
                                            <select name="category_id{{ $i }}" id="feature_category_id{{ $i }}" data-href="{{route('back.get.subcategory')}}" class="form-control">
                                                <option value="">{{__('Select Primary Category')}}</option>
                                                @foreach(DB::table('categories')->whereStatus(1)->get() as $cat)
                                                    <option value="{{ $cat->id }}" {{isset($feature_category['category_id'.$i]) && $cat->id == $feature_category['category_id'.$i] ? 'selected' : ''}} >{{ $cat->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>

                                        <div class="col-md-4 mb-3">
                                            <label for="feature_subcategory_id{{ $i }}" class="form-label font-weight-bold">{{ __('Sub Category') }}</label>
                                            <select name="subcategory_id{{ $i }}" id="feature_subcategory_id{{ $i }}" class="form-control" data-href="{{route('back.get.childcategory')}}">
                                                <option value="">{{__('Select Sub Category')}}</option>
                                                @if(isset($feature_category['category_id'.$i]))
                                                    @foreach(DB::table('subcategories')->where('category_id', $feature_category['category_id'.$i])->whereStatus(1)->get() as $subcat)
                                                        <option value="{{ $subcat->id }}" {{ isset($feature_category['subcategory_id'.$i]) && $subcat->id == $feature_category['subcategory_id'.$i] ? 'selected' : '' }}>{{ $subcat->name }}</option>
                                                    @endforeach
                                                @endif
                                            </select>
                                        </div>

                                        <div class="col-md-4 mb-3">
                                            <label for="feature_childcategory_id{{ $i }}" class="form-label font-weight-bold">{{ __('Child Category') }}</label>
                                            <select name="childcategory_id{{ $i }}" id="feature_childcategory_id{{ $i }}" class="form-control">
                                                <option value="">{{__('Select Child Category')}}</option>
                                                @if(isset($feature_category['category_id'.$i]))
                                                    @foreach(DB::table('chield_categories')->where('category_id', $feature_category['category_id'.$i])->whereStatus(1)->get() as $chieldcategory)
                                                        <option value="{{ $chieldcategory->id }}" {{ isset($feature_category['childcategory_id'.$i]) && $chieldcategory->id == $feature_category['childcategory_id'.$i] ? 'selected' : '' }}>{{ $chieldcategory->name }}</option>
                                                    @endforeach
                                                @endif
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                @endfor

                                <div class="d-flex justify-content-end mt-4">
                                    <button type="submit" class="btn btn-primary px-4 py-2" style="border-radius: 10px; font-weight: 700; background: linear-gradient(135deg, #4f46e5, #3b82f6); border: none; box-shadow: 0 4px 12px rgba(79, 70, 229, 0.3);">
                                        <i class="fa-solid fa-floppy-disk mr-1"></i> {{ __('Save Featured Categories') }}
                                    </button>
                                </div>
                            </form>
                        </div>

                        {{-- 7. TWO COLUMN BANNER --}}
                        <div class="tab-pane fade" id="v-pills-t6" role="tabpanel" aria-labelledby="v-pills-t6-tab">
                            <div class="settings-tab-pane-title mb-4">
                                <i class="fa-solid fa-columns text-primary mr-1"></i> {{ __('2 Column Promo Banner') }}
                            </div>
                            <form class="admin-form" action="{{route('back.third.banner.update')}}" method="POST" enctype="multipart/form-data">
                                @csrf

                                @for($i = 1; $i <= 2; $i++)
                                <div class="settings-section-card mb-4">
                                    <h6 class="section-card-title"><i class="fa-solid fa-image text-primary mr-1"></i> {{ __('Banner :i', ['i' => $i]) }}</h6>
                                    <div class="row align-items-center mb-3">
                                        <div class="col-12 col-sm-auto mb-2 mb-sm-0">
                                            <div style="width: 140px; height: 75px; border-radius: 10px; overflow: hidden; background: #ffffff; border: 1px solid #cbd5e1; display: flex; align-items: center; justify-content: center;">
                                                <img class="admin-img" style="width: 100%; height: 100%; object-fit: cover;"
                                                    src="{{ isset($third_banner['img'.$i]) ? url('/core/public/storage/images/'.$third_banner['img'.$i]) : url('/core/public/storage/images/placeholder.png') }}"
                                                    alt="Banner {{ $i }}" onerror="this.onerror=null; this.src='{{ url('/core/public/storage/images/placeholder.png') }}';">
                                            </div>
                                        </div>
                                        <div class="col-12 col-sm">
                                            <div class="position-relative mb-2">
                                                <label class="file">
                                                    <input type="file" accept="image/*" class="upload-photo" name="img{{ $i }}" id="file_tb{{ $i }}" aria-label="Upload Image">
                                                    <span class="file-custom text-left">{{ __('Choose Image :i...', ['i' => $i]) }}</span>
                                                </label>
                                            </div>
                                            <span class="text-muted d-block" style="font-size: 12px;"><i class="fa-solid fa-circle-info text-primary mr-1"></i> {{ __('Recommended Image Size: 496 x 204 pixels.') }}</span>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-6 mb-3">
                                            <label for="title_tb{{ $i }}" class="form-label font-weight-bold">{{ __('Banner Title') }} *</label>
                                            <input type="text" name="title{{ $i }}" class="form-control" id="title_tb{{ $i }}" placeholder="{{ __('Enter Title') }}" value="{{isset($third_banner['title'.$i]) ? $third_banner['title'.$i] : ''}}">
                                        </div>
                                        <div class="col-md-6 mb-3">
                                            <label for="subtitle_tb{{ $i }}" class="form-label font-weight-bold">{{ __('Banner Subtitle') }} *</label>
                                            <input type="text" name="subtitle{{ $i }}" class="form-control" id="subtitle_tb{{ $i }}" placeholder="{{ __('Enter Subtitle') }}" value="{{isset($third_banner['subtitle'.$i]) ? $third_banner['subtitle'.$i] : ''}}">
                                        </div>
                                        <div class="col-12 mb-2">
                                            <label for="url_tb{{ $i }}" class="form-label font-weight-bold">{{ __('Target URL / Link') }} *</label>
                                            <div class="input-group">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text bg-light"><i class="fa-solid fa-link text-muted"></i></span>
                                                </div>
                                                <input type="text" name="url{{ $i }}" class="form-control" id="url_tb{{ $i }}" placeholder="{{ __('Enter Banner Url') }}" value="{{isset($third_banner['url'.$i]) ? $third_banner['url'.$i] : ''}}">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                @endfor

                                <div class="d-flex justify-content-end mt-4">
                                    <button type="submit" class="btn btn-primary px-4 py-2" style="border-radius: 10px; font-weight: 700; background: linear-gradient(135deg, #4f46e5, #3b82f6); border: none; box-shadow: 0 4px 12px rgba(79, 70, 229, 0.3);">
                                        <i class="fa-solid fa-floppy-disk mr-1"></i> {{ __('Save 2 Column Banner') }}
                                    </button>
                                </div>
                            </form>
                        </div>

                        {{-- 8. HOME PAGE 4 BANNER (5 COLUMN) --}}
                        <div class="tab-pane fade" id="v-pills-t7" role="tabpanel" aria-labelledby="v-pills-t7-tab">
                            <div class="settings-tab-pane-title mb-4">
                                <i class="fa-solid fa-grip text-primary mr-1"></i> {{ __('Home Page 4 Banner (5 Column Grid)') }}
                            </div>
                            <form class="admin-form" action="{{route('back.home_page4.banner.update')}}" method="POST" enctype="multipart/form-data">
                                @csrf

                                @for($i = 1; $i <= 5; $i++)
                                <div class="settings-section-card mb-4">
                                    <h6 class="section-card-title"><i class="fa-solid fa-image text-primary mr-1"></i> {{ __('Grid Item :i', ['i' => $i]) }} @if($i == 3) <small class="text-primary font-weight-bold">({{ __('Middle Highlight Box') }})</small> @endif</h6>
                                    <div class="row align-items-center mb-3">
                                        <div class="col-12 col-sm-auto mb-2 mb-sm-0">
                                            <div style="width: 140px; height: 75px; border-radius: 10px; overflow: hidden; background: #ffffff; border: 1px solid #cbd5e1; display: flex; align-items: center; justify-content: center;">
                                                <img class="admin-img" style="width: 100%; height: 100%; object-fit: cover;"
                                                    src="{{ isset($home4_banner['img'.$i]) ? url('/core/public/storage/images/'.$home4_banner['img'.$i]) : url('/core/public/storage/images/placeholder.png') }}"
                                                    alt="Grid Item {{ $i }}" onerror="this.onerror=null; this.src='{{ url('/core/public/storage/images/placeholder.png') }}';">
                                            </div>
                                        </div>
                                        <div class="col-12 col-sm">
                                            <div class="position-relative mb-2">
                                                <label class="file">
                                                    <input type="file" accept="image/*" class="upload-photo" name="img{{ $i }}" id="file_h4_{{ $i }}" aria-label="Upload Image">
                                                    <span class="file-custom text-left">{{ __('Choose Image :i...', ['i' => $i]) }}</span>
                                                </label>
                                            </div>
                                            <span class="text-muted d-block" style="font-size: 12px;"><i class="fa-solid fa-circle-info text-primary mr-1"></i> {{ __('Recommended Image Size: 496 x 204 pixels.') }}</span>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-6 mb-3">
                                            <label for="label{{ $i }}" class="form-label font-weight-bold">{{ __('Button / Label Text') }} *</label>
                                            <input type="text" name="label{{ $i }}" class="form-control" id="label{{ $i }}" placeholder="{{ __('Enter Button Text') }}" value="{{isset($home4_banner['label'.$i]) ? $home4_banner['label'.$i] : ''}}">
                                        </div>
                                        <div class="col-md-6 mb-3">
                                            <label for="url_h4_{{ $i }}" class="form-label font-weight-bold">{{ __('Target URL / Link') }} *</label>
                                            <div class="input-group">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text bg-light"><i class="fa-solid fa-link text-muted"></i></span>
                                                </div>
                                                <input type="text" name="url{{ $i }}" class="form-control" id="url_h4_{{ $i }}" placeholder="{{ __('Enter Target Url') }}" value="{{isset($home4_banner['url'.$i]) ? $home4_banner['url'.$i] : ''}}">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                @endfor

                                <div class="d-flex justify-content-end mt-4">
                                    <button type="submit" class="btn btn-primary px-4 py-2" style="border-radius: 10px; font-weight: 700; background: linear-gradient(135deg, #4f46e5, #3b82f6); border: none; box-shadow: 0 4px 12px rgba(79, 70, 229, 0.3);">
                                        <i class="fa-solid fa-floppy-disk mr-1"></i> {{ __('Save 5 Column Banner') }}
                                    </button>
                                </div>
                            </form>
                        </div>

                        {{-- 9. HOME PAGE 4 POPULAR CATEGORIES --}}
                        <div class="tab-pane fade" id="v-pills-t8" role="tabpanel" aria-labelledby="v-pills-t8-tab">
                            <div class="settings-tab-pane-title mb-4">
                                <i class="fa-solid fa-cubes text-primary mr-1"></i> {{ __('Home Page 4 Popular Categories Multi-Select') }}
                            </div>
                            <form class="admin-form" action="{{route('back.home4.category.update')}}" method="POST" enctype="multipart/form-data">
                                @csrf
                                @php
                                    $home_4_popular_category = isset($home_4_popular_category) ? $home_4_popular_category : [];
                                @endphp

                                <div class="settings-section-card mb-4">
                                    <h6 class="section-card-title"><i class="fa-solid fa-list-check text-primary mr-1"></i> {{ __('Choose Active Showcase Categories') }}</h6>
                                    <div class="form-group mb-0">
                                        <label for="basic" class="form-label font-weight-bold">{{ __('Select Categories (Multiple Selection Allowed)') }}</label>
                                        <select name="home_4_popular_category[]" id="basic" class="form-control" multiple data-href="{{route('back.get.childcategory')}}">
                                            @foreach(DB::table('categories')->whereStatus(1)->get() as $category)
                                                <option value="{{ $category->id }}" {{ in_array($category->id, $home_4_popular_category) ? 'selected' : '' }}>{{ $category->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>

                                <div class="d-flex justify-content-end mt-4">
                                    <button type="submit" class="btn btn-primary px-4 py-2" style="border-radius: 10px; font-weight: 700; background: linear-gradient(135deg, #4f46e5, #3b82f6); border: none; box-shadow: 0 4px 12px rgba(79, 70, 229, 0.3);">
                                        <i class="fa-solid fa-floppy-disk mr-1"></i> {{ __('Save Categories') }}
                                    </button>
                                </div>
                            </form>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>

</div>
<!-- End of Main Content -->

@endsection

@section('scripts')
    <script type="" src="{{asset('assets/back/js/select2.js')}}"></script>
    <script>
        $(document).ready(function() {
            if ($('#basic').length) {
                $('#basic').select2({
                    theme: "bootstrap"
                });
            }
        });
    </script>
@endsection