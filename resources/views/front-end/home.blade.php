    
@extends('front-end.layouts.pages')    

@section('content-css')
    <link rel="stylesheet" href="{{ asset('css/front-end/homepage.css') }}">
@endsection



@section('content')
    <div class="banner">
        <img src="{{ asset('images/all-star.jpg') }}" alt="Banner Image">
        <!-- <div class="banner-text">
            <h1>Welcome to Our Store</h1>
            <p>Find the best products here!</p>
        </div> -->
    </div>

    <div class="content"> 
        <div class="container">
            <p>Page Content..</p>
        </div>
    </div>
@endsection




@section('content-scripts')

@endsection