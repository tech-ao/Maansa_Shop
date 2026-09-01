@extends('master.back')

@section('content')

<div class="container-fluid">

    <!-- Page Header Banner -->
    <div class="dash-hero-banner mb-4">
        <div class="dash-hero-content">
            <div class="dash-hero-text">
                <h2><i class="fa-solid fa-envelope mr-2" style="font-size: 22px;"></i> {{ __('Email Settings & Templates') }}</h2>
                <p>{{ __('Configure outgoing SMTP mail server credentials, notification triggers, and customizable email templates.') }}</p>
                <ul class="profile-breadcrumb mt-2">
                    <li><a href="{{ route('back.dashboard') }}"><i class="fa-solid fa-house"></i> {{ __('Dashboard') }}</a></li>
                    <span class="divider">/</span>
                    <li><a href="{{ route('back.setting.system') }}">{{ __('Settings') }}</a></li>
                    <span class="divider">/</span>
                    <li class="active">{{ __('Email') }}</li>
                </ul>
            </div>
        </div>
    </div>

    <!-- Main Row -->
    <div class="row">
        <!-- Navigation Tabs Column -->
        <div class="col-xl-3 col-lg-4 col-12 mb-3 mb-lg-0">
            <div class="nav settings-nav-pills" id="v-pills-tab" role="tablist" aria-orientation="vertical">
                <a class="nav-link active" data-toggle="pill" href="#conf" role="tab" aria-selected="true">
                    <i class="fa-solid fa-sliders"></i>
                    <span>{{ __('Configuration') }}</span>
                </a>
                <a class="nav-link" data-toggle="pill" href="#template" role="tab" aria-selected="false">
                    <i class="fa-solid fa-file-lines"></i>
                    <span>{{ __('Email Templates') }}</span>
                </a>
            </div>
        </div>

        <!-- Content Panes Column -->
        <div class="col-xl-9 col-lg-8 col-12 mb-4">
            <div class="card-modern">
                <div class="card-modern-body p-4">
                    @include('alerts.alerts')

                    <div class="tab-content" id="emailTabContent">

                        <!-- 1. CONFIGURATION TAB -->
                        <div id="conf" class="tab-pane fade show active" role="tabpanel">
                            <div class="settings-tab-pane-title mb-4 pb-3 border-bottom d-flex align-items-center justify-content-between">
                                <div>
                                    <i class="fa-solid fa-sliders text-primary mr-2" style="font-size: 18px;"></i>
                                    <span>{{ __('Email System Configuration') }}</span>
                                </div>
                                <span class="badge" style="background: #ecfdf5; color: #065f46; border: 1px solid #a7f3d0; font-size: 12px; font-weight: 600; padding: 5px 12px; border-radius: 999px;">
                                    <i class="fa-solid fa-paper-plane mr-1"></i> {{ __('SMTP / Mail') }}
                                </span>
                            </div>

                            <form class="admin-form" action="{{ route('back.email.update') }}" method="POST" enctype="multipart/form-data">
                                @csrf

                                <!-- Mail Triggers & Queue Card -->
                                <div class="settings-section-card mb-4">
                                    <h6 class="section-card-title mb-3">
                                        <i class="fa-solid fa-bell text-primary mr-1"></i> {{ __('Notification Triggers & Delivery') }}
                                    </h6>

                                    <div class="py-2 border-bottom d-flex align-items-center justify-content-between mb-3">
                                        <div>
                                            <div class="font-weight-bold text-dark" style="font-size: 14px;">{{ __('Mail Using Queue') }}</div>
                                            <small class="text-muted">{{ __('Process and send emails in the background queue for faster page loads.') }}</small>
                                        </div>
                                        <div>
                                            <label class="switch-primary mb-0">
                                                <input type="checkbox" class="switch switch-bootstrap" name="is_queue_enabled" value="1" {{ $setting->is_queue_enabled == 1 ? 'checked' : '' }}>
                                                <span class="switch-body"></span>
                                            </label>
                                        </div>
                                    </div>

                                    <div class="py-2 border-bottom d-flex align-items-center justify-content-between mb-3">
                                        <div>
                                            <div class="font-weight-bold text-dark" style="font-size: 14px;">{{ __('After Order Admin Notification') }}</div>
                                            <small class="text-muted">{{ __('Send immediate notification email to store admin when a new order is received.') }}</small>
                                        </div>
                                        <div>
                                            <label class="switch-primary mb-0">
                                                <input type="checkbox" class="switch switch-bootstrap" name="order_mail" value="1" {{ $setting->order_mail == 1 ? 'checked' : '' }}>
                                                <span class="switch-body"></span>
                                            </label>
                                        </div>
                                    </div>

                                    <div class="py-2 border-bottom d-flex align-items-center justify-content-between mb-3">
                                        <div>
                                            <div class="font-weight-bold text-dark" style="font-size: 14px;">{{ __('Ticket Reply Notification') }}</div>
                                            <small class="text-muted">{{ __('Send notification email when a support ticket receives a new reply.') }}</small>
                                        </div>
                                        <div>
                                            <label class="switch-primary mb-0">
                                                <input type="checkbox" class="switch switch-bootstrap" name="ticket_mail" value="1" {{ $setting->ticket_mail == 1 ? 'checked' : '' }}>
                                                <span class="switch-body"></span>
                                            </label>
                                        </div>
                                    </div>

                                    <div class="py-2 d-flex align-items-center justify-content-between">
                                        <div>
                                            <div class="font-weight-bold text-dark" style="font-size: 14px;">{{ __('Enable Email Verification') }}</div>
                                            <small class="text-muted">{{ __('Require newly registered customers to verify their email before account activation.') }}</small>
                                        </div>
                                        <div>
                                            <label class="switch-primary mb-0">
                                                <input type="checkbox" class="switch switch-bootstrap status" name="is_mail_verify" value="1" {{ $setting->is_mail_verify == 1 ? 'checked' : '' }}>
                                                <span class="switch-body"></span>
                                            </label>
                                        </div>
                                    </div>
                                </div>

                                <!-- SMTP Service Setup Card -->
                                <div class="settings-section-card mb-4">
                                    <div class="d-flex align-items-center justify-content-between">
                                        <div>
                                            <h6 class="section-card-title mb-1">
                                                <i class="fa-solid fa-server text-primary mr-1"></i> {{ __('SMTP Service') }}
                                            </h6>
                                            <span class="text-muted" style="font-size: 13px;">{{ __('Send outgoing system emails via custom SMTP mail server.') }}</span>
                                        </div>
                                        <div>
                                            <label class="switch-primary mb-0">
                                                <input type="checkbox" class="switch switch-bootstrap status radio-check" name="smtp_check" value="1" {{ $setting->smtp_check == 1 ? 'checked' : '' }}>
                                                <span class="switch-body"></span>
                                            </label>
                                        </div>
                                    </div>
                                </div>

                                <!-- SMTP Server Credentials Container -->
                                <div class="radio-show {{ $setting->smtp_check == 0 ? 'd-none' : '' }}">
                                    <div class="settings-section-card mb-4">
                                        <h6 class="section-card-title mb-3">
                                            <i class="fa-solid fa-key text-primary mr-1"></i> {{ __('SMTP Server Details') }}
                                        </h6>

                                        <div class="row">
                                            <div class="col-md-6 mb-3">
                                                <label for="email_host" class="form-label font-weight-bold">{{ __('SMTP Host') }} *</label>
                                                <div class="input-group">
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text"><i class="fa-solid fa-network-wired"></i></span>
                                                    </div>
                                                    <input type="text" class="form-control" id="email_host" name="email_host" placeholder="{{ __('e.g. smtp.mailtrap.io') }}" value="{{ $setting->email_host }}">
                                                </div>
                                            </div>

                                            <div class="col-md-3 mb-3">
                                                <label for="email_port" class="form-label font-weight-bold">{{ __('SMTP Port') }} *</label>
                                                <div class="input-group">
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text"><i class="fa-solid fa-hashtag"></i></span>
                                                    </div>
                                                    <input type="text" class="form-control" id="email_port" name="email_port" placeholder="{{ __('e.g. 587') }}" value="{{ $setting->email_port }}">
                                                </div>
                                            </div>

                                            <div class="col-md-3 mb-3">
                                                <label for="email_encryption" class="form-label font-weight-bold">{{ __('Encryption') }} *</label>
                                                <div class="input-group">
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text"><i class="fa-solid fa-shield-halved"></i></span>
                                                    </div>
                                                    <input type="text" class="form-control" id="email_encryption" name="email_encryption" placeholder="{{ __('e.g. tls or ssl') }}" value="{{ $setting->email_encryption }}">
                                                </div>
                                            </div>

                                            <div class="col-md-6 mb-3">
                                                <label for="email_user" class="form-label font-weight-bold">{{ __('SMTP Username') }} *</label>
                                                <div class="input-group">
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text"><i class="fa-solid fa-user"></i></span>
                                                    </div>
                                                    <input type="text" class="form-control" id="email_user" name="email_user" placeholder="{{ __('Enter SMTP Username') }}" value="{{ $setting->email_user }}">
                                                </div>
                                            </div>

                                            <div class="col-md-6 mb-3">
                                                <label for="email_pass" class="form-label font-weight-bold">{{ __('SMTP Password') }} *</label>
                                                <div class="input-group">
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text"><i class="fa-solid fa-lock"></i></span>
                                                    </div>
                                                    <input type="password" class="form-control" id="email_pass" name="email_pass" placeholder="{{ __('Enter SMTP Password') }}" value="{{ $setting->email_pass }}">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!-- Sender Identity & Contact Card -->
                                <div class="settings-section-card mb-4">
                                    <h6 class="section-card-title mb-3">
                                        <i class="fa-solid fa-id-card-clip text-primary mr-1"></i> {{ __('Sender Identity & Contact Addresses') }}
                                    </h6>

                                    <div class="row">
                                        <div class="col-md-6 mb-3">
                                            <label for="email_from" class="form-label font-weight-bold">{{ __('Email From (Sender Address)') }} *</label>
                                            <div class="input-group">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text"><i class="fa-solid fa-at"></i></span>
                                                </div>
                                                <input type="text" class="form-control" id="email_from" name="email_from" placeholder="{{ __('e.g. noreply@domain.com') }}" value="{{ $setting->email_from }}">
                                            </div>
                                        </div>

                                        <div class="col-md-6 mb-3">
                                            <label for="email_from_name" class="form-label font-weight-bold">{{ __('Email From Name (Sender Name)') }} *</label>
                                            <div class="input-group">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text"><i class="fa-solid fa-user-tag"></i></span>
                                                </div>
                                                <input type="text" class="form-control" id="email_from_name" name="email_from_name" placeholder="{{ __('e.g. Store Notifications') }}" value="{{ $setting->email_from_name }}">
                                            </div>
                                        </div>

                                        <div class="col-12 mb-0">
                                            <label for="contact_email" class="form-label font-weight-bold">{{ __('Public Contact Email') }} *</label>
                                            <div class="input-group">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text"><i class="fa-solid fa-envelope-open-text"></i></span>
                                                </div>
                                                <input type="text" class="form-control" id="contact_email" name="contact_email" placeholder="{{ __('e.g. support@domain.com') }}" value="{{ $setting->contact_email }}">
                                            </div>
                                            <small class="text-muted mt-1 d-block" style="font-size: 12px;">
                                                <i class="fa-solid fa-circle-info text-primary mr-1"></i> {{ __('Used for customer replies and public storefront contact forms.') }}
                                            </small>
                                        </div>
                                    </div>
                                </div>

                                <div class="d-flex justify-content-end mt-4">
                                    <button type="submit" class="btn btn-primary px-4 py-2" style="border-radius: 10px; font-weight: 700; background: linear-gradient(135deg, #10b981, #059669); border: none; box-shadow: 0 4px 12px rgba(16, 185, 129, 0.3);">
                                        <i class="fa-solid fa-floppy-disk mr-1"></i> {{ __('Save Email Settings') }}
                                    </button>
                                </div>

                            </form>
                        </div>

                        <!-- 2. EMAIL TEMPLATES TAB -->
                        <div id="template" class="tab-pane fade" role="tabpanel">
                            <div class="settings-tab-pane-title mb-4 pb-3 border-bottom d-flex align-items-center justify-content-between">
                                <div>
                                    <i class="fa-solid fa-file-lines text-primary mr-2" style="font-size: 18px;"></i>
                                    <span>{{ __('Customizable Email Templates') }}</span>
                                </div>
                                <span class="badge" style="background: #f8fafc; color: #475569; border: 1px solid #e2e8f0; font-size: 12px; font-weight: 600; padding: 5px 12px; border-radius: 999px;">
                                    <i class="fa-solid fa-layer-group mr-1"></i> {{ count($datas) }} {{ __('Templates') }}
                                </span>
                            </div>

                            <div class="table-responsive">
                                <table class="table table-modern align-middle" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th width="30%">{{ __('Template Type') }}</th>
                                            <th width="50%">{{ __('Email Subject') }}</th>
                                            <th width="20%" class="text-center">{{ __('Actions') }}</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($datas as $data)
                                            <tr>
                                                <td class="align-middle">
                                                    <span class="badge" style="background: #f1f5f9; color: #334155; border: 1px solid #cbd5e1; font-size: 12.5px; font-weight: 700; padding: 6px 12px; border-radius: 8px;">
                                                        <i class="fa-solid fa-envelope mr-1 text-primary"></i> {{ $data->type }}
                                                    </span>
                                                </td>
                                                <td class="align-middle">
                                                    <div class="font-weight-bold text-dark" style="font-size: 14px;">
                                                        {{ $data->subject }}
                                                    </div>
                                                </td>
                                                <td class="text-center align-middle">
                                                    <a class="btn btn-sm px-3 py-1" 
                                                       style="background: #ecfdf5; color: #059669; border: 1px solid #a7f3d0; font-weight: 600; border-radius: 8px; font-size: 12.5px; transition: all 0.2s;"
                                                       href="{{ route('back.template.edit', $data->id) }}">
                                                        <i class="fa-solid fa-pen-to-square mr-1"></i> {{ __('Edit Template') }}
                                                    </a>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>

</div>

@endsection
