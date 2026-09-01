<div class="js-cookie-consent modern-cookie-card-wrapper">
    <div class="cookie-card-container">
        <!-- Cookie Card Header -->
        <div class="cookie-card-header">
            <div class="cookie-header-left">
                <div class="cookie-icon-badge">
                    <i class="fa fa-cookie-bite"></i>
                </div>
                <div>
                    <h6 class="cookie-title">{{ __('Cookie Preferences') }}</h6>
                    <span class="cookie-badge-tag">{{ __('Privacy Policy') }}</span>
                </div>
            </div>
            <button type="button" class="cookie-close-trigger js-cookie-consent-agree" aria-label="Close">
                <i class="fa fa-times"></i>
            </button>
        </div>

        <!-- Cookie Card Body -->
        <div class="cookie-card-body">
            <p class="cookie-text">
                {{ $setting->cookie_text ?? __('Your experience on this site will be improved by allowing cookies.') }}
            </p>
        </div>

        <!-- Cookie Card Actions -->
        <div class="cookie-card-actions">
            <button type="button" class="cookie-btn-decline" onclick="window.laravelCookieConsent.hideCookieDialog()">
                {{ __('Decline') }}
            </button>
            <button type="button" class="js-cookie-consent-agree cookie-btn-accept">
                <i class="fa fa-check mr-1"></i> {{ __('Allow Cookies') }}
            </button>
        </div>
    </div>
</div>

<style>
.modern-cookie-card-wrapper {
    position: fixed !important;
    bottom: 24px !important;
    left: 24px !important;
    z-index: 9999999 !important;
    max-width: 420px !important;
    width: calc(100vw - 48px) !important;
    margin: 0 !important;
    padding: 0 !important;
    background: transparent !important;
    border: none !important;
    animation: cookieSlideUp 0.4s cubic-bezier(0.16, 1, 0.3, 1) forwards;
}

@keyframes cookieSlideUp {
    from {
        opacity: 0;
        transform: translateY(30px) scale(0.95);
    }
    to {
        opacity: 1;
        transform: translateY(0) scale(1);
    }
}

.cookie-card-container {
    background: #ffffff !important;
    border: 1px solid #e2e8f0 !important;
    border-radius: 18px !important;
    box-shadow: 0 20px 40px -10px rgba(0, 0, 0, 0.15), 0 8px 20px rgba(0, 0, 0, 0.08) !important;
    padding: 20px !important;
    position: relative !important;
    overflow: hidden !important;
}

.cookie-card-container::before {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 4px;
    background: linear-gradient(90deg, #10b981 0%, #059669 100%);
}

.cookie-card-header {
    display: flex !important;
    align-items: center !important;
    justify-content: space-between !important;
    margin-bottom: 12px !important;
}

.cookie-header-left {
    display: flex !important;
    align-items: center !important;
    gap: 12px !important;
}

.cookie-icon-badge {
    width: 40px !important;
    height: 40px !important;
    min-width: 40px !important;
    border-radius: 12px !important;
    background: #ecfdf5 !important;
    color: #10b981 !important;
    display: flex !important;
    align-items: center !important;
    justify-content: center !important;
    font-size: 18px !important;
}

.cookie-title {
    font-size: 15px !important;
    font-weight: 700 !important;
    color: #0f172a !important;
    margin: 0 !important;
    line-height: 1.2 !important;
}

.cookie-badge-tag {
    font-size: 11px !important;
    color: #059669 !important;
    font-weight: 600 !important;
    background: #f0fdf4 !important;
    padding: 2px 6px !important;
    border-radius: 6px !important;
    display: inline-block !important;
    margin-top: 3px !important;
}

.cookie-close-trigger {
    background: transparent !important;
    border: none !important;
    color: #94a3b8 !important;
    width: 30px !important;
    height: 30px !important;
    min-width: 30px !important;
    border-radius: 8px !important;
    display: inline-flex !important;
    align-items: center !important;
    justify-content: center !important;
    cursor: pointer !important;
    font-size: 14px !important;
    transition: all 0.2s ease !important;
    padding: 0 !important;
}

.cookie-close-trigger:hover {
    background: #f1f5f9 !important;
    color: #0f172a !important;
}

.cookie-card-body {
    margin-bottom: 16px !important;
}

.cookie-text {
    font-size: 13.5px !important;
    line-height: 1.5 !important;
    color: #475569 !important;
    margin: 0 !important;
    font-weight: 400 !important;
}

.cookie-card-actions {
    display: flex !important;
    align-items: center !important;
    gap: 10px !important;
}

.cookie-btn-decline {
    flex: 1 !important;
    padding: 9px 16px !important;
    border-radius: 10px !important;
    background: #f8fafc !important;
    color: #64748b !important;
    border: 1px solid #e2e8f0 !important;
    font-size: 13px !important;
    font-weight: 600 !important;
    cursor: pointer !important;
    transition: all 0.2s ease !important;
    text-align: center !important;
}

.cookie-btn-decline:hover {
    background: #f1f5f9 !important;
    color: #0f172a !important;
    border-color: #cbd5e1 !important;
}

.cookie-btn-accept {
    flex: 1.5 !important;
    padding: 9px 18px !important;
    border-radius: 10px !important;
    background: linear-gradient(135deg, #10b981 0%, #059669 100%) !important;
    color: #ffffff !important;
    border: none !important;
    font-size: 13px !important;
    font-weight: 700 !important;
    cursor: pointer !important;
    box-shadow: 0 4px 14px rgba(16, 185, 129, 0.35) !important;
    transition: all 0.2s ease !important;
    text-align: center !important;
    display: inline-flex !important;
    align-items: center !important;
    justify-content: center !important;
}

.cookie-btn-accept:hover {
    box-shadow: 0 6px 20px rgba(16, 185, 129, 0.45) !important;
    transform: translateY(-1px) !important;
    color: #ffffff !important;
}

@media (max-width: 575px) {
    .modern-cookie-card-wrapper {
        bottom: 16px !important;
        left: 16px !important;
        width: calc(100vw - 32px) !important;
    }
    .cookie-card-container {
        padding: 16px !important;
    }
}
</style>
