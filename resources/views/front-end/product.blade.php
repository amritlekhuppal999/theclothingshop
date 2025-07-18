    
@extends('layouts.pages')

@section('content-css')
    <meta name="get-color-attribute-route" content="{{ route('get-color-attribute') }}">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <style>
        #pincode-input:focus {
            outline: none; /* Removes the focus outline */
            box-shadow: none; /* Removes any default box shadow */
        }
    </style>

    <style>
        .product-section {
            background: linear-gradient(135deg, #f8f9fa 0%, #e9ecef 100%);
            border-radius: 20px;
            padding: 2rem;
            box-shadow: 0 10px 30px rgba(0,0,0,0.1);
            max-width: 500px;
            margin: 2rem auto;
            width: 100%;
        }
        
        .product-title {
            font-size: clamp(1.8rem, 5vw, 2.5rem);
            font-weight: 700;
            color: #212529;
            margin-bottom: 1rem;
            text-shadow: 2px 2px 4px rgba(0,0,0,0.1);
        }
        
        .product-description {
            color: #6c757d;
            line-height: 1.6;
            margin-bottom: 2rem;
            font-size: clamp(0.85rem, 2.5vw, 0.95rem);
        }
        
        .size-selector {
            margin-bottom: 1.5rem;
        }
        
        .size-label, .color-label {
            font-weight: 600;
            color: #495057;
            margin-bottom: 0.5rem;
            font-size: 1.1rem;
        }
        
        .size-options {
            display: flex;
            gap: 0.5rem;
            flex-wrap: wrap;
            justify-content: center;
        }
        
        .size-btn, .color-btn {
            border: 2px solid #dee2e6;
            background: white;
            color: #495057;
            padding: 0.5rem 1rem;
            border-radius: 10px;
            cursor: pointer;
            transition: all 0.3s ease;
            font-weight: 500;
            min-width: 50px;
            text-align: center;
            flex: 1;
            /*max-width: 80px;*/
        }
        .size-btn{
            max-width: 80px;
        }
        .color-btn{
            /*max-width: 150px;*/
        }
        
        .size-btn:hover, .color-btn:hover {
            border-color: #007bff;
            background: #e3f2fd;
            /*transform: translateY(-2px);*/
        }
        
        .size-btn.active, .color-btn.active {
            /*background: #007bff;*/
            background: purple;
            color: white;
            /*border-color: #007bff;*/
            border-color: purple;
        }
        .size-btn.disabled, .color-btn.disabled {
            background: grey;
            color: lightgrey;
            border-color: #dee2e6;
        }
        
        .size-chart-link {
            color: #007bff;
            text-decoration: none;
            font-size: 0.9rem;
            margin-left: 0.5rem;
        }
        
        .size-chart-link:hover {
            text-decoration: underline;
        }
        
        .availability-section {
            background: white;
            border-radius: 12px;
            padding: 1rem;
            margin-bottom: 1.5rem;
            border: 1px solid #e9ecef;
        }
        
        .availability-label {
            font-weight: 600;
            color: #495057;
            margin-bottom: 0.5rem;
        }
        
        .pincode-group {
            display: flex;
            gap: 0.5rem;
        }
        
        .pincode-input {
            flex: 1;
            border: 1px solid #dee2e6;
            border-radius: 8px;
            padding: 0.5rem;
            font-size: 0.95rem;
        }
        
        .pincode-input:focus {
            outline: none;
            border-color: #007bff;
            box-shadow: 0 0 0 2px rgba(0,123,255,0.25);
        }
        
        .check-btn {
            background: #28a745;
            color: white;
            border: none;
            padding: 0.5rem 1rem;
            border-radius: 8px;
            cursor: pointer;
            transition: all 0.3s ease;
            font-weight: 500;
        }
        
        .check-btn:hover {
            background: #218838;
            transform: translateY(-1px);
        }
        
        .price-section {
            background: linear-gradient(135deg, #495057 0%, #343a40 100%);
            color: white;
            padding: 1.5rem;
            border-radius: 15px;
            margin-bottom: 1.5rem;
            text-align: center;
        }
        
        .price {
            font-size: clamp(2rem, 6vw, 2.5rem);
            font-weight: 700;
            margin-bottom: 0.2rem;
        }
        
        .price-label {
            font-size: clamp(0.8rem, 2vw, 0.9rem);
            opacity: 0.8;
        }
        
        .quantity-section {
            display: flex;
            align-items: center;
            gap: 1rem;
            margin-bottom: 1.5rem;
        }
        
        .quantity-label {
            font-weight: 600;
            color: #495057;
        }
        
        .quantity-select {
            border: 1px solid #dee2e6;
            border-radius: 8px;
            padding: 0.5rem;
            font-size: 0.95rem;
        }
        
        .action-buttons {
            display: flex;
            gap: 1rem;
            flex-wrap: wrap;
        }
        
        .add-to-cart {
            background: linear-gradient(135deg, #8e44ad 0%, #9b59b6 100%);
            color: white;
            border: none;
            padding: 0.75rem 1.5rem;
            border-radius: 12px;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s ease;
            display: flex;
            align-items: center;
            gap: 0.5rem;
            flex: 1;
            justify-content: center;
            min-width: 140px;
            font-size: clamp(0.9rem, 2.5vw, 1rem);
        }
        
        .add-to-cart:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 20px rgba(142, 68, 173, 0.3);
        }
        
        .add-to-wishlist {
            background: white;
            color: #6c757d;
            border: 2px solid #dee2e6;
            padding: 0.75rem 1.5rem;
            border-radius: 12px;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s ease;
            display: flex;
            align-items: center;
            gap: 0.5rem;
            flex: 1;
            justify-content: center;
            min-width: 140px;
            font-size: clamp(0.9rem, 2.5vw, 1rem);
        }
        
        .add-to-wishlist:hover {
            background: #f8f9fa;
            border-color: #adb5bd;
            transform: translateY(-1px);
        }
        
        .notify-link {
            color: #007bff;
            text-decoration: none;
            font-size: 0.9rem;
            display: inline-flex;
            align-items: center;
            gap: 0.3rem;
        }
        
        .notify-link:hover {
            text-decoration: underline;
        }
        
        @media (max-width: 768px) {
            .product-section {
                margin: 1rem;
                padding: 1.5rem;
                border-radius: 15px;
            }
            
            .size-options {
                justify-content: space-between;
            }
            
            .size-btn {
                flex: 1;
                max-width: none;
                min-width: 45px;
            }
            
            .pincode-group {
                flex-direction: column;
                gap: 0.75rem;
            }
            
            .pincode-input {
                width: 100%;
            }
            
            .check-btn {
                width: 100%;
            }
            
            .quantity-section {
                flex-direction: column;
                align-items: flex-start;
                gap: 0.5rem;
            }
            
            .quantity-select {
                width: 100%;
            }
        }
        
        @media (max-width: 576px) {
            .product-section {
                margin: 0.5rem;
                padding: 1rem;
                border-radius: 12px;
            }
            
            .action-buttons {
                flex-direction: column;
                gap: 0.75rem;
            }
            
            .add-to-cart,
            .add-to-wishlist {
                min-width: 100%;
                width: 100%;
            }
            
            .size-options {
                gap: 0.3rem;
            }
            
            .size-btn {
                padding: 0.4rem 0.6rem;
                font-size: 0.9rem;
            }
            
            .availability-section {
                padding: 0.75rem;
            }
            
            .price-section {
                padding: 1rem;
            }
        }
        
        @media (max-width: 400px) {
            .product-section {
                margin: 0.25rem;
                padding: 0.75rem;
            }
            
            .size-options {
                gap: 0.25rem;
            }
            
            .size-btn {
                padding: 0.3rem 0.5rem;
                font-size: 0.85rem;
                min-width: 40px;
            }
        }
        
        @media (min-width: 1200px) {
            .product-section {
                max-width: 550px;
                padding: 2.5rem;
            }
        }
    </style>


    {{-- Image Gallery --}}
    <style>
        .gallery-container {
            background: linear-gradient(135deg, #f8f9fa 0%, #e9ecef 100%);
            border-radius: 20px;
            padding: 2rem;
            box-shadow: 0 10px 30px rgba(0,0,0,0.1);
            /*max-width: 600px;*/
            margin: 2rem auto;
            width: 100%;
        }
        
        .main-image-container {
            position: relative;
            margin-bottom: 1.5rem;
            border-radius: 15px;
            overflow: hidden;
            background: white;
            box-shadow: 0 8px 25px rgba(0,0,0,0.1);
        }
        
        .main-image {
            width: 100%;
            height: 600px;
            object-fit: cover;
            transition: transform 0.3s ease;
        }
        
        .main-image:hover {
            transform: scale(1.05);
        }
        
        .image-overlay {
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: rgba(0,0,0,0.5);
            display: flex;
            align-items: center;
            justify-content: center;
            opacity: 0;
            transition: opacity 0.3s ease;
        }
        
        .main-image-container:hover .image-overlay {
            opacity: 1;
        }
        
        .zoom-icon {
            color: white;
            font-size: 2rem;
            cursor: pointer;
            background: rgba(255,255,255,0.2);
            padding: 1rem;
            border-radius: 50%;
            backdrop-filter: blur(10px);
        }
        
        .image-actions {
            position: absolute;
            top: 1rem;
            right: 1rem;
            display: flex;
            gap: 0.5rem;
        }
        
        .action-btn {
            background: rgba(255,255,255,0.9);
            border: none;
            padding: 0.5rem;
            border-radius: 50%;
            cursor: pointer;
            transition: all 0.3s ease;
            backdrop-filter: blur(10px);
        }
        
        .action-btn:hover {
            background: white;
            transform: translateY(-2px);
        }
        
        .action-btn.active {
            background: #dc3545;
            color: white;
        }
        
        .thumbnails-container {
            display: flex;
            gap: 0.5rem;
            overflow-x: auto;
            padding: 0.5rem;
            scrollbar-width: thin;
            scrollbar-color: #dee2e6 transparent;
        }
        
        .thumbnails-container::-webkit-scrollbar {
            height: 6px;
        }
        
        .thumbnails-container::-webkit-scrollbar-track {
            background: #f1f1f1;
            border-radius: 10px;
        }
        
        .thumbnails-container::-webkit-scrollbar-thumb {
            background: #dee2e6;
            border-radius: 10px;
        }
        
        .thumbnails-container::-webkit-scrollbar-thumb:hover {
            background: #adb5bd;
        }
        
        .thumbnail {
            min-width: 80px;
            height: 80px;
            border-radius: 10px;
            overflow: hidden;
            cursor: pointer;
            border: 2px solid transparent;
            transition: all 0.3s ease;
            background: white;
            box-shadow: 0 4px 15px rgba(0,0,0,0.1);
        }
        
        .thumbnail:hover {
            border-color: #007bff;
            transform: translateY(-2px);
        }
        
        .thumbnail.active {
            border-color: #007bff;
            box-shadow: 0 6px 20px rgba(0,123,255,0.3);
        }
        
        .thumbnail img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            transition: transform 0.3s ease;
        }
        
        .thumbnail:hover img {
            transform: scale(1.1);
        }
        
        .image-counter {
            position: absolute;
            bottom: 1rem;
            left: 50%;
            transform: translateX(-50%);
            background: rgba(0,0,0,0.7);
            color: white;
            padding: 0.5rem 1rem;
            border-radius: 20px;
            font-size: 0.9rem;
            backdrop-filter: blur(10px);
        }
        
        .navigation-arrows {
            position: absolute;
            top: 50%;
            transform: translateY(-50%);
            background: rgba(255,255,255,0.9);
            border: none;
            padding: 1rem;
            border-radius: 50%;
            cursor: pointer;
            transition: all 0.3s ease;
            backdrop-filter: blur(10px);
            opacity: 0;
        }
        
        .main-image-container:hover .navigation-arrows {
            opacity: 1;
        }
        
        .navigation-arrows:hover {
            background: white;
            transform: translateY(-50%) scale(1.1);
        }
        
        .nav-prev {
            left: 1rem;
        }
        
        .nav-next {
            right: 1rem;
        }
        
        .product-badge {
            position: absolute;
            top: 1rem;
            left: 1rem;
            background: linear-gradient(135deg, #28a745 0%, #20c997 100%);
            color: white;
            padding: 0.5rem 1rem;
            border-radius: 20px;
            font-size: 0.8rem;
            font-weight: 600;
            box-shadow: 0 4px 15px rgba(40, 167, 69, 0.3);
        }
        
        .fullscreen-modal {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: rgba(0,0,0,0.9);
            z-index: 1000;
            padding: 2rem;
        }
        
        .fullscreen-modal.active {
            display: flex;
            align-items: center;
            justify-content: center;
        }
        
        .fullscreen-image {
            max-width: 90%;
            max-height: 90%;
            object-fit: contain;
            border-radius: 10px;
        }
        
        .close-modal {
            position: absolute;
            top: 2rem;
            right: 2rem;
            background: rgba(255,255,255,0.2);
            border: none;
            color: white;
            font-size: 2rem;
            padding: 1rem;
            border-radius: 50%;
            cursor: pointer;
            backdrop-filter: blur(10px);
        }
        
        @media (max-width: 768px) {
            .gallery-container {
                margin: 1rem;
                padding: 1.5rem;
                border-radius: 15px;
            }
            
            .main-image {
                height: 300px;
            }
            
            .thumbnail {
                min-width: 70px;
                height: 70px;
            }
            
            .navigation-arrows {
                padding: 0.75rem;
            }
            
            .zoom-icon {
                font-size: 1.5rem;
                padding: 0.75rem;
            }
        }
        
        @media (max-width: 576px) {
            .gallery-container {
                margin: 0.5rem;
                padding: 1rem;
                border-radius: 12px;
            }
            
            .main-image {
                height: 250px;
            }
            
            .thumbnail {
                min-width: 60px;
                height: 60px;
            }
            
            .image-actions {
                top: 0.5rem;
                right: 0.5rem;
            }
            
            .action-btn {
                padding: 0.4rem;
            }
            
            .product-badge {
                top: 0.5rem;
                left: 0.5rem;
                padding: 0.3rem 0.8rem;
                font-size: 0.7rem;
            }
        }
        
        @media (max-width: 400px) {
            .gallery-container {
                margin: 0.25rem;
                padding: 0.75rem;
            }
            
            .main-image {
                height: 200px;
            }
            
            .thumbnail {
                min-width: 50px;
                height: 50px;
            }
        }
        
        @media (min-width: 1200px) {
            .gallery-container {
                max-width: 550px;
                /*padding: 2.5rem;*/
            }
            
            .main-image {
                height: 100%;
            }
            
            .thumbnail {
                min-width: 90px;
                height: 90px;
            }
        }
    </style>
    
@endsection



@section('content')
    

    {{-- <div class="banner">
        @include('components.front.carousel')
    </div> --}}

    @php
        $product = $product_data["product"];
        $PAL = $product_data["product_attribute_list"];
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
                                <div class="gallery-container">
                                    <!-- Main Image Display -->
                                    <div class="main-image-container">
                                        {{-- <div class="product-badge">New Arrival</div> --}}
                                        @foreach($product_images as $key => $images)
                                            @if($images["prime_image"])
                                                <img 
                                                    src="{{ asset($images["image_location"]) }}" 
                                                    class="main-image cursor-pointer" 
                                                    id="poster-image"
                                                    alt="Prime Product Image"
                                                />
                                            @endif
                                        @endforeach
                                        
                                        {{-- <div class="image-overlay">
                                            <div class="zoom-icon" id="zoomIcon">
                                                <i class="fas fa-search-plus"></i>
                                            </div>
                                        </div> --}}
                                        
                                        {{-- <div class="image-actions">
                                            <button class="action-btn" id="wishlistBtn" title="Add to Wishlist">
                                                <i class="far fa-heart"></i>
                                            </button>
                                            <button class="action-btn" id="shareBtn" title="Share">
                                                <i class="fas fa-share-alt"></i>
                                            </button>
                                        </div>
                                        
                                        <button class="navigation-arrows nav-prev" id="prevBtn">
                                            <i class="fas fa-chevron-left"></i>
                                        </button>
                                        <button class="navigation-arrows nav-next" id="nextBtn">
                                            <i class="fas fa-chevron-right"></i>
                                        </button>
                                        
                                        <div class="image-counter">
                                            <span id="currentImage">1</span> / <span id="totalImages">6</span>
                                        </div> --}}
                                    </div>
                                    
                                    <!-- Thumbnails -->
                                    <div class="thumbnails-container" id="thumbnailsContainer">
                                        <!-- Thumbnails will be populated by JavaScript -->
                                        @foreach($product_images as $key => $images)    
                                            {{-- {{}} --}}
                                            <img 
                                                src="{{ asset($images["image_location"]) }}" 
                                                class=" thumbnail {{ ($images["prime_image"] == 1) ? "active" : "" }}"
                                                alt="Product Image"
                                            />
                                        @endforeach
                                    </div>
                                </div>

                                {{-- Product Info --}}
                                <div class="col-12 col-sm-6">
                                    <div class="product-section">
                                        <h1 class="product-title"> {{ $product["product_name"] }} </h1>

                                        <p class="product-description">
                                            {{ $product["short_description"] }}
                                        </p>
                                        
                                        {{-- Select Size --}}
                                        <div class="size-selector">
                                            <div class="size-label">
                                                Please select one 
                                                <a href="#" class="size-chart-link">
                                                    <i class="fas fa-ruler"></i> Size Chart
                                                </a>
                                            </div>
                                            
                                            {{-- size btns --}}
                                            <div class="" id="size-options"> <!-- size-options -->
                                                @foreach(getAttributeList("size") as $key => $attribute)
                                                    <button 
                                                        class="size-btn {{ !isset($PAL[$attribute["value"]]) ? 'disabled' : '' }} " 
                                                        data-product_id="{{ $product["id"] }}"
                                                        data-attribute_id="{{ $attribute["id"] }}"
                                                        data-size="{{ $attribute["value"] }}" 
                                                        title="{{ !isset($PAL[$attribute["value"]]) ? 'Out of stock' : '' }}"
                                                        {{ !isset($PAL[$attribute["value"]]) ? 'disabled' : '' }}>
                                                        {{ $attribute["value"] }}
                                                    </button>
                                                @endforeach
                                            </div>
                                            
                                            {{-- Notify Me --}}
                                            <div class="mt-2">
                                                <small class="text-muted">Size not available? 
                                                    <a href="#" class="notify-link">
                                                        <i class="fas fa-bell"></i> Notify Me
                                                    </a>
                                                </small>
                                            </div>
                                        </div>

                                        {{-- Available Color (build by JS) --}}
                                        <div id="color-selector">
                                            
                                            <span id="select-color-loading" hidden>Loading...</span>
                                            
                                            <div id="color-selector-body" hidden>
                                                <div class="color-label">
                                                    Available Color 
                                                </div>
                                                
                                                {{-- color btns --}}
                                                <div class="" id="color-options"> </div>
                                            </div>
                                        </div>
                                        
                                        {{-- Check Availability --}}
                                        <div class="availability-section mt-3">
                                            <div class="availability-label">
                                                <i class="fas fa-map-marker-alt"></i> Check Availability
                                            </div>
                                            <div class="pincode-group">
                                                <input type="text" class="pincode-input" placeholder="Enter Pincode" maxlength="6">
                                                <button class="check-btn">
                                                    <i class="fas fa-search"></i> Check
                                                </button>
                                            </div>
                                        </div>
                                        
                                        {{-- Price Section --}}
                                        <div class="price-section">
                                            <div class="price" id="product-price">₹{{ $product["base_price"] }}</div>
                                            <div class="price-label">MRP incl. of all taxes</div>
                                        </div>
                                        
                                        {{-- select quantity --}}
                                        <div class="quantity-section">
                                            <label class="quantity-label">Quantity</label>
                                            <select class="quantity-select" id="select-quantity">
                                                @for ($i=1; $i<=10; $i++)
                                                    <option value="{{ $i }}"> {{ $i }} </option>
                                                @endfor
                                            </select>
                                        </div>

                                        {{-- returned response --}}
                                        <div id="response-message" class="mb-2" style="min-height:30px;"></div>
                                        
                                        <div class="action-buttons">
                                            <button class="add-to-cart">
                                                <i class="fas fa-shopping-cart"></i>
                                                Add to Cart
                                            </button>
                                            <button class="add-to-wishlist">
                                                <i class="far fa-heart"></i>
                                                Add to Wishlist
                                            </button>
                                        </div>
                                    </div>
        
                                </div>
                                
                                <!-- Fullscreen Modal -->
                                <div class="fullscreen-modal" id="fullscreenModal">
                                    <button class="close-modal" id="closeModal">
                                        <i class="fas fa-times"></i>
                                    </button>
                                    <img src="" alt="Fullscreen Image" class="fullscreen-image" id="fullscreenImage">
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

    {{-- product description section --}}
    <script>

        document.addEventListener('DOMContentLoaded', e=>{

            let product_data = null;
            let selected_variant_data = null;

            const size_option_section = document.getElementById('size-options');
            
            const color_selector_section = document.getElementById('color-selector');
            const color_selector_body = document.getElementById('color-selector-body');
            const loading_span = document.getElementById('select-color-loading');
            const color_option_section = document.getElementById('color-options');
            
            const quantity_selector = document.getElementById('select-quantity');

            ADD_TO_CART_BTN = document.querySelector('.add-to-cart');
         
            const delayed_call_attributes = MyApp.debounce(load_color_attr_wrapper, 1000);
            
            // Size selector functionality
            size_option_section.addEventListener('click', event=>{
                let element = event.target;
                
                product_data = {};
                selected_variant_data = {};

                if(element.className.includes("size-btn")){
                    document.querySelectorAll('.size-btn').forEach(b => b.classList.remove('active'));    

                    element.classList.add('active');

                    product_data = {
                        product_id: element.dataset.product_id,
                        attribute_id: element.dataset.attribute_id,
                        attribute_value: element.dataset.size,
                    };

                    loading_span.hidden = false;
                    color_selector_body.hidden = true;

                    // load_color_attributes(product_data);
                    delayed_call_attributes()
                }
            });

            // color selector functionality
            color_option_section.addEventListener('click', event=>{
                let element = event.target;

                selected_variant_data = {};

                if(element.className.includes("color-btn")){
                    document.querySelectorAll('.color-btn').forEach(b => b.classList.remove('active'));

                    element.classList.add("active");
                    
                    selected_variant_data = {
                        product_id: element.dataset.product_id,
                        variant_id: element.dataset.variant_id,
                        variant_price: element.dataset.variant_price, 
                        quantity: 0
                    };

                    //selected_variant_data = {x:1,y:2};

                    // selected_variant_data = {};
                    // console.log(element.dataset.variant_price);

                    // sets quantity selection element
                    set_product_quantity(element.dataset.stock);

                    document.getElementById('product-price').innerText = '₹'+element.dataset.variant_price;
                }
            });

            // quantity selector functionality
            quantity_selector.addEventListener('change', event=>{
                let selectedOption = quantity_selector.options[quantity_selector.selectedIndex];
                if(!MyApp.isEmptyObject(selected_variant_data)){
                    selected_variant_data.quantity = selectedOption.value;

                }
                // console.log(selected_variant_data);
            });

            // select product quantity
            function set_product_quantity(quantity){
                const qty_ele = document.getElementById('select-quantity');
                let opt_str = ''; 
                let priceCounter = 10;

                if(quantity>0 && quantity < 10){
                    priceCounter = quantity;
                }

                for(let i=1; i<=priceCounter; i++){
                    opt_str += `<option value="${i}">${i}</option>`;
                }

                qty_ele.innerHTML = opt_str;

                selected_variant_data.quantity = 1;
            }

            
            // so that i can debounce a parameterised function.
            function load_color_attr_wrapper(){
                load_color_attributes(product_data);
            }

            // load color attributes of product
            async function load_color_attributes(product_data){
                
                if(MyApp.isEmptyObject(product_data)){
                    console.error("Product object empty.");
                    return false;
                }

                color_selector_section.hidden = false;

                /*
                const request_data = {
                    result_count: result_count
                };
                const params = new URLSearchParams(request_data);
                */
                
                const request_options = {
                    method: 'GET',
                    // headers: {},
                    // body: JSON.stringify(request_data)
                };

                //let url = document.querySelector('meta[name="get-color-attribute-route"]').getAttribute('content');
                let url = '/get-color-attribute'
                url = MyApp.appendQueryString(url, 'product_id', product_data.product_id);
                url = MyApp.appendQueryString(url, 'attribute_id', product_data.attribute_id);
                url = MyApp.appendQueryString(url, 'attribute_value', product_data.attribute_value);

                try{
                    let response = await fetch(url, request_options);
                     //console.log(response);
                    let response_data = await response.json();
                    //console.log(response_data);
                    //return response_data;

                    color_option_section.innerHTML = '';

                    if(response.status === MyApp.REQUEST_SUCCESSFUL){
                        let color_data = response_data.color_data;
                        color_data.forEach(element=>{
                            let button = document.createElement('button');
                            
                            button.innerText = element.label;
                            button.dataset.product_id = '';
                            button.dataset.attribute_id = element.id;
                            button.dataset.variant_id = element.variant_id;
                            button.dataset.variant_price = element.price;
                            button.dataset.color = element.value;
                            button.classList.add("color-btn");
                            button.title = "";
                            
                            color_option_section.appendChild(button);
                            console.log(color_option_section);
                        });

                        loading_span.hidden = true;
                        color_selector_body.hidden = false;
                    }
                    else if(response.status === MyApp.REQUESTED_DATA_UNAVAILABLE){
                        //color_selector_section.hidden = true;
                        color_option_section.innerHTML = `<span>${response_data.errors}</span>`;
                    }
                    else if(response.status === MyApp.BAD_REQUEST_ERROR){
                        //color_selector_section.hidden = true;
                        color_option_section.innerHTML = `<span>${response_data.errors}</span>`;
                    }


                    /*
                    switch (response.status) {
                        case MyApp.REQUEST_SUCCESSFUL:
                            if(response_data.requested_action_performed){

                                
                            }
                        break;

                        case MyApp.REQUESTED_DATA_UNAVAILABLE:
                            if(response_data.errors){
                                response_data.errors.forEach(message_element=>{
                                    // toastr.error(message_element);
                                    toastr.warning('<span style="color: blue;">'+message_element+'</span>');
                                });
                            }
                            else toastr.error(response_data.message);
                            resetSubmitBTN();
                        break;

                        case MyApp.BAD_REQUEST_ERROR:
                            //toastr.error(response_data.message);
                            toastr.warning('<span style="color: blue;">'+response_data.message+'</span>');
                            resetSubmitBTN();
                        break;
                        
                        default:
                        toastr.error("Something went down. We are fixing it.");
                        resetSubmitBTN();
                    }
                    */
                    
                }
                catch(error){
                    console.error('Error:', error);
                }
            }


            // Add to cart functionality
            ADD_TO_CART_BTN.addEventListener('click', function() {

                let response_msg_sec = document.getElementById('response-message');
                                
                // check for product variant object, if its set or not
                if(MyApp.isEmptyObject(product_data)){
                    alert("Select size");
                    return false;
                }


                if(MyApp.isEmptyObject(selected_variant_data)){
                    alert("Select variant");
                    return false;
                }

                if(selected_variant_data.quantity === 0){
                    alert("Select quantity");
                    return false;
                }
                
                addToCart();

                async function addToCart(){

                    // Add loading state
                    const originalBtnHTML = ADD_TO_CART_BTN.innerHTML;
                    ADD_TO_CART_BTN.innerHTML = MyApp.LOADER_SMALL + ' Adding...';
                    //ADD_TO_CART_BTN.innerHTML = '<i class="fas fa-spinner fa-spin"></i> Adding...';
                    ADD_TO_CART_BTN.disabled = true;

                    response_msg_sec.innerHTML = '';
               
                    const request_data = {
                        product_id: product_data.product_id,
                        variant_id: selected_variant_data.variant_id,
                        price: selected_variant_data.variant_price,
                        quantity: selected_variant_data.quantity,
                    };
                    //const params = new URLSearchParams(request_data);
                    
                    
                    const request_options = {
                        method: 'POST',
                        headers: {
                            'content-type': 'application/json',
                            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                        },
                        body: JSON.stringify(request_data)
                    };

                    let url = '/add-to-cart'

                    try{
                        let response = await fetch(url, request_options);
                        //console.log(response);
                        //console.log('status:', typeof response.status);
                        
                        if(!response.ok){

                            //when your CSRF token is expired
                            if(response.status === MyApp.PAGE_EXPIRED){  //419
                                response_msg_sec.innerHTML = `<span class="text-danger">Page Expired. Reloading...</span>`;
                                setTimeout(() => {
                                    location.reload();
                                }, 1000);
                            }
                        }

                        let response_data = await response.json();
                        //console.log(response_data);

                        //USER GENERATED ERRORS (FORCED)
                        if(response.status === MyApp.REQUEST_SUCCESSFUL){   // 200   
                            response_msg_sec.innerHTML = `<span class="text-success text-bold">${response_data.message}</span>`;
                        }

                        else if(response.status === MyApp.REQUESTED_DATA_UNAVAILABLE){  // 204
                            response_msg_sec.innerHTML = `<span class="text-danger text-bold">${response_data.errors}</span>`;
                        }

                        else if(response.status === MyApp.BAD_REQUEST_ERROR){  // 400
                            response_msg_sec.innerHTML = `<span class="text-danger text-bold">${response_data.message} ${response_data.errors}</span>`;
                        }

                        else if(response.status === MyApp.UNAUTHORISED_ACCESS){     //401
                            response_msg_sec.innerHTML = `<span class="text-danger text-bold">${response_data.message}</span>`;
                        }
                        
                        else if(response.status === MyApp.INTERNAL_SERVER_ERROR){  //500
                            response_msg_sec.innerHTML = `<span class="text-danger text-bold">${response_data.message}</span>`;
                        }

                        else response_msg_sec.innerHTML = `<span class="text-danger text-bold">Something went wrong...</span>`;

                        ADD_TO_CART_BTN.disabled = false;
                        ADD_TO_CART_BTN.innerHTML = originalBtnHTML;
                        
                    }
                    catch(error){ 
                        console.error('Error:', error);
                    }
                }
            });
        });

        
        
        
        
        
        // Pincode check functionality
        document.querySelector('.check-btn').addEventListener('click', function() {
            const pincodeInput = document.querySelector('.pincode-input');
            const pincode = pincodeInput.value.trim();
            
            if (pincode === '') {
                alert('Please enter a pincode');
                return;
            }
            
            if (!/^\d{6}$/.test(pincode)) {
                alert('Please enter a valid 6-digit pincode');
                return;
            }
            
            // Simulate API call
            this.innerHTML = '<i class="fas fa-spinner fa-spin"></i> Checking...';
            this.disabled = true;
            
            setTimeout(() => {
                alert(`Delivery available for pincode: ${pincode}`);
                this.innerHTML = '<i class="fas fa-search"></i> Check';
                this.disabled = false;
            }, 1500);
        });
        
        
        
        // Add to wishlist functionality
        document.querySelector('.add-to-wishlist').addEventListener('click', function() {
            const selectedSize = document.querySelector('.size-btn.active').dataset.size;
            
            // Toggle wishlist state
            const icon = this.querySelector('i');
            if (icon.classList.contains('far')) {
                icon.classList.remove('far');
                icon.classList.add('fas');
                this.style.background = '#dc3545';
                this.style.color = 'white';
                this.style.borderColor = '#dc3545';
                alert(`Added Batman 39 (Size: ${selectedSize}) to wishlist!`);
            } else {
                icon.classList.remove('fas');
                icon.classList.add('far');
                this.style.background = 'white';
                this.style.color = '#6c757d';
                this.style.borderColor = '#dee2e6';
                alert(`Removed Batman 39 from wishlist!`);
            }
        });
        
        // Pincode input validation
        document.querySelector('.pincode-input').addEventListener('input', function() {
            this.value = this.value.replace(/\D/g, '');
        });
    </script>

    {{-- image gallery section --}}
    {{-- <script>
        // Product images array
        const productImages = [
            {
                url: "https://prod-img.thesouledstore.com/public/theSoul/uploads/catalog/product/1728371396_8622468.jpg?format=webp&w=480&dpr=1.0",
                alt: "Tune Squad T-Shirt - Front View"
            },
            {
                url: "https://prod-img.thesouledstore.com/public/theSoul/uploads/catalog/product/1719071967_7805244.jpg?format=webp&w=480&dpr=1.0",
                alt: "Tune Squad T-Shirt - Back View"
            },
            {
                url: "https://prod-img.thesouledstore.com/public/theSoul/uploads/catalog/product/1719071967_6774061.jpg?format=webp&w=480&dpr=1.0",
                alt: "Tune Squad T-Shirt - Side View"
            },
            {
                url: "https://prod-img.thesouledstore.com/public/theSoul/uploads/catalog/product/1719071967_5081794.jpg?format=webp&w=480&dpr=1.0",
                alt: "Tune Squad T-Shirt - Detail View"
            },
            {
                url: "https://prod-img.thesouledstore.com/public/theSoul/uploads/catalog/product/1719071967_8996039.jpg?format=webp&w=480&dpr=1.0",
                alt: "Tune Squad T-Shirt - Lifestyle"
            },
            {
                url: "https://prod-img.thesouledstore.com/public/theSoul/uploads/catalog/product/1719071967_2491567.jpg?format=webp&w=480&dpr=1.0",
                alt: "Tune Squad T-Shirt - Model View"
            }
        ];
        
        let currentImageIndex = 0;
        
        // Initialize gallery
        function initGallery() {
            const thumbnailsContainer = document.getElementById('thumbnailsContainer');
            const totalImagesSpan = document.getElementById('totalImages');
            
            // Update total images count
            totalImagesSpan.textContent = productImages.length;
            
            // Create thumbnails
            productImages.forEach((image, index) => {
                const thumbnail = document.createElement('div');
                thumbnail.className = `thumbnail ${index === 0 ? 'active' : ''}`;
                thumbnail.innerHTML = `<img src="${image.url}" alt="${image.alt}">`;
                thumbnail.addEventListener('click', () => changeImage(index));
                thumbnailsContainer.appendChild(thumbnail);
            });
        }
        
        // Change main image
        function changeImage(index) {
            const mainImage = document.getElementById('mainImage');
            const currentImageSpan = document.getElementById('currentImage');
            const thumbnails = document.querySelectorAll('.thumbnail');
            
            // Update current image index
            currentImageIndex = index;
            
            // Update main image
            mainImage.src = productImages[index].url;
            mainImage.alt = productImages[index].alt;
            
            // Update counter
            currentImageSpan.textContent = index + 1;
            
            // Update active thumbnail
            thumbnails.forEach((thumb, i) => {
                thumb.classList.toggle('active', i === index);
            });
        }
        
        // Navigation functions
        function nextImage() {
            const nextIndex = (currentImageIndex + 1) % productImages.length;
            changeImage(nextIndex);
        }
        
        function prevImage() {
            const prevIndex = (currentImageIndex - 1 + productImages.length) % productImages.length;
            changeImage(prevIndex);
        }
        
        // Event listeners
        document.getElementById('nextBtn').addEventListener('click', nextImage);
        document.getElementById('prevBtn').addEventListener('click', prevImage);
        
        // Zoom functionality
        document.getElementById('zoomIcon').addEventListener('click', function() {
            const modal = document.getElementById('fullscreenModal');
            const fullscreenImage = document.getElementById('fullscreenImage');
            
            fullscreenImage.src = productImages[currentImageIndex].url;
            fullscreenImage.alt = productImages[currentImageIndex].alt;
            modal.classList.add('active');
        });
        
        // Close modal
        document.getElementById('closeModal').addEventListener('click', function() {
            document.getElementById('fullscreenModal').classList.remove('active');
        });
        
        // Close modal on background click
        document.getElementById('fullscreenModal').addEventListener('click', function(e) {
            if (e.target === this) {
                this.classList.remove('active');
            }
        });
        
        // Wishlist functionality
        document.getElementById('wishlistBtn').addEventListener('click', function() {
            const icon = this.querySelector('i');
            if (icon.classList.contains('far')) {
                icon.classList.remove('far');
                icon.classList.add('fas');
                this.classList.add('active');
                this.title = 'Remove from Wishlist';
            } else {
                icon.classList.remove('fas');
                icon.classList.add('far');
                this.classList.remove('active');
                this.title = 'Add to Wishlist';
            }
        });
        
        // Share functionality
        document.getElementById('shareBtn').addEventListener('click', function() {
            if (navigator.share) {
                navigator.share({
                    title: 'Tune Squad T-Shirt',
                    text: 'Check out this awesome Tune Squad T-Shirt!',
                    url: window.location.href
                });
            } else {
                // Fallback for browsers that don't support Web Share API
                const shareData = `Check out this awesome Tune Squad T-Shirt! ${window.location.href}`;
                navigator.clipboard.writeText(shareData).then(() => {
                    alert('Link copied to clipboard!');
                });
            }
        });
        
        // Keyboard navigation
        document.addEventListener('keydown', function(e) {
            if (e.key === 'ArrowLeft') {
                prevImage();
            } else if (e.key === 'ArrowRight') {
                nextImage();
            } else if (e.key === 'Escape') {
                document.getElementById('fullscreenModal').classList.remove('active');
            }
        });
        
        // Touch/swipe support for mobile
        let touchStartX = 0;
        let touchEndX = 0;
        
        document.getElementById('mainImage').addEventListener('touchstart', function(e) {
            touchStartX = e.changedTouches[0].screenX;
        });
        
        document.getElementById('mainImage').addEventListener('touchend', function(e) {
            touchEndX = e.changedTouches[0].screenX;
            handleSwipe();
        });
        
        function handleSwipe() {
            const swipeThreshold = 50;
            const diff = touchStartX - touchEndX;
            
            if (Math.abs(diff) > swipeThreshold) {
                if (diff > 0) {
                    nextImage(); // Swipe left - next image
                } else {
                    prevImage(); // Swipe right - previous image
                }
            }
        }
        
        // Initialize gallery when page loads
        document.addEventListener('DOMContentLoaded', initGallery);
    </script> --}}
@endsection