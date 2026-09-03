@extends('master.front')
@section('title')
    {{__('Create Support Ticket')}}
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
                    <li>{{__('New Ticket')}} </li>
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
                <div class="card-header bg-white px-4 py-3 border-bottom d-flex align-items-center justify-content-between">
                    <div>
                        <h4 class="mb-1 text-dark fw-bold fs-5">
                            <i class="icon-plus-circle text-success mr-2"></i>{{ __('Create New Ticket') }}
                        </h4>
                        <p class="mb-0 text-muted small">
                            {{ __('Describe your query or issue below and our customer support team will reply promptly.') }}
                        </p>
                    </div>
                    <a href="{{ route('user.ticket') }}" class="btn btn-sm btn-outline-secondary rounded-pill px-3">
                        <i class="icon-arrow-left mr-1"></i> {{ __('Back to List') }}
                    </a>
                </div>

                <!-- Form Body -->
                <div class="card-body p-4">
                    <form action="{{ route('user.ticket.store') }}" method="post" enctype="multipart/form-data" class="contact-form">
                        @csrf

                        <!-- Subject -->
                        <div class="mb-3">
                            <label for="subject" class="form-label-custom">{{ __('Subject') }} <span class="text-danger">*</span></label>
                            <input type="text" class="form-control custom-input" id="subject" name="subject" value="{{ old('subject') }}" placeholder="{{ __('E.g. Issue with Order #12345, Delivery Status, etc.') }}" required>
                            @error('subject')
                                <p class="text-danger small mt-1 mb-0">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Message -->
                        <div class="mb-3">
                            <label for="inputMessage" class="form-label-custom">{{ __('Message / Details') }} <span class="text-danger">*</span></label>
                            <textarea name="message" id="inputMessage" class="form-control custom-input-textarea" rows="5" placeholder="{{ __('Please provide detailed information so we can assist you quickly...') }}" required>{{ old('message') }}</textarea>
                            @error('message')
                                <p class="text-danger small mt-1 mb-0">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Attachment -->
                        <div class="mb-4">
                            <label class="form-label-custom">{{ __('Attachment') }} <span class="text-muted fw-normal">({{ __('Optional, .zip format') }})</span></label>
                            <div class="file-upload-box p-3 bg-light rounded-3 border d-flex align-items-center gap-3">
                                <label for="customFile" class="btn btn-sm btn-outline-success rounded-pill px-3 mb-0 cursor-pointer">
                                    <i class="icon-paperclip mr-1"></i> {{ __('Choose File') }}
                                </label>
                                <input type="file" name="file" id="customFile" class="d-none" onchange="document.getElementById('ticket_file_label').textContent = this.files[0] ? this.files[0].name : ''">
                                <span id="ticket_file_label" class="small text-muted text-truncate" style="max-width: 250px;">{{ __('No file selected') }}</span>
                            </div>
                            @error('file')
                                <p class="text-danger small mt-1 mb-0">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Submit Button -->
                        <div class="d-flex justify-content-end pt-3 border-top">
                            <button class="btn btn-save-profile px-4 py-2" type="submit">
                                <i class="icon-send mr-2"></i> <span>{{ __('Submit Ticket') }}</span>
                            </button>
                        </div>
                    </form>
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

.form-label-custom {
    font-size: 13px !important;
    font-weight: 600 !important;
    color: #334155 !important;
    margin-bottom: 6px !important;
    display: block !important;
}

.custom-input {
    width: 100% !important;
    padding: 11px 16px !important;
    font-size: 14px !important;
    border-radius: 12px !important;
    border: 1px solid #cbd5e1 !important;
    background: #ffffff !important;
    color: #0f172a !important;
    transition: all 0.2s ease !important;
}

.custom-input:focus,
.custom-input-textarea:focus {
    border-color: #059669 !important;
    box-shadow: 0 0 0 3px rgba(5, 150, 105, 0.15) !important;
    outline: none !important;
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

.cursor-pointer {
    cursor: pointer !important;
}

@media (max-width: 767px) {
    .modern-ticket-card {
        border-radius: 14px !important;
    }
    .btn-save-profile {
        width: 100% !important;
    }
}
</style>
@endsection

