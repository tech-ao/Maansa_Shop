@extends('master.back')

@section('content')

<!-- Start of Main Content -->
<div class="container-fluid">

    <!-- Page Header Banner -->
    <div class="dash-hero-banner mb-4">
        <div class="dash-hero-content">
            <div class="dash-hero-text">
                <h2><i class="fa-solid fa-images mr-2" style="font-size: 22px;"></i> {{ __('Homepage Sliders') }}</h2>
                <p>{{ __('Manage and customize hero sliders, branding, titles, and promo links across all home page themes.') }}</p>
                <ul class="profile-breadcrumb mt-2">
                    <li><a href="{{ route('back.dashboard') }}"><i class="fa-solid fa-house"></i> {{ __('Dashboard') }}</a></li>
                    <span class="divider">/</span>
                    <li>{{ __('Manage Site') }}</li>
                    <span class="divider">/</span>
                    <li class="active">{{ __('Sliders') }}</li>
                </ul>
            </div>
            <div class="dash-hero-actions">
                <a class="btn btn-hero-action btn-hero-primary" href="{{ route('back.slider.create') }}" style="font-size: 13.5px; font-weight: 700; padding: 10px 20px;">
                    <i class="fa-solid fa-plus mr-1"></i> {{ __('Add New Slider') }}
                </a>
            </div>
        </div>
    </div>

    <!-- DataTales -->
    <div class="card-modern">
        <div class="card-modern-body">
            @include('alerts.alerts')
            <div class="table-responsive">
                <table class="table-modern" id="admin-table" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th width="12%">{{ __('Image') }}</th>
                            <th width="26%">{{ __('Title & Link') }}</th>
                            <th width="14%">{{ __('Theme') }}</th>
                            <th width="34%">{{ __('Details') }}</th>
                            <th width="14%" class="text-right">{{ __('Actions') }}</th>
                        </tr>
                    </thead>

                    <tbody>
                        @include('back.slider.table', compact('datas'))
                    </tbody>
                </table>
            </div>
        </div>
    </div>

</div>

{{-- DELETE MODAL --}}
<div class="modal fade" id="confirm-delete" tabindex="-1" role="dialog" aria-labelledby="confirm-deleteModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content" style="border-radius: 16px; border: none; overflow: hidden; box-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.1), 0 10px 10px -5px rgba(0, 0, 0, 0.04);">
            <div class="modal-header border-0 pb-0 pt-4 px-4">
                <div class="d-flex align-items-center">
                    <div style="width: 44px; height: 44px; border-radius: 12px; background: #fee2e2; color: #dc2626; display: flex; align-items: center; justify-content: center; font-size: 20px; margin-right: 14px;">
                        <i class="fa-solid fa-triangle-exclamation"></i>
                    </div>
                    <div>
                        <h5 class="modal-title font-weight-bold text-dark" id="exampleModalLabel">{{ __('Confirm Delete?') }}</h5>
                        <p class="text-muted mb-0" style="font-size: 13px;">{{ __('This action cannot be undone.') }}</p>
                    </div>
                </div>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <div class="modal-body px-4 py-3" style="color: #475569; font-size: 14px; line-height: 1.6;">
                {{ __('You are going to delete this slider. All content and images associated with this slider will be permanently removed.') }}
            </div>

            <div class="modal-footer border-0 pt-0 pb-4 px-4">
                <button type="button" class="btn btn-light px-4 py-2" data-dismiss="modal" style="border-radius: 10px; font-weight: 600; color: #475569; border: 1px solid #cbd5e1;">{{ __('Cancel') }}</button>
                <form action="" class="d-inline btn-ok" method="POST">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger px-4 py-2" style="border-radius: 10px; font-weight: 700; background: #ef4444; border: none; box-shadow: 0 4px 12px rgba(239, 68, 68, 0.3);">
                        <i class="fa-solid fa-trash mr-1"></i> {{ __('Delete') }}
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>
{{-- DELETE MODAL ENDS --}}

@endsection
