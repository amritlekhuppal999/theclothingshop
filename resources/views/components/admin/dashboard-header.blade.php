

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    {{-- Stores the path for public directory --}}
    <meta name="public-path" content="{{  asset('') }}">

    <title>{{ isset($pageTitle) ? $pageTitle.' | '.config('app.name') : config('app.name')}}</title>

    <link rel="icon" href="https://tss-static-images.gumlet.io/fevicon.png" type="image/x-icon">
    <link rel="icon" href="{{ asset('images/ico/snorlax.ico') }}" type="image/x-icon">

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />

    <!-- ADMIN LTE CSS -->
    <link rel="stylesheet" href="{{ asset('plugins/fontawesome-free/css/all.min.css') }}">
    <link rel="stylesheet" href="{{ asset('dist/css/adminlte.min.css') }}">

    <!-- overlayScrollbars (used in sidebar) -->
    <link rel="stylesheet" href="{{ asset('plugins/overlayScrollbars/css/OverlayScrollbars.min.css') }} ">

    <!-- MAIN CSS -->
    <link rel="stylesheet" href="{{ asset('css/front-end/main.css') }}">

    <!-- Toastr -->
    <link rel="stylesheet" href="{{ asset('plugins/toastr/toastr.min.css') }}">

    {{-- <link rel="stylesheet" href="{{ asset("plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css")}}"> --}}


    <!-- Google Font: Source Sans Pro -->
    {{-- <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">  --}}