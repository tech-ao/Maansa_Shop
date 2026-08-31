<ul class="nav">
    <li class="nav-section-title">
        <span>{{ __('Main Menu') }}</span>
    </li>
    <li class="nav-item {{ request()->routeIs('seller.dashboard') ? 'active' : '' }}">
        <a href="{{ route('seller.dashboard') }}">
            <i class="fa-solid fa-gauge-high"></i>
            <p>{{ __('Dashboard') }}</p>
        </a>
    </li>

    <li class="nav-section-title">
        <span>{{ __('Store Management') }}</span>
    </li>
    @php
        $isProductActive = request()->routeIs('seller.item.*') || request()->routeIs('seller.bulk.product.*');
    @endphp
    <li class="nav-item {{ $isProductActive ? 'active submenu' : '' }}">
        <a data-toggle="collapse" href="#items" aria-expanded="{{ $isProductActive ? 'true' : 'false' }}">
            <i class="fa-solid fa-boxes-stacked"></i>
            <p>{{ __('Manage Products') }}</p>
            <span class="caret"></span>
        </a>
        <div class="collapse {{ $isProductActive ? 'show' : '' }}" id="items">
            <ul class="nav nav-collapse">
                <li class="{{ request()->routeIs('seller.item.add') ? 'active' : '' }}">
                    <a class="sub-link" href="{{ route('seller.item.add') }}">
                        <span class="sub-item">{{ __('Add Product') }}</span>
                    </a>
                </li>
                <li class="{{ request()->routeIs('seller.item.index') ? 'active' : '' }}">
                    <a class="sub-link" href="{{ route('seller.item.index') }}">
                        <span class="sub-item">{{ __('All Products') }}</span>
                    </a>
                </li>
                <li class="{{ request()->routeIs('seller.item.stock.out') ? 'active' : '' }}">
                    <a class="sub-link" href="{{ route('seller.item.stock.out') }}">
                        <span class="sub-item">{{ __('Stock Out Products') }}</span>
                    </a>
                </li>
                <li class="{{ request()->routeIs('seller.bulk.product.*') ? 'active' : '' }}">
                    <a class="sub-link" href="{{ route('seller.bulk.product.index') }}">
                        <span class="sub-item">{{ __('CSV Import & Export') }}</span>
                    </a>
                </li>
            </ul>
        </div>
    </li>

    @php
        $isOrderActive = request()->is('orders/*') || request()->is('admin/orders*') || request()->is('seller/orders*');
    @endphp
    <li class="nav-item {{ $isOrderActive ? 'active submenu' : '' }}">
        <a data-toggle="collapse" href="#order" aria-expanded="{{ $isOrderActive ? 'true' : 'false' }}">
            <i class="fa-solid fa-bag-shopping"></i>
            <p>{{ __('Manage Orders') }}</p>
            <span class="caret"></span>
        </a>
        <div class="collapse {{ $isOrderActive ? 'show' : '' }}" id="order">
            <ul class="nav nav-collapse">
                <li class="{{ !request()->input('type') && (request()->is('admin/orders') || request()->is('seller/orders')) ? 'active' : '' }}">
                    <a class="sub-link" href="{{ route('seller.order.index') }}">
                        <span class="sub-item">{{ __('All Orders') }}</span>
                    </a>
                </li>
                <li class="{{ request()->input('type') == 'Pending' ? 'active' : '' }}">
                    <a class="sub-link" href="{{ route('seller.order.index') . '?type=' . 'Pending' }}">
                        <span class="sub-item">{{ __('Pending Orders') }}</span>
                    </a>
                </li>
                <li class="{{ request()->input('type') == 'In Progress' ? 'active' : '' }}">
                    <a class="sub-link" href="{{ route('seller.order.index') . '?type=' . 'In Progress' }}">
                        <span class="sub-item">{{ __('Progress Orders') }}</span>
                    </a>
                </li>
                <li class="{{ request()->input('type') == 'Delivered' ? 'active' : '' }}">
                    <a class="sub-link" href="{{ route('seller.order.index') . '?type=' . 'Delivered' }}">
                        <span class="sub-item">{{ __('Delivered Orders') }}</span>
                    </a>
                </li>
                <li class="{{ request()->input('type') == 'Canceled' ? 'active' : '' }}">
                    <a class="sub-link" href="{{ route('seller.order.index') . '?type=' . 'Canceled' }}">
                        <span class="sub-item">{{ __('Canceled Orders') }}</span>
                    </a>
                </li>
            </ul>
        </div>
    </li>

    <li class="nav-item {{ request()->routeIs('seller.transaction.*') ? 'active' : '' }}">
        <a href="{{ route('seller.transaction.index') }}">
            <i class="fa-solid fa-arrow-right-arrow-left"></i>
            <p>{{ __('Transactions') }}</p>
        </a>
    </li>

    @php
        $isEcomActive = request()->routeIs('seller.shipping.*');
    @endphp
    <li class="nav-item {{ $isEcomActive ? 'active submenu' : '' }}">
        <a data-toggle="collapse" href="#ecommerce" aria-expanded="{{ $isEcomActive ? 'true' : 'false' }}">
            <i class="fa-solid fa-store"></i>
            <p>{{ __('Ecommerce') }}</p>
            <span class="caret"></span>
        </a>
        <div class="collapse {{ $isEcomActive ? 'show' : '' }}" id="ecommerce">
            <ul class="nav nav-collapse">
                <li class="{{ request()->routeIs('seller.shipping.*') ? 'active' : '' }}">
                    <a class="sub-link" href="{{ route('seller.shipping.index') }}">
                        <span class="sub-item">{{ __('Shipping') }}</span>
                    </a>
                </li>
            </ul>
        </div>
    </li>

</ul>
