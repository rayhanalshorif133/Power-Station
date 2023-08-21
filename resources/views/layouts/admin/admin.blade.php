<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <?php header('Access-Control-Allow-Origin: *'); ?>

    <title>{{ config('app.name', 'Power Station') }}</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- ===============================================-->
    <!--    Favicons-->
    <!-- ===============================================-->

    <link rel="icon" href="{{ asset('images/favicon.ico') }}">
    <link rel="manifest" href="{{asset('assets/img/favicons/manifest.json')}}">
    <meta name="msapplication-TileImage" content="{{asset('assets/img/favicons/mstile-150x150.png')}}">
    <meta name="theme-color" content="#ffffff">
    <script src="{{asset('assets/js/config.js')}}"></script>
    <script src="{{asset('vendors/overlayscrollbars/OverlayScrollbars.min.js')}}"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.0/font/bootstrap-icons.css" />

    <!-- ===============================================-->
    <!--    Stylesheets-->
    <!-- ===============================================-->
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link
        href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,500,600,700%7cPoppins:300,400,500,600,700,800,900&amp;display=swap"
        rel="stylesheet">
    <link href="{{asset('vendors/overlayscrollbars/OverlayScrollbars.min.css')}}" rel="stylesheet">
    <link href="{{asset('assets/css/theme-rtl.min.css')}}" rel="stylesheet" id="style-rtl">
    <link href="{{asset('assets/css/theme.min.css')}}" rel="stylesheet" id="style-default">
    <link href="{{asset('assets/css/user-rtl.min.css')}}" rel="stylesheet" id="user-style-rtl">
    <link href="{{asset('assets/css/user.min.css')}}" rel="stylesheet" id="user-style-default">
    <link href="{{asset('vendors/glightbox/glightbox.min.css')}}" rel="stylesheet" />
    <link href="{{asset('css/custom.css')}}" rel="stylesheet">
    <link rel="stylesheet" href="{{asset('assets/css/toastr.min.css')}}">


    {{-- Datatable CSS--}}
    <link rel="stylesheet" href="{{asset('assets/css/dataTables/dataTables.min.css')}}">
    <link rel="stylesheet" href="{{asset('assets/css/dataTables/fixedHeader.dataTables.min.css')}}">
    <link rel="stylesheet" href="{{asset('assets/css/dataTables/responsive.dataTables.min.css')}}">



    <!-- ===============================================-->
    <!--    JavaScripts-->
    <!-- ===============================================-->
    {{-- Datatable Js--}}
    <script src="{{asset('assets/js/jquery.min.js')}}"></script>
    <script src="{{asset('assets/js/dataTables/dataTables.min.js')}}"></script>
    <script src="{{asset('assets/js/dataTables/fixedHeader.min.js')}}"></script>
    <script src="{{asset('assets/js/dataTables/responsive.min.js')}}"></script>
    <script src="{{asset('assets/js/sweetalert2@11.js')}}"></script>
    <script src="{{asset('assets/js/custom.js')}}"></script>
    {{-- TomSelect --}}
    <link href="{{asset('assets/css/tom-select.css')}}" rel="stylesheet">
    <script src="{{asset('assets/js/tom-select.complete.min.js')}}"></script>
    @yield('head')
</head>

<body class="hold-transition">
    <!-- ===============================================-->
    <!--    Main Content-->
    <!-- ===============================================-->
    <main class="main" id="top">
        <div class="container" data-layout="container">
            @include('layouts.admin._partials.sidebar')
            <div class="content">
                @include('layouts.admin._partials.rightSideNavbar')
                @include('layouts.common.alert')
                @yield('content')
                @include('layouts.common.footer')
            </div>
        </div>
    </main>
    <!-- ===============================================-->
    <!--    End of Main Content-->
    <!-- ===============================================-->
    @include('layouts.admin._partials.settings')




    <!-- ===============================================-->
    <!--    JavaScripts-->
    <!-- ===============================================-->
    <script src="{{asset('vendors/popper/popper.min.js')}}"></script>
    <script src="{{asset('vendors/bootstrap/bootstrap.min.js')}}"></script>
    <script src="{{asset('vendors/anchorjs/anchor.min.js')}}"></script>
    <script src="{{asset('vendors/is/is.min.js')}}"></script>
    <script src="{{asset('vendors/echarts/echarts.min.js')}}"></script>
    <script src="{{asset('vendors/fontawesome/all.min.js')}}"></script>
    <script src="{{asset('vendors/lodash/lodash.min.js')}}"></script>
    <script src="https://polyfill.io/v3/polyfill.min.js?features=window.scroll"></script>
    <script src="{{asset('vendors/list.js/list.min.js')}}"></script>
    <script src="{{asset('vendors/glightbox/glightbox.min.js')}}"></script>
    <script src="{{asset('assets/js/theme.js')}}"></script>
    <script src="{{asset('assets/js/toastr.min.js')}}"></script>
    <script src="{{asset('assets/js/sweetalert.min.js')}}"></script>

    @yield('scripts')
</body>