<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <!-- headers -->
        <x-front.page-header />
        
        <link rel="stylesheet" href="{{ asset("css/animation.css") }}">
        <link rel="stylesheet" href="{{ asset("css/front-end/product-card.css") }}">
        
        <link rel="stylesheet" href="{{ asset("css/front-end/nav-bar.css") }}">
        <link rel="stylesheet" href="{{ asset("css/front-end/search-bar.css") }}">
        
        @if(env("APP_ENV") == "local")
            @vite(['resources/css/app.css', 'resources/js/app.js'])
        @endif

        @yield('content-css')
        {{-- @livewireStyles --}}

    </head>
    
    <body class="hold-transition layout-top-nav">
        <!-- <h1>Welcome to the {{config('app.name')}}</h1> -->

        <div class="wrapper">
            
            <!-- Navbar -->
            <x-front.navbar.nav-bar />

            <!-- Content Wrapper. Contains page content -->
            <div class="content-wrapper">
                
                @yield('content')

            </div>

            <!-- Main Footer -->
            <x-front.footer />

        </div>

        <!-- ADMIN LTE JS -->
        <x-front.adminlte-scripts />

        <script src="{{ asset("js/globals.js") }}"></script>
        <script src="{{ asset("js/text-animation.js") }}"></script>

        {{-- @livewireScripts --}}
        @stack('scripts')
        @stack('searchbar-scripts')
        @yield('content-scripts')
    </body>
</html>
