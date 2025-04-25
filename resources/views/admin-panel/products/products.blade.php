@extends('layouts.dashboard')

@section('content-css')

@endsection

@section('content')
    
    <div class="content">
      <div class="container-fluid">

        {{-- Margin Div --}}
        <div class="row">
            <div class="col-md-12 mb-2"></div>
        </div>

        {{-- infobox --}}
        <div class="row">
            <x-admin.info-box-component
                infoText="Total Products Added"
                infoValue="{{$total_products_added}}"
                boxLogo="fas fa-tshirt"
            />

            <x-admin.info-box-component
                infoText="Inventory"
                infoValue="{{$inventory}}"
                boxLogo="fas fa-tshirt"
                alertType="Success"
            />

            <x-admin.info-box-component
                infoText="Out of stock"
                infoValue="{{$out_of_stock}}"
                boxLogo="fas fa-tshirt"
                alertType="Warning"
            />
        </div>
        
        <div class="row">
            <div class="col-lg-12">
                {{-- <x-admin.tables.table-component /> --}}


                <div class="card">

                    <div class="card-header    d-flex align-items-center justify-content-between flex-wrap">
                        <h3 class="card-title  mb-2 mb-md-0">Products</h3>

                        <div class="mx-auto mb-2 mb-md-0   d-flex align-items-center justify-content-between" style="min-width: 300px; flex-grow: 1; max-width: 600px;">
                            <x-admin.searchbar.search-bar 
                                page="products" 
                                divClass="w-100 mr-1"
                                placeholder="Search by name, category, group, price and discount"
                                id="product-search-bar"
                                value="{{ $search_keyword }}"
                            />
                            <button type="button" class="btn btn-sm btn-info w-50" id="advance-search-btn">
                                Advance Filter
                            </button>
                        </div>

                        <div class="card-tools  mb-2 mb-md-0">
                            {{-- <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                <i class="fas fa-minus"></i>
                            </button>
                            <button type="button" class="btn btn-tool" data-card-widget="remove">
                                <i class="fas fa-times"></i>
                            </button> --}}

                            

                            <a href="{{ route("products-add") }}" class="btn btn-sm btn-info ">Add New</a>
                            <a href="{{ route("products-variants") }}" class="btn btn-sm btn-secondary ">View Variants</a>
                        </div>
                    </div>

                    
                    <div class="card-body p-0">
                        <div class="table-responsive" style="overflow-x:auto !important;">
                            <table class="table m-0" >
                                <thead>
                                    <tr>
                                        <th>S.no</th>
                                        <th >Product Name</th>
                                        <th>Group</th>
                                        <th style="width:25%">Category</th>
                                        <th>Base Price (₹)</th>
                                        <th>Discount (%)</th>
                                        <th>Status</th>
                                        <th >Action</th>
                                    </tr>
                                </thead>

                                <tbody id="load-product-list" class="">
                                    
                                    <x-admin.search-result.ProductSearchResult :productList="$product_list" />   
                                    
                                </tbody>
                            </table>
                        </div>
                        <!-- /.table-responsive -->
                    </div>


                    {{-- Pagination --}}
                    <div class="card-footer clearfix">
                        {{ $product_list->links() }}
                    </div>
                    
                </div>
            </div>

        </div>

        
        
      </div>
    </div>

@endsection


@section('content-scripts')
    {{-- <script src="{{ asset('js/search_product.js') }}"></script> --}}


    <script>
        let result_options = {
            search_keyword: '',
            limit: 10,
            //start: 0
        };

        const PRODUCT_SEARCH_BAR = document.getElementById("product-search-bar");
        const PRODUCT_SEARCH_BTN = document.getElementById("search-btn");
        // const PRODUCT_RESULT_SECTION = document.getElementById("load-product-list");

        PRODUCT_SEARCH_BAR.addEventListener('keypress', event=>{
            if(event.key === "Enter"){
                search_action(PRODUCT_SEARCH_BAR);
            }
        });

        PRODUCT_SEARCH_BTN.addEventListener('click', event=>{
            search_action(PRODUCT_SEARCH_BAR);
        });


        function search_action(target_ele){
            result_options.search_keyword = target_ele.value.replace(/\s/g, " ");

            if(result_options.search_keyword.length){
                const queryParams = new URLSearchParams(result_options);
                let new_url = CURRENT_URL+'?'+queryParams;
                location.href = new_url;
                //history.pushState(null, null, new_url);
                //load_products(result_options);
            }
        }
    </script>
@endsection