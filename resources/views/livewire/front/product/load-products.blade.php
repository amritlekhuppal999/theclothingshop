

<div class="row" id="livewire-load-product">
    
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


            <div class="col-md-3" wire:key="item-{{ $product["product_id"] }}" @if($loop->last) id="last_record" @endif>
                <div class="card {{ ($key == 0) ? 'dark' : '' }}" style="">
                    <a href="{{ safe_route('product', ["product_slug" => $product["product_slug"]]) }}">
                        <img 
                            @php
                                $loc_img = ($product["image_location"] !=null ) ? $product["image_location"] : 'images/product-card-loader.jpg';
                            @endphp
                            src="{{  asset($loc_img) }}" 
                            class="card-img-top" alt="..."
                        />
                    </a>
                    
                    <div class="card-body">
                        <h5 class="text-center" >
                            {{ $product["product_name"] }}
                        </h5>
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
            <div class="col-md-12 text-center">
                <h3>That's all from us!!</h3>
            </div>
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