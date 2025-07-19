    
@extends('layouts.pages')

@section('content-css')
    <link rel="stylesheet" href="{{ asset('css/front-end/wishlist.css') }}">
@endsection



@section('content')
    
    {{-- <div class="banner">
        @include('components.front.carousel')
    </div> --}}

    <div class="content"> 
        <div class="container">
            <!-- <p>Page Content..</p> -->

            
            <div class="row">

                <!-- <div class="col-md-12 mt-3"></div> -->
                <div class="col-md-9 offset-md-3 mt-3 mb-2">
                    <div class="row">
                        <!-- search bar -->
                        {{-- <x-front.search-bar 
                            page="wishlist"
                            divClass="col-md-8"
                            placeholder="Search wishlist"
                            id="wishlist-search-bar"
                        /> --}}
                        
                        <!-- Order Duration Filter -->
                        <x-front.sort-button 
                            page="wishlist" 
                            class="offset-md-8"
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

                    <livewire:front.wishlist.wishlist-items />

                </div>
            </div>
        </div>
    </div>
@endsection




@section('content-scripts')
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

    <script>
        document.addEventListener('livewire:initialized', event=>{
            loadWishlistElement = document.getElementById('livewire-load-wishlist-items');

            const LIVEWIRE_WISHLIST_COMPONENT = Livewire.find(loadWishlistElement.getAttribute('wire:id'));

            loadWishlistElement.addEventListener('click', async e=>{
                let element = e.target;

                if(element.className.includes("remove-item")){
                    e.preventDefault();
                    if(!confirm("Remove seletec item?")){
                        return false;
                    }

                    let removeBtn = element;
                    removeBtn.disabled = true;

                    const request_data = {
                        productId: removeBtn.dataset.product_id
                    };
                    const params = new URLSearchParams(request_data);

                    const request_options = {
                        method: 'GET',
                        // headers: {},
                        // body: JSON.stringify(request_data)
                    };

                    let url = '/remove-from-wishlist?'+params;
                    //console.log(url);

                    try{
                        let response = await fetch(url, request_options);

                        //console.log(response);
                        if(response.ok){
                            let response_data = await response.json();
                            //console.log(response_data);

                            if(response_data.code === 200){
                                toastr.success(response_data.message);      

                                LIVEWIRE_WISHLIST_COMPONENT.refresh();
                            }

                            else toastr.error(response_data.message);
                            

                            setTimeout(()=>{
                                if(response_data.reload) location.reload();
                            }, 800);
                        }

                        removeBtn.disabled = false;

                    }
                    catch(error){
                        console.error('Error:', error);
                        removeBtn.disabled = false;
                    }
                }
            });
        });
    </script>

@endsection