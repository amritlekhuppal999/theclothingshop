@php
    $card_class = ($cardTheme == "dark") ? "bg-dark text-white" : "";
    $card_size_class = "";
    
    
    if($cardType === "product"){
        $card_size_class = "col-6 col-md-3 col-lg-3 col-xl-3";
    }
    else if($cardType === "category"){
        $card_size_class = "col-12 col-md-4";
    }
    else if($cardType === "category-remaining"){
        $card_size_class = "col-6 col-md-3";
    }
@endphp

    {{-- VIEW NOT IN USE --}}

    <!-- Product Card -->

    <div 
        {{-- class="col-md-{{ $cardSize }}"  --}}
        class="{{ $card_size_class }}" 
        title="{{ isset($itemName) ? $itemName : 'loading...' }}">
        <div class="card {{ $card_class }}" style="">
            
            <a href="{{ $slug }}" class="text-decoration-none text-reset">
                <img src="{{ asset($imageSlug) }}" class="card-img-top" alt="...">
                
                <div class="card-body">
                    <h5 class="text-center cursor-pointer {{$cardType}}-title-re">
                        {{ isset($itemName) ? $itemName : 'loading...' }}
                    </h5>
                    {{-- <p class="card-text">
                        {{ $description }}
                    </p> --}}
                    

                    @if($cardType == "wishlist")
                        <a href="#" class="btn btn-block btn-danger text-white">Remove</a>
                    @endif
                </div>
            </a>
            
        </div>
    </div>