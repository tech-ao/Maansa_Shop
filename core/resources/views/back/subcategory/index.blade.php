@extends('master.back')

@section('content')

<!-- Start of Main Content -->
<div class="container-fluid">

    <!-- Page Header Banner -->
    <div class="dash-hero-banner mb-4">
        <div class="dash-hero-content">
            <div class="dash-hero-text">
                <h2><i class="fa-solid fa-sitemap mr-2" style="font-size: 22px;"></i> {{ __('Manage Sub Categories') }}</h2>
                <p>{{ __('Organize secondary category levels within primary catalog hierarchies and configure navigation routes.') }}</p>
            </div>
            <div class="dash-hero-actions">
                <a class="btn btn-hero-action btn-hero-primary" href="{{ route('back.subcategory.create') }}" style="font-size: 13.5px; font-weight: 700; padding: 10px 20px;">
                    <i class="fa-solid fa-plus mr-1"></i> {{ __('Add Sub Category') }}
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
                            <th width="35%">{{ __('Primary Category') }}</th>
                            <th width="35%">{{ __('Sub Category Name & Slug') }}</th>
                            <th width="18%">{{ __('Status') }}</th>
                            <th width="12%" class="text-right">{{ __('Actions') }}</th>
                        </tr>
                    </thead>

                    <tbody>
                        @include('back.subcategory.table', compact('datas'))
                    </tbody>
                </table>
            </div>
        </div>
    </div>

</div>

{{-- DELETE MODAL --}}

  <div class="modal fade" id="confirm-delete" tabindex="-1" role="dialog" aria-labelledby="confirm-deleteModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">

		<!-- Modal Header -->
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">{{ __('Confirm Delete?') }}</h5>
          <button class="close" type="button" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
          </button>
		</div>

		<!-- Modal Body -->
        <div class="modal-body">
			{{ __('You are going to delete this subcategory. All contents related with this category will be lost.') }} {{ __('Do you want to delete it?') }}
		</div>

		<!-- Modal footer -->
        <div class="modal-footer">
			<button type="button" class="btn btn-secondary" data-dismiss="modal">{{ __('Cancel') }}</button>
			<form action="" class="d-inline btn-ok" method="POST">

                @csrf

                @method('DELETE')

                <button type="submit" class="btn btn-danger">{{ __('Delete') }}</button>

			</form>
		</div>

      </div>
    </div>
  </div>

{{-- DELETE MODAL ENDS --}}

@endsection
