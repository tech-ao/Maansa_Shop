@extends('master.front')
@section('title')
    {{__('Shopping Cart')}}
@endsection
@section('meta')
<meta name="keywords" content="{{$setting->meta_keywords}}">
<meta name="description" content="{{$setting->meta_description}}">
@endsection
@section('content')
    <!-- Page Title / Breadcrumbs -->
<div class="page-title">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <ul class="breadcrumbs">
                    <li><a href="{{route('front.index')}}">{{__('Home')}}</a> </li>
                    <li class="separator"></li>
                    <li>{{__('Shopping Cart')}}</li>
                  </ul>
            </div>
        </div>
    </div>
</div>

<div class="container padding-bottom-3x mb-4 mt-2">
    @if(Session::has('cart') && count(Session::get('cart')) > 0)
        <!-- Shopping Cart Grid & Summary -->
        <div id="view_cart_load">
            @include('includes.cart')
        </div>
    @else
        <div class="cart-empty-box text-center">
            <div class="cart-empty-icon">
                <i class="fas fa-shopping-bag"></i>
            </div>
            <h3 class="cart-empty-title">{{ __('Your Shopping Cart is Empty') }}</h3>
            <p class="cart-empty-desc">{{ __('Looks like you haven\'t added any items to your cart yet. Explore our curated collections and discover great deals!') }}</p>
            <a class="btn btn-primary px-4 py-2" href="{{ route('front.catalog') }}" style="border-radius: 12px; font-weight: 700; background: linear-gradient(135deg, #10b981 0%, #059669 100%); border: none; box-shadow: 0 4px 14px rgba(16, 185, 129, 0.4);">
                <i class="fas fa-arrow-left mr-2"></i> {{ __('Start Shopping') }}
            </a>
        </div>
    @endif
</div>

@endsection


