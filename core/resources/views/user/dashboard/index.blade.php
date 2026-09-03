@extends('master.front')
@section('title')
    {{__('Profile Settings')}}
@endsection
@section('content')

<!-- Page Title-->
<div class="page-title">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <ul class="breadcrumbs">
                    <li><a href="{{ route('front.index')}}">{{__('Home')}}</a> </li>
                    <li class="separator"></li>
                    <li>{{__('My Account')}}</li>
                    <li class="separator"></li>
                    <li>{{__('Profile Settings')}}</li>
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

            <div class="card modern-profile-card border-0 shadow-sm rounded-4">
                <!-- Card Header -->
                <div class="profile-card-header px-4 py-3 border-bottom d-flex align-items-center justify-content-between">
                    <div>
                        <h4 class="profile-card-title mb-1">
                            <i class="icon-user text-success mr-2"></i>{{ __('Personal Information') }}
                        </h4>
                        <p class="profile-card-subtitle mb-0 text-muted small">
                            {{ __('Update your photo, personal details, contact info, and account password.') }}
                        </p>
                    </div>
                </div>

                <!-- Card Body Form -->
                <div class="card-body p-4">
                    <form action="{{ route('user.profile.update') }}" method="POST" enctype="multipart/form-data" id="profileUpdateForm">
                        @csrf

                        <!-- Avatar Upload Section -->
                        <div class="avatar-upload-wrapper mb-4 p-3 bg-light rounded-3 d-flex align-items-center flex-wrap gap-3">
                            <div class="profile-avatar-preview">
                                <img id="profile_photo_preview" src="{{ $user->photo_url }}" alt="{{ $user->displayName() }}">
                            </div>
                            <div class="avatar-upload-info flex-grow-1">
                                <h6 class="mb-1 text-dark fw-bold fs-6">{{ __('Profile Photo') }}</h6>
                                <p class="text-muted small mb-2">{{ __('Recommended: Square JPG, PNG or WebP. Max 5MB.') }}</p>
                                <div class="d-flex align-items-center gap-2">
                                    <label for="avater" class="btn btn-sm btn-outline-success rounded-pill px-3 mb-0 cursor-pointer">
                                        <i class="icon-camera mr-1"></i> {{ __('Choose New Photo') }}
                                    </label>
                                    <input type="file" name="photo" id="avater" class="d-none" accept="image/*" onchange="previewProfilePhoto(this)">
                                    <span id="file_name_display" class="small text-muted text-truncate" style="max-width: 180px;"></span>
                                </div>
                                @error('photo')
                                    <p class="text-danger small mt-1 mb-0">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>

                        <!-- Form Fields Grid -->
                        <div class="row g-3">
                            <!-- First Name -->
                            <div class="col-md-6 mb-3">
                                <div class="form-group custom-form-group">
                                    <label for="account-fn" class="form-label-custom">{{ __('First Name') }} <span class="text-danger">*</span></label>
                                    <div class="input-icon-wrapper">
                                        <i class="icon-user input-icon"></i>
                                        <input class="form-control custom-input" name="first_name" type="text" id="account-fn" value="{{ $user->first_name }}" required placeholder="{{ __('Enter first name') }}">
                                    </div>
                                    @error('first_name')
                                        <p class="text-danger small mt-1 mb-0">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>

                            <!-- Last Name -->
                            <div class="col-md-6 mb-3">
                                <div class="form-group custom-form-group">
                                    <label for="account-ln" class="form-label-custom">{{ __('Last Name') }} <span class="text-danger">*</span></label>
                                    <div class="input-icon-wrapper">
                                        <i class="icon-user input-icon"></i>
                                        <input class="form-control custom-input" name="last_name" type="text" id="account-ln" value="{{ $user->last_name }}" required placeholder="{{ __('Enter last name') }}">
                                    </div>
                                    @error('last_name')
                                        <p class="text-danger small mt-1 mb-0">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>

                            <!-- Email Address -->
                            <div class="col-md-6 mb-3">
                                <div class="form-group custom-form-group">
                                    <label for="account-email" class="form-label-custom">{{ __('Email Address') }} <span class="text-danger">*</span></label>
                                    <div class="input-icon-wrapper">
                                        <i class="icon-mail input-icon"></i>
                                        <input class="form-control custom-input" name="email" type="email" id="account-email" value="{{ $user->email }}" required placeholder="{{ __('Enter email address') }}">
                                    </div>
                                    @error('email')
                                        <p class="text-danger small mt-1 mb-0">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>

                            <!-- Phone Number -->
                            <div class="col-md-6 mb-3">
                                <div class="form-group custom-form-group">
                                    <label for="account-phone" class="form-label-custom">{{ __('Phone Number') }} <span class="text-danger">*</span></label>
                                    <div class="input-icon-wrapper">
                                        <i class="icon-phone input-icon"></i>
                                        <input class="form-control custom-input" name="phone" type="text" id="account-phone" value="{{ $user->phone }}" required placeholder="{{ __('Enter phone number') }}">
                                    </div>
                                    @error('phone')
                                        <p class="text-danger small mt-1 mb-0">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>

                            <!-- New Password -->
                            <div class="col-12 mb-3">
                                <div class="form-group custom-form-group">
                                    <label for="account-pass" class="form-label-custom">{{ __('Change Password') }} <span class="text-muted fw-normal">({{ __('Optional') }})</span></label>
                                    <div class="input-icon-wrapper position-relative">
                                        <i class="icon-lock input-icon"></i>
                                        <input class="form-control custom-input pr-5" name="password" type="password" id="account-pass" placeholder="{{ __('Leave blank to keep your current password') }}">
                                        <button type="button" class="btn-toggle-password" onclick="togglePasswordVisibility('account-pass', this)" aria-label="Toggle password visibility">
                                            <i class="icon-eye"></i>
                                        </button>
                                    </div>
                                    @error('password')
                                        <p class="text-danger small mt-1 mb-0">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <!-- Newsletter & Save Button -->
                        <div class="mt-4 pt-3 border-top d-flex flex-wrap justify-content-between align-items-center gap-3">
                            <div class="custom-control custom-checkbox custom-switch-wrapper">
                                <input class="custom-control-input" name="newsletter" type="checkbox" id="subscribe_me" {{ $check_newsletter ? 'checked' : '' }}>
                                <label class="custom-control-label fw-semibold text-dark" for="subscribe_me">
                                    {{ __('Subscribe to Email Newsletter') }}
                                    <span class="d-block text-muted small fw-normal">{{ __('Get updates on new collections, exclusive discounts & offers.') }}</span>
                                </label>
                            </div>

                            <button class="btn btn-save-profile px-4 py-2" type="submit">
                                <i class="icon-check mr-2"></i> <span>{{ __('Save Changes') }}</span>
                            </button>
                        </div>
                    </form>
                </div>
            </div>

        </div>
    </div>
</div>

<style>
/* Modern Profile Settings Styles */
.modern-profile-card {
    background: #ffffff !important;
    border-radius: 18px !important;
    overflow: hidden !important;
    border: 1px solid #e2e8f0 !important;
    box-shadow: 0 4px 20px rgba(0, 0, 0, 0.05) !important;
}

.profile-card-header {
    background: #f8fafc !important;
}

.profile-card-title {
    font-size: 18px !important;
    font-weight: 700 !important;
    color: #0f172a !important;
}

.avatar-upload-wrapper {
    background: #f8fafc !important;
    border: 1px solid #e2e8f0 !important;
    border-radius: 14px !important;
}

.profile-avatar-preview {
    width: 80px !important;
    height: 80px !important;
    min-width: 80px !important;
    border-radius: 50% !important;
    overflow: hidden !important;
    border: 3px solid #059669 !important;
    box-shadow: 0 4px 12px rgba(5, 150, 105, 0.2) !important;
    background: #ffffff !important;
}

.profile-avatar-preview img {
    width: 100% !important;
    height: 100% !important;
    object-fit: cover !important;
    display: block !important;
}

.cursor-pointer {
    cursor: pointer !important;
}

.form-label-custom {
    font-size: 13px !important;
    font-weight: 600 !important;
    color: #334155 !important;
    margin-bottom: 6px !important;
    display: block !important;
}

.input-icon-wrapper {
    position: relative !important;
    display: flex !important;
    align-items: center !important;
}

.input-icon-wrapper .input-icon {
    position: absolute !important;
    left: 14px !important;
    color: #94a3b8 !important;
    font-size: 16px !important;
    pointer-events: none !important;
    z-index: 2 !important;
}

.custom-input {
    width: 100% !important;
    padding: 11px 16px 11px 40px !important;
    font-size: 14px !important;
    border-radius: 12px !important;
    border: 1px solid #cbd5e1 !important;
    background: #ffffff !important;
    color: #0f172a !important;
    transition: all 0.2s ease !important;
    height: auto !important;
}

.custom-input:focus {
    border-color: #059669 !important;
    box-shadow: 0 0 0 3px rgba(5, 150, 105, 0.15) !important;
    outline: none !important;
    background: #ffffff !important;
}

.btn-toggle-password {
    position: absolute !important;
    right: 12px !important;
    background: transparent !important;
    border: none !important;
    color: #94a3b8 !important;
    padding: 6px !important;
    font-size: 16px !important;
    cursor: pointer !important;
    z-index: 3 !important;
    transition: color 0.2s ease !important;
}

.btn-toggle-password:hover {
    color: #0f172a !important;
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
    transition: all 0.25s cubic-bezier(0.16, 1, 0.3, 1) !important;
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

/* Mobile Responsiveness */
@media (max-width: 767px) {
    .modern-profile-card {
        border-radius: 14px !important;
    }
    .profile-card-header {
        padding: 14px 16px !important;
    }
    .profile-card-title {
        font-size: 16px !important;
    }
    .modern-profile-card .card-body {
        padding: 16px !important;
    }
    .avatar-upload-wrapper {
        padding: 12px !important;
        gap: 12px !important;
    }
    .profile-avatar-preview {
        width: 68px !important;
        height: 68px !important;
        min-width: 68px !important;
    }
    .custom-input {
        padding: 10px 14px 10px 38px !important;
        font-size: 13.5px !important;
    }
    .btn-save-profile {
        width: 100% !important;
        padding: 12px !important;
    }
}
</style>

<script>
function previewProfilePhoto(input) {
    if (input.files && input.files[0]) {
        var reader = new FileReader();
        reader.onload = function(e) {
            var preview = document.getElementById('profile_photo_preview');
            if (preview) {
                preview.src = e.target.result;
            }
            var sideAvatar = document.getElementById('avater_photo_view');
            if (sideAvatar) {
                sideAvatar.src = e.target.result;
            }
        };
        reader.readAsDataURL(input.files[0]);

        var nameDisplay = document.getElementById('file_name_display');
        if (nameDisplay) {
            nameDisplay.textContent = input.files[0].name;
        }
    }
}

function togglePasswordVisibility(inputId, btn) {
    var input = document.getElementById(inputId);
    var icon = btn.querySelector('i');
    if (input) {
        if (input.type === 'password') {
            input.type = 'text';
            if (icon) {
                icon.className = 'icon-eye-off';
            }
        } else {
            input.type = 'password';
            if (icon) {
                icon.className = 'icon-eye';
            }
        }
    }
}
</script>
@endsection

