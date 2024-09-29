    
@extends('front-end.layouts.pages')    

@section('content-css')
    <link rel="stylesheet" href="{{ asset('css/front-end/orders.css') }}">
@endsection



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
                        <div class="col-md-8">
                            <input class="form-control" type="search" placeholder="Search orders" id="orders-search-bar" >
                        </div>
                        
                        <!-- Order Duration Filter -->
                        <div class="col-md-4 text-right">

                            <div class="dropdown">
                                <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton2" data-bs-toggle="dropdown" aria-expanded="false">
                                    Orders In Last 30 Days
                                </button>
                                <ul class="dropdown-menu dropdown-menu-dark" aria-labelledby="dropdownMenuButton2" style="">
                                    <li><a class="dropdown-item active" href="#">Last 30 Days</a></li>
                                    <li><a class="dropdown-item" href="#">Last 3 Months</a></li>
                                    <li><a class="dropdown-item" href="#">2024</a></li>
                                    <li><a class="dropdown-item" href="#"> 2023 </a></li>
                                    <li><a class="dropdown-item" href="#"> 2024 </a></li>
                                </ul>
                            </div>
                        </div>
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

                    <!-- Order 1 -->    
                    <div class="card card-success card-outline">
                        
                        <!-- ORDER card header -->
                        <div class="card-header">
                            <div class="row small">
                                <div class="col-md-6 d-flex ">
                                    <div class="mr-3">
                                        <span class="text-muted">ORDER PLACED</span> 
                                        <span class="d-block text-muted text-bold"> 27th Sept 2024</span>
                                    </div>

                                    <!-- Total Amount -->
                                    <div class="mr-3">
                                        <span class="text-muted">TOTAL</span>
                                        <span class="d-block text-muted text-bold">₹1,585.00</span>
                                    </div>

                                    <div class="mr-3">
                                        <span class="text-muted">SHIP TO</span>
                                        <span class="d-block text-muted text-bold">Shipping Address</span>
                                    </div>
                                </div>
                                
                                <div class="col-md-6 text-right"> 
                                    <span class="text-muted">Order Id #</span>
                                    <div class="d-block">
                                        <a href="#">View Order Details</a> |
                                        <a href="#">Invoice</a>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- ORDER card body -->
                        <div class="card-body">
                            <div class="row">

                                <div class="col-md-12 mb-3">
                                    <h5 class="card-text text-success">
                                        Arriving on 30th Sept 2024
                                    </h5>
                                </div>
                                
                                <!-- Order Item 1 -->
                                <div class="col-md-12">
                                    <div class="card mb-3" style="">
                                        <div class="row g-0">
                                            <div class="col-md-2">
                                                <a href="/product/product_slug">
                                                    <img 
                                                        src="http://127.0.0.1:8000/images/one-piece.webp" 
                                                        class="img-fluid rounded-start" 
                                                        alt="..." 
                                                        style="height:167px;"
                                                    />
                                                    
                                                </a>
                                            </div>
                                            <div class="col-md-8">
                                                <div class="card-body">
                                                    <h5 class="card-text">
                                                        <a href="/product/product_slug">Party Tees</a>    
                                                    </h5>
                                                    <h6 class="card-subtitle mb-2 text-muted">Oversized</h6>
                                                    
                                                    <div class="text-muted small">
                                                        <span>Size: L</span> | <span>Qty: 5</span>
                                                    </div>

                                                    <p class="card-text">
                                                        <small class="text-muted">Status: </small>
                                                        <small class="text-muted">Undelivered</small>
                                                    </p>

                                                    <button type="button" class="btn btn-secondary btn-xs" class="write-product-review">
                                                        Write Review
                                                    </button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!-- Order Item 2 -->
                                <div class="col-md-12">
                                    <div class="card mb-3" style="">
                                        <div class="row g-0">
                                            <div class="col-md-2">
                                                <a href="/product/product_slug">
                                                    <img 
                                                        src="{{ asset('images/op-hoodie.webp') }}" 
                                                        class="img-fluid rounded-start" 
                                                        alt="..." 
                                                        style="height:167px;"
                                                    />
                                                    
                                                </a>
                                            </div>
                                            <div class="col-md-8">
                                                <div class="card-body">
                                                    <h5 class="card-text">
                                                        <a href="/product/product_slug">HULK TEEs</a>    
                                                    </h5>
                                                    <h6 class="card-subtitle mb-2 text-muted">Sleeveless</h6>
                                                    
                                                    <div class="text-muted small">
                                                        <span>Size: L</span> | <span>Qty: 1</span>
                                                    </div>

                                                    <p class="card-text">
                                                        <small class="text-muted">Status: </small>
                                                        <small class="text-muted">Undelivered</small>
                                                    </p>

                                                    <button type="button" class="btn btn-secondary btn-xs" class="write-product-review">
                                                        Write Review
                                                    </button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!-- Order Item 3 -->
                                <div class="col-md-12">
                                    <div class="card mb-3" style="">
                                        <div class="row g-0">
                                            <div class="col-md-2">
                                                <a href="/product/product_slug">
                                                    <img 
                                                        src="{{ asset('images/rick-n-m-tees.webp') }}" 
                                                        class="img-fluid rounded-start" 
                                                        alt="..." 
                                                        style="height:167px;"
                                                    />
                                                </a>                                                
                                            </div>
                                            <div class="col-md-8">
                                                <div class="card-body">
                                                    <h5 class="card-text">
                                                        <a href="/product/product_slug">Rick N Morty</a>    
                                                    </h5>
                                                    <h6 class="card-subtitle mb-2 text-muted">Te-Shirts</h6>
                                                    
                                                    <div class="text-muted small">
                                                        <span>Size: XL</span> | <span>Qty: 2</span>
                                                    </div>

                                                    <p class="card-text">
                                                        <small class="text-muted">Status: </small>
                                                        <small class="text-muted">Undelivered</small>
                                                    </p>

                                                    <button type="button" class="btn btn-secondary btn-xs" class="write-product-review">
                                                        Write Review
                                                    </button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- ORDER card footer -->
                        <div class="card-footer">
                            <button type="button" class="btn btn-sm btn-warning text-white">Track</button>
                            <button type="button" class="btn btn-sm btn-default text-secondary">View or Edit Order</button>
                            <button type="button" class="btn btn-sm btn-secondary">Feedback</button>
                        </div>
                    </div>

                    <!-- Order 2 (EXAMPLE: DELIVERED) -->    
                    <div class="card card-secondary card-outline">
                        
                        <!-- ORDER card header -->
                        <div class="card-header">
                            <div class="row small">
                                <div class="col-md-6 d-flex ">
                                    <div class="mr-3">
                                        <span class="text-muted">ORDER PLACED</span> 
                                        <span class="d-block text-muted text-bold"> 19th Sept 2024</span>
                                    </div>

                                    <!-- Total Amount -->
                                    <div class="mr-3">
                                        <span class="text-muted">TOTAL</span>
                                        <span class="d-block text-muted text-bold">₹1,585.00</span>
                                    </div>

                                    <div class="mr-3">
                                        <span class="text-muted">SHIP TO</span>
                                        <span class="d-block text-muted text-bold">Shipping Address</span>
                                    </div>
                                </div>
                                
                                <div class="col-md-6 text-right"> 
                                    <span class="text-muted">Order Id #</span>
                                    <div class="d-block">
                                        <a href="#">View Order Details</a> |
                                        <a href="#">Invoice</a>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- ORDER card body -->
                        <div class="card-body">
                            <div class="row">

                                <div class="col-md-12 mb-3">
                                    <h5 class="card-text text-secondary">
                                        Delivered on 20th Sept 2024
                                    </h5>
                                </div>
                                
                                <!-- Order Item 1 -->
                                <div class="col-md-12">
                                    <div class="card mb-3" style="">
                                        <div class="row g-0">
                                            <div class="col-md-2">
                                                <a href="/product/product_slug">
                                                    <img 
                                                        src="{{ asset('images/rick-n-m-tees.webp') }}" 
                                                        class="img-fluid rounded-start" 
                                                        alt="..." 
                                                        style="height:167px;"
                                                    />
                                                </a>                                                
                                            </div>
                                            <div class="col-md-8">
                                                <div class="card-body">
                                                    <h5 class="card-text">
                                                        <a href="/product/product_slug">Rick N Morty</a>    
                                                    </h5>
                                                    <h6 class="card-subtitle mb-2 text-muted">Te-Shirts</h6>
                                                    
                                                    <div class="text-muted small">
                                                        <span>Size: XL</span> | <span>Qty: 2</span>
                                                    </div>

                                                    <p class="card-text">
                                                        <small class="text-muted">Status: </small>
                                                        <small class="text-muted">Undelivered</small>
                                                    </p>

                                                    <button type="button" class="btn btn-secondary btn-xs" class="write-product-review">
                                                        Write Review
                                                    </button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- ORDER card footer -->
                        <div class="card-footer">
                            <button type="button" class="btn btn-sm btn-warning text-white">Track</button>
                            <button type="button" class="btn btn-sm btn-default text-secondary">Return or Replace Items</button>
                            <button type="button" class="btn btn-sm btn-secondary">Feedback</button>
                        </div>
                    </div>

                    <!-- Order 3 (EXAMPLE: CANCELLED) -->    
                    <div class="card card-danger card-outline">
                        
                        <!-- ORDER card header -->
                        <div class="card-header">
                            <div class="row small">
                                <div class="col-md-6 d-flex ">
                                    <div class="mr-3">
                                        <span class="text-muted">ORDER PLACED</span> 
                                        <span class="d-block text-muted text-bold"> 19th Sept 2024</span>
                                    </div>

                                    <!-- Total Amount -->
                                    <div class="mr-3">
                                        <span class="text-muted">TOTAL</span>
                                        <span class="d-block text-muted text-bold">₹1,585.00</span>
                                    </div>

                                    <div class="mr-3">
                                        <span class="text-muted">SHIP TO</span>
                                        <span class="d-block text-muted text-bold">Shipping Address</span>
                                    </div>
                                </div>
                                
                                <div class="col-md-6 text-right"> 
                                    <span class="text-muted">Order Id #</span>
                                    <div class="d-block">
                                        <a href="#">View Order Details</a> |
                                        <a href="#">Invoice</a>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- ORDER card body -->
                        <div class="card-body">
                            <div class="row">

                                <div class="col-md-12 mb-3">
                                    <h5 class="card-text text-danger">
                                        Order Cancelled
                                    </h5>
                                </div>
                                
                                <!-- Order Item 1 -->
                                <div class="col-md-12">
                                    <div class="card mb-3" style="">
                                        <div class="row g-0">
                                            <div class="col-md-2">
                                                <a href="/product/product_slug">
                                                    <img 
                                                        src="{{ asset('images/rick-n-m-tees.webp') }}" 
                                                        class="img-fluid rounded-start" 
                                                        alt="..." 
                                                        style="height:167px;"
                                                    />
                                                </a>                                                
                                            </div>
                                            <div class="col-md-8">
                                                <div class="card-body">
                                                    <h5 class="card-text">
                                                        <a href="/product/product_slug">Rick N Morty</a>    
                                                    </h5>
                                                    <h6 class="card-subtitle mb-2 text-muted">Te-Shirts</h6>
                                                    
                                                    <div class="text-muted small">
                                                        <span>Size: XL</span> | <span>Qty: 2</span>
                                                    </div>

                                                    <p class="card-text">
                                                        <small class="text-muted">Status: </small>
                                                        <small class="text-muted">Undelivered</small>
                                                    </p>

                                                    <button type="button" class="btn btn-secondary btn-xs" class="write-product-review">
                                                        Write Review
                                                    </button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- ORDER card footer -->
                        <div class="card-footer">
                            <button type="button" class="btn btn-sm btn-warning text-white">Track</button>
                            <button type="button" class="btn btn-sm btn-secondary">Feedback</button>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
@endsection




@section('content-scripts')
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
@endsection