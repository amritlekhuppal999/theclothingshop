    
@extends('layouts.pages')    

@section('content-css')
    <link rel="stylesheet" href="{{ asset('css/front-end/homepage.css') }}">
@endsection


@section('content')
    
    <div class="banner">
        {{-- @include('components.front.carousel') --}}
        <!-- <img src="{{ asset('images/all-star.jpg') }}" alt="Banner Image"> -->
        <!-- <div class="banner-text">
            <h1>Welcome to Our Store</h1>
            <p>Find the best products here!</p>
        </div> -->
        <x-front.carousel :bannerImages="$bannerImages" />
    </div>

    <div class="content"> 
        <div class="container-fluid">
            <!-- <p>Page Content..</p> -->

            <!-- CATEGORIES -->
            <div class="row">
                <div class="col-md-12 text-center mt-5 mb-3">
                    <h3>CATEGORIES</h3>
                </div>

                <!-- BIG THREE -->
                    <x-front.product.product-card
                        displayPage="home"
                        cardType="category"
                        cardSize="4"
                        cardTheme="dark"
                        slug="category"
                        imageSlug="images/one-piece.webp"
                        description="Some quick example text to build on the card title and make up the bulk of the card's content."
                        itemName="Oversized T-shirt"
                    />

                    <x-front.product.product-card
                        displayPage="home"
                        cardType="category"
                        cardSize="4"
                        cardTheme=""
                        slug="category"
                        imageSlug="images/op-hoodie.webp"
                        description="Some quick example text to build on the card title and make up the bulk of the card's content."
                        itemName="Polos"
                    />

                    <x-front.product.product-card
                        displayPage="home"
                        cardType="category"
                        cardSize="4"
                        cardTheme=""
                        slug="category"
                        imageSlug="images/rick-n-m-tees.webp"
                        description="Some quick example text to build on the card title and make up the bulk of the card's content."
                        itemName="Solid T-shirts"
                    />
                <!-- BIG THREE END --> 

                <!-- Remaining Categories -->
                    <x-front.product.product-card
                        displayPage="home"
                        cardType="category"
                        cardSize="3"
                        cardTheme=""
                        slug="category"
                        imageSlug="https://prod-img.thesouledstore.com/public/theSoul/uploads/catalog/product/1724912570_5870366.jpg?format=webp&w=480&dpr=1.0"
                        description="Some quick example text to build on the card title and make up the bulk of the card's content."
                        itemName="Polos"
                    />

                    <x-front.product.product-card
                        displayPage="home"
                        cardType="category"
                        cardSize="3"
                        cardTheme=""
                        slug="category"
                        imageSlug="https://prod-img.thesouledstore.com/public/theSoul/uploads/catalog/product/1713943206_9376927.png?format=webp&w=480&dpr=1.0"
                        description="Some quick example text to build on the card title and make up the bulk of the card's content."
                    />

                    <x-front.product.product-card
                        displayPage="home"
                        cardType="category"
                        cardSize="3"
                        cardTheme=""
                        slug="category"
                        imageSlug="https://prod-img.thesouledstore.com/public/theSoul/uploads/catalog/product/1723875789_8404256.jpg?format=webp&w=480&dpr=1.0"
                        description="Some quick example text to build on the card title and make up the bulk of the card's content."
                    />

                    <x-front.product.product-card
                        displayPage="home"
                        cardType="category"
                        cardSize="3"
                        cardTheme=""
                        slug="category"
                        imageSlug="https://prod-img.thesouledstore.com/public/theSoul/uploads/catalog/product/1723875789_7940407.jpg?format=webp&w=480&dpr=1.0"
                        description="Some quick example text to build on the card title and make up the bulk of the card's content."
                    />

                    <x-front.product.product-card
                        displayPage="home"
                        cardType="category"
                        cardSize="3"
                        cardTheme=""
                        slug="category"
                        imageSlug="https://prod-img.thesouledstore.com/public/theSoul/uploads/catalog/product/1709968005_4121325.jpg?format=webp&w=480&dpr=1.0"
                        description="Some quick example text to build on the card title and make up the bulk of the card's content."
                    />

                    <x-front.product.product-card
                        displayPage="home"
                        cardType="category"
                        cardSize="3"
                        cardTheme=""
                        slug="category"
                        imageSlug="https://prod-img.thesouledstore.com/public/theSoul/uploads/catalog/product/1726122231_3508839.jpg?exp_id=41fc062fc4&group=b&format=webp&w=480&dpr=1.0"
                        description="Some quick example text to build on the card title and make up the bulk of the card's content."
                    />

                    <x-front.product.product-card
                        displayPage="home"
                        cardType="category"
                        cardSize="3"
                        cardTheme=""
                        slug="category"
                        imageSlug="https://prod-img.thesouledstore.com/public/theSoul/uploads/catalog/product/1726325300_2818328.jpg?format=webp&w=480&dpr=1.0"
                        description="Some quick example text to build on the card title and make up the bulk of the card's content."
                    />

                    <x-front.product.product-card
                        displayPage="home"
                        cardType="category"
                        cardSize="3"
                        cardTheme=""
                        slug="category"
                        imageSlug="https://prod-img.thesouledstore.com/public/theSoul/uploads/catalog/product/1726325221_5236500.jpg?format=webp&w=480&dpr=1.0"
                        description="Some quick example text to build on the card title and make up the bulk of the card's content."
                    />
                <!-- Remaining Categories END -->
            </div>

            <!-- NEW ADDITIONS / NEW ARRIVALS -->
            <div class="row">
                <div class="col-md-12 text-center mt-5 mb-3">
                    <h3>NEW ADDITIONS</h3>
                </div>

                <x-front.product.product-card
                    displayPage="home"
                    cardType="new-additions"
                    cardSize="3"
                    cardTheme="dark"
                    slug=""
                    imageSlug="images/brown-fit.webp"
                    description="Some quick example text to build on the card title and make up the bulk of the card's content."
                />

                <x-front.product.product-card
                    displayPage="home"
                    cardType="new-additions"
                    cardSize="3"
                    cardTheme=""
                    slug=""
                    imageSlug="images/oversized-fit.webp"
                    description="Some quick example text to build on the card title and make up the bulk of the card's content."
                />

                <x-front.product.product-card
                    displayPage="home"
                    cardType="new-additions"
                    cardSize="3"
                    cardTheme=""
                    slug=""
                    imageSlug="images/grey.webp"
                    description="Some quick example text to build on the card title and make up the bulk of the card's content."
                />

                <x-front.product.product-card
                    displayPage="home"
                    cardType="new-additions"
                    cardSize="3"
                    cardTheme=""
                    slug=""
                    imageSlug="images/slim-fit.webp"
                    description="Some quick example text to build on the card title and make up the bulk of the card's content."
                />
            </div>

            <!-- BEST SELLING -->
            <div class="row">
                <div class="col-md-12 text-center mt-5 mb-3">
                    <h3>BEST SELLING</h3>
                </div>

                <x-front.product.product-card
                    displayPage="home"
                    cardType="best-selling"
                    cardSize="3"
                    cardTheme="dark"
                    slug=""
                    imageSlug="images/bs-popoye-tees.webp"
                    description="Some quick example text to build on the card title and make up the bulk of the card's content."
                />

                <x-front.product.product-card
                    displayPage="home"
                    cardType="best-selling"
                    cardSize="3"
                    cardTheme=""
                    slug=""
                    imageSlug="images/bs-star-wars-pant.webp"
                    description="Some quick example text to build on the card title and make up the bulk of the card's content."
                />

                <x-front.product.product-card
                    displayPage="home"
                    cardType="best-selling"
                    cardSize="3"
                    cardTheme=""
                    slug=""
                    imageSlug="images/bs-st-fit.webp"
                    description="Some quick example text to build on the card title and make up the bulk of the card's content."
                />

                <x-front.product.product-card
                    displayPage="home"
                    cardType="best-selling"
                    cardSize="3"
                    cardTheme=""
                    slug=""
                    imageSlug="images/bs-straight-fit.webp"
                    description="Some quick example text to build on the card title and make up the bulk of the card's content."
                />
            </div>

            <!-- POP CULTURE / SHOP BY FANDOM -->
            <div class="row">
                <div class="col-md-12 text-center mt-5 mb-3">
                    <h3>POP CULTURE</h3>
                </div>

                <div class="col-md-3">
                    <div class="card" style=" background-color:#f4f6f9;">
                        <img src="{{ asset('images/svg/Naruto_logo.svg') }}" class="card-img-top" alt="...">
                    </div>
                </div>

                <div class="col-md-3">
                    <div class="card" style=" background-color:#f4f6f9;">
                        <img src="{{ asset('images/svg/Friends_logo.svg') }}" class="card-img-top" alt="...">
                    </div>
                </div>

                <div class="col-md-3">
                    <div class="card" style=" background-color:#f4f6f9;">
                        <img src="{{ asset('images/svg/Marvel_Logo.svg') }}" class="card-img-top" alt="...">
                    </div>
                </div>

                <div class="col-md-3">
                    <div class="card" style=" background-color:#f4f6f9;">
                        <img src="{{ asset('images/svg/The_Office_US_logo.svg') }}" class="card-img-top" alt="...">
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection




@section('content-scripts')

@endsection