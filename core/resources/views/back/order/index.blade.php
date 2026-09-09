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
        /* Datepicker / Calendar Popup Styling & Z-Index Fix */
        .bootstrap-datetimepicker-widget {
            z-index: 9999999 !important;
            background: #ffffff !important;
            border: 1.5px solid #e2e8f0 !important;
            border-radius: 14px !important;
            box-shadow: 0 20px 45px -5px rgba(0, 0, 0, 0.18), 0 0 0 1px rgba(0, 0, 0, 0.04) !important;
            padding: 12px 14px !important;
            margin-top: 8px !important;
            min-width: 290px !important;
        }
        .bootstrap-datetimepicker-widget.dropdown-menu {
            z-index: 9999999 !important;
            position: absolute !important;
        }
        .bootstrap-datetimepicker-widget table th {
            color: #475569 !important;
            font-weight: 700 !important;
            font-size: 12px !important;
            padding: 6px !important;
        }
        .bootstrap-datetimepicker-widget table th.picker-switch {
            color: #0f172a !important;
            font-size: 13.5px !important;
            font-weight: 800 !important;
            cursor: pointer !important;
        }
        .bootstrap-datetimepicker-widget table th.prev,
        .bootstrap-datetimepicker-widget table th.next {
            color: #059669 !important;
            font-size: 14px !important;
            cursor: pointer !important;
        }
        .bootstrap-datetimepicker-widget table td.day {
            height: 32px !important;
            line-height: 32px !important;
            width: 32px !important;
            font-size: 12.5px !important;
            font-weight: 600 !important;
            color: #1e293b !important;
            border-radius: 8px !important;
            cursor: pointer !important;
        }
        .bootstrap-datetimepicker-widget table td.day:hover {
            background-color: #ecfdf5 !important;
            color: #047857 !important;
        }
        .bootstrap-datetimepicker-widget table td.active,
        .bootstrap-datetimepicker-widget table td.active:hover {
            background: linear-gradient(135deg, #10b981, #059669) !important;
            color: #ffffff !important;
            font-weight: 700 !important;
            box-shadow: 0 2px 8px rgba(16, 185, 129, 0.35) !important;
        }
        .bootstrap-datetimepicker-widget table td.today:before {
            border-bottom-color: #10b981 !important;
        }
        .custom-date-input-wrap {
            cursor: pointer !important;
        }
        .custom-date-control {
            cursor: pointer !important;
        }

        /* Bulk Print Modern Pop-up Modal */
        .bulk-modal-dialog {
            max-width: 560px;
            margin: 1.75rem auto;
        }
        .bulk-modal-content {
            border-radius: 20px;
            border: 1px solid #e2e8f0;
            box-shadow: 0 25px 50px -12px rgba(15, 23, 42, 0.25);
            overflow: hidden;
            background: #ffffff;
        }
        .bulk-modal-header {
            padding: 18px 24px;
            display: flex;
            align-items: center;
            justify-content: space-between;
            position: relative;
        }
        .bulk-header-icon-box {
            width: 42px;
            height: 42px;
            border-radius: 12px;
            background: rgba(255, 255, 255, 0.15);
            border: 1px solid rgba(255, 255, 255, 0.25);
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 18px;
            color: #ffffff;
            flex-shrink: 0;
        }
        .bulk-modal-close-btn {
            width: 32px;
            height: 32px;
            border-radius: 50%;
            background: rgba(255, 255, 255, 0.15);
            border: 1px solid rgba(255, 255, 255, 0.25);
            color: #ffffff;
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            transition: all 0.2s;
            font-size: 14px;
            padding: 0;
            line-height: 1;
            flex-shrink: 0;
        }
        .bulk-modal-close-btn:hover {
            background: rgba(255, 255, 255, 0.3);
            color: #ffffff;
        }
        
        /* 6-Grid Date Preset Buttons */
        .presets-grid-3col {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 8px;
        }
        .btn-preset-card {
            padding: 9px 8px;
            min-height: 40px;
            border-radius: 10px;
            border: 1.5px solid #e2e8f0;
            background: #ffffff;
            color: #334155;
            font-size: 12.5px;
            font-weight: 700;
            display: flex !important;
            flex-direction: row !important;
            align-items: center !important;
            justify-content: center !important;
            cursor: pointer;
            transition: all 0.2s cubic-bezier(0.4, 0, 0.2, 1);
            text-align: center;
            outline: none !important;
            white-space: nowrap;
            user-select: none;
            width: 100%;
        }
        .btn-preset-card i {
            font-size: 13px;
            margin-right: 6px;
            color: #64748b;
            transition: color 0.2s;
            flex-shrink: 0;
        }
        .btn-preset-card span {
            display: inline-block;
            font-size: 12px;
            font-weight: 700;
            line-height: 1;
            color: inherit;
        }
        .btn-preset-card:hover {
            border-color: #cbd5e1;
            background: #f8fafc;
            color: #0f172a;
        }
        .btn-preset-card.active {
            background: linear-gradient(135deg, #059669 0%, #047857 100%) !important;
            border-color: #059669 !important;
            color: #ffffff !important;
            box-shadow: 0 4px 12px rgba(5, 150, 105, 0.25) !important;
        }
        .btn-preset-card.active i,
        .btn-preset-card.active span {
            color: #ffffff !important;
        }

        /* Range Summary Chip */
        .range-summary-chip {
            display: inline-flex;
            align-items: center;
            padding: 4px 12px;
            border-radius: 20px;
            background: #f1f5f9;
            color: #334155;
            font-size: 11.5px;
            font-weight: 700;
            border: 1px solid #e2e8f0;
        }

        /* Custom Date Field Wrapper */
        .custom-date-input-wrap {
            position: relative;
            display: flex;
            align-items: center;
            width: 100%;
        }
        .custom-date-input-wrap .custom-date-icon {
            position: absolute;
            left: 12px;
            font-size: 13px;
            color: #059669;
            pointer-events: none;
            z-index: 5;
        }
        .custom-date-control {
            padding-left: 34px !important;
            padding-right: 10px !important;
            height: 38px !important;
            border-radius: 10px !important;
            border: 1.5px solid #cbd5e1 !important;
            background: #ffffff !important;
            color: #0f172a !important;
            font-weight: 700 !important;
            font-size: 12.5px !important;
            box-shadow: none !important;
            width: 100% !important;
            transition: border-color 0.2s, box-shadow 0.2s;
        }
        .custom-date-control:focus {
            border-color: #10b981 !important;
            box-shadow: 0 0 0 3px rgba(16, 185, 129, 0.15) !important;
        }

        /* Mobile & Small Screens (<576px) */
        @media (max-width: 576px) {
            .bulk-modal-dialog {
                margin: 0.5rem;
                max-width: calc(100% - 1rem);
            }
            .presets-grid-3col {
                grid-template-columns: repeat(2, 1fr) !important;
                gap: 7px !important;
            }
            .btn-preset-card {
                padding: 8px 6px !important;
                min-height: 38px !important;
                font-size: 11.5px !important;
            }
            .btn-preset-card i {
                font-size: 12px !important;
                margin-right: 4px !important;
            }
            .btn-preset-card span {
                font-size: 11.5px !important;
            }
            .bulk-modal-header {
                padding: 14px 16px;
            }
            .bulk-modal-content .modal-body {
                padding: 16px !important;
            }
            .bulk-modal-content .modal-footer {
                padding: 12px 16px !important;
                flex-direction: column-reverse !important;
                gap: 8px;
            }
            .bulk-modal-content .modal-footer .btn {
                width: 100% !important;
                justify-content: center;
            }
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
                        <label class="form-label font-weight-bold text-dark small mb-1.5 d-flex align-items-center">
                            <i class="fa-solid fa-calendar-day text-success mr-2" style="font-size: 13px;"></i>
                            <span>{{ __('Start Date') }} *</span>
                        </label>
                        <div class="custom-date-input-wrap">
                            <i class="fa-regular fa-calendar text-success custom-date-icon"></i>
                            <input type="text" name="start_date" id="datepicker" class="form-control datepicker custom-date-control"
                                placeholder="{{ __('Start Date') }}" value="{{ request()->input('start_date') }}" style="height: 40px !important;">
                        </div>
                    </div>
                    <div class="col-md-5 col-sm-6 mb-3 mb-md-0">
                        <label class="form-label font-weight-bold text-dark small mb-1.5 d-flex align-items-center">
                            <i class="fa-solid fa-calendar-check text-success mr-2" style="font-size: 13px;"></i>
                            <span>{{ __('End Date') }} *</span>
                        </label>
                        <div class="custom-date-input-wrap">
                            <i class="fa-regular fa-calendar-check text-success custom-date-icon"></i>
                            <input type="text" name="end_date" id="datepicker1" class="form-control datepicker custom-date-control"
                                placeholder="{{ __('End Date') }}" value="{{ request()->input('end_date') }}" style="height: 40px !important;">
                        </div>
                    </div>
                    <div class="col-md-2 col-sm-12">
                        <div class="d-flex gap-2">
                            <button type="submit" class="btn btn-primary flex-grow-1 mr-1" style="border-radius: 10px; font-weight: 700; height: 40px; background: linear-gradient(135deg, #10b981, #059669); border: none; display: inline-flex; align-items: center; justify-content: center;">
                                <i class="fa-solid fa-filter mr-1.5"></i> {{ __('Filter') }}
                            </button>
                            <a href="{{ route('back.order.index', request()->input('type') ? ['type' => request()->input('type')] : []) }}" class="btn btn-light border flex-grow-1" style="border-radius: 10px; font-weight: 700; height: 40px; display: inline-flex; align-items: center; justify-content: center; color: #475569;">
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
    <div class="modal-dialog modal-dialog-centered bulk-modal-dialog" role="document">
        <div class="modal-content bulk-modal-content">
            <!-- Modal Header -->
            <div class="bulk-modal-header" id="bulkModalHeader" style="background: linear-gradient(135deg, #064e3b 0%, #047857 100%);">
                <div class="d-flex align-items-center mr-2">
                    <div class="bulk-header-icon-box mr-3" id="bulkModalIconBox">
                        <i class="fa-solid fa-file-invoice" id="bulkModalIcon"></i>
                    </div>
                    <div>
                        <h5 class="modal-title font-weight-bold text-white mb-0" id="bulkModalHeadingText" style="font-size: 16px; letter-spacing: 0.2px; line-height: 1.3;">
                            {{ __('Bulk Invoices Generator') }}
                        </h5>
                        <p class="text-white small mb-0 mt-0.5" id="bulkModalSubtext" style="font-size: 11.5px; opacity: 0.85; line-height: 1.3;">
                            {{ __('Filter orders to generate and print official tax invoices.') }}
                        </p>
                    </div>
                </div>
                <button type="button" class="bulk-modal-close-btn flex-shrink-0" data-dismiss="modal" aria-label="Close">
                    <i class="fa-solid fa-xmark"></i>
                </button>
            </div>

            <form id="bulkPrintForm" action="{{ route('back.order.bulk.invoices') }}" method="GET" target="_blank">
                <input type="hidden" name="time_frame" id="modal_time_frame" value="today">
                <input type="hidden" name="ids" id="modal_selected_ids" value="">

                <div class="modal-body p-4">
                    <!-- Selected Items Banner (shown only when table checkboxes are checked) -->
                    <div id="bulkSelectedAlert" class="alert mb-3 p-3 d-none" style="background: #f0fdf4; border: 1.5px solid #86efac; border-radius: 14px;">
                        <div class="d-flex align-items-center justify-content-between flex-wrap gap-2">
                            <div class="d-flex align-items-center">
                                <div class="rounded-circle mr-2 d-flex align-items-center justify-content-center flex-shrink-0" style="width: 32px; height: 32px; background: #bbf7d0; color: #15803d; font-size: 14px;">
                                    <i class="fa-solid fa-check"></i>
                                </div>
                                <div>
                                    <div class="font-weight-bold text-dark" style="font-size: 13px;" id="bulkSelectedCountText">
                                        {{ __('0 order(s) selected from table') }}
                                    </div>
                                    <small class="text-muted" style="font-size: 11px;">{{ __('Print checked orders or switch to date filters.') }}</small>
                                </div>
                            </div>
                            <div class="btn-group btn-group-toggle" data-toggle="buttons">
                                <label class="btn btn-sm btn-outline-success active font-weight-bold" style="border-radius: 8px 0 0 8px; font-size: 11.5px; padding: 4px 10px;" id="optSelectedOnlyLabel">
                                    <input type="radio" name="scope_selection" id="scope_selected" value="selected" checked> {{ __('Selected Only') }}
                                </label>
                                <label class="btn btn-sm btn-outline-secondary font-weight-bold" style="border-radius: 0 8px 8px 0; font-size: 11.5px; padding: 4px 10px;" id="optUseFiltersLabel">
                                    <input type="radio" name="scope_selection" id="scope_filter" value="filter"> {{ __('Use Filters') }}
                                </label>
                            </div>
                        </div>
                    </div>

                    <div id="bulkFilterControls">
                        <!-- Date Range Header with Active Summary Badge -->
                        <div class="d-flex align-items-center justify-content-between mb-2 flex-wrap gap-2">
                            <label class="form-label font-weight-bold text-dark small mb-0 d-flex align-items-center">
                                <i class="fa-solid fa-calendar-days text-success mr-2" style="font-size: 13px;"></i>
                                <span>{{ __('Quick Date Presets') }}</span>
                            </label>
                            <span class="range-summary-chip" id="summaryChipText">
                                <i class="fa-solid fa-circle-check text-success mr-1" style="font-size: 11px;"></i>
                                <span id="chipRangeLabel">{{ __('Today') }}</span>
                            </span>
                        </div>

                        <!-- 6 Balanced Preset Cards (3x2 on desktop, 2x3 on mobile) -->
                        <div class="presets-grid-3col mb-3">
                            <button type="button" class="btn-preset-card active" data-preset="today">
                                <i class="fa-solid fa-sun"></i>
                                <span>{{ __('Today') }}</span>
                            </button>
                            <button type="button" class="btn-preset-card" data-preset="yesterday">
                                <i class="fa-solid fa-clock-rotate-left"></i>
                                <span>{{ __('Yesterday') }}</span>
                            </button>
                            <button type="button" class="btn-preset-card" data-preset="this_week">
                                <i class="fa-solid fa-calendar-week"></i>
                                <span>{{ __('This Week') }}</span>
                            </button>
                            <button type="button" class="btn-preset-card" data-preset="last_7_days">
                                <i class="fa-solid fa-calendar-check"></i>
                                <span>{{ __('Last 7 Days') }}</span>
                            </button>
                            <button type="button" class="btn-preset-card" data-preset="this_month">
                                <i class="fa-solid fa-calendar-days"></i>
                                <span>{{ __('This Month') }}</span>
                            </button>
                            <button type="button" class="btn-preset-card" data-preset="all">
                                <i class="fa-solid fa-infinity"></i>
                                <span>{{ __('All Time') }}</span>
                            </button>
                        </div>

                        <!-- Custom Date Range Section -->
                        <div class="custom-date-box mb-3 p-3" style="background: #f8fafc; border: 1.5px solid #e2e8f0; border-radius: 14px;">
                            <div class="d-flex align-items-center justify-content-between mb-2">
                                <span class="font-weight-bold text-dark small d-flex align-items-center" style="font-size: 11.5px; text-transform: uppercase; letter-spacing: 0.4px;">
                                    <i class="fa-solid fa-sliders text-muted mr-1.5" style="font-size: 12px; margin-right: 6px;"></i> {{ __('Custom Date Range') }}
                                </span>
                                <small class="text-muted" style="font-size: 11px;">{{ __('Or adjust dates manually') }}</small>
                            </div>
                            <div class="row gx-2">
                                <div class="col-6 pr-1">
                                    <label class="form-label text-muted font-weight-bold" style="font-size: 11px; margin-bottom: 4px; display: block;">{{ __('From') }}</label>
                                    <div class="custom-date-input-wrap">
                                        <i class="fa-regular fa-calendar custom-date-icon"></i>
                                        <input type="text" name="start_date" id="modal_start_date" class="form-control datepicker custom-date-control" placeholder="{{ __('MM/DD/YYYY') }}">
                                    </div>
                                </div>
                                <div class="col-6 pl-1">
                                    <label class="form-label text-muted font-weight-bold" style="font-size: 11px; margin-bottom: 4px; display: block;">{{ __('To') }}</label>
                                    <div class="custom-date-input-wrap">
                                        <i class="fa-regular fa-calendar-check custom-date-icon"></i>
                                        <input type="text" name="end_date" id="modal_end_date" class="form-control datepicker custom-date-control" placeholder="{{ __('MM/DD/YYYY') }}">
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Order Fulfillment Status Dropdown -->
                        <div class="form-group mb-0">
                            <label class="form-label font-weight-bold text-dark small mb-2 d-flex align-items-center">
                                <i class="fa-solid fa-truck-ramp-box text-primary mr-2" style="font-size: 13px;"></i>
                                <span>{{ __('Filter by Order Status') }}</span>
                            </label>
                            <div class="status-select-wrap">
                                <select name="type" id="modal_order_status" class="form-control" style="border-radius: 10px !important; font-weight: 600 !important; font-size: 12.5px !important; height: 42px !important; border: 1.5px solid #cbd5e1 !important; background: #ffffff !important; color: #0f172a !important; padding: 0 14px !important;">
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
                </div>

                <!-- Modal Footer with Cancel & Submit -->
                <div class="modal-footer bg-light border-0 py-3 px-4 d-flex justify-content-between align-items-center" style="border-top: 1px solid #e2e8f0 !important;">
                    <button type="button" class="btn btn-light border px-4 font-weight-bold" style="border-radius: 12px; color: #475569; font-size: 13px; height: 42px;" data-dismiss="modal">
                        {{ __('Cancel') }}
                    </button>
                    <button type="submit" class="btn btn-primary px-4 font-weight-bold d-inline-flex align-items-center shadow-sm" id="bulkSubmitBtn" style="border-radius: 12px; font-size: 13px; height: 42px; background: linear-gradient(135deg, #10b981 0%, #059669 100%); border: none;">
                        <i class="fa-solid fa-print mr-2"></i> <span id="bulkSubmitBtnText">{{ __('Download / Print Invoices') }}</span>
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

    function formatDisplayDate(d) {
        var months = ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'];
        return ('0' + d.getDate()).slice(-2) + ' ' + months[d.getMonth()] + ', ' + d.getFullYear();
    }

    function applyDatePreset(preset) {
        $('#modal_time_frame').val(preset);
        $('.btn-preset-card').removeClass('active');
        $('.btn-preset-card[data-preset="' + preset + '"]').addClass('active');

        var now = new Date();
        var todayInput = formatUsDate(now);
        var todayDisplay = formatDisplayDate(now);
        var chipText = '';

        if (preset === 'today') {
            $('#modal_start_date').val(todayInput);
            $('#modal_end_date').val(todayInput);
            chipText = 'Today: ' + todayDisplay;
        } else if (preset === 'yesterday') {
            var yest = new Date();
            yest.setDate(yest.getDate() - 1);
            $('#modal_start_date').val(formatUsDate(yest));
            $('#modal_end_date').val(formatUsDate(yest));
            chipText = 'Yesterday: ' + formatDisplayDate(yest);
        } else if (preset === 'this_week') {
            var d = new Date();
            var day = d.getDay();
            var diff = d.getDate() - day + (day === 0 ? -6 : 1); // Monday
            var monday = new Date(d.setDate(diff));
            $('#modal_start_date').val(formatUsDate(monday));
            $('#modal_end_date').val(todayInput);
            chipText = 'This Week: ' + formatDisplayDate(monday) + ' – ' + todayDisplay;
        } else if (preset === 'last_7_days') {
            var d7 = new Date();
            d7.setDate(d7.getDate() - 6);
            $('#modal_start_date').val(formatUsDate(d7));
            $('#modal_end_date').val(todayInput);
            chipText = 'Last 7 Days: ' + formatDisplayDate(d7) + ' – ' + todayDisplay;
        } else if (preset === 'this_month') {
            var firstDay = new Date(now.getFullYear(), now.getMonth(), 1);
            $('#modal_start_date').val(formatUsDate(firstDay));
            $('#modal_end_date').val(todayInput);
            chipText = 'This Month: ' + formatDisplayDate(firstDay) + ' – ' + todayDisplay;
        } else if (preset === 'all') {
            $('#modal_start_date').val('');
            $('#modal_end_date').val('');
            chipText = 'All Time (No Date Filter)';
        } else if (preset === 'custom') {
            var s = $('#modal_start_date').val();
            var e = $('#modal_end_date').val();
            chipText = 'Custom: ' + (s || 'Start') + ' – ' + (e || 'End');
        }

        $('#chipRangeLabel').text(chipText);
    }

    $(document).ready(function() {
        var dpOptions = {
            format: 'MM/DD/YYYY',
            allowInputToggle: true,
            showTodayButton: true,
            showClose: true,
            icons: {
                time: 'fa-regular fa-clock',
                date: 'fa-regular fa-calendar-alt',
                up: 'fa-solid fa-chevron-up',
                down: 'fa-solid fa-chevron-down',
                previous: 'fa-solid fa-chevron-left',
                next: 'fa-solid fa-chevron-right',
                today: 'fa-solid fa-calendar-day',
                clear: 'fa-solid fa-trash-can',
                close: 'fa-solid fa-xmark'
            }
        };

        // Initialize datepickers with allowInputToggle for both main page and modal
        $('#datepicker, #datepicker1, #modal_start_date, #modal_end_date').each(function() {
            if ($(this).data('DateTimePicker')) {
                $(this).data('DateTimePicker').destroy();
            }
            $(this).datetimepicker(dpOptions);
        });

        // Click anywhere in the date container or input opens the calendar
        $(document).on('click', '.custom-date-input-wrap', function(e) {
            var $inp = $(this).find('input.datepicker');
            if ($inp.length && $inp.data('DateTimePicker')) {
                $inp.data('DateTimePicker').show();
            }
        });
        $(document).on('click', '#datepicker, #datepicker1, #modal_start_date, #modal_end_date', function(e) {
            if ($(this).data('DateTimePicker')) {
                $(this).data('DateTimePicker').show();
            }
        });

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
                $('#bulkModalHeader').css('background', 'linear-gradient(135deg, #064e3b 0%, #047857 100%)');
                $('#bulkModalIcon').attr('class', 'fa-solid fa-file-invoice');
                $('#bulkModalHeadingText').text("{{ __('Bulk Invoices Generator') }}");
                $('#bulkModalSubtext').text("{{ __('Filter orders to generate and print official tax invoices.') }}");
                $('#bulkPrintForm').attr('action', "{{ route('back.order.bulk.invoices') }}");
                $('#bulkSubmitBtn').css('background', 'linear-gradient(135deg, #10b981 0%, #059669 100%)');
                $('#bulkSubmitBtnText').text("{{ __('Download / Print Invoices') }}");
            } else {
                $('#bulkModalHeader').css('background', 'linear-gradient(135deg, #0f172a 0%, #1e293b 100%)');
                $('#bulkModalIcon').attr('class', 'fa-solid fa-tags');
                $('#bulkModalHeadingText').text("{{ __('Bulk Packing Labels Generator') }}");
                $('#bulkModalSubtext').text("{{ __('Filter orders to generate and print 4x6 / thermal packing labels.') }}");
                $('#bulkPrintForm').attr('action', "{{ route('back.order.bulk.packing_labels') }}");
                $('#bulkSubmitBtn').css('background', 'linear-gradient(135deg, #1e293b 0%, #0f172a 100%)');
                $('#bulkSubmitBtnText').text("{{ __('Download / Print Packing Labels') }}");
            }

            if (selectedCount > 0) {
                $('#bulkSelectedAlert').removeClass('d-none');
                $('#bulkSelectedCountText').text(selectedCount + " {{ __('order(s) selected from table') }}");
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
        $(document).on('click', '.btn-preset-card', function(e) {
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
            $('.btn-preset-card').removeClass('active');
            var s = $('#modal_start_date').val();
            var e = $('#modal_end_date').val();
            $('#chipRangeLabel').text('Custom: ' + (s || 'Start') + ' – ' + (e || 'End'));
        });
    });
</script>
@endsection
