@extends('master.back')

@section('styles')
<style>
    /* ==========================================================================
       NOTIFICATIONS CENTER - MODERN ACTIVITY FEED
       ========================================================================== */
    
    /* Hero Banner */
    .notif-hero-card {
        background: linear-gradient(135deg, #064e3b 0%, #047857 50%, #059669 100%);
        border-radius: 20px;
        padding: 24px 28px;
        color: #ffffff;
        box-shadow: 0 16px 36px -10px rgba(6, 78, 59, 0.4), 0 0 0 1px rgba(255, 255, 255, 0.1) inset;
        margin-bottom: 24px;
        position: relative;
        overflow: hidden;
    }
    .notif-hero-card::before {
        content: '';
        position: absolute;
        right: -40px;
        top: -40px;
        width: 220px;
        height: 220px;
        border-radius: 50%;
        background: radial-gradient(circle, rgba(255, 255, 255, 0.15) 0%, rgba(255, 255, 255, 0) 70%);
        pointer-events: none;
    }
    .notif-hero-card::after {
        content: '';
        position: absolute;
        left: 30%;
        bottom: -60px;
        width: 160px;
        height: 160px;
        border-radius: 50%;
        background: radial-gradient(circle, rgba(16, 185, 129, 0.25) 0%, rgba(16, 185, 129, 0) 70%);
        pointer-events: none;
    }
    .notif-hero-icon {
        width: 52px;
        height: 52px;
        border-radius: 16px;
        background: rgba(255, 255, 255, 0.18);
        border: 1.5px solid rgba(255, 255, 255, 0.35);
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 22px;
        color: #ffffff;
        flex-shrink: 0;
        box-shadow: 0 8px 16px rgba(0, 0, 0, 0.1);
    }
    .notif-hero-btn {
        border-radius: 12px;
        font-size: 13px;
        font-weight: 700;
        padding: 9px 18px;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        gap: 8px;
        transition: all 0.25s cubic-bezier(0.4, 0, 0.2, 1);
        text-decoration: none !important;
        border: none;
        cursor: pointer;
    }
    .notif-hero-btn-primary {
        background: #ffffff;
        color: #047857 !important;
        box-shadow: 0 6px 16px rgba(0, 0, 0, 0.15);
    }
    .notif-hero-btn-primary:hover {
        background: #f0fdf4;
        color: #064e3b !important;
        transform: translateY(-2px);
        box-shadow: 0 10px 22px rgba(0, 0, 0, 0.2);
    }
    .notif-hero-btn-danger {
        background: rgba(239, 68, 68, 0.22);
        border: 1px solid rgba(255, 255, 255, 0.3);
        color: #ffffff !important;
    }
    .notif-hero-btn-danger:hover {
        background: rgba(239, 68, 68, 0.4);
        color: #ffffff !important;
        transform: translateY(-2px);
    }
    .notif-hero-btn-glass {
        background: rgba(255, 255, 255, 0.16);
        border: 1px solid rgba(255, 255, 255, 0.3);
        color: #ffffff !important;
    }
    .notif-hero-btn-glass:hover {
        background: rgba(255, 255, 255, 0.28);
        color: #ffffff !important;
        transform: translateY(-2px);
    }

    /* Stat Quick Pills */
    .notif-stat-pill {
        display: inline-flex;
        align-items: center;
        gap: 6px;
        padding: 4px 12px;
        border-radius: 9999px;
        background: rgba(255, 255, 255, 0.18);
        border: 1px solid rgba(255, 255, 255, 0.25);
        font-size: 12px;
        font-weight: 700;
        color: #ffffff;
    }

    /* Filter & Search Bar Container */
    .notif-toolbar-card {
        background: #ffffff;
        border: 1.5px solid #e2e8f0;
        border-radius: 18px;
        padding: 14px 18px;
        margin-bottom: 20px;
        box-shadow: 0 4px 14px rgba(15, 23, 42, 0.03);
    }
    .notif-filter-tabs {
        display: flex;
        align-items: center;
        gap: 8px;
        overflow-x: auto;
        padding-bottom: 2px;
        scrollbar-width: none;
        -webkit-overflow-scrolling: touch;
    }
    .notif-filter-tabs::-webkit-scrollbar {
        display: none;
    }
    .notif-tab-btn {
        padding: 8px 16px;
        border-radius: 9999px;
        font-size: 13px;
        font-weight: 700;
        border: 1.5px solid #e2e8f0;
        background: #f8fafc;
        color: #475569;
        display: inline-flex;
        align-items: center;
        gap: 6px;
        cursor: pointer;
        transition: all 0.2s cubic-bezier(0.4, 0, 0.2, 1);
        white-space: nowrap;
        text-decoration: none !important;
        outline: none !important;
    }
    .notif-tab-btn:hover {
        background: #f1f5f9;
        border-color: #cbd5e1;
        color: #0f172a;
    }
    .notif-tab-btn.active {
        background: linear-gradient(135deg, #10b981 0%, #059669 100%) !important;
        border-color: #059669 !important;
        color: #ffffff !important;
        box-shadow: 0 4px 12px rgba(16, 185, 129, 0.3) !important;
    }
    .notif-tab-btn.active .notif-tab-badge {
        background: rgba(255, 255, 255, 0.28) !important;
        color: #ffffff !important;
    }
    .notif-tab-badge {
        padding: 2px 7px;
        border-radius: 12px;
        background: #e2e8f0;
        color: #475569;
        font-size: 11px;
        font-weight: 800;
        line-height: 1;
        transition: all 0.2s;
    }
    .notif-search-wrap {
        position: relative;
        min-width: 220px;
    }
    .notif-search-icon {
        position: absolute;
        left: 14px;
        top: 50%;
        transform: translateY(-50%);
        color: #94a3b8;
        font-size: 13px;
        pointer-events: none;
    }
    .notif-search-input {
        width: 100%;
        padding: 8px 14px 8px 36px;
        border-radius: 9999px;
        border: 1.5px solid #e2e8f0;
        background: #f8fafc;
        font-size: 13px;
        color: #1e293b;
        transition: all 0.2s;
        outline: none;
    }
    .notif-search-input:focus {
        background: #ffffff;
        border-color: #10b981;
        box-shadow: 0 0 0 3px rgba(16, 185, 129, 0.15);
    }

    /* Notification Activity Feed Items */
    .notif-feed-container {
        display: flex;
        flex-direction: column;
        gap: 12px;
    }
    .notif-item-card {
        background: #ffffff;
        border: 1.5px solid #e2e8f0;
        border-radius: 16px;
        padding: 16px 20px;
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 18px;
        transition: all 0.25s cubic-bezier(0.4, 0, 0.2, 1);
        position: relative;
        box-shadow: 0 2px 8px rgba(15, 23, 42, 0.02);
    }
    .notif-item-card:hover {
        border-color: #cbd5e1;
        box-shadow: 0 10px 25px -5px rgba(15, 23, 42, 0.08);
        transform: translateY(-2px);
    }
    .notif-item-card.is-unread {
        background: #f0fdf4 !important;
        border-color: #86efac !important;
        border-left: 4.5px solid #10b981 !important;
        box-shadow: 0 4px 18px rgba(16, 185, 129, 0.09);
    }
    
    /* Left Avatar Squircles */
    .notif-avatar-box {
        width: 48px;
        height: 48px;
        min-width: 48px;
        border-radius: 14px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 19px;
        flex-shrink: 0;
        transition: transform 0.2s ease;
    }
    .notif-item-card:hover .notif-avatar-box {
        transform: scale(1.05);
    }
    .notif-avatar-order {
        background: linear-gradient(135deg, #10b981 0%, #059669 100%);
        color: #ffffff;
        box-shadow: 0 4px 12px rgba(16, 185, 129, 0.25);
    }
    .notif-avatar-user {
        background: linear-gradient(135deg, #3b82f6 0%, #1d4ed8 100%);
        color: #ffffff;
        box-shadow: 0 4px 12px rgba(59, 130, 246, 0.25);
    }

    /* Category Badges */
    .notif-category-chip {
        display: inline-flex;
        align-items: center;
        gap: 5px;
        font-size: 11px;
        font-weight: 800;
        text-transform: uppercase;
        letter-spacing: 0.5px;
        padding: 3px 9px;
        border-radius: 7px;
        line-height: 1.2;
    }
    .notif-chip-order {
        background: #ecfdf5;
        color: #047857;
        border: 1px solid #a7f3d0;
    }
    .notif-chip-user {
        background: #eff6ff;
        color: #1d4ed8;
        border: 1px solid #bfdbfe;
    }
    .notif-unread-badge {
        background: linear-gradient(135deg, #ef4444 0%, #dc2626 100%);
        color: #ffffff;
        font-size: 10px;
        font-weight: 800;
        padding: 3px 8px;
        border-radius: 6px;
        letter-spacing: 0.4px;
        box-shadow: 0 2px 6px rgba(239, 68, 68, 0.35);
        display: inline-flex;
        align-items: center;
        gap: 4px;
    }
    .notif-unread-dot {
        width: 6px;
        height: 6px;
        border-radius: 50%;
        background: #ffffff;
        display: inline-block;
        animation: notifPulse 1.8s infinite;
    }
    @keyframes notifPulse {
        0%, 100% { opacity: 1; transform: scale(1); }
        50% { opacity: 0.4; transform: scale(0.85); }
    }

    /* Action Buttons */
    .notif-btn-action {
        padding: 8px 18px;
        border-radius: 11px;
        font-size: 12.5px;
        font-weight: 700;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        gap: 6px;
        text-decoration: none !important;
        transition: all 0.2s cubic-bezier(0.4, 0, 0.2, 1);
        white-space: nowrap;
        height: 38px;
    }
    .notif-btn-invoice {
        background: linear-gradient(135deg, #10b981 0%, #059669 100%);
        color: #ffffff !important;
        border: none;
        box-shadow: 0 3px 10px rgba(16, 185, 129, 0.3);
    }
    .notif-btn-invoice:hover {
        background: linear-gradient(135deg, #059669 0%, #047857 100%);
        box-shadow: 0 5px 15px rgba(16, 185, 129, 0.4);
        transform: translateY(-1px);
    }
    .notif-btn-user {
        background: linear-gradient(135deg, #3b82f6 0%, #1d4ed8 100%);
        color: #ffffff !important;
        border: none;
        box-shadow: 0 3px 10px rgba(59, 130, 246, 0.3);
    }
    .notif-btn-user:hover {
        background: linear-gradient(135deg, #2563eb 0%, #1e40af 100%);
        box-shadow: 0 5px 15px rgba(59, 130, 246, 0.4);
        transform: translateY(-1px);
    }
    .notif-btn-delete {
        width: 38px;
        height: 38px;
        min-width: 38px;
        border-radius: 11px;
        background: #fff1f2;
        color: #e11d48 !important;
        border: 1.5px solid #fecdd3;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        transition: all 0.2s ease;
        text-decoration: none !important;
        cursor: pointer;
    }
    .notif-btn-delete:hover {
        background: #ffe4e6;
        border-color: #fda4af;
        color: #be123c !important;
        transform: scale(1.06);
    }

    /* Mobile Responsive Optimizations (< 768px) */
    @media (max-width: 767.98px) {
        .notif-hero-card {
            padding: 18px 16px;
            border-radius: 16px;
            margin-bottom: 16px;
        }
        .notif-hero-row {
            flex-direction: column !important;
            align-items: flex-start !important;
            gap: 16px;
        }
        .notif-hero-actions {
            width: 100%;
            display: flex;
            flex-direction: column;
            gap: 8px;
        }
        .notif-hero-btn {
            width: 100%;
            padding: 10px 14px;
            font-size: 12.5px;
        }
        .notif-toolbar-card {
            padding: 12px;
            border-radius: 14px;
            margin-bottom: 16px;
        }
        .notif-toolbar-flex {
            flex-direction: column !important;
            align-items: stretch !important;
            gap: 10px;
        }
        .notif-search-wrap {
            min-width: 100%;
        }
        .notif-item-card {
            flex-direction: column;
            align-items: stretch;
            padding: 14px 15px;
            gap: 12px;
            border-radius: 14px;
        }
        .notif-mobile-header {
            display: flex;
            align-items: center;
            justify-content: space-between;
            width: 100%;
            gap: 10px;
        }
        .notif-avatar-box {
            width: 42px;
            height: 42px;
            min-width: 42px;
            font-size: 16px;
            border-radius: 12px;
        }
        .notif-card-actions {
            display: flex;
            align-items: center;
            gap: 8px;
            border-top: 1px solid #f1f5f9;
            padding-top: 10px;
            width: 100%;
        }
        .notif-btn-action {
            flex-grow: 1;
            width: auto;
            font-size: 12px;
        }
    }
</style>
@endsection

@section('content')

@php
    $allNotifications = $data ?? App\Models\Notification::with(['order', 'user'])->orderby('id','desc')->get();
    $totalCount = $allNotifications->count();
    $unreadCount = $allNotifications->where('is_read', 0)->count();
    $orderCount = $allNotifications->whereNotNull('order_id')->count();
    $userCount = $allNotifications->whereNotNull('user_id')->count();
@endphp

<!-- Start of Main Content -->
<div class="container-fluid">

	<!-- Hero Header Banner -->
    <div class="notif-hero-card">
        <div class="d-flex align-items-center justify-content-between notif-hero-row flex-wrap gap-3">
            <div class="d-flex align-items-center">
                <div class="notif-hero-icon mr-3">
                    <i class="fa-solid fa-bell"></i>
                </div>
                <div>
                    <div class="d-flex align-items-center flex-wrap gap-2 mb-1">
                        <h2 class="font-weight-bold text-white mb-0" style="font-size: 21px; letter-spacing: 0.2px;">
                            {{ __('Notifications Center') }}
                        </h2>
                        <span class="notif-stat-pill">
                            <i class="fa-solid fa-layer-group" style="font-size: 11px;"></i>
                            <span id="headerTotalCount">{{ $totalCount }}</span> {{ __('Total') }}
                        </span>
                        @if($unreadCount > 0)
                            <span class="notif-stat-pill" style="background: rgba(239, 68, 68, 0.35); border-color: rgba(254, 202, 202, 0.4);" id="headerUnreadPill">
                                <span class="notif-unread-dot"></span>
                                <span id="headerUnreadCount">{{ $unreadCount }}</span> {{ __('Unread') }}
                            </span>
                        @endif
                    </div>
                    <p class="text-white small mb-0" style="font-size: 13px; opacity: 0.9;">
                        {{ __('Review real-time store purchase orders, customer registrations, and activity logs.') }}
                    </p>
                </div>
            </div>
            
            <div class="notif-hero-actions d-flex align-items-center gap-2 flex-wrap">
                <button type="button" id="btnMarkAllRead" class="notif-hero-btn notif-hero-btn-primary" data-url="{{ route('back.notifications.read') }}">
                    <i class="fa-solid fa-check-double text-success"></i>
                    <span>{{ __('Mark All as Read') }}</span>
                </button>
                @if($totalCount > 0)
                    <a href="javascript:;" data-toggle="modal" data-target="#confirm-clear-all" class="notif-hero-btn notif-hero-btn-danger">
                        <i class="fa-solid fa-trash-can"></i>
                        <span>{{ __('Clear All') }}</span>
                    </a>
                @endif
                <a href="{{ route('back.dashboard') }}" class="notif-hero-btn notif-hero-btn-glass">
                    <i class="fa-solid fa-chart-pie"></i>
                    <span>{{ __('Dashboard') }}</span>
                </a>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-12">
            @include('alerts.alerts')
        </div>
    </div>

    <!-- Filter & Search Bar -->
    <div class="notif-toolbar-card">
        <div class="d-flex align-items-center justify-content-between flex-wrap notif-toolbar-flex gap-2">
            <!-- Filter Tabs -->
            <div class="notif-filter-tabs">
                <button type="button" class="notif-tab-btn active" data-filter="all">
                    <i class="fa-solid fa-list-ul"></i>
                    <span>{{ __('All Alerts') }}</span>
                    <span class="notif-tab-badge" id="tabCountAll">{{ $totalCount }}</span>
                </button>
                <button type="button" class="notif-tab-btn" data-filter="order">
                    <i class="fa-solid fa-cart-shopping text-success"></i>
                    <span>{{ __('Orders') }}</span>
                    <span class="notif-tab-badge" id="tabCountOrder">{{ $orderCount }}</span>
                </button>
                <button type="button" class="notif-tab-btn" data-filter="user">
                    <i class="fa-solid fa-user-plus text-primary"></i>
                    <span>{{ __('Customers') }}</span>
                    <span class="notif-tab-badge" id="tabCountUser">{{ $userCount }}</span>
                </button>
                <button type="button" class="notif-tab-btn {{ $unreadCount == 0 ? 'd-none' : '' }}" data-filter="unread" id="tabBtnUnread">
                    <i class="fa-solid fa-circle-dot text-danger"></i>
                    <span>{{ __('Unread') }}</span>
                    <span class="notif-tab-badge text-danger font-weight-bold" style="background: #fee2e2;" id="tabCountUnread">{{ $unreadCount }}</span>
                </button>
            </div>

            <!-- Search Filter -->
            <div class="notif-search-wrap">
                <i class="fa-solid fa-magnifying-glass notif-search-icon"></i>
                <input type="text" id="notifSearchInput" class="notif-search-input" placeholder="{{ __('Search orders, names, dates...') }}" autocomplete="off">
            </div>
        </div>
    </div>

    <!-- Notification Activity Feed List -->
    <div class="notif-feed-container" id="notifFeedList">
        @forelse($allNotifications as $notf)
            @php
                $isOrder = ($notf->order_id != null);
                $isUser = ($notf->user_id != null);
                $itemType = $isOrder ? 'order' : ($isUser ? 'user' : 'other');
                $isUnread = ($notf->is_read == 0);
            @endphp

            <div class="notif-item-card notif-feed-item {{ $isUnread ? 'is-unread' : '' }}" 
                 id="notif-card-{{ $notf->id }}"
                 data-id="{{ $notf->id }}"
                 data-type="{{ $itemType }}" 
                 data-unread="{{ $isUnread ? '1' : '0' }}"
                 data-search="{{ strtolower(($isOrder ? 'order #' . ($notf->order ? $notf->order->order_number : '') . ' purchase invoice' : '') . ' ' . ($isUser ? 'customer registration ' . ($notf->user ? $notf->user->name . ' ' . $notf->user->email : '') : '') . ' ' . $notf->created_at->format('M d Y h:i a') . ' ' . $notf->created_at->diffForHumans()) }}">
                
                <!-- Left Details Area -->
                <div class="d-flex align-items-center flex-grow-1">
                    <!-- Icon Avatar -->
                    <div class="notif-avatar-box {{ $isOrder ? 'notif-avatar-order' : 'notif-avatar-user' }} mr-3">
                        <i class="fa-solid {{ $isOrder ? 'fa-cart-shopping' : 'fa-user-plus' }}"></i>
                    </div>

                    <!-- Main Text Info -->
                    <div class="flex-grow-1">
                        <!-- Category Chip + Time + Unread Pill -->
                        <div class="d-flex align-items-center justify-content-between mb-1.5 flex-wrap gap-2">
                            <div class="d-flex align-items-center flex-wrap gap-2">
                                <span class="notif-category-chip {{ $isOrder ? 'notif-chip-order' : 'notif-chip-user' }}">
                                    <i class="fa-solid {{ $isOrder ? 'fa-bag-shopping' : 'fa-user' }}"></i>
                                    {{ $isOrder ? __('Purchase Order') : __('Customer Registration') }}
                                </span>
                                @if($isUnread)
                                    <span class="notif-unread-badge">
                                        <span class="notif-unread-dot"></span> {{ __('NEW') }}
                                    </span>
                                @endif
                            </div>
                            
                            <!-- Timestamp -->
                            <span class="text-muted small d-inline-flex align-items-center" style="font-size: 12px;" title="{{ $notf->created_at->format('M d, Y h:i A') }}">
                                <i class="fa-regular fa-clock mr-1.5 text-muted"></i> {{ $notf->created_at->diffForHumans() }}
                            </span>
                        </div>

                        <!-- Title & Description Body -->
                        <h6 class="font-weight-bold text-dark mb-1" style="font-size: 14.5px; line-height: 1.3;">
                            @if($isOrder)
                                {{ __('New Order') }} @if($notf->order && $notf->order->order_number)<span class="text-success">#{{ $notf->order->order_number }}</span>@endif
                            @else
                                {{ __('New Customer Signup') }}
                            @endif
                        </h6>

                        <p class="text-muted mb-0" style="font-size: 13px; line-height: 1.45;">
                            @if($isOrder)
                                @if($notf->order && $notf->order->order_number)
                                    {{ __('A new purchase order') }} <strong class="text-dark">#{{ $notf->order->order_number }}</strong> {{ __('was placed successfully. Click to review invoice, items, and shipping status.') }}
                                @else
                                    {{ __('You have received a new purchase order. View the invoice for payment and dispatch details.') }}
                                @endif
                            @else
                                @if($notf->user && $notf->user->name)
                                    <strong class="text-dark">{{ $notf->user->name }}</strong> ({{ $notf->user->email }}) {{ __('created a new account on your store.') }}
                                @else
                                    {{ __('A new customer successfully registered an account on your store.') }}
                                @endif
                            @endif
                        </p>
                    </div>
                </div>

                <!-- Right Action Buttons -->
                <div class="notif-card-actions d-flex align-items-center gap-2">
                    @if($isOrder)
                        <a href="{{ route('back.order.invoice', $notf->order_id) }}" class="notif-btn-action notif-btn-invoice">
                            <i class="fa-solid fa-file-invoice"></i>
                            <span>{{ __('View Invoice') }}</span>
                        </a>
                    @elseif($isUser)
                        <a href="{{ route('back.user.show', $notf->user_id) }}" class="notif-btn-action notif-btn-user">
                            <i class="fa-solid fa-user-gear"></i>
                            <span>{{ __('View Customer') }}</span>
                        </a>
                    @endif
                    <button type="button" class="notif-btn-delete btn-delete-single" data-id="{{ $notf->id }}" data-url="{{ route('back.notification.delete', $notf->id) }}" title="{{ __('Delete notification') }}">
                        <i class="fa-solid fa-trash-can" style="font-size: 13.5px;"></i>
                    </button>
                </div>

            </div>
        @empty
            <!-- Empty State -->
            <div class="text-center py-5 bg-white rounded-xl shadow-sm border" style="border-radius: 18px;">
                <div class="mb-3">
                    <div style="width: 72px; height: 72px; border-radius: 50%; background: #f0fdf4; border: 2px solid #bbf7d0; display: inline-flex; align-items: center; justify-content: center; color: #16a34a; font-size: 28px; box-shadow: 0 6px 16px rgba(16, 185, 129, 0.15);">
                        <i class="fa-solid fa-bell-slash"></i>
                    </div>
                </div>
                <h5 class="font-weight-bold text-dark mb-1" style="font-size: 17px;">{{ __('No Notifications Found') }}</h5>
                <p class="text-muted mb-4" style="max-width: 440px; margin: 0 auto; font-size: 13.5px;">
                    {{ __('You are completely caught up! New orders, customer registrations, and store activity alerts will automatically appear here.') }}
                </p>
                <a href="{{ route('back.dashboard') }}" class="btn btn-primary font-weight-bold" style="border-radius: 11px; padding: 10px 22px; background: linear-gradient(135deg, #10b981 0%, #059669 100%); border: none; font-size: 13.5px;">
                    <i class="fa-solid fa-arrow-left mr-1.5"></i> {{ __('Return to Dashboard') }}
                </a>
            </div>
        @endforelse

        <!-- Filter / Search No Match State -->
        <div id="noFilterMatch" class="text-center py-5 bg-white rounded-xl shadow-sm border d-none" style="border-radius: 18px;">
            <div class="mb-3">
                <div style="width: 60px; height: 60px; border-radius: 50%; background: #f8fafc; border: 1.5px solid #e2e8f0; display: inline-flex; align-items: center; justify-content: center; color: #94a3b8; font-size: 22px;">
                    <i class="fa-solid fa-magnifying-glass"></i>
                </div>
            </div>
            <h6 class="font-weight-bold text-dark mb-1" style="font-size: 15px;">{{ __('No matching notifications') }}</h6>
            <p class="text-muted small mb-0">{{ __('No notifications match your selected filter or search keyword.') }}</p>
        </div>
    </div>

</div>

<!-- Clear All Confirmation Modal -->
<div class="modal fade" id="confirm-clear-all" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document" style="max-width: 440px;">
        <div class="modal-content" style="border-radius: 20px; border: 1px solid #e2e8f0; overflow: hidden; box-shadow: 0 25px 50px -12px rgba(15, 23, 42, 0.25);">
            <div class="modal-header" style="background: #fef2f2; border-bottom: 1px solid #fee2e2; padding: 18px 24px;">
                <h5 class="modal-title font-weight-bold text-danger d-flex align-items-center" style="font-size: 15.5px;">
                    <i class="fa-solid fa-triangle-exclamation mr-2"></i> {{ __('Clear All Notifications?') }}
                </h5>
                <button class="close text-danger" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body p-4 text-center">
                <div class="mb-3">
                    <div style="width: 58px; height: 58px; border-radius: 50%; background: #fee2e2; display: inline-flex; align-items: center; justify-content: center; color: #dc2626; font-size: 24px;">
                        <i class="fa-solid fa-trash-can"></i>
                    </div>
                </div>
                <h6 class="font-weight-bold text-dark mb-2" style="font-size: 15px;">{{ __('Are you sure you want to clear all notifications?') }}</h6>
                <p class="text-muted mb-0" style="font-size: 13px; line-height: 1.5;">{{ __('This will permanently remove all notification history from your store dashboard feed.') }}</p>
            </div>
            <div class="modal-footer" style="background: #f8fafc; border-top: 1px solid #e2e8f0; padding: 14px 24px;">
                <button type="button" class="btn btn-light border font-weight-bold" data-dismiss="modal" style="border-radius: 10px; padding: 8px 18px; font-size: 13px;">{{ __('Cancel') }}</button>
                <a href="{{ route('back.notifications.clear') }}" class="btn btn-danger font-weight-bold" style="border-radius: 10px; padding: 8px 20px; background: linear-gradient(135deg, #ef4444, #dc2626); border: none; font-size: 13px;">
                    <i class="fa-solid fa-trash-can mr-1.5"></i> {{ __('Yes, Clear All') }}
                </a>
            </div>
        </div>
    </div>
</div>

@endsection

@section('scripts')
<script>
    $(document).ready(function() {
        var currentFilter = 'all';

        function filterItems() {
            var search = ($('#notifSearchInput').val() || '').toLowerCase().trim();
            var visibleCount = 0;

            $('.notif-feed-item').each(function() {
                var $item = $(this);
                var type = $item.data('type');
                var isUnread = $item.data('unread') == '1';
                var text = ($item.data('search') || '').toLowerCase();

                var matchesTab = false;
                if (currentFilter === 'all') {
                    matchesTab = true;
                } else if (currentFilter === 'order' && type === 'order') {
                    matchesTab = true;
                } else if (currentFilter === 'user' && type === 'user') {
                    matchesTab = true;
                } else if (currentFilter === 'unread' && isUnread) {
                    matchesTab = true;
                }

                var matchesSearch = true;
                if (search.length > 0) {
                    matchesSearch = text.indexOf(search) > -1;
                }

                if (matchesTab && matchesSearch) {
                    $item.removeClass('d-none');
                    visibleCount++;
                } else {
                    $item.addClass('d-none');
                }
            });

            if (visibleCount === 0 && $('.notif-feed-item').length > 0) {
                $('#noFilterMatch').removeClass('d-none');
            } else {
                $('#noFilterMatch').addClass('d-none');
            }
        }

        // Tab click
        $(document).on('click', '.notif-tab-btn', function(e) {
            e.preventDefault();
            $('.notif-tab-btn').removeClass('active');
            $(this).addClass('active');
            currentFilter = $(this).data('filter');
            filterItems();
        });

        // Search input keyup
        $(document).on('input', '#notifSearchInput', function() {
            filterItems();
        });

        // AJAX Mark All as Read
        $('#btnMarkAllRead').on('click', function(e) {
            e.preventDefault();
            var url = $(this).data('url');
            var $btn = $(this);
            
            $btn.prop('disabled', true).html('<i class="fa-solid fa-spinner fa-spin mr-1"></i> {{ __("Updating...") }}');

            $.ajax({
                url: url,
                type: 'GET',
                cache: false,
                success: function() {
                    // Update UI items
                    $('.notif-feed-item').removeClass('is-unread').attr('data-unread', '0');
                    $('.notif-unread-badge').fadeOut(200, function() { $(this).remove(); });
                    $('#headerUnreadPill').fadeOut(200, function() { $(this).remove(); });
                    $('#tabBtnUnread').addClass('d-none');
                    $('#tabCountUnread').text('0');

                    // Navbar badge update
                    $('#alertsDropdown .topbar-notif-badge').fadeOut(200, function() { $(this).remove(); });
                    $('.notif-header-unread-badge').fadeOut(200, function() { $(this).remove(); });

                    $btn.html('<i class="fa-solid fa-check mr-1 text-success"></i> {{ __("All Read") }}');
                    setTimeout(function() {
                        $btn.prop('disabled', false).html('<i class="fa-solid fa-check-double mr-1 text-success"></i> {{ __("Mark All as Read") }}');
                    }, 2500);

                    // Re-filter if on unread tab
                    if (currentFilter === 'unread') {
                        $('.notif-tab-btn[data-filter="all"]').trigger('click');
                    }
                },
                error: function() {
                    // Fallback to direct navigation
                    window.location.href = url;
                }
            });
        });

        // AJAX Single Notification Delete
        $(document).on('click', '.btn-delete-single', function(e) {
            e.preventDefault();
            var notfId = $(this).data('id');
            var url = $(this).data('url');
            var $card = $('#notif-card-' + notfId);

            if (!confirm('{{ __("Delete this notification?") }}')) {
                return;
            }

            $.ajax({
                url: url,
                type: 'GET',
                cache: false,
                success: function() {
                    $card.slideUp(250, function() {
                        $(this).remove();

                        // Recalculate counts
                        var total = $('.notif-feed-item').length;
                        var orders = $('.notif-feed-item[data-type="order"]').length;
                        var users = $('.notif-feed-item[data-type="user"]').length;
                        var unread = $('.notif-feed-item[data-unread="1"]').length;

                        $('#headerTotalCount').text(total);
                        $('#tabCountAll').text(total);
                        $('#tabCountOrder').text(orders);
                        $('#tabCountUser').text(users);
                        $('#tabCountUnread').text(unread);
                        $('#headerUnreadCount').text(unread);

                        if (unread === 0) {
                            $('#headerUnreadPill').fadeOut(200, function() { $(this).remove(); });
                            $('#tabBtnUnread').addClass('d-none');
                        }

                        filterItems();
                    });
                },
                error: function() {
                    window.location.href = url;
                }
            });
        });
    });
</script>
@endsection
