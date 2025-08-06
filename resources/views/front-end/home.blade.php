    
@extends('layouts.pages')    

@section('content-css')
    <link rel="stylesheet" href="{{ asset('css/front-end/homepage.css') }}">
@endsection


@section('content')
    
    <div class="banner" id="load-carousel">
        <x-front.carousel />
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
                <div id="the-big-three">
                    {{-- Dummy load (Actual thing is loaded using JS) --}}
                    <x-front.home.featured-big-three />
                </div>

                <!-- Remaining Categories -->
                <div id="the-remaining-featured-category" >
                    {{-- <x-front.home.featured-remaining-category /> --}}
                </div>

            </div>

            <!-- NEW ADDITIONS / NEW ARRIVALS -->
            <div class="row" id="new-additions-section" >
                <div class="col-md-12 text-center mt-5 mb-3">
                    <h3>NEW ADDITIONS</h3>
                </div>

                <div id="new-additions"></div>

                {{-- <x-front.product.product-card
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
                /> --}}
            </div>

            <!-- BEST SELLING -->
            <div class="row" id="best-sellers-section" >
                <div class="col-md-12 text-center mt-5 mb-3">
                    <h3>BEST SELLING</h3>
                </div>

                <div id="best-sellers" ></div>

                {{-- <x-front.product.product-card
                    displayPage="home"
                    cardType="best-sellers"
                    cardSize="3"
                    cardTheme="dark"
                    slug=""
                    imageSlug="images/bs-popoye-tees.webp"
                    description="Some quick example text to build on the card title and make up the bulk of the card's content."
                />

                <x-front.product.product-card
                    displayPage="home"
                    cardType="best-sellers"
                    cardSize="3"
                    cardTheme=""
                    slug=""
                    imageSlug="images/bs-star-wars-pant.webp"
                    description="Some quick example text to build on the card title and make up the bulk of the card's content."
                />

                <x-front.product.product-card
                    displayPage="home"
                    cardType="best-sellers"
                    cardSize="3"
                    cardTheme=""
                    slug=""
                    imageSlug="images/bs-st-fit.webp"
                    description="Some quick example text to build on the card title and make up the bulk of the card's content."
                />

                <x-front.product.product-card
                    displayPage="home"
                    cardType="best-sellers"
                    cardSize="3"
                    cardTheme=""
                    slug=""
                    imageSlug="images/bs-straight-fit.webp"
                    description="Some quick example text to build on the card title and make up the bulk of the card's content."
                /> --}}
            </div>

            <!-- POP CULTURE / SHOP BY FANDOM -->
            <div class="row" id="pop-culture-section" >
                <div class="col-md-12 text-center mt-5 mb-3">
                    <h3>POP CULTURE</h3>
                </div>

                <div id="pop-culture"></div>

                {{-- <div class="col-md-3">
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
                </div> --}}
            </div>
        </div>
    </div>
@endsection




@section('content-scripts')
    <script>

        window.onload = ()=>{
            // Mapping divs to functions
            const actions = {
                "load-carousel": () => { load_banner_carousel(); },
                "the-big-three": () => { load_featured_category(); },
                "the-remaining-featured-category": () => { load_remaining_featured_category(); },
                "new-additions": () => { load_featured_products("new-arrivals", "new-additions"); },
                "best-sellers": () => { load_featured_products("best-sellers", "best-sellers"); },
                "pop-culture": () => { load_featured_products("pop-culture", "pop-culture"); },
            };

            // array to store section ids
            const section_array = [
                "load-carousel", 
                "the-big-three", 
                "the-remaining-featured-category",
                "new-additions",
                "best-sellers",
                "pop-culture",
            ];

            scrollObserve(actions, section_array);

            // load_banner_carousel();
            // function to load ADDED banner images
            async function load_banner_carousel(){

                let LOAD_CAROUSEL = document.getElementById('load-carousel');

                const request_options = {
                    method: 'GET',
                    // headers: {},
                    // body: JSON.stringify(request_data)
                };

                let url = `get-banner-carousel`;
                // console.log(url);

                try{
                    let response = await fetch(url, request_options);
                    //console.log(response);
                    // let response_data = await response.json();
                    // console.log(response_data);
                    //return response_data;
                    
                    if(!response.ok){
                        throw new Error(`HTTP error! status: ${response.status}`);
                    }

                    const html = await response.text();
                    //console.log(html);
                    LOAD_CAROUSEL.innerHTML = html;
                }

                catch(error){
                    console.error('Error:', error);
                }
            }

            // load_featured_category();
            async function load_featured_category(){

                let FEATURED_THREE = document.getElementById('the-big-three');

                const request_options = {
                    method: 'GET',
                    // headers: {},
                    // body: JSON.stringify(request_data)
                };

                let url = `get-featured-category`;
                // console.log(url);

                try{
                    let response = await fetch(url, request_options);
                    //console.log(response);
                    // let response_data = await response.json();
                    // console.log(response_data);
                    //return response_data;
                    
                    if(!response.ok){
                        throw new Error(`HTTP error! status: ${response.status}`);
                    }

                    const html = await response.text();
                    // console.log(html);
                    FEATURED_THREE.innerHTML = html;
                }

                catch(error){
                    console.error('Error:', error);
                }
            }

            //load_remaining_featured_category();
            async function load_remaining_featured_category(){

                let FEATURED_REMAINING = document.getElementById('the-remaining-featured-category');

                const request_options = {
                    method: 'GET',
                    // headers: {},
                    // body: JSON.stringify(request_data)
                };

                let url = `get-remaining-featured-category`;
                // console.log(url);

                try{
                    let response = await fetch(url, request_options);
                    //console.log(response);
                    // let response_data = await response.json();
                    // console.log(response_data);
                    //return response_data;
                    
                    if(!response.ok){
                        throw new Error(`HTTP error! status: ${response.status}`);
                    }

                    const html = await response.text();
                    //console.log(html);
                    FEATURED_REMAINING.innerHTML = html;
                }

                catch(error){
                    console.error('Error:', error);
                }
            }

            /*
            load_featured_products("new-arrivals", "new-additions");
            load_featured_products("best-sellers", "best-sellers");
            load_featured_products("pop-culture", "pop-culture");
            */
            async function load_featured_products(feature_group, loadout_id){

                let LOADOUT_POINT = document.getElementById(loadout_id);

                // let parent_element = LOADOUT_POINT.parentElement;
                // parent_element.hidden = false;

                const request_options = {
                    method: 'GET',
                    // headers: {},
                    // body: JSON.stringify(request_data)
                };

                let url = `get-featured-products?feature_group=${feature_group}`;
                //console.log(url);
                (feature_group == "best-sellers") ? console.log(url) : "";
                //return false;

                try{
                    let response = await fetch(url, request_options);
                    //console.log(response);
                    // let response_data = await response.json();
                    // console.log(response_data);
                    //return response_data;
                    
                    if(!response.ok){
                        throw new Error(`HTTP error! status: ${response.status}`);
                    }

                    const html = await response.text();
                    (feature_group == "best-sellers") ? console.log(html) : "";
                    LOADOUT_POINT.innerHTML = html;
                }

                catch(error){
                    console.error('Error:', error);
                }
            }


            // Function to trigger any action when scrolled into view
            function scrollObserve(actions, section_array){
                
                const observer = new IntersectionObserver((entries, observer) => {
                    entries.forEach(entry => {
                        if (entry.isIntersecting) {
                            const id = entry.target.id;
                            if (actions[id]) {
                                actions[id](); // Run the correct function
                                observer.unobserve(entry.target); // Stop watching this element after triggering
                            }
                        }
                    });
                }, {
                    threshold: 0.5  // Only trigger when at least 50% of the div is visible
                });

                //return observe;

                section_array.forEach((div_id)=>{
                    const ele = document.getElementById(div_id);
                    if(ele) 
                        observer.observe(ele);
                });
            }


            let LOADER_TEXT_ELE = document.getElementsByClassName('animate-loading-text');
            let loaderTextArray = Array.from(LOADER_TEXT_ELE);
            loaderTextArray.forEach((element)=>{
                new TextAnimator(element);
            });
        }
    </script>
@endsection