    
@extends('front-end.layouts.pages')    

@section('content-css')
    <link rel="stylesheet" href="{{ asset('css/front-end/wishlist.css') }}">
@endsection



@section('content')
    
    <!-- <div class="banner">
        @include('components.front.carousel')
    </div> -->

    <div class="content"> 
        <div class="container">
            <!-- <p>Page Content..</p> -->

            
            <div class="row">

                <!-- display applied filters here, along with pagination if possible -->

                <!-- SORT OPTIONS -->
                <div class="col-md-6 offset-md-6 text-right mt-3 mb-2"> 
                    <!-- <h3>SORT OPTIONS</h3> -->
                    <div class="dropdown">
                        <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton2" data-bs-toggle="dropdown" aria-expanded="false">
                            Select Sorting Options
                        </button>
                        <ul class="dropdown-menu dropdown-menu-dark" aria-labelledby="dropdownMenuButton2" style="">
                            <li><a class="dropdown-item active" href="#">A-Z</a></li>
                            <li><a class="dropdown-item" href="#">Price- High to Low </a></li>
                            <li><a class="dropdown-item" href="#">Price- Low to High </a></li>
                            <li><a class="dropdown-item" href="#"> Newest </a></li>
                            <li><a class="dropdown-item" href="#"> Oldest </a></li>
                            <!-- <li><hr class="dropdown-divider"></li>
                            <li><a class="dropdown-item" href="#">Separated link</a></li> -->
                        </ul>
                    </div>
                </div>

                <!-- PRODUCT & SUB-CATEGORY -->
                <div class="col-md-12">

                    <div class="row">

                        <!-- PRODUCTS -->
                        <div class="col-md-12">

                            <div class="row">
                                <div class="col-md-3">
                                    <div class="card bg-dark text-white" style="">
                                        <a href="/product/product_slug">
                                            <img src="{{ asset('images/one-piece.webp') }}" class="card-img-top" alt="...">
                                        </a>
                                        
                                        <div class="card-body">
                                            <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-3">
                                    <div class="card" style="">
                                        <a href="product/product_slug">
                                            <img src="{{ asset('images/op-hoodie.webp') }}" class="card-img-top" alt="...">
                                        </a>

                                        <div class="card-body">
                                            <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-3">
                                    <div class="card" style="">
                                        <a href="product/product_slug">
                                            <img src="{{ asset('images/rick-n-m-tees.webp') }}" class="card-img-top" alt="...">
                                        </a>

                                        <div class="card-body">
                                            <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-3">
                                    <div class="card" style="">
                                        <a href="product/product_slug">
                                            <img src="{{ asset('images/rick-n-m-tees.webp') }}" class="card-img-top" alt="...">
                                        </a>
                                        
                                        <div class="card-body">
                                            <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
@endsection




@section('content-scripts')
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
@endsection