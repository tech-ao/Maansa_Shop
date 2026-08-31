@extends('master.back')

@section('content')

<div class="container-fluid">

	<!-- Page Header Banner -->
    <div class="dash-hero-banner mb-4">
        <div class="dash-hero-content">
            <div class="dash-hero-text">
                <h2><i class="fa-solid fa-boxes-stacked mr-2" style="font-size: 22px;"></i> {{ __('Select Product Type') }}</h2>
                <p>{{ __('Choose the format of the product you want to create to configure attributes, media, files, and pricing.') }}</p>
            </div>
            <div class="dash-hero-actions">
                <a class="btn btn-hero-action btn-hero-primary" href="{{ route('back.item.index') }}" style="font-size: 13.5px; font-weight: 700; padding: 10px 20px;">
                    <i class="fa-solid fa-list mr-1"></i> {{ __('All Products') }}
                </a>
            </div>
        </div>
    </div>

	<!-- Form / Selection Cards -->
	@if(session()->has('multipledomain'))
	<div class="alert alert-danger" style="background-color: #FFE4E4;" id="license_alert">
		<strong>One Purchase Code Use in multiple domain :</strong>
		@foreach (session()->get('multipledomain') as $item)
			<p style="margin-bottom: 0px;color: #155724;">{{ $item }}</p>
		@endforeach
		<hr>
		<strong>
			{{ __('Envato not allow to install script multiple domin using one purchase code.') }}
			<br>
			{{ __('One purched codes for one Domin. Author can take action any time for that.') }}
			<br>
			<hr>
			{{ __('Author Contact : geniusdevs24@gmail.com') }}
		</strong>
	</div>
	@else
        <div class="product-type-grid">
            
            <!-- 1. Physical Product -->
            <a href="{{ route('back.item.create') }}" class="product-type-card card-physical">
                <div class="icon-box">
                    <i class="fa-solid fa-box-open"></i>
                </div>
                <div class="card-content">
                    <h3 class="card-title">{{ __('Physical Product') }}</h3>
                    <p class="card-desc">
                        {{ __('Tangible goods that require physical packaging, inventory SKU counts, weight metrics, and real-world courier shipping.') }}
                    </p>
                </div>
                <div class="card-action-pill">
                    <span>{{ __('Create Physical Product') }}</span>
                    <i class="fa-solid fa-arrow-right"></i>
                </div>
            </a>

            <!-- 2. Digital Product -->
            <a href="{{ route('back.digital.item.create') }}" class="product-type-card card-digital">
                <div class="icon-box">
                    <i class="fa-solid fa-cloud-arrow-down"></i>
                </div>
                <div class="card-content">
                    <h3 class="card-title">{{ __('Digital Product') }}</h3>
                    <p class="card-desc">
                        {{ __('Downloadable digital files such as software, PDF eBooks, music, design templates, and high-resolution assets.') }}
                    </p>
                </div>
                <div class="card-action-pill">
                    <span>{{ __('Create Digital Product') }}</span>
                    <i class="fa-solid fa-arrow-right"></i>
                </div>
            </a>

            <!-- 3. License Product -->
            <a href="{{ route('back.license.item.create') }}" class="product-type-card card-license">
                <div class="icon-box">
                    <i class="fa-solid fa-key"></i>
                </div>
                <div class="card-content">
                    <h3 class="card-title">{{ __('Licence Product') }}</h3>
                    <p class="card-desc">
                        {{ __('Products delivered as serial numbers, activation codes, subscription vouchers, or single-use software licenses.') }}
                    </p>
                </div>
                <div class="card-action-pill">
                    <span>{{ __('Create Licence Product') }}</span>
                    <i class="fa-solid fa-arrow-right"></i>
                </div>
            </a>

            <!-- 4. Affiliate Product -->
            <a href="{{ route('back.affiliate.create') }}" class="product-type-card card-affiliate">
                <div class="icon-box">
                    <i class="fa-solid fa-arrow-up-right-from-square"></i>
                </div>
                <div class="card-content">
                    <h3 class="card-title">{{ __('Affiliate Product') }}</h3>
                    <p class="card-desc">
                        {{ __('External marketplace products or partner listings with external referral links to earn referral commission.') }}
                    </p>
                </div>
                <div class="card-action-pill">
                    <span>{{ __('Create Affiliate Product') }}</span>
                    <i class="fa-solid fa-arrow-right"></i>
                </div>
            </a>

        </div>
	@endif

</div>

@endsection
