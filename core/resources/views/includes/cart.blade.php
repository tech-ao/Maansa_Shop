@php
    $cart = Session::has('cart') ? Session::get('cart') : [];
    $total = 0;
    $option_price = 0;
    $cartTotal = 0;
@endphp

<div class="card border-0 shadow-sm cart-main-card">
    <div class="card-body p-3 p-md-4">
        <div class="table-responsive shopping-cart">
            <table class="table table-bordered mb-0">
                <thead>
                    <tr>
                        <th>{{ __('Product Name') }}</th>
                        <th>{{ __('Product Price') }}</th>
                        <th class="text-center">{{ __('Quantity') }}</th>
                        <th class="text-center">{{ __('Subtotal') }}</th>
                        <th class="text-center"><a class="btn btn-sm btn-outline-danger"
                                href="{{ route('front.cart.clear') }}"><span>{{ __('Clear Cart') }}</span></a></th>
                    </tr>
                </thead>

                <tbody id="cart_view_load" data-target="{{ route('cart.get.load') }}">
                    @foreach ($cart as $key => $item)
                        @php
                            $cartTotal += ($item['main_price'] + $total + $item['attribute_price']) * $item['qty'];
                        @endphp
                        <tr>
                            <td>
                                <div class="product-item">
                                    <a class="product-thumb" href="{{ route('front.product', $item['slug']) }}">
                                        <img src="{{ url('/core/public/storage/images/' . $item['photo']) }}" alt="Product">
                                    </a>
                                    <div class="product-info">
                                        <h4 class="product-title">
                                            <a href="{{ route('front.product', $item['slug']) }}">
                                                {{ Str::limit($item['name'], 45) }}
                                            </a>
                                        </h4>
                                        @foreach ($item['attribute']['option_name'] as $optionkey => $option_name)
                                            <span class="d-block text-muted small">
                                                <em>{{ $item['attribute']['names'][$optionkey] }}:</em>
                                                <strong>{{ $option_name }}</strong>
                                                ({{ PriceHelper::setCurrencyPrice($item['attribute']['option_price'][$optionkey]) }})
                                            </span>
                                        @endforeach
                                    </div>
                                </div>
                            </td>
                            <td class="text-center text-lg product-price-col">
                                {{ PriceHelper::setCurrencyPrice($item['main_price']) }}
                            </td>

                            <td class="text-center product-qty-col">
                                @if ($item['item_type'] == 'normal')
                                    <div class="qtySelector product-quantity">
                                        <span class="decreaseQtycart cartsubclick" data-id="{{ $key }}"
                                            data-target="{{ PriceHelper::GetItemId($key) }}"><i
                                                class="fas fa-minus"></i></span>
                                        <input type="text" disabled class="qtyValue cartcart-amount"
                                            value="{{ $item['qty'] }}">
                                        <span class="increaseQtycart cartaddclick" data-id="{{ $key }}"
                                            data-target="{{ PriceHelper::GetItemId($key) }}"
                                            data-item="{{ implode(',', $item['options_id']) }}"><i
                                                class="fas fa-plus"></i></span>
                                        <input type="hidden" value="3333" id="current_stock">
                                    </div>
                                @endif
                            </td>
                            <td class="text-center text-lg product-subtotal-col">
                                {{ PriceHelper::setCurrencyPrice($item['main_price'] * $item['qty']) }}
                            </td>

                            <td class="text-center product-action-col">
                                <a class="remove-from-cart"
                                    href="{{ route('front.cart.destroy', $key) }}" data-toggle="tooltip"
                                    title="{{ __('Remove item') }}"><i class="icon-x"></i></a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>

<div class="card border-0 shadow-sm cart-summary-card mt-4">
    <div class="card-body p-3 p-md-4">
        <div class="shopping-cart-footer modern-cart-footer d-flex justify-content-between align-items-center flex-wrap gap-3">
            <div class="column coupon-col">
                <form class="coupon-form modern-coupon-form" method="post" id="coupon_form" action="{{ route('front.promo.submit') }}">
                    @csrf
                    <div class="input-group">
                        <input class="form-control" name="code" type="text"
                            placeholder="{{ __('Coupon code') }}" required>
                        <button class="btn btn-primary"
                            type="submit"><span>{{ __('Apply Coupon') }}</span></button>
                    </div>
                </form>
            </div>

            <div class="total-summary-col">
                <div class="text-right text-lg {{ Session::has('coupon') ? '' : 'd-none' }} discount-line">
                    <span class="text-muted">{{ __('Discount') }}
                        ({{ Session::has('coupon') ? Session::get('coupon')['code']['title'] : '' }}): </span>
                    <span class="text-danger font-weight-bold">-{{ PriceHelper::setCurrencyPrice(Session::has('coupon') ? Session::get('coupon')['discount'] : 0) }}</span>
                    <a class="remove-from-cart text-danger ml-2"
                        href="{{ route('front.promo.destroy') }}" data-toggle="tooltip"
                        title="{{ __('Remove coupon') }}"><i class="icon-x"></i></a>
                </div>

                <div class="text-right text-lg subtotal-line">
                    <span class="text-muted">{{ __('Subtotal') }}: </span>
                    <span class="cart-subtotal-amount">{{ PriceHelper::setCurrencyPrice($cartTotal - (Session::has('coupon') ? Session::get('coupon')['discount'] : 0)) }}</span>
                </div>
            </div>
        </div>

        <div class="cart-actions-row mt-4 pt-3 border-top d-flex justify-content-between align-items-center flex-wrap gap-2">
            <a class="btn btn-outline-secondary cart-back-btn" href="{{ route('front.catalog') }}">
                <i class="icon-arrow-left mr-1"></i> {{ __('Back to Shopping') }}
            </a>
            <a class="btn btn-primary cart-checkout-btn" href="{{ route('front.checkout.billing') }}">
                <span>{{ __('Proceed to Checkout') }}</span> <i class="icon-arrow-right ml-1"></i>
            </a>
        </div>
    </div>
</div>
