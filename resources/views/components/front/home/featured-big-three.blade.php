<!-- Happiness is not something readymade. It comes from your own actions. - Dalai Lama -->
    @php
        // var_dump($sub_category); echo "<br/>";
        //echo "SQL STR: "; var_dump($sql_query); echo "<br/>";
        // echo "ERROR STR: ";var_dump($error_msg); echo "<br/>";
    @endphp
    
    <div class="row w-100 m-auto" >
        @if(count($product_array))
            @foreach($product_array as $product_html)
                
                {{-- This allows us to render strings of HTML as HTML  --}}
                {!! $product_html !!}
                
            @endforeach
        @else
            
            {{-- <h4>Its Broken</h4> --}}

            @for($i = 0; $i < 3; $i++)
                <x-front.product.product-card
                    displayPage="home"
                    cardType="category"
                    cardSize="4"
                    cardTheme="dark"
                    slug="category"
                    imageSlug="images/product-card-loader.jpg"
                    description="Some quick example text to build on the card title and make up the bulk of the card's content."
                    itemName="loading..."
                />
            @endfor
            
        @endif
    </div>


    {{-- <div class="row w-100 m-auto" >
        @if($sub_category->isNotEmpty())
            @foreach($sub_category as $key => $sub_cat)
                
                <x-front.product.product-card
                    displayPage="home"
                    cardType="category"
                    cardSize="4"
                    cardTheme="{{ ($key == 0) ? 'dark' : '' }}"
                    slug="{{ $sub_cat["SC_slug"] }}"
                    imageSlug="{{ $sub_cat["SCIL"] }}"
                    description=""
                    itemName="{{ $sub_cat["SC_name"] }}"
                />
            @endforeach
        @else
            
            @for($i = 0; $i < 3; $i++)
                <x-front.product.product-card
                    displayPage="home"
                    cardType="category"
                    cardSize="4"
                    cardTheme="dark"
                    slug="category"
                    imageSlug="images/product-card-loader.jpg"
                    description="Some quick example text to build on the card title and make up the bulk of the card's content."
                    itemName="loading..."
                />
            @endfor
        @endif
    </div> --}}


    {{-- <div class="row w-100 m-auto" >

        {{ $slot }}
    </div> --}}