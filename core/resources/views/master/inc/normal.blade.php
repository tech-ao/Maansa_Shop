<ul class="nav">
    <li class="nav-section-title">
        <span>{{ __('Main Menu') }}</span>
    </li>
    <li class="nav-item {{ request()->routeIs('back.dashboard') ? 'active' : '' }}">
        <a href="{{ route('back.dashboard') }}">
            <i class="fa-solid fa-gauge-high"></i>
            <p>{{ __('Dashboard') }}</p>
        </a>
    </li>

    @php
        if(Auth::guard('admin')->user()->role && Auth::guard('admin')->user()->role->section != 'null'){
            $section = json_decode(Auth::guard('admin')->user()->role->section,true);
        }else{
            $section = [];
        }
    @endphp

    @if (in_array('Manage Categories',$section) || in_array('Manage Products',$section) || in_array('Manage Orders',$section) || in_array('Transactions',$section) || in_array('Ecommerce',$section))
    <li class="nav-section-title">
        <span>{{ __('Store Management') }}</span>
    </li>
    @endif

    @if (in_array('Manage Categories',$section))
    @php
        $isCatActive = request()->routeIs('back.category.*') || request()->routeIs('back.subcategory.*') || request()->routeIs('back.childcategory.*');
    @endphp
    <li class="nav-item {{ $isCatActive ? 'active submenu' : '' }}">
        <a data-toggle="collapse" href="#category" aria-expanded="{{ $isCatActive ? 'true' : 'false' }}">
            <i class="fa-solid fa-layer-group"></i>
            <p>{{ __('Manage Categories') }}</p>
            <span class="caret"></span>
        </a>
        <div class="collapse {{ $isCatActive ? 'show' : '' }}" id="category">
            <ul class="nav nav-collapse">
                <li class="{{ request()->routeIs('back.category.*') ? 'active' : '' }}">
                    <a class="sub-link" href="{{ route('back.category.index') }}">
                        <span class="sub-item">{{ __('Categories') }}</span>
                    </a>
                </li>
                <li class="{{ request()->routeIs('back.subcategory.*') ? 'active' : '' }}">
                    <a class="sub-link" href="{{ route('back.subcategory.index') }}">
                        <span class="sub-item">{{ __('Sub categories') }}</span>
                    </a>
                </li>
                <li class="{{ request()->routeIs('back.childcategory.*') ? 'active' : '' }}">
                    <a class="sub-link" href="{{ route('back.childcategory.index') }}">
                        <span class="sub-item">{{ __('Child categories') }}</span>
                    </a>
                </li>
            </ul>
        </div>
    </li>
    @endif

    @if (in_array('Manage Products',$section))
    @php
        $isProductActive = request()->routeIs('back.brand.*') || request()->routeIs('back.item.*') || request()->routeIs('back.campaign.*') || request()->routeIs('back.bulk.product.*') || request()->routeIs('back.review.*');
    @endphp
    <li class="nav-item {{ $isProductActive ? 'active submenu' : '' }}">
        <a data-toggle="collapse" href="#items" aria-expanded="{{ $isProductActive ? 'true' : 'false' }}">
            <i class="fa-solid fa-boxes-stacked"></i>
            <p>{{ __('Manage Products') }}</p>
            <span class="caret"></span>
        </a>
        <div class="collapse {{ $isProductActive ? 'show' : '' }}" id="items">
            <ul class="nav nav-collapse">
                <li class="{{ request()->routeIs('back.brand.*') ? 'active' : '' }}">
                    <a class="sub-link" href="{{ route('back.brand.index') }}">
                        <span class="sub-item">{{ __('Brands') }}</span>
                    </a>
                </li>
                <li class="{{ request()->routeIs('back.item.add') ? 'active' : '' }}">
                    <a class="sub-link" href="{{ route('back.item.add') }}">
                        <span class="sub-item">{{ __('Add Product') }}</span>
                    </a>
                </li>
                <li class="{{ request()->routeIs('back.item.index') ? 'active' : '' }}">
                    <a class="sub-link" href="{{ route('back.item.index') }}">
                        <span class="sub-item">{{ __('All Products') }}</span>
                    </a>
                </li>
                <li class="{{ request()->routeIs('back.item.stock.out') ? 'active' : '' }}">
                    <a class="sub-link" href="{{ route('back.item.stock.out') }}">
                        <span class="sub-item">{{ __('Stock Out Products') }}</span>
                    </a>
                </li>
                <li class="{{ request()->routeIs('back.campaign.*') ? 'active' : '' }}">
                    <a class="sub-link" href="{{ route('back.campaign.index') }}">
                        <span class="sub-item">{{ __('Campaign Offer') }}</span>
                    </a>
                </li>
                <li class="{{ request()->routeIs('back.bulk.product.*') ? 'active' : '' }}">
                    <a class="sub-link" href="{{ route('back.bulk.product.index') }}">
                        <span class="sub-item">{{ __('CSV Import & Export') }}</span>
                    </a>
                </li>
                <li class="{{ request()->routeIs('back.review.*') ? 'active' : '' }}">
                    <a class="sub-link" href="{{ route('back.review.index') }}">
                        <span class="sub-item">{{ __('Product Reviews') }}</span>
                    </a>
                </li>
            </ul>
        </div>
    </li>
    @endif

    @if (in_array('Manage Orders',$section))
    @php
        $isOrderActive = request()->is('orders/*') || request()->is('admin/orders*');
    @endphp
    <li class="nav-item {{ $isOrderActive ? 'active submenu' : '' }}">
        <a data-toggle="collapse" href="#order" aria-expanded="{{ $isOrderActive ? 'true' : 'false' }}">
            <i class="fa-solid fa-bag-shopping"></i>
            <p>{{ __('Manage Orders') }}</p>
            <span class="caret"></span>
        </a>
        <div class="collapse {{ $isOrderActive ? 'show' : '' }}" id="order">
            <ul class="nav nav-collapse">
                <li class="{{ !request()->input('type') && request()->is('admin/orders') ? 'active' : '' }}">
                    <a class="sub-link" href="{{ route('back.order.index') }}">
                        <span class="sub-item">{{ __('All Orders') }}</span>
                    </a>
                </li>
                <li class="{{ request()->input('type') == 'Pending' ? 'active' : '' }}">
                    <a class="sub-link" href="{{ route('back.order.index').'?type='.'Pending' }}">
                        <span class="sub-item">{{ __('Pending Orders') }}</span>
                    </a>
                </li>
                <li class="{{ request()->input('type') == 'In Progress' ? 'active' : '' }}">
                    <a class="sub-link" href="{{ route('back.order.index').'?type='.'In Progress' }}">
                        <span class="sub-item">{{ __('Progress Orders') }}</span>
                    </a>
                </li>
                <li class="{{ request()->input('type') == 'Delivered' ? 'active' : '' }}">
                    <a class="sub-link" href="{{ route('back.order.index').'?type='.'Delivered' }}">
                        <span class="sub-item">{{ __('Delivered Orders') }}</span>
                    </a>
                </li>
                <li class="{{ request()->input('type') == 'Canceled' ? 'active' : '' }}">
                    <a class="sub-link" href="{{ route('back.order.index').'?type='.'Canceled' }}">
                        <span class="sub-item">{{ __('Canceled Orders') }}</span>
                    </a>
                </li>
            </ul>
        </div>
    </li>
    @endif

    @if (in_array('Transactions',$section))
    <li class="nav-item {{ request()->routeIs('back.transaction.*') ? 'active' : '' }}">
        <a href="{{ route('back.transaction.index') }}">
            <i class="fa-solid fa-arrow-right-arrow-left"></i>
            <p>{{ __('Transactions') }}</p>
        </a>
    </li>
    @endif

    @if (in_array('Ecommerce',$section))
    @php
        $isEcomActive = request()->routeIs('back.code.*') || request()->routeIs('back.shipping.*') || request()->routeIs('back.state.*') || request()->routeIs('back.tax.*') || request()->routeIs('back.currency.*') || request()->routeIs('back.setting.payment');
    @endphp
    <li class="nav-item {{ $isEcomActive ? 'active submenu' : '' }}">
        <a data-toggle="collapse" href="#ecommerce" aria-expanded="{{ $isEcomActive ? 'true' : 'false' }}">
            <i class="fa-solid fa-store"></i>
            <p>{{ __('Ecommerce') }}</p>
            <span class="caret"></span>
        </a>
        <div class="collapse {{ $isEcomActive ? 'show' : '' }}" id="ecommerce">
            <ul class="nav nav-collapse">
                <li class="{{ request()->routeIs('back.code.*') ? 'active' : '' }}">
                    <a class="sub-link" href="{{ route('back.code.index') }}">
                        <span class="sub-item">{{ __('Set Coupons') }}</span>
                    </a>
                </li>
                <li class="{{ request()->routeIs('back.shipping.*') ? 'active' : '' }}">
                    <a class="sub-link" href="{{ route('back.shipping.index') }}">
                        <span class="sub-item">{{ __('Shipping') }}</span>
                    </a>
                </li>
                <li class="{{ request()->routeIs('back.state.*') ? 'active' : '' }}">
                    <a class="sub-link" href="{{ route('back.state.index') }}">
                        <span class="sub-item">{{ __('State Charge') }}</span>
                    </a>
                </li>
                <li class="{{ request()->routeIs('back.tax.*') ? 'active' : '' }}">
                    <a class="sub-link" href="{{ route('back.tax.index') }}">
                        <span class="sub-item">{{ __('Tax') }}</span>
                    </a>
                </li>
                <li class="{{ request()->routeIs('back.currency.*') ? 'active' : '' }}">
                    <a class="sub-link" href="{{ route('back.currency.index') }}">
                        <span class="sub-item">{{ __('Currency') }}</span>
                    </a>
                </li>
                <li class="{{ request()->routeIs('back.setting.payment') ? 'active' : '' }}">
                    <a class="sub-link" href="{{ route('back.setting.payment') }}">
                        <span class="sub-item">{{ __('Payment') }}</span>
                    </a>
                </li>
            </ul>
        </div>
    </li>
    @endif

    @if (in_array('Customer List',$section) || in_array('Manages Tickets',$section) || in_array('Subscribers List',$section))
    <li class="nav-section-title">
        <span>{{ __('Customers & Support') }}</span>
    </li>
    @endif

    @if (in_array('Customer List',$section))
    <li class="nav-item {{ request()->routeIs('back.user.*') ? 'active' : '' }}">
        <a href="{{ route('back.user.index') }}">
            <i class="fa-solid fa-users"></i>
            <p>{{ __('Customer List') }}</p>
        </a>
    </li>
    @endif

    @if (in_array('Manages Tickets',$section))
    <li class="nav-item {{ request()->routeIs('back.ticket.*') ? 'active' : '' }}">
        <a href="{{ route('back.ticket.index') }}">
            <i class="fa-solid fa-headset"></i>
            <p>{{ __('Manage Tickets') }}</p>
        </a>
    </li>
    @endif

    @if (in_array('Subscribers List',$section))
    <li class="nav-item {{ request()->routeIs('back.subscribers.*') ? 'active' : '' }}">
        <a href="{{ route('back.subscribers.index') }}">
            <i class="fa-solid fa-envelope-open-text"></i>
            <p>{{ __('Subscribers List') }}</p>
        </a>
    </li>
    @endif

    @if (in_array('Manage Site',$section) || in_array('Manage Faqs Contents',$section) || in_array('Manage Blogs',$section) || in_array('Manages Pages',$section))
    <li class="nav-section-title">
        <span>{{ __('Content & Customization') }}</span>
    </li>
    @endif

    @if (in_array('Manage Site',$section))
    @php
        $isSiteActive = request()->routeIs('back.setting.*') || request()->routeIs('back.menu.*') || request()->routeIs('back.homePage') || request()->routeIs('back.slider.*') || request()->routeIs('back.service.*') || request()->routeIs('back.cookie.alert') || request()->routeIs('admin.sitemap.*') || request()->routeIs('back.language.*') || request()->routeIs('back.subscribers.announcement');
    @endphp
    <li class="nav-item {{ $isSiteActive ? 'active submenu' : '' }}">
        <a data-toggle="collapse" href="#content" aria-expanded="{{ $isSiteActive ? 'true' : 'false' }}">
            <i class="fa-solid fa-sliders"></i>
            <p>{{ __('Manage Site') }}</p>
            <span class="caret"></span>
        </a>
        <div class="collapse {{ $isSiteActive ? 'show' : '' }}" id="content">
            <ul class="nav nav-collapse">
                <li class="{{ request()->routeIs('back.setting.system') ? 'active' : '' }}">
                    <a class="sub-link" href="{{ route('back.setting.system') }}">
                        <span class="sub-item">{{ __('General Settings') }}</span>
                    </a>
                </li>
                <li class="{{ request()->routeIs('back.menu.*') ? 'active' : '' }}">
                    <a class="sub-link" href="{{ route('back.menu.index') }}">
                        <span class="sub-item">{{ __('Menu Builder') }}</span>
                    </a>
                </li>
                <li class="{{ request()->routeIs('back.homePage') ? 'active' : '' }}">
                    <a class="sub-link" href="{{ route('back.homePage') }}">
                        <span class="sub-item">{{ __('Home Page') }}</span>
                    </a>
                </li>
                <li class="{{ request()->routeIs('back.slider.*') ? 'active' : '' }}">
                    <a class="sub-link" href="{{ route('back.slider.index') }}">
                        <span class="sub-item">{{ __('Sliders') }}</span>
                    </a>
                </li>
                <li class="{{ request()->routeIs('back.service.*') ? 'active' : '' }}">
                    <a class="sub-link" href="{{ route('back.service.index') }}">
                        <span class="sub-item">{{ __('Services') }}</span>
                    </a>
                </li>
                <li class="{{ request()->routeIs('back.setting.section') ? 'active' : '' }}">
                    <a class="sub-link" href="{{ route('back.setting.section') }}">
                        <span class="sub-item">{{ __('Visibility') }}</span>
                    </a>
                </li>
                <li class="{{ request()->routeIs('back.setting.social') ? 'active' : '' }}">
                    <a class="sub-link" href="{{ route('back.setting.social') }}">
                        <span class="sub-item">{{ __('Social Login') }}</span>
                    </a>
                </li>
                <li class="{{ request()->routeIs('back.setting.email') ? 'active' : '' }}">
                    <a class="sub-link" href="{{ route('back.setting.email') }}">
                        <span class="sub-item">{{ __('Email Settings') }}</span>
                    </a>
                </li>
                <li class="{{ request()->routeIs('back.setting.sms') ? 'active' : '' }}">
                    <a class="sub-link" href="{{ route('back.setting.sms') }}">
                        <span class="sub-item">{{ __('SMS Settings') }}</span>
                    </a>
                </li>
                <li class="{{ request()->routeIs('back.subscribers.announcement') ? 'active' : '' }}">
                    <a class="sub-link" href="{{ route('back.subscribers.announcement') }}">
                        <span class="sub-item">{{ __('Announcement') }}</span>
                    </a>
                </li>
                <li class="{{ request()->routeIs('back.cookie.alert') ? 'active' : '' }}">
                    <a class="sub-link" href="{{ route('back.cookie.alert') }}">
                        <span class="sub-item">{{ __('Cookies Alert') }}</span>
                    </a>
                </li>
                <li class="{{ request()->routeIs('back.setting.maintainance') ? 'active' : '' }}">
                    <a class="sub-link" href="{{ route('back.setting.maintainance') }}">
                        <span class="sub-item">{{ __('Maintainance') }}</span>
                    </a>
                </li>
                <li class="{{ request()->routeIs('admin.sitemap.*') ? 'active' : '' }}">
                    <a class="sub-link" href="{{ route('admin.sitemap.index') }}">
                        <span class="sub-item">{{ __('Sitemap') }}</span>
                    </a>
                </li>
                <li class="{{ request()->routeIs('back.language.*') ? 'active' : '' }}">
                    <a class="sub-link" href="{{ route('back.language.index') }}">
                        <span class="sub-item">{{ __('Language') }}</span>
                    </a>
                </li>
            </ul>
        </div>
    </li>
    @endif

    @if (in_array('Manage Faqs Contents',$section))
    @php
        $isFaqActive = request()->routeIs('back.fcategory.*') || request()->routeIs('back.faq.*');
    @endphp
    <li class="nav-item {{ $isFaqActive ? 'active submenu' : '' }}">
        <a data-toggle="collapse" href="#faqs" aria-expanded="{{ $isFaqActive ? 'true' : 'false' }}">
            <i class="fa-solid fa-circle-question"></i>
            <p>{{ __('Manage Faqs') }}</p>
            <span class="caret"></span>
        </a>
        <div class="collapse {{ $isFaqActive ? 'show' : '' }}" id="faqs">
            <ul class="nav nav-collapse">
                <li class="{{ request()->routeIs('back.fcategory.*') ? 'active' : '' }}">
                    <a class="sub-link" href="{{ route('back.fcategory.index') }}">
                        <span class="sub-item">{{ __('Categories') }}</span>
                    </a>
                </li>
                <li class="{{ request()->routeIs('back.faq.*') ? 'active' : '' }}">
                    <a class="sub-link" href="{{ route('back.faq.index') }}">
                        <span class="sub-item">{{ __('Faqs') }}</span>
                    </a>
                </li>
            </ul>
        </div>
    </li>
    @endif

    @if (in_array('Manage Blogs',$section))
    @php
        $isBlogActive = request()->routeIs('back.bcategory.*') || request()->routeIs('back.post.*');
    @endphp
    <li class="nav-item {{ $isBlogActive ? 'active submenu' : '' }}">
        <a data-toggle="collapse" href="#post" aria-expanded="{{ $isBlogActive ? 'true' : 'false' }}">
            <i class="fa-solid fa-newspaper"></i>
            <p>{{ __('Manage Blogs') }}</p>
            <span class="caret"></span>
        </a>
        <div class="collapse {{ $isBlogActive ? 'show' : '' }}" id="post">
            <ul class="nav nav-collapse">
                <li class="{{ request()->routeIs('back.bcategory.*') ? 'active' : '' }}">
                    <a class="sub-link" href="{{ route('back.bcategory.index') }}">
                        <span class="sub-item">{{ __('Categories') }}</span>
                    </a>
                </li>
                <li class="{{ request()->routeIs('back.post.*') ? 'active' : '' }}">
                    <a class="sub-link" href="{{ route('back.post.index') }}">
                        <span class="sub-item">{{ __('Blogs') }}</span>
                    </a>
                </li>
            </ul>
        </div>
    </li>
    @endif

    @if (in_array('Manages Pages',$section))
    <li class="nav-item {{ request()->routeIs('back.page.*') ? 'active' : '' }}">
        <a href="{{ route('back.page.index') }}">
            <i class="fa-solid fa-file-lines"></i>
            <p>{{ __('Manage Pages') }}</p>
        </a>
    </li>
    @endif

    @if (in_array('Manage System User',$section) || in_array('System Backup',$section))
    <li class="nav-section-title">
        <span>{{ __('System & Administration') }}</span>
    </li>
    @endif

    @if (in_array('Manage System User',$section))
    @php
        $isUserActive = request()->routeIs('back.role.*') || request()->routeIs('back.staff.*');
    @endphp
    <li class="nav-item {{ $isUserActive ? 'active submenu' : '' }}">
        <a data-toggle="collapse" href="#user" aria-expanded="{{ $isUserActive ? 'true' : 'false' }}">
            <i class="fa-solid fa-user-shield"></i>
            <p>{{ __('System User') }}</p>
            <span class="caret"></span>
        </a>
        <div class="collapse {{ $isUserActive ? 'show' : '' }}" id="user">
            <ul class="nav nav-collapse">
                <li class="{{ request()->routeIs('back.role.*') ? 'active' : '' }}">
                    <a class="sub-link" href="{{ route('back.role.index') }}">
                        <span class="sub-item">{{ __('Role') }}</span>
                    </a>
                </li>
                <li class="{{ request()->routeIs('back.staff.*') ? 'active' : '' }}">
                    <a class="sub-link" href="{{ route('back.staff.index') }}">
                        <span class="sub-item">{{ __('System User') }}</span>
                    </a>
                </li>
            </ul>
        </div>
    </li>
    @endif

    @if (in_array('System Backup',$section))
    @php
        $isBackupActive = request()->routeIs('back.system.backup') || request()->routeIs('back.database.backup');
    @endphp
    <li class="nav-item {{ $isBackupActive ? 'active submenu' : '' }}">
        <a data-toggle="collapse" href="#backup" aria-expanded="{{ $isBackupActive ? 'true' : 'false' }}">
            <i class="fa-solid fa-database"></i>
            <p>{{ __('System Backup') }}</p>
            <span class="caret"></span>
        </a>
        <div class="collapse {{ $isBackupActive ? 'show' : '' }}" id="backup">
            <ul class="nav nav-collapse">
                <li class="{{ request()->routeIs('back.system.backup') ? 'active' : '' }}">
                    <a class="sub-link" href="{{ route('back.system.backup') }}">
                        <span class="sub-item">{{ __('System Backup') }}</span>
                    </a>
                </li>
                <li class="{{ request()->routeIs('back.database.backup') ? 'active' : '' }}">
                    <a class="sub-link" href="{{ route('back.database.backup') }}">
                        <span class="sub-item">{{ __('Database Backup') }}</span>
                    </a>
                </li>
            </ul>
        </div>
    </li>
    @endif

    <li class="nav-item">
        <a href="{{ route('front.cache.clear') }}">
            <i class="fa-solid fa-broom"></i>
            <p>{{ __('Cache Clear') }}</p>
        </a>
    </li>

</ul>
