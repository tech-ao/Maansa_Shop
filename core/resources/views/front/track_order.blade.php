@extends('master.front')
@section('title')
    {{__('Track Order')}}
@endsection

@section('content')
<div class="page-title">
    <div class="container">
      <div class="row">
          <div class="col-lg-12">
            <ul class="breadcrumbs">
                <li><a href="{{route('front.index')}}">{{__('Home')}}</a> </li>
                <li class="separator"></li>
                <li>{{ __('Track Order') }}</li>
              </ul>
          </div>
      </div>
    </div>
</div>

<div class="container py-4 py-md-5">
    <div class="row justify-content-center">
        <div class="col-lg-8 col-md-10">
            <!-- Modern Search Tracking Card -->
            <div class="track-order-search-card text-center p-4 p-md-5 mb-4">
                <div class="track-icon-badge mx-auto mb-3">
                    <i class="fa fa-truck-fast"></i>
                </div>
                <h2 class="track-search-title mb-2">{{ __('Track Your Order') }}</h2>
                <p class="track-search-subtitle text-muted mb-4">
                    {{ __('Enter your order tracking number to see real-time updates and delivery status.') }}
                </p>

                <form id="track-order-form" onsubmit="return false;">
                    <div class="track-input-group">
                        <div class="track-input-icon">
                            <i class="fa fa-barcode text-muted"></i>
                        </div>
                        <input class="form-control track-input-field" type="text" id="order_number" name="order_number"
                            placeholder="{{ __('e.g. ORD-20260901-135') }}" autocomplete="off" required>
                        <button class="btn btn-primary track-submit-btn" id="submit_number"
                            data-href="{{route('front.order.track.submit')}}" type="button">
                            <span><i class="fa fa-search mr-1"></i> {{ __('Track Now') }}</span>
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Track Results Area -->
    <div class="row justify-content-center">
        <div class="col-lg-8 col-md-10">
            <div id="track-order">
                <!-- AJAX content loaded here -->
            </div>
        </div>
    </div>
</div>
@endsection

@section('script')
<script>
    $(document).ready(function () {
        $('#order_number').on('keypress', function(e) {
            if (e.which === 13) {
                $('#submit_number').trigger('click');
            }
        });

        $('#submit_number').on('click', function (e) {
            e.preventDefault();
            var orderNum = $('#order_number').val().trim();
            if (!orderNum) {
                $('#order_number').focus();
                return false;
            }

            var btn = $(this);
            var originalText = btn.html();
            btn.addClass('disabled').html('<span><i class="fa fa-spinner fa-spin mr-1"></i> {{ __("Searching...") }}</span>');

            var link = $(this).data('href') + '?order_number=' + encodeURIComponent(orderNum);
            $('#track-order').html('<div class="text-center py-5"><div class="spinner-border text-primary" role="status"></div><p class="mt-2 text-muted">{{ __("Fetching tracking details...") }}</p></div>');

            $('#track-order').load(link, function() {
                btn.removeClass('disabled').html(originalText);
            });
            return false;
        });
    });
</script>
@endsection


