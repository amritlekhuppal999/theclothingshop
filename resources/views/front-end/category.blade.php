    
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
                            <ul 
                                class="dropdown-menu dropdown-menu-dark" 
                                aria-labelledby="dropdownMenuButton2"
                                id="sort-button"  style="">
                                @php
                                    $sort_value = 0;
                                    if(request()->has('sort')){
                                        $sort_value = request('sort');
                                    }
                                @endphp

                                <li><a class="dropdown-item {{ $sort_value == 1 ? "active" : "" }}" href="#" data-value="1">A-Z</a></li> <!-- active -->
                                <li><a class="dropdown-item {{ $sort_value == 2 ? "active" : "" }}" href="#" data-value="2">Z-A</a></li> <!-- active -->
                                <li><a class="dropdown-item {{ $sort_value == 3 ? "active" : "" }}" href="#" data-value="3"> Price- High to Low </a></li>
                                <li><a class="dropdown-item {{ $sort_value == 4 ? "active" : "" }}" href="#" data-value="4"> Price- Low to High </a></li>
                                <li><a class="dropdown-item {{ $sort_value == 5 ? "active" : "" }}" href="#" data-value="5"> Newest </a></li>
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
                                {{-- wire:listen="filtersUpdated->triggerRefresh" --}}
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

    <script>

        // SORT PRODUCTS
        document.addEventListener('livewire:initialized', event=>{
            let sort_value = null;
            let sort_parameter = "sort";

            const loadProductElement = document.getElementById("livewire-load-product");
            const LIVEWIRE_PRODUCT_COMPONENT = Livewire.find(loadProductElement.getAttribute('wire:id'));
        
            let trigger_my_function = MyApp.debounce(set_query_param, 1000);

            const sort_options = document.getElementsByClassName("dropdown-item");

            push_selected_sortOption();

            const sort_button = document.getElementById('sort-button');

            sort_button.addEventListener('click', event=>{
                event.preventDefault();
                let element = event.target;

                if(element.className.includes("dropdown-item")){
                    remove_active();
                    sort_value = element.dataset.value;

                    element.classList.add("active");
                }
                
                // function to set url and push state
                trigger_my_function();
            });

            // remove active class
            function remove_active(){
                let sort_option_array = Array.from(sort_options);
                sort_option_array.map((element)=>{
                    element.classList.remove("active");
                });
            }

            // pushes already selected sub categories in the array
            function push_selected_sortOption(){
                // let sort_options = document.getElementsByClassName("dropdown-item");

                let sort_option_array = Array.from(sort_options);

                sort_option_array.map((element, index)=>{
                    if(element.className.includes("active")){
                        sort_value = element.dataset.value;
                        return;
                    }
                });
                //console.log("sort_value: ", sort_value);
            }

            // set values to query parameters upon selecting
            function set_query_param(){
                let sort_value_string = sort_value;

                let new_url = MyApp.appendQueryString(window.location.href, sort_parameter, sort_value_string);
                // console.log('new_url: ', new_url);
                history.pushState(null, null, new_url);

                livewireRerender()
            }

            //To reload/rerender the livewire component with new values
            function livewireRerender(){
                // LIVEWIRE_PRODUCT_COMPONENT.triggerRefresh();
                // LIVEWIRE_PRODUCT_COMPONENT.call('triggerRefresh');

                let sort = new URLSearchParams(window.location.search).get('sort')
                LIVEWIRE_PRODUCT_COMPONENT.updateSort(sort);
                // console.log(theme)
            }


            // Save remove from wishlist
            document.addEventListener('click', async event=>{
                let element = event.target;
                if(element.className.includes("favorite-btn")){
                    
                    toggleFavorite(element);
                    let addToWishlistBtn = element;
                    addToWishlistBtn.disabled = true;

                    const request_data = {
                        productId: addToWishlistBtn.dataset.product_id
                    };
                    const params = new URLSearchParams(request_data);

                    const request_options = {
                        method: 'GET',
                        // headers: {},
                        // body: JSON.stringify(request_data)
                    };

                    let route = '/add-to-wishlist?'; 
                    if(addToWishlistBtn.dataset.saved_in_wishlist == 1){
                        route = '/remove-from-wishlist?';

                    }
                    let url = route+params;

                    try{
                        let response = await fetch(url, request_options);

                        //console.log(response);
                        if(response.ok){
                            let response_data = await response.json();
                            //console.log(response_data);

                            if(response_data.code === 200){
                                toastr.success(response_data.message);                               
                            }

                            else {
                                toastr.error(response_data.message);
                                toggleFavorite(element);
                            }
                            

                            setTimeout(()=>{
                                if(response_data.reload) location.reload();
                            }, 800);
                        }

                        addToWishlistBtn.disabled = false;

                    }
                    catch(error){
                        console.error('Error:', error);
                        addToWishlistBtn.disabled = false;
                        toggleFavorite(element);
                    }
                }

                
            });

            // wishlist btn fn
            function toggleFavorite(button) {
                const icon = button.querySelector('i');
                const isActive = button.classList.contains('active');
                
                if (isActive) {
                    button.classList.remove('active');
                    icon.className = 'far fa-heart';
                } else {
                    button.classList.add('active');
                    icon.className = 'fas fa-heart';
                }
            }

        });
    </script>
@endsection
    



