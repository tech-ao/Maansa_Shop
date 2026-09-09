@php
    $notifications = App\Models\Notification::orderby('id','desc')->take(10)->get();
    $notifCount = $notifications->count();
    $unreadCount = $notifications->where('is_read', 0)->count();
@endphp

@if($notifCount > 0)
    <div class="notif-dropdown-header d-flex align-items-center justify-content-between">
        <div class="d-flex align-items-center">
            <span class="notif-dropdown-title">
                <i class="fa-solid fa-bell text-primary mr-1"></i> {{ __('Notifications') }}
            </span>
            @if($unreadCount > 0)
                <span class="badge badge-primary badge-pill ml-2 px-2 py-0.5 notif-header-unread-badge" style="font-size: 11px; font-weight: 700;">{{ $unreadCount }}</span>
            @endif
        </div>
        <a class="notif-clear-btn" id="clear-notf" data-href="{{ route('back.notifications.clear') }}" href="javascript:;" title="{{ __('Clear All') }}">
            <i class="fa-solid fa-trash-can mr-1"></i> {{ __('Clear All') }}
        </a>
    </div>

    <div class="notif-dropdown-scroll">
        @foreach($notifications as $notf)
            @if($notf->user_id != null)
                <a class="notif-dropdown-item d-flex align-items-start {{ $notf->is_read == 0 ? 'notif-item-unread' : '' }}" href="{{ route('back.user.show', $notf->user_id) }}">
                    <div class="notif-item-icon notif-item-user">
                        <i class="fa-solid fa-user-plus"></i>
                    </div>
                    <div class="notif-item-content">
                        <div class="notif-item-text font-weight-bold">{{ __('A new user has registered.') }}</div>
                        <div class="notif-item-time"><i class="fa-regular fa-clock mr-1"></i> {{ $notf->created_at->diffForHumans() }}</div>
                    </div>
                </a>
            @elseif($notf->order_id != null)
                <a class="notif-dropdown-item d-flex align-items-start {{ $notf->is_read == 0 ? 'notif-item-unread' : '' }}" href="{{ route('back.order.invoice', $notf->order_id) }}">
                    <div class="notif-item-icon notif-item-order">
                        <i class="fa-solid fa-cart-shopping"></i>
                    </div>
                    <div class="notif-item-content">
                        <div class="notif-item-text font-weight-bold">{{ __('You have received a new order.') }}</div>
                        <div class="notif-item-time"><i class="fa-regular fa-clock mr-1"></i> {{ $notf->created_at->diffForHumans() }}</div>
                    </div>
                </a>
            @endif
        @endforeach
    </div>

    <div class="notif-dropdown-footer d-flex align-items-center justify-content-between px-3 py-2.5 border-top" style="background: #f8fafc; border-bottom-left-radius: 14px; border-bottom-right-radius: 14px;">
        <a class="notif-mark-read-btn text-muted font-weight-bold d-inline-flex align-items-center" id="mark-read-notf" data-href="{{ route('back.notifications.read') }}" href="javascript:;" style="font-size: 12.5px; text-decoration: none; transition: color 0.2s ease;">
            <i class="fa-solid fa-check-double text-success mr-1.5" style="font-size: 13px;"></i> <span>{{ __('Mark as read') }}</span>
        </a>
        <a class="notif-view-all-link font-weight-bold d-inline-flex align-items-center text-primary" href="{{ route('back.view.notification') }}" style="font-size: 12.5px; text-decoration: none;">
            <span>{{ __('View All Notifications') }}</span> <i class="fa-solid fa-arrow-right ml-1.5" style="font-size: 11px;"></i>
        </a>
    </div>
@else
    <div class="notif-dropdown-header">
        <span class="notif-dropdown-title">
            <i class="fa-solid fa-bell text-primary mr-1"></i> {{ __('Notifications') }}
        </span>
    </div>
    <div class="notif-dropdown-empty text-center py-4 px-3">
        <div style="width: 44px; height: 44px; border-radius: 50%; background: #f1f5f9; display: inline-flex; align-items: center; justify-content: center; color: #94a3b8; font-size: 18px; margin-bottom: 8px;">
            <i class="fa-regular fa-bell-slash"></i>
        </div>
        <p class="text-muted mb-0 font-weight-bold" style="font-size: 13px;">{{ __('No new notifications') }}</p>
    </div>
@endif
