@extends('master.back')
@section('styles')
	<link rel="stylesheet" href="{{ asset('assets/back/css/datepicker.css') }}">
    <style>
        .filter-date-card {
            overflow: visible !important;
            position: relative !important;
            z-index: 50 !important;
        }
        .filter-date-card .card-modern-body {
            overflow: visible !important;
        }
        .bootstrap-datetimepicker-widget {
            z-index: 999999 !important;
            background: #ffffff !important;
            border: 1.5px solid #cbd5e1 !important;
            border-radius: 14px !important;
            box-shadow: 0 20px 45px -5px rgba(15, 23, 42, 0.18), 0 4px 12px rgba(15, 23, 42, 0.08) !important;
            padding: 12px 14px !important;
            margin-top: 8px !important;
            min-width: 280px !important;
        }
        .bootstrap-datetimepicker-widget.dropdown-menu {
            z-index: 999999 !important;
            position: absolute !important;
        }
        .btn-date-preset {
            border-radius: 10px;
            font-size: 12px;
            font-weight: 700;
            padding: 9px 12px;
            border: 1.5px solid #cbd5e1;
            background: #ffffff;
            color: #334155;
            transition: all 0.2s ease;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            text-align: center;
            cursor: pointer;
        }
        .btn-date-preset:hover {
            background: #f8fafc;
            border-color: #94a3b8;
            color: #0f172a;
        }
        .btn-date-preset.active {
            background: #f0fdf4 !important;
            border-color: #10b981 !important;
            color: #047857 !important;
            box-shadow: 0 0 0 2px rgba(16, 185, 129, 0.25) !important;
        }
        .btn-date-preset.active.preset-blue {
            background: #eff6ff !important;
            border-color: #0284c7 !important;
            color: #0369a1 !important;
            box-shadow: 0 0 0 2px rgba(2, 132, 199, 0.25) !important;
        }
        .btn-date-preset.active.preset-dark {
            background: #f1f5f9 !important;
            border-color: #0f172a !important;
            color: #0f172a !important;
            box-shadow: 0 0 0 2px rgba(15, 23, 42, 0.25) !important;
        }
    </style>
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
                <button type="button" class="btn btn-hero-action btn-hero-secondary open-bulk-modal" data-mode="invoices" style="font-size: 13px; font-weight: 700; padding: 9px 16px;">
                    <i class="fa-solid fa-receipt mr-1 text-info"></i> {{ __('Bulk Invoices') }}
                </button>
                <button type="button" class="btn btn-hero-action btn-hero-secondary open-bulk-modal" data-mode="labels" style="font-size: 13px; font-weight: 700; padding: 9px 16px;">
                    <i class="fa-solid fa-tags mr-1 text-primary"></i> {{ __('Bulk Packing Labels') }}
                </button>
                <a href="{{ route('back.csv.order.export') }}" class="btn btn-hero-action btn-hero-secondary" style="font-size: 13px; font-weight: 700; padding: 9px 16px;">
                    <i class="fa-solid fa-file-export mr-1"></i> {{ __('CSV Export') }}
                </a>
                <form class="d-inline-block" action="{{ route('back.bulk.delete') }}" method="get">
                    <input type="hidden" value="" name="ids[]" id="bulk_delete">
                    <input type="hidden" value="orders" name="table">
                    <button class="btn btn-hero-action btn-hero-danger" style="font-size: 13px; font-weight: 700; padding: 9px 16px;">
                        <i class="fa-solid fa-trash-can mr-1"></i> {{ __('Bulk Delete') }}
                    </button>
                </form>
            </div>
        </div>
    </div>

    <!-- Date Range Filter Card -->
    <div class="card-modern filter-date-card mb-4" style="position: relative; z-index: 50; overflow: visible;">
        <div class="card-modern-body" style="overflow: visible;">
            <div class="d-flex align-items-center mb-3">
                <div class="d-inline-flex align-items-center justify-content-center rounded-circle mr-2" style="width: 34px; height: 34px; background: #f0fdf4; color: #059669;">
                    <i class="fa-solid fa-filter" style="font-size: 14px;"></i>
                </div>
                <div>
                    <h6 class="font-weight-bold text-dark mb-0">{{ __('Filter Orders by Date Range') }}</h6>
                    <p class="text-muted small mb-0">{{ __('Select a date range to filter orders by creation date.') }}</p>
                </div>
            </div>

            <form action="{{ route('back.order.index') }}" method="GET" id="orderFilterForm">
                <input type="hidden" name="type" value="{{ request()->input('type') }}">
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
                            <a href="{{ route('back.order.index', request()->input('type') ? ['type' => request()->input('type')] : []) }}" class="btn btn-light border flex-grow-1" style="border-radius: 10px; font-weight: 700; height: 38px; display: inline-flex; align-items: center; justify-content: center;">
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
</div>
{{-- DELETE MODAL ENDS --}}

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
                        <input type="text" name="courier_name" id="modal_courier_name" class="form-control" placeholder="{{ __('e.g. BlueDart, DTDC, Indian Post, ST Courier') }}" required style="border-radius: 10px; font-weight: 600;">
                        <!-- Quick Courier Presets (Single Row 4-Column Grid) -->
                        <div class="courier-presets-grid mt-2" style="display: grid; grid-template-columns: repeat(4, 1fr); gap: 6px;">
                            <button type="button" class="btn courier-preset px-1 py-1.5 font-weight-bold text-center d-flex align-items-center justify-content-center" style="border-radius: 8px; font-size: 11.5px; border: 1.5px solid #cbd5e1; background: #ffffff; color: #1e293b; transition: all 0.2s;" data-courier="BlueDart">
                                <i class="fa-solid fa-truck-fast mr-1 text-primary" style="font-size: 11px;"></i> <span>BlueDart</span>
                            </button>
                            <button type="button" class="btn courier-preset px-1 py-1.5 font-weight-bold text-center d-flex align-items-center justify-content-center" style="border-radius: 8px; font-size: 11.5px; border: 1.5px solid #cbd5e1; background: #ffffff; color: #1e293b; transition: all 0.2s;" data-courier="DTDC">
                                <i class="fa-solid fa-box mr-1 text-info" style="font-size: 11px;"></i> <span>DTDC</span>
                            </button>
                            <button type="button" class="btn courier-preset px-1 py-1.5 font-weight-bold text-center d-flex align-items-center justify-content-center" style="border-radius: 8px; font-size: 11.5px; border: 1.5px solid #cbd5e1; background: #ffffff; color: #1e293b; transition: all 0.2s;" data-courier="Indian Post">
                                <i class="fa-solid fa-envelope mr-1 text-danger" style="font-size: 11px;"></i> <span>Indian Post</span>
                            </button>
                            <button type="button" class="btn courier-preset px-1 py-1.5 font-weight-bold text-center d-flex align-items-center justify-content-center" style="border-radius: 8px; font-size: 11.5px; border: 1.5px solid #cbd5e1; background: #ffffff; color: #1e293b; transition: all 0.2s;" data-courier="ST Courier">
                                <i class="fa-solid fa-paper-plane mr-1 text-success" style="font-size: 11px;"></i> <span>ST Courier</span>
                            </button>
                        </div>
                    </div>

                    <div class="form-group mb-3">
                        <label class="form-label font-weight-bold text-dark small">{{ __('AWB / Tracking Number') }} <span class="text-danger">*</span></label>
                        <input type="text" name="tracking_number" id="modal_tracking_number" class="form-control" placeholder="{{ __('e.g. AWB1234567890') }}" required style="border-radius: 10px; font-weight: 600; font-family: monospace;">
                        <small class="form-text text-muted">{{ __('The tracking link URL will automatically update as you enter the tracking number.') }}</small>
                    </div>

                    <div class="form-group mb-3">
                        <label class="form-label font-weight-bold text-dark small">{{ __('Tracking URL / Link') }} <span class="text-muted font-weight-normal">({{ __('Auto-generated based on courier') }})</span></label>
                        <div class="input-group">
                            <input type="url" name="tracking_link" id="modal_tracking_link" class="form-control" placeholder="{{ __('e.g. https://www.bluedart.com/tracking?numbers=...') }}" style="border-radius: 10px;">
                        </div>
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
{{-- BULK PRINT POP-UP MODAL --}}
<div class="modal fade" id="bulkPrintModal" tabindex="-1" role="dialog" aria-labelledby="bulkPrintModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content border-0 shadow-lg" style="border-radius: 18px; overflow: hidden;">
            <div class="modal-header text-white border-0 py-3" id="bulkModalHeader" style="background: linear-gradient(135deg, #0284c7 0%, #0369a1 100%);">
                <div>
                    <h5 class="modal-title d-flex align-items-center font-weight-bold" id="bulkPrintModalTitle">
                        <i class="fa-solid fa-receipt mr-2" id="bulkModalIcon"></i> <span id="bulkModalHeadingText">{{ __('Bulk Invoices Generator') }}</span>
                    </h5>
                    <small class="text-white opacity-9 d-block mt-0.5" id="bulkModalSubtext">
                        {{ __('Filter orders by preset dates (Today, This Week, etc.) or custom range.') }}
                    </small>
                </div>
                <button class="close text-white opacity-8" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form id="bulkPrintForm" action="{{ route('back.order.bulk.invoices') }}" method="GET" target="_blank">
                <input type="hidden" name="time_frame" id="modal_time_frame" value="today">
                <input type="hidden" name="ids" id="modal_selected_ids" value="">

                <div class="modal-body p-4">
                    <!-- Selected Orders Banner (Visible only when checkboxes are selected) -->
                    <div id="bulkSelectedAlert" class="alert mb-3 p-3 d-none" style="background: #f0fdf4; border: 1.5px solid #86efac; border-radius: 12px;">
                        <div class="d-flex align-items-center justify-content-between flex-wrap gap-2">
                            <div class="d-flex align-items-center">
                                <div class="rounded-circle mr-2.5 d-flex align-items-center justify-content-center" style="width: 34px; height: 34px; background: #bbf7d0; color: #15803d; font-size: 16px;">
                                    <i class="fa-solid fa-circle-check"></i>
                                </div>
                                <div>
                                    <div class="font-weight-bold text-dark" style="font-size: 13.5px;" id="bulkSelectedCountText">
                                        {{ __('You have selected 0 order(s) in the table.') }}
                                    </div>
                                    <small class="text-muted">{{ __('Choose whether to print only these checked items or use the date filters below.') }}</small>
                                </div>
                            </div>
                            <div class="btn-group btn-group-toggle" data-toggle="buttons">
                                <label class="btn btn-sm btn-outline-success active font-weight-bold" style="border-radius: 8px 0 0 8px; font-size: 12px;" id="optSelectedOnlyLabel">
                                    <input type="radio" name="scope_selection" id="scope_selected" value="selected" checked> {{ __('Selected Only') }}
                                </label>
                                <label class="btn btn-sm btn-outline-secondary font-weight-bold" style="border-radius: 0 8px 8px 0; font-size: 12px;" id="optUseFiltersLabel">
                                    <input type="radio" name="scope_selection" id="scope_filter" value="filter"> {{ __('Use Date Filters') }}
                                </label>
                            </div>
                        </div>
                    </div>

                    <!-- Date Range Presets Section -->
                    <div id="bulkFilterControls">
                        <div class="d-flex align-items-center justify-content-between mb-2">
                            <label class="form-label font-weight-bold text-dark small mb-0">
                                <i class="fa-solid fa-calendar-days text-primary mr-1"></i> {{ __('Choose Date Filter Preset') }}
                            </label>
                            <span class="badge badge-light border text-dark font-weight-bold px-2 py-1" id="activePresetBadge" style="border-radius: 6px; font-size: 11.5px;">{{ __('Preset: Today') }}</span>
                        </div>
                        
                        <!-- Quick Filter Buttons: Today, Yesterday, This Week, Last 7 Days, This Month, All Time, Custom -->
                        <div class="date-presets-grid mb-3" style="display: grid; grid-template-columns: repeat(auto-fit, minmax(105px, 1fr)); gap: 8px;">
                            <button type="button" class="btn btn-date-preset active" data-preset="today">
                                <i class="fa-solid fa-sun mr-1"></i> {{ __('Today') }}
                            </button>
                            <button type="button" class="btn btn-date-preset" data-preset="yesterday">
                                <i class="fa-solid fa-clock-rotate-left mr-1"></i> {{ __('Yesterday') }}
                            </button>
                            <button type="button" class="btn btn-date-preset" data-preset="this_week">
                                <i class="fa-solid fa-calendar-week mr-1"></i> {{ __('This Week') }}
                            </button>
                            <button type="button" class="btn btn-date-preset" data-preset="last_7_days">
                                <i class="fa-solid fa-calendar-minus mr-1"></i> {{ __('Last 7 Days') }}
                            </button>
                            <button type="button" class="btn btn-date-preset" data-preset="this_month">
                                <i class="fa-solid fa-calendar mr-1"></i> {{ __('This Month') }}
                            </button>
                            <button type="button" class="btn btn-date-preset" data-preset="all">
                                <i class="fa-solid fa-infinity mr-1"></i> {{ __('All Time') }}
                            </button>
                            <button type="button" class="btn btn-date-preset" data-preset="custom">
                                <i class="fa-solid fa-sliders mr-1"></i> {{ __('Custom') }}
                            </button>
                        </div>

                        <!-- Custom Date Pickers -->
                        <div class="row custom-dates-row mb-3" id="bulkModalCustomDates">
                            <div class="col-md-6 mb-2 mb-md-0">
                                <label class="form-label font-weight-bold text-dark small">{{ __('Start Date') }}</label>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="fa-solid fa-calendar-day"></i></span>
                                    </div>
                                    <input type="text" name="start_date" id="modal_start_date" class="form-control datepicker" placeholder="{{ __('Start Date (MM/DD/YYYY)') }}" style="border-radius: 0 10px 10px 0; font-weight: 600;">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label font-weight-bold text-dark small">{{ __('End Date') }}</label>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="fa-solid fa-calendar-check"></i></span>
                                    </div>
                                    <input type="text" name="end_date" id="modal_end_date" class="form-control datepicker" placeholder="{{ __('End Date (MM/DD/YYYY)') }}" style="border-radius: 0 10px 10px 0; font-weight: 600;">
                                </div>
                            </div>
                        </div>

                        <!-- Order Fulfillment Status Filter -->
                        <div class="form-group mb-0">
                            <label class="form-label font-weight-bold text-dark small">{{ __('Order Fulfillment Status') }}</label>
                            <select name="type" id="modal_order_status" class="form-control" style="border-radius: 10px; font-weight: 600;">
                                <option value="all">{{ __('All Statuses (Pending, In Progress, Shipped, Delivered)') }}</option>
                                <option value="Pending" {{ request()->input('type') == 'Pending' ? 'selected' : '' }}>{{ __('Pending Only') }}</option>
                                <option value="In Progress" {{ request()->input('type') == 'In Progress' ? 'selected' : '' }}>{{ __('In Progress Only') }}</option>
                                <option value="Shipped" {{ request()->input('type') == 'Shipped' ? 'selected' : '' }}>{{ __('Shipped Only') }}</option>
                                <option value="Delivered" {{ request()->input('type') == 'Delivered' ? 'selected' : '' }}>{{ __('Delivered Only') }}</option>
                                <option value="Canceled" {{ request()->input('type') == 'Canceled' ? 'selected' : '' }}>{{ __('Canceled Only') }}</option>
                            </select>
                        </div>
                    </div>
                </div>

                <div class="modal-footer bg-light border-0 py-3 d-flex justify-content-between align-items-center">
                    <button type="button" class="btn btn-secondary px-4" style="border-radius: 10px; font-weight: 700;" data-dismiss="modal">{{ __('Cancel') }}</button>
                    <button type="submit" class="btn btn-primary px-4" id="bulkSubmitBtn" style="border-radius: 10px; font-weight: 700; background: linear-gradient(135deg, #0284c7, #0369a1); border: none;">
                        <i class="fa-solid fa-print mr-1"></i> <span id="bulkSubmitBtnText">{{ __('Download / Print Invoices') }}</span>
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
{{-- BULK PRINT POP-UP MODAL ENDS --}}

@endsection

@section('scripts')
<script>
    function getCourierTrackingUrl(courier, awb) {
        courier = (courier || '').trim().toLowerCase();
        awb = (awb || '').trim();

        if (courier.includes('bluedart') || courier.includes('blue dart')) {
            return awb ? 'https://www.bluedart.com/tracking?numbers=' + encodeURIComponent(awb) : 'https://www.bluedart.com/tracking';
        } else if (courier.includes('dtdc')) {
            return awb ? 'https://track.dtdc.com/ctbs-tracking/customerInterface.tr?submitName=showTrackingDetail&strCnno=' + encodeURIComponent(awb) : 'https://www.dtdc.in/';
        } else if (courier.includes('indian post') || courier.includes('india post') || courier.includes('speed post')) {
            return 'https://www.indiapost.gov.in/_layouts/15/dop.portal.tracking/trackconsignment.aspx';
        } else if (courier.includes('st courier') || courier.includes('stcourier')) {
            return awb ? 'https://stcourier.com/track/shipment?awb=' + encodeURIComponent(awb) : 'https://stcourier.com/track';
        }
        return '';
    }

    function syncTrackingLink() {
        var courier = $('#modal_courier_name').val();
        var awb = $('#modal_tracking_number').val();
        var generatedUrl = getCourierTrackingUrl(courier, awb);
        if (generatedUrl) {
            $('#modal_tracking_link').val(generatedUrl);
        }
    }

    function formatUsDate(d) {
        var month = '' + (d.getMonth() + 1);
        var day = '' + d.getDate();
        var year = d.getFullYear();
        if (month.length < 2) month = '0' + month;
        if (day.length < 2) day = '0' + day;
        return [month, day, year].join('/');
    }

    function applyDatePreset(preset) {
        $('#modal_time_frame').val(preset);
        $('.btn-date-preset').removeClass('active');
        $('.btn-date-preset[data-preset="' + preset + '"]').addClass('active');

        var now = new Date();
        var todayStr = formatUsDate(now);
        var badgeText = 'Preset: ' + preset.replace('_', ' ').toUpperCase();

        if (preset === 'today') {
            $('#modal_start_date').val(todayStr);
            $('#modal_end_date').val(todayStr);
            badgeText = 'Preset: Today';
        } else if (preset === 'yesterday') {
            var yest = new Date();
            yest.setDate(yest.getDate() - 1);
            var yestStr = formatUsDate(yest);
            $('#modal_start_date').val(yestStr);
            $('#modal_end_date').val(yestStr);
            badgeText = 'Preset: Yesterday';
        } else if (preset === 'this_week') {
            var d = new Date();
            var day = d.getDay();
            var diff = d.getDate() - day + (day === 0 ? -6 : 1); // Monday
            var monday = new Date(d.setDate(diff));
            $('#modal_start_date').val(formatUsDate(monday));
            $('#modal_end_date').val(todayStr);
            badgeText = 'Preset: This Week';
        } else if (preset === 'last_7_days') {
            var d7 = new Date();
            d7.setDate(d7.getDate() - 6);
            $('#modal_start_date').val(formatUsDate(d7));
            $('#modal_end_date').val(todayStr);
            badgeText = 'Preset: Last 7 Days';
        } else if (preset === 'this_month') {
            var firstDay = new Date(now.getFullYear(), now.getMonth(), 1);
            $('#modal_start_date').val(formatUsDate(firstDay));
            $('#modal_end_date').val(todayStr);
            badgeText = 'Preset: This Month';
        } else if (preset === 'all') {
            $('#modal_start_date').val('');
            $('#modal_end_date').val('');
            badgeText = 'Preset: All Time';
        } else if (preset === 'custom') {
            badgeText = 'Preset: Custom Range';
        }

        $('#activePresetBadge').text(badgeText);
    }

    $(document).ready(function() {
        $('#modal_start_date').datetimepicker({ format: 'MM/DD/YYYY' });
        $('#modal_end_date').datetimepicker({ format: 'MM/DD/YYYY' });

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
            
            if (link) {
                $('#modal_tracking_link').val(link);
            } else {
                syncTrackingLink();
            }

            // Highlight matching preset button
            highlightActivePreset(courier);
        });

        $(document).on('click', '.courier-preset', function(e) {
            e.preventDefault();
            var courierName = $(this).data('courier') || $(this).text().trim();
            $('#modal_courier_name').val(courierName);
            syncTrackingLink();
            highlightActivePreset(courierName);
        });

        $(document).on('input', '#modal_tracking_number, #modal_courier_name', function() {
            syncTrackingLink();
            highlightActivePreset($('#modal_courier_name').val());
        });

        function highlightActivePreset(courier) {
            courier = (courier || '').trim().toLowerCase();
            $('.courier-preset').each(function() {
                var btnCourier = ($(this).data('courier') || $(this).text()).trim().toLowerCase();
                if (courier && (btnCourier === courier || courier.includes(btnCourier))) {
                    $(this).css({
                        'border-color': '#10b981',
                        'background': '#f0fdf4',
                        'color': '#047857',
                        'box-shadow': '0 0 0 2px rgba(16, 185, 129, 0.35)',
                        'font-weight': '700'
                    });
                } else {
                    $(this).css({
                        'border-color': '#cbd5e1',
                        'background': '#ffffff',
                        'color': '#1e293b',
                        'box-shadow': 'none',
                        'font-weight': '600'
                    });
                }
            });
        }

        // Open Bulk Print Modal & Configure for Invoices or Packing Labels
        $(document).on('click', '.open-bulk-modal', function(e) {
            e.preventDefault();
            var mode = $(this).data('mode'); // 'invoices' or 'labels'
            var selectedVal = $('#bulk_delete').val();
            var selectedCount = selectedVal ? selectedVal.split(',').filter(function(x) { return x.trim() !== ''; }).length : 0;

            if (mode === 'invoices') {
                $('#bulkModalHeader').css('background', 'linear-gradient(135deg, #0284c7 0%, #0369a1 100%)');
                $('#bulkModalIcon').attr('class', 'fa-solid fa-receipt mr-2');
                $('#bulkModalHeadingText').text("{{ __('Bulk Invoices Generator') }}");
                $('#bulkModalSubtext').text("{{ __('Filter orders to generate and print official tax invoices.') }}");
                $('#bulkPrintForm').attr('action', "{{ route('back.order.bulk.invoices') }}");
                $('#bulkSubmitBtn').css('background', 'linear-gradient(135deg, #0284c7, #0369a1)');
                $('#bulkSubmitBtnText').text("{{ __('Download / Print Invoices') }}");
            } else {
                $('#bulkModalHeader').css('background', 'linear-gradient(135deg, #0f172a 0%, #1e293b 100%)');
                $('#bulkModalIcon').attr('class', 'fa-solid fa-tags mr-2');
                $('#bulkModalHeadingText').text("{{ __('Bulk Packing Labels Generator') }}");
                $('#bulkModalSubtext').text("{{ __('Filter orders to generate and print 4x6 / thermal packing labels.') }}");
                $('#bulkPrintForm').attr('action', "{{ route('back.order.bulk.packing_labels') }}");
                $('#bulkSubmitBtn').css('background', 'linear-gradient(135deg, #1e293b, #0f172a)');
                $('#bulkSubmitBtnText').text("{{ __('Download / Print Packing Labels') }}");
            }

            if (selectedCount > 0) {
                $('#bulkSelectedAlert').removeClass('d-none');
                $('#bulkSelectedCountText').text("{{ __('You have selected') }} " + selectedCount + " {{ __('order(s) in the table.') }}");
                $('#modal_selected_ids').val(selectedVal);
                $('#scope_selected').prop('checked', true);
                $('#optSelectedOnlyLabel').addClass('active');
                $('#optUseFiltersLabel').removeClass('active');
                $('#bulkFilterControls').css('opacity', '0.45');
            } else {
                $('#bulkSelectedAlert').addClass('d-none');
                $('#modal_selected_ids').val('');
                $('#scope_filter').prop('checked', true);
                $('#optUseFiltersLabel').addClass('active');
                $('#optSelectedOnlyLabel').removeClass('active');
                $('#bulkFilterControls').css('opacity', '1');
            }

            // Sync with page filters if present, otherwise default to Today
            var pageStartDate = $('#datepicker').val();
            var pageEndDate = $('#datepicker1').val();
            if (pageStartDate || pageEndDate) {
                $('#modal_start_date').val(pageStartDate || '');
                $('#modal_end_date').val(pageEndDate || '');
                applyDatePreset('custom');
            } else {
                applyDatePreset('today');
            }

            $('#bulkPrintModal').modal('show');
        });

        // Toggle Selected Only vs Filter controls in Bulk Modal
        $(document).on('change', 'input[name="scope_selection"]', function() {
            if ($(this).val() === 'selected') {
                $('#modal_selected_ids').val($('#bulk_delete').val());
                $('#bulkFilterControls').css('opacity', '0.45');
            } else {
                $('#modal_selected_ids').val('');
                $('#bulkFilterControls').css('opacity', '1');
            }
        });

        // Click Preset Date Buttons inside Bulk Modal
        $(document).on('click', '.btn-date-preset', function(e) {
            e.preventDefault();
            var preset = $(this).data('preset');
            applyDatePreset(preset);

            // Automatically switch radio to filters if selected only was checked
            if ($('#scope_selected').is(':checked')) {
                $('#scope_filter').prop('checked', true);
                $('#optUseFiltersLabel').addClass('active');
                $('#optSelectedOnlyLabel').removeClass('active');
                $('#modal_selected_ids').val('');
                $('#bulkFilterControls').css('opacity', '1');
            }
        });

        // When user manually edits date inputs, switch preset to custom
        $(document).on('input change dp.change', '#modal_start_date, #modal_end_date', function() {
            $('#modal_time_frame').val('custom');
            $('.btn-date-preset').removeClass('active');
            $('.btn-date-preset[data-preset="custom"]').addClass('active');
            $('#activePresetBadge').text("{{ __('Preset: Custom Range') }}");
        });
    });
</script>
@endsection
