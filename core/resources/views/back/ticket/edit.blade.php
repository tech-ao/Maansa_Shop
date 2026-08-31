@extends('master.back')

@section('content')

<div class="container-fluid">

    <!-- Page Header Banner -->
    <div class="dash-hero-banner mb-4">
        <div class="dash-hero-content">
            <div class="dash-hero-text">
                <h2><i class="fa-solid fa-comments mr-2" style="font-size: 22px;"></i> {{ __('Ticket Discussion Thread') }}</h2>
                <p>{{ __('Review conversation history and respond to customer questions in real-time.') }}</p>
            </div>
            <div class="dash-hero-actions">
                <a class="btn btn-hero-action btn-hero-primary" href="{{ route('back.ticket.index') }}" style="font-size: 13.5px; font-weight: 700; padding: 10px 20px;">
                    <i class="fa-solid fa-chevron-left mr-1"></i> {{ __('Back to Tickets') }}
                </a>
            </div>
        </div>
    </div>

    <!-- Ticket Thread Card -->
    <div class="row">
        <div class="col-lg-12">
            <div class="card-modern">
                <div class="card-modern-body">
                    @include('alerts.alerts')

                    <!-- Thread Header Card -->
                    <div class="ticket-thread-header">
                        <div>
                            <div class="d-flex align-items-center mb-1" style="gap: 10px;">
                                @if($ticket->status == 'Pending')
                                    <span class="badge-status badge-status-pending"><i class="fa-solid fa-clock mr-1"></i> {{ __('Pending') }}</span>
                                @elseif($ticket->status == 'Open')
                                    <span class="badge-status badge-status-open"><i class="fa-solid fa-circle-dot mr-1"></i> {{ __('Open') }}</span>
                                @elseif($ticket->status == 'Closed')
                                    <span class="badge-status badge-status-closed"><i class="fa-solid fa-check-circle mr-1"></i> {{ __('Closed') }}</span>
                                @endif
                                <h4 class="mb-0 font-weight-bold" style="font-size: 17px; color: #0f172a;">{{ $ticket->subject }}</h4>
                            </div>
                            <small class="text-muted">
                                <i class="fa-solid fa-user mr-1"></i> {{ $ticket->user->first_name ? $ticket->user->first_name . ' ' . $ticket->user->last_name : __('Customer') }} 
                                &bull; <i class="fa-regular fa-clock ml-2 mr-1"></i> {{ __('Opened') }} {{ \Carbon\Carbon::parse($ticket->created_at)->format('M d, Y h:i A') }}
                            </small>
                        </div>

                        <div class="d-flex align-items-center gap-2">
                            @if($ticket->file)
                                <a href="{{ asset('assets/files/'.$ticket->file) }}" title="{{ __('Download Attachment') }}" class="btn btn-outline-primary btn-sm px-3 mr-2" style="border-radius: 9px; font-weight: 700;" download>
                                    <i class="fa-solid fa-paperclip mr-1"></i> {{ __('Download Attachment') }}
                                </a>
                            @endif

                            @if($ticket->status != 'Closed')
                                <a href="{{ route('back.ticket.status', $ticket->id) }}" class="btn btn-warning btn-sm px-3 text-dark font-weight-bold" style="border-radius: 9px;">
                                    <i class="fa-solid fa-lock mr-1"></i> {{ __('Close Ticket') }}
                                </a>
                            @else
                                <span class="badge-status badge-status-closed px-3 py-2" style="font-size: 13px;">
                                    <i class="fa-solid fa-lock mr-1"></i> {{ __('Ticket Closed') }}
                                </span>
                            @endif
                        </div>
                    </div>

                    <!-- Initial Ticket Message -->
                    @if($ticket->message)
                    <div class="ticket-chat-message ticket-chat-user mb-4">
                        <div class="ticket-chat-sender">
                            <span class="ticket-sender-badge">
                                <i class="fa-solid fa-circle-user"></i>
                                {{ $ticket->user->first_name ? $ticket->user->first_name . ' ' . $ticket->user->last_name : __('Customer') }} ({{ __('Original Request') }})
                            </span>
                            <span class="ticket-chat-time">
                                {{ \Carbon\Carbon::parse($ticket->created_at)->diffForHumans() }}
                            </span>
                        </div>
                        <p class="ticket-chat-text">{{ $ticket->message }}</p>
                    </div>
                    @endif

                    <!-- Message Replies History -->
                    @if($ticket->messages->count() > 0)
                        @foreach ($ticket->messages as $message)
                            @if ($message->user_id == 0)
                                <div class="ticket-chat-message ticket-chat-admin mb-4">
                                    <div class="ticket-chat-sender">
                                        <span class="ticket-sender-badge">
                                            <i class="fa-solid fa-shield-halved"></i>
                                            {{ __('Support Team (Admin)') }}
                                        </span>
                                        <span class="ticket-chat-time">
                                            {{ \Carbon\Carbon::parse($message->created_at)->diffForHumans() }}
                                        </span>
                                    </div>
                                    <p class="ticket-chat-text">{{ $message->message }}</p>
                                </div>
                            @else
                                <div class="ticket-chat-message ticket-chat-user mb-4">
                                    <div class="ticket-chat-sender">
                                        <span class="ticket-sender-badge">
                                            <i class="fa-solid fa-circle-user"></i>
                                            {{ $ticket->user->first_name ? $ticket->user->first_name . ' ' . $ticket->user->last_name : __('Customer') }}
                                        </span>
                                        <span class="ticket-chat-time">
                                            {{ \Carbon\Carbon::parse($message->created_at)->diffForHumans() }}
                                        </span>
                                    </div>
                                    <p class="ticket-chat-text">{{ $message->message }}</p>
                                </div>
                            @endif
                        @endforeach
                    @endif

                    <!-- Reply Form Composer -->
                    @if($ticket->status != 'Closed')
                        <div class="mt-4 pt-3 border-top">
                            <form class="admin-form" action="{{ route('back.ticket.update', $ticket->id) }}" method="POST" enctype="multipart/form-data">
                                @method('PUT')
                                @csrf
                                <input type="hidden" value="{{ $ticket->id }}" name="ticket_id">

                                <div class="form-group mb-3">
                                    <label for="inputMessage" class="form-label font-weight-bold">
                                        <i class="fa-solid fa-reply text-primary mr-1"></i> {{ __('Post a Reply to Customer') }}
                                    </label>
                                    <textarea name="message" class="form-control" id="inputMessage" placeholder="{{ __('Type your response here...') }}" rows="5" required></textarea>
                                </div>

                                <div class="d-flex justify-content-end">
                                    <button class="btn btn-primary px-4 py-2" type="submit" style="border-radius: 10px; font-weight: 700; background: linear-gradient(135deg, #10b981, #059669); border: none; box-shadow: 0 4px 12px rgba(16, 185, 129, 0.3);">
                                        <i class="fa-solid fa-paper-plane mr-1"></i> {{ __('Send Reply') }}
                                    </button>
                                </div>
                            </form>
                        </div>
                    @else
                        <div class="alert alert-secondary text-center mt-4 mb-0" style="border-radius: 12px;">
                            <i class="fa-solid fa-lock mr-1"></i> {{ __('This ticket has been marked as closed.') }}
                        </div>
                    @endif

                </div>
            </div>
        </div>
    </div>
</div>

@endsection
