@extends('master.back')

@section('content')

<div class="container-fluid">

    <!-- Page Header Banner -->
    <div class="dash-hero-banner mb-4">
        <div class="dash-hero-content">
            <div class="dash-hero-text">
                <h2><i class="fa-solid fa-plus-circle mr-2" style="font-size: 22px;"></i> {{ __('Create Support Ticket') }}</h2>
                <p>{{ __('Open a new support inquiry on behalf of a registered customer.') }}</p>
            </div>
            <div class="dash-hero-actions">
                <a class="btn btn-hero-action btn-hero-primary" href="{{ route('back.ticket.index') }}" style="font-size: 13.5px; font-weight: 700; padding: 10px 20px;">
                    <i class="fa-solid fa-chevron-left mr-1"></i> {{ __('Back to Tickets') }}
                </a>
            </div>
        </div>
    </div>

    <!-- Form Card -->
    <div class="row">
        <div class="col-lg-12">
            <div class="card-modern">
                <div class="card-modern-body">
                    <form class="admin-form" action="{{ route('back.ticket.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @include('alerts.alerts')

                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="email" class="form-label font-weight-bold">{{ __('Customer Email') }} *</label>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text bg-light"><i class="fa-solid fa-envelope text-muted"></i></span>
                                    </div>
                                    <input type="email" name="email" class="form-control" id="email" placeholder="{{ __('customer@example.com') }}" value="{{ old('email') }}" required>
                                </div>
                            </div>

                            <div class="col-md-6 mb-3">
                                <label for="subject" class="form-label font-weight-bold">{{ __('Subject') }} *</label>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text bg-light"><i class="fa-solid fa-heading text-muted"></i></span>
                                    </div>
                                    <input type="text" name="subject" class="form-control" id="subject" placeholder="{{ __('Ticket topic / summary') }}" value="{{ old('subject') }}" required>
                                </div>
                            </div>
                        </div>

                        <div class="form-group mb-3">
                            <label for="message" class="form-label font-weight-bold">{{ __('Message Body') }} *</label>
                            <textarea name="message" id="message" class="form-control" rows="6" placeholder="{{ __('Detailed description of the issue or inquiry...') }}" required>{{ old('message') }}</textarea>
                        </div>

                        <div class="form-group mb-4">
                            <label class="form-label font-weight-bold">{{ __('Attachment (Optional)') }}</label>
                            <input type="file" name="file" id="file" class="form-control-file" accept="image/*,.pdf,.zip,.doc,.docx">
                            <small class="form-text text-muted">{{ __('Supported formats: Images, PDF, Word documents, or ZIP files.') }}</small>
                        </div>

                        <div class="d-flex justify-content-end gap-2">
                            <a href="{{ route('back.ticket.index') }}" class="btn btn-secondary px-4 mr-2" style="border-radius: 10px; font-weight: 700;">{{ __('Cancel') }}</a>
                            <button type="submit" class="btn btn-primary px-4" style="border-radius: 10px; font-weight: 700; background: linear-gradient(135deg, #4f46e5, #3b82f6); border: none; box-shadow: 0 4px 12px rgba(79, 70, 229, 0.3);">
                                <i class="fa-solid fa-paper-plane mr-1"></i> {{ __('Submit Ticket') }}
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
