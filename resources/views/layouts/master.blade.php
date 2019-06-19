<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>
        @if(View::hasSection('title'))
        @yield('title')
        @else
        CMS
        @endif
    </title>
    <link rel="shortcut icon" href="{{ asset('images/favicon.png') }}">
    <!-- CSS Style -->
    @include('includes.css')
    @yield('extra_css')
    <!-- CSS Style -->
</head>

<body class="nav-md">
    <div class="container body">
        <div class="main_container">
            @include('includes.sidebar')

            @include('includes.header_topbar')

            <!-- page content -->
            @yield('page_content')
            <!-- /page content -->
            
            @include('includes.footer')
            
        </div>
    </div>


    <!-- SCRIPT -->
    @include('includes.js')
    @yield('extra_js')
    <!-- SCRIPT -->
</body>

</html>