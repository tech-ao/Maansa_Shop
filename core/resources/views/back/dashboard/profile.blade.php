@extends('master.back')

@section('content')
<div class="container-fluid">

    <!-- Page Header -->
    <div class="profile-header-card">
        <div class="profile-header-content">
            <div class="profile-title-group">
                <h3><i class="fa-solid fa-user-gear text-primary"></i> {{ __('Admin Profile Settings') }}</h3>
                <p>{{ __('Manage and update your personal account information and profile image.') }}</p>
            </div>
            <ul class="profile-breadcrumb">
                <li><a href="{{ route('back.dashboard') }}"><i class="fa-solid fa-house"></i> {{ __('Dashboard') }}</a></li>
                <span class="divider">/</span>
                <li class="active">{{ __('Profile') }}</li>
            </ul>
        </div>
    </div>

    @include('alerts.alerts')

    <form class="admin-form" action="{{ route('back.profile.update') }}" method="POST" enctype="multipart/form-data" id="profileUpdateForm">
        @csrf

        <div class="row">
            <!-- Left Column: Avatar & Overview -->
            <div class="col-xl-4 col-lg-5 mb-4">
                <div class="profile-box-card">
                    <div class="profile-box-header">
                        <h4><i class="fa-solid fa-camera text-primary"></i> {{ __('Profile Picture') }}</h4>
                    </div>
                    <div class="profile-box-body">
                        <div class="avatar-preview-wrapper">
                            <div class="avatar-preview-container">
                                <img class="avatar-preview-img" id="avatarPreview"
                                    src="{{ $data->photo ? url('/core/public/storage/images/'.$data->photo) : url('/core/public/storage/images/placeholder.png') }}"
                                    onerror="this.onerror=null; this.src='{{ url('/core/public/storage/images/placeholder.png') }}';"
                                    alt="{{ $data->name }}">
                                
                                <label for="profilePhotoInput" class="avatar-upload-trigger" title="{{ __('Click to change avatar') }}">
                                    <i class="fa-solid fa-camera"></i>
                                </label>
                            </div>

                            <input type="file" accept="image/*" name="photo" id="profilePhotoInput" style="display: none;">
                            
                            <label for="profilePhotoInput" class="avatar-upload-btn-label">
                                <i class="fa-solid fa-arrow-up-from-bracket"></i>
                                <span>{{ __('Upload New Photo') }}</span>
                            </label>
                            
                            <span class="avatar-specs-hint">{{ __('Recommended: Square JPG or PNG (min 300x300)') }}</span>

                            <div class="admin-badge-summary">
                                <h5 style="font-size: 16px; font-weight: 800; color: #0f172a; margin-bottom: 2px;">{{ $data->name }}</h5>
                                <p style="font-size: 13px; color: #64748b; margin-bottom: 6px;">{{ $data->email }}</p>
                                <span class="admin-role-pill">
                                    <i class="fa-solid fa-shield-halved"></i>
                                    {{ $data->role_id == 0 ? __('Super Administrator') : __('Staff Admin') }}
                                </span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Right Column: Account Information Form -->
            <div class="col-xl-8 col-lg-7 mb-4">
                <div class="profile-box-card">
                    <div class="profile-box-header">
                        <h4><i class="fa-solid fa-id-card text-primary"></i> {{ __('Account Information') }}</h4>
                    </div>
                    <div class="profile-box-body">

                        <div class="modern-form-group">
                            <label for="name">{{ __('Full Name') }} <span class="required-asterisk">*</span></label>
                            <div class="modern-input-box">
                                <i class="fa-regular fa-user input-icon-prefix"></i>
                                <input type="text" name="name" id="name" placeholder="{{ __('Enter your full name') }}" value="{{ old('name', $data->name) }}" required>
                            </div>
                        </div>

                        <div class="modern-form-group">
                            <label for="email">{{ __('Email Address') }} <span class="required-asterisk">*</span></label>
                            <div class="modern-input-box">
                                <i class="fa-regular fa-envelope input-icon-prefix"></i>
                                <input type="email" name="email" id="email" placeholder="{{ __('admin@example.com') }}" value="{{ old('email', $data->email) }}" required>
                            </div>
                        </div>

                        <div class="modern-form-group">
                            <label for="phone">{{ __('Phone Number') }} <span class="required-asterisk">*</span></label>
                            <div class="modern-input-box">
                                <i class="fa-solid fa-phone input-icon-prefix"></i>
                                <input type="text" name="phone" id="phone" placeholder="{{ __('e.g. +1 234 567 8900') }}" value="{{ old('phone', $data->phone) }}" required>
                            </div>
                        </div>

                        <hr style="margin: 28px 0; border: 0; border-top: 1px solid #f1f5f9;">

                        <div class="d-flex align-items-center justify-content-between flex-wrap gap-2">
                            <button type="submit" class="btn-save-profile" style="color: #ffffff !important;">
                                <i class="fa-solid fa-floppy-disk" style="color: #ffffff !important;"></i>
                                <span style="color: #ffffff !important;">{{ __('Save Profile Changes') }}</span>
                            </button>
                            <a href="{{ route('back.password') }}" class="btn btn-outline-secondary btn-round btn-sm">
                                <i class="fa-solid fa-key mr-1"></i> {{ __('Change Password') }}
                            </a>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </form>

</div>
@endsection

@section('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const photoInput = document.getElementById('profilePhotoInput');
        const avatarPreview = document.getElementById('avatarPreview');

        if (photoInput && avatarPreview) {
            photoInput.addEventListener('change', function(e) {
                const file = e.target.files[0];
                if (file) {
                    const reader = new FileReader();
                    reader.onload = function(event) {
                        avatarPreview.src = event.target.result;
                    };
                    reader.readAsDataURL(file);
                }
            });
        }
    });
</script>
@endsection
