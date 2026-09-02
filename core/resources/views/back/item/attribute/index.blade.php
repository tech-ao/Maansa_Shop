@extends('master.back')

@section('content')

<!-- Start of Main Content -->
<div class="container-fluid">

	<!-- Hero Banner -->
    <div class="dash-hero-banner mb-4">
        <div class="dash-hero-content">
            <div class="dash-hero-text">
                <h2>
                    <i class="fa-solid fa-sliders mr-2" style="font-size: 22px;"></i> {{ __('Product Attributes') }}
                </h2>
                <p>
                    {{ __('Manage variation groups (e.g., Size, Color, Capacity, Material) for ') }}
                    <span class="badge badge-light text-dark font-weight-bold ml-1 px-2.5 py-1" style="font-size: 12.5px; border-radius: 6px;">{{ $item->name }}</span>
                </p>
            </div>
            <div class="dash-hero-actions">
                <a class="btn btn-hero-action btn-hero-secondary" href="{{ route('back.item.index') }}" style="font-size: 13px; font-weight: 700; padding: 10px 18px;">
                    <i class="fa-solid fa-arrow-left mr-1"></i> {{ __('Back to Products') }}
                </a>
                <a class="btn btn-hero-action btn-hero-primary" href="{{ route('back.attribute.create', $item->id) }}" style="font-size: 13px; font-weight: 700; padding: 10px 18px;">
                    <i class="fa-solid fa-plus mr-1"></i> {{ __('Add Attribute') }}
                </a>
            </div>
        </div>
    </div>

	<!-- DataTales Card -->
	<div class="card-modern shadow-sm mb-4">
		<div class="card-modern-body p-3 p-md-4">
			@include('alerts.alerts')
			<div class="gd-responsive-table">
				<table class="table table-hover align-middle mb-0" id="admin-table" width="100%" cellspacing="0">
					<thead>
						<tr>
							<th width="75%">{{ __('Attribute Group Name') }}</th>
							<th width="25%" class="text-center no-sort" data-orderable="false">{{ __('Actions') }}</th>
						</tr>
					</thead>
					<tbody>
                        @include('back.item.attribute.table', compact('datas'))
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
        <div class="modal-content border-0 shadow" style="border-radius: 16px; overflow: hidden;">
            <div class="modal-header bg-danger text-white py-3 px-4">
                <h5 class="modal-title font-weight-bold d-flex align-items-center" id="exampleModalLabel">
                    <i class="fa-solid fa-triangle-exclamation mr-2"></i> {{ __('Confirm Attribute Deletion') }}
                </h5>
                <button class="close text-white opacity-8" type="button" data-dismiss="modal" aria-label="Close" style="outline: none;">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body p-4 text-dark" style="font-size: 14px; line-height: 1.6;">
                {{ __('You are about to delete this attribute group. All variation options associated with this attribute will also be permanently removed.') }}
            </div>
            <div class="modal-footer bg-light py-3 px-4 border-0">
                <button type="button" class="btn btn-secondary px-4" data-dismiss="modal" style="border-radius: 10px; font-weight: 600;">{{ __('Cancel') }}</button>
                <form action="" class="d-inline btn-ok" method="POST">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger px-4" style="border-radius: 10px; font-weight: 700; box-shadow: 0 4px 12px rgba(239, 68, 68, 0.3);">
                        <i class="fa-solid fa-trash-can mr-1"></i> {{ __('Delete Attribute') }}
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>
{{-- DELETE MODAL ENDS --}}

@endsection
