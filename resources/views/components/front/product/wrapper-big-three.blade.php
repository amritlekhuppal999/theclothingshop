
{{-- 

    So we tried dynamically loading nested components for dynamica data, but the child component was not being rendered.
    GPT suggested to create a wrapper blade view, include the component in it and return that via ajax call. DIDN'T WORK!!!

    So Lastly I tried using the `slot` feature of the components as you can see below.....
    Ended up back to square 1, The child is not being rendered as HTML.

    SO THIS EXERCISE WAS A BUST. WILL CHECK OUT Alpine.js and see if that helps. 
    OR LAREVEL LIVEWIRE,
    OR Go t he REACT/VUE route!!!

    TL;DR
    THIS PAGE IS USELESS AS OF NOW!!!

 --}}

    @php
        //var_dump($sub_category); echo "<br /> <br />";
        // var_dump($sql); echo "<br /> <br />";
        // var_dump($error_msg); echo "<br /> <br />";
        
    @endphp



    <x-front.product.featured-big-three>

        @if($sub_category->count())
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

    </x-front.product.featured-big-three>