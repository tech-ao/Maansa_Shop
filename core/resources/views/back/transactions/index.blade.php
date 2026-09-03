@extends('master.back')

@section('content')

<!-- Start of Main Content -->
<div class="container-fluid">

    <!-- Page Header Banner -->
    <div class="dash-hero-banner mb-4">
        <div class="dash-hero-content">
            <div class="dash-hero-text">
                <h2>
                    @if(isset($activeType) && $activeType === 'failed')
                        <i class="fa-solid fa-triangle-exclamation mr-2 text-danger" style="font-size: 22px;"></i> {{ $title ?? __('Failed Transactions') }}
                    @else
                        <i class="fa-solid fa-receipt mr-2" style="font-size: 22px;"></i> {{ $title ?? __('Payment Transactions') }}
                    @endif
                </h2>
                <p>{{ $subtitle ?? __('Monitor customer gateway payments, transaction identifiers, invoice billing, and settlement logs.') }}</p>
            </div>
            <div class="dash-hero-actions">
                <a href="{{ route('back.csv.transaction.export') }}?type={{ $activeType ?? 'payment' }}" class="btn btn-hero-action btn-hero-primary" style="font-size: 13.5px; font-weight: 700; padding: 10px 20px;">
                    <i class="fa-solid fa-file-csv mr-1"></i> {{ __('CSV Export') }}
                </a>
                <form class="d-inline-block" action="{{ route('back.bulk.delete') }}" method="get" onsubmit="return confirm('{{ __('Are you sure you want to delete the selected transactions?') }}');">
                    <input type="hidden" value="" name="ids[]" id="bulk_delete">
                    <input type="hidden" value="transactions" name="table">
                    <button class="btn btn-hero-action" style="background: rgba(239, 68, 68, 0.25); border-color: rgba(239, 68, 68, 0.4); font-size: 13.5px; font-weight: 700; padding: 10px 20px;">
                        <i class="fa-solid fa-trash-can mr-1"></i> {{ __('Bulk Delete') }}
                    </button>
                </form>
            </div>
        </div>
    </div>

    <!-- Transactions Table Card -->
    <div class="card-modern">
        <div class="card-modern-body">
            @include('alerts.alerts')
            <div class="table-responsive">
                <table class="table-modern" id="admin-table" width="100%" cellspacing="0">
                    <thead>
                        @if(isset($activeType) && $activeType === 'failed')
                            <tr>
                                <th width="4%">
                                    <input type="checkbox" data-target="transaction-bulk-delete" class="bulk_all_delete" style="cursor: pointer; width: 16px; height: 16px;">
                                </th>
                                <th width="20%">{{ __('Customer') }}</th>
                                <th width="12%">{{ __('Gateway') }}</th>
                                <th width="26%">{{ __('Failure Reason') }}</th>
                                <th width="12%">{{ __('Attempts') }}</th>
                                <th width="10%">{{ __('Amount') }}</th>
                                <th width="11%">{{ __('Last Attempt') }}</th>
                                <th width="5%" class="text-right">{{ __('Action') }}</th>
                            </tr>
                        @else
                            <tr>
                                <th width="4%">
                                    <input type="checkbox" data-target="transaction-bulk-delete" class="bulk_all_delete" style="cursor: pointer; width: 16px; height: 16px;">
                                </th>
                                <th width="22%">{{ __('Customer') }}</th>
                                <th width="18%">{{ __('Transaction ID') }}</th>
                                <th width="14%">{{ __('Payment Method') }}</th>
                                <th width="13%">{{ __('Order Status') }}</th>
                                <th width="12%">{{ __('Payment Status') }}</th>
                                <th width="12%">{{ __('Amount') }}</th>
                                <th width="5%" class="text-right">{{ __('Action') }}</th>
                            </tr>
                        @endif
                    </thead>

                    <tbody>
                        @include('back.transactions.table', compact('datas'))
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
			{{ __('Are you sure') }} {{ __('Do you want to delete it?') }}
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
