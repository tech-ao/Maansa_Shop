@extends('master.back')

@section('content')

<!-- Start of Main Content -->
<div class="container-fluid">

    <!-- Page Header Banner -->
    <div class="dash-hero-banner mb-4">
        <div class="dash-hero-content">
            <div class="dash-hero-text">
                <h2><i class="fa-solid fa-folder-tree mr-2" style="font-size: 22px;"></i> {{ __('FAQ Categories') }}</h2>
                <p>{{ __('Organize frequently asked questions into structured topic categories for your storefront help center.') }}</p>
                <ul class="profile-breadcrumb mt-2">
                    <li><a href="{{ route('back.dashboard') }}"><i class="fa-solid fa-house"></i> {{ __('Dashboard') }}</a></li>
                    <span class="divider">/</span>
                    <li><a href="{{ route('back.faq.index') }}">{{ __('FAQ & Help Center') }}</a></li>
                    <span class="divider">/</span>
                    <li class="active">{{ __('Categories') }}</li>
                </ul>
            </div>
            <div class="dash-hero-actions mt-2 mt-sm-0">
                <a class="btn btn-hero-white" href="{{ route('back.fcategory.create') }}">
                    <i class="fa-solid fa-plus mr-1"></i> {{ __('Add FAQ Category') }}
                </a>
            </div>
        </div>
    </div>

    <input type="hidden" id="table-create-data" data-icon="fas fa-plus" data-href="{{ route('back.fcategory.create') }}" value="{{ __('Create Category') }}">

    @include('alerts.alerts')

    <!-- DataTales / Table Card -->
    <div class="card-modern mb-4">
        <div class="card-modern-body p-4">
            <div class="table-responsive">
                <table class="table table-modern align-middle" id="admin-table" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th width="25%">{{ __('Category Name') }}</th>
                            <th width="45%">{{ __('Description / Text') }}</th>
                            <th width="15%">{{ __('Status') }}</th>
                            <th width="15%" class="text-center">{{ __('Actions') }}</th>
                        </tr>
                    </thead>
                    <tbody>
                        @include('back.fcategory.table', compact('datas'))
                    </tbody>
                </table>
            </div>
        </div>
    </div>

</div>

<!-- Delete Confirmation Modal -->
<div class="modal fade" id="confirm-delete" tabindex="-1" role="dialog" aria-labelledby="confirmDeleteModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content" style="border-radius: 16px; border: none; box-shadow: 0 10px 30px rgba(0,0,0,0.15); overflow: hidden;">
            <div class="modal-header border-0 pb-0 pt-4 px-4">
                <div class="d-flex align-items-center">
                    <div style="width: 42px; height: 42px; border-radius: 10px; background: #fef2f2; color: #dc2626; display: flex; align-items: center; justify-content: center; font-size: 18px; margin-right: 12px;">
                        <i class="fa-solid fa-triangle-exclamation"></i>
                    </div>
                    <h5 class="modal-title font-weight-bold text-dark" id="confirmDeleteModalLabel">{{ __('Delete Category?') }}</h5>
                </div>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close" style="outline: none;">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body px-4 py-3 text-muted" style="font-size: 14px;">
                {{ __('You are going to delete this category. All FAQ questions and entries associated with this category will be affected.') }}
            </div>
            <div class="modal-footer border-0 pt-0 pb-4 px-4">
                <button type="button" class="btn btn-light px-3 py-2 font-weight-bold" data-dismiss="modal" style="border-radius: 8px; font-size: 13px;">{{ __('Cancel') }}</button>
                <form action="" class="d-inline btn-ok" method="POST">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger px-4 py-2 font-weight-bold" style="border-radius: 8px; font-size: 13px; background: #dc2626; border: none;">
                        <i class="fa-solid fa-trash-can mr-1"></i> {{ __('Delete Category') }}
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>

@endsection
