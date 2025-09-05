    @php 
        $item_id = $cartItems["id"];
        $product_name = $cartItems["product"]["product_name"];
        $product_slug = $cartItems["product"]["product_slug"];
        $product_discount = $cartItems["product"]["discount_percentage"];
        
        $quantity = $cartItems["quantity"];
        
        $pcm = $cartItems["product"]["p_c_m"];  //product_category_mapper
        $subCategoryList = array_map(fn($element) => $element["sub_category"] , $pcm);
        
        $product_variants = $cartItems["variants"];
        $product_attributes = $product_variants["product_attributes"];
        $variant_stock = $product_variants["stock"];
        $variant_price = $product_variants["price"];

        $total_price = $variant_price * $quantity;


        // calculate discount and stuff
            $discount_amount = ($product_discount/100) * $total_price;
            $discounted_price = $total_price - $discount_amount;
        // calculate discount and stuff END

        /*
        $discounted_price = discounted_price($total_price, $product_discount);
        function discounted_price($price, $discount){
            //$base_price = $product["base_price"];
            //$discount_percentage = $product["discount_percentage"];
            $discount_amount = ($discount/100) * $price;
            //echo $discount_amount;
            return $discounted_price = $price - $discount_amount;
        }
        */

        $attribute_values = array_map(fn($element) => $element["attribute_values"] , $product_attributes);

        // Size Attribute
        $size_attribute = array_map( function($element){ 
                                if($element["attribute"]["name"] == "Size"){
                                    return $element["label"];
                                }
                            }, $attribute_values);
        $size_attribute = array_values(array_filter($size_attribute, fn($ele) => $ele !== NULL));
        $size_attribute = $size_attribute[0]; // since its from the same array 

        // Color Attribute
        $color_attribute = array_map(function($element){ 
                                if($element["attribute"]["name"] == "Color"){
                                    return $element["label"];
                                } 
                            }, $attribute_values);
        $color_attribute = array_values(array_filter($color_attribute, fn($ele) => $ele !== NULL));
        $color_attribute = $color_attribute[0]; // since its from the same array

        //$product_image = $cartItems["product"]["primary_image"]["image_location"];
        $product_image = isset($cartItems["product"]["primary_image"]["image_location"]) ? $cartItems["product"]["primary_image"]["image_location"] : "";

        $size_list = getAttributeList("Size");

        $allowed_quantity = ($variant_stock < 10 && $variant_stock > 0) ? $variant_stock : 10;
        //$allowed_quantity = 10;
        
        
        
    @endphp

{{-- <pre>
    @php    
        var_dump($product_variants);
    @endphp        
</pre> --}}

    {{-- THIS COULD BE A LIVEWIRE COMPONENT, we need rerender after quantity changes --}}
    <div class="cart-item" id="{{ $item_id }}">
        <div class="row align-items-center">
            <div class="col-sm-3 col-12">
                <a href="{{ safe_route('product', ["product_slug" => $product_slug]) }}">
                    <img src="{{ asset($product_image) }}" alt="Hulk Sleeveless" class="product-image">
                </a>
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
                    <span class="color-label">
                        {{ $size_attribute }} - {{ $color_attribute }}
                    </span>
                </div>

                <div class="mb-2">
                    {{-- size attribute --}}
                    {{-- <select class="form-select form-select-sm d-inline-block item-size" style="width: 150px;">
                        @foreach($size_list as $key => $size)
                            <option 
                                value="{{ $size["id"] }}"
                                {{ ( $size["value"] == $size_attribute ) ? "selected" : "" }} >
                                {{ $size["value"] }} - {{ $size["label"] }}
                            </option>
                        @endforeach
                    </select> --}}

                    {{-- qty attribute --}}
                    <select class="form-select form-select-sm d-inline-block ms-2  item-quantity" 
                        style="width: 65px;"
                        data-quantity="{{ $quantity }}"
                        data-item_id="{{ $item_id }}">
                        
                        @for($qt = 1; $qt <= $allowed_quantity; $qt++) 
                            <option value="{{ $qt }}"
                                {{ ($quantity == $qt) ? "selected" : "" }} >
                                {{ $qt }}
                            </option>
                        @endfor
                    </select>
                </div>

                {{-- estimated delivery --}}
                <div class="delivery-info">
                    {{-- Estimated Delivery by <strong>31 Oct</strong> --}}
                    Estimated Delivery by : UNDEFINED
                </div>
            </div>

            {{-- price breakdown --}}
            <div class="col-sm-3 col-12 price-section d-block" 
                data-item_id="{{ $item_id }}"
                data-single_item_price="{{ $variant_price }}"
                data-discount_percentage="{{ $product_discount }}">

                <div class="current-price discounted-price">₹ {{ $discounted_price }}</div>
                <div class="original-price total-price">₹ {{ $total_price }}</div>
                <div class="mrp-text">MRP incl. of all taxes</div>
                <div class="discount-text price-difference">₹ {{ $total_price - $discounted_price }} OFF</div>
            </div>
        </div>

        {{-- action btns --}}
        <div class="action-buttons">
            <button class="btn-remove remove-item" data-item_id="{{ $item_id }}">Remove</button>
            <button class="btn-wishlist add-to-wishlist" data-product_id="{{ $cartItems["product"]["id"] }}">Add to wishlist</button>
        </div>
    </div>


