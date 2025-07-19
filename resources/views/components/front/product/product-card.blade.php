@php
    $card_class = ($cardTheme == "dark") ? "bg-dark text-white" : "";
@endphp

    {{-- VIEW NOT IN USE --}}

    <!-- Product Card -->

    <div class="col-md-{{ $cardSize }}">
        <div class="card {{ $card_class }}" style="">
            <a href="{{ $slug }}">
                <img src="{{ asset($imageSlug) }}" class="card-img-top" alt="...">
            </a>
            
            <div class="card-body">
                <h5 class="text-center" >
                    {{ isset($itemName) ? $itemName : 'asdasd' }}
                </h5>
                {{-- <p class="card-text">
                    {{ $description }}
                </p> --}}
                

                @if($cardType == "wishlist")
                    <a href="#" class="btn btn-block btn-danger text-white">Remove</a>
                @endif
            </div>
        </div>
    </div>