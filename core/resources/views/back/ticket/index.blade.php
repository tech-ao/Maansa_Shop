@extends('master.back')

@section('content')

<!-- Start of Main Content -->
<div class="container-fluid">

    @php
        $type = request()->input('type');
        $title = __('All Support Tickets');
        $desc = __('Review customer inquiries, monitor resolution progress, and respond to support threads.');
        $icon = 'fa-solid fa-headset';
        if ($type == 'Pending') {
            $title = __('Pending Support Tickets');
            $desc = __('Tickets waiting for initial review or response from staff.');
            $icon = 'fa-solid fa-clock text-warning';
        } elseif ($type == 'Open') {
            $title = __('Open Support Tickets');
            $desc = __('Active support tickets and conversations in progress.');
            $icon = 'fa-solid fa-envelope-open-text text-primary';
        } elseif ($type == 'Closed') {
            $title = __('Closed Support Tickets');
            $desc = __('Resolved and completed customer support inquiries.');
            $icon = 'fa-solid fa-circle-check text-success';
        }
    @endphp

    <!-- Page Header Banner -->
    <div class="dash-hero-banner mb-4">
        <div class="dash-hero-content">
            <div class="dash-hero-text">
                <h2><i class="{{ $icon }} mr-2" style="font-size: 22px;"></i> {{ $title }}</h2>
                <p>{{ $desc }}</p>
            </div>
            <div class="dash-hero-actions">
                <a class="btn btn-hero-action btn-hero-primary" href="{{ route('back.ticket.create') }}" style="font-size: 13.5px; font-weight: 700; padding: 10px 22px;">
                    <i class="fa-solid fa-plus mr-1"></i> {{ __('Create Ticket') }}
                </a>
            </div>
        </div>
    </div>

    <input type="hidden" id="tickets_url" value="{{ route('back.ticket.index') }}">

    <!-- Data Table Card -->
    <div class="card-modern">
        <div class="card-modern-body">
            @include('alerts.alerts')
            
            <div class="table-responsive">
                <table class="table-modern" id="admin-table" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th width="25%">{{ __('Customer') }}</th>
                            <th width="32%">{{ __('Subject') }}</th>
                            <th width="15%">{{ __('Status') }}</th>
                            <th width="15%">{{ __('Last Reply') }}</th>
                            <th width="13%" class="text-right">{{ __('Actions') }}</th>
                        </tr>
                    </thead>

                    <tbody>
                        @include('back.ticket.table', compact('datas'))
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
			{{ __('You are going to delete this Ticket. All contents related with this ticket will be lost.') }} {{ __('Do you want to delete it?') }}
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
