@extends('master.back')

@section('content')

<div class="container-fluid">

    <!-- Page Header Banner -->
    <div class="dash-hero-banner mb-4">
        <div class="dash-hero-content">
            <div class="dash-hero-text">
                <h2><i class="fa-solid fa-file-pen mr-2" style="font-size: 22px;"></i> {{ __('Edit Email Template') }}</h2>
                <p>{{ __('Customize email subject lines, body message, and dynamic order/user placeholders.') }}</p>
                <ul class="profile-breadcrumb mt-2">
                    <li><a href="{{ route('back.dashboard') }}"><i class="fa-solid fa-house"></i> {{ __('Dashboard') }}</a></li>
                    <span class="divider">/</span>
                    <li><a href="{{ route('back.setting.email') }}">{{ __('Email Settings') }}</a></li>
                    <span class="divider">/</span>
                    <li class="active">{{ __('Edit Template') }}</li>
                </ul>
            </div>
            <div class="dash-hero-actions mt-2 mt-sm-0">
                <a class="btn btn-hero-action" href="{{ route('back.setting.email') }}" style="font-size: 13px; font-weight: 600; padding: 9px 16px; background: rgba(255,255,255,0.15); color: #ffffff; border: 1px solid rgba(255,255,255,0.25);">
                    <i class="fa-solid fa-arrow-left mr-1"></i> {{ __('Back to Templates') }}
                </a>
            </div>
        </div>
    </div>

    <!-- Form Row -->
    <div class="row">
        <!-- Shortcodes / Tags Sidebar -->
        <div class="col-xl-4 col-lg-5 col-12 mb-4">
            <div class="card-modern h-100">
                <div class="card-modern-body p-4">
                    <div class="settings-tab-pane-title mb-3 pb-2 border-bottom">
                        <i class="fa-solid fa-code text-primary mr-1"></i> {{ __('Dynamic Placeholders') }}
                    </div>
                    <p class="text-muted mb-3" style="font-size: 13px;">
                        {{ __('Copy and insert any placeholder tag into your email subject or body:') }}
                    </p>

                    <div class="table-responsive">
                        <table class="table table-sm table-borderless align-middle mb-0">
                            <tbody>
                                <tr>
                                    <td class="py-2">
                                        <code class="px-2 py-1 user-select-all" style="background: #eff6ff; color: #1d4ed8; border: 1px solid #bfdbfe; border-radius: 6px; font-size: 13px;">{user_name}</code>
                                    </td>
                                    <td class="py-2 text-muted" style="font-size: 13px;">{{ __('Customer Name') }}</td>
                                </tr>
                                <tr>
                                    <td class="py-2">
                                        <code class="px-2 py-1 user-select-all" style="background: #eff6ff; color: #1d4ed8; border: 1px solid #bfdbfe; border-radius: 6px; font-size: 13px;">{order_cost}</code>
                                    </td>
                                    <td class="py-2 text-muted" style="font-size: 13px;">{{ __('Order Total Cost') }}</td>
                                </tr>
                                <tr>
                                    <td class="py-2">
                                        <code class="px-2 py-1 user-select-all" style="background: #eff6ff; color: #1d4ed8; border: 1px solid #bfdbfe; border-radius: 6px; font-size: 13px;">{site_title}</code>
                                    </td>
                                    <td class="py-2 text-muted" style="font-size: 13px;">{{ __('Website Title') }}</td>
                                </tr>
                                <tr>
                                    <td class="py-2">
                                        <code class="px-2 py-1 user-select-all" style="background: #eff6ff; color: #1d4ed8; border: 1px solid #bfdbfe; border-radius: 6px; font-size: 13px;">{transaction_number}</code>
                                    </td>
                                    <td class="py-2 text-muted" style="font-size: 13px;">{{ __('Transaction ID') }}</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

        <!-- Template Editor Form -->
        <div class="col-xl-8 col-lg-7 col-12 mb-4">
            <div class="card-modern">
                <div class="card-modern-body p-4">
                    <div class="settings-tab-pane-title mb-4 pb-3 border-bottom d-flex align-items-center justify-content-between">
                        <div>
                            <i class="fa-solid fa-envelope-open-text text-primary mr-1"></i> {{ __('Template Content') }}
                        </div>
                        <span class="badge" style="background: #f1f5f9; color: #334155; border: 1px solid #cbd5e1; font-size: 12.5px; font-weight: 700; padding: 5px 12px; border-radius: 8px;">
                            {{ $template->type }}
                        </span>
                    </div>

                    @include('alerts.alerts')

                    <form class="admin-form" action="{{ route('back.template.update', $template->id) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')

                        <div class="settings-section-card mb-4">
                            <div class="form-group mb-3">
                                <label for="subject" class="form-label font-weight-bold">{{ __('Email Subject') }} *</label>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="fa-solid fa-heading"></i></span>
                                    </div>
                                    <input type="text" name="subject" class="form-control" id="subject" placeholder="{{ __('Enter Subject Line') }}" value="{{ $template->subject }}" required>
                                </div>
                            </div>

                            <div class="form-group mb-0">
                                <label for="body" class="form-label font-weight-bold">{{ __('Email Body Message') }} *</label>
                                <textarea name="body" id="body" class="form-control" rows="8" placeholder="{{ __('Enter Email Body Content...') }}" required>{{ $template->body }}</textarea>
                            </div>
                        </div>

                        <div class="d-flex justify-content-end mt-4">
                            <button type="submit" class="btn btn-primary px-4 py-2" style="border-radius: 10px; font-weight: 700; background: linear-gradient(135deg, #10b981, #059669); border: none; box-shadow: 0 4px 12px rgba(16, 185, 129, 0.3);">
                                <i class="fa-solid fa-floppy-disk mr-1"></i> {{ __('Update Template') }}
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

</div>

@endsection
