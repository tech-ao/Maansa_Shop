@extends('master.front')
@section('title')
    {{__('View Ticket')}} - {{ $ticket->subject }}
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
                    <li><a href="{{ route('user.ticket') }}">{{__('Support Tickets')}}</a> </li>
                    <li class="separator"></li>
                    <li>{{__('Ticket #')}}{{ $ticket->id }}</li>
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

            <!-- Ticket Header Card -->
            <div class="card modern-ticket-card border-0 shadow-sm rounded-4 mb-4">
                <div class="card-header bg-white px-4 py-3 border-bottom d-flex flex-wrap align-items-center justify-content-between gap-3">
                    <div>
                        <div class="d-flex align-items-center gap-2 mb-1 flex-wrap">
                            <span class="fw-bold text-dark fs-5">{{ $ticket->subject }}</span>
                            @if($ticket->status == 'Open' || $ticket->status == 'Pending')
                                <span class="badge bg-warning-subtle text-warning border border-warning-subtle rounded-pill px-3 py-1">{{ $ticket->status }}</span>
                            @elseif($ticket->status == 'Closed')
                                <span class="badge bg-secondary-subtle text-secondary border border-secondary-subtle rounded-pill px-3 py-1">{{ $ticket->status }}</span>
                            @else
                                <span class="badge bg-success-subtle text-success border border-success-subtle rounded-pill px-3 py-1">{{ $ticket->status }}</span>
                            @endif
                        </div>
                        <p class="mb-0 text-muted small">
                            {{ __('Ticket ID: #') }}{{ $ticket->id }} &bull; {{ __('Created') }} {{ $ticket->created_at->format('M d, Y h:i A') }}
                        </p>
                    </div>

                    <div class="d-flex align-items-center gap-2">
                        @if($ticket->file)
                            <a href="{{ asset('assets/files/'.$ticket->file) }}" title="Download Attachment" class="btn btn-sm btn-outline-success rounded-pill px-3" download>
                                <i class="icon-download mr-1"></i> {{ __('Attachment') }}
                            </a>
                        @endif
                        <a href="{{ route('user.ticket') }}" class="btn btn-sm btn-outline-secondary rounded-pill px-3">
                            <i class="icon-arrow-left mr-1"></i> {{ __('Back') }}
                        </a>
                    </div>
                </div>

                <!-- Messages Thread -->
                <div class="card-body p-4">
                    <div class="ticket-thread-wrapper">
                        @if($ticket->messages->count() > 0)
                            @foreach ($ticket->messages as $message)
                                @if ($message->user_id == 0)
                                    <!-- Admin Message (Left) -->
                                    <div class="message-bubble-row admin-message mb-3">
                                        <div class="message-sender-avatar admin-avatar">
                                            <i class="icon-headphones"></i>
                                        </div>
                                        <div class="message-bubble-content">
                                            <div class="d-flex align-items-center justify-content-between mb-1">
                                                <span class="sender-name fw-bold text-dark">{{ __('Support Team') }}</span>
                                                <span class="message-time text-muted small">{{ \Carbon\Carbon::parse($message->created_at)->diffForHumans() }}</span>
                                            </div>
                                            <div class="message-body text-dark">
                                                {!! nl2br(e($message->message)) !!}
                                            </div>
                                        </div>
                                    </div>
                                @else
                                    <!-- User Message (Right) -->
                                    <div class="message-bubble-row user-message mb-3">
                                        <div class="message-bubble-content">
                                            <div class="d-flex align-items-center justify-content-between mb-1">
                                                <span class="sender-name fw-bold text-success">{{ __('You') }}</span>
                                                <span class="message-time text-muted small">{{ \Carbon\Carbon::parse($message->created_at)->diffForHumans() }}</span>
                                            </div>
                                            <div class="message-body text-dark">
                                                {!! nl2br(e($message->message)) !!}
                                            </div>
                                        </div>
                                        <div class="message-sender-avatar user-avatar-msg">
                                            <i class="icon-user"></i>
                                        </div>
                                    </div>
                                @endif
                            @endforeach
                        @else
                            <div class="text-center py-4 text-muted small">
                                {{ __('No messages in this ticket yet.') }}
                            </div>
                        @endif
                    </div>

                    <!-- Reply Form -->
                    @if($ticket->status != 'Closed')
                        <div class="reply-box-wrapper mt-4 pt-3 border-top">
                            <h6 class="fw-bold text-dark mb-2">
                                <i class="icon-message-square text-success mr-1"></i> {{ __('Post a Reply') }}
                            </h6>
                            <form action="{{ route('user.ticket.reply') }}" method="post" enctype="multipart/form-data" class="contact-form">
                                @csrf
                                <input type="hidden" value="{{ $ticket->id }}" name="ticket_id">
                                
                                <div class="mb-3">
                                    <textarea name="message" class="form-control custom-input-textarea" id="inputMessage" placeholder="{{ __('Type your response or additional information here...') }}" rows="4" required></textarea>
                                    @error('message')
                                        <p class="text-danger small mt-1 mb-0">{{ $message }}</p>
                                    @enderror
                                </div>

                                <div class="d-flex justify-content-end">
                                    <button class="btn btn-save-profile px-4 py-2" type="submit">
                                        <i class="icon-send mr-2"></i> <span>{{ __('Send Reply') }}</span>
                                    </button>
                                </div>
                            </form>
                        </div>
                    @else
                        <div class="alert alert-secondary text-center mt-4 rounded-3 border-0 py-3 mb-0">
                            <i class="icon-lock mr-1"></i> {{ __('This ticket has been marked as Closed. If you need further help, please create a new ticket.') }}
                        </div>
                    @endif
                </div>
            </div>

        </div>
    </div>
</div>

<style>
.modern-ticket-card {
    background: #ffffff !important;
    border-radius: 18px !important;
    overflow: hidden !important;
    border: 1px solid #e2e8f0 !important;
    box-shadow: 0 4px 20px rgba(0, 0, 0, 0.05) !important;
}

.ticket-thread-wrapper {
    display: flex;
    flex-direction: column;
    gap: 12px;
}

.message-bubble-row {
    display: flex;
    align-items: flex-start;
    gap: 12px;
    max-width: 85%;
}

.admin-message {
    align-self: flex-start;
}

.admin-message .message-bubble-content {
    background: #f8fafc;
    border: 1px solid #e2e8f0;
    border-radius: 16px 16px 16px 4px;
    padding: 14px 18px;
}

.user-message {
    align-self: flex-end;
}

.user-message .message-bubble-content {
    background: #ecfdf5;
    border: 1px solid #a7f3d0;
    border-radius: 16px 16px 4px 16px;
    padding: 14px 18px;
}

.message-sender-avatar {
    width: 36px;
    height: 36px;
    min-width: 36px;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 16px;
}

.admin-avatar {
    background: #0f172a;
    color: #ffffff;
}

.user-avatar-msg {
    background: #059669;
    color: #ffffff;
}

.custom-input-textarea {
    width: 100% !important;
    padding: 12px 16px !important;
    font-size: 14px !important;
    border-radius: 12px !important;
    border: 1px solid #cbd5e1 !important;
    background: #ffffff !important;
    color: #0f172a !important;
    transition: all 0.2s ease !important;
}

.custom-input-textarea:focus {
    border-color: #059669 !important;
    box-shadow: 0 0 0 3px rgba(5, 150, 105, 0.15) !important;
    outline: none !important;
}

.btn-save-profile {
    background: linear-gradient(135deg, #059669 0%, #047857 100%) !important;
    color: #ffffff !important;
    border: none !important;
    border-radius: 999px !important;
    font-size: 14px !important;
    font-weight: 700 !important;
    padding: 10px 28px !important;
    box-shadow: 0 4px 14px rgba(5, 150, 105, 0.35) !important;
    transition: all 0.2s ease !important;
    display: inline-flex !important;
    align-items: center !important;
    justify-content: center !important;
}

.btn-save-profile:hover {
    transform: translateY(-2px) !important;
    box-shadow: 0 6px 20px rgba(5, 150, 105, 0.45) !important;
    background: linear-gradient(135deg, #047857 0%, #065f46 100%) !important;
    color: #ffffff !important;
}

.bg-warning-subtle { background-color: #fffbeb !important; }
.bg-success-subtle { background-color: #ecfdf5 !important; }
.bg-secondary-subtle { background-color: #f1f5f9 !important; }

@media (max-width: 767px) {
    .modern-ticket-card {
        border-radius: 14px !important;
    }
    .message-bubble-row {
        max-width: 100%;
    }
    .btn-save-profile {
        width: 100% !important;
    }
}
</style>
@endsection

