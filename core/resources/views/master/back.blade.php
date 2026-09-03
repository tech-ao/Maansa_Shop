<!DOCTYPE html>
<html lang="en">

<head>
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <title>{{ $setting->title }}</title>
    <meta content='width=device-width, initial-scale=1.0, shrink-to-fit=no' name='viewport' />
    <link rel="icon" type="image/x-icon" href="{{ url('/core/public/storage/images/' . $setting->favicon) }}" />

    <!-- Fonts and icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <script src="{{ asset('assets/back/js/plugin/webfont/webfont.min.js') }}"></script>
    <script id="setFont" data-src="{{ asset('assets/back/css/fonts.css') }}"
        src="{{ asset('assets/back/js/plugin/webfont/setfont.js') }}"></script>

    <!-- CSS Files -->
    <link rel="stylesheet" href="{{ asset('assets/back/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/back/css/azzara.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/back/css/tagify.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/back/css/sweetalert2/sweetalert2.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/back/css/editor.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/back/css/bootstrap-iconpicker.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/back/css/magnific-popup.css') }}">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css">

    <!-- Custom CSS -->
    <link rel="stylesheet" href="{{ asset('assets/back/css/custom.css') }}">

    @php
        $dashLang = null;
        try {
            $dashLang = DB::table('languages')->where('type', 'Dashboard')->where('is_default', 1)->first();
        } catch (\Throwable $e) {}
    @endphp

    @if ($dashLang && isset($dashLang->rtl) && $dashLang->rtl == 1)
        <link rel="stylesheet" href="{{ asset('assets/back/css/rtl.css') }}">
    @endif

    @yield('styles')

</head>

<body>
    <div class="wrapper">
        <div class="main-header ">
            <!-- Logo Header -->
            <div class="logo-header">

                <a href="{{ route('back.dashboard') }}" class="logo">
                    <img src="{{ $setting->logo ? url('/core/public/storage/images/' . $setting->logo) : url('/core/public/storage/images/placeholder.png') }}"
                        alt="navbar brand" class="navbar-brand">
                </a>
                <button class="navbar-toggler sidenav-toggler ml-auto" type="button" data-toggle="collapse"
                    data-target="collapse" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon">
                        <i class="fa fa-bars"></i>
                    </span>
                </button>
                <button class="topbar-toggler more"><i class="fa fa-ellipsis-v"></i></button>
                <div class="navbar-minimize">
                    <button class="btn btn-minimize ">
                        <i class="fa fa-bars"></i>
                    </button>
                </div>
            </div>
            <!-- End Logo Header -->

            <!-- Navbar Header -->
            <nav class="navbar navbar-header navbar-expand-lg">
                <div class="container-fluid">
                    <ul class="navbar-nav topbar-nav ml-md-auto align-items-center">
                        <li class="nav-item">
                            <a class="btn-topbar-store" title="Live Store" href="{{ route('front.index') }}" target="_blank">
                                <i class="fa-solid fa-store"></i>
                                <span>{{ __('View Website') }}</span>
                                <i class="fa-solid fa-arrow-up-right-from-square" style="font-size: 11px; opacity: 0.75;"></i>
                            </a>
                        </li>
                        <!-- Nav Item - Support Tickets -->
                        <li class="nav-item no-arrow">
                            @php
                                $ticketPendingCount = 0;
                                try {
                                    $ticketPendingCount = \App\Models\Ticket::whereIn('status', ['Pending', 'Open'])->count();
                                } catch (\Throwable $e) {}
                            @endphp
                            <a class="nav-link-notif" href="{{ route('back.ticket.index') }}" title="{{ __('Support Tickets') }} ({{ $ticketPendingCount }} {{ __('Open/Pending') }})">
                                <i class="fa-solid fa-headset"></i>
                                @if($ticketPendingCount > 0)
                                    <span class="topbar-notif-badge" style="background: linear-gradient(135deg, #f59e0b, #d97706); box-shadow: 0 2px 5px rgba(245, 158, 11, 0.45);">{{ $ticketPendingCount }}</span>
                                @endif
                            </a>
                        </li>

                        <!-- Nav Item - Alerts -->
                        <li class="nav-item dropdown no-arrow">
                            <a class="nav-link-notif" href="#" id="alertsDropdown" role="button"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" title="Notifications">
                                <i class="fas fa-bell"></i>
                                <!-- Counter - Alerts -->
                                @php
                                    $notifCount = 0;
                                    try {
                                        $notifCount = App\Models\Notification::countRegistration() + App\Models\Notification::countOrder();
                                    } catch (\Throwable $e) {}
                                @endphp
                                @if($notifCount > 0)
                                    <span class="topbar-notif-badge">{{ $notifCount }}</span>
                                @endif
                            </a>
                            <!-- Dropdown - Alerts -->
                            <div class="dropdown-list dropdown-menu dropdown-menu-right shadow animated--grow-in notif-dropdown-box"
                                aria-labelledby="alertsDropdown" id="display-notf"
                                data-href={{ route('back.notifications') }}>
                                @include('back.notification.index')
                            </div>
                        </li>

                        <li class="nav-item dropdown hidden-caret">
                            <a class="dropdown-toggle profile-pic topbar-profile-btn" data-toggle="dropdown"
                                href="{{ route('back.dashboard') }}" aria-expanded="false">
                                <div class="user-avatar-badge">
                                    <img src="{{ (Auth::guard('admin')->check() && Auth::guard('admin')->user()->photo) ? url('/core/public/storage/images/' . Auth::guard('admin')->user()->photo) : url('/core/public/storage/images/placeholder.png') }}"
                                        onerror="this.onerror=null; this.src='{{ url('/core/public/storage/images/placeholder.png') }}';"
                                        alt="Avatar" class="user-avatar-img">
                                    <span class="user-status-dot"></span>
                                </div>
                                <div class="topbar-user-info d-none d-lg-flex">
                                    <span class="topbar-user-name">{{ Auth::guard('admin')->check() ? Auth::guard('admin')->user()->name : 'Admin' }}</span>
                                    <span class="topbar-user-role">{{ (Auth::guard('admin')->check() && Auth::guard('admin')->user()->role_id == 0) ? __('Administrator') : __('Staff') }}</span>
                                </div>
                                <i class="fa-solid fa-chevron-down topbar-chevron d-none d-lg-inline-block"></i>
                            </a>
                            <ul class="dropdown-menu dropdown-user animated fadeIn topbar-user-dropdown">
                                <li>
                                    <div class="user-box">
                                        <div class="avatar-lg"><img
                                                src="{{ (Auth::guard('admin')->check() && Auth::guard('admin')->user()->photo) ? url('/core/public/storage/images/' . Auth::guard('admin')->user()->photo) : url('/core/public/storage/images/placeholder.png') }}"
                                                onerror="this.onerror=null; this.src='{{ url('/core/public/storage/images/placeholder.png') }}';"
                                                alt="image profile" class="avatar-img rounded-circle"></div>

                                        <div class="u-text">
                                            <h4>{{ Auth::guard('admin')->check() ? Auth::guard('admin')->user()->name : 'Admin' }}</h4>
                                            <p class="text-muted">{{ Auth::guard('admin')->check() ? Auth::guard('admin')->user()->email : '' }}</p>
                                            <a href="{{ route('back.profile') }}"
                                                class="btn btn-sm btn-primary btn-round">{{ __('Update Profile') }}</a>
                                        </div>
                                    </div>
                                </li>
                                <li>
                                    <div class="dropdown-divider"></div>
                                    <a class="dropdown-item"
                                        href="{{ route('back.profile') }}"><i class="fa-solid fa-user-gear mr-2 text-primary"></i> {{ __('Account Settings') }}</a>
                                    <div class="dropdown-divider"></div>
                                    <a class="dropdown-item"
                                        href="{{ route('back.password') }}"><i class="fa-solid fa-key mr-2 text-warning"></i> {{ __('Change Password') }}</a>
                                    <div class="dropdown-divider"></div>
                                    <a class="dropdown-item text-danger" href="{{ route('back.logout') }}"><i class="fa-solid fa-right-from-bracket mr-2"></i> {{ __('Logout') }}</a>
                                </li>
                            </ul>
                        </li>
                    </ul>
                </div>
            </nav>
            <!-- End Navbar -->
        </div>

        <!-- Sidebar -->
        <div class="sidebar">

            <div class="sidebar-background"></div>
            <div class="sidebar-wrapper scrollbar-inner">
                <div class="sidebar-content">
                    <!-- Mobile Drawer Header with Logo & Close Button -->
                    <div class="sidebar-mobile-header d-flex d-lg-none align-items-center justify-content-between">
                        <div class="mobile-brand-wrapper">
                            <img src="{{ $setting->logo ? url('/core/public/storage/images/' . $setting->logo) : url('/core/public/storage/images/placeholder.png') }}"
                                onerror="this.onerror=null; this.src='{{ url('/core/public/storage/images/placeholder.png') }}';"
                                alt="logo" class="mobile-drawer-logo">
                        </div>
                        <button type="button" class="sidebar-mobile-close" onclick="$('html').removeClass('nav_open'); $('body').removeClass('nav_open'); $('.sidenav-toggler').removeClass('toggled');" title="Close Menu">
                            <i class="fa-solid fa-xmark"></i>
                        </button>
                    </div>

                    <div class="user">
                        <div class="avatar-sm">
                            <img src="{{ (Auth::guard('admin')->check() && Auth::guard('admin')->user()->photo) ? url('/core/public/storage/images/' . Auth::guard('admin')->user()->photo) : url('/core/public/storage/images/placeholder.png') }}"
                                onerror="this.onerror=null; this.src='{{ url('/core/public/storage/images/placeholder.png') }}';"
                                alt="..." class="avatar-img">
                        </div>
                        <div class="info">
                            <a href="{{ route('back.profile') }}">
                                <span class="user-name-text">{{ Auth::guard('admin')->check() ? Auth::guard('admin')->user()->name : 'Admin' }}</span>
                                <span class="user-level">{{ (Auth::guard('admin')->check() && Auth::guard('admin')->user()->role_id == 0) ? __('Administrator') : __('Staff') }}</span>
                            </a>
                        </div>
                    </div>

                    @if (Auth::guard('admin')->check() && Auth::guard('admin')->user()->id == 1)
                        @include('master.inc.super')
                    @else
                        @include('master.inc.normal')
                    @endif
                    <div class="sidebar-footer">
                        <span><i class="fa-solid fa-code-branch mr-1"></i> {{ __('Version') }} {{ $setting->version }}</span>
                    </div>

                </div>
            </div>
        </div>
        <!-- End Sidebar -->

        <!-- Mobile Sidenav Backdrop Overlay -->
        <div class="sidenav-overlay" onclick="$('html').removeClass('nav_open'); $('body').removeClass('nav_open'); $('.sidenav-toggler').removeClass('toggled');"></div>

        <div class="main-panel">
            <div class="content">
                <div class="page-inner">
                    @yield('content')
                </div>
            </div>
        </div>

    </div>
    @php
        $mainbs = [];
        $mainbs['is_announcement'] = $setting->is_announcement;
        $mainbs['announcement_delay'] = $setting->announcement_delay;
        $mainbs['overlay'] = $setting->overlay;
        $mainbs = json_encode($mainbs);

    @endphp

    <script>
        var mainbs = {!! $mainbs !!};
        var summernot_upload_url = '{{ route('back.summernote.image.upload') }}';
    </script>
    <!--   Core JS Files   -->
    <script src="{{ asset('assets/back/js/core/jquery.3.6.0.min.js') }}"></script>
    <script src="{{ asset('assets/back/js/core/popper.min.js') }}"></script>
    <script src="{{ asset('assets/back/js/core/bootstrap.min.js') }}"></script>

    <!-- jQuery UI -->
    <script src="{{ asset('assets/back/js/plugin/jquery-ui-1.12.1.custom/jquery-ui.min.js') }}"></script>
    <script src="{{ asset('assets/back/js/plugin/jquery-ui-touch-punch/jquery.ui.touch-punch.min.js') }}"></script>

    <!-- jQuery Scrollbar -->
    <script src="{{ asset('assets/back/js/plugin/jquery-scrollbar/jquery.scrollbar.min.js') }}"></script>

    <!-- Moment JS -->
    <script src="{{ asset('assets/back/js/plugin/moment/moment.min.js') }}"></script>

    <!-- Datatables -->
    <script src="{{ asset('assets/back/js/plugin/datatables/datatables.min.js') }}"></script>
    <script src="{{ asset('assets/back/js/plugin/datatables/dataTables.bootstrap4.min.js') }}"></script>

    <!-- Bootstrap Notify -->
    <script src="{{ asset('assets/back/js/plugin/bootstrap-notify/bootstrap-notify.min.js') }}"></script>

    <!-- sweetalert2 -->
    <script src="{{ asset('assets/back/js/plugin/sweetalert2/sweetalert2.min.js') }}"></script>

    <!-- Menu Builder -->
    <script src="{{ asset('assets/back/js/plugin/jquery-menu-editor.js') }}"></script>

    <!-- Chartjs -->
    <script src="{{ asset('assets/back/js/plugin/chart.min.js') }}"></script>

    <!-- Editor -->
    <script src="{{ asset('assets/back/js/plugin/editor.js') }}"></script>
    <script src="{{ asset('assets/back/js/plugin/datepicker/bootstrap-datetimepicker.min.js') }}"></script>

    <!-- Tagify -->
    <script src="{{ asset('assets/back/js/tagify.js') }}"></script>

    <!-- JS Color -->
    <script src="{{ asset('assets/back/js/jscolor.js') }}"></script>

    <!-- Magnific Popup -->
    <script src="{{ asset('assets/back/js/jquery.magnific-popup.min.js') }}"></script>

    <!-- Icon Picker -->
    <script src="{{ asset('assets/back/js/bootstrap-iconpicker.bundle.min.js') }}"></script>

    <!-- Azzara JS -->
    <script src="{{ asset('assets/back/js/ready.min.js') }}"></script>

    <!-- Select2 JS -->
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

    <!-- Custom JS -->

    @yield('scripts')
    <script src="{{ asset('assets/back/js/custom.js') }}?v=1.6"></script>

</body>

</html>
