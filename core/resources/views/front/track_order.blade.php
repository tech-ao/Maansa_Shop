@extends('master.front')
@section('title')
    {{__('Track Your Order')}}
@endsection

@section('content')
<!-- Page Title / Breadcrumbs -->
<div class="page-title">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <ul class="breadcrumbs">
                    <li><a href="{{route('front.index')}}">{{__('Home')}}</a></li>
                    <li class="separator"></li>
                    <li>{{ __('Track Order') }}</li>
                </ul>
            </div>
        </div>
    </div>
</div>

<style>
    /* ==========================================================================
       MODERN TRACK ORDER STYLES (DESKTOP & MOBILE)
       ========================================================================== */
    .track-order-search-card {
        background: #ffffff;
        border-radius: 20px;
        border: 1px solid #e2e8f0;
        box-shadow: 0 10px 30px -5px rgba(0, 0, 0, 0.06);
        padding: 40px 32px;
        position: relative;
        overflow: hidden;
    }
    .track-icon-badge {
        width: 64px;
        height: 64px;
        min-width: 64px;
        border-radius: 18px;
        background: #ecfdf5;
        color: #059669;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        font-size: 26px;
        border: 1.5px solid #a7f3d0;
        box-shadow: 0 4px 14px rgba(16, 185, 129, 0.18);
        transition: transform 0.25s ease;
    }
    .track-order-search-card:hover .track-icon-badge {
        transform: scale(1.06);
    }
    .track-search-title {
        font-size: 24px;
        font-weight: 800;
        color: #0f172a;
        margin-top: 14px;
        margin-bottom: 8px;
    }
    .track-search-subtitle {
        font-size: 14px;
        color: #64748b;
        max-width: 460px;
        margin: 0 auto 26px auto;
        line-height: 1.5;
    }
    .track-input-group {
        display: flex;
        align-items: center;
        background: #f8fafc;
        border: 1.5px solid #cbd5e1;
        border-radius: 14px;
        padding: 4px 5px 4px 14px;
        transition: all 0.2s ease;
        max-width: 540px;
        margin: 0 auto;
    }
    .track-input-group:focus-within {
        border-color: #10b981;
        background: #ffffff;
        box-shadow: 0 0 0 3.5px rgba(16, 185, 129, 0.18);
    }
    .track-input-icon {
        color: #94a3b8;
        font-size: 18px;
        margin-right: 10px;
        display: flex;
        align-items: center;
    }
    .track-input-field {
        flex: 1;
        min-width: 0;
        border: none !important;
        background: transparent !important;
        font-size: 14.5px;
        font-weight: 600;
        color: #0f172a;
        padding: 10px 8px;
        outline: none !important;
        box-shadow: none !important;
    }
    .track-input-field::placeholder {
        color: #94a3b8;
        font-weight: 400;
    }
    .track-submit-btn {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        gap: 8px;
        background: linear-gradient(135deg, #10b981 0%, #059669 100%);
        color: #ffffff !important;
        border: none;
        padding: 11px 24px;
        border-radius: 11px;
        font-size: 14px;
        font-weight: 700;
        cursor: pointer;
        transition: all 0.2s ease;
        box-shadow: 0 4px 12px rgba(16, 185, 129, 0.35);
        white-space: nowrap;
        flex-shrink: 0;
    }
    .track-submit-btn i {
        margin-right: 6px;
    }
    .track-submit-btn:hover {
        background: linear-gradient(135deg, #059669 0%, #047857 100%);
        transform: translateY(-1px);
        box-shadow: 0 6px 16px rgba(16, 185, 129, 0.45);
        color: #ffffff !important;
    }
    .track-help-text {
        font-size: 12px;
        color: #94a3b8;
        margin-top: 14px;
        font-weight: 500;
    }

    /* Mobile Adaptations */
    @media (max-width: 575.98px) {
        .track-order-search-card {
            padding: 28px 18px;
            border-radius: 16px;
        }
        .track-search-title {
            font-size: 20px;
        }
        .track-input-group {
            flex-direction: column;
            padding: 12px;
            gap: 10px;
            background: #ffffff;
        }
        .track-input-field {
            width: 100%;
            text-align: center;
            padding: 6px;
        }
        .track-submit-btn {
            width: 100%;
            padding: 12px;
        }
        .track-input-icon {
            display: none;
        }
    }

    /* Tracking Result Card */
    .order-tracking-result-card {
        background: #ffffff;
        border-radius: 18px;
        border: 1px solid #e2e8f0;
        box-shadow: 0 8px 26px -4px rgba(0, 0, 0, 0.06);
        overflow: hidden;
        animation: trackFadeUp 0.3s cubic-bezier(0.16, 1, 0.3, 1);
    }
    @keyframes trackFadeUp {
        from {
            opacity: 0;
            transform: translateY(12px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }
    .tracking-card-header {
        background: #fafbfc;
        padding: 18px 24px;
    }
    .tracking-vertical-timeline {
        position: relative;
        padding: 8px 0;
    }
    .timeline-step {
        display: flex;
        position: relative;
        padding-bottom: 28px;
    }
    .timeline-step:last-child {
        padding-bottom: 0;
    }
    .step-indicator {
        display: flex;
        flex-direction: column;
        align-items: center;
        margin-right: 18px;
        position: relative;
    }
    .step-icon {
        width: 38px;
        height: 38px;
        min-width: 38px;
        border-radius: 50%;
        background: #f1f5f9;
        color: #94a3b8;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 14px;
        border: 2px solid #e2e8f0;
        z-index: 2;
        transition: all 0.25s ease;
    }
    .timeline-step.step-completed .step-icon {
        background: #10b981;
        border-color: #10b981;
        color: #ffffff;
        box-shadow: 0 0 0 4px rgba(16, 185, 129, 0.2);
    }
    .timeline-step.step-active .step-icon {
        background: #f0fdf4;
        border-color: #10b981;
        color: #059669;
        box-shadow: 0 0 0 4px rgba(16, 185, 129, 0.25);
        animation: pulseTrack 2s infinite;
    }
    @keyframes pulseTrack {
        0%, 100% { box-shadow: 0 0 0 3px rgba(16, 185, 129, 0.2); }
        50% { box-shadow: 0 0 0 7px rgba(16, 185, 129, 0.1); }
    }
    .step-line {
        position: absolute;
        top: 38px;
        bottom: 0;
        width: 2px;
        background: #e2e8f0;
        z-index: 1;
    }
    .timeline-step.step-completed .step-line {
        background: #10b981;
    }
    .step-content {
        flex: 1;
        min-width: 0;
        padding-top: 4px;
    }
    .step-title {
        font-size: 15px;
        font-weight: 700;
        color: #0f172a;
    }
    .timeline-step.step-completed .step-title {
        color: #059669;
    }
    .step-desc {
        font-size: 13px;
        color: #64748b;
        line-height: 1.45;
    }
    .step-time {
        font-size: 12px;
        font-weight: 600;
    }

    /* Order Not Found */
    .order-not-found-card {
        background: #ffffff;
        border-radius: 18px;
        border: 1px solid #e2e8f0;
        box-shadow: 0 4px 20px -4px rgba(0, 0, 0, 0.05);
    }
    .not-found-icon-box {
        width: 64px;
        height: 64px;
        border-radius: 50%;
        background: #fef2f2;
        color: #ef4444;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        font-size: 26px;
        border: 1px solid #fee2e2;
    }
</style>

<div class="container py-4 py-md-5">
    <div class="row justify-content-center">
        <div class="col-lg-8 col-md-10">
            <!-- Modern Search Tracking Card -->
            <div class="track-order-search-card text-center mb-4">
                <div class="track-icon-badge mx-auto">
                    <i class="fas fa-shipping-fast"></i>
                </div>
                <h2 class="track-search-title">{{ __('Track Your Order') }}</h2>
                <p class="track-search-subtitle">
                    {{ __('Enter your order tracking number to see real-time updates and delivery status.') }}
                </p>

                <form id="track-order-form" onsubmit="return false;">
                    <div class="track-input-group">
                        <div class="track-input-icon">
                            <i class="fas fa-barcode"></i>
                        </div>
                        <input class="form-control track-input-field" type="text" id="order_number" name="order_number"
                            placeholder="{{ __('e.g. ORD-20260901-135') }}" autocomplete="off" required>
                        <button class="track-submit-btn" id="submit_number"
                            data-href="{{route('front.order.track.submit')}}" type="button">
                            <i class="fas fa-search"></i>
                            <span>{{ __('Track Now') }}</span>
                        </button>
                    </div>
                </form>
                <div class="track-help-text">
                    <i class="fas fa-info-circle mr-1 text-muted"></i> {{ __('Your order ID was sent to your email confirmation upon purchase.') }}
                </div>
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
            var originalHtml = btn.html();
            btn.addClass('disabled').html('<i class="fas fa-spinner fa-spin"></i> <span>{{ __("Searching...") }}</span>');

            var link = $(this).data('href') + '?order_number=' + encodeURIComponent(orderNum);
            $('#track-order').html(`
                <div class="text-center py-5">
                    <div class="spinner-border text-success" role="status" style="width: 2.5rem; height: 2.5rem;"></div>
                    <p class="mt-3 text-dark font-weight-bold" style="font-size: 14.5px;">{{ __("Fetching tracking details...") }}</p>
                </div>
            `);

            $('#track-order').load(link, function() {
                btn.removeClass('disabled').html(originalHtml);
            });
            return false;
        });
    });
</script>
@endsection



