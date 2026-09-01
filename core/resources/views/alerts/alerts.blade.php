@if (Session::has('success'))
<div class="toast-floating-container" id="admin-toast-success">
    <div class="toast-floating-card toast-success">
        <div class="toast-icon-badge">
            <i class="fa-solid fa-circle-check"></i>
        </div>
        <div class="toast-content">
            <span class="toast-title">{{ __('Success') }}</span>
            <span class="toast-message">{{ Session::get('success') }}</span>
        </div>
        <button type="button" class="toast-close-btn" onclick="dismissToastAlert('admin-toast-success')" aria-label="Close">
            <i class="fa-solid fa-xmark"></i>
        </button>
        <div class="toast-progress-bar bg-success-bar"></div>
    </div>
</div>
@endif

@if (Session::has('error'))
<div class="toast-floating-container" id="admin-toast-error">
    <div class="toast-floating-card toast-danger">
        <div class="toast-icon-badge">
            <i class="fa-solid fa-circle-exclamation"></i>
        </div>
        <div class="toast-content">
            <span class="toast-title">{{ __('Error') }}</span>
            <span class="toast-message">{{ Session::get('error') }}</span>
        </div>
        <button type="button" class="toast-close-btn" onclick="dismissToastAlert('admin-toast-error')" aria-label="Close">
            <i class="fa-solid fa-xmark"></i>
        </button>
        <div class="toast-progress-bar bg-danger-bar"></div>
    </div>
</div>
@endif

@if(isset($errors) && count($errors) > 0)
<div class="toast-floating-container" id="admin-toast-validation">
    <div class="toast-floating-card toast-danger">
        <div class="toast-icon-badge">
            <i class="fa-solid fa-triangle-exclamation"></i>
        </div>
        <div class="toast-content">
            <span class="toast-title">{{ __('Validation Alert') }}</span>
            <ul class="toast-error-list mb-0 pl-3">
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
        <button type="button" class="toast-close-btn" onclick="dismissToastAlert('admin-toast-validation')" aria-label="Close">
            <i class="fa-solid fa-xmark"></i>
        </button>
        <div class="toast-progress-bar bg-danger-bar"></div>
    </div>
</div>
@endif

<script>
    function dismissToastAlert(id) {
        var el = typeof id === 'string' ? document.getElementById(id) : id.closest('.toast-floating-container');
        if (el) {
            el.classList.add('toast-hiding');
            setTimeout(function() {
                if (el && el.parentNode) {
                    el.parentNode.removeChild(el);
                }
            }, 300);
        }
    }

    document.addEventListener('DOMContentLoaded', function() {
        var toastContainers = document.querySelectorAll('.toast-floating-container');
        toastContainers.forEach(function(toast) {
            // Auto close after 2 seconds (2000ms)
            var autoDismissTimer = setTimeout(function() {
                dismissToastAlert(toast);
            }, 2000);

            // Pause timer if user hovers over the toast
            toast.addEventListener('mouseenter', function() {
                clearTimeout(autoDismissTimer);
                var bar = toast.querySelector('.toast-progress-bar');
                if (bar) bar.style.animationPlayState = 'paused';
            });

            // Resume dismiss on mouse leave
            toast.addEventListener('mouseleave', function() {
                autoDismissTimer = setTimeout(function() {
                    dismissToastAlert(toast);
                }, 1000);
            });
        });
    });
</script>
