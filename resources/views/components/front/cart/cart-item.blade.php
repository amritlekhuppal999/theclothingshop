    @php 
        $product_name = $cartItems["product"]["product_name"];
        $product_slug = $cartItems["product"]["product_slug"];
        
        $quantity = $cartItems["quantity"];
        
        $pcm = $cartItems["product"]["p_c_m"];  //product_category_mapper
        $subCategoryList = array_map(fn($element) => $element["sub_category"] , $pcm);
        
        $product_variants = $cartItems["variants"];
        $product_attributes = $product_variants["product_attributes"];
        $attribute_values = array_map(fn($element) => $element["attribute_values"] , $product_attributes);

        // Size Attribute
        $size_attribute = array_map( function($element){ 
                                if($element["attribute"]["name"] == "Size"){
                                    return $element["value"];
                                }
                            }, $attribute_values);
        $size_attribute = array_filter($size_attribute, fn($ele) => $ele !== NULL);
        //$size_attribute = $size_attribute[0]; // since its from the same array 

        // Color Attribute
        $color_attribute = array_map(function($element){ 
                                if($element["attribute"]["name"] == "Color"){
                                    return $element["value"];
                                } 
                            }, $attribute_values);
        $color_attribute = array_filter($color_attribute, fn($ele) => $ele !== NULL);
        //$color_attribute = $color_attribute[1]; // since its from the same array

        $product_image = $cartItems["product"]["primary_image"]["image_location"];


        $size_list = getAttributeList("Size");
    @endphp

{{-- <pre>
    @php    
        //var_dump($pcm);
        echo "<h1>ITEM:</h1>";
        var_dump($product_name);
        var_dump($size_list);
        var_dump($color_attribute);
        //var_dump($attribute_values);
        //var_dump($cartItems);
        echo "<h1>ITEM END</h1>";
    @endphp        
</pre> --}}


    <div class="cart-item">
        <div class="row align-items-center">
            <div class="col-sm-3 col-12">
                <img src="{{ asset($product_image) }}" alt="Hulk Sleeveless" class="product-image">
            </div>
            <div class="col-sm-6 col-12 product-details">
                
                {{-- product name --}}
                <h3 class="product-title">
                    <a href="{{ safe_route('product', ["product_slug" => $product_slug]) }}">{{ $product_name }}</a>
                </h3>

                {{-- category/sub-category --}}
                <p class="product-type">
                    @foreach($subCategoryList as $subCategory)
                        <u class="cursor-pointer">{{ $subCategory["sub_category_name"] }}</u>
                    @endforeach
                </p>


                {{-- Color attribute --}}
                <div class="color-info">
                    <span class="color-label">Color: 
                        @foreach($color_attribute as $color)
                            {{ $color }}
                        @endforeach
                    </span>
                </div>

                <div class="mb-2">
                    {{-- size attribute --}}
                    <select class="form-select form-select-sm d-inline-block" style="width: 150px;">
                        @foreach($size_list as $key => $size)
                            <option 
                                value="{{ $size["id"] }}"
                                {{ ( $size["value"] == $size_attribute[0] ) ? "selected" : "" }} >
                                {{ $size["value"] }} - {{ $size["label"] }}
                            </option>
                        @endforeach
                    </select>

                    {{-- qty attribute --}}
                    <select class="form-select form-select-sm d-inline-block ms-2" style="width: 65px;">
                        @for($qt = 1; $qt <= 10; $qt++) 
                            <option value="{{ $qt }}"
                                {{ ($quantity == $qt) ? "selected" : "" }} >
                                {{ $qt }}
                            </option>
                        @endfor
                    </select>
                </div>

                {{-- estimated delivery --}}
                <div class="delivery-info">
                    Estimated Delivery by <strong>31 Oct</strong>
                </div>
            </div>

            {{-- price breakdown --}}
            <div class="col-sm-3 col-12 price-section d-block">
                <div class="current-price">₹ 699</div>
                <div class="original-price">₹ 1299</div>
                <div class="mrp-text">MRP incl. of all taxes</div>
                <div class="discount-text">₹ 100 OFF</div>
            </div>
        </div>

        {{-- action btns --}}
        <div class="action-buttons">
            <button class="btn-remove">Remove</button>
            <button class="btn-wishlist">Add to wishlist</button>
        </div>
    </div>