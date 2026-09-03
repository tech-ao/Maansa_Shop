@extends('master.back')

@section('content')

<div class="container-fluid">

	<!-- Page Header Banner -->
    <div class="dash-hero-banner mb-4">
        <div class="dash-hero-content">
            <div class="dash-hero-text">
                <h2><i class="fa-solid fa-user-pen mr-2" style="font-size: 22px;"></i> {{ __('Update Role') }}: {{ $role->name }}</h2>
                <p>{{ __('Update role details and adjust assigned module-level permissions.') }}</p>
            </div>
            <div class="dash-hero-actions">
                <a class="btn btn-hero-action btn-hero-primary" href="{{ route('back.role.index') }}" style="font-size: 13.5px; font-weight: 700; padding: 10px 20px;">
                    <i class="fa-solid fa-chevron-left mr-1"></i> {{ __('Back to Roles') }}
                </a>
            </div>
        </div>
    </div>

	<!-- Form Card -->
	<div class="row">
		<div class="col-lg-12">
			<div class="card-modern">
				<div class="card-modern-body">
					<form class="admin-form" action="{{ route('back.role.update', $role->id) }}" method="POST" enctype="multipart/form-data">
						@method('PUT')
                        @csrf
						@include('alerts.alerts')

						@php
							if($role->section && $role->section != 'null'){
								$section = json_decode($role->section, true) ?? [];
							} else {
								$section = [];
							}

                            $permissionGroups = [
                                'Orders & Catalog Management' => [
                                    ['key' => 'Manage Products', 'icon' => 'fa-boxes-stacked', 'desc' => 'Products inventory, variants & pricing'],
                                    ['key' => 'Manage Categories', 'icon' => 'fa-folder-tree', 'desc' => 'Categories, subcategories & hierarchy'],
                                    ['key' => 'Manage Orders', 'icon' => 'fa-bag-shopping', 'desc' => 'Order processing & tracking status'],
                                    ['key' => 'Ecommerce', 'icon' => 'fa-store', 'desc' => 'Coupons, shipping, tax & currency'],
                                    ['key' => 'Transactions', 'icon' => 'fa-money-bill-transfer', 'desc' => 'Payment history and transactions'],
                                ],
                                'Customers & Support Helpdesk' => [
                                    ['key' => 'Customer List', 'icon' => 'fa-users', 'desc' => 'Customer accounts and purchase history'],
                                    ['key' => 'Manages Tickets', 'icon' => 'fa-headset', 'desc' => 'Support queries and ticket responses'],
                                    ['key' => 'Subscribers List', 'icon' => 'fa-envelope-open-text', 'desc' => 'Newsletter subscribers and emails'],
                                ],
                                'Website & Content Customization' => [
                                    ['key' => 'Manage Site', 'icon' => 'fa-sliders', 'desc' => 'General site settings, sliders & banners'],
                                    ['key' => 'Manage Faqs Contents', 'icon' => 'fa-circle-question', 'desc' => 'FAQ entries and knowledgebase'],
                                    ['key' => 'Manage Blogs', 'icon' => 'fa-newspaper', 'desc' => 'Blog articles, categories & tags'],
                                    ['key' => 'Manages Pages', 'icon' => 'fa-file-lines', 'desc' => 'Custom pages and static content'],
                                ],
                                'System & Security Administration' => [
                                    ['key' => 'Manage System User', 'icon' => 'fa-user-shield', 'desc' => 'Staff users, assignments & roles'],
                                ],
                            ];
						@endphp

						<div class="form-group mb-4">
							<label for="name" class="form-label font-weight-bold">{{ __('Role Name') }} *</label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="fa-solid fa-shield"></i></span>
                                </div>
                                <input type="text" name="name" class="form-control" id="name"
                                    placeholder="{{ __('Enter Role Name') }}" value="{{ old('name', $role->name) }}" required>
                            </div>
						</div>

                        <!-- Permission Matrix Header -->
                        <div class="permission-matrix-header mt-4">
                            <div>
                                <h5 class="mb-0 font-weight-bold text-dark d-flex align-items-center">
                                    <i class="fa-solid fa-key text-primary mr-2"></i> {{ __('Assign Access Permissions') }}
                                </h5>
                                <small class="text-muted">{{ __('Toggle the modules and sections accessible by users with this role.') }}</small>
                            </div>
                            <div class="d-flex" style="gap: 8px;">
                                <button type="button" class="btn btn-outline-primary btn-sm font-weight-bold" id="btn-select-all">
                                    <i class="fa-solid fa-check-double mr-1"></i> {{ __('Select All') }}
                                </button>
                                <button type="button" class="btn btn-outline-secondary btn-sm font-weight-bold" id="btn-deselect-all">
                                    <i class="fa-solid fa-xmark mr-1"></i> {{ __('Deselect All') }}
                                </button>
                            </div>
                        </div>

                        @php $cardIndex = 0; @endphp
                        @foreach($permissionGroups as $groupTitle => $groupPerms)
                            <div class="perm-group-title">
                                <span>{{ __($groupTitle) }}</span>
                            </div>
                            <div class="row">
                                @foreach($groupPerms as $perm)
                                    @php $cardIndex++; @endphp
                                    <div class="col-xl-3 col-lg-4 col-md-6 col-sm-6 mb-3">
                                        <label class="perm-checkbox-card" for="perm_{{ $cardIndex }}">
                                            <div class="perm-card-content">
                                                <span class="perm-card-icon">
                                                    <i class="fa-solid {{ $perm['icon'] }}"></i>
                                                </span>
                                                <div class="perm-card-texts">
                                                    <h6 class="perm-card-label">{{ __($perm['key']) }}</h6>
                                                    <p class="perm-card-desc">{{ __($perm['desc']) }}</p>
                                                </div>
                                            </div>
                                            <input type="checkbox" name="section[]" value="{{ $perm['key'] }}" id="perm_{{ $cardIndex }}" class="perm-checkbox d-none" {{ in_array($perm['key'], $section) ? 'checked' : '' }}>
                                            <span class="perm-check-indicator">
                                                <i class="fa-solid fa-check"></i>
                                            </span>
                                        </label>
                                    </div>
                                @endforeach
                            </div>
                        @endforeach

						<div class="d-flex justify-content-end gap-2 mt-4 pt-3 border-top">
                            <a href="{{ route('back.role.index') }}" class="btn btn-secondary px-4 mr-2" style="border-radius: 10px; font-weight: 700;">{{ __('Cancel') }}</a>
							<button type="submit" class="btn btn-primary px-4" style="border-radius: 10px; font-weight: 700; background: linear-gradient(135deg, #10b981, #059669); border: none; box-shadow: 0 4px 12px rgba(16, 185, 129, 0.3);">
                                <i class="fa-solid fa-floppy-disk mr-1"></i> {{ __('Update Role') }}
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
        // Toggle card active state based on checkbox checked
        function updateCardStyles() {
            $('.perm-checkbox').each(function() {
                if ($(this).is(':checked')) {
                    $(this).closest('.perm-checkbox-card').addClass('active');
                } else {
                    $(this).closest('.perm-checkbox-card').removeClass('active');
                }
            });
        }

        updateCardStyles();

        $(document).on('change', '.perm-checkbox', function() {
            updateCardStyles();
        });

        $('#btn-select-all').on('click', function(e) {
            e.preventDefault();
            $('.perm-checkbox').prop('checked', true);
            updateCardStyles();
        });

        $('#btn-deselect-all').on('click', function(e) {
            e.preventDefault();
            $('.perm-checkbox').prop('checked', false);
            updateCardStyles();
        });
    });
</script>
@endpush

@endsection
