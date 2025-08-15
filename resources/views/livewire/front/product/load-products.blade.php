

    <div class="row" id="livewire-load-product">
        
        {{-- This span will bring focus back to the top of the page when new results load upon parameter change --}}
        {{-- <span id="bring-back-focus"></span> --}}
        
        {{-- {{ $totalRecords }} --}}
        @if($productList->isNotEmpty())
            
            @foreach($productList as $key => $product)
                {{-- <x-front.product.product-card
                    displayPage="category"
                    cardType="product"
                    cardSize="3"
                    cardTheme="{{ ($key == 0) ? 'dark' : '' }}"
                    slug="{{ safe_route('product', ["product_slug" => $product["product_slug"]]) }}"
                    imageSlug="{{ asset($product["image_location"]) }}"
                    description="{{ $product["short_description"] }}"
                /> --}}


                <div class="col-6 col-md-6 col-lg-3 col-xl-3" wire:key="item-{{ $product["product_id"] }}" @if($loop->last) id="last_record" @endif>
                    
                    <div class="card product-card border-0 {{ ($key == 0) ? 'dark' : '' }}">
                        <div class="product-image">
                            <a href="{{ safe_route('product', ["product_slug" => $product["product_slug"]]) }}">
                                <img 
                                    @php
                                        $loc_img = ($product["image_location"] !=null ) ? $product["image_location"] : 'images/product-card-loader.jpg';
                                    @endphp
                                    src="{{ asset($loc_img) }}" 
                                    alt="Batman Caped Crusader Hoodie" class="card-img-top"
                                />
                            </a>
                            
                            {{-- <div class="oversized-fit">OVERSIZED FIT</div> --}}

                            <button 
                                class="favorite-btn {{ isAddedToWishlist($product["product_id"]) ? "active" : "" }}" 
                                data-product_id="{{ $product["product_id"] }}"
                                data-saved_in_wishlist="{{ isAddedToWishlist($product["product_id"]) ? 1 : 0 }}"
                                aria-label="Add to favorites">
                                <i class="{{ isAddedToWishlist($product["product_id"]) ? "fas fa-heart" : "far fa-heart" }}"  
                                    data-product_id="{{ $product["product_id"] }}"></i>
                            </button>
                        </div>
                        <div class="card-body">
                            <a 
                                href="{{ safe_route('product', ["product_slug" => $product["product_slug"]]) }}"
                                class="text-decoration-none">
                                <h5 class="product-title">
                                    {{ $product["product_name"] }}
                                </h5>
                            </a>

                            @php
                                $base_price = $product["base_price"];
                                $discount_percentage = $product["discount_percentage"];
                                $discount_amount = ($discount_percentage/100) * $base_price;
                                //echo $discount_amount;
                                $discounted_price = $base_price - $discount_amount;
                            @endphp

                            <div class="price-section">
                                <span class="current-price">₹{{ $discounted_price }}</span>
                                <span class="original-price">₹{{ $base_price }}</span>
                                <span class="discount-badge">{{ floor($product["discount_percentage"]) }}% </span>
                            </div>
                        </div>
                    </div>

                </div>

                {{-- {{ $product["product_name"] }} --}}
            @endforeach

            @if($loadAmount < $totalRecords)
                {{-- <div class="col-md-12 text-center">
                    <h3>That's all from us... </h3>
                </div> --}}

                <div class="col-md-12 text-center"
                    x-data
                    x-intersect="$wire.loadMore()">
                    {{-- <h3>Loading more...</h3> --}}
                    <h3>Chottu aur nikaal...</h3>
                </div>
            @else

                @if($productList->count() > 50)
                    
                    <div class="col-md-12 text-center mb-2 mt-1">
                        {{-- <hr> --}}
                        {{-- <img src="{{ asset("images/you-wanted-more.jpeg") }}" alt="" style="border-radius: 10px;"> --}}
                        <h6>You wanted more??</h6>
                    </div>
                @else
                    <div class="col-md-12 text-center mb-2 mt-1">
                        <h6>Thats all we got...</h6>
                    </div>
                @endif
            @endif
        
        @else
        
            <div class="col-md-12">
                <h3>No product available.</h3>
            </div>
        
        @endif

        
    </div>

@push('scripts')

    <script>
        
    </script>

    {{-- <script>
        const lastRecord = document.getElementById('last_record');

        const options = {
            root: null,
            threshold: 1,
            rootMargin: '0px'
        }

        const observer = new IntersectionObserver((entries, observe) => {
            entries.forEach(entry=>{
                if(entry.isIntersecting){
                    
                    /* loadMore() here is a laravel livewire method that is being called by the help of AlpineJS. This shizz is amazing!!*/
                    @this.loadMore();
                }
            });
        });

        console.log(lastRecord)
        observer.observe(lastRecord);
        //document.addEventListener('livewire:load', ()=>{});

    </script> --}}

    

    
@endpush





{{-- 
    <!-- Alpine JS component example -->
    <div x-data="{
            allParams: {},
            init() {
                const urlParams = new URLSearchParams(window.location.search);
                urlParams.forEach((value, key) => {
                    this.allParams[key] = value;
                });
            }
        }">
        <h3 x-show="Object.keys(allParams).length > 0">All Query Parameters:</h3>
        <ul x-show="Object.keys(allParams).length > 0">
            <template x-for="(value, key) in allParams" :key="key">
                <li><strong x-text="key"></strong>: <span x-text="value"></span></li>
            </template>
        </ul>
        <p x-show="Object.keys(allParams).length === 0">No query parameters found.</p>
    </div> --}}