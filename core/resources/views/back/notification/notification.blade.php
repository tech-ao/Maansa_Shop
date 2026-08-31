@extends('master.back')

@section('content')

<!-- Start of Main Content -->
<div class="container-fluid">

	<!-- Page Header Banner -->
    <div class="dash-hero-banner mb-4">
        <div class="dash-hero-content">
            <div class="dash-hero-text">
                <h2><i class="fa-solid fa-bell mr-2" style="font-size: 22px;"></i> {{ __('Notifications Center') }}</h2>
                <p>{{ __('Review real-time store alerts, customer registrations, and recent orders.') }}</p>
            </div>
            <div class="dash-hero-actions">
                @php
                    $allNotifications = App\Models\Notification::orderby('id','desc')->get();
                @endphp
                @if($allNotifications->count() > 0)
                    <a href="javascript:;" data-toggle="modal" data-target="#confirm-clear-all" class="btn btn-hero-action btn-hero-secondary" style="font-size: 13.5px; font-weight: 700; padding: 10px 18px; background: rgba(239, 68, 68, 0.15); border: 1px solid rgba(239, 68, 68, 0.3); color: #dc2626;">
                        <i class="fa-solid fa-trash-can mr-1"></i> {{ __('Clear All') }}
                    </a>
                @endif
                <a class="btn btn-hero-action btn-hero-primary" href="{{ route('back.dashboard') }}" style="font-size: 13.5px; font-weight: 700; padding: 10px 20px;">
                    <i class="fa-solid fa-chart-line mr-1"></i> {{ __('Dashboard') }}
                </a>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-12">
            @include('alerts.alerts')
        </div>
    </div>

    <!-- Notifications List Card -->
    <div class="card-modern mb-4">
        <div class="card-modern-header d-flex align-items-center justify-content-between">
            <h6 class="font-weight-bold text-dark mb-0 d-flex align-items-center">
                <i class="fa-solid fa-list-check text-primary mr-2"></i> {{ __('Recent Activity Feed') }}
                <span class="badge badge-primary ml-2 px-2.5 py-1" style="font-size: 12px; border-radius: 6px; font-weight: 700;">{{ $allNotifications->count() }}</span>
            </h6>
        </div>
        <div class="card-modern-body p-4">
            @forelse($allNotifications as $notf)
                @if($notf->user_id != null)
                    <div class="notif-card-item">
                        <div class="notif-icon-circle notif-icon-user">
                            <i class="fa-solid fa-user-plus"></i>
                        </div>
                        <div class="flex-grow-1">
                            <div class="d-flex align-items-center justify-content-between mb-1">
                                <h6 class="font-weight-bold text-dark mb-0" style="font-size: 15px;">{{ __('New Customer Registration') }}</h6>
                                <span class="badge badge-light text-muted px-2.5 py-1" style="background: #f1f5f9; border-radius: 6px; font-size: 12px; font-weight: 600;">
                                    <i class="fa-regular fa-clock text-primary mr-1"></i> {{ $notf->created_at->diffForHumans() }}
                                </span>
                            </div>
                            <p class="text-muted mb-0" style="font-size: 13.5px;">{{ __('A new customer has registered an account on your store.') }}</p>
                        </div>
                        <div class="notif-card-actions d-flex align-items-center">
                            <a href="{{ route('back.user.show', $notf->user_id) }}" class="btn btn-sm btn-outline-primary font-weight-bold mr-2" style="border-radius: 8px; padding: 7px 14px; font-size: 13px;">
                                <i class="fa-solid fa-user mr-1"></i> {{ __('View User') }}
                            </a>
                            <a href="{{ route('back.notification.delete', $notf->id) }}" class="btn btn-sm btn-light text-danger" style="width: 36px; height: 36px; border-radius: 8px; display: inline-flex; align-items: center; justify-content: center; border: 1px solid #fee2e2; background: #fff5f5;" title="{{ __('Delete Notification') }}">
                                <i class="fa-solid fa-trash-can" style="font-size: 13px;"></i>
                            </a>
                        </div>
                    </div>
                @elseif($notf->order_id != null)
                    <div class="notif-card-item">
                        <div class="notif-icon-circle notif-icon-order">
                            <i class="fa-solid fa-cart-shopping"></i>
                        </div>
                        <div class="flex-grow-1">
                            <div class="d-flex align-items-center justify-content-between mb-1">
                                <h6 class="font-weight-bold text-dark mb-0" style="font-size: 15px;">{{ __('New Order Received') }}</h6>
                                <span class="badge badge-light text-muted px-2.5 py-1" style="background: #f1f5f9; border-radius: 6px; font-size: 12px; font-weight: 600;">
                                    <i class="fa-regular fa-clock text-success mr-1"></i> {{ $notf->created_at->diffForHumans() }}
                                </span>
                            </div>
                            <p class="text-muted mb-0" style="font-size: 13.5px;">{{ __('You have received a new purchase order. Check invoice for shipping details.') }}</p>
                        </div>
                        <div class="notif-card-actions d-flex align-items-center">
                            <a href="{{ route('back.order.invoice', $notf->order_id) }}" class="btn btn-sm btn-outline-success font-weight-bold mr-2" style="border-radius: 8px; padding: 7px 14px; font-size: 13px;">
                                <i class="fa-solid fa-receipt mr-1"></i> {{ __('View Invoice') }}
                            </a>
                            <a href="{{ route('back.notification.delete', $notf->id) }}" class="btn btn-sm btn-light text-danger" style="width: 36px; height: 36px; border-radius: 8px; display: inline-flex; align-items: center; justify-content: center; border: 1px solid #fee2e2; background: #fff5f5;" title="{{ __('Delete Notification') }}">
                                <i class="fa-solid fa-trash-can" style="font-size: 13px;"></i>
                            </a>
                        </div>
                    </div>
                @endif
            @empty
                <div class="text-center py-5">
                    <div class="mb-3">
                        <div style="width: 72px; height: 72px; border-radius: 50%; background: #f1f5f9; display: inline-flex; align-items: center; justify-content: center; color: #94a3b8; font-size: 30px;">
                            <i class="fa-regular fa-bell-slash"></i>
                        </div>
                    </div>
                    <h5 class="font-weight-bold text-dark mb-1">{{ __('No Notifications Found') }}</h5>
                    <p class="text-muted mb-4" style="max-width: 420px; margin: 0 auto; font-size: 14px;">{{ __('You are all caught up! New orders, user registrations, and system alerts will appear here.') }}</p>
                    <a href="{{ route('back.dashboard') }}" class="btn btn-primary btn-sm font-weight-bold" style="border-radius: 8px; padding: 8px 18px;">
                        <i class="fa-solid fa-arrow-left mr-1"></i> {{ __('Return to Dashboard') }}
                    </a>
                </div>
            @endforelse
        </div>
    </div>

</div>

<!-- Clear All Modal -->
<div class="modal fade" id="confirm-clear-all" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content" style="border-radius: 16px; border: none; overflow: hidden; box-shadow: 0 10px 30px rgba(0,0,0,0.15);">
            <div class="modal-header" style="background: #fef2f2; border-bottom: 1px solid #fee2e2; padding: 18px 24px;">
                <h5 class="modal-title font-weight-bold text-danger d-flex align-items-center" style="font-size: 16px;">
                    <i class="fa-solid fa-triangle-exclamation mr-2"></i> {{ __('Clear All Notifications?') }}
                </h5>
                <button class="close text-danger" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body p-4 text-center">
                <div class="mb-3">
                    <div style="width: 56px; height: 56px; border-radius: 50%; background: #fee2e2; display: inline-flex; align-items: center; justify-content: center; color: #dc2626; font-size: 24px;">
                        <i class="fa-solid fa-trash-can"></i>
                    </div>
                </div>
                <h6 class="font-weight-bold text-dark mb-2">{{ __('Are you sure you want to clear all notifications?') }}</h6>
                <p class="text-muted mb-0" style="font-size: 13.5px;">{{ __('This will permanently remove all notification history from your dashboard feed.') }}</p>
            </div>
            <div class="modal-footer" style="background: #f8fafc; border-top: 1px solid #e2e8f0; padding: 14px 24px;">
                <button type="button" class="btn btn-secondary font-weight-bold" data-dismiss="modal" style="border-radius: 8px; padding: 8px 18px;">{{ __('Cancel') }}</button>
                <a href="{{ route('back.notifications.clear') }}" class="btn btn-danger font-weight-bold" style="border-radius: 8px; padding: 8px 20px; background: linear-gradient(135deg, #ef4444, #dc2626); border: none;">
                    <i class="fa-solid fa-trash-can mr-1"></i> {{ __('Yes, Clear All') }}
                </a>
            </div>
        </div>
    </div>
</div>

@endsection



