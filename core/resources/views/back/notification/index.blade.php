@php
    $notifications = App\Models\Notification::orderby('id','desc')->take(10)->get();
    $notifCount = $notifications->count();
@endphp

@if($notifCount > 0)
    <div class="notif-dropdown-header d-flex align-items-center justify-content-between">
        <div class="d-flex align-items-center">
            <span class="notif-dropdown-title">
                <i class="fa-solid fa-bell text-primary mr-1"></i> {{ __('Notifications') }}
            </span>
            <span class="badge badge-primary badge-pill ml-2 px-2 py-0.5" style="font-size: 11px; font-weight: 700;">{{ $notifCount }}</span>
        </div>
        <a class="notif-clear-btn" id="clear-notf" data-href="{{ route('back.notifications.clear') }}" href="javascript:;" title="{{ __('Clear All') }}">
            <i class="fa-solid fa-trash-can mr-1"></i> {{ __('Clear All') }}
        </a>
    </div>

    <div class="notif-dropdown-scroll">
        @foreach($notifications as $notf)
            @if($notf->user_id != null)
                <a class="notif-dropdown-item d-flex align-items-start" href="{{ route('back.user.show', $notf->user_id) }}">
                    <div class="notif-item-icon notif-item-user">
                        <i class="fa-solid fa-user-plus"></i>
                    </div>
                    <div class="notif-item-content">
                        <div class="notif-item-text">{{ __('A new user has registered.') }}</div>
                        <div class="notif-item-time"><i class="fa-regular fa-clock mr-1"></i> {{ $notf->created_at->diffForHumans() }}</div>
                    </div>
                </a>
            @elseif($notf->order_id != null)
                <a class="notif-dropdown-item d-flex align-items-start" href="{{ route('back.order.invoice', $notf->order_id) }}">
                    <div class="notif-item-icon notif-item-order">
                        <i class="fa-solid fa-cart-shopping"></i>
                    </div>
                    <div class="notif-item-content">
                        <div class="notif-item-text">{{ __('You have received a new order.') }}</div>
                        <div class="notif-item-time"><i class="fa-regular fa-clock mr-1"></i> {{ $notf->created_at->diffForHumans() }}</div>
                    </div>
                </a>
            @endif
        @endforeach
    </div>

    <div class="notif-dropdown-footer">
        <a class="notif-view-all-link" href="{{ route('back.view.notification') }}">
            {{ __('View All Notifications') }} <i class="fa-solid fa-arrow-right ml-1"></i>
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
