@php
    $cart = Session::has('cart') ? Session::get('cart') : [];
    $total = 0;
    $option_price = 0;
    $cartTotal = 0;
    $itemCount = 0;
    foreach ($cart as $key => $item) {
        $cartTotal += ($item['main_price'] + $total + $item['attribute_price']) * $item['qty'];
        $itemCount += $item['qty'];
    }
    $discount = Session::has('coupon') ? Session::get('coupon')['discount'] : 0;
    $grandTotal = $cartTotal - $discount;
@endphp

<style>
    /* ==========================================================================
       MODERN SHOPPING CART STYLES (DESKTOP & MOBILE)
       ========================================================================== */
    .cart-box-card {
        background: #ffffff;
        border-radius: 18px;
        border: 1px solid #e2e8f0;
        box-shadow: 0 4px 20px -4px rgba(0, 0, 0, 0.05);
        overflow: hidden;
    }
    .cart-box-header {
        padding: 20px 24px;
        border-bottom: 1px solid #f1f5f9;
        background: #ffffff;
    }
    .cart-header-icon {
        width: 44px;
        height: 44px;
        min-width: 44px;
        border-radius: 12px;
        background: #ecfdf5;
        color: #059669;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 19px;
    }
    .cart-header-title {
        font-size: 17px;
        font-weight: 700;
        color: #0f172a;
        margin: 0;
    }
    .cart-header-subtitle {
        font-size: 13px;
        color: #64748b;
        font-weight: 500;
    }
    .btn-clear-cart {
        display: inline-flex;
        align-items: center;
        padding: 7px 14px;
        border-radius: 999px;
        background: #fff1f2;
        color: #e11d48 !important;
        font-size: 12.5px;
        font-weight: 600;
        border: 1px solid #ffe4e6;
        text-decoration: none !important;
        transition: all 0.2s ease;
    }
    .btn-clear-cart:hover {
        background: #ffe4e6;
        color: #be123c !important;
        transform: translateY(-1px);
    }

    /* Desktop Cart Table */
    .cart-table {
        width: 100%;
        border-collapse: separate;
        border-spacing: 0;
    }
    .cart-table thead th {
        background: #f8fafc;
        padding: 14px 20px;
        font-size: 12.5px;
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: 0.5px;
        color: #475569;
        border-bottom: 1px solid #e2e8f0;
        border-top: none;
    }
    .cart-table tbody tr {
        border-bottom: 1px solid #f1f5f9;
        transition: background-color 0.15s ease;
    }
    .cart-table tbody tr:last-child {
        border-bottom: none;
    }
    .cart-table tbody tr:hover {
        background-color: #fafbfc;
    }
    .cart-table tbody td {
        padding: 18px 20px;
        vertical-align: middle;
        border: none;
        border-bottom: 1px solid #f1f5f9;
    }

    /* Product Item Cell */
    .cart-product-cell {
        display: flex;
        align-items: center;
        gap: 16px;
    }
    .cart-img-wrap {
        width: 72px;
        height: 72px;
        min-width: 72px;
        border-radius: 12px;
        border: 1px solid #e2e8f0;
        overflow: hidden;
        background: #f8fafc;
        display: flex;
        align-items: center;
        justify-content: center;
        padding: 4px;
        transition: transform 0.2s ease, box-shadow 0.2s ease;
    }
    .cart-img-wrap:hover {
        transform: scale(1.04);
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.08);
    }
    .cart-img-wrap img {
        width: 100%;
        height: 100%;
        object-fit: contain;
    }
    .cart-info-wrap {
        flex: 1;
        min-width: 0;
    }
    .cart-prod-title {
        font-size: 14px;
        font-weight: 600;
        line-height: 1.4;
        margin: 0 0 6px 0;
    }
    .cart-prod-title a {
        color: #0f172a;
        text-decoration: none;
        transition: color 0.15s ease;
    }
    .cart-prod-title a:hover {
        color: #059669;
    }
    .cart-attributes-list {
        display: flex;
        flex-wrap: wrap;
        gap: 6px;
    }
    .cart-attr-badge {
        display: inline-flex;
        align-items: center;
        gap: 4px;
        background: #f1f5f9;
        border: 1px solid #e2e8f0;
        padding: 2px 8px;
        border-radius: 6px;
        font-size: 11.5px;
        color: #475569;
    }
    .cart-attr-badge .attr-name {
        color: #64748b;
        font-weight: 500;
    }
    .cart-attr-badge .attr-val {
        color: #0f172a;
        font-weight: 600;
    }
    .cart-attr-badge .attr-price {
        color: #059669;
        font-weight: 600;
    }

    /* Unit Price & Subtotal */
    .cart-unit-price {
        font-size: 14.5px;
        font-weight: 600;
        color: #334155;
    }
    .cart-line-total {
        font-size: 15.5px;
        font-weight: 700;
        color: #0f172a;
    }

    /* Modern Stepper */
    .cart-qty-stepper {
        display: inline-flex;
        align-items: center;
        background: #ffffff;
        border: 1.5px solid #cbd5e1;
        border-radius: 10px;
        overflow: hidden;
        box-shadow: 0 1px 2px rgba(0, 0, 0, 0.04);
    }
    .cart-qty-stepper .qty-btn {
        width: 34px;
        height: 34px;
        background: #f8fafc;
        border: none;
        color: #475569;
        font-size: 12px;
        cursor: pointer;
        display: flex;
        align-items: center;
        justify-content: center;
        transition: all 0.15s ease;
        padding: 0;
    }
    .cart-qty-stepper .qty-btn:hover {
        background: #10b981;
        color: #ffffff;
    }
    .cart-qty-stepper .qty-input {
        width: 40px;
        height: 34px;
        border: none;
        border-left: 1px solid #e2e8f0;
        border-right: 1px solid #e2e8f0;
        background: #ffffff;
        text-align: center;
        font-weight: 700;
        font-size: 13.5px;
        color: #0f172a;
        padding: 0;
    }

    /* Remove Button */
    .cart-item-del-btn {
        width: 36px;
        height: 36px;
        border-radius: 50%;
        background: #fff1f2;
        color: #f43f5e !important;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        font-size: 13px;
        transition: all 0.2s ease;
        text-decoration: none !important;
        border: 1px solid #ffe4e6;
    }
    .cart-item-del-btn:hover {
        background: #f43f5e;
        color: #ffffff !important;
        transform: scale(1.1);
        box-shadow: 0 4px 10px rgba(244, 63, 94, 0.35);
    }

    /* Cart Box Footer */
    .cart-box-footer {
        padding: 16px 24px;
        background: #f8fafc;
        border-top: 1px solid #e2e8f0;
    }
    .btn-continue-shopping {
        display: inline-flex;
        align-items: center;
        font-size: 13.5px;
        font-weight: 600;
        color: #475569 !important;
        text-decoration: none !important;
        padding: 8px 16px;
        border-radius: 10px;
        background: #ffffff;
        border: 1px solid #cbd5e1;
        transition: all 0.2s ease;
    }
    .btn-continue-shopping:hover {
        background: #f1f5f9;
        color: #0f172a !important;
        border-color: #94a3b8;
    }

    /* Mobile Card Layout */
    .cart-mobile-items-list {
        padding: 14px;
    }
    .cart-mobile-item {
        background: #ffffff;
        border: 1px solid #e2e8f0;
        border-radius: 14px;
        padding: 14px;
        margin-bottom: 12px;
        box-shadow: 0 2px 8px rgba(0, 0, 0, 0.03);
    }
    .cart-mobile-item:last-child {
        margin-bottom: 0;
    }
    .cart-mobile-top {
        display: flex;
        gap: 12px;
    }
    .cart-mob-img {
        width: 70px;
        height: 70px;
        min-width: 70px;
        border-radius: 10px;
        border: 1px solid #e2e8f0;
        background: #f8fafc;
        overflow: hidden;
        display: flex;
        align-items: center;
        justify-content: center;
        padding: 4px;
    }
    .cart-mob-img img {
        width: 100%;
        height: 100%;
        object-fit: contain;
    }
    .cart-mob-details {
        flex: 1;
        min-width: 0;
    }
    .cart-mob-title {
        font-size: 13.5px;
        font-weight: 600;
        line-height: 1.35;
        margin: 0;
    }
    .cart-mob-title a {
        color: #0f172a;
        text-decoration: none;
    }
    .cart-mob-del-btn {
        width: 30px;
        height: 30px;
        min-width: 30px;
        border-radius: 50%;
        background: #fff1f2;
        color: #f43f5e !important;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        font-size: 12px;
        border: 1px solid #ffe4e6;
        text-decoration: none !important;
    }
    .cart-mob-attrs {
        display: flex;
        flex-wrap: wrap;
        gap: 4px;
        margin-top: 4px;
    }
    .cart-mob-attr-tag {
        font-size: 11px;
        background: #f1f5f9;
        padding: 2px 6px;
        border-radius: 4px;
        color: #475569;
    }
    .cart-mob-unit-price {
        font-size: 13.5px;
        font-weight: 600;
        color: #059669;
    }

    /* ==========================================================================
       ORDER SUMMARY SIDEBAR
       ========================================================================== */
    .cart-summary-sticky {
        position: sticky;
        top: 100px;
    }
    .cart-summary-card {
        background: #ffffff;
        border-radius: 18px;
        border: 1px solid #e2e8f0;
        box-shadow: 0 4px 20px -4px rgba(0, 0, 0, 0.05);
        overflow: hidden;
    }
    .cart-summary-header {
        padding: 18px 22px;
        border-bottom: 1px solid #f1f5f9;
        background: #fafbfc;
    }
    .summary-title {
        font-size: 16px;
        font-weight: 700;
        color: #0f172a;
        margin: 0;
    }
    .cart-summary-body {
        padding: 22px;
    }

    /* Coupon Section */
    .coupon-label {
        display: block;
        font-size: 12.5px;
        font-weight: 600;
        color: #334155;
        margin-bottom: 8px;
    }
    .coupon-input-group {
        display: flex;
        align-items: center;
        position: relative;
        background: #f8fafc;
        border: 1.5px solid #cbd5e1;
        border-radius: 12px;
        padding: 3px;
        transition: all 0.2s ease;
    }
    .coupon-input-group:focus-within {
        border-color: #10b981;
        background: #ffffff;
        box-shadow: 0 0 0 3px rgba(16, 185, 129, 0.15);
    }
    .coupon-icon-prefix {
        width: 36px;
        display: flex;
        align-items: center;
        justify-content: center;
        color: #94a3b8;
        font-size: 14px;
    }
    .coupon-field {
        flex: 1;
        min-width: 0;
        border: none;
        background: transparent;
        font-size: 13.5px;
        font-weight: 600;
        color: #0f172a;
        padding: 6px 8px;
        outline: none;
    }
    .coupon-field::placeholder {
        color: #94a3b8;
        font-weight: 400;
    }
    .coupon-apply-btn {
        background: linear-gradient(135deg, #10b981, #059669);
        color: #ffffff;
        border: none;
        padding: 8px 18px;
        border-radius: 9px;
        font-size: 13px;
        font-weight: 700;
        cursor: pointer;
        transition: all 0.2s ease;
        box-shadow: 0 2px 6px rgba(16, 185, 129, 0.3);
    }
    .coupon-apply-btn:hover {
        background: linear-gradient(135deg, #059669, #047857);
        transform: translateY(-1px);
        box-shadow: 0 4px 10px rgba(16, 185, 129, 0.4);
    }

    /* Applied Coupon Pill */
    .applied-coupon-pill {
        background: #ecfdf5;
        border: 1px solid #a7f3d0;
        border-radius: 10px;
        padding: 8px 12px;
        font-size: 12.5px;
    }
    .remove-coupon-btn {
        color: #ef4444 !important;
        font-size: 14px;
        transition: transform 0.15s ease;
        text-decoration: none !important;
    }
    .remove-coupon-btn:hover {
        transform: scale(1.15);
        color: #dc2626 !important;
    }

    /* Summary Breakdown */
    .summary-row {
        font-size: 14px;
        color: #475569;
    }
    .summary-row .summary-value {
        color: #0f172a;
    }
    .summary-divider {
        height: 1px;
        background: #e2e8f0;
    }

    /* Checkout Button */
    .btn-proceed-checkout {
        display: flex;
        align-items: center;
        justify-content: center;
        width: 100%;
        padding: 14px 20px;
        border-radius: 12px;
        background: linear-gradient(135deg, #10b981 0%, #059669 100%);
        color: #ffffff !important;
        font-size: 15px;
        font-weight: 700;
        text-decoration: none !important;
        box-shadow: 0 6px 18px -2px rgba(16, 185, 129, 0.45);
        transition: all 0.25s cubic-bezier(0.4, 0, 0.2, 1);
        border: none;
    }
    .btn-proceed-checkout:hover {
        background: linear-gradient(135deg, #059669 0%, #047857 100%);
        transform: translateY(-2px);
        box-shadow: 0 10px 24px -2px rgba(16, 185, 129, 0.55);
        color: #ffffff !important;
    }

    /* Trust Box */
    .trust-item {
        display: flex;
        flex-direction: column;
        align-items: center;
        gap: 4px;
    }
    .trust-icon {
        font-size: 18px;
        color: #059669;
    }
    .trust-text {
        font-size: 11px;
        font-weight: 600;
        color: #64748b;
    }
</style>

<!-- Hidden Target for AJAX Cart Refreshing -->
<div id="cart_view_load" data-target="{{ route('cart.get.load') }}" style="display:none;"></div>

<div class="modern-cart-container">
    <div class="row">
        <!-- Left: Cart Items (8 cols on lg+) -->
        <div class="col-lg-8 mb-4 mb-lg-0">
            <div class="cart-box-card">
                <!-- Header -->
                <div class="cart-box-header d-flex align-items-center justify-content-between flex-wrap">
                    <div class="d-flex align-items-center mb-2 mb-sm-0">
                        <div class="cart-header-icon mr-3">
                            <i class="fas fa-shopping-bag"></i>
                        </div>
                        <div>
                            <h4 class="cart-header-title mb-0">{{ __('Shopping Cart') }}</h4>
                            <span class="cart-header-subtitle text-muted">{{ count($cart) }} {{ count($cart) == 1 ? __('item') : __('items') }}</span>
                        </div>
                    </div>
                    <div>
                        <a href="{{ route('front.cart.clear') }}" class="btn-clear-cart" onclick="return confirm('{{ __('Are you sure you want to clear your cart?') }}')">
                            <i class="far fa-trash-alt mr-1"></i> {{ __('Clear Cart') }}
                        </a>
                    </div>
                </div>

                <!-- Desktop Table View (visible on md and up) -->
                <div class="d-none d-md-block">
                    <div class="table-responsive">
                        <table class="cart-table">
                            <thead>
                                <tr>
                                    <th class="th-product" style="width: 45%;">{{ __('Product Name') }}</th>
                                    <th class="th-price text-center" style="width: 15%;">{{ __('Price') }}</th>
                                    <th class="th-qty text-center" style="width: 20%;">{{ __('Quantity') }}</th>
                                    <th class="th-subtotal text-right" style="width: 15%;">{{ __('Subtotal') }}</th>
                                    <th class="th-action text-center" style="width: 5%;"></th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($cart as $key => $item)
                                    @php
                                        $itemUnitPrice = $item['main_price'] + $item['attribute_price'];
                                        $itemLineTotal = $itemUnitPrice * $item['qty'];
                                    @endphp
                                    <tr class="cart-item-row">
                                        <td class="td-product">
                                            <div class="cart-product-cell">
                                                <a href="{{ route('front.product', $item['slug']) }}" class="cart-img-wrap">
                                                    <img src="{{ url('/core/public/storage/images/' . $item['photo']) }}" alt="{{ $item['name'] }}">
                                                </a>
                                                <div class="cart-info-wrap">
                                                    <h5 class="cart-prod-title">
                                                        <a href="{{ route('front.product', $item['slug']) }}">{{ $item['name'] }}</a>
                                                    </h5>
                                                    @if(!empty($item['attribute']['option_name']))
                                                        <div class="cart-attributes-list">
                                                            @foreach ($item['attribute']['option_name'] as $optionkey => $option_name)
                                                                <span class="cart-attr-badge">
                                                                    <span class="attr-name">{{ $item['attribute']['names'][$optionkey] }}:</span>
                                                                    <span class="attr-val">{{ $option_name }}</span>
                                                                    @if(isset($item['attribute']['option_price'][$optionkey]) && $item['attribute']['option_price'][$optionkey] > 0)
                                                                        <span class="attr-price">(+{{ PriceHelper::setCurrencyPrice($item['attribute']['option_price'][$optionkey]) }})</span>
                                                                    @endif
                                                                </span>
                                                            @endforeach
                                                        </div>
                                                    @endif
                                                </div>
                                            </div>
                                        </td>
                                        <td class="td-price text-center">
                                            <span class="cart-unit-price">{{ PriceHelper::setCurrencyPrice($itemUnitPrice) }}</span>
                                        </td>
                                        <td class="td-qty text-center">
                                            @if ($item['item_type'] == 'normal')
                                                <div class="qtySelector product-quantity cart-qty-stepper">
                                                    <span class="decreaseQtycart cartsubclick qty-btn minus" data-id="{{ $key }}" data-target="{{ PriceHelper::GetItemId($key) }}">
                                                        <i class="fas fa-minus"></i>
                                                    </span>
                                                    <input type="text" disabled class="qtyValue cartcart-amount qty-input" value="{{ $item['qty'] }}">
                                                    <span class="increaseQtycart cartaddclick qty-btn plus" data-id="{{ $key }}" data-target="{{ PriceHelper::GetItemId($key) }}" data-item="{{ implode(',', $item['options_id']) }}">
                                                        <i class="fas fa-plus"></i>
                                                    </span>
                                                    <input type="hidden" value="3333" id="current_stock">
                                                </div>
                                            @else
                                                <span class="badge badge-light font-weight-bold">1</span>
                                            @endif
                                        </td>
                                        <td class="td-subtotal text-right">
                                            <span class="cart-line-total">{{ PriceHelper::setCurrencyPrice($itemLineTotal) }}</span>
                                        </td>
                                        <td class="td-action text-center">
                                            <a class="remove-from-cart cart-item-del-btn" href="{{ route('front.cart.destroy', $key) }}" data-toggle="tooltip" title="{{ __('Remove item') }}">
                                                <i class="fas fa-trash-alt"></i>
                                            </a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>

                <!-- Mobile Card View (visible on < md screens) -->
                <div class="d-md-none cart-mobile-items-list">
                    @foreach ($cart as $key => $item)
                        @php
                            $itemUnitPrice = $item['main_price'] + $item['attribute_price'];
                            $itemLineTotal = $itemUnitPrice * $item['qty'];
                        @endphp
                        <div class="cart-mobile-item">
                            <div class="cart-mobile-top">
                                <a href="{{ route('front.product', $item['slug']) }}" class="cart-mob-img">
                                    <img src="{{ url('/core/public/storage/images/' . $item['photo']) }}" alt="{{ $item['name'] }}">
                                </a>
                                <div class="cart-mob-details">
                                    <div class="d-flex justify-content-between align-items-start">
                                        <h5 class="cart-mob-title">
                                            <a href="{{ route('front.product', $item['slug']) }}">{{ $item['name'] }}</a>
                                        </h5>
                                        <a class="remove-from-cart cart-mob-del-btn ml-2" href="{{ route('front.cart.destroy', $key) }}" title="{{ __('Remove') }}">
                                            <i class="fas fa-trash-alt"></i>
                                        </a>
                                    </div>
                                    @if(!empty($item['attribute']['option_name']))
                                        <div class="cart-mob-attrs">
                                            @foreach ($item['attribute']['option_name'] as $optionkey => $option_name)
                                                <span class="cart-mob-attr-tag">
                                                    {{ $item['attribute']['names'][$optionkey] }}: <strong>{{ $option_name }}</strong>
                                                </span>
                                            @endforeach
                                        </div>
                                    @endif
                                    <div class="cart-mob-unit-price mt-1">
                                        {{ PriceHelper::setCurrencyPrice($itemUnitPrice) }}
                                    </div>
                                </div>
                            </div>
                            <div class="cart-mobile-bottom d-flex justify-content-between align-items-center pt-2 mt-2 border-top">
                                <div>
                                    @if ($item['item_type'] == 'normal')
                                        <div class="qtySelector product-quantity cart-qty-stepper">
                                            <span class="decreaseQtycart cartsubclick qty-btn minus" data-id="{{ $key }}" data-target="{{ PriceHelper::GetItemId($key) }}">
                                                <i class="fas fa-minus"></i>
                                            </span>
                                            <input type="text" disabled class="qtyValue cartcart-amount qty-input" value="{{ $item['qty'] }}">
                                            <span class="increaseQtycart cartaddclick qty-btn plus" data-id="{{ $key }}" data-target="{{ PriceHelper::GetItemId($key) }}" data-item="{{ implode(',', $item['options_id']) }}">
                                                <i class="fas fa-plus"></i>
                                            </span>
                                        </div>
                                    @else
                                        <span class="badge badge-light">Qty: 1</span>
                                    @endif
                                </div>
                                <div class="text-right">
                                    <span class="text-muted small d-block" style="font-size: 11px; font-weight: 600;">{{ __('Total') }}</span>
                                    <span class="cart-mob-line-total font-weight-bold text-dark" style="font-size: 15px;">{{ PriceHelper::setCurrencyPrice($itemLineTotal) }}</span>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>

                <!-- Card Footer Actions -->
                <div class="cart-box-footer d-flex justify-content-between align-items-center">
                    <a href="{{ route('front.catalog') }}" class="btn-continue-shopping">
                        <i class="fas fa-arrow-left mr-2"></i> {{ __('Continue Shopping') }}
                    </a>
                </div>
            </div>
        </div>

        <!-- Right: Order Summary Sticky Sidebar (4 cols on lg+) -->
        <div class="col-lg-4">
            <div class="cart-summary-sticky">
                <div class="cart-summary-card">
                    <div class="cart-summary-header">
                        <h4 class="summary-title">{{ __('Order Summary') }}</h4>
                    </div>

                    <div class="cart-summary-body">
                        <!-- Coupon Form -->
                        <div class="cart-coupon-section mb-4">
                            <label class="coupon-label">{{ __('Have a Coupon or Promo Code?') }}</label>
                            <form class="coupon-form" method="post" id="coupon_form" action="{{ route('front.promo.submit') }}">
                                @csrf
                                <div class="coupon-input-group">
                                    <div class="coupon-icon-prefix">
                                        <i class="fas fa-tags"></i>
                                    </div>
                                    <input type="text" name="code" class="coupon-field" placeholder="{{ __('Enter coupon code') }}" required>
                                    <button type="submit" class="coupon-apply-btn">
                                        {{ __('Apply') }}
                                    </button>
                                </div>
                            </form>

                            @if(Session::has('coupon'))
                                <div class="applied-coupon-pill d-flex align-items-center justify-content-between mt-2">
                                    <div class="d-flex align-items-center">
                                        <i class="fas fa-check-circle text-success mr-2"></i>
                                        <span class="coupon-code-name font-weight-bold">{{ Session::get('coupon')['code']['title'] }}</span>
                                    </div>
                                    <div class="d-flex align-items-center">
                                        <span class="coupon-save-val text-success font-weight-bold mr-2">-{{ PriceHelper::setCurrencyPrice($discount) }}</span>
                                        <a href="{{ route('front.promo.destroy') }}" class="remove-coupon-btn" data-toggle="tooltip" title="{{ __('Remove coupon') }}">
                                            <i class="fas fa-times-circle"></i>
                                        </a>
                                    </div>
                                </div>
                            @endif
                        </div>

                        <!-- Price Breakdown -->
                        <div class="summary-breakdown">
                            <div class="summary-row d-flex justify-content-between align-items-center mb-2">
                                <span class="summary-label">{{ __('Subtotal') }}</span>
                                <span class="summary-value font-weight-600">{{ PriceHelper::setCurrencyPrice($cartTotal) }}</span>
                            </div>

                            @if(Session::has('coupon'))
                                <div class="summary-row discount-row d-flex justify-content-between align-items-center mb-2 text-success">
                                    <span class="summary-label">{{ __('Discount') }}</span>
                                    <span class="summary-value font-weight-600">-{{ PriceHelper::setCurrencyPrice($discount) }}</span>
                                </div>
                            @endif

                            <div class="summary-divider my-3"></div>

                            <div class="summary-row total-row d-flex justify-content-between align-items-center mb-3">
                                <div>
                                    <span class="total-label d-block font-weight-bold text-dark" style="font-size: 16px;">{{ __('Estimated Total') }}</span>
                                    <span class="tax-note text-muted small" style="font-size: 11.5px;">{{ __('Taxes & shipping calculated at checkout') }}</span>
                                </div>
                                <span class="total-amount font-weight-bold text-success" style="font-size: 22px;">{{ PriceHelper::setCurrencyPrice($grandTotal) }}</span>
                            </div>
                        </div>

                        <!-- Checkout CTA Button -->
                        <div class="checkout-action-wrap mt-3">
                            <a href="{{ route('front.checkout.billing') }}" class="btn-proceed-checkout">
                                <span>{{ __('Proceed to Checkout') }}</span>
                                <i class="fas fa-arrow-right ml-2"></i>
                            </a>
                        </div>

                        <!-- Trust Features Box -->
                        <div class="cart-trust-box mt-4 pt-3 border-top">
                            <div class="row text-center g-2">
                                <div class="col-4">
                                    <div class="trust-item">
                                        <i class="fas fa-shield-alt trust-icon"></i>
                                        <span class="trust-text">{{ __('Secure Payment') }}</span>
                                    </div>
                                </div>
                                <div class="col-4">
                                    <div class="trust-item">
                                        <i class="fas fa-truck-fast trust-icon"></i>
                                        <span class="trust-text">{{ __('Fast Delivery') }}</span>
                                    </div>
                                </div>
                                <div class="col-4">
                                    <div class="trust-item">
                                        <i class="fas fa-rotate-left trust-icon"></i>
                                        <span class="trust-text">{{ __('Easy Returns') }}</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
