@php
    $temp_size_arr = array( "XS", "S", "M", "L", "XL", "XXL" );
    $temp_color_arr = array( "XS", "S", "M", "L", "XL", "XXL" );
@endphp


    <div class="card mb-3" style="">
        <div class="row g-0">

            <!-- Product Image -->
            <div class="col-md-3">
                <img 
                    src="{{ asset($itemDetails["product_image"]) }}" 
                    class="img-fluid rounded-start" 
                    alt="..."
                />
            </div>
            
            <!-- Product Details -->
            <div class="col-md-9 p-3">
                
                <div class="row">
                    
                    <!-- Product & category name -->
                    <div class="col-md-6">
                        <h5>
                            <a href="/product/product_slug"> {{ $itemDetails["product_name"] }} </a>
                        </h5>
                        
                        <!-- category name -->
                        <p class="text-muted "> {{ $itemDetails["product_category"] }} </p>

                        <!-- Size & Quantity -->
                        <div class="d-flex">
                            <!-- Size -->
                            <select name="" id="" class=" mr-2">
                                @foreach($temp_size_arr as $size)
                                    <option 
                                        value="{{$size}}"
                                        @php echo ($itemDetails["size"] == $size) ? "selected" : ""; @endphp >
                                        {{$size}}
                                    </option>
                                @endforeach
                            </select>

                            <!-- Quantity -->
                            <select name="" id="" class="">
                                @for ($i=1; $i<=10; $i++)
                                    <option 
                                        value="{{$i}}"
                                        @php echo ($itemDetails["quantity"] == $i) ? "selected" : ""; @endphp
                                    >
                                        Quantity {{$i}}
                                    </option>
                                @endfor
                            </select>
                        </div>

                        <!-- <div class="clearfix"></div> -->
                    </div>

                    <!-- Price breakdown -->
                    <div class="col-md-6 text-right pr-3 text-muted small">
                        <div> 
                            <span class="text-bold text-dark">₹ {{ $itemDetails["item_price"] }}</span>   <strike>₹ 1299</strike>  
                        </div>
                        <div> MRP incl. of all taxes </div>
                        <div class="text-red"> ₹ {{ $itemDetails["item_discount"] }} OFF </div>
                    </div>

                    <!-- Color -->
                    <div class="col-md-12 mt-1 "> 
                        <span class="text-muted">Color: </span>
                        <b> {{ $itemDetails["color"] }} </b>
                    </div>

                    <!-- Estimated delivery -->
                    <div class="col-md-4 mt-1 small"> 
                        <span class="text-muted">Estimated Delivery by </span>
                        <b> {{ $itemDetails["delivery_details"]["estimated_delivery"] }} </b>
                    </div>

                    <!-- Remove and wishlist BTNS -->
                    <div class="col-md-6 offset-md-6 text-right pr-3">
                        
                        <!-- Remove from cart -->
                        <a href="#" class="card-link text-red remove-item" data-product_id="{{ $itemDetails["product_id"] }}">
                            Remove
                        </a>

                        <!-- Add to wishlist -->
                        <a href="#" class="card-link move-to-wishlist" data-product_id="{{ $itemDetails["product_id"] }}">
                            Add to wishlist
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>