<!DOCTYPE html>

<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="light-style layout-menu-fixed" dir="ltr"
    data-theme="theme-default" data-assets-path="../assets/" data-template="vertical-menu-template-free">

<head>
    <meta charset="utf-8" />
    <meta name="viewport"
        content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0" />

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Admin dashboard What company stack') }}</title>



    <meta name="description" content="" />

    <!-- Favicon -->
    <link rel="icon" type="image/x-icon" href="{{ asset('assets/img/favicon/favicon.png') }}" />

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link
        href="https://fonts.googleapis.com/css2?family=Public+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500;1,600;1,700&display=swap"
        rel="stylesheet" />

    <!-- Icons. Uncomment required icon fonts -->
    <link rel="stylesheet" href="{{ asset('assets/vendor/fonts/boxicons.css') }}" />

    <!-- Core CSS -->
    <link rel="stylesheet" href="{{ asset('assets/vendor/css/core.css') }}" class="template-customizer-core-css" />
    <link rel="stylesheet" href="{{ asset('assets/vendor/css/theme-default.css') }}"
        class="template-customizer-theme-css" />
    <link rel="stylesheet" href="{{ asset('assets/css/demo.css') }}" />

    <!-- Vendors CSS -->
    <link rel="stylesheet" href="{{ asset('assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.css') }}" />

    <link rel="stylesheet" href="{{ asset('assets/vendor/libs/apex-charts/apex-charts.css') }}" />

    <!-- Page CSS -->

    <!-- Helpers -->
    <script src="{{ asset('assets/vendor/js/helpers.js') }}"></script>

    <!-- Scripts -->
    {{-- If using Vite (uncomment this line when applicable) --}}
    {{-- @vite(['resources/sass/app.scss', 'resources/js/app.js']) --}}

    <!-- Template customizer & Theme config files MUST be included after core stylesheets and helpers.js in the <head> section -->
    <!-- Config: Mandatory theme config file contains global vars & default theme options. Set your preferred theme option in this file. -->
    <script src="{{ asset('assets/js/config.js') }}"></script>

    @stack('select2style')

</head>

<body>
    <div id="app">

        <div class="layout-wrapper layout-content-navbar">
            <div class="layout-container">
                <!-- Menu -->

                <aside id="layout-menu" class="layout-menu menu-vertical menu bg-menu-theme">
                    <div class="app-brand demo">
                        <a href="" class="app-brand-link">
                            <img src="https://res.cloudinary.com/chidiebere/image/upload/v1703702998/WCS_1.png"
                                class="img-fluid app-brand-logo" style="height: 3em"/>
                           
                        </a>

                        <a href="javascript:void(0);"
                            class="layout-menu-toggle menu-link text-large ms-auto d-block d-xl-none">
                            <i class="bx bx-chevron-left bx-sm align-middle"></i>
                        </a>
                    </div>

                    <div class="menu-inner-shadow"></div>

                    <ul class="menu-inner py-1">
                        <!-- Dashboard -->
                        <li class="menu-item  {{ request()->routeIs('admin.dashboard.index') ? 'active' : '' }} ">
                            <a href="/" class="menu-link">
                                <i class="menu-icon tf-icons bx bx-home-circle"
                                    style="{{ request()->routeIs('admin.dashboard.*') ? 'color: rgb(0, 0, 10)' : '' }}"></i>
                                <div data-i18n="Analytics">Dashboard</div>
                            </a>
                        </li>


                        <li class="menu-item  {{ request()->routeIs('admin.dataControl.index') ? 'active' : '' }}">
                            <a href="{{ route('admin.dataControl.index') }}" class=" menu-link ">
                                <i class="menu-icon tf-icons bx bx-cube-alt"
                                    style="{{ request()->routeIs('admin.dataControl.*') ? 'color: rgb(0, 0, 10)' : '' }}"></i>
                                <div data-i18n="Analytics">Data Control</div>
                            </a>
                        </li>

                        <li class="menu-item  ">
                            <a href="javascript:void(0);" class="menu-link menu-toggle">
                                <i class="menu-icon tf-icons bx bx-layout"
                                    style="{{ request()->routeIs('admin.company.*') ? 'color: rgb(0, 0, 10)' : '' }}"></i>
                                <div data-i18n="Layouts">Companies</div>
                            </a>

                            <ul class="menu-sub">
                                <li class="menu-item {{ request()->routeIs('admin.companies.index') ? 'active' : '' }}">
                                    <a href="{{ route('admin.companies.index') }}" class="menu-link">
                                        <div data-i18n="Without menu">View Companies</div>
                                    </a>
                                </li>
                            </ul>
                            <!-- I want to become a disciplined successful accomplished  -->
                            <ul class="menu-sub">
                                <li class="menu-item {{ request()->routeIs('admin.companies.create') ? 'active' : '' }}">
                                    <a href="{{ route('admin.companies.create') }}" class="menu-link">
                                        <div data-i18n="Without menu">Add Companies</div>
                                    </a>
                                </li>
                            </ul>
                        </li>


                        <li class="menu-item  ">

                            <a href="javascript:void(0);" class="menu-link menu-toggle">

                                <i class="menu-icon  tf-icons bx bx-collection "
                                    style="{{ request()->routeIs('admin.stack.*') ? 'color: rgb(0, 0, 10)' : '' }}"></i>
                                <div data-i18n="Layouts">Stack
                                </div>
                            </a>

                            <ul class="menu-sub">
                                <li class="menu-item {{ request()->routeIs('admin.stack.index') ? 'active' : '' }}">
                                    <a href="{{ route('admin.stack.index') }}" class="menu-link">
                                        <div data-i18n="Without menu">Index</div>
                                    </a>
                                </li>
                            </ul>
                            <!-- I want to become a disciplined successful accomplished  -->

                        </li>


                        <li class="menu-item  ">

                            <a href="javascript:void(0);" class="menu-link menu-toggle">

                                <i class="menu-icon bx bxl-baidu "></i>
                                <div data-i18n="Layouts">Source</div>
                            </a>

                            <ul class="menu-sub">
                                <li class="menu-item {{ request()->routeIs('admin.source.index') ? 'active' : '' }}">
                                    <a href="{{ route('admin.source.index') }}" class="menu-link">
                                        <div data-i18n="Without menu">View Sources</div>
                                    </a>
                                </li>
                            </ul>


                            <ul class="menu-sub">
                                <li class="menu-item {{ request()->routeIs('admin.source.create') ? 'active' : '' }}">
                                    <a href="{{ route('admin.source.create') }}" class="menu-link">
                                        <div data-i18n="Without menu">Add Source</div>
                                    </a>
                                </li>
                            </ul>

                            <ul class="menu-sub">
                                <li class="menu-item {{ request()->routeIs('admin.source.create') ? 'active' : '' }}">
                                    <a href="{{ route('admin.source.create') }}" class="menu-link">
                                        <div data-i18n="Without menu">Settings</div>
                                    </a>
                                </li>
                            </ul>
                            <!-- I want to become a disciplined successful accomplished  -->
                        </li>
                    </ul>
                </aside>
                <!-- / Menu -->

                <!-- Layout container -->
                <div class="layout-page">
                    <!-- Navbar -->

                    <nav class="layout-navbar container-xxl navbar navbar-expand-xl navbar-detached align-items-center bg-navbar-theme"
                        id="layout-navbar">
                        <div class="layout-menu-toggle navbar-nav align-items-xl-center me-3 me-xl-0 d-xl-none">
                            <a class="nav-item nav-link px-0 me-xl-4" href="javascript:void(0)">
                                <i class="bx bx-menu bx-sm"></i>
                            </a>
                        </div>

                        <div class="navbar-nav-right d-flex align-items-center" id="navbar-collapse">
                            <!-- Search -->
                            <div class="navbar-nav align-items-center">
                                <div class="nav-item d-flex align-items-center">
                                    <i class="bx bx-search fs-4 lh-0"></i>
                                    <input type="text" class="form-control border-0 shadow-none"
                                        placeholder="Search..." aria-label="Search..." />
                                </div>
                            </div>
                            <!-- /Search -->

                            <ul class="navbar-nav flex-row align-items-center ms-auto">
                                <!-- Place this tag where you want the button to render. -->
                                <li class="nav-item lh-1 me-3">
                                    <a class="github-button" href="https://github.com/jovialcore/whatcompstack-BE"
                                        data-icon="octicon-star" data-size="large" data-show-count="true"
                                        aria-label="Star themeselection/sneat-html-admin-template-free on GitHub">Star</a>
                                </li>

                                <!-- User -->
                                <li class="nav-item navbar-dropdown dropdown-user dropdown">
                                    <a class="nav-link dropdown-toggle hide-arrow" href="javascript:void(0);"
                                        data-bs-toggle="dropdown">
                                        <div class="avatar avatar-online">
                                            <img src="{{ asset('assets/img/avatars/me.png') }}" alt
                                                class="w-px-40 h-auto rounded-circle" />
                                        </div>
                                    </a>
                                    <ul class="dropdown-menu dropdown-menu-end">

                                        @guest


                                            <li class="">
                                                <a class="dropdown-item"
                                                    href="{{ route('login') }}">{{ __('Login') }}</a>
                                            </li>
                                        @else
                                            <li>
                                                <a class="dropdown-item" href="{{ route('logout') }}"
                                                    onclick="event.preventDefault();
                                                document.getElementById('logout-form').submit();">

                                                    <i class="bx bx-power-off me-2"></i>
                                                    <span class="align-middle"> {{ __('Logout') }}</span>
                                                </a>

                                                <form id="logout-form" action="{{ route('logout') }}" method="POST"
                                                    class="d-none">
                                                    @csrf
                                                </form>
                                            </li>
                                        @endguest
                                    </ul>
                                </li>
                                <!--/ User -->
                            </ul>
                        </div>
                    </nav>

                    <!-- / Navbar -->

                    <!-- Content wrapper -->
                    <div class="content-wrapper">
                        <!-- Content -->

                        <div class="container-xxl flex-grow-1 container-p-y">
                            <div class="row">
                                @yield('content')
                            </div>
                        </div>
                        <!-- / content -->


                        <!-- Footer -->
                        <footer class="content-footer footer bg-footer-theme">
                            <div
                                class="container-xxl d-flex flex-wrap justify-content-between py-2 flex-md-row flex-column">
                                {{-- <div class="mb-2 mb-md-0">
                                    ©
                                    <script>
                                        document.write(new Date().getFullYear());
                                    </script>, Admin Template credits to
                                    <a href="https://themeselection.com" target="_blank"
                                        class="footer-link fw-bolder">ThemeSelection</a>
                                </div> --}}
                                {{-- <div>
                                    <a href="https://themeselection.com/license/" class="footer-link me-4"
                                        target="_blank">License</a>
                                    <a href="https://themeselection.com/" target="_blank"
                                        class="footer-link me-4">More
                                        Themes</a>

                                    <a href="https://themeselection.com/demo/sneat-bootstrap-html-admin-template/documentation/"
                                        target="_blank" class="footer-link me-4">Documentation</a>

                                    <a href="https://github.com/themeselection/sneat-html-admin-template-free/issues"
                                        target="_blank" class="footer-link me-4">Support</a>
                                </div> --}}
                            </div>
                        </footer>
                        <!-- / Footer -->

                        <div class="content-backdrop fade"></div>
                    </div>

                    <!-- / Content wrapper -->
                </div>
                <!-- / Layout page -->

            </div>

            <!-- Overlay -->
            <div class="layout-overlay layout-menu-toggle"></div>
        </div>

        <!-- / Layout wrapper -->

        {{-- <div class="buy-now">
            <a href="https://themeselection.com/products/sneat-bootstrap-html-admin-template/" target="_blank"
                class="btn btn-danger btn-buy-now">Upgrade to Pro</a>
        </div> --}}
    </div>


    <!-- build:js assets/vendor/js/core.js -->
    <script src="{{ asset('assets/vendor/libs/jquery/jquery.js') }}"></script>
    <script src="{{ asset('assets/vendor/libs/popper/popper.js') }}"></script>
    <script src="{{ asset('assets/vendor/js/bootstrap.js') }}"></script>
    <script src="{{ asset('assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.js') }}"></script>

    <script src="{{ asset('assets/vendor/js/menu.js') }}"></script>
    <!-- endbuild -->

    <!-- Vendors JS -->
    <script src="{{ asset('assets/vendor/libs/apex-charts/apexcharts.js') }}"></script>

    <!-- Main JS -->
    <script src="{{ asset('assets/js/main.js') }}"></script>

    <!-- Alert js ui  -->
    <script src="{{ asset('assets/js/ui-alert.js') }}"></script>
    <!-- Page JS -->
    <script src="{{ asset('assets/js/dashboards-analytics.js') }}"></script>

    <!-- Place this tag in your head or just before your close body tag. -->
    <script async defer src="https://buttons.github.io/buttons.js"></script>

    @stack('select2script')

</body>

</html>
