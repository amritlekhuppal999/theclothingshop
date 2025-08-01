

    <div class="row" id="livewire-load-wishlist-items">

        @if($wishlist_items->isNotEmpty())
            
            @foreach($wishlist_items as $key => $item)
                
                <div class="col-md-3" wire:key="item-{{ $item["id"] }}" @if($loop->last) id="last_record" @endif>
                    
                    <div class="card product-card border-0 {{ ($key == 0) ? 'dark' : '' }}">
                        <div class="product-image">
                            <a href="{{ safe_route('product', ["product_slug" => $item["product_slug"]]) }}">
                                <img 
                                    @php
                                        $loc_img = ($item["image_location"] !=null ) ? $item["image_location"] : 'images/product-card-loader.jpg';
                                    @endphp
                                    src="{{ asset($loc_img) }}" 
                                    alt="{{ $item["product_name"] }}" class="card-img-top"
                                />
                            </a>
                            
                        </div>

                        <div class="card-body">
                            <a 
                                href="{{ safe_route('product', ["product_slug" => $item["product_slug"]]) }}"
                                class="text-decoration-none">
                                <h5 class="product-title">
                                    {{ $item["product_name"] }}
                                </h5>
                            </a>

                            <a href="#" 
                                class="btn btn-block btn-danger text-white remove-item" 
                                data-product_id="{{ $item["product_id"] }}"
                                data-item_id="{{ $item["id"] }}">
                                Remove
                            </a>
                        </div>
                    </div>
                </div>
            @endforeach

            
            @if($item_load_limit < $totalRecords)
                <div class="col-md-12 text-center"
                    x-data
                    x-intersect="$wire.load_more()">
                    {{-- <h3>Loading more...</h3> --}}
                    <h3>Loading...</h3>
                </div>
            @endif
        @else
            <div class="col-md-12">
                <h3>Haven't saved anything yet...</h3>
            </div>
        @endif

        
    </div>