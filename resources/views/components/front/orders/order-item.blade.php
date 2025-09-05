
    {{-- Order Items --}}

    @if(count($orderItem))
        
        @foreach($orderItem as $items)

            @php
                $image_location = isset($items["image_location"]) ? $items["image_location"] : "/images/product-card-loader.jpg";
            @endphp
            
            <div class="col-md-12">
                <div class="card mb-3" style="">
                    <div class="row g-0">
                        <div class="col-md-2">
                            <a href="{{ safe_route('product', ["product_slug" => $items["product_slug"]]) }}">
                                <img 
                                    src="{{ asset($image_location) }}" 
                                    class="img-fluid rounded-start" 
                                    alt="..." 
                                    style="height:100%;"
                                />
                                
                            </a>
                        </div>
                        
                        <div class="col-md-8">
                            <div class="card-body">
                                <h5 class="card-text">
                                    <a href="{{ safe_route('product', ["product_slug" => $items["product_slug"]]) }}"
                                        class="product-title text-decoration-none"> 
                                        {{ $items["product_name"] }} 
                                    </a>    
                                </h5>
                                <h6 class="card-subtitle mb-2 text-muted"> {{ $items["category_name"] }} </h6>
                                
                                {{-- <div class="text-muted small">
                                    <span>Size: {{ $items["size"] }} </span> | 
                                    <span>Color: {{ $items["color"] }} </span> | 
                                    <span>Qty: {{ $items["quantity"] }} </span>
                                </div> --}}

                                <p class="card-text">
                                    <small class="text-muted">Status: </small>
                                    {{-- <small class="text-muted">{{ $items["status"] }}</small> --}}
                                </p>

                                <button type="button" class="btn btn-secondary btn-xs" class="write-product-review">
                                    Write Review
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
        @endforeach

    @else
        
    @endif
