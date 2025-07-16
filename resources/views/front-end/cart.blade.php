    
@extends('layouts.pages') 

@section('content-css')
    
    <link rel="stylesheet" href="{{ asset('css/front-end/category.css') }}">

    <style>
        .billing-side{
            width:80%; 
            margin-left: 44px;
        }
    </style>

    <style>
        .cart-container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 20px;
        }
        
        .cart-item {
            background: #f8f9fa;
            border-radius: 8px;
            padding: 20px;
            margin-bottom: 20px;
            border: 1px solid #e9ecef;
        }
        
        .product-image {
            width: 100%;
            max-width: 150px;
            height: auto;
            object-fit: cover;
            border-radius: 8px;
        }
        
        .product-title {
            color: #007bff;
            font-weight: 600;
            font-size: 1.2rem;
            margin-bottom: 5px;
        }
        
        .product-type {
            color: #6c757d;
            font-size: 0.9rem;
            margin-bottom: 10px;
        }
        
        .price-section {
            text-align: right;
        }
        
        .current-price {
            font-size: 1.3rem;
            font-weight: bold;
            color: #000;
        }
        
        .original-price {
            color: #6c757d;
            text-decoration: line-through;
            font-size: 0.9rem;
        }
        
        .mrp-text {
            font-size: 0.8rem;
            color: #6c757d;
        }
        
        .discount-text {
            color: #dc3545;
            font-weight: bold;
            font-size: 0.9rem;
        }
        
        .delivery-info {
            color: #6c757d;
            font-size: 0.9rem;
            margin-top: 10px;
        }
        
        .color-info {
            margin: 10px 0;
        }
        
        .color-label {
            font-weight: 600;
            color: #333;
        }
        
        .action-buttons {
            margin-top: 15px;
        }
        
        .btn-remove {
            color: #dc3545;
            background: none;
            border: none;
            text-decoration: none;
            font-size: 0.9rem;
        }
        
        .btn-remove:hover {
            color: #b02a37;
            text-decoration: underline;
        }
        
        .btn-wishlist {
            color: #007bff;
            background: none;
            border: none;
            text-decoration: none;
            font-size: 0.9rem;
            margin-left: 20px;
        }
        
        .btn-wishlist:hover {
            color: #0056b3;
            text-decoration: underline;
        }
        
        .cart-sidebar {
            position: sticky;
            top: 20px;
        }
        
        .cart-summary {
            background: #fff;
            border: 1px solid #e9ecef;
            border-radius: 8px;
            padding: 20px;
            margin-bottom: 20px;
        }
        
        .cart-title {
            font-size: 1.5rem;
            font-weight: bold;
            color: #333;
            margin-bottom: 20px;
        }
        
        .summary-row {
            display: flex;
            justify-content: space-between;
            margin-bottom: 10px;
            padding: 5px 0;
        }
        
        .summary-row.total {
            border-top: 1px solid #e9ecef;
            padding-top: 15px;
            margin-top: 15px;
            font-weight: bold;
            background: #f8f9fa;
            padding: 15px;
            margin-left: -20px;
            margin-right: -20px;
        }
        
        .discount-amount {
            color: #28a745;
        }
        
        .gst-amount {
            color: #dc3545;
        }
        
        .btn-checkout {
            width: 100%;
            padding: 12px;
            font-size: 1.1rem;
            font-weight: bold;
            background: #007bff;
            border: none;
            border-radius: 6px;
            color: white;
            margin-top: 20px;
        }
        
        .btn-checkout:hover {
            background: #0056b3;
        }
        
        .gift-wrap-section {
            margin-top: 20px;
            padding: 15px;
            background: #f8f9fa;
            border-radius: 6px;
        }
        
        .gift-wrap-checkbox {
            margin-right: 8px;
        }
        
        .gift-wrap-label {
            color: #dc3545;
            font-weight: 600;
        }
        
        .coupon-section, .voucher-section {
            margin-bottom: 15px;
        }
        
        .form-control {
            border-radius: 6px;
        }
        
        @media (max-width: 768px) {
            .cart-container {
                padding: 15px;
            }
            
            .product-image {
                max-width: 100px;
            }
            
            .product-title {
                font-size: 1.1rem;
            }
            
            .current-price {
                font-size: 1.2rem;
            }
            
            .cart-item {
                padding: 15px;
            }
            
            .action-buttons {
                margin-top: 10px;
            }
            
            .btn-wishlist {
                margin-left: 15px;
            }
        }
        
        @media (max-width: 576px) {
            .product-details {
                text-align: center;
                margin-top: 15px;
            }
            
            .price-section {
                text-align: center;
                margin-top: 15px;
            }
            
            .action-buttons {
                text-align: center;
            }
            
            .btn-wishlist {
                margin-left: 10px;
            }
        }
    </style>
@endsection


@php
    $itemDetailsArr = array(
        [
            "product_id"    => "1",
            "product_slug"    => "product_slug",
            "product_name"  =>  "Hulk",
            "product_category"  =>  "Sleeveless",
            "product_image"  =>  "images/op-hoodie.webp",
            "size"  =>  "L",
            "quantity"  =>  "1",
            "color" =>  "Green",
            "item_price" =>  "699",
            "item_discount" => "100",
            "delivery_details"  =>  array(
                "estimated_delivery" => "31 Oct",
                "delivery_status"   => ""
            )
        ],
        
        [
            "product_id"    => "2",
            "product_slug"    => "product_slug",
            "product_name"  =>  "Rick-N-Morty Tees",
            "product_category"  =>  "Oversized",
            "product_image"  =>  "images/rick-n-m-tees.webp",
            "size"  =>  "L",
            "quantity"  =>  "1",
            "color" =>  "Black",
            "item_price" =>  "699",
            "item_discount" => "100",
            "delivery_details"  =>  array(
                "estimated_delivery" => "2 Nov",
                "delivery_status"   => ""
            )
        ],

        [
            "product_id"    => "3",
            "product_slug"    => "product_slug",
            "product_name"  =>  "One Piece Shirts",
            "product_category"  =>  "Oversized",
            "product_image"  =>  "images/one-piece.webp",
            "size"  =>  "XL",
            "quantity"  =>  "3",
            "color" =>  "Grey",
            "item_price" =>  "699",
            "item_discount" => "100",
            "delivery_details"  =>  array(
                "estimated_delivery" => "5 Nov",
                "delivery_status"   => ""
            )
        ]
    );


    $billing_details = array(
        "cart_total" => "6084.00",
        "discount" =>  "600.00",
        "GST" => "611.54",
        "shipping_charges"  => "20",
        "total_amount" => "6093"
    );
@endphp



@section('content')
    
    

    <div class="content"> 
        <div class="container">
            <!-- <p>Page Content..</p> -->

            {{-- breadcrumb --}}
            <div class="row">
                <div class="col-md-6 offset-md-6 text-right mt-3 " > 
                    {{-- <h3>/cart</h3> --}}
                    
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="/home">Home</a></li>
                        <li class="breadcrumb-item active">cart</li>
                    </ol>
                </div>
            </div>

            <div class="row">
                <!-- Cart Items -->
                <div class="col-lg-8">
                    @foreach($cartData as $cartItems)
                        
                        <x-front.cart.cart-item  :cartItems="$cartItems" />

                    @endforeach
                    
                </div>

                <!-- Cart Summary Sidebar -->
                <div class="col-lg-4">
                    <x-front.cart.cart-summary-sidebar />
                </div>
            
            </div>


            
        </div>
    </div>
@endsection




@section('content-scripts')
    
@endsection