@extends('master.back')
@section('styles')
	<link rel="stylesheet" href="{{ asset('assets/back/css/datepicker.css') }}">
@endsection
@section('content')

<!-- Start of Main Content -->
<div class="container-fluid">

	<!-- Page Header Banner -->
    <div class="dash-hero-banner mb-4">
        <div class="dash-hero-content">
            <div class="dash-hero-text">
                <h2><i class="fa-solid fa-cart-shopping mr-2" style="font-size: 22px;"></i> {{ request()->input('type') ? ucfirst(str_replace('_', ' ', request()->input('type'))) : __('All') }} {{ __('Orders Management') }}</h2>
                <p>{{ __('Review customer purchases, track fulfillment states, manage payment transactions, and print tax invoices.') }}</p>
            </div>
            <div class="dash-hero-actions d-flex flex-wrap gap-2">
                <a href="{{ route('back.csv.order.export') }}" class="btn btn-hero-action btn-hero-secondary" style="font-size: 13px; font-weight: 700; padding: 9px 18px;">
                    <i class="fa-solid fa-file-export mr-1"></i> {{ __('CSV Export') }}
                </a>
                <form class="d-inline-block" action="{{ route('back.bulk.delete') }}" method="get">
                    <input type="hidden" value="" name="ids[]" id="bulk_delete">
                    <input type="hidden" value="orders" name="table">
                    <button class="btn btn-hero-action btn-hero-danger" style="font-size: 13px; font-weight: 700; padding: 9px 18px;">
                        <i class="fa-solid fa-trash-can mr-1"></i> {{ __('Bulk Delete') }}
                    </button>
                </form>
            </div>
        </div>
    </div>

    <!-- Date Range Filter Card -->
    <div class="card-modern mb-4">
        <div class="card-modern-body">
            <div class="d-flex align-items-center mb-3">
                <div class="d-inline-flex align-items-center justify-content-center rounded-circle mr-2" style="width: 34px; height: 34px; background: #f0fdf4; color: #059669;">
                    <i class="fa-solid fa-filter" style="font-size: 14px;"></i>
                </div>
                <div>
                    <h6 class="font-weight-bold text-dark mb-0">{{ __('Filter Orders by Date Range') }}</h6>
                    <p class="text-muted small mb-0">{{ __('Select a date range to filter orders by creation date.') }}</p>
                </div>
            </div>

            <form action="{{ route('back.order.index') }}" method="GET">
                <div class="row align-items-end">
                    <div class="col-md-5 col-sm-6 mb-3 mb-md-0">
                        <label class="form-label font-weight-bold text-dark small">{{ __('Start Date') }} *</label>
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text"><i class="fa-solid fa-calendar-day"></i></span>
                            </div>
                            <input type="text" name="start_date" id="datepicker" class="form-control datepicker"
                                placeholder="{{ __('Start Date') }}" value="{{ request()->input('start_date') }}">
                        </div>
                    </div>
                    <div class="col-md-5 col-sm-6 mb-3 mb-md-0">
                        <label class="form-label font-weight-bold text-dark small">{{ __('End Date') }} *</label>
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text"><i class="fa-solid fa-calendar-check"></i></span>
                            </div>
                            <input type="text" name="end_date" id="datepicker1" class="form-control datepicker"
                                placeholder="{{ __('End Date') }}" value="{{ request()->input('end_date') }}">
                        </div>
                    </div>
                    <div class="col-md-2 col-sm-12">
                        <div class="d-flex gap-2">
                            <button type="submit" class="btn btn-primary flex-grow-1 mr-1" style="border-radius: 10px; font-weight: 700; height: 38px; background: linear-gradient(135deg, #10b981, #059669); border: none;">
                                <i class="fa-solid fa-filter mr-1"></i> {{ __('Filter') }}
                            </button>
                            <a href="{{ route('back.order.index') }}" class="btn btn-light border flex-grow-1" style="border-radius: 10px; font-weight: 700; height: 38px; display: inline-flex; align-items: center; justify-content: center;">
                                {{ __('Reset') }}
                            </a>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>

	<!-- Orders Table Card -->
	<div class="card-modern">
		<div class="card-modern-body">
			@include('alerts.alerts')
			<div class="table-responsive">
				<table class="table-modern" id="admin-table" width="100%" cellspacing="0">
					<thead>
						<tr>
                            <th width="4%" class="text-center no-sort" data-orderable="false">
                                <input type="checkbox" data-target="order-bulk-delete" class="bulk_all_delete cursor-pointer" style="width: 16px; height: 16px;">
                            </th>
                            <th width="16%">{{ __('Order ID') }}</th>
                            <th width="22%">{{ __('Customer') }}</th>
                            <th width="14%">{{ __('Total Amount') }}</th>
                            <th width="14%" class="text-center">{{ __('Payment Status') }}</th>
                            <th width="16%" class="text-center">{{ __('Order Status') }}</th>
							<th width="14%" class="text-center no-sort" data-orderable="false">{{ __('Actions') }}</th>
						</tr>
					</thead>
					<tbody>
                        @include('back.order.table', compact('datas'))
					</tbody>
				</table>
			</div>
		</div>
	</div>

</div>
<!-- End of Main Content -->

{{-- STATUS MODAL --}}
<div class="modal fade" id="statusModal" tabindex="-1" role="dialog" aria-labelledby="statusModalModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content border-0 shadow-lg" style="border-radius: 16px; overflow: hidden;">
            <div class="modal-header bg-primary text-white border-0 py-3">
                <h5 class="modal-title d-flex align-items-center font-weight-bold" id="exampleModalLabel">
                    <i class="fa-solid fa-arrows-rotate mr-2"></i> {{ __('Update Order Status?') }}
                </h5>
                <button class="close text-white opacity-8" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body p-4 text-center">
                <div class="mb-3">
                    <div class="d-inline-flex align-items-center justify-content-center bg-primary-light text-primary rounded-circle" style="width: 60px; height: 60px; font-size: 24px; background: #f0fdf4; color: #059669;">
                        <i class="fa-solid fa-rotate text-primary"></i>
                    </div>
                </div>
                <h5 class="font-weight-bold text-dark mb-2">{{ __('Confirm Status Change') }}</h5>
                <p class="text-muted mb-0">
                    {{ __('You are going to update the status of this order. Do you want to proceed?') }}
                </p>
            </div>
            <div class="modal-footer bg-light border-0 py-3 d-flex justify-content-center">
                <button type="button" class="btn btn-secondary px-4" style="border-radius: 10px; font-weight: 700;" data-dismiss="modal">{{ __('Cancel') }}</button>
                <a href="" class="btn btn-ok btn-primary px-4" style="border-radius: 10px; font-weight: 700; background: linear-gradient(135deg, #10b981, #059669); border: none;">{{ __('Confirm Update') }}</a>
            </div>
        </div>
    </div>
</div>
{{-- STATUS MODAL ENDS --}}

{{-- DELETE MODAL --}}
<div class="modal fade" id="confirm-delete" tabindex="-1" role="dialog" aria-labelledby="confirm-deleteModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content border-0 shadow-lg" style="border-radius: 16px; overflow: hidden;">
            <div class="modal-header bg-danger text-white border-0 py-3">
                <h5 class="modal-title d-flex align-items-center font-weight-bold" id="exampleModalLabel">
                    <i class="fas fa-exclamation-triangle mr-2"></i> {{ __('Confirm Order Deletion') }}
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
                <h5 class="font-weight-bold text-dark mb-2">{{ __('Delete This Order Record?') }}</h5>
                <p class="text-muted mb-0">
                    {{ __('You are going to delete this order record permanently. All contents related with this order will be lost.') }}
                </p>
            </div>
            <div class="modal-footer bg-light border-0 py-3 d-flex justify-content-center">
                <button type="button" class="btn btn-secondary px-4" style="border-radius: 10px; font-weight: 700;" data-dismiss="modal">{{ __('Cancel') }}</button>
                <form action="" class="d-inline btn-ok" method="POST">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger px-4" style="border-radius: 10px; font-weight: 700;">{{ __('Delete Order') }}</button>
                </form>
            </div>
        </div>
    </div>
{{-- SHIPPING / DISPATCH MODAL --}}
<div class="modal fade" id="shippingModal" tabindex="-1" role="dialog" aria-labelledby="shippingModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content border-0 shadow-lg" style="border-radius: 16px; overflow: hidden;">
            <div class="modal-header text-white border-0 py-3" style="background: linear-gradient(135deg, #0284c7 0%, #0369a1 100%);">
                <h5 class="modal-title d-flex align-items-center font-weight-bold" id="shippingModalLabel">
                    <i class="fa-solid fa-truck-fast mr-2"></i> {{ __('Dispatch & Shipping Details') }}
                </h5>
                <button class="close text-white opacity-8" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form id="shippingStatusForm" action="" method="POST">
                @csrf
                <div class="modal-body p-4">
                    <div class="d-flex align-items-center mb-3 p-2.5 rounded-lg" style="background: #f0f9ff; border: 1px solid #e0f2fe; border-radius: 10px;">
                        <div class="mr-2 text-info" style="font-size: 20px;">
                            <i class="fa-solid fa-box"></i>
                        </div>
                        <div>
                            <span class="text-muted d-block small font-weight-bold" style="font-size: 11px; text-transform: uppercase;">{{ __('Order Transaction') }}</span>
                            <span class="font-weight-bold text-dark shipping-modal-txn" style="font-size: 14px;">#ORD-...</span>
                        </div>
                    </div>

                    <div class="form-group mb-3">
                        <label class="form-label font-weight-bold text-dark small">{{ __('Courier / Delivery Partner') }} <span class="text-danger">*</span></label>
                        <input type="text" name="courier_name" id="modal_courier_name" class="form-control" placeholder="{{ __('e.g. Blue Dart, Delhivery, DTDC, India Post') }}" required style="border-radius: 10px; font-weight: 600;">
                        <!-- Quick Courier Presets -->
                        <div class="d-flex flex-wrap gap-1 mt-2">
                            <span class="badge badge-light border cursor-pointer courier-preset px-2 py-1 mr-1" style="font-size: 11px; cursor: pointer;">Blue Dart</span>
                            <span class="badge badge-light border cursor-pointer courier-preset px-2 py-1 mr-1" style="font-size: 11px; cursor: pointer;">Delhivery</span>
                            <span class="badge badge-light border cursor-pointer courier-preset px-2 py-1 mr-1" style="font-size: 11px; cursor: pointer;">DTDC</span>
                            <span class="badge badge-light border cursor-pointer courier-preset px-2 py-1 mr-1" style="font-size: 11px; cursor: pointer;">India Post</span>
                            <span class="badge badge-light border cursor-pointer courier-preset px-2 py-1 mr-1" style="font-size: 11px; cursor: pointer;">FedEx</span>
                            <span class="badge badge-light border cursor-pointer courier-preset px-2 py-1 mr-1" style="font-size: 11px; cursor: pointer;">Ecom Express</span>
                        </div>
                    </div>

                    <div class="form-group mb-3">
                        <label class="form-label font-weight-bold text-dark small">{{ __('AWB / Tracking Number') }} <span class="text-danger">*</span></label>
                        <input type="text" name="tracking_number" id="modal_tracking_number" class="form-control" placeholder="{{ __('e.g. AWB1234567890') }}" required style="border-radius: 10px; font-weight: 600; font-family: monospace;">
                    </div>

                    <div class="form-group mb-3">
                        <label class="form-label font-weight-bold text-dark small">{{ __('Tracking URL / Link') }} <span class="text-muted font-weight-normal">({{ __('Optional') }})</span></label>
                        <input type="url" name="tracking_link" id="modal_tracking_link" class="form-control" placeholder="{{ __('e.g. https://www.bluedart.com/track/...') }}" style="border-radius: 10px;">
                    </div>

                    <div class="custom-control custom-checkbox mt-3">
                        <input type="checkbox" class="custom-control-input" id="send_shipping_email" name="send_email" value="1" checked>
                        <label class="custom-control-label font-weight-bold text-dark small cursor-pointer" for="send_shipping_email">
                            <i class="fa-solid fa-envelope text-success mr-1"></i> {{ __('Send dispatch notification email to client ("Your product has been shipped")') }}
                        </label>
                    </div>
                </div>
                <div class="modal-footer bg-light border-0 py-3 d-flex justify-content-between">
                    <button type="button" class="btn btn-secondary px-4" style="border-radius: 10px; font-weight: 700;" data-dismiss="modal">{{ __('Cancel') }}</button>
                    <button type="submit" class="btn btn-primary px-4" style="border-radius: 10px; font-weight: 700; background: linear-gradient(135deg, #0284c7, #0369a1); border: none;">
                        <i class="fa-solid fa-paper-plane mr-1"></i> {{ __('Save & Mark Shipped') }}
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
{{-- SHIPPING MODAL ENDS --}}

@endsection

@section('scripts')
<script>
    $(document).ready(function() {
        $(document).on('click', '.open-shipping-modal', function() {
            var formAction = $(this).data('action');
            var txn = $(this).data('txn');
            var courier = $(this).data('courier');
            var tracking = $(this).data('tracking');
            var link = $(this).data('link');

            $('#shippingStatusForm').attr('action', formAction);
            $('.shipping-modal-txn').text('#' + txn);
            $('#modal_courier_name').val(courier || '');
            $('#modal_tracking_number').val(tracking || '');
            $('#modal_tracking_link').val(link || '');
        });

        $(document).on('click', '.courier-preset', function() {
            $('#modal_courier_name').val($(this).text().trim());
        });
    });
</script>
@endsection
