@extends('master.back')

@section('content')

<!-- Start of Main Content -->
<div class="container-fluid">

	<!-- Page Header Banner -->
    <div class="dash-hero-banner mb-4">
        <div class="dash-hero-content">
            <div class="dash-hero-text">
                <h2><i class="fa-solid fa-map-location-dot mr-2" style="font-size: 22px;"></i> {{ __('State & Regional Tax / Delivery Rules') }}</h2>
                <p>{{ __('Configure regional sales taxes, state-level surcharges, and location-based delivery fees.') }}</p>
            </div>
            <div class="dash-hero-actions">
                <a class="btn btn-hero-action btn-hero-primary" href="{{ route('back.state.create') }}" style="font-size: 13.5px; font-weight: 700; padding: 10px 20px;">
                    <i class="fa-solid fa-plus mr-1"></i> {{ __('Add State Rule') }}
                </a>
            </div>
        </div>
    </div>

    <!-- Info Notice Box -->
    <div class="card-modern mb-4" style="background: linear-gradient(135deg, #eff6ff, #f8fafc); border-left: 4px solid #3b82f6;">
        <div class="card-modern-body py-3 d-flex align-items-center">
            <div class="d-inline-flex align-items-center justify-content-center rounded-circle mr-3" style="width: 40px; height: 40px; min-width: 40px; background: #dbeafe; color: #1d4ed8; font-size: 16px;">
                <i class="fa-solid fa-circle-info"></i>
            </div>
            <div>
                <h6 class="font-weight-bold text-dark mb-1" style="font-size: 13.5px;">{{ __('Regional Tax & Delivery Charge Management') }}</h6>
                <p class="text-muted small mb-0">{{ __('Only add states if you wish to enforce state-wise extra Tax or customized regional Delivery surcharges at checkout.') }}</p>
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
							<th width="40%">{{ __('State / Region') }}</th>
							<th width="30%" class="text-center">{{ __('Tax / Surcharge Rate') }}</th>
							<th width="15%" class="text-center">{{ __('Status') }}</th>
							<th width="15%" class="text-center no-sort" data-orderable="false">{{ __('Actions') }}</th>
						</tr>
					</thead>
					<tbody>
              			@include('back.state.table', compact('datas'))
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
                    <i class="fas fa-exclamation-triangle mr-2"></i> {{ __('Confirm State Deletion') }}
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
                <h5 class="font-weight-bold text-dark mb-2">{{ __('Delete This State Tax Rule?') }}</h5>
                <p class="text-muted mb-0">
                    {{ __('You are going to delete this State rule. All calculations and tax configurations related with this state will be permanently removed.') }}
                </p>
            </div>
            <div class="modal-footer bg-light border-0 py-3 d-flex justify-content-center">
                <button type="button" class="btn btn-secondary px-4" style="border-radius: 10px; font-weight: 700;" data-dismiss="modal">{{ __('Cancel') }}</button>
                <form action="" class="d-inline btn-ok" method="POST">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger px-4" style="border-radius: 10px; font-weight: 700;">{{ __('Delete State') }}</button>
                </form>
            </div>
        </div>
    </div>
</div>
{{-- DELETE MODAL ENDS --}}

@endsection
