    
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

                <!-- <div class="col-md-12 mt-3"></div> -->
                <div class="col-md-9 offset-md-3 mt-3 mb-2">
                    <div class="row">
                        <!-- search bar -->
                        <x-front.search-bar 
                            page="wishlist"
                            divClass="col-md-8"
                            placeholder="Search wishlist"
                            id="wishlist-search-bar"
                        />
                        
                        <!-- Order Duration Filter -->
                        <x-front.sort-button 
                            page="wishlist" 
                            buttonText="Newest First">
                            <ul class="dropdown-menu dropdown-menu-dark" aria-labelledby="dropdownMenuButton2" style="">
                                <li><a class="dropdown-item active" href="#">Newest First</a></li>
                                <li><a class="dropdown-item" href="#">Oldest First</a></li>
                            </ul>
                        </x-front.sort-button>
                    </div>
                </div>


            </div>

            
            <div class="row">

                {{-- <div class="col-md-12 mt-3"></div> --}}

                <!-- PRODUCT & SUB-CATEGORY -->
                <div class="col-md-12">

                    <div class="row">

                        <!-- PRODUCTS -->
                        <div class="col-md-12">

                            <div class="row">

                                <x-front.product.product-card
                                    displayPage="wishlist"
                                    cardType="wishlist"
                                    cardSize="3"
                                    cardTheme=""
                                    slug="/product/product_slug"
                                    imageSlug="images/one-piece.webp"
                                    description="Some quick example text to build on the card title and make up the bulk of the card's content."
                                />

                                <x-front.product.product-card
                                    displayPage="wishlist"
                                    cardType="wishlist"
                                    cardSize="3"
                                    cardTheme=""
                                    slug="/product/product_slug"
                                    imageSlug="images/op-hoodie.webp"
                                    description="Some quick example text to build on the card title and make up the bulk of the card's content."
                                />

                                <x-front.product.product-card
                                    displayPage="wishlist"
                                    cardType="wishlist"
                                    cardSize="3"
                                    cardTheme=""
                                    slug="/product/product_slug"
                                    imageSlug="images/rick-n-m-tees.webp"
                                    description="Some quick example text to build on the card title and make up the bulk of the card's content."
                                />

                                <x-front.product.product-card
                                    displayPage="wishlist"
                                    cardType="wishlist"
                                    cardSize="3"
                                    cardTheme=""
                                    slug="/product/product_slug"
                                    imageSlug="images/rick-n-m-tees.webp"
                                    description="Some quick example text to build on the card title and make up the bulk of the card's content."
                                />

                                
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