@php
    $user = Auth::user();
@endphp
<div class="col-lg-4">
    <aside class="user-info-wrapper">
      <div class="user-info">
        <div class="user-avatar">
          <img id="avater_photo_view" src="{{ $user->photo_url }}" alt="{{ $user->displayName() }}">
        </div>

        <div class="user-data">
          <h4 class="h5">{{$user->first_name}} {{$user->last_name}}</h4><span>{{__('Joined')}} {{$user->created_at->format('M d, Y')}}</span>
        </div>
      </div>
      <nav class="list-group">
        <a class="list-group-item {{ request()->is('user/dashboard') ? 'active' : '' }}" href="{{route('user.dashboard')}}"><i class="icon-command"></i>{{__('Dashboard')}}</a>
        <a class="list-group-item {{ request()->is('user/profile') ? 'active' : '' }}" href="{{route('user.profile')}}"><i class="icon-user"></i>{{__('Profile')}}</a>
        <a class="list-group-item {{ request()->is('user/ticket') ? 'active' : '' }}" href="{{route('user.ticket')}}"><i class="icon-file-text"></i>{{__('Support Ticket')}}</a>
        <a class="list-group-item with-badge {{ request()->is('user/orders') ? 'active' : '' }}" href="{{route('user.order.index')}}"><i class="icon-shopping-bag"></i>{{__('Orders')}}<span class="badge badge-default badge-pill">{{$user->orders->count()}}</span></a>
        <a class="list-group-item {{ request()->is('user/addresses') ? 'active' : '' }}" href="{{route('user.address')}}"><i class="icon-map-pin"></i>{{__('Address')}}</a>
        <a class="list-group-item  with-badge {{ request()->is('user/wishlists') ? 'active' : '' }}" href="{{route('user.wishlist.index')}}"><i class="icon-heart"></i>{{__('Wishlist')}}<span class="badge badge-default badge-pill">{{$user->wishlists->count()}}</span></a>
        <a class="list-group-item remove-account with-badge text-danger" data-bs-toggle="modal" data-bs-target="#deleteAccountModal" data-toggle="modal" data-target="#deleteAccountModal" href="javascript:;"><i class="icon-trash text-danger"></i>{{__('Delete Account')}}</a>
        <a class="list-group-item with-badge" href="{{route('user.logout')}}"><i class="icon-log-out"></i>{{__('Log out')}}</a>
      </nav>
    </aside>

    <!-- Delete Account Confirmation Modal -->
    <div class="modal fade" id="deleteAccountModal" tabindex="-1" role="dialog" aria-labelledby="deleteAccountModalLabel" aria-hidden="true">
      <div class="modal-dialog modal-dialog-centered" role="document" style="max-width: 440px;">
        <div class="modal-content border-0 shadow-lg" style="border-radius: 20px; overflow: hidden;">
          <div class="modal-header border-0 pb-0 pt-3 px-3 justify-content-end">
            <button type="button" class="btn-close" data-bs-dismiss="modal" data-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body text-center px-4 pb-4 pt-0">
            <div class="delete-modal-icon-wrapper mb-3">
              <i class="icon-alert-triangle"></i>
            </div>
            <h4 class="fw-bold text-dark mb-2" id="deleteAccountModalLabel">{{ __('Delete Account?') }}</h4>
            <p class="text-muted small mb-4 px-2">
              {{ __('Are you sure you want to permanently delete your account? This action is irreversible and will erase all your profile details, orders, and saved addresses.') }}
            </p>
            <div class="d-flex flex-column flex-sm-row justify-content-center gap-2">
              <button type="button" class="btn btn-cancel-modal rounded-pill px-4 py-2" data-bs-dismiss="modal" data-dismiss="modal">
                {{ __('Cancel') }}
              </button>
              <a href="{{ route('user.account.remove') }}" class="btn btn-danger-delete rounded-pill px-4 py-2">
                <i class="icon-trash mr-1"></i> {{ __('Yes, Delete') }}
              </a>
            </div>
          </div>
        </div>
      </div>
    </div>

</div>

<style>
.user-info-wrapper .user-avatar {
    width: 90px !important;
    height: 90px !important;
    border-radius: 50% !important;
    overflow: hidden !important;
    margin: 0 auto 12px auto !important;
    border: 3px solid #059669 !important;
    box-shadow: 0 4px 14px rgba(5, 150, 105, 0.2) !important;
    background: #f8fafc !important;
    display: flex !important;
    align-items: center !important;
    justify-content: center !important;
}

.user-info-wrapper .user-avatar img,
#avater_photo_view {
    width: 100% !important;
    height: 100% !important;
    object-fit: cover !important;
    border-radius: 50% !important;
    display: block !important;
}

.delete-modal-icon-wrapper {
    width: 64px;
    height: 64px;
    border-radius: 50%;
    background: #fef2f2;
    color: #ef4444;
    font-size: 28px;
    display: inline-flex;
    align-items: center;
    justify-content: center;
    margin: 0 auto;
    border: 4px solid #fee2e2;
}

.btn-cancel-modal {
    background: #f1f5f9 !important;
    color: #475569 !important;
    border: 1px solid #e2e8f0 !important;
    font-weight: 600 !important;
    font-size: 14px !important;
    transition: all 0.2s ease !important;
}

.btn-cancel-modal:hover {
    background: #e2e8f0 !important;
    color: #0f172a !important;
}

.btn-danger-delete {
    background: linear-gradient(135deg, #ef4444 0%, #dc2626 100%) !important;
    color: #ffffff !important;
    border: none !important;
    font-weight: 700 !important;
    font-size: 14px !important;
    box-shadow: 0 4px 14px rgba(239, 68, 68, 0.35) !important;
    transition: all 0.2s ease !important;
    display: inline-flex !important;
    align-items: center !important;
    justify-content: center !important;
}

.btn-danger-delete:hover {
    background: linear-gradient(135deg, #dc2626 0%, #b91c1c 100%) !important;
    color: #ffffff !important;
    transform: translateY(-2px) !important;
    box-shadow: 0 6px 18px rgba(239, 68, 68, 0.45) !important;
}
</style>


