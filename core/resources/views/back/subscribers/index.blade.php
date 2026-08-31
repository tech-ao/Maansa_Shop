@extends('master.back')

@section('content')

<!-- Start of Main Content -->
<div class="container-fluid">

    <!-- Page Header Banner -->
    <div class="dash-hero-banner mb-4">
        <div class="dash-hero-content">
            <div class="dash-hero-text">
                <h2><i class="fa-solid fa-envelope-open-text mr-2" style="font-size: 22px;"></i> {{ __('Newsletter Subscribers') }}</h2>
                <p>{{ __('Manage newsletter mailing list subscribers, monitor audience growth, and send broadcast email campaigns.') }}</p>
            </div>
            <div class="dash-hero-actions">
                <a class="btn btn-hero-action btn-hero-primary" href="{{ route('back.subscribers.mail') }}" style="font-size: 13.5px; font-weight: 700; padding: 10px 20px;">
                    <i class="fa-solid fa-paper-plane mr-1"></i> {{ __('Send Broadcast Email') }}
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
                            <th width="10%" class="text-center">{{ __('#') }}</th>
                            <th width="65%">{{ __('Subscriber Email Address') }}</th>
                            <th width="15%">{{ __('Status') }}</th>
                            <th width="10%" class="text-right">{{ __('Action') }}</th>
                        </tr>
                    </thead>

                    <tbody>
                        @foreach($datas as $data)
                        <tr>
                            <td class="text-center" style="min-width: 60px;">
                                <span style="width: 32px; height: 32px; font-weight: 700; background: #f1f5f9; border-radius: 8px; font-size: 12px; display: inline-flex; align-items: center; justify-content: center; color: #475569;">
                                    {{ $loop->index + 1 }}
                                </span>
                            </td>

                            <td style="min-width: 250px;">
                                <div class="d-flex align-items-center" style="gap: 12px;">
                                    <div class="ticket-user-avatar" style="width: 36px; height: 36px; min-width: 36px; font-size: 13px; background: #e0f2fe; color: #0284c7; border-radius: 10px;">
                                        <i class="fa-solid fa-envelope"></i>
                                    </div>
                                    <div>
                                        <a href="mailto:{{ $data->email }}" class="ticket-user-name" style="text-decoration: none;">
                                            {{ $data->email }}
                                        </a>
                                        <span class="ticket-user-email">
                                            <i class="fa-regular fa-calendar-check mr-1"></i> {{ __('Subscribed') }}
                                        </span>
                                    </div>
                                </div>
                            </td>

                            <td style="min-width: 120px;">
                                <span class="badge-status badge-status-paid">
                                    <i class="fa-solid fa-circle-check mr-1"></i> {{ __('Subscribed') }}
                                </span>
                            </td>

                            <td class="text-right" style="min-width: 80px;">
                                <div class="action-btn-group justify-content-end">
                                    <a class="btn-action-icon btn-action-delete" data-toggle="modal"
                                        data-target="#confirm-delete" href="javascript:;"
                                        data-href="{{ route('back.subscriber.delete', $data->id) }}" title="{{ __('Remove Subscriber') }}">
                                        <i class="fa-solid fa-trash-can"></i>
                                    </a>
                                </div>
                            </td>
                        </tr>
                        @endforeach
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
