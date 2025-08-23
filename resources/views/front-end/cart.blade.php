    
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
            display:block;
            /*align-items:center;*/
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
            color: white;
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
    $cartDataArr = $cartData->toArray();
    $cartSummary = $cartSummary->toArray();
@endphp



@section('content')
    
    

    <div class="content"> 
        <div class="container">
            <!-- <p>Page Content..</p> -->

            {{-- breadcrumb --}}
            <x-front.breadcrumb>
                <li class="breadcrumb-item"><a href="/home">Home</a></li>
                <li class="breadcrumb-item active">Cart</li>
            </x-front.breadcrumb>

            @if($cartData->isNotEmpty())
                
                <div class="row">
                    <!-- Cart Items -->
                    <div class="col-lg-8">
                        @foreach($cartDataArr as $cartItems)
                            
                            <x-front.cart.cart-item  :cartItems="$cartItems" />

                        @endforeach
                        
                    </div>

                    <!-- Cart Summary Sidebar -->
                    <div class="col-lg-4">
                        <x-front.cart.cart-summary-sidebar :cartSummary="$cartSummary" />
                    </div>
                
                </div>

            @else
                <div class="row">
                    <div class="col-lg-12 text-center">
                        <h4>Cart Empty!!</h4>
                        <img 
                            class="mb-2" 
                            src="{{ asset('images/arey-le-lo.jpg') }}" 
                            alt="" 
                            style="height:50vw; border-radius:10px;"
                        />
                        <h4>
                            Offer Jabar hai humhari... 
                            kuch le lo.. 
                            arey le lo.
                        </h4>
                    </div>
                </div>
            @endif


            
        </div>
    </div>
@endsection




@push('scripts') 

    <script>
        document.addEventListener('DOMContentLoaded', event=>{

            // CART ITEMS
                document.addEventListener('click', async e=>{
                    let element = e.target;
                    
                    // Remove from cart
                    if(element.className.includes("remove-item")){

                        if(!confirm("Remove item from cart?")){
                            return false;
                        }

                        let removeItemBtn = element;
                        removeItemBtn.disabled = true;

                        let dataObj = {
                            cartItemId: removeItemBtn.dataset.item_id
                        };
                        let route = '/remove-cart-item?';

                        try{
                            let response = await cartActions(route, dataObj);

                            //console.log(response);
                            if(response.ok){
                                let response_data = await response.json();
                                //console.log(response_data);

                                if(response_data.code === 200){
                                    toastr.success(response_data.message);

                                    document.getElementById(removeItemBtn.dataset.item_id).remove();
                                }

                                else toastr.error(response_data.message);

                                setTimeout(()=>{
                                    if(response_data.reload) location.reload();
                                }, 800);
                            }

                            removeItemBtn.disabled = false;

                        }
                        catch(error){
                            console.error('Error:', error);
                            removeItemBtn.disabled = false;
                        }                  

                    }

                    // Wishlist
                    if(element.className.includes("add-to-wishlist")){
                        if(!confirm("Add product to wishlist?")){
                            return false;
                        }

                        let addToWishlistBtn = element;
                        addToWishlistBtn.disabled = true;

                        let dataObj = {
                            productId: addToWishlistBtn.dataset.product_id
                        };
                        let route = '/add-to-wishlist?';

                        try{
                            let response = await cartActions(route, dataObj);

                            //console.log(response);
                            if(response.ok){
                                let response_data = await response.json();
                                //console.log(response_data);

                                if(response_data.code === 200){
                                    toastr.success(response_data.message);                               
                                }

                                else toastr.error(response_data.message);

                                setTimeout(()=>{
                                    if(response_data.reload) location.reload();
                                }, 800);
                            }

                            addToWishlistBtn.disabled = false;

                        }
                        catch(error){
                            console.error('Error:', error);
                            addToWishlistBtn.disabled = false;
                        }
                        
                    }
                });

                //ON CHANGE EVENT
                document.addEventListener('change', async e=>{
                    let element = e.target;

                    // QUANTITY
                    if (element.className.includes("item-quantity")) {

                        let changeItemEle = element;

                        let originalQty = changeItemEle.dataset.quantity;
                        let newQty = changeItemEle.value;

                        changeItemEle.disabled = true;

                        let dataObj = {
                            cartItemId: changeItemEle.dataset.item_id,
                            newQuantity: newQty
                        };
                        let route = '/cart-update-item-qty?';

                        try{
                            let response = await cartActions(route, dataObj);

                            //console.log(response);
                            if(response.ok){
                                let response_data = await response.json();
                                //console.log(response_data);

                                if(response_data.code === 200){
                                    toastr.success(response_data.message);
                                    
                                    // get cart item element using itemId for targated dom manupulation;
                                    let cartItemId = changeItemEle.dataset.item_id;
                                    let itemCardBlock = document.getElementById(cartItemId);
                                    update_item_prices(newQty, itemCardBlock);                               
                                }

                                else toastr.error(response_data.message);

                                setTimeout(()=>{
                                    if(response_data.reload) location.reload();
                                }, 800);
                            }

                            else{
                                changeItemEle.value = originalQty;
                            }

                            changeItemEle.disabled = false;

                        }
                        catch(error){
                            console.error('Error:', error);
                            changeItemEle.disabled = false;
                            changeItemEle.value = originalQty;
                        }
                    }
                });

                //cart action btn
                async function cartActions(route, dataObj){
                    
                    const request_data = dataObj;
                    const params = new URLSearchParams(request_data);

                    const request_options = {
                        method: 'GET',
                        // headers: {},
                        // body: JSON.stringify(request_data)
                    };

                    //let url = '/remove-cart-item?'+params;
                    let url = route+params;
                    return await fetch(url, request_options);

                    /*
                        returns promise that will be handled in the calling function
                    */
                }


                // update price section 
                function update_item_prices($new_quantity, element){
                    const priceSection = element.querySelector('.price-section');

                    const discountedPrice = priceSection.querySelector('.discounted-price');
                    const totalPrice = priceSection.querySelector('.total-price');
                    // const mrpText = priceSection.querySelector('.mrp-text');
                    const discountText = priceSection.querySelector('.price-difference');

                    //let ogCurrentPrice = discountedPrice.value;
                    //let ogOriginalPrice = totalPrice.value;
                    // let ogMrpText = mrpText.value;
                    // let ogDiscountText = discountText.value;

                    let singleItemPrice = priceSection.dataset.single_item_price;
                    let discountPercentage = priceSection.dataset.discount_percentage;

                    let new_total_price = parseInt($new_quantity) * parseFloat(singleItemPrice);


                    let discounted_amount = (discountPercentage/100) * new_total_price;
                    let new_discounted_price = new_total_price - discounted_amount;
                    //console.log(new_total_price, new_discounted_price); return false;
                    let price_difference = new_total_price - new_discounted_price;

                    discounted_amount = Math.round(discounted_amount*100) / 100 ;
                    new_discounted_price = Math.round(new_discounted_price*100) / 100 ;
                    price_difference = Math.round(price_difference*100) / 100 ;

                    discountedPrice.innerText = `₹ ${new_discounted_price}`;
                    totalPrice.innerText = `₹ ${new_total_price}`;

                    discountText.innerText = `₹ ${price_difference} OFF`;
                }
            // CART ITEMS END

            
            
            // CART ITEM SUMMARY

            // CART ITEM SUMMARY END

        });
    </script>
@endpush

{{-- @once @endonce --}}