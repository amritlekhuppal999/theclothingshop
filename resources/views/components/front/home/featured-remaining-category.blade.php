    @php
        // var_dump($product_array); echo "<br/>";
        // echo "SQL STR: "; var_dump($sql); echo "<br/>";
        // echo "SQL STR BND: "; var_dump($sql_str_binding); echo "<br/>";
        // echo "ERROR STR: ";var_dump($error_msg); echo "<br/>";
    @endphp

    <div class="row w-100 m-auto">
        @if(count($product_array))
            @foreach($product_array as $product_html)
                
                {{-- This allows us to render strings of HTML as HTML  --}}
                {!! $product_html !!}
                
            @endforeach
        @else
            
            {{-- <h4>Its Broken</h4> --}}

            @for($i = 0; $i < 4; $i++)
                <x-front.product.product-card
                    displayPage="home"
                    cardType="category"
                    cardSize="3"
                    cardTheme=""
                    slug="category"
                    imageSlug="images/product-card-loader.jpg"
                    description="Some quick example text to build on the card title and make up the bulk of the card's content."
                    itemName="loading..."
                />
            @endfor
            
        @endif
    </div>





    {{-- 
        <x-front.product.product-card
            displayPage="home"
            cardType="category"
            cardSize="3"
            cardTheme=""
            slug="category"
            imageSlug="https://prod-img.thesouledstore.com/public/theSoul/uploads/catalog/product/1724912570_5870366.jpg?format=webp&w=480&dpr=1.0"
            description="Some quick example text to build on the card title and make up the bulk of the card's content."
            itemName="Polos"
        />

        <x-front.product.product-card
            displayPage="home"
            cardType="category"
            cardSize="3"
            cardTheme=""
            slug="category"
            imageSlug="https://prod-img.thesouledstore.com/public/theSoul/uploads/catalog/product/1713943206_9376927.png?format=webp&w=480&dpr=1.0"
            description="Some quick example text to build on the card title and make up the bulk of the card's content."
        />

        <x-front.product.product-card
            displayPage="home"
            cardType="category"
            cardSize="3"
            cardTheme=""
            slug="category"
            imageSlug="https://prod-img.thesouledstore.com/public/theSoul/uploads/catalog/product/1723875789_8404256.jpg?format=webp&w=480&dpr=1.0"
            description="Some quick example text to build on the card title and make up the bulk of the card's content."
        />

        <x-front.product.product-card
            displayPage="home"
            cardType="category"
            cardSize="3"
            cardTheme=""
            slug="category"
            imageSlug="https://prod-img.thesouledstore.com/public/theSoul/uploads/catalog/product/1723875789_7940407.jpg?format=webp&w=480&dpr=1.0"
            description="Some quick example text to build on the card title and make up the bulk of the card's content."
        />

        <x-front.product.product-card
            displayPage="home"
            cardType="category"
            cardSize="3"
            cardTheme=""
            slug="category"
            imageSlug="https://prod-img.thesouledstore.com/public/theSoul/uploads/catalog/product/1709968005_4121325.jpg?format=webp&w=480&dpr=1.0"
            description="Some quick example text to build on the card title and make up the bulk of the card's content."
        />

        <x-front.product.product-card
            displayPage="home"
            cardType="category"
            cardSize="3"
            cardTheme=""
            slug="category"
            imageSlug="https://prod-img.thesouledstore.com/public/theSoul/uploads/catalog/product/1726122231_3508839.jpg?exp_id=41fc062fc4&group=b&format=webp&w=480&dpr=1.0"
            description="Some quick example text to build on the card title and make up the bulk of the card's content."
        />

        <x-front.product.product-card
            displayPage="home"
            cardType="category"
            cardSize="3"
            cardTheme=""
            slug="category"
            imageSlug="https://prod-img.thesouledstore.com/public/theSoul/uploads/catalog/product/1726325300_2818328.jpg?format=webp&w=480&dpr=1.0"
            description="Some quick example text to build on the card title and make up the bulk of the card's content."
        />

        <x-front.product.product-card
            displayPage="home"
            cardType="category"
            cardSize="3"
            cardTheme=""
            slug="category"
            imageSlug="https://prod-img.thesouledstore.com/public/theSoul/uploads/catalog/product/1726325221_5236500.jpg?format=webp&w=480&dpr=1.0"
            description="Some quick example text to build on the card title and make up the bulk of the card's content."
        /> 
    --}}