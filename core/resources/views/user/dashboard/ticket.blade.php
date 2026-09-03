@extends('master.front')
@section('title')
    {{__('Support Tickets')}}
@endsection
@section('content')

<!-- Page Title-->
<div class="page-title">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <ul class="breadcrumbs">
                    <li><a href="{{ route('front.index') }}">{{__('Home')}}</a> </li>
                    <li class="separator"></li>
                    <li>{{__('My Account')}} </li>
                    <li class="separator"></li>
                    <li>{{__('Support Tickets')}} </li>
                </ul>
            </div>
        </div>
    </div>
</div>

<!-- Page Content-->
<div class="container padding-bottom-3x mb-1">
    <div class="row">
        @include('includes.user_sitebar')
        
        <div class="col-lg-8">
            <div class="padding-top-2x mt-2 hidden-lg-up"></div>

            <div class="card modern-ticket-card border-0 shadow-sm rounded-4">
                <!-- Header -->
                <div class="card-header bg-white px-4 py-3 border-bottom d-flex flex-wrap align-items-center justify-content-between gap-3">
                    <div>
                        <h4 class="mb-1 text-dark fw-bold fs-5">
                            <i class="icon-file-text text-success mr-2"></i>{{ __('Support Tickets') }}
                        </h4>
                        <p class="mb-0 text-muted small">
                            {{ __('Need help with your orders or account? Submit and track your requests here.') }}
                        </p>
                    </div>
                    <a href="{{ route('user.ticket.create') }}" class="btn btn-sm btn-create-ticket px-3 py-2">
                        <i class="icon-plus mr-1"></i> {{ __('Create New Ticket') }}
                    </a>
                </div>

                <!-- Body / Ticket List -->
                <div class="card-body p-0">
                    @if($tickets->count() > 0)
                        <!-- Desktop Table View -->
                        <div class="table-responsive d-none d-md-block">
                            <table class="table table-hover align-middle mb-0 custom-ticket-table">
                                <thead class="table-light">
                                    <tr>
                                        <th class="ps-4">{{ __('Subject') }}</th>
                                        <th>{{ __('Status') }}</th>
                                        <th>{{ __('Last Reply') }}</th>
                                        <th class="text-end pe-4">{{ __('Actions') }}</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($tickets as $ticket)
                                        <tr>
                                            <td class="ps-4">
                                                <a href="{{ route('user.ticket.view', $ticket->id) }}" class="fw-bold text-dark text-decoration-none hover-primary">
                                                    {{ $ticket->subject }}
                                                </a>
                                            </td>
                                            <td>
                                                @if($ticket->status == 'Open' || $ticket->status == 'Pending')
                                                    <span class="badge bg-warning-subtle text-warning border border-warning-subtle rounded-pill px-3 py-1">{{ $ticket->status }}</span>
                                                @elseif($ticket->status == 'Closed')
                                                    <span class="badge bg-secondary-subtle text-secondary border border-secondary-subtle rounded-pill px-3 py-1">{{ $ticket->status }}</span>
                                                @else
                                                    <span class="badge bg-success-subtle text-success border border-success-subtle rounded-pill px-3 py-1">{{ $ticket->status }}</span>
                                                @endif
                                            </td>
                                            <td>
                                                <span class="text-muted small">
                                                    @if ($ticket->lastMessage)
                                                        <i class="icon-clock mr-1"></i>{{ \Carbon\Carbon::parse($ticket->lastMessage->created_at)->diffForHumans() }}
                                                    @else
                                                        {{ __('No Reply') }}
                                                    @endif
                                                </span>
                                            </td>
                                            <td class="text-end pe-4">
                                                <div class="d-inline-flex align-items-center gap-2">
                                                    <a class="btn btn-sm btn-outline-success rounded-pill px-3 py-1" href="{{ route('user.ticket.view', $ticket->id) }}">
                                                        <i class="icon-eye mr-1"></i> {{ __('View') }}
                                                    </a>
                                                    <a class="btn btn-sm btn-outline-danger rounded-circle p-1 d-inline-flex align-items-center justify-content-center" style="width: 28px; height: 28px;" href="{{ route('user.ticket.delete', $ticket->id) }}" onclick="return confirm('{{ __('Are you sure you want to delete this ticket?') }}')">
                                                        <i class="icon-trash"></i>
                                                    </a>
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>

                        <!-- Mobile Card List View -->
                        <div class="d-md-none p-3">
                            @foreach ($tickets as $ticket)
                                <div class="ticket-mobile-card mb-3 p-3 bg-white rounded-3 border shadow-sm">
                                    <div class="d-flex justify-content-between align-items-start mb-2">
                                        <a href="{{ route('user.ticket.view', $ticket->id) }}" class="fw-bold text-dark text-decoration-none fs-6 mb-0">
                                            {{ $ticket->subject }}
                                        </a>
                                        @if($ticket->status == 'Open' || $ticket->status == 'Pending')
                                            <span class="badge bg-warning-subtle text-warning border border-warning-subtle rounded-pill px-2 py-1 small">{{ $ticket->status }}</span>
                                        @elseif($ticket->status == 'Closed')
                                            <span class="badge bg-secondary-subtle text-secondary border border-secondary-subtle rounded-pill px-2 py-1 small">{{ $ticket->status }}</span>
                                        @else
                                            <span class="badge bg-success-subtle text-success border border-success-subtle rounded-pill px-2 py-1 small">{{ $ticket->status }}</span>
                                        @endif
                                    </div>
                                    <div class="d-flex justify-content-between align-items-center mt-3 pt-2 border-top">
                                        <span class="text-muted small">
                                            @if ($ticket->lastMessage)
                                                <i class="icon-clock mr-1"></i>{{ \Carbon\Carbon::parse($ticket->lastMessage->created_at)->diffForHumans() }}
                                            @else
                                                {{ __('No Reply') }}
                                            @endif
                                        </span>
                                        <div class="d-flex align-items-center gap-2">
                                            <a class="btn btn-sm btn-outline-success rounded-pill px-3 py-1" href="{{ route('user.ticket.view', $ticket->id) }}">
                                                {{ __('View') }}
                                            </a>
                                            <a class="btn btn-sm btn-outline-danger rounded-circle p-1 d-inline-flex align-items-center justify-content-center" style="width: 28px; height: 28px;" href="{{ route('user.ticket.delete', $ticket->id) }}" onclick="return confirm('{{ __('Are you sure you want to delete this ticket?') }}')">
                                                <i class="icon-trash"></i>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    @else
                        <!-- Clean Empty State -->
                        <div class="text-center py-5 px-3">
                            <div class="ticket-empty-icon mb-3">
                                <i class="icon-message-square"></i>
                            </div>
                            <h5 class="text-dark fw-bold mb-1">{{ __('No Support Tickets Found') }}</h5>
                            <p class="text-muted small mb-4" style="max-width: 360px; margin: 0 auto;">
                                {{ __('Have a question, inquiry, or issue? Create a new support ticket and our team will assist you.') }}
                            </p>
                            <a href="{{ route('user.ticket.create') }}" class="btn btn-sm btn-create-ticket rounded-pill px-4 py-2">
                                <i class="icon-plus mr-1"></i> {{ __('Create Your First Ticket') }}
                            </a>
                        </div>
                    @endif
                </div>
            </div>

        </div>
    </div>
</div>

<style>
/* Modern Ticket Styles */
.modern-ticket-card {
    background: #ffffff !important;
    border-radius: 18px !important;
    overflow: hidden !important;
    border: 1px solid #e2e8f0 !important;
    box-shadow: 0 4px 20px rgba(0, 0, 0, 0.05) !important;
}

.btn-create-ticket {
    background: linear-gradient(135deg, #059669 0%, #047857 100%) !important;
    color: #ffffff !important;
    border: none !important;
    border-radius: 999px !important;
    font-size: 13px !important;
    font-weight: 700 !important;
    box-shadow: 0 4px 12px rgba(5, 150, 105, 0.3) !important;
    transition: all 0.2s ease !important;
    display: inline-flex !important;
    align-items: center !important;
}

.btn-create-ticket:hover {
    background: linear-gradient(135deg, #047857 0%, #065f46 100%) !important;
    color: #ffffff !important;
    transform: translateY(-2px) !important;
    box-shadow: 0 6px 18px rgba(5, 150, 105, 0.4) !important;
}

.custom-ticket-table th {
    font-size: 12px !important;
    font-weight: 700 !important;
    text-transform: uppercase !important;
    letter-spacing: 0.5px !important;
    color: #64748b !important;
    padding: 14px 16px !important;
    border-bottom: 1px solid #e2e8f0 !important;
}

.custom-ticket-table td {
    padding: 16px !important;
    font-size: 14px !important;
    border-bottom: 1px solid #f1f5f9 !important;
}

.ticket-mobile-card {
    border: 1px solid #e2e8f0 !important;
    border-radius: 14px !important;
    transition: all 0.2s ease !important;
}

.ticket-mobile-card:hover {
    border-color: #cbd5e1 !important;
    box-shadow: 0 4px 14px rgba(0, 0, 0, 0.06) !important;
}

.ticket-empty-icon {
    width: 72px;
    height: 72px;
    border-radius: 50%;
    background: #ecfdf5;
    color: #059669;
    font-size: 32px;
    display: inline-flex;
    align-items: center;
    justify-content: center;
    margin: 0 auto;
}

.bg-warning-subtle { background-color: #fffbeb !important; }
.bg-info-subtle { background-color: #eff6ff !important; }
.bg-success-subtle { background-color: #ecfdf5 !important; }
.bg-secondary-subtle { background-color: #f1f5f9 !important; }

.hover-primary:hover {
    color: #059669 !important;
}

@media (max-width: 767px) {
    .modern-ticket-card {
        border-radius: 14px !important;
    }
    .btn-create-ticket {
        width: 100% !important;
        justify-content: center !important;
    }
}
</style>
@endsection

