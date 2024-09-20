    
@extends('front-end.layouts.pages')    

@section('content-css')
    <link rel="stylesheet" href="{{ asset('css/front-end/category.css') }}">
@endsection



@section('content')
    
    <!-- <div class="banner">
        @include('components.front.carousel')
    </div> -->

    <div class="content"> 
        <div class="container">
            <!-- <p>Page Content..</p> -->

            
            <div class="row mb-5">

                <!-- display applied filters here, along with pagination if possible -->
                
                <!-- SORT OPTIONS -->
                <div class="col-md-6 offset-md-6 text-right mt-3 mb-2"> 
                    <h3>CART</h3>
                </div>

                <!-- ITEMS -->
                <div class="col-md-7">
                    
                    <!-- Item 1 -->
                    <div class="card mb-3" style="">
                        <div class="row g-0">

                            <!-- Product Image -->
                            <div class="col-md-3">
                                <img 
                                    src="{{ asset('images/op-hoodie.webp') }}" 
                                    class="img-fluid rounded-start" 
                                    alt="..."
                                />
                            </div>
                            
                            <!-- Product Details -->
                            <div class="col-md-9 pt-3">
                                
                                <div class="row">
                                    
                                    <!-- Product & category name -->
                                    <div class="col-md-6">
                                        <h5>
                                            <a href="/product/product_slug">Hulk</a>
                                        </h5>
                                        
                                        <!-- category name -->
                                        <p class="text-muted "> Sleeveless </p>

                                        <!-- Size & Quantity -->
                                        <div class="d-flex">
                                            <!-- Size -->
                                            <select name="" id="" class="form-control mr-2">
                                                @for ($i=0; $i<10; $i++)
                                                    <option value="{{$i}}">Size {{$i}}</option>
                                                @endfor
                                            </select>

                                            <!-- Quantity -->
                                            <select name="" id="" class="form-control">
                                                @for ($i=1; $i<=10; $i++)
                                                    <option value="{{$i}}">Quantity {{$i}}</option>
                                                @endfor
                                            </select>
                                        </div>

                                        <!-- <div class="clearfix"></div> -->
                                    </div>

                                    <!-- Price breakdown -->
                                    <div class="col-md-6 text-right pr-3 text-muted small">
                                        <div> ₹ 699  <strike>₹ 1299</strike>  </div>
                                        <div> MRP incl. of all taxes </div>
                                        <div> ₹ 600 OFF </div>
                                    </div>

                                    

                                    <!-- Estimated delivery -->
                                    <div class="col-md-12 mt-3 small"> 
                                        <span class="text-muted">Estimated Delivery by </span>
                                        <b>25 Sep</b> 
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                     
                    <!-- Item 2 -->
                    <div class="card mb-3" style="">
                        <div class="row g-0">

                            <!-- Product Image -->
                            <div class="col-md-3">
                                <img 
                                    src="{{ asset('images/rick-n-m-tees.webp') }}" 
                                    class="img-fluid rounded-start" 
                                    alt="..."
                                />
                            </div>
                            
                            <!-- Product Details -->
                            <div class="col-md-9 pt-3">
                                
                                <div class="row">
                                    
                                    <!-- Product & category name -->
                                    <div class="col-md-6">
                                        <h5>
                                            <a href="/product/product_slug">Rick-N-Morty Tees</a>
                                        </h5>
                                        
                                        <!-- category name -->
                                        <p class="text-muted "> Sleeveless </p>

                                        <!-- Size & Quantity -->
                                        <div class="d-flex">
                                            <!-- Size -->
                                            <select name="" id="" class="form-control mr-2">
                                                @for ($i=0; $i<10; $i++)
                                                    <option value="{{$i}}">Size {{$i}}</option>
                                                @endfor
                                            </select>

                                            <!-- Quantity -->
                                            <select name="" id="" class="form-control">
                                                @for ($i=1; $i<=10; $i++)
                                                    <option value="{{$i}}">Quantity {{$i}}</option>
                                                @endfor
                                            </select>
                                        </div>

                                        <!-- <div class="clearfix"></div> -->
                                    </div>

                                    <!-- Price breakdown -->
                                    <div class="col-md-6 text-right pr-3 text-muted small">
                                        <div> ₹ 699  <strike>₹ 1299</strike>  </div>
                                        <div> MRP incl. of all taxes </div>
                                        <div> ₹ 600 OFF </div>
                                    </div>

                                    

                                    <!-- Estimated delivery -->
                                    <div class="col-md-12 mt-3 small"> 
                                        <span class="text-muted">Estimated Delivery by </span>
                                        <b>25 Sep</b> 
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>

                <!-- Place Order -->
                <div class="col-md-4 ml-5">
                    
                    <!-- <ul class="list-group">
                        <li class="list-group-item">Apply Coupon</li>
                        <li class="list-group-item">Gift Voucher</li>
                        <li class="list-group-item">Gift Wrap</li>
                    </ul> -->

                    <!-- Coupons and vouchers -->
                    <table class="table bg-white" style="width:90%;">
                        <tbody class="text-muted ">
                            <tr>
                                <td> Apply Coupon </td>
                            </tr>

                            <tr>
                                <td> Gift Voucher </td>
                            </tr>

                            <tr>
                                <td> GST </td>
                            </tr>

                            <tr>
                                <td> Gift Wrap </td>
                            </tr>
                        </tbody>
                    </table>

                    <!-- Billing Details -->
                    <span class="text-muted mt-3" style="display:block;"> Billing Details </span>

                    <!-- Billing Details TABLE -->
                    <table class="table bg-white" style="width:90%;">
                        <tbody class="">
                            <tr>
                                <td> Cart Total (Excl. of all taxes) </td>
                                <td class="text-right"> ₹ 6084.46 </td>
                            </tr>

                            <tr>
                                <td> Discount </td>
                                <td class="text-right"> ₹ 600.00 </td>
                            </tr>

                            <tr>
                                <td> GST </td>
                                <td class="text-right"> ₹ 611.54 </td>
                            </tr>

                            <tr>
                                <td> Shipping Charges </td>
                                <td class="text-right"> ₹ 0 </td>
                            </tr>

                            <tr class="table-secondary">
                                <td> Total Amount </td>
                                <td class="text-right"> ₹ 6096.00 </td>
                            </tr>
                        </tbody>
                    </table>

                    <!-- Place Order BTN -->
                    <button class="btn btn-primary" style="width: 90%;"> Place Order </button>
                    
                </div>
            </div>
        </div>
    </div>
@endsection




@section('content-scripts')
    
@endsection