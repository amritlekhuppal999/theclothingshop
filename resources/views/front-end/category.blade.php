    
@extends('layouts.pages')

@section('content-css')
    <link rel="stylesheet" href="{{ asset('css/front-end/category.css') }}">
    
    <link rel="stylesheet" href="{{ asset('css/front-end/category-load-product.css') }}">
    <link rel="stylesheet" href="{{ asset('css/front-end/category-filter-section.css') }}">

      
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
                <div class="col-md-12 mt-2 mb-2">

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

            
            <!-- PRODUCT & FILTERS -->
            <div class="row">
            
                <div class="col-md-12">

                    <div class="row">

                        {{-- WE WILL USE SOME JS MAGIC TO MAKE IT MOVE the filters IN MOBILE AND DESKTOP VIEW --}}

                        <!-- FILTERS -->
                        <div class="col-12 col-md-3" id="filter-section">

                            <div class="filter-sub-section ">
                            
                                <!-- SUB-CATEGORY -->
                                <x-front.category.sub-category-filter :categorySlug="$category_slug" />

                                <!-- THEME -->
                                <x-front.category.theme-filter />

                                <!-- Attribute -->
                                <x-front.category.attribute-filter />
                                
                                <!-- PRICE -->
                                <x-front.category.price-filter />

                                {{-- <div class="filter-sub-section-filler ">
                                    <!-- Lets see whats happening here...
                                    So we made a sub-section and made it sticky so that the filter section does not fly off to 
                                    oblivion when page is scrolled.
                                    Next we added this filler div with some height because upon scrolling new items were loaded
                                    preventing few parts of price filter never surfacing as scrolling further loaded more and
                                    it kept the part hidden. Adding this filler allowed us to scroll further.
                                    The scrollbar is hidden to make it look not UGLY -->
                                </div> --}}
                            </div>
                        </div>

                        <!-- PRODUCTS -->
                        <div class="col-12 col-lg-9">

                            <livewire:front.product.load-products :categorySlug="$category_slug" />
                
                        </div>
                    </div>

                </div>
            
            </div>


            <!-- Overlay Category -->
            <div class="overlay-category pl-4 pr-4" id="overlay-category" style="overflow-y:auto;">
                {{-- <div class="overlay-category-content" onclick="">
                    <button class="close-overlay-category-btn">&times;</button>
                </div> --}}
                
                {{-- filter element is loaded here --}}
                <div 
                    class="filter-overlay-section" 
                    id="filter-overlay-section"
                    style="">
                
                </div>
            </div>


            {{-- Launch Filter BTN --}}
            <span 
                class="filter-button" 
                id="filter-overlay-btn"
                type="button">
                <i class="fas fa-filter"></i>
            </span>

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

                    console.log(url);

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
                            

                            /*
                            setTimeout(()=>{
                                if(response_data.reload) location.reload();
                            }, 800);
                            */
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

        
        // OVERLAY FUNCTIONS
        document.addEventListener('DOMContentLoaded', e=>{
            
            //console.log(document.getElementById("filter-overlay-btn"));
            const FILTER_OVERLAY_BTN = document.getElementById("filter-overlay-btn");

            let FILTER_SECTION_MAIN = document.getElementById("filter-section");
            let FILTER_OVERLAY_SECTION = document.getElementById("filter-overlay-section");

            FILTER_OVERLAY_BTN.addEventListener('click', event=>{
                openOverlay();
            });

            document.addEventListener('keydown', function(event) {
                if (event.key === 'Escape') {
                    closeOverlay();
                }
            });

            // close overlay when clicking anywhere on the body
            document.getElementById("overlay-category").addEventListener('click', event=>{ 
                closeOverlay(event);
             });

            /*
            document.querySelector('.close-overlay-category-btn')
                    .addEventListener('click', event=>{
                event.stopPropagation();
                closeOverlay(event);
            });
            */

            // Prevent scrolling when overlay is open
            document.getElementById('overlay-category').addEventListener('wheel', function(e) {
                //e.preventDefault();
            });


            // launch category page overlay
            function openOverlay() {
                document.getElementById('overlay-category').classList.add('active');
                document.body.style.overflow = 'hidden';

                moveFilterChild("to-overlay");
            }

            // close category page overlay
            function closeOverlay(event) {
                
                // if ( event && event.target !== document.getElementById('overlay-category') ) return;
                if ( event.target !== document.getElementById('overlay-category') ) return;
                
                document.getElementById('overlay-category').classList.remove('active');
                document.body.style.overflow = 'auto';

                moveFilterChild("from-overlay");
            }
            

            function moveFilterChild(movement="to-overlay"){
                if(movement == "to-overlay"){

                    while(FILTER_SECTION_MAIN.firstChild){
                        FILTER_OVERLAY_SECTION.appendChild(FILTER_SECTION_MAIN.firstChild);
                    }
                }

                else {
                    while(FILTER_OVERLAY_SECTION.firstChild){
                        FILTER_SECTION_MAIN.appendChild(FILTER_OVERLAY_SECTION.firstChild);
                    }
                }
            }
        });
    </script>
@endsection
    



