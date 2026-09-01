@extends('master.front')
@section('meta')
<meta name="keywords" content="{{$setting->meta_keywords}}">
<meta name="description" content="{{$setting->meta_description}}">
@endsection
@section('title')
    {{__('Products')}}
@endsection

@section('content')
    <!-- Page Title-->
<div class="page-title">
    <div class="container">
      <div class="row">
          <div class="col-lg-12">
            <ul class="breadcrumbs">
                <li><a href="{{route('front.index')}}">{{__('Home')}}</a> </li>
                <li class="separator"></li>
                <li>{{__('Shop')}}</li>
              </ul>
          </div>
      </div>
    </div>
  </div>
  <!-- Page Content-->
  <div class="container padding-bottom-3x mb-1">
        <div class="row">
            <div class="col-lg-12">
                <div class="shop-top-filter-wrapper">
                    <div class="catalog-toolbar-flex">
                        <!-- Left / Filter Group: Quick Filter & Sort By -->
                        <div class="catalog-toolbar-left">
                            <div class="sptfl-modern">
                                <!-- Quick Filter Dropdown -->
                                <div class="quickFilter modern-quick-filter">
                                    <div class="quickFilter-title">
                                        <i class="fas fa-filter"></i> <span>{{__('Quick filter')}}</span> <i class="icon-chevron-down filter-arrow"></i>
                                    </div>
                                    <ul id="quick_filter" class="quick-filter-dropdown">
                                        <li><a datahref=""><i class="icon-chevron-right pr-2"></i>{{__('All products')}} </a></li>
                                        <li><a href="javascript:;" data-href="feature"><i class="icon-chevron-right pr-2"></i>{{__('Featured products')}} </a></li>
                                        <li><a href="javascript:;" data-href="best"><i class="icon-chevron-right pr-2"></i>{{__('Best sellers')}} </a></li>
                                        <li><a href="javascript:;" data-href="top"><i class="icon-chevron-right pr-2"></i>{{__('Top rated')}} </a></li>
                                        <li><a href="javascript:;" data-href="new"><i class="icon-chevron-right pr-2"></i>{{__('New Arrival')}} </a></li>
                                    </ul>
                                </div>

                                <!-- Sort By Select -->
                                <div class="shop-sorting modern-sort-group">
                                    <div class="sort-select-wrapper">
                                        <i class="fas fa-arrow-down-short-wide sort-icon"></i>
                                        <select class="form-control" id="sorting">
                                            <option value="">{{__('All Products')}}</option>
                                            <option value="low_to_high" {{request()->input('low_to_high') ? 'selected' : ''}}>{{__('Low - High Price')}}</option>
                                            <option value="high_to_low" {{request()->input('high_to_low') ? 'selected' : ''}}>{{__('High - Low Price')}}</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Right: Item Counter & Grid/List View Toggle -->
                        <div class="catalog-toolbar-right">
                            <div class="catalog-items-count d-none d-md-inline-block">
                                <span class="text-muted">{{__('Showing')}}:</span> <strong class="text-dark">1 - {{$setting->view_product}} {{__('items')}}</strong>
                            </div>
                            
                            <div class="shop-view modern-view-switch">
                                <a class="list-view {{Session::has('view_catalog') && Session::get('view_catalog') == 'grid' ? 'active' : (!Session::has('view_catalog') ? 'active' : '')}}" data-step="grid" href="javascript:;" data-href="{{route('front.catalog').'?view_check=grid'}}" title="{{__('Grid View')}}">
                                    <i class="fas fa-th-large"></i>
                                </a>
                                <a class="list-view {{Session::has('view_catalog') && Session::get('view_catalog') == 'list' ? 'active' : ''}}" href="javascript:;" data-step="list" data-href="{{route('front.catalog').'?view_check=list'}}" title="{{__('List View')}}">
                                    <i class="fas fa-list"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>

                <style>
                .shop-top-filter-wrapper {
                    background: #ffffff !important;
                    border: 1px solid #e2e8f0 !important;
                    border-radius: 14px !important;
                    padding: 10px 16px !important;
                    margin-bottom: 24px !important;
                    box-shadow: 0 2px 10px rgba(0, 0, 0, 0.03) !important;
                }

                .catalog-toolbar-flex {
                    display: flex !important;
                    align-items: center !important;
                    justify-content: space-between !important;
                    gap: 12px !important;
                    width: 100% !important;
                }

                .catalog-toolbar-left {
                    display: flex !important;
                    align-items: center !important;
                    flex: 1 !important;
                }

                .sptfl-modern {
                    display: flex !important;
                    align-items: center !important;
                    gap: 10px !important;
                    width: 100% !important;
                }

                /* Quick Filter Button */
                .quickFilter,
                .modern-quick-filter {
                    position: relative !important;
                    display: inline-flex !important;
                    align-items: center !important;
                    width: auto !important;
                    height: auto !important;
                    margin: 0 !important;
                    padding: 0 !important;
                }

                .quickFilter .quickFilter-title,
                .modern-quick-filter .quickFilter-title {
                    position: relative !important;
                    top: auto !important;
                    left: auto !important;
                    right: auto !important;
                    bottom: auto !important;
                    width: auto !important;
                    height: 38px !important;
                    line-height: 1 !important;
                    margin: 0 !important;
                    padding: 0 14px !important;
                    border-radius: 10px !important;
                    background: #f8fafc !important;
                    border: 1px solid #e2e8f0 !important;
                    color: #334155 !important;
                    font-size: 13px !important;
                    font-weight: 600 !important;
                    cursor: pointer !important;
                    display: inline-flex !important;
                    align-items: center !important;
                    justify-content: center !important;
                    gap: 6px !important;
                    transition: all 0.2s ease !important;
                    user-select: none !important;
                    white-space: nowrap !important;
                    overflow: visible !important;
                }

                .quickFilter .quickFilter-title:hover,
                .modern-quick-filter .quickFilter-title:hover {
                    background: #ecfdf5 !important;
                    border-color: #a7f3d0 !important;
                    color: #059669 !important;
                }

                .quickFilter .quickFilter-title i,
                .modern-quick-filter .quickFilter-title i {
                    color: #10b981 !important;
                    font-size: 13px !important;
                    line-height: 1 !important;
                    margin: 0 !important;
                    display: inline-block !important;
                }

                .quickFilter .quickFilter-title span,
                .modern-quick-filter .quickFilter-title span {
                    display: inline-block !important;
                    line-height: 1 !important;
                    font-size: 13px !important;
                    color: inherit !important;
                    margin: 0 !important;
                    padding: 0 !important;
                    white-space: nowrap !important;
                }

                .quickFilter .quickFilter-title .filter-arrow,
                .modern-quick-filter .quickFilter-title .filter-arrow {
                    font-size: 10px !important;
                    color: #94a3b8 !important;
                    margin-left: 2px !important;
                }

                #quick_filter,
                .modern-quick-filter .quick-filter-dropdown {
                    position: absolute !important;
                    top: calc(100% + 6px) !important;
                    left: 0 !important;
                    min-width: 180px !important;
                    background: #ffffff !important;
                    border: 1px solid #e2e8f0 !important;
                    border-radius: 12px !important;
                    box-shadow: 0 12px 30px rgba(0, 0, 0, 0.12) !important;
                    padding: 6px 0 !important;
                    list-style: none !important;
                    z-index: 99999 !important;
                    margin: 0 !important;
                    display: none;
                    border-top: 1px solid #e2e8f0 !important;
                }

                .modern-quick-filter:hover #quick_filter,
                .modern-quick-filter:hover .quick-filter-dropdown,
                .quickFilter:hover #quick_filter {
                    display: block !important;
                    visibility: visible !important;
                    opacity: 1 !important;
                }

                #quick_filter li a,
                .modern-quick-filter .quick-filter-dropdown li a {
                    display: flex !important;
                    align-items: center !important;
                    gap: 6px !important;
                    padding: 8px 16px !important;
                    color: #475569 !important;
                    font-size: 13px !important;
                    font-weight: 500 !important;
                    text-decoration: none !important;
                    transition: all 0.15s ease !important;
                }

                #quick_filter li a:hover,
                .modern-quick-filter .quick-filter-dropdown li a:hover {
                    background: #ecfdf5 !important;
                    color: #059669 !important;
                }

                /* Sort Select */
                .shop-sorting,
                .modern-sort-group {
                    display: inline-flex !important;
                    align-items: center !important;
                    margin: 0 !important;
                    flex: 1 !important;
                }

                .sort-select-wrapper {
                    position: relative !important;
                    display: inline-flex !important;
                    align-items: center !important;
                    width: 100% !important;
                }

                .sort-select-wrapper .sort-icon {
                    position: absolute !important;
                    left: 12px !important;
                    color: #10b981 !important;
                    font-size: 13px !important;
                    pointer-events: none !important;
                    z-index: 2 !important;
                }

                .shop-sorting select.form-control,
                .modern-sort-group select.form-control {
                    width: 100% !important;
                    padding: 0 14px 0 32px !important;
                    border-radius: 10px !important;
                    background: #f8fafc !important;
                    border: 1px solid #e2e8f0 !important;
                    color: #334155 !important;
                    font-size: 13px !important;
                    font-weight: 600 !important;
                    height: 38px !important;
                    line-height: 38px !important;
                    cursor: pointer !important;
                    transition: all 0.2s ease !important;
                    margin: 0 !important;
                }

                .shop-sorting select.form-control:focus,
                .modern-sort-group select.form-control:focus {
                    background: #ffffff !important;
                    border-color: #10b981 !important;
                    box-shadow: 0 0 0 3px rgba(16, 185, 129, 0.12) !important;
                }

                /* Right Side: Items count & Grid/List Switch */
                .catalog-toolbar-right {
                    display: flex !important;
                    align-items: center !important;
                    gap: 12px !important;
                    flex-shrink: 0 !important;
                }

                .catalog-items-count {
                    font-size: 13px !important;
                    color: #64748b !important;
                    white-space: nowrap !important;
                }

                .modern-view-switch,
                .shop-view {
                    display: inline-flex !important;
                    align-items: center !important;
                    background: #f1f5f9 !important;
                    padding: 3px !important;
                    border-radius: 10px !important;
                    border: 1px solid #e2e8f0 !important;
                    gap: 2px !important;
                    float: none !important;
                    text-align: center !important;
                }

                .modern-view-switch .list-view,
                .shop-view .list-view {
                    display: inline-flex !important;
                    align-items: center !important;
                    justify-content: center !important;
                    width: 32px !important;
                    height: 32px !important;
                    border-radius: 8px !important;
                    color: #64748b !important;
                    background: transparent !important;
                    text-decoration: none !important;
                    font-size: 13px !important;
                    transition: all 0.2s ease !important;
                }

                .modern-view-switch .list-view:hover,
                .shop-view .list-view:hover {
                    color: #0f172a !important;
                    background: rgba(255, 255, 255, 0.6) !important;
                }

                .modern-view-switch .list-view.active,
                .shop-view .list-view.active {
                    background: #10b981 !important;
                    color: #ffffff !important;
                    box-shadow: 0 2px 6px rgba(16, 185, 129, 0.35) !important;
                }

                /* Mobile Responsiveness (<= 768px) */
                @media (max-width: 768px) {
                    .shop-top-filter-wrapper {
                        padding: 8px 10px !important;
                        margin-bottom: 16px !important;
                    }

                    .catalog-toolbar-flex {
                        flex-direction: row !important;
                        justify-content: space-between !important;
                        align-items: center !important;
                        gap: 6px !important;
                        flex-wrap: nowrap !important;
                    }

                    .catalog-toolbar-left {
                        flex: 1 !important;
                        min-width: 0 !important;
                    }

                    .sptfl-modern {
                        display: flex !important;
                        flex-direction: row !important;
                        gap: 6px !important;
                        width: 100% !important;
                        flex-wrap: nowrap !important;
                    }

                    .modern-quick-filter {
                        flex: 1 !important;
                        min-width: 0 !important;
                    }

                    .quickFilter .quickFilter-title,
                    .modern-quick-filter .quickFilter-title {
                        width: 100% !important;
                        height: 36px !important;
                        line-height: 1 !important;
                        padding: 0 6px !important;
                        gap: 4px !important;
                    }

                    .quickFilter .quickFilter-title span,
                    .modern-quick-filter .quickFilter-title span {
                        font-size: 11.5px !important;
                    }

                    .quickFilter .quickFilter-title i,
                    .modern-quick-filter .quickFilter-title i {
                        font-size: 11.5px !important;
                    }

                    .modern-sort-group {
                        flex: 1.15 !important;
                        min-width: 0 !important;
                    }

                    .shop-sorting select.form-control,
                    .modern-sort-group select.form-control {
                        width: 100% !important;
                        height: 36px !important;
                        line-height: 36px !important;
                        padding: 0 6px 0 26px !important;
                        font-size: 11.5px !important;
                    }

                    .sort-select-wrapper .sort-icon {
                        left: 8px !important;
                        font-size: 11px !important;
                    }

                    .catalog-toolbar-right {
                        gap: 4px !important;
                        flex-shrink: 0 !important;
                    }

                    .modern-view-switch,
                    .shop-view {
                        padding: 2px !important;
                    }

                    .modern-view-switch .list-view,
                    .shop-view .list-view {
                        width: 28px !important;
                        height: 28px !important;
                        font-size: 11.5px !important;
                    }
                }
                </style>
            </div>
        </div>
        <div class="row g-3">

          <div class="col-lg-9 order-lg-2" id="list_view_ajax">
            @include('front.catalog.catalog')
          </div>

          <!-- Sidebar          -->
          <div class="col-lg-3 order-lg-1">
            <div class="sidebar-toggle position-left"><i class="icon-filter"></i></div>
            <aside class="sidebar sidebar-offcanvas position-left"><span class="sidebar-close"><i class="icon-x"></i></span>
              <!-- Widget Categories-->
              <section class="widget widget-categories card rounded p-4">
                <h3 class="widget-title">{{__('Shop Categories')}}</h3>
                <ul id="category_list" class="category-scroll">
                    @foreach ($categories as $getcategory)
                    <li class="has-children  {{isset($category) && $category->id == $getcategory->id ? 'expanded active' : ''}} ">
                      <a class="category_search" href="javascript:;"  data-href="{{$getcategory->slug}}">{{$getcategory->name}}</a>

                        <ul id="subcategory_list">
                            @foreach ($getcategory->subcategory as $getsubcategory)
                            <li class="{{isset($subcategory) && $subcategory->id == $getsubcategory->id ? 'active' : ''}}">
                              <a class="subcategory" href="javascript:;" data-href="{{$getsubcategory->slug}}">{{$getsubcategory->name}}</a>

                              <ul id="childcategory_list">
                                @foreach ($getsubcategory->childcategory as $getchildcategory)
                                <li class="{{isset($childcategory) && $getchildcategory->id == $getchildcategory->id ? 'active' : ''}}">
                                  <a class="childcategory" href="javascript:;" data-href="{{$getchildcategory->slug}}">{{$getchildcategory->name}}</a>

                                </li>
                                @endforeach
                            </ul>
                            </li>
                            @endforeach
                        </ul>
                      </li>
                    @endforeach
                </ul>
              </section>

              @if ($setting->is_range_search == 1)
                   <!-- Widget Price Range-->
              <section class="widget widget-categories card rounded p-4">
                <h3 class="widget-title">{{ __('Filter by Price') }}</h3>
                <form class="price-range-slider" method="post" data-start-min="{{request()->input('minPrice') ? request()->input('minPrice') : '0'}}" data-start-max="{{request()->input('maxPrice') ? request()->input('maxPrice') : $setting->max_price}}" data-min="0" data-max="{{$setting->max_price}}" data-step="5">
                  <div class="ui-range-slider"></div>
                  <footer class="ui-range-slider-footer">
                    <div class="column">
                      <button class="btn btn-primary btn-sm" id="price_filter" type="button"><span>{{__('Filter')}}</span></button>
                    </div>
                    <div class="column">
                      <div class="ui-range-values">
                        <div class="ui-range-value-min">{{PriceHelper::setCurrencySign()}}<span class="min_price"></span>
                          <input type="hidden">
                        </div>-
                        <div class="ui-range-value-max">{{PriceHelper::setCurrencySign()}}<span class="max_price"></span>
                          <input type="hidden">
                        </div>
                      </div>
                    </div>
                  </footer>
                </form>
              </section>
              @endif

              @if ($setting->is_attribute_search == 1)
              @foreach ($attrubutes as $attrubute)
              
              <section class="widget widget-categories card rounded p-4">
                <h3 class="widget-title">{{ __('Filter by') }} {{$attrubute->name}}</h3>
                @foreach ($options as $option)
                @if ($attrubute->keyword == $option->attribute->keyword)
                <div class="custom-control custom-checkbox">
                  <input class="custom-control-input option" {{isset($subcategory) && $subcategory->id == $option->id ? 'checked' : ''}}   type="checkbox" value="{{$option->name}}" id="{{$attrubute->id}}{{$option->name}}">
                  <label class="custom-control-label" for="{{$attrubute->id}}{{$option->name}}">{{$option->name}}<span class="text-muted"></span></label>
              </div>  
                @endif
                @endforeach
              </section>
              @endforeach
              @endif

              <!-- Widget Brand Filter-->
              <section class="widget widget-categories card rounded p-4">
                <h3 class="widget-title">{{__('Filter by Brand')}}</h3>
                <div class="custom-control custom-checkbox">
                  <input class="custom-control-input brand-select" type="checkbox" value="" id="all-brand">
                  <label class="custom-control-label" for="all-brand">{{__('All Brands')}}</label>
                </div>
                @foreach ($brands as $getbrand)
                <div class="custom-control custom-checkbox">
                    <input class="custom-control-input brand-select" {{isset($brand) && $brand->id == $getbrand->id ? 'checked' : ''}} type="checkbox" value="{{$getbrand->slug}}" id="{{$getbrand->slug}}">
                    <label class="custom-control-label" for="{{$getbrand->slug}}">{{$getbrand->name}}</label>
                  </div>
                @endforeach
              </section>


            </aside>
          </div>
        </div>
      </div>



      <form id="search_form" class="d-none" action="{{route('front.catalog')}}" method="GET">

        <input type="text" name="maxPrice" id="maxPrice" value="{{request()->input('maxPrice') ? request()->input('maxPrice') : ''}}">
        <input type="text" name="minPrice" id="minPrice" value="{{request()->input('minPrice') ? request()->input('minPrice') : ''}}">
        <input type="text" name="brand" id="brand" value="{{isset($brand) ? $brand->slug : ''}}">
        <input type="text" name="brand" id="brand" value="{{isset($brand) ? $brand->slug : ''}}">
        <input type="text" name="category" id="category" value="{{isset($category) ? $category->slug : ''}}">
        <input type="text" name="quick_filter" id="quick_filter" value="">
        <input type="text" name="childcategory" id="childcategory" value="{{isset($childcategory) ? $childcategory->slug : ''}}">
        <input type="text" name="page" id="page" value="{{isset($page) ? $page : ''}}">
        <input type="text" name="attribute" id="attribute" value="{{isset($attribute) ? $attribute : ''}}">
        <input type="text" name="option" id="option" value="{{isset($option) ? $option : ''}}">
        <input type="text" name="subcategory" id="subcategory" value="{{isset($subcategory) ? $subcategory->slug : ''}}">
        <input type="text" name="sorting" id="sorting" value="{{isset($sorting) ? $sorting : ''}}">
        <input type="text" name="view_check" id="view_check" value="{{isset($view_check) ? $view_check : ''}}">


        <button type="submit" id="search_button" class="d-none"></button>
    </form>
@endsection

