@extends('master.back')

@section('content')

<div class="container-fluid">

    <!-- Page Header Banner -->
    <div class="dash-hero-banner mb-4">
        <div class="dash-hero-content">
            <div class="dash-hero-text">
                <h2><i class="fa-solid fa-share-nodes mr-2" style="font-size: 22px;"></i> {{ __('Social Login Integration') }}</h2>
                <p>{{ __('Configure third-party OAuth social authentication for Facebook and Google customer sign-ins.') }}</p>
                <ul class="profile-breadcrumb mt-2">
                    <li><a href="{{ route('back.dashboard') }}"><i class="fa-solid fa-house"></i> {{ __('Dashboard') }}</a></li>
                    <span class="divider">/</span>
                    <li><a href="{{ route('back.setting.system') }}">{{ __('Settings') }}</a></li>
                    <span class="divider">/</span>
                    <li class="active">{{ __('Social Login') }}</li>
                </ul>
            </div>
        </div>
    </div>

    <!-- Form Row -->
    <div class="row">
        <!-- Navigation Tabs Column -->
        <div class="col-xl-3 col-lg-4 col-12 mb-3 mb-lg-0">
            <div class="nav settings-nav-pills" id="v-pills-tab" role="tablist" aria-orientation="vertical">
                <a class="nav-link active" data-toggle="pill" href="#facebook" role="tab" aria-selected="true">
                    <i class="fa-brands fa-facebook-f text-primary"></i>
                    <span>{{ __('Facebook Login') }}</span>
                </a>
                <a class="nav-link" data-toggle="pill" href="#google" role="tab" aria-selected="false">
                    <i class="fa-brands fa-google text-danger"></i>
                    <span>{{ __('Google Login') }}</span>
                </a>
            </div>
        </div>

        <!-- Content Panes Column -->
        <div class="col-xl-9 col-lg-8 col-12 mb-4">
            <div class="card-modern">
                <div class="card-modern-body p-4">
                    @include('alerts.alerts')

                    <form class="admin-form" action="{{ route('back.setting.update') }}" method="POST" enctype="multipart/form-data">
                        @csrf

                        <div class="tab-content" id="socialTabContent">

                            <!-- Facebook Tab -->
                            <div id="facebook" class="tab-pane fade show active" role="tabpanel">
                                <div class="settings-tab-pane-title mb-4 pb-3 border-bottom d-flex align-items-center justify-content-between">
                                    <div>
                                        <i class="fa-brands fa-facebook-f text-primary mr-2" style="font-size: 18px;"></i>
                                        <span>{{ __('Facebook OAuth Credentials') }}</span>
                                    </div>
                                    <span class="badge" style="background: #eff6ff; color: #1d4ed8; border: 1px solid #bfdbfe; font-size: 12px; font-weight: 600; padding: 5px 12px; border-radius: 999px;">
                                        <i class="fa-solid fa-shield-halved mr-1"></i> {{ __('OAuth 2.0') }}
                                    </span>
                                </div>

                                <!-- Status Toggle -->
                                <div class="settings-section-card mb-4">
                                    <div class="d-flex align-items-center justify-content-between">
                                        <div>
                                            <h6 class="section-card-title mb-1">
                                                <i class="fa-solid fa-power-off text-primary mr-1"></i> {{ __('Enable Facebook Login') }}
                                            </h6>
                                            <span class="text-muted" style="font-size: 13px;">{{ __('Allow customers to quickly register and log in using their Facebook account.') }}</span>
                                        </div>
                                        <div>
                                            <label class="switch-primary mb-0">
                                                <input type="checkbox" class="switch switch-bootstrap status radio-check" name="facebook_check" value="1" {{ $setting->facebook_check == 1 ? 'checked' : '' }}>
                                                <span class="switch-body"></span>
                                            </label>
                                        </div>
                                    </div>
                                </div>

                                <!-- Credentials Container -->
                                <div class="radio-show {{ $setting->facebook_check == 0 ? 'd-none' : '' }}">
                                    <div class="settings-section-card mb-4">
                                        <h6 class="section-card-title mb-3">
                                            <i class="fa-solid fa-key text-primary mr-1"></i> {{ __('API Credentials & Redirect URI') }}
                                        </h6>

                                        <div class="alert alert-info py-2 px-3 mb-4" style="border-radius: 10px; font-size: 13px; border: 1px solid #bae6fd; background: #f0f9ff; color: #0369a1;">
                                            <i class="fa-solid fa-circle-info mr-1"></i>
                                            {{ __('Create a Facebook App in') }} <a href="https://developers.facebook.com" target="_blank" class="font-weight-bold text-primary" style="text-decoration: underline;">developers.facebook.com</a> {{ __('and add Facebook Login product.') }}
                                        </div>

                                        <div class="form-group mb-3">
                                            <label for="facebook_client_id" class="form-label font-weight-bold">{{ __('App ID') }} *</label>
                                            <div class="input-group">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text"><i class="fa-solid fa-id-card"></i></span>
                                                </div>
                                                <input type="text" class="form-control" id="facebook_client_id" name="facebook_client_id" placeholder="{{ __('e.g. 643929170080071') }}" value="{{ $setting->facebook_client_id }}">
                                            </div>
                                        </div>

                                        <div class="form-group mb-3">
                                            <label for="facebook_client_secret" class="form-label font-weight-bold">{{ __('App Secret') }} *</label>
                                            <div class="input-group">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text"><i class="fa-solid fa-lock"></i></span>
                                                </div>
                                                <input type="text" class="form-control" id="facebook_client_secret" name="facebook_client_secret" placeholder="{{ __('e.g. 038b2100dff9a2a684c85959c0accf66') }}" value="{{ $setting->facebook_client_secret }}">
                                            </div>
                                        </div>

                                        <div class="form-group mb-0">
                                            <label for="facebook_redirect" class="form-label font-weight-bold">{{ __('Valid OAuth Redirect URI') }}</label>
                                            <div class="input-group">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text"><i class="fa-solid fa-link"></i></span>
                                                </div>
                                                <input type="text" class="form-control font-monospace" id="facebook_redirect" name="facebook_redirect" value="{{ $facebook_url }}" readonly style="background: #f8fafc; font-size: 13px;">
                                                <div class="input-group-append">
                                                    <button class="btn btn-outline-secondary copy-btn" type="button" onclick="copyToClipboard('{{ $facebook_url }}', this)" title="{{ __('Copy to clipboard') }}">
                                                        <i class="fa-regular fa-copy"></i>
                                                    </button>
                                                </div>
                                            </div>
                                            <small class="text-muted mt-1 d-block" style="font-size: 12px;">
                                                <i class="fa-solid fa-circle-info text-primary mr-1"></i> {{ __('Paste this URL into "Valid OAuth Redirect URIs" under Facebook Login Settings.') }}
                                            </small>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Google Tab -->
                            <div id="google" class="tab-pane fade" role="tabpanel">
                                <div class="settings-tab-pane-title mb-4 pb-3 border-bottom d-flex align-items-center justify-content-between">
                                    <div>
                                        <i class="fa-brands fa-google text-danger mr-2" style="font-size: 18px;"></i>
                                        <span>{{ __('Google OAuth Credentials') }}</span>
                                    </div>
                                    <span class="badge" style="background: #fef2f2; color: #b91c1c; border: 1px solid #fecaca; font-size: 12px; font-weight: 600; padding: 5px 12px; border-radius: 999px;">
                                        <i class="fa-solid fa-shield-halved mr-1"></i> {{ __('OAuth 2.0') }}
                                    </span>
                                </div>

                                <!-- Status Toggle -->
                                <div class="settings-section-card mb-4">
                                    <div class="d-flex align-items-center justify-content-between">
                                        <div>
                                            <h6 class="section-card-title mb-1">
                                                <i class="fa-solid fa-power-off text-primary mr-1"></i> {{ __('Enable Google Login') }}
                                            </h6>
                                            <span class="text-muted" style="font-size: 13px;">{{ __('Allow customers to seamlessly sign in with their Google accounts.') }}</span>
                                        </div>
                                        <div>
                                            <label class="switch-primary mb-0">
                                                <input type="checkbox" class="switch switch-bootstrap status radio-check" name="google_check" value="1" {{ $setting->google_check == 1 ? 'checked' : '' }}>
                                                <span class="switch-body"></span>
                                            </label>
                                        </div>
                                    </div>
                                </div>

                                <!-- Credentials Container -->
                                <div class="radio-show {{ $setting->google_check == 0 ? 'd-none' : '' }}">
                                    <div class="settings-section-card mb-4">
                                        <h6 class="section-card-title mb-3">
                                            <i class="fa-solid fa-key text-primary mr-1"></i> {{ __('API Credentials & Redirect URI') }}
                                        </h6>

                                        <div class="alert alert-info py-2 px-3 mb-4" style="border-radius: 10px; font-size: 13px; border: 1px solid #bae6fd; background: #f0f9ff; color: #0369a1;">
                                            <i class="fa-solid fa-circle-info mr-1"></i>
                                            {{ __('Create an OAuth 2.0 Client ID in') }} <a href="https://console.cloud.google.com" target="_blank" class="font-weight-bold text-primary" style="text-decoration: underline;">console.cloud.google.com</a> {{ __('APIs & Services > Credentials.') }}
                                        </div>

                                        <div class="form-group mb-3">
                                            <label for="google_client_id" class="form-label font-weight-bold">{{ __('Client ID') }} *</label>
                                            <div class="input-group">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text"><i class="fa-solid fa-id-card"></i></span>
                                                </div>
                                                <input type="text" class="form-control" id="google_client_id" name="google_client_id" placeholder="{{ __('Enter Client ID') }}" value="{{ $setting->google_client_id }}">
                                            </div>
                                        </div>

                                        <div class="form-group mb-3">
                                            <label for="google_client_secret" class="form-label font-weight-bold">{{ __('Client Secret') }} *</label>
                                            <div class="input-group">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text"><i class="fa-solid fa-lock"></i></span>
                                                </div>
                                                <input type="text" class="form-control" id="google_client_secret" name="google_client_secret" placeholder="{{ __('Enter Client Secret') }}" value="{{ $setting->google_client_secret }}">
                                            </div>
                                        </div>

                                        <div class="form-group mb-0">
                                            <label for="google_redirect" class="form-label font-weight-bold">{{ __('Authorized Redirect URI') }}</label>
                                            <div class="input-group">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text"><i class="fa-solid fa-link"></i></span>
                                                </div>
                                                <input type="text" class="form-control font-monospace" id="google_redirect" name="google_redirect" value="{{ $google_url }}" readonly style="background: #f8fafc; font-size: 13px;">
                                                <div class="input-group-append">
                                                    <button class="btn btn-outline-secondary copy-btn" type="button" onclick="copyToClipboard('{{ $google_url }}', this)" title="{{ __('Copy to clipboard') }}">
                                                        <i class="fa-regular fa-copy"></i>
                                                    </button>
                                                </div>
                                            </div>
                                            <small class="text-muted mt-1 d-block" style="font-size: 12px;">
                                                <i class="fa-solid fa-circle-info text-primary mr-1"></i> {{ __('Paste this URL into "Authorized redirect URIs" in your Google Cloud Console.') }}
                                            </small>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>

                        <div class="d-flex justify-content-end mt-4">
                            <button type="submit" class="btn btn-primary px-4 py-2" style="border-radius: 10px; font-weight: 700; background: linear-gradient(135deg, #10b981, #059669); border: none; box-shadow: 0 4px 12px rgba(16, 185, 129, 0.3);">
                                <i class="fa-solid fa-floppy-disk mr-1"></i> {{ __('Save Changes') }}
                            </button>
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </div>

</div>

<script>
function copyToClipboard(text, btn) {
    if (navigator.clipboard && window.isSecureContext) {
        navigator.clipboard.writeText(text);
    } else {
        var textArea = document.createElement("textarea");
        textArea.value = text;
        textArea.style.position = "fixed";
        textArea.style.left = "-999999px";
        textArea.style.top = "-999999px";
        document.body.appendChild(textArea);
        textArea.focus();
        textArea.select();
        document.execCommand('copy');
        textArea.remove();
    }
    var origHTML = btn.innerHTML;
    btn.innerHTML = '<i class="fa-solid fa-check text-success"></i>';
    setTimeout(function() {
        btn.innerHTML = origHTML;
    }, 2000);
}
</script>

@endsection
