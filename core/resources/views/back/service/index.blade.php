@extends('master.back')

@section('content')

<!-- Start of Main Content -->
<div class="container-fluid">

    <!-- Page Header Banner -->
    <div class="dash-hero-banner mb-4">
        <div class="dash-hero-content">
            <div class="dash-hero-text">
                <h2><i class="fa-solid fa-truck-fast mr-2" style="font-size: 22px;"></i> {{ __('Store Services') }}</h2>
                <p>{{ __('Manage store highlights, service guarantees, customer perks, and trust badges.') }}</p>
                <ul class="profile-breadcrumb mt-2">
                    <li><a href="{{ route('back.dashboard') }}"><i class="fa-solid fa-house"></i> {{ __('Dashboard') }}</a></li>
                    <span class="divider">/</span>
                    <li class="active">{{ __('Services') }}</li>
                </ul>
            </div>
            <div class="dash-hero-actions mt-2 mt-sm-0">
                <a class="btn btn-hero-action" href="{{ route('back.service.create') }}">
                    <i class="fa-solid fa-plus mr-1"></i> {{ __('Add New Service') }}
                </a>
            </div>
        </div>
    </div>

    @include('alerts.alerts')

    <!-- DataTales -->
    <div class="card-modern mb-4">
        <div class="card-modern-body p-4">
            <div class="table-responsive">
                <table class="table table-modern align-middle" id="admin-table" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th width="15%" class="text-center">{{ __('Icon / Image') }}</th>
                            <th width="55%">{{ __('Service Title') }}</th>
                            <th width="30%" class="text-center">{{ __('Actions') }}</th>
                        </tr>
                    </thead>
                    <tbody>
                        @include('back.service.table', compact('datas'))
                    </tbody>
                </table>
            </div>
        </div>
    </div>

</div>
<!-- End of Main Content -->

{{-- DELETE MODAL --}}
<div class="modal fade" id="confirm-delete" tabindex="-1" role="dialog" aria-labelledby="confirm-deleteModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content" style="border-radius: 16px; border: none; overflow: hidden; box-shadow: 0 10px 30px rgba(0,0,0,0.15);">
            <div class="modal-header border-0 bg-light px-4 pt-4 pb-3">
                <div class="d-flex align-items-center">
                    <div style="width: 40px; height: 40px; border-radius: 50%; background: #fee2e2; color: #ef4444; display: flex; align-items: center; justify-content: center; font-size: 18px; margin-right: 12px;">
                        <i class="fa-solid fa-triangle-exclamation"></i>
                    </div>
                    <h5 class="modal-title font-weight-bold text-dark mb-0" id="confirm-deleteModalLabel">{{ __('Delete Service?') }}</h5>
                </div>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body px-4 py-3 text-muted" style="font-size: 14.5px;">
                {{ __('Are you sure you want to delete this service? All content related to this service guarantee will be permanently removed.') }}
            </div>
            <div class="modal-footer border-0 bg-light px-4 py-3">
                <button type="button" class="btn btn-secondary px-3 py-2" data-dismiss="modal" style="border-radius: 8px; font-weight: 600;">{{ __('Cancel') }}</button>
                <form action="" class="d-inline btn-ok" method="POST">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger px-4 py-2" style="border-radius: 8px; font-weight: 600; background: #ef4444; border-color: #ef4444;">{{ __('Yes, Delete') }}</button>
                </form>
            </div>
        </div>
    </div>
</div>
{{-- DELETE MODAL ENDS --}}

@endsection
