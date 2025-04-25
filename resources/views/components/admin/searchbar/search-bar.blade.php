    {{-- ADMIN Search Bar --}}
    
    {{-- <div class="{{ $divClass }}">
        <input class="form-control" type="search" placeholder="{{ $placeholder }}" id="{{ $id }}" >
        
        <!-- Search Results -->
        {{ $slot }}
    </div> --}}

    <div class="{{ $divClass }}">
        <div class="input-group">
            <input 
                type="text" 
                class="form-control" 
                placeholder="{{ $placeholder }}" 
                id="{{ $id }}"
                value="{{ $value }}"
            />
            
            <div class="input-group-append ">
                <button type="button" class="input-group-text" id="search-btn">
                    <i class="fas fa-search"></i>
                </button>
            </div>
        </div>
    </div>




    {{-- How this component is used in admin..

        <x-admin.searchbar.search-bar 
            page="dashboard" 
            divClass="offset-md-2 col-md-8 mb-2"
            placeholder="Search.. (Inactive)"
            id="dashboard-search-bar"
        />

    --}}


    {{-- <div class="card-header border-transparent   d-flex align-items-center justify-content-between flex-wrap">
        <h3 class="card-title  mb-2 mb-md-0">Products</h3>

        <div class="mx-auto mb-2 mb-md-0" style="min-width: 300px; flex-grow: 1; max-width: 500px;">
            <x-admin.searchbar.search-bar 
                page="products" 
                divClass="w-100"
                placeholder="Search product"
                id="product-search-bar" 
            />
        </div>

        <div class="card-tools  mb-2 mb-md-0">
            <a href="{{ route("products-add") }}" class="btn btn-sm btn-info ">Add New</a>
            <a href="{{ route("products-variants") }}" class="btn btn-sm btn-secondary ">View Variants</a>
        </div>
    </div> --}}