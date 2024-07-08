<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Laravel</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />

        <!-- ADMIN LTE CSS -->
        <link rel="stylesheet" href="{{ asset('plugins/fontawesome-free/css/all.min.css') }}">
        <link rel="stylesheet" href="{{ asset('dist/css/adminlte.min.css') }}">

        <!-- Google Font: Source Sans Pro -->
        <!-- <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet"> -->

    </head>
    <!-- <body class="font-sans antialiased dark:bg-black dark:text-white/50"></body> -->

    <body>
        <h1>Welcome to the {{config('app.name')}}</h1>

        <div class="row">

        <!-- Column 1 -->
        <div class="col-lg-6">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Card title</h5>

                    <p class="card-text">
                    Some quick example text to build on the card title and make up the bulk of the card's
                    content.
                    </p>

                    <a href="#" class="card-link">Card link</a>
                    <a href="#" class="card-link">Another link</a>
                </div>
            </div>

            <div class="card card-primary card-outline">
                <div class="card-body">
                    <h5 class="card-title">Card title</h5>

                    <p class="card-text">
                    Some quick example text to build on the card title and make up the bulk of the card's
                    content.
                    </p>
                    <a href="#" class="card-link">Card link</a>
                    <a href="#" class="card-link">Another link</a>
                </div>
            </div>
        </div>
        
        <!-- Column 2 -->
        <div class="col-lg-6">
            
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title m-0">Featured</h5>
                </div>
                <div class="card-body">
                    <h6 class="card-title">Special title treatment</h6>

                    <p class="card-text">With supporting text below as a natural lead-in to additional content.</p>
                    <a href="#" class="btn btn-primary">Go somewhere</a>
                </div>
            </div>

            <div class="card card-primary card-outline">
                <div class="card-header">
                    <h5 class="card-title m-0">Featured</h5>
                </div>
                <div class="card-body">
                    <h6 class="card-title">Special title treatment</h6>

                    <p class="card-text">With supporting text below as a natural lead-in to additional content.</p>
                    <a href="#" class="btn btn-primary">Go somewhere</a>
                </div>
            </div>
        </div>
    </div>

        <!-- ADMIN LTE JS -->
        <script src="{{ asset('plugins/jquery/jquery.min.js') }}"></script>
        <script src="{{ asset('plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
        <script src="{{ asset('dist/js/adminlte.min.js') }}"></script>
    </body>
</html>
