@extends('master.back')

@section('content')

<!-- Start of Main Content -->
<div class="container-fluid">

    <!-- Page Header Banner -->
    <div class="dash-hero-banner mb-4">
        <div class="dash-hero-content">
            <div class="dash-hero-text">
                <h2><i class="fa-solid fa-user-clock mr-2" style="font-size: 22px;"></i> {{ __('Guest Customers') }}</h2>
                <p>{{ __('Review guest customer contact details, phone numbers, emails, and order histories from non-registered checkouts.') }}</p>
            </div>
        </div>
    </div>

    <!-- Quick Stat Cards -->
    <div class="row mb-4">
        <div class="col-md-6 mb-3 mb-md-0">
            <div class="feature-toggle-card" style="margin-bottom: 0;">
                <div class="d-flex align-items-center" style="gap: 16px;">
                    <div class="ticket-user-avatar" style="width: 48px; height: 48px; background: #e0f2fe; color: #0284c7; font-size: 20px;">
                        <i class="fa-solid fa-user-tag"></i>
                    </div>
                    <div>
                        <h6 style="font-size: 13px; color: #64748b; margin-bottom: 2px;">{{ __('Total Guest Customers') }}</h6>
                        <span style="font-size: 22px; font-weight: 800; color: #0f172a;">{{ $totalGuestCount ?? count($datas) }}</span>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-6">
            <div class="feature-toggle-card" style="margin-bottom: 0;">
                <div class="d-flex align-items-center" style="gap: 16px;">
                    <div class="ticket-user-avatar" style="width: 48px; height: 48px; background: #ecfdf5; color: #059669; font-size: 20px;">
                        <i class="fa-solid fa-bag-shopping"></i>
                    </div>
                    <div>
                        <h6 style="font-size: 13px; color: #64748b; margin-bottom: 2px;">{{ __('Total Guest Orders Placed') }}</h6>
                        <span style="font-size: 22px; font-weight: 800; color: #0f172a;">{{ $totalGuestOrders ?? 0 }}</span>
                    </div>
                </div>
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
                            <th width="25%">{{ __('Customer Name') }}</th>
                            <th width="25%">{{ __('Email Address') }}</th>
                            <th width="20%">{{ __('Mobile / Phone') }}</th>
                            <th width="15%">{{ __('Location') }}</th>
                            <th width="15%" class="text-right">{{ __('Actions') }}</th>
                        </tr>
                    </thead>

                    <tbody>
                        @foreach($datas as $data)
                        <tr>
                            <td>
                                <div class="d-flex align-items-center" style="gap: 12px;">
                                    <div class="ticket-user-avatar" style="background: #f1f5f9; color: #64748b;">
                                        <i class="fa-solid fa-user-clock"></i>
                                    </div>
                                    <div>
                                        <a href="{{ route('back.user.guest.show', $data->id) }}" class="ticket-user-name" style="text-decoration: none;">
                                            {{ $data->name() }}
                                        </a>
                                        <span class="ticket-user-email">
                                            <i class="fa-regular fa-clock mr-1"></i> {{ $data->created_at ? $data->created_at->diffForHumans() : __('N/A') }}
                                        </span>
                                    </div>
                                </div>
                            </td>

                            <td>
                                @if($data->email)
                                    <a href="mailto:{{ $data->email }}" class="text-dark font-weight-600" style="font-size: 13.5px; text-decoration: none;">
                                        <i class="fa-regular fa-envelope text-primary mr-1"></i> {{ $data->email }}
                                    </a>
                                @else
                                    <span class="text-muted" style="font-size: 12.5px;">{{ __('Not Provided') }}</span>
                                @endif
                            </td>

                            <td>
                                @if($data->phone)
                                    <a href="tel:{{ $data->phone }}" class="text-muted font-weight-600" style="font-size: 13.5px; text-decoration: none;">
                                        <i class="fa-solid fa-phone text-success mr-1"></i> {{ $data->phone }}
                                    </a>
                                @else
                                    <span class="text-muted" style="font-size: 12.5px;">{{ __('Not Provided') }}</span>
                                @endif
                            </td>

                            <td>
                                @if($data->bill_city || $data->bill_country)
                                    <span class="text-dark" style="font-size: 13px;">
                                        <i class="fa-solid fa-location-dot text-danger mr-1"></i>
                                        {{ $data->bill_city }}{{ $data->bill_city && $data->bill_country ? ', ' : '' }}{{ $data->bill_country }}
                                    </span>
                                @else
                                    <span class="text-muted" style="font-size: 12px;">{{ __('N/A') }}</span>
                                @endif
                            </td>

                            <td class="text-right">
                                <div class="action-btn-group justify-content-end">
                                    <a class="btn-action-icon btn-action-view" href="{{ route('back.user.guest.show', $data->id) }}" title="{{ __('View Details & Orders') }}">
                                        <i class="fa-solid fa-eye"></i>
                                    </a>
                                    <a class="btn-action-icon btn-action-delete" data-toggle="modal" data-target="#confirm-delete" href="javascript:;" data-href="{{ route('back.user.guest.destroy', $data->id) }}" title="{{ __('Delete') }}">
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
            {{ __('Are you sure you want to delete this guest customer record?') }}
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
