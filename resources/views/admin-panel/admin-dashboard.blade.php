@extends('layouts.dashboard')

@section('content-css')

@endsection

@section('content')
    
    <div class="content">
      <div class="container-fluid">

        {{-- Margin Div --}}
        <div class="row">
            <div class="col-md-12 mb-2"></div>

            {{-- Searchbar --}}
            {{-- <x-admin.searchbar.search-bar 
                page="dashboard" 
                divClass="offset-md-2 col-md-8 mb-2"
                placeholder="Search.. (Inactive)"
                id="dashboard-search-bar" /> --}}

            <x-admin.searchbar.search-bar 
                page="dashboard" 
                divClass="offset-md-2 col-md-8 mb-2"
                placeholder="Search.. (Inactive)"
                id="dashboard-search-bar"
                value="">

                {{-- Search result slot --}}
                <div id="show-dashboard-search-results" class="search-results-dashboard" style="z-index:9; position:absolute; width:97%;" hidden>
                    <ul class="list-group">
                        <a href="#" class="list-group-item list-group-item-action">An item</a>
                        <a href="#" class="list-group-item list-group-item-action">A second link item</a>
                        <a href="#" class="list-group-item list-group-item-action">A third link item</a>
                        <a href="#" class="list-group-item list-group-item-action">A fourth link item</a>
                        <a href="#" class="list-group-item list-group-item-action disabled" tabindex="-1" aria-disabled="true">A disabled link item</a>
                    </ul>
                </div>

            </x-admin.searchbar.search-bar>
            

            <div class="col-md-12 mb-2">
                <h3>DASHBOARD</h3>            
                <h3 class="text-center">TODO LIST</h3>       
            </div>

            <div class="col-md-6 mb-2">

                <h3 class="text-success">MANAGE PRODUCT</h3>
                <h3 class="text-success">MANAGE VARIANTS</h3>
                <h3 class="text-success">SEARCH-BAR Component</h3>
                <h3 class="text-danger">Advance Filter</h3>
                <h3 class="text-secondary">SKU GENERATOR</h3>
                <h3 class="text-success">EDIT PRODUCT</h3>
                <h3 class="text-success">EDIT VARIANTS - some change needed</h3>
                <h3 class="text-secondary">VARIANT IMAGES</h3>
                <h3 class="text-success">MANAGE STOCK</h3>
                <h3 class="text-red">Database Records Deleter</h3>
                <h3 class="text-red">BANNER IMAGES add link, page, etc fields in db</h3>
            </div>

            <div class="col-md-6 mb-2">
                <h3 class="text-danger">MAKE FRONT END FUNCTIONAL</h3>
                <h3 class="text-success">FE-LOAD PRODUCTS</h3>
                <h3 class="text-success">FE-MAKE DYNAMIC</h3>
                <h3 class="text-success">Category PRODUCT PAGE size and color attributes</h3>
                <h3 class="text-success">PRODUCT PAGE</h3>
                <h4 class="text-secondary">PRODUCT PAGE Check Availablity</h4>
                <h3 class="text-danger">CART</h3>
                <h3 class="text-danger">CHECKOUT</h3>
                <h3 class="text-danger">ORDER</h3>
                
            </div>


            <div class="col-md-12 mb-5"></div>


            <div class="col-md-6 mb-2">
                <h3 class="text-danger">MANAGE ORDER</h3>
                <h3 class="text-danger">DELIVERY PARTNER INTEGRATION</h3>
                <h3 class="text-danger">PAYMENT GATEWAY INTEGRATION</h3>
                <h3 class="text-danger">MANAGE RETURNS / REFUNDS</h3>
                <h3 class="text-danger">MANAGE SALES</h3>
            </div>
        </div>

        <div class="row">
            <div class="col-lg-12">
                
            </div>

        </div>
        
      </div>
    </div>

@endsection


@section('content-scripts')
    
@endsection