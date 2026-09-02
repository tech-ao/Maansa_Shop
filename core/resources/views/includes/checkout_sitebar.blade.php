<aside class="sidebar checkout-sidebar-wrapper">
    <div class="padding-top-2x hidden-lg-up"></div>

    <!-- 1. Modern Order Summary Card -->
    <section class="checkout-summary-card mb-4">
        <div class="summary-card-header d-flex align-items-center justify-content-between pb-3 mb-3 border-bottom">
            <div class="d-flex align-items-center" style="gap: 12px;">
                <div class="summary-header-icon flex-shrink-0">
                    <i class="fa fa-receipt text-primary"></i>
                </div>
                <h3 class="summary-card-title mb-0 font-weight-bold" style="font-size: 16px; color: #0f172a;">
                    {{ __('Order Summary') }}
                </h3>
            </div>
            <span class="badge badge-light border text-muted px-2.5 py-1" style="border-radius: 999px; font-size: 11.5px; font-weight: 600;">
                {{ count($cart) }} {{ count($cart) == 1 ? __('Item') : __('Items') }}
            </span>
        </div>

        @php
            $free_shipping = DB::table('shipping_services')->whereStatus(1)->whereIsCondition(1)->first();
        @endphp

        @if ($free_shipping)
            @if ($free_shipping->minimum_price > $cart_total)
                <div class="free-shipping-progress-banner p-2.5 px-3 rounded mb-3" style="background: #f8fafc; border: 1px dashed #cbd5e1; font-size: 12.5px; color: #475569;">
                    <i class="fa fa-info-circle mr-1 text-primary"></i>
                    {{ __('Add') }} <strong class="text-dark">{{ PriceHelper::setCurrencyPrice($free_shipping->minimum_price - $cart_total) }}</strong> {{ __('more for Free Shipping!') }}
                </div>
            @else
                <div class="free-shipping-progress-banner p-2.5 px-3 rounded mb-3" style="background: #ecfdf5; border: 1px solid #a7f3d0; font-size: 12.5px; color: #065f46;">
                    <i class="fa fa-check-circle mr-1 text-success"></i>
                    <strong class="text-success">{{ __('You have unlocked Free Shipping!') }}</strong>
                </div>
            @endif
        @endif

        <div class="summary-breakdown-list">
            <div class="summary-row d-flex justify-content-between align-items-center py-2">
                <span class="text-muted" style="font-size: 13.5px;">{{ __('Cart subtotal') }}</span>
                <span class="font-weight-600 text-dark" style="font-size: 13.5px;">{{ PriceHelper::setCurrencyPrice($cart_total) }}</span>
            </div>

            @if ($tax != 0)
                <div class="summary-row d-flex justify-content-between align-items-center py-2">
                    <span class="text-muted" style="font-size: 13.5px;">{{ __('Estimated tax') }}</span>
                    <span class="font-weight-600 text-dark" style="font-size: 13.5px;">{{ PriceHelper::setCurrencyPrice($tax) }}</span>
                </div>
            @endif

            @if (DB::table('states')->count() > 0)
                <div class="summary-row d-flex justify-content-between align-items-center py-2 set__state_price_tr {{ Auth::check() && Auth::user()->state_id ? '' : 'd-none' }}">
                    <span class="text-muted" style="font-size: 13.5px;">{{ __('State tax') }}</span>
                    <span class="font-weight-600 text-dark set__state_price" style="font-size: 13.5px;">
                        {{ PriceHelper::setCurrencyPrice(Auth::check() && Auth::user()->state_id ? ($cart_total * Auth::user()->state->price) / 100 : 0) }}
                    </span>
                </div>
            @endif

            @if ($discount)
                <div class="summary-row d-flex justify-content-between align-items-center py-2">
                    <span class="text-muted" style="font-size: 13.5px;">{{ __('Coupon discount') }}</span>
                    <span class="font-weight-bold text-danger" style="font-size: 13.5px;">-{{ PriceHelper::setCurrencyPrice($discount ? $discount['discount'] : 0) }}</span>
                </div>
            @endif

            <div class="summary-row d-flex justify-content-between align-items-center py-2 set__shipping_price_tr {{ isset($shipping) && $shipping ? '' : 'd-none' }}">
                <span class="text-muted" style="font-size: 13.5px;">{{ __('Shipping') }}</span>
                <span class="font-weight-600 set__shipping_price" style="font-size: 13.5px;">
                    @if (isset($shipping) && $shipping && $shipping->price == 0)
                        <span class="badge badge-success font-weight-bold px-2 py-0.5" style="border-radius: 6px; font-size: 12px;">{{ __('Free') }}</span>
                    @else
                        {{ PriceHelper::setCurrencyPrice(isset($shipping) && $shipping ? $shipping->price : 0) }}
                    @endif
                </span>
            </div>
        </div>

        <!-- Total Highlight Card -->
        <div class="order-total-highlight-card mt-3 p-3 rounded d-flex justify-content-between align-items-center">
            <div>
                <span class="d-block font-weight-bold text-dark" style="font-size: 14px; letter-spacing: -0.01em;">
                    {{ __('Order Total') }}
                </span>
                <small class="text-muted d-block" style="font-size: 11px;">{{ __('Inclusive of all taxes & delivery') }}</small>
            </div>
            <div class="text-right">
                <span class="grand_total_set font-weight-800 text-primary d-block" style="font-size: 18.5px; line-height: 1.2;">
                    {{ PriceHelper::setCurrencyPrice($grand_total) }}
                </span>
            </div>
        </div>
    </section>

    <!-- 2. Modern Items In Cart Card -->
    <section class="checkout-cart-items-card">
        <div class="cart-items-card-header d-flex align-items-center justify-content-between pb-3 mb-3 border-bottom">
            <div class="d-flex align-items-center" style="gap: 12px;">
                <div class="cart-items-header-icon flex-shrink-0">
                    <i class="fa fa-shopping-bag text-primary"></i>
                </div>
                <h3 class="cart-items-card-title mb-0 font-weight-bold" style="font-size: 16px; color: #0f172a;">
                    {{ __('Items In Your Cart') }}
                </h3>
            </div>
            <a href="{{ route('front.cart') }}" class="text-primary font-weight-600 ml-auto" style="font-size: 13px; text-decoration: none; display: inline-flex; align-items: center; gap: 4px;">
                <i class="fa fa-pencil"></i> {{ __('Edit') }}
            </a>
        </div>

        <div class="checkout-items-list">
            @foreach ($cart as $key => $item)
                @php
                    $item_single_price = $item['main_price'] + $item['attribute_price'];
                    $item_total_price = $item_single_price * $item['qty'];
                @endphp
                <div class="checkout-item-card d-flex align-items-start py-3 {{ !$loop->last ? 'border-bottom' : '' }}" style="gap: 14px;">
                    <!-- Thumbnail with Badge -->
                    <div class="checkout-item-thumb-wrapper position-relative flex-shrink-0" style="width: 58px; height: 58px; min-width: 58px;">
                        <a href="{{ route('front.product', $item['slug']) }}" class="d-block w-100 h-100">
                            <img src="{{ url('/core/public/storage/images/' . $item['photo']) }}" alt="{{ $item['name'] }}" class="checkout-item-thumb">
                        </a>
                        <span class="checkout-item-qty-badge" style="top: -5px; right: -5px;">×{{ $item['qty'] }}</span>
                    </div>

                    <!-- Details -->
                    <div class="checkout-item-info flex-grow-1 min-w-0" style="padding-top: 2px;">
                        <h4 class="checkout-item-name mb-1">
                            <a href="{{ route('front.product', $item['slug']) }}" class="text-dark font-weight-600" title="{{ $item['name'] }}" style="font-size: 13.5px; line-height: 1.35; display: -webkit-box; -webkit-line-clamp: 2; -webkit-box-orient: vertical; overflow: hidden;">
                                {{ $item['name'] }}
                            </a>
                        </h4>

                        @if (isset($item['attribute']['option_name']) && count($item['attribute']['option_name']) > 0)
                            <div class="checkout-item-variants d-flex flex-wrap mb-1">
                                @foreach ($item['attribute']['option_name'] as $optionkey => $option_name)
                                    <span class="variant-pill-tag">
                                        {{ $option_name }}@if(!empty($item['attribute']['option_price'][$optionkey])): {{ PriceHelper::setCurrencySign() }}{{ $item['attribute']['option_price'][$optionkey] }}@endif
                                    </span>
                                @endforeach
                            </div>
                        @endif

                        <div class="d-flex align-items-center justify-content-between mt-1">
                            <span class="checkout-item-unit-price text-muted" style="font-size: 12px;">
                                {{ PriceHelper::setCurrencyPrice($item_single_price) }} / unit
                            </span>
                            <span class="checkout-item-total-price font-weight-bold text-dark" style="font-size: 13.5px;">
                                {{ PriceHelper::setCurrencyPrice($item_total_price) }}
                            </span>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </section>

</aside>
