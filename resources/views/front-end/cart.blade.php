    
@extends('front-end.layouts.pages')    

@section('content-css')
    <link rel="stylesheet" href="{{ asset('css/front-end/category.css') }}">
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
    
    <style>
        .billing-side{
            width:80%; 
            margin-left: 44px;
        }
    </style>

    <div class="content"> 
        <div class="container">
            <!-- <p>Page Content..</p> -->

            
            <div class="row ">

                <!-- display applied filters here, along with pagination if possible -->
                
                <!-- SORT OPTIONS -->
                <div class="col-md-6 offset-md-6 text-right mt-3 mb-2"> 
                    <h3>CART</h3>
                </div>

                <!-- ITEMS -->
                <div class="col-md-8">

                    @foreach($itemDetailsArr as $itemDetails)
                        
                        <x-front.cart.cart-item  :itemDetails="$itemDetails" />

                    @endforeach  

                </div>

                <!-- Billing Side -->
                <div class="col-md-4 ">
                    
                    <!-- Coupons and vouchers -->
                    <table class="table bg-white billing-side">
                        <tbody class="text text-danger small">
                            <tr>
                                <td colspan="2"> 
                                    <input type="text" name="coupon" class="form-control" placeholder="Apply Coupon" /> 
                                </td>
                            </tr>

                            <tr>
                                <td colspan="2"> 
                                    <input type="text" name="gift_voucher" class="form-control" placeholder="Gift Voucher" /> 
                                </td>
                            </tr>

                            <tr>
                                {{-- <td> Gift Wrap </td> --}}
                                <td>
                                    <div class="custom-control custom-checkbox">
                                        <input class="custom-control-input " name="" type="checkbox" id="customCheckbox2" checked="">
                                        <label for="customCheckbox2" class="custom-control-label mt-1"> Gift Wrap </label>
                                    </div>
                                </td>
                            </tr>
                        </tbody>
                    </table>

                    <!-- Billing Details -->
                    <span class="text-muted mt-3 billing-side"> Billing Details </span>

                    <!-- Billing Details TABLE -->
                    <table class="table bg-white billing-side">
                        <tbody class="text-muted small">
                            <tr>
                                <td> 
                                    Cart Total 
                                    <!-- (Excl. of all taxes) -->
                                </td>
                                <td class="text-right text-bold"> ₹ 6084.46 </td>
                            </tr>

                            <tr>
                                <td> Discount </td>
                                <td class="text-right text-green"> - ₹ 600.00 </td>
                            </tr>

                            <tr>
                                <td> GST </td>
                                <td class="text-right text-red"> ₹ 611.54 </td>
                            </tr>

                            <tr>
                                <td> Shipping Charges </td>
                                <td class="text-right"> ₹ 0 </td>
                            </tr>

                            <tr class="table-secondary text-bold">
                                <td> Total Amount </td>
                                <td class="text-right"> ₹ 6096.00 </td>
                            </tr>
                        </tbody>
                    </table>

                    <!-- Checkout BTN -->
                    <button class="btn btn-primary billing-side" id="checkout-btn"> Checkout </button>
                    
                </div>
            </div>
        </div>
    </div>
@endsection




@section('content-scripts')
    
@endsection