@extends('master.back')

@section('content')

<!-- Start of Main Content -->
<div class="container-fluid">

	<!-- Page Header Banner -->
    <div class="dash-hero-banner mb-4">
        <div class="dash-hero-content">
            <div class="dash-hero-text">
                <h2><i class="fa-solid fa-triangle-exclamation mr-2" style="font-size: 22px;"></i> {{ __('Stock Out Products') }}</h2>
                <p>{{ __('Products that have zero or depleted inventory levels. Replenish stocks or adjust product availability.') }}</p>
            </div>
            <div class="dash-hero-actions">
                <a class="btn btn-hero-action btn-hero-primary" href="{{ route('back.item.index') }}" style="font-size: 13.5px; font-weight: 700; padding: 10px 20px;">
                    <i class="fa-solid fa-boxes-stacked mr-1"></i> {{ __('All Products') }}
                </a>
            </div>
        </div>
    </div>

	<!-- DataTales Container -->
	<div class="card-modern">
		<div class="card-modern-body">
            @include('alerts.alerts')
			<div class="table-responsive">
				<table class="table-modern" id="admin-table" width="100%" cellspacing="0">
					<thead>
						<tr>
							<th width="4%" class="text-center no-sort" data-orderable="false">
                                <input type="checkbox" data-target="product-bulk-delete" class="bulk_all_delete cursor-pointer" style="width: 16px; height: 16px;">
                            </th>
							<th width="7%" class="text-center">{{ __('Image') }}</th>
                            <th width="28%">{{ __('Name') }}</th>
                            <th width="11%">{{ __('Price') }}</th>
							<th width="12%" class="text-center">{{ __('Status') }}</th>
							<th width="12%" class="text-center">{{ __('Tag') }}</th>
							<th width="12%" class="text-center">{{ __('Format') }}</th>
							<th width="14%" class="text-center no-sort" data-orderable="false">{{ __('Actions') }}</th>
						</tr>
					</thead>
					<tbody>
                        @include('back.item.table', compact('datas'))
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
        <div class="modal-content border-0 shadow-lg" style="border-radius: 16px; overflow: hidden;">
            <div class="modal-header bg-danger text-white border-0 py-3">
                <h5 class="modal-title d-flex align-items-center font-weight-bold" id="exampleModalLabel">
                    <i class="fas fa-exclamation-triangle mr-2"></i> {{ __('Confirm Product Deletion') }}
                </h5>
                <button class="close text-white opacity-8" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body p-4 text-center">
                <div class="mb-3">
                    <div class="d-inline-flex align-items-center justify-content-center bg-danger-light text-danger rounded-circle" style="width: 60px; height: 60px; font-size: 24px; background: #fee2e2;">
                        <i class="fas fa-trash-can text-danger"></i>
                    </div>
                </div>
                <h5 class="font-weight-bold text-dark mb-2">{{ __('Delete This Product?') }}</h5>
                <p class="text-muted mb-0">
                    {{ __('You are going to delete this item. All contents, attributes, gallery media, and reviews related with this item will be lost.') }}
                </p>
            </div>
            <div class="modal-footer bg-light border-0 py-3 d-flex justify-content-center">
                <button type="button" class="btn btn-secondary px-4" style="border-radius: 10px; font-weight: 700;" data-dismiss="modal">{{ __('Cancel') }}</button>
                <form action="" class="d-inline btn-ok" method="POST">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger px-4" style="border-radius: 10px; font-weight: 700;">{{ __('Delete Product') }}</button>
                </form>
            </div>
        </div>
    </div>
</div>
{{-- DELETE MODAL ENDS --}}

@endsection



