@extends('master.back')

@section('content')

<div class="container-fluid">

	<!-- Page Header Banner -->
    <div class="dash-hero-banner mb-4">
        <div class="dash-hero-content">
            <div class="dash-hero-text">
                <h2><i class="fa-solid fa-user-pen mr-2" style="font-size: 22px;"></i> {{ __('Update System User') }}</h2>
                <p>{{ __('Update staff account details, contact info, login credentials, or assigned role.') }}</p>
            </div>
            <div class="dash-hero-actions">
                <a class="btn btn-hero-action btn-hero-primary" href="{{ route('back.staff.index') }}" style="font-size: 13.5px; font-weight: 700; padding: 10px 20px;">
                    <i class="fa-solid fa-chevron-left mr-1"></i> {{ __('Back to Users') }}
                </a>
            </div>
        </div>
    </div>

	<!-- Form Card -->
	<div class="row">
		<div class="col-lg-12">
			<div class="card-modern">
				<div class="card-modern-body">
					<form class="admin-form" action="{{ route('back.staff.update', $admin->id) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
						@include('alerts.alerts')

                        <!-- Photo Upload Section -->
                        <div class="staff-avatar-upload-wrap">
                            <img class="staff-preview-img"
                            src="{{ $admin->photo ? url('/core/public/storage/images/' . $admin->photo) : url('/core/public/storage/images/placeholder.png') }}"
                            id="avatar-preview"
                            onerror="this.onerror=null; this.src='{{ url('/core/public/storage/images/placeholder.png') }}';"
                            alt="{{ $admin->name }}">
                            <div>
                                <h6 class="font-weight-bold text-dark mb-1">{{ __('Profile Avatar') }}</h6>
                                <p class="text-muted small mb-2">{{ __('Recommended image dimensions: 200 x 200 px (Square JPG/PNG).') }}</p>
                                <label class="btn btn-outline-primary btn-sm mb-0 cursor-pointer" style="border-radius: 8px; font-weight: 600;">
                                    <i class="fas fa-camera mr-1"></i> {{ __('Change Photo') }}
                                    <input type="file" accept="image/*" class="upload-photo d-none" name="photo" id="staff-photo-input">
                                </label>
                            </div>
                        </div>

                        <div class="row">
                            <!-- User Name -->
                            <div class="col-md-6 mb-3">
                                <label for="name" class="form-label font-weight-bold">{{ __('User Name') }} *</label>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text bg-light"><i class="fa-solid fa-user text-muted"></i></span>
                                    </div>
                                    <input type="text" name="name" class="form-control" id="name"
                                        placeholder="{{ __('Enter Full Name') }}" value="{{ old('name', $admin->name) }}" required>
                                </div>
                            </div>

                            <!-- Email Address -->
                            <div class="col-md-6 mb-3">
                                <label for="email" class="form-label font-weight-bold">{{ __('Email Address') }} *</label>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text bg-light"><i class="fa-solid fa-envelope text-muted"></i></span>
                                    </div>
                                    <input type="email" name="email" class="form-control" id="email"
                                        placeholder="{{ __('Enter Email Address') }}" value="{{ old('email', $admin->email) }}" required>
                                </div>
                            </div>

                            <!-- Phone Number -->
                            <div class="col-md-6 mb-3">
                                <label for="phone" class="form-label font-weight-bold">{{ __('Phone Number') }} *</label>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text bg-light"><i class="fa-solid fa-phone text-muted"></i></span>
                                    </div>
                                    <input type="text" name="phone" class="form-control" id="phone"
                                        placeholder="{{ __('Enter Phone Number') }}" value="{{ old('phone', $admin->phone) }}" required>
                                </div>
                            </div>

                            <!-- Password -->
                            <div class="col-md-6 mb-3">
                                <label for="password" class="form-label font-weight-bold">{{ __('Password') }}</label>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text bg-light"><i class="fa-solid fa-lock text-muted"></i></span>
                                    </div>
                                    <input type="password" name="password" class="form-control" id="password"
                                        placeholder="{{ __('Leave blank to keep existing password') }}">
                                </div>
                            </div>

                            <!-- Role Selector -->
                            <div class="col-md-12 mb-3">
                                <label for="role_id" class="form-label font-weight-bold">{{ __('Select Role') }} *</label>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text bg-light"><i class="fa-solid fa-shield-halved text-muted"></i></span>
                                    </div>
                                    <select name="role_id" id="role_id" class="form-control" required>
                                        @foreach(DB::table('roles')->get() as $role)
                                            <option value="{{ $role->id }}" {{ (old('role_id', $admin->role_id) == $role->id) ? 'selected' : '' }}>
                                                {{ $role->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>

                        <div class="d-flex justify-content-end gap-2 mt-4 pt-3 border-top">
                            <a href="{{ route('back.staff.index') }}" class="btn btn-secondary px-4 mr-2" style="border-radius: 10px; font-weight: 700;">{{ __('Cancel') }}</a>
                            <button type="submit" class="btn btn-primary px-4" style="border-radius: 10px; font-weight: 700; background: linear-gradient(135deg, #4f46e5, #3b82f6); border: none; box-shadow: 0 4px 12px rgba(79, 70, 229, 0.3);">
                                <i class="fa-solid fa-floppy-disk mr-1"></i> {{ __('Update User') }}
                            </button>
                        </div>

					</form>
				</div>
			</div>
		</div>
	</div>

</div>

@push('scripts')
<script>
    $(document).ready(function() {
        $('#staff-photo-input').on('change', function(e) {
            const file = e.target.files[0];
            if (file) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    $('#avatar-preview').attr('src', e.target.result);
                }
                reader.readAsDataURL(file);
            }
        });
    });
</script>
@endpush

@endsection
