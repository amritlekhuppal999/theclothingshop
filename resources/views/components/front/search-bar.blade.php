
    {{-- Search Bar --}}
    
    <div class="{{ $divClass }}">
        <input class="form-control" type="search" placeholder="{{ $placeholder }}" id="{{ $id }}" >
        
        {{-- Search Results --}}
        <div id="show-search-results" class="search-results-{{ $page }}" style="z-index:9; position:absolute; width:97%;" hidden>
            <ul class="list-group">
                <a href="/category" class="list-group-item list-group-item-action">An item</a>
                <a href="#" class="list-group-item list-group-item-action">A second link item</a>
                <a href="#" class="list-group-item list-group-item-action">A third link item</a>
                <a href="#" class="list-group-item list-group-item-action">A fourth link item</a>
                <a href="#" class="list-group-item list-group-item-action disabled" tabindex="-1" aria-disabled="true">A disabled link item</a>
            </ul>
        </div>
    </div>



    {{-- How this component is used..

        <x-front.search-bar 
            page="orders" 
            divClass="col-md-8"
            placeholder="Search orders"
            id="orders-search-bar"
        /> 

    --}}
