    
@extends('layouts.pages')

@section('content-css')
    <link rel="stylesheet" href="{{ asset('css/front-end/category.css') }}">

    <style>
        /* Container for the scrollable content */
        .scroll-container {
            /* max-height: 300px; /* Set a max height to make it scrollable */
            /* overflow-y: auto; /* Enable vertical scrolling */
            /* border: 1px solid #dee2e6; /* Bootstrap-like border */
            /* border-radius: 0.5rem; /* Rounded corners for the container */
            /* background-color: #fff; /* White background for the content area */
            /* padding: 1.5rem; /* Internal padding for content, not scrollbar */
            /* width: 100%; /* Ensure it takes full width of its parent */
            /* max-width: 400px; /* Max width for better presentation */
            /* box-shadow: 0 0.5rem 1rem rgba(0, 0, 0, 0.05); /* Subtle shadow */
        }

        /* --- Custom Scrollbar Styles for WebKit browsers (Chrome, Safari, Edge) --- */

        /* Width of the scrollbar */
        .scroll-container::-webkit-scrollbar {
            width: 8px; /* Make it narrower */
        }

        /* Track of the scrollbar (the area behind the thumb) */
        .scroll-container::-webkit-scrollbar-track {
            background: #f1f1f1; /* Light gray track */
            border-radius: 10px; /* Rounded track */
        }

        /* Thumb of the scrollbar (the draggable part) */
        .scroll-container::-webkit-scrollbar-thumb {
            background: #888; /* Darker gray thumb */
            border-radius: 10px; /* Rounded thumb */
        }

        /* Hover state for the scrollbar thumb */
        .scroll-container::-webkit-scrollbar-thumb:hover {
            background: #555; /* Even darker gray on hover */
        }

        /* --- Scrollbar Styles for Firefox --- */
        /* Note: Firefox styling is more limited. */
        .scroll-container {
            /* scrollbar-width: thin; /* 'auto' or 'thin' */
            /* scrollbar-color: #888 #f1f1f1; /* thumb color track color */
        }
    </style>
@endsection



@section('content')
    
    {{-- <div class="banner">
        @include('components.front.carousel')
    </div>  --}}

    <div class="content"> 
        <div class="container-fluid">
            <!-- <p>Page Content..</p> -->

            
            <div class="row">

                <!-- display applied filters here, along with pagination if possible -->
                <div class="col-md-9 offset-md-3 mt-2 mb-2">

                    <div class="row">
                        {{-- searchbar --}}
                        {{-- <x-front.search-bar 
                            page="category" 
                            divClass="col-md-8"
                            placeholder="Search category"
                            id="category-search-bar"
                        /> --}}

                        <!-- SORT OPTIONS -->
                        <x-front.sort-button 
                            page="category"
                            class="offset-md-8"
                            buttonText="Select Sorting Options">
                            <ul class="dropdown-menu dropdown-menu-dark" aria-labelledby="dropdownMenuButton2" style="">
                                <li><a class="dropdown-item active" href="#">A-Z</a></li>
                                <li><a class="dropdown-item" href="#">Price- High to Low </a></li>
                                <li><a class="dropdown-item" href="#">Price- Low to High </a></li>
                                <li><a class="dropdown-item" href="#"> Newest </a></li>
                            </ul>
                        </x-front.sort-button>

                    </div>
                </div>


            </div>

            
            <!-- PRODUCT & SUB-CATEGORY -->
            <div class="row">
            
                <div class="col-md-12">

                    <div class="row">

                        <!-- FILTERS -->
                        <div class="col-md-3" id="filter-section">

                            <!-- SUB-CATEGORY -->
                            <span id="subCatFilter-adjacent"></span>
                            <x-front.category.sub-category-filter :categorySlug="$category_slug"/>

                            <!-- THEME -->
                            <span id="themeFilter-adjacent"></span>
                            <x-front.category.theme-filter />

                            <!-- Attribute -->
                            <span id="attributeFilter-adjacent"></span>
                            <x-front.category.attribute-filter />
                            
                            <!-- SIZE -->
                            {{-- <span id="sizeFilter-adjacent"></span>
                            <x-front.category.size-filter /> --}}

                            <!-- PRICE -->
                            <span id="priceFilter-adjacent"></span>
                            <x-front.category.price-filter />
                        </div>

                        <!-- PRODUCTS -->
                        <div class="col-md-9">

                            <livewire:front.product.load-products
                                id="" 
                                :categorySlug="$category_slug" 
                                wire:listen="filtersUpdated->triggerRefresh"
                            />
                            
                            {{-- <div class="row">

                                
                                <x-front.product.product-card
                                    displayPage="home"
                                    cardType="category"
                                    cardSize="3"
                                    cardTheme="dark"
                                    slug="/product/product_slug"
                                    imageSlug="images/one-piece.webp"
                                    description="Some quick example text to build on the card title and make up the bulk of the card's content."
                                />

                                <x-front.product.product-card
                                    displayPage="home"
                                    cardType="category"
                                    cardSize="3"
                                    cardTheme=""
                                    slug="/product/product_slug"
                                    imageSlug="images/op-hoodie.webp"
                                    description="Some quick example text to build on the card title and make up the bulk of the card's content."
                                />

                                <x-front.product.product-card
                                    displayPage="home"
                                    cardType="category"
                                    cardSize="3"
                                    cardTheme=""
                                    slug="/product/product_slug"
                                    imageSlug="images/rick-n-m-tees.webp"
                                    description="Some quick example text to build on the card title and make up the bulk of the card's content."
                                />

                                <x-front.product.product-card
                                    displayPage="home"
                                    cardType="category"
                                    cardSize="3"
                                    cardTheme=""
                                    slug="/product/product_slug"
                                    imageSlug="images/rick-n-m-tees.webp"
                                    description="Some quick example text to build on the card title and make up the bulk of the card's content."
                                />
                            </div> --}}

                        </div>
                    </div>

                </div>
            
            </div>

        </div>
    </div>
@endsection




@section('content-scripts')
    {{-- Used in the Sorting option dropdown --}}
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
@endsection
    



