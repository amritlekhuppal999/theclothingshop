    
@extends('layouts.pages')

@section('content-css')
    <link rel="stylesheet" href="{{ asset('css/front-end/orders.css') }}">

    
@endsection


@php
    $order_data_list = array(
        [
            "order_id" => "ORD123456789",
            "order_date"    => "27th Sept 2024",
            "order_total"   => "1585.00",
            "shipping_address"  =>  "Shipping Address",

            "download_invoice" => "",
            "status" => "Undelivered",
            "expected_delivery" =>  "30th Sept 2024",
            "delivered_on"  =>  "",
            
            "order_items" => array(
                [
                    "product_id"    =>  "1",
                    "product_slug"  =>  "product_slug",
                    "product_image"  =>  "/images/one-piece.webp",
                    "product_name"  =>  "Party Tees",
                    "category"  =>  "Oversized",
                    "size"  =>  "L",
                    "color" =>  "Brown",
                    "quantity"  =>  "5",
                    "status"    => "Undelivered",
                    "review_link"   =>  ""
                ],
                [
                    "product_id"    =>  "2",
                    "product_slug"  =>  "product_slug",
                    "product_image"  =>  "/images/op-hoodie.webp",
                    "product_name"  =>  "HULK TEEs",
                    "category"  =>  "Sleeveless",
                    "size"  =>  "L",
                    "color" =>  "Green",
                    "quantity"  =>  "1",
                    "status"    => "Undelivered",
                    "review_link"   =>  ""
                ],
                [
                    "product_id"    =>  "3",
                    "product_slug"  =>  "product_slug",
                    "product_image"  =>  "/images/rick-n-m-tees.webp",
                    "product_name"  =>  "Rick N Morty",
                    "category"  =>  "Te-Shirts",
                    "size"  =>  "XL",
                    "color" =>  "Black",
                    "quantity"  =>  "2",
                    "status"    => "Undelivered",
                    "review_link"   =>  ""
                ]
            )
        ],

        [
            "order_id" => "ORD223456789",
            "order_date"    => "19th Sept 2024",
            "order_total"   => "585.00",
            "shipping_address"  =>  "Shipping Address 2",

            "download_invoice" => "",
            "status" => "Delivered",
            "expected_delivery" =>  "",
            "delivered_on"  =>  "20th Sept 2024",
            
            "order_items" => array(
                [
                    "product_id"    =>  "3",
                    "product_slug"  =>  "product_slug",
                    "product_image"  =>  "/images/rick-n-m-tees.webp",
                    "product_name"  =>  "Rick N Morty",
                    "category"  =>  "Te-Shirts",
                    "size"  =>  "XL",
                    "color" =>  "Black",
                    "quantity"  =>  "2",
                    "status"    => "Undelivered",
                    "review_link"   =>  ""
                ]
            )
        ],

        [
            "order_id" => "ORD323456789",
            "order_date"    => "20th Sept 2024",
            "order_total"   => "1170.00",
            "shipping_address"  =>  "Shipping Address",

            "download_invoice" => "",
            "status" => "Cancelled",
            "expected_delivery" =>  "",
            "delivered_on"  =>  "",
            
            "order_items" => array(
                [
                    "product_id"    =>  "3",
                    "product_slug"  =>  "product_slug",
                    "product_image"  =>  "/images/op-hoodie.webp",
                    "product_name"  =>  "HULK TEEs",
                    "category"  =>  "Sleeveless",
                    "size"  =>  "XL",
                    "color" =>  "Green",
                    "quantity"  =>  "2",
                    "status"    => "Undelivered",
                    "review_link"   =>  ""
                ]
            )
        ]
    );
@endphp


@section('content')
    
    

    <div class="content"> 
        <div class="container">
            <!-- <p>Page Content..</p> -->

            
            <!-- Sort & Search Bar -->
            <div class="row">
                
                <div class="col-12 col-sm-12 col-md-12 col-lg-9 col-xl-9 offset-lg-3 offset-xl-3 mt-3 mb-2"> 
                    
                    <div class="row">

                        <!-- search bar -->
                        <x-front.search-bar 
                            page="orders" 
                            divClass="col-3 col-md-8"
                            placeholder="Search orders"
                            id="orders-search-bar"
                        />
                        
                        <!-- Order Duration Filter -->
                        <x-front.sort-button 
                            divClass="col-9 col-md-4"
                            page="orders" 
                            buttonText="Orders In Last 30 Days" >
                            <ul class="dropdown-menu dropdown-menu-dark" aria-labelledby="dropdownMenuButton2" style="">
                                <li><a class="dropdown-item active" href="#">Last 30 Days</a></li>
                                <li><a class="dropdown-item" href="#">Last 3 Months</a></li>
                                <li><a class="dropdown-item" href="#">2024</a></li>
                                <li><a class="dropdown-item" href="#"> 2023 </a></li>
                                <li><a class="dropdown-item" href="#"> 2024 </a></li>
                            </ul>
                        </x-front.sort-button>

                    </div>
                </div>
            </div>
            
            
            {{-- Order details & Filter --}}
            <div class="row ">

                <!-- ORDER FILTER -->
                <div class="col-lg-3 " id="order-filter-section">

                    <div class="card mb-0">
                        <div class="card-body">
                            <p class="card-text"> ORDER TYPE </p>

                            <div class="list-group list-group-flush opacity-75">
                                <label class="list-group-item cursor-pointer pl-4" style="border-top:none;">
                                    <input class="form-check-input me-1" type="checkbox" value="all">
                                    All Orders
                                </label>

                                <label class="list-group-item cursor-pointer pl-4" style="border-top:none;">
                                    <input class="form-check-input me-1" type="checkbox" value="confirmed">
                                    Confirmed
                                </label>

                                <label class="list-group-item cursor-pointer pl-4" style="border-top:none;">
                                    <input class="form-check-input me-1" type="checkbox" value="shipped">
                                    Shipped
                                </label>

                                <label class="list-group-item cursor-pointer pl-4" style="border-top:none;">
                                    <input class="form-check-input me-1" type="checkbox" value="delivered">
                                    Delivered
                                </label>

                                <label class="list-group-item cursor-pointer pl-4" style="border-top:none;">
                                    <input class="form-check-input me-1" type="checkbox" value="">
                                    Cancelled
                                </label>

                                <label class="list-group-item cursor-pointer pl-4" style="border-top:none;">
                                    <input class="form-check-input me-1" type="checkbox" value="">
                                    Returned
                                </label>

                                <label class="list-group-item cursor-pointer pl-4" style="border-top:none;">
                                    <input class="form-check-input me-1" type="checkbox" value="">
                                    Refunded
                                </label>

                            </div>
                        </div>
                    </div>
                </div>

                <!-- ORDERS -->
                <div class="col-md-12 col-lg-9">

                    @foreach($order_data_list as $orderRec)
                        
                        <x-front.orders.order-card :$orderRec />
                        {{-- <livewire:front.product.load-products :categorySlug="$category_slug" /> --}}
                        <livewire:front.orders.load-orders />

                    @endforeach

                </div>
            </div>

            {{-- Launch Filter BTN --}}
            <span 
                {{-- type="button" --}}
                class="filter-button" id="filter-overlay-btn"
                data-bs-toggle="modal" data-bs-target="#orderFilterModal">
                <i class="fas fa-filter"></i>
            </span>

            <!-- Button trigger modal -->
            {{-- <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">
            Launch demo modal
            </button> --}}

            <!-- Bootstrap Modal -->
            {{-- <x-modal id="orderFilterModal"></x-modal> --}}
            <x-modal id="orderFilterModal" />


        </div>
    </div>
@endsection




@section('content-scripts')
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

    <script>
        const filterBTN = document.getElementById('filter-overlay-btn');
        const FILTER_SECTION_MAIN = document.getElementById('order-filter-section');
        
        //const modalSection = document.getElementById('orderFilterModal');
        let modalContentSection = document.querySelector('#orderFilterModal .modal-content');

        filterBTN.addEventListener('click', (event)=>{
            moveFilterChild("to-modal");
        });

        function moveFilterChild(movement="to-modal"){
            if(movement == "to-modal"){

                while(FILTER_SECTION_MAIN.firstChild){
                    modalContentSection.appendChild(FILTER_SECTION_MAIN.firstChild);
                }
            }

            else {
                while(modalContentSection.firstChild){
                    FILTER_SECTION_MAIN.appendChild(modalContentSection.firstChild);
                }
            }
        }
    </script>
@endsection