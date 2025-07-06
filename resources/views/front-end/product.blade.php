    
@extends('layouts.pages')

@section('content-css')
    <!-- <link rel="stylesheet" href="{{ asset('css/front-end/') }}"> -->

    
@endsection



@section('content')
    <style>
        #pincode-input:focus {
            outline: none; /* Removes the focus outline */
            box-shadow: none; /* Removes any default box shadow */
        }
    </style>

    {{-- <div class="banner">
        @include('components.front.carousel')
    </div> --}}

    @php
        $product = $product_data["product"];
        // $product_attribute_map = $product_data["product_attribute_map"];
        $product_images = $product_data["product_images"];
    @endphp

    <div class="content"> 
        <div class="container-fluid">
            <!-- <p>Page Content..</p> -->

            <div class="row">
                <!-- Breadcrumb -->
                <div class="col-md-6 offset-md-6 text-right mt-3 mb-2"> 
                    <span>Breadcrumb</span>
                </div>

                <div class="col-md-12">
                    
                    <div class="card card-solid">
                        <div class="card-body">
                            
                            <div class="row">
                                
                                {{-- Product Image Gallery --}}
                                <div class="col-12 col-sm-6">
                                    
                                    <div class="col-12">
                                        @foreach($product_images as $key => $images)
                                            @if($images["prime_image"])
                                                <img 
                                                    src="{{ asset($images["image_location"]) }}" 
                                                    class="product-image cursor-pointer" 
                                                    id="poster-image"
                                                    alt="Prime Product Image"
                                                />
                                            @endif
                                        @endforeach
                                    </div>
                                    
                                    <div class="col-12 product-image-thumbs">
                                        @foreach($product_images as $key => $images)    
                                            {{-- {{}} --}}
                                            <div class="product-image-thumb cursor-pointer {{ ($images["prime_image"] == 1) ? "active" : "" }}">
                                                <img 
                                                    src="{{ asset($images["image_location"]) }}" 
                                                    class="product-image-list"
                                                    alt="Product Image"
                                                />
                                            </div>
                                        @endforeach
                                    </div>
                                </div>

                                {{-- Product Info --}}
                                <div class="col-12 col-sm-6">
                                    <h3 class="d-inline-block">{{ $product["product_name"] }}</h3>

                                    <!-- Product description -->
                                    <p> {{ $product["short_description"] }} </p>
            
                                    <hr>
                                    <h4>Available Colors</h4>
                                    <div class="btn-group btn-group-toggle" data-toggle="buttons">
                                        <label class="btn btn-default text-center active">
                                            <input type="radio" name="color_option" id="color_option1" autocomplete="off" checked="">
                                            Green
                                            <br>
                                            <i class="fas fa-circle fa-2x text-green"></i>
                                        </label>

                                        <label class="btn btn-default text-center">
                                            <input type="radio" name="color_option" id="color_option2" autocomplete="off">
                                            Blue
                                            <br>
                                            <i class="fas fa-circle fa-2x text-blue"></i>
                                        </label>

                                        <label class="btn btn-default text-center">
                                            <input type="radio" name="color_option" id="color_option3" autocomplete="off">
                                            Purple
                                            <br>
                                            <i class="fas fa-circle fa-2x text-purple"></i>
                                        </label>

                                        <label class="btn btn-default text-center">
                                            <input type="radio" name="color_option" id="color_option4" autocomplete="off">
                                            Red
                                            <br>
                                            <i class="fas fa-circle fa-2x text-red"></i>
                                        </label>

                                        <label class="btn btn-default text-center">
                                            <input type="radio" name="color_option" id="color_option5" autocomplete="off">
                                            Orange
                                            <br>
                                            <i class="fas fa-circle fa-2x text-orange"></i>
                                        </label>
                                    </div>
            
                                    <div class="mt-3"> 
                                        Please select one
                                        <a href="#">Size Chart</a> 
                                    </div>
                                    
                                    <!-- Sizes -->
                                    <div class="btn-group btn-group-toggle" data-toggle="buttons">
                                        <!-- <label class="btn btn-default text-center">
                                            <input type="radio" name="color_option" id="color_option1" autocomplete="off">
                                            <span class="text-xl">S</span>
                                            <br>
                                            Small
                                        </label> -->
                                        <label class="btn btn-default text-center cursor-pointer">
                                            <input type="radio" name="color_option" id="color_option1" autocomplete="off">
                                            <span class="text-xl">S</span>
                                        </label>
                                        <label class="btn btn-default text-center cursor-pointer">
                                            <input type="radio" name="color_option" id="color_option1" autocomplete="off">
                                            <span class="text-xl">M</span>
                                        </label>
                                        <label class="btn btn-default text-center cursor-pointer">
                                            <input type="radio" name="color_option" id="color_option1" autocomplete="off">
                                            <span class="text-xl">L</span>
                                        </label>
                                        <label class="btn btn-default text-center cursor-pointer">
                                            <input type="radio" name="color_option" id="color_option1" autocomplete="off">
                                            <span class="text-xl">XL</span>
                                        </label>
                                        <label class="btn btn-default text-center cursor-pointer">
                                            <input type="radio" name="color_option" id="color_option1" autocomplete="off">
                                            <span class="text-xl">XXL</span>
                                        </label>
                                    </div>

                                    <!-- Notify Me -->
                                    <div class="mt-3"> 
                                        Size not available?
                                        <a href="#">Notify Me</a> 
                                    </div>

                                    <!-- Availability -->
                                    <div class="mt-3">
                                        Check Availability
                                        <div class="input-group mb-3" style="width:26vw;">
                                            <input 
                                                type="text"
                                                class="form-control"
                                                id="pincode-input"
                                                placeholder="Enter Pincode"
                                                style="border-right:none;"
                                            />

                                            <div class="input-group-append">
                                                <Button 
                                                    type="button"class="input-group-text bg-white" 
                                                    style="border-left:none;">
                                                    Check
                                                </Button>
                                            </div>
                                        </div> 
                                    </div>
            
                                    <div class="bg-gray py-2 px-3 mt-4">
                                        <h2 class="mb-0">
                                            ₹3500.00
                                        </h2>
                                        <h4 class="mt-0">
                                            <small> MRP incl. of all taxes </small>
                                        </h4>
                                    </div>
            
                                    <!-- Quantity -->
                                    <div class="mt-4"> 
                                        Quantity 
                                        <select name="" id="">
                                            @for ($i=1; $i<=10; $i++)
                                                <option value="{{ $i }}"> {{ $i }} </option>
                                            @endfor
                                        </select>
                                    </div>

                                    <!-- Add to cart / Wishlist BTN -->
                                    <div class="mt-4">
                                        
                                        <!-- Add to Cart BTN -->
                                        <button 
                                            type="button"
                                            class="btn bg-purple btn-lg btn-flat"
                                            id="add-to-cart-btn">
                                            <i class="fas fa-cart-plus fa-lg mr-2"></i> 
                                            Add to Cart
                                        </button>
            
                                        <!-- Add to Wishlist BTN -->
                                        <button 
                                            type="button" 
                                            class="btn btn-default btn-lg btn-flat"
                                            id="add-to-wishlist-btn">
                                            <i class="fas fa-heart fa-lg mr-2"></i> 
                                            Add to Wishlist
                                        </button>
                                    </div>
            
                                    <!-- share BTNS -->
                                    {{-- <div class="mt-4 product-share">
                                        <a href="#" class="text-gray"> <i class="fab fa-facebook-square fa-2x"></i> </a>
                                        <a href="#" class="text-gray"> <i class="fab fa-twitter-square fa-2x"></i> </a>
                                        <a href="#" class="text-gray"> <i class="fas fa-envelope-square fa-2x"></i> </a>
                                        <a href="#" class="text-gray"> <i class="fas fa-rss-square fa-2x"></i> </a>
                                    </div> --}}
        
                                </div>
                            </div>
                            
                            <!-- Product Details -->
                            <div class="row mt-4">
                                <nav class="w-100">
                                    <div class="nav nav-tabs" id="product-tab" role="tablist">
                                        <a class="nav-item nav-link active" id="product-desc-tab" data-toggle="tab" href="#product-desc" role="tab" aria-controls="product-desc" aria-selected="true"> Product Detail </a>

                                        <a class="nav-item nav-link" id="product-comments-tab" data-toggle="tab" href="#product-comments" role="tab" aria-controls="product-comments" aria-selected="false"> Comments </a>
                                        
                                        <a class="nav-item nav-link" id="product-rating-tab" data-toggle="tab" href="#product-rating" role="tab" aria-controls="product-rating" aria-selected="false"> Rating </a>
                                    </div>
                                </nav>

                                <div class="tab-content p-3" id="nav-tabContent">
                                    {{-- Long description --}}
                                    <div class="tab-pane fade show active" id="product-desc" role="tabpanel" aria-labelledby="product-desc-tab"> 
                                        {{ $product["long_description"] }}
                                    </div>

                                    {{-- comment section --}}
                                    <div class="tab-pane fade" id="product-comments" role="tabpanel" aria-labelledby="product-comments-tab"> 
                                        Vivamus rhoncus nisl sed venenatis luctus. Sed condimentum risus ut tortor feugiat laoreet. Suspendisse potenti. Donec et finibus sem, ut commodo lectus. Cras eget neque dignissim, placerat orci interdum, venenatis odio. Nulla turpis elit, consequat eu eros ac, consectetur fringilla urna. Duis gravida ex pulvinar mauris ornare, eget porttitor enim vulputate. Mauris hendrerit, massa nec aliquam cursus, ex elit euismod lorem, vehicula rhoncus nisl dui sit amet eros. Nulla turpis lorem, dignissim a sapien eget, ultrices venenatis dolor. Curabitur vel turpis at magna elementum hendrerit vel id dui. Curabitur a ex ullamcorper, ornare velit vel, tincidunt ipsum. 
                                    </div>

                                    {{-- ratings --}}
                                    <div class="tab-pane fade" id="product-rating" role="tabpanel" aria-labelledby="product-rating-tab"> 
                                        Cras ut ipsum ornare, aliquam ipsum non, posuere elit. In hac habitasse platea dictumst. Aenean elementum leo augue, id fermentum risus efficitur vel. Nulla iaculis malesuada scelerisque. Praesent vel ipsum felis. Ut molestie, purus aliquam placerat sollicitudin, mi ligula euismod neque, non bibendum nibh neque et erat. Etiam dignissim aliquam ligula, aliquet feugiat nibh rhoncus ut. Aliquam efficitur lacinia lacinia. Morbi ac molestie lectus, vitae hendrerit nisl. Nullam metus odio, malesuada in vehicula at, consectetur nec justo. Quisque suscipit odio velit, at accumsan urna vestibulum a. Proin dictum, urna ut varius consectetur, sapien justo porta lectus, at mollis nisi orci et nulla. Donec pellentesque tortor vel nisl commodo ullamcorper. Donec varius massa at semper posuere. Integer finibus orci vitae vehicula placerat. 
                                    </div>

                                </div>
                            </div>
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