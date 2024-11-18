<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <!-- headers -->
        <x-admin.dashboard-header />

        @yield('content-css')
    </head>
    
    <body class="hold-transition sidebar-mini">
        <!-- <h1>Welcome to the {{config('app.name')}}</h1> -->

        {{-- 
        @php 
            var_dump(session()->all());
        @endphp
        --}}
        

        <div class="wrapper">
            <!-- Navbar -->
            <x-admin.dashboard-navbar />

            <!-- Sidebar -->
            <x-admin.dashboard-sidebar />

            <!-- Content Wrapper. Contains page content -->
            <div class="content-wrapper">
                
                @yield('content')

            </div>

            <!-- Main Footer -->
            <x-admin.dashboard-footer />

        </div>

        <!-- ADMIN LTE JS -->
        <x-admin.dashboard-adminlte-scripts />

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