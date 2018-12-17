<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <meta name="keywords" content="HTML5 Admin Template" />
    <meta name="description" content="Porto Admin - Responsive HTML5 Template">
    <meta name="author" content="okler.net">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title') </title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    
   	<!-- Web Fonts  -->
    <link href="http://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700,800|Shadows+Into+Light" rel="stylesheet" type="text/css">
    
    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">

    <!-- Vendor CSS -->
    <link rel="stylesheet" href="{{ asset('css/vendor.css') }}" />

    <!-- Head Libs -->
    <script src="{{ asset('js/modernizr.js') }}"></script>
</head>
<body>
    
    <section class="body">
    
        @include('layouts.header')
    
        <div class="inner-wrapper">
    
            @include('layouts.navigation')
    
            <section role="main" class="content-body">

                    @yield('content')
                    
            </section>
        </div>
    </section>

    <!-- Vendor -->
    <script src="{{asset('js/lib.js') }}"></script>
    
    
    <script>
        console.log('successfull');
    </script>
        
    
    @yield('scripts')
</body>
</html>
