<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <!-- headers -->
        <x-front.page-header />

        @yield('content-css')
    </head>
    
    <body class="hold-transition layout-top-nav">
        <!-- <h1>Welcome to the {{config('app.name')}}</h1> -->

        <div class="wrapper">
            <!-- Navbar -->
            @include('components.front.navbar')

            <!-- Content Wrapper. Contains page content -->
            <div class="content-wrapper">
                
                <!-- BREAD CRUM / Content Header (Page header) -->
                {{-- @include('components.front.breadcrumb') --}}

                <!-- To add margin gap -->
                <!-- <div class="content-header"> 
                    <div class="container"></div>
                </div> -->

                <!-- Main content -->
                <!-- <div class="content">
                    <div class="container"></div>
                </div> -->
                
                @yield('content')

            </div>

            <!-- Main Footer -->
            <x-front.footer />

        </div>

        <!-- ADMIN LTE JS -->
        <x-front.adminlte-scripts />

        @yield('content-scripts')
    </body>
</html>


<?php 
    /*
     * 
     * {{-- <x-component /> --}}
     * @include('component')
     * 
     * these two do the same thing so don't get confused
     */
?>