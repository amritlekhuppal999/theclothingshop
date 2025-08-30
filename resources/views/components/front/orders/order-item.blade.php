
    {{-- Order Items --}}

    <div class="col-md-12">
        <div class="card mb-3" style="">
            <div class="row g-0">
                <div class="col-md-2">
                    <a href="{{ $orderItem["product_slug"] }}">
                        <img 
                            src="{{ asset($orderItem["product_image"]) }}" 
                            class="img-fluid rounded-start" 
                            alt="..." 
                            style="height:100%;"
                        />
                        
                    </a>
                </div>
                
                <div class="col-md-8">
                    <div class="card-body">
                        <h5 class="card-text">
                            <a href="{{ $orderItem["product_slug"] }}"> {{ $orderItem["product_name"] }} </a>    
                        </h5>
                        <h6 class="card-subtitle mb-2 text-muted"> {{ $orderItem["category"] }} </h6>
                        
                        <div class="text-muted small">
                            <span>Size: {{ $orderItem["size"] }} </span> | 
                            <span>Color: {{ $orderItem["color"] }} </span> | 
                            <span>Qty: {{ $orderItem["quantity"] }} </span>
                        </div>

                        <p class="card-text">
                            <small class="text-muted">Status: </small>
                            <small class="text-muted">{{ $orderItem["status"] }}</small>
                        </p>

                        <button type="button" class="btn btn-secondary btn-xs" class="write-product-review">
                            Write Review
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>