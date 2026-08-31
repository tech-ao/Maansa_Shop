@extends('master.back')

@section('content')
<div class="container-fluid">

	<!-- Page Header Banner -->
    <div class="dash-hero-banner mb-4">
        <div class="dash-hero-content">
            <div class="dash-hero-text">
                <h2><i class="fa-solid fa-pen-to-square mr-2" style="font-size: 22px;"></i> {{ __('Edit Order ID & Reference') }}</h2>
                <p>{{ __('Update the reference transaction code for this customer purchase order.') }}</p>
            </div>
            <div class="dash-hero-actions">
                <a class="btn btn-hero-action btn-hero-primary" href="{{ route('back.order.index') }}" style="font-size: 13.5px; font-weight: 700; padding: 10px 20px;">
                    <i class="fa-solid fa-arrow-left mr-1"></i> {{ __('Back to Orders') }}
                </a>
            </div>
        </div>
    </div>

	<!-- Form Card -->
	<div class="row justify-content-center">
		<div class="col-lg-7 col-md-10">
			<div class="card-modern">
				<div class="card-modern-body">
                    @include('alerts.alerts')
                    
                    <div class="d-flex align-items-center mb-4 pb-3 border-bottom">
                        <div class="d-inline-flex align-items-center justify-content-center bg-primary-light rounded-circle mr-3" style="width: 44px; height: 44px; background: #f0fdf4; color: #059669; font-size: 18px;">
                            <i class="fa-solid fa-receipt"></i>
                        </div>
                        <div>
                            <h5 class="font-weight-bold text-dark mb-0">{{ __('Transaction Reference Number') }}</h5>
                            <p class="text-muted small mb-0">{{ __('Modify the tracking or payment identifier for order #') }}{{ $order->id }}</p>
                        </div>
                    </div>

                    <form class="admin-form" action="{{ route('back.order.update', $order->id) }}" method="POST">
                        @csrf

                        <div class="form-group mb-4">
                            <label for="transaction_number" class="form-label font-weight-bold text-dark">{{ __('Order Transaction Code / ID') }} *</label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text bg-light"><i class="fa-solid fa-barcode text-muted"></i></span>
                                </div>
                                <input type="text" name="transaction_number" class="form-control"
                                    id="transaction_number" placeholder="{{ __('Enter Order ID') }}"
                                    value="{{ $order->transaction_number }}" required style="height: 44px; font-family: monospace; font-size: 14px; font-weight: 600;">
                            </div>
                        </div>

                        <div class="d-flex justify-content-end gap-2 pt-3 border-top">
                            <a href="{{ route('back.order.index') }}" class="btn btn-secondary px-4 mr-2" style="border-radius: 10px; font-weight: 700;">{{ __('Cancel') }}</a>
                            <button type="submit" class="btn btn-primary px-4" style="border-radius: 10px; font-weight: 700; background: linear-gradient(135deg, #10b981, #059669); border: none; box-shadow: 0 4px 12px rgba(16, 185, 129, 0.3);">
                                <i class="fa-solid fa-floppy-disk mr-1"></i> {{ __('Save Changes') }}
                            </button>
                        </div>
                    </form>
				</div>
			</div>
		</div>
	</div>

</div>
@endsection
