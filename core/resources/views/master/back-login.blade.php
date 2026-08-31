<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <title>{{ $setting->title ?? 'Maansa Admin' }}</title>
    <meta content="width=device-width, initial-scale=1.0, shrink-to-fit=no" name="viewport" />
    
    @if(isset($setting->favicon) && $setting->favicon)
        <link rel="icon" href="{{ url('/core/public/storage/images/'.$setting->favicon) }}" type="image/x-icon"/>
    @else
        <link rel="icon" type="image/png" href="{{ asset('installer/img/favicon/favicon-32x32.png') }}" sizes="32x32"/>
    @endif

    <link rel="stylesheet" href="{{ asset('assets/back/css/admin-auth.css') }}">

    @php
        $dashLang = null;
        try {
            $dashLang = DB::table('languages')->where('type', 'Dashboard')->where('is_default', 1)->first();
        } catch (\Throwable $e) {}
    @endphp

    @if($dashLang && isset($dashLang->rtl) && $dashLang->rtl == 1)
        <link rel="stylesheet" href="{{ asset('assets/back/css/rtl.css') }}">
    @endif
</head>

<body class="login-page">
    <div class="auth-bg-glow-1"></div>
    <div class="auth-bg-glow-2"></div>

    <div class="auth-wrapper">
        @yield('content')
        
        <div class="auth-footer">
            <span>&copy; {{ date('Y') }} Maansa. All rights reserved.</span>
        </div>
    </div>

    <script src="{{ asset('assets/back/js/core/jquery.3.2.1.min.js') }}"></script>
    @yield('scripts')
</body>
</html>
