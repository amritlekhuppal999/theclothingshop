
    @php
        //var_dump($product_array); echo "<br/>";
        //echo "SQL STR: "; var_dump($sql); echo "<br/>";
        //echo "SQL STR BND: "; var_dump($sql_str_binding); echo "<br/>";
        //echo "ERROR STR: "; var_dump($error_msg); echo "<br/>";

        //$product_array = [];
    @endphp


    <div class="row w-100 m-auto">
        @if(count($product_array))
            @foreach($product_array as $product_html)
                
                {{-- This allows us to render strings of HTML as HTML  --}}
                {!! $product_html !!}
                
            @endforeach

            
        @else
            
            @for($i = 0; $i < 4; $i++)
                <x-front.product.product-card
                    displayPage="home"
                    cardType="product"
                    cardSize="3"
                    cardTheme=""
                    slug="product"
                    imageSlug="images/product-card-loader.jpg"
                    description="Some quick example text to build on the card title and make up the bulk of the card's content."
                    itemName="loading..."
                />
            @endfor
            
        @endif
    </div>


    
    {{-- select 
        `products`.`id` as `product_id`, `products`.`product_name` as `product_name`, `products`.`product_slug` as `product_slug`, `PI`.`image_location` as `image_location`, `PI`.`prime_image` as `prime_image` 
    from 
        `featured_collection` as `FC` inner join `products` 
    on 
        `products`.`id` = `FC`.`product_id` 
    left join 
        `product_images` as `PI` 
    on 
        `products`.`id` = `PI`.`product_id` and `PI`.`prime_image` = 1 and `PI`.`status` = 1 
    where 
        `FC`.`collection_id` = (select `id` from `sub_category` where `sub_category_slug` = "new-additions" limit 1) limit 4 --}}