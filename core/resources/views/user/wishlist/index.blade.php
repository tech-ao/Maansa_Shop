@extends('master.front')
@section('title')
    {{__('My Wishlist')}}
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
                    <li>{{__('My Account')}}</li>
                    <li class="separator"></li>
                    <li>{{__('Wishlist')}}</li>
                </ul>
            </div>
        </div>
    </div>
</div>

<!-- Page Content-->
<div class="container padding-bottom-3x mb-1">
    <div class="row">
        @include('includes.user_sitebar')
        
        <div class="col-lg-8">
            <div class="padding-top-2x mt-2 hidden-lg-up"></div>

            <div class="card modern-wishlist-card border-0 shadow-sm rounded-4">
                <!-- Header -->
                <div class="card-header bg-white px-4 py-3 border-bottom d-flex flex-wrap align-items-center justify-content-between gap-3">
                    <div>
                        <h4 class="mb-1 text-dark fw-bold fs-5">
                            <i class="icon-heart text-danger mr-2"></i>{{ __('My Wishlist') }}
                        </h4>
                        <p class="mb-0 text-muted small">
                            {{ __('All your saved items in one place. Add them directly to your cart.') }}
                        </p>
                    </div>

                    @if ($wishlist_items->count() > 0)
                        <a class="btn btn-sm btn-outline-danger rounded-pill px-3" href="{{route('user.wishlist.delete.all')}}" onclick="return confirm('{{ __('Are you sure you want to clear your entire wishlist?') }}')">
                            <i class="icon-trash mr-1"></i> {{__('Clear Wishlist')}}
                        </a>
                    @endif
                </div>

                <!-- Body / Wishlist Items -->
                <div class="card-body p-0">
                    @if ($wishlist_items->count() > 0)
                        <!-- Desktop Table View -->
                        <div class="table-responsive d-none d-md-block">
                            <table class="table table-hover align-middle mb-0 custom-wishlist-table">
                                <thead class="table-light">
                                    <tr>
                                        <th class="ps-4" style="width: 50%;">{{ __('Product Details') }}</th>
                                        <th>{{ __('Price') }}</th>
                                        <th>{{ __('Stock Status') }}</th>
                                        <th class="text-end pe-4">{{ __('Action') }}</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($wishlist_items as $product)
                                        <tr>
                                            <td class="ps-4">
                                                <div class="d-flex align-items-center gap-3">
                                                    <a href="{{ route('front.product', $product->slug) }}" class="wishlist-thumb-wrapper">
                                                        <img src="{{ url('/core/public/storage/images/'.$product->photo) }}" alt="{{ $product->name }}" class="wishlist-thumb-img">
                                                    </a>
                                                    <div>
                                                        <h6 class="mb-1 fw-bold fs-6">
                                                            <a href="{{ route('front.product', $product->slug) }}" class="text-dark text-decoration-none hover-primary">
                                                                {{ $product->name }}
                                                            </a>
                                                        </h6>
                                                    </div>
                                                </div>
                                            </td>
                                            <td>
                                                <span class="fw-bold text-dark fs-6">
                                                    {{ PriceHelper::grandCurrencyPrice($product) }}
                                                </span>
                                            </td>
                                            <td>
                                                @if($product->is_stock())
                                                    <span class="badge bg-success-subtle text-success border border-success-subtle rounded-pill px-3 py-1">{{ __('In Stock') }}</span>
                                                @else
                                                    <span class="badge bg-danger-subtle text-danger border border-danger-subtle rounded-pill px-3 py-1">{{ __('Out of Stock') }}</span>
                                                @endif
                                            </td>
                                            <td class="text-end pe-4">
                                                <div class="d-inline-flex align-items-center gap-2">
                                                    @if ($product->is_stock())
                                                        @if ($product->item_type != 'affiliate')
                                                            <a class="btn btn-sm btn-cart-action rounded-pill px-3 py-1 add_to_single_cart" href="javascript:;" data-target="{{ $product->id }}">
                                                                <i class="icon-shopping-cart mr-1"></i> {{ __('Add To Cart') }}
                                                            </a>
                                                        @endif
                                                    @else
                                                        <a class="btn btn-sm btn-outline-secondary rounded-pill px-3 py-1" href="{{ route('front.product', $product->slug) }}">
                                                            {{ __('Details') }}
                                                        </a>
                                                    @endif
                                                    
                                                    <a class="btn btn-sm btn-outline-danger rounded-circle p-1 d-inline-flex align-items-center justify-content-center" style="width: 30px; height: 30px;" href="{{ route('user.wishlist.delete', $product->getWishlistItemId()) }}" title="{{ __('Remove item') }}">
                                                        <i class="icon-trash"></i>
                                                    </a>
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>

                        <!-- Mobile Cards View -->
                        <div class="d-md-none p-3">
                            @foreach ($wishlist_items as $product)
                                <div class="wishlist-mobile-card mb-3 p-3 bg-white rounded-3 border shadow-sm">
                                    <div class="d-flex gap-3 align-items-start mb-2">
                                        <a href="{{ route('front.product', $product->slug) }}" class="wishlist-thumb-wrapper flex-shrink-0">
                                            <img src="{{ url('/core/public/storage/images/'.$product->photo) }}" alt="{{ $product->name }}" class="wishlist-thumb-img">
                                        </a>
                                        <div class="flex-grow-1 min-w-0">
                                            <h6 class="mb-1 fw-bold fs-6">
                                                <a href="{{ route('front.product', $product->slug) }}" class="text-dark text-decoration-none">
                                                    {{ $product->name }}
                                                </a>
                                            </h6>
                                            <div class="d-flex align-items-center justify-content-between mb-1">
                                                <span class="fw-bold text-success fs-6">
                                                    {{ PriceHelper::grandCurrencyPrice($product) }}
                                                </span>
                                                @if($product->is_stock())
                                                    <span class="badge bg-success-subtle text-success border border-success-subtle rounded-pill px-2 py-1 small">{{ __('In Stock') }}</span>
                                                @else
                                                    <span class="badge bg-danger-subtle text-danger border border-danger-subtle rounded-pill px-2 py-1 small">{{ __('Out of Stock') }}</span>
                                                @endif
                                            </div>
                                        </div>
                                    </div>

                                    <div class="d-flex align-items-center gap-2 pt-2 border-top mt-2">
                                        @if ($product->is_stock())
                                            @if ($product->item_type != 'affiliate')
                                                <a class="btn btn-sm btn-cart-action flex-grow-1 rounded-pill py-2 add_to_single_cart" href="javascript:;" data-target="{{ $product->id }}">
                                                    <i class="icon-shopping-cart mr-1"></i> {{ __('Add To Cart') }}
                                                </a>
                                            @endif
                                        @else
                                            <a class="btn btn-sm btn-outline-secondary flex-grow-1 rounded-pill py-2" href="{{ route('front.product', $product->slug) }}">
                                                {{ __('View Details') }}
                                            </a>
                                        @endif
                                        <a class="btn btn-sm btn-outline-danger rounded-circle p-2 d-inline-flex align-items-center justify-content-center" style="width: 36px; height: 36px;" href="{{ route('user.wishlist.delete', $product->getWishlistItemId()) }}" title="{{ __('Remove item') }}">
                                            <i class="icon-trash"></i>
                                        </a>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    @else
                        <!-- Clean Empty State -->
                        <div class="text-center py-5 px-3">
                            <div class="wishlist-empty-icon mb-3">
                                <i class="icon-heart"></i>
                            </div>
                            <h5 class="text-dark fw-bold mb-1">{{ __('Your Wishlist is Empty') }}</h5>
                            <p class="text-muted small mb-4" style="max-width: 360px; margin: 0 auto;">
                                {{ __('Explore our vast catalogue and tap the heart icon on any product to save it for later.') }}
                            </p>
                            <a href="{{ route('front.catalog') }}" class="btn btn-sm btn-primary-green rounded-pill px-4 py-2">
                                <i class="icon-shopping-cart mr-1"></i> {{ __('Explore Products') }}
                            </a>
                        </div>
                    @endif
                </div>
            </div>

        </div>
    </div>
</div>

<style>
.modern-wishlist-card {
    background: #ffffff !important;
    border-radius: 18px !important;
    overflow: hidden !important;
    border: 1px solid #e2e8f0 !important;
    box-shadow: 0 4px 20px rgba(0, 0, 0, 0.05) !important;
}

.custom-wishlist-table th {
    font-size: 12px !important;
    font-weight: 700 !important;
    text-transform: uppercase !important;
    letter-spacing: 0.5px !important;
    color: #64748b !important;
    padding: 14px 16px !important;
    border-bottom: 1px solid #e2e8f0 !important;
}

.custom-wishlist-table td {
    padding: 16px !important;
    font-size: 14px !important;
    border-bottom: 1px solid #f1f5f9 !important;
}

.wishlist-thumb-wrapper {
    width: 64px;
    height: 64px;
    border-radius: 10px;
    overflow: hidden;
    border: 1px solid #e2e8f0;
    display: inline-block;
    background: #f8fafc;
}

.wishlist-thumb-img {
    width: 100%;
    height: 100%;
    object-fit: cover;
    display: block;
}

.btn-cart-action {
    background: linear-gradient(135deg, #059669 0%, #047857 100%) !important;
    color: #ffffff !important;
    border: none !important;
    font-size: 13px !important;
    font-weight: 700 !important;
    box-shadow: 0 4px 12px rgba(5, 150, 105, 0.3) !important;
    transition: all 0.2s ease !important;
}

.btn-cart-action:hover {
    background: linear-gradient(135deg, #047857 0%, #065f46 100%) !important;
    color: #ffffff !important;
    transform: translateY(-2px) !important;
    box-shadow: 0 6px 18px rgba(5, 150, 105, 0.4) !important;
}

.wishlist-mobile-card {
    border: 1px solid #e2e8f0 !important;
    border-radius: 14px !important;
    transition: all 0.2s ease !important;
}

.wishlist-empty-icon {
    width: 72px;
    height: 72px;
    border-radius: 50%;
    background: #fef2f2;
    color: #ef4444;
    font-size: 32px;
    display: inline-flex;
    align-items: center;
    justify-content: center;
    margin: 0 auto;
}

.btn-primary-green {
    background: linear-gradient(135deg, #059669 0%, #047857 100%) !important;
    color: #ffffff !important;
    border: none !important;
    box-shadow: 0 4px 12px rgba(5, 150, 105, 0.3) !important;
    transition: all 0.2s ease !important;
}

.btn-primary-green:hover {
    background: linear-gradient(135deg, #047857 0%, #065f46 100%) !important;
    color: #ffffff !important;
    transform: translateY(-2px) !important;
    box-shadow: 0 6px 18px rgba(5, 150, 105, 0.4) !important;
}

.bg-success-subtle { background-color: #ecfdf5 !important; }
.bg-danger-subtle { background-color: #fef2f2 !important; }

.hover-primary:hover {
    color: #059669 !important;
}

@media (max-width: 767px) {
    .modern-wishlist-card {
        border-radius: 14px !important;
    }
}
</style>
@endsection

