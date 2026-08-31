<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@if (trim($__env->yieldContent('template_title')))@yield('template_title') | @endif Maansa Setup</title>
    
    <link rel="icon" type="image/png" href="{{ asset('installer/img/favicon/favicon-32x32.png') }}" sizes="32x32"/>
    <link rel="stylesheet" href="{{ asset('installer/css/modern-installer.css') }}"/>
    @yield('style')
    
    <script>
        window.Laravel = <?php echo json_encode(['csrfToken' => csrf_token()]); ?>;
    </script>
</head>
<body>
    <div class="bg-glow-1"></div>
    <div class="bg-glow-2"></div>

    <div class="installer-wrapper">
        <div class="installer-card">
            
            <!-- Header -->
            <div class="installer-header">
                <div class="brand-section">
                    <div class="brand-logo-badge">
                        <i class="fa-solid fa-cart-shopping"></i>
                    </div>
                    <div class="brand-info">
                        <h1>Maan<span class="gradient-text">sa</span></h1>
                        <p>Web Installation & Configuration Wizard</p>
                    </div>
                </div>
                <div class="version-badge">
                    <i class="fa-solid fa-bolt"></i> v1.0 Installer
                </div>
            </div>

            <!-- Stepper Progress Bar (5 Steps without License Verification) -->
            @php
                $step = 1;
                if (Request::is('install/requirements*')) $step = 2;
                elseif (Request::is('install/permissions*')) $step = 3;
                elseif (Request::is('install/environment*')) $step = 4;
                elseif (Request::is('install/final*')) $step = 5;
                
                $progressPercent = ($step - 1) * 25;
            @endphp

            <div class="stepper-container">
                <div class="stepper-nav">
                    <div class="step-connector">
                        <div class="step-connector-progress" style="width: {{ $progressPercent }}%;"></div>
                    </div>

                    <!-- Step 1: Welcome -->
                    <a href="{{ $step >= 1 ? route('LaravelInstaller::welcome') : '#' }}" class="stepper-item {{ $step == 1 ? 'active' : ($step > 1 ? 'completed' : '') }}">
                        <div class="step-node">
                            @if($step > 1) <i class="fa-solid fa-check"></i> @else <i class="fa-solid fa-house"></i> @endif
                        </div>
                        <span class="step-label">Welcome</span>
                    </a>

                    <!-- Step 2: Requirements -->
                    <a href="{{ $step >= 2 ? route('LaravelInstaller::requirements') : '#' }}" class="stepper-item {{ $step == 2 ? 'active' : ($step > 2 ? 'completed' : '') }}">
                        <div class="step-node">
                            @if($step > 2) <i class="fa-solid fa-check"></i> @else <i class="fa-solid fa-server"></i> @endif
                        </div>
                        <span class="step-label">Server</span>
                    </a>

                    <!-- Step 3: Permissions -->
                    <a href="{{ $step >= 3 ? route('LaravelInstaller::permissions') : '#' }}" class="stepper-item {{ $step == 3 ? 'active' : ($step > 3 ? 'completed' : '') }}">
                        <div class="step-node">
                            @if($step > 3) <i class="fa-solid fa-check"></i> @else <i class="fa-solid fa-folder-open"></i> @endif
                        </div>
                        <span class="step-label">Permissions</span>
                    </a>

                    <!-- Step 4: Environment Configuration -->
                    <a href="{{ $step >= 4 ? route('LaravelInstaller::environment') : '#' }}" class="stepper-item {{ $step == 4 ? 'active' : ($step > 4 ? 'completed' : '') }}">
                        <div class="step-node">
                            @if($step > 4) <i class="fa-solid fa-check"></i> @else <i class="fa-solid fa-database"></i> @endif
                        </div>
                        <span class="step-label">Configuration</span>
                    </a>

                    <!-- Step 5: Complete -->
                    <div class="stepper-item {{ $step == 5 ? 'active' : '' }}">
                        <div class="step-node">
                            <i class="fa-solid fa-flag-checkered"></i>
                        </div>
                        <span class="step-label">Complete</span>
                    </div>
                </div>
            </div>

            <!-- Body -->
            <div class="installer-body">
                @if (session('message'))
                    <div class="alert alert-success">
                        <i class="fa-solid fa-circle-check" style="font-size: 18px; margin-top: 2px;"></i>
                        <div>
                            @if(is_array(session('message')))
                                {{ session('message')['message'] }}
                            @else
                                {{ session('message') }}
                            @endif
                        </div>
                    </div>
                @endif

                @if(session()->has('errors'))
                    <div class="alert alert-danger" id="error_alert">
                        <button type="button" class="close-btn" id="close_alert" aria-label="Close">
                            <i class="fa-solid fa-xmark"></i>
                        </button>
                        <i class="fa-solid fa-triangle-exclamation" style="font-size: 18px; margin-top: 2px;"></i>
                        <div>
                            <strong>Configuration Notice</strong>
                            <ul style="margin-top: 4px; padding-left: 18px;">
                                @foreach($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                @endif

                @yield('container')
            </div>

            <!-- Footer -->
            <div class="installer-footer">
                <span>&copy; {{ date('Y') }} Maansa. All rights reserved.</span>
                <span>Need help? <a href="#" onclick="alert('Contact support or check documentation.'); return false;">Documentation</a></span>
            </div>

        </div>
    </div>

    @yield('scripts')
    <script>
        const alertEl = document.getElementById('error_alert');
        const closeBtn = document.getElementById('close_alert');
        if (closeBtn && alertEl) {
            closeBtn.onclick = function() {
                alertEl.style.display = 'none';
            };
        }
    </script>
</body>
</html>
