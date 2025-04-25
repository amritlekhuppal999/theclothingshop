    
@extends('layouts.pages')

@section('content-css')
    <link rel="stylesheet" href="{{ asset('css/front-end/category.css') }}">
@endsection



@section('content')
    
    <!-- <div class="banner">
        @include('components.front.carousel')
    </div> -->

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
                        <div class="col-md-3">

                            <!-- SUB-CATEGORY -->
                            <div class="col-md-12">
                                <div class="card" style="">
                                    <div class="card-body">
                                        <p class="card-text"> SUB-CATEGORY </p>

                                        <div class="list-group list-group-flush">
                                            <label class="list-group-item cursor-pointer pl-4" style="border-top:none;">
                                                <input class="form-check-input me-1" type="checkbox" value="">
                                                First
                                            </label>

                                            <label class="list-group-item cursor-pointer pl-4" style="border-top:none;">
                                                <input class="form-check-input me-1" type="checkbox" value="">
                                                Second
                                            </label>

                                            <label class="list-group-item cursor-pointer pl-4" style="border-top:none;">
                                                <input class="form-check-input me-1" type="checkbox" value="">
                                                Third
                                            </label>

                                            <label class="list-group-item cursor-pointer pl-4" style="border-top:none;">
                                                <input class="form-check-input me-1" type="checkbox" value="">
                                                Fourth
                                            </label>

                                            <label class="list-group-item cursor-pointer pl-4" style="border-top:none;">
                                                <input class="form-check-input me-1" type="checkbox" value="">
                                                Fifth
                                            </label>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- THEME -->
                            <div class="col-md-12">
                                <div class="card" style="">
                                    <div class="card-body">
                                        <p class="card-text"> THEME </p>

                                        <div class="list-group list-group-flush">
                                            <label class="list-group-item cursor-pointer pl-4" style="border-top:none;">
                                                <input class="form-check-input me-1" type="checkbox" value="">
                                                First
                                            </label>

                                            <label class="list-group-item cursor-pointer pl-4" style="border-top:none;">
                                                <input class="form-check-input me-1" type="checkbox" value="">
                                                Second
                                            </label>

                                            <label class="list-group-item cursor-pointer pl-4" style="border-top:none;">
                                                <input class="form-check-input me-1" type="checkbox" value="">
                                                Third
                                            </label>

                                            <label class="list-group-item cursor-pointer pl-4" style="border-top:none;">
                                                <input class="form-check-input me-1" type="checkbox" value="">
                                                Fourth
                                            </label>

                                            <label class="list-group-item cursor-pointer pl-4" style="border-top:none;">
                                                <input class="form-check-input me-1" type="checkbox" value="">
                                                Fifth
                                            </label>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- SIZE -->
                            <div class="col-md-12">
                                <div class="card" style="">
                                    <div class="card-body">
                                        <p class="card-text"> SIZE </p>

                                        <div class="">
                                            <label class="btn btn-outline-secondary cursor-pointer"> XXL </label>
                                            <label class="btn btn-outline-secondary cursor-pointer"> XL </label>
                                            <label class="btn btn-outline-secondary cursor-pointer"> L </label>
                                            <label class="btn btn-outline-secondary cursor-pointer"> M </label>
                                            <label class="btn btn-outline-secondary cursor-pointer"> S </label>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- PRICE -->
                            <div class="col-md-12">
                                <div class="card" style="">
                                    <div class="card-body">
                                        <p class="card-text"> PRICE </p>

                                        <div class="list-group list-group-flush">
                                            <label class="list-group-item list-group-item-action cursor-pointer pl-4" aria-current="true" style="border-top:none;"> 
                                                <input class="form-check-input me-1" name="price" type="radio" value="">
                                                Rs. 599 To Rs. 1073
                                            </label>

                                            <label class="list-group-item list-group-item-action cursor-pointer pl-4" aria-current="true" style="border-top:none;"> 
                                                <input class="form-check-input me-1" name="price" type="radio" value="">
                                                Rs. 1074 To Rs. 1548
                                            </label>

                                            <label class="list-group-item list-group-item-action cursor-pointer pl-4" aria-current="true" style="border-top:none;"> 
                                                <input class="form-check-input me-1" name="price" type="radio" value="">
                                                Rs. 1074 To Rs. 1548
                                            </label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- PRODUCTS -->
                        <div class="col-md-9">

                            <div class="row">

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