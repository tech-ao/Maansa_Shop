@extends('master.back')

@section('content')

<div class="container-fluid">

	<!-- Page Header Banner -->
    <div class="dash-hero-banner mb-4">
        <div class="dash-hero-content">
            <div class="dash-hero-text">
                <h2><i class="fa-solid fa-file-lines mr-2" style="font-size: 22px;"></i> {{ __('Review Details & Feedback') }}</h2>
                <p>{{ __('Inspect customer submission details, rating feedback, and product reference.') }}</p>
            </div>
            <div class="dash-hero-actions">
                <a class="btn btn-hero-action btn-hero-primary" href="{{ route('back.review.index') }}" style="font-size: 13.5px; font-weight: 700; padding: 10px 20px;">
                    <i class="fa-solid fa-arrow-left mr-1"></i> {{ __('Back to Reviews') }}
                </a>
            </div>
        </div>
    </div>

	<!-- Review Details Content -->
	<div class="row">
		<!-- Customer Profile Card -->
		<div class="col-lg-5 mb-4">
			<div class="card-modern h-100">
				<div class="card-modern-body">
                    <div class="d-flex align-items-center mb-4 pb-3 border-bottom">
                        <div class="d-inline-flex align-items-center justify-content-center bg-primary-light rounded-circle mr-3" style="width: 46px; height: 46px; background: #eef2ff; color: #4f46e5; font-size: 20px;">
                            <i class="fa-solid fa-user"></i>
                        </div>
                        <div>
                            <h5 class="font-weight-bold text-dark mb-0">{{ __('Customer Information') }}</h5>
                            <p class="text-muted small mb-0">{{ __('Details of reviewer account') }}</p>
                        </div>
                    </div>

                    <div class="mb-3">
                        <label class="text-muted small font-weight-bold text-uppercase mb-1">{{ __('Full Name') }}</label>
                        <div class="font-weight-bold text-dark" style="font-size: 14.5px;">
                            {{ $review->user ? $review->user->first_name . ' ' . $review->user->last_name : __('Anonymous') }}
                        </div>
                    </div>

                    <div class="mb-3">
                        <label class="text-muted small font-weight-bold text-uppercase mb-1">{{ __('Email Address') }}</label>
                        <div class="text-dark" style="font-size: 14px;">
                            {{ $review->user && $review->user->email ? $review->user->email : '-' }}
                        </div>
                    </div>

                    <div class="mb-3">
                        <label class="text-muted small font-weight-bold text-uppercase mb-1">{{ __('Phone Number') }}</label>
                        <div class="text-dark" style="font-size: 14px;">
                            {{ $review->user && $review->user->phone ? $review->user->phone : '-' }}
                        </div>
                    </div>

                    <div class="mb-0">
                        <label class="text-muted small font-weight-bold text-uppercase mb-1">{{ __('Country') }}</label>
                        <div class="text-dark" style="font-size: 14px;">
                            {{ $review->user && $review->user->country ? $review->user->country : '-' }}
                        </div>
                    </div>
				</div>
			</div>
		</div>

		<!-- Review & Rating Statement Card -->
		<div class="col-lg-7 mb-4">
			<div class="card-modern h-100">
				<div class="card-modern-body">
                    <div class="d-flex align-items-center mb-4 pb-3 border-bottom">
                        <div class="d-inline-flex align-items-center justify-content-center bg-primary-light rounded-circle mr-3" style="width: 46px; height: 46px; background: #fef3c7; color: #b45309; font-size: 20px;">
                            <i class="fa-solid fa-star"></i>
                        </div>
                        <div>
                            <h5 class="font-weight-bold text-dark mb-0">{{ __('Feedback & Rating') }}</h5>
                            <p class="text-muted small mb-0">{{ __('Customer review submission') }}</p>
                        </div>
                    </div>

                    <!-- Product Reference -->
                    <div class="p-3 mb-4" style="background: #f8fafc; border-radius: 12px; border: 1px solid #e2e8f0;">
                        <label class="text-muted small font-weight-bold text-uppercase mb-1">{{ __('Reviewed Product') }}</label>
                        @if($review->item)
                            <div class="d-flex flex-wrap align-items-center justify-content-between">
                                <div class="font-weight-bold text-dark mb-2 mb-sm-0 mr-2" style="font-size: 14px;">
                                    {{ $review->item->name }}
                                </div>
                                <a href="{{ route('front.product', $review->item->slug) }}" target="_blank" class="btn btn-outline-primary btn-sm font-weight-bold" style="border-radius: 8px;">
                                    <i class="fa-solid fa-arrow-up-right-from-square mr-1"></i> {{ __('View Product') }}
                                </a>
                            </div>
                        @else
                            <div class="text-muted font-italic">{{ __('Deleted Product') }}</div>
                        @endif
                    </div>

                    <!-- Star Score -->
                    <div class="mb-4">
                        <label class="text-muted small font-weight-bold text-uppercase mb-2 d-block">{{ __('Rating Score') }}</label>
                        <div class="d-inline-flex align-items-center px-3 py-2" style="background: #fefce8; border: 1px solid #fef08a; border-radius: 10px;">
                            <div class="text-warning mr-2" style="font-size: 16px;">
                                @for ($i = 1; $i <= 5; $i++)
                                    @if ($i <= $review->rating)
                                        <i class="fa-solid fa-star" style="color: #f59e0b;"></i>
                                    @else
                                        <i class="fa-regular fa-star" style="color: #cbd5e1;"></i>
                                    @endif
                                @endfor
                            </div>
                            <span class="font-weight-bold text-dark" style="font-size: 14px;">{{ $review->rating }} / 5 {{ __('Stars') }}</span>
                        </div>
                    </div>

                    <!-- Review Comment -->
                    <div class="mb-0">
                        <label class="text-muted small font-weight-bold text-uppercase mb-2 d-block">{{ __('Review Comments') }}</label>
                        <div class="p-3 text-dark" style="background: #ffffff; border: 1px solid #e2e8f0; border-radius: 12px; font-size: 14px; line-height: 1.6; min-height: 100px;">
                            {{ $review->review ? $review->review : __('No written feedback provided.') }}
                        </div>
                    </div>
				</div>
			</div>
		</div>
	</div>

</div>

@endsection
