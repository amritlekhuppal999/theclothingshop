    
@extends('front-end.layouts.pages')    

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
    
    <style>
        .billing-side{
            width:80%; 
            margin-left: 44px;
        }
    </style>

    <div class="content"> 
        <div class="container">
            <!-- <p>Page Content..</p> -->

            
            <!-- Filter & Search Bar -->
            <div class="row">
                
                <div class="col-md-9 offset-md-3 mt-3 mb-2"> 
                    
                    <div class="row">

                        <!-- search bar -->
                        <x-front.search-bar 
                            page="orders" 
                            divClass="col-md-8"
                            placeholder="Search orders"
                            id="orders-search-bar"
                        />
                        
                        <!-- Order Duration Filter -->
                        <x-front.sort-button 
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
            
            
            <div class="row ">

                <!-- ORDER TYPE -->
                <div class="col-md-3">

                    <div class="row">
                        <div class="col-md-12">
                            <div class="card" style="">
                                <div class="card-body">
                                    <p class="card-text"> ORDER TYPE </p>
    
                                    <div class="list-group list-group-flush">
                                        <label class="list-group-item cursor-pointer pl-4" style="border-top:none;">
                                            <input class="form-check-input me-1" type="checkbox" value="">
                                            All Orders
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
    
                                        <!-- <label class="list-group-item cursor-pointer pl-4" style="border-top:none;">
                                            <input class="form-check-input me-1" type="checkbox" value="">
                                            Fifth
                                        </label> -->
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>

                <!-- ORDERS -->
                <div class="col-md-9">

                    @foreach($order_data_list as $orderRec)
                        
                        <x-front.orders.order-card :$orderRec />

                    @endforeach

                </div>
            </div>
        </div>
    </div>
@endsection




@section('content-scripts')
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
@endsection