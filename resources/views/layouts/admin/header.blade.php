<!doctype html>
<html
    @if(auth()->check() && auth()->user()->hasRole('branch'))
        data-layout="vertical" data-topbar="light" data-sidebar="gradient-4" data-sidebar-size="lg" data-sidebar-image="none" data-preloader="disable" data-theme="default" data-theme-colors="default" data-sidebar-visibility="show" data-layout-style="default" data-bs-theme="light" data-layout-width="fluid" data-layout-position="fixed" data-body-image="none"
    @elseif(auth()->check() && auth()->user()->hasRole('super-admin')) 
        data-layout="vertical" data-topbar="light" data-sidebar="gradient-4" data-sidebar-size="lg" data-sidebar-image="none" data-preloader="disable" data-theme="default" data-theme-colors="green" data-sidebar-visibility="show" data-layout-style="default" data-bs-theme="light" data-layout-width="fluid" data-layout-position="fixed" data-body-image="none"
    @else
        lang="en" data-layout="vertical" data-topbar="light" data-sidebar="gradient-4" data-sidebar-size="lg" data-sidebar-image="none" data-preloader="disable" data-theme="corporate" data-theme-colors="default" data-sidebar-visibility="show" data-layout-style="default" data-bs-theme="light" data-layout-width="fluid" data-layout-position="fixed" data-body-image="none"
    @endif
>


<head>
    <meta charset="utf-8" />
    <title>@yield('title') | {{config('constants.SITE_NAME')}}</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="admin-path" content="{{ url('/admin') }}">
    <meta name="base-path" content="{{ url('/') }}">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="{{asset('/assets/admin/images/favicon.ico')}}">
    <link href="{{ asset('/assets/admin/libs/swiper/swiper-bundle.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{asset('/assets/admin/libs/sweetalert2/sweetalert2.min.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('/assets/admin/libs/select2/css/select2.min.css')}}" rel="stylesheet" />
    <link href="{{ asset('/assets/admin/libs/jsvectormap/jsvectormap.min.css')}}" rel="stylesheet" type="text/css" />
    <link rel="stylesheet" href="https://cdn.datatables.net/rowgroup/1.3.1/css/rowGroup.dataTables.min.css">
    <link href="{{asset('/assets/admin/plugins/custom/datatables/css/dataTables.bootstrap5.min.css')}}" rel="stylesheet"
        type="text/css" />
    <link href="{{asset('/assets/admin/plugins/custom/datatables/responsive/css/responsive.bootstrap.min.css')}}"
        rel="stylesheet" type="text/css" />

    <script src="{{ asset('/assets/admin/js/layout.js')}}"></script>
    <link href="{{ asset('/assets/admin/css/bootstrap.min.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('/assets/admin/css/icons.min.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('/assets/admin/css/app.min.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('/assets/admin/css/custom.min.css')}}" rel="stylesheet" type="text/css" />

</head>

<body>