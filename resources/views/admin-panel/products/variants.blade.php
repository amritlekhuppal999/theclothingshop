@extends('layouts.dashboard')

@section('content-css')
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <meta name="action-sub-product-url" content="{{ route('sub-product-action') }}">
    
    <!-- Select2 JS -->
    <link rel="stylesheet" href="{{ asset("plugins/select2/css/select2.min.css") }}">
    <link rel="stylesheet" href="{{ asset("plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css") }}">
@endsection

@section('content')
    
    <div class="content">
      <div class="container-fluid">

        {{-- Margin Div --}}
        <div class="row">
            <div class="col-md-12 mb-2"></div>
        </div>

        {{-- Select Product --}}
        <div class="row">
            <div class="col-md-4 mb-2">
                
                <select 
                    name="select-product" 
                    id="select-product" 
                    class="form-control" 
                    data-value="{{$productSlug}}">
                    <option value="">Loading...</option>
                </select>
            </div>

        </div>
        
        <div class="row">
 
            <div class="col-lg-12">
                {{-- <x-admin.tables.table-component /> --}}

                <div class="card">
        
                    <div class="card-header border-transparent    d-flex align-items-center justify-content-between flex-wrap">
                        <h3 class="card-title   mb-2 mb-md-0">Variants</h3>

                        <div class="mx-auto mb-2 mb-md-0   d-flex align-items-center justify-content-between" style="min-width: 300px; flex-grow: 1; max-width: 600px;">
                            <x-admin.searchbar.search-bar 
                                page="variants" 
                                divClass="w-100 mr-1"
                                placeholder="Search by name, category, group, price and discount"
                                id="variant-search-bar"
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
                            <a href="{{ route("products-add-variants") }}" class="btn btn-sm btn-secondary">Add New Variant</a>
                        </div>
                    </div>

                    
                    <div class="card-body p-0">
                        <div class="table-responsive">
                            <table class="table m-0">
                                <thead>
                                    <tr>
                                        <th>Sno</th>
                                        <th>Product</th>
                                        <th>Variant Name </th>
                                        <th>SKU</th>
                                        <th>Price (₹)</th>
                                        <th>Stock</th>
                                        <th>Status</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>

                                <tbody>
                                    @if($sub_product_list->total())
                                        
                                        @php
                                            $counter = 0;
                                        @endphp

                                        @foreach($sub_product_list as $sub_product)
                                            <tr class="variant-action-row">
                                                <td>
                                                    <a href="#">{{++$counter}}</a>
                                                </td>

                                                <td>{{ $sub_product["product_name"] }}</td> 
                                                <td>{{ $sub_product["variant_name"] }}</td> 
                                                <td>{{ $sub_product["sku"] }}</td> 
                                                <td>₹ {{ $sub_product["price"] }} </td>
                                                <td>
                                                    @if($sub_product["stock_status"])
                                                        {{ $sub_product["stock"] }}      
                                                    @else
                                                        <span class="text-sm text-danger">
                                                            {{ getStockStatus($sub_product["stock_status"]) }}
                                                        </span>
                                                    @endif

                                                    
                                                    
                                                </td>
                                                
                                                <td>
                                                    @if($sub_product["status"] == 1)
                                                        <span class="badge badge-success">{{ getGeneralStatus($sub_product["status"]) }}</span>
                                                    @elseif($sub_product["status"] == 0)
                                                        <span class="badge badge-danger">{{ getGeneralStatus($sub_product["status"]) }}</span>
                                                    @endif
                                                </td>

                                                <td class="variant-action-section">

                                                    @if($sub_product["status"])
                                                        {{-- Add Images --}}
                                                        <a 
                                                            href="{{ route("variants-add-images", ["subProductSlug" => $sub_product["variant_slug"]]) }}"
                                                            class="btn btn-sm btn-info">
                                                            Images
                                                        </a>

                                                        {{-- Edit --}}
                                                        <a 
                                                            class="btn btn-sm btn-secondary"
                                                            href="{{ route("variants-update", ["subProductSlug" => $sub_product["variant_slug"]]) }}"
                                                            class="btn btn-sm btn-secondary">
                                                            Edit
                                                        </a>

                                                        {{-- Delete --}}
                                                        <button 
                                                            type="button" 
                                                            class="btn btn-sm btn-danger delete-sub_product"
                                                            data-sub_product_name="{{ $sub_product["variant_name"] }}"
                                                            data-sub_product_id="{{ $sub_product["id"] }}"
                                                            data-sub_product_slug="{{ $sub_product["variant_slug"] }}">
                                                            Delete
                                                        </button>
                                                    @else
                                                        {{-- Restore --}}
                                                        <button 
                                                            type="button" 
                                                            class="btn btn-sm btn-success restore-sub_product"
                                                            data-sub_product_name="{{ $sub_product["variant_name"] }}"
                                                            data-sub_product_id="{{ $sub_product["id"] }}"
                                                            data-sub_product_slug="{{ $sub_product["variant_slug"] }}">
                                                            Restore
                                                        </button>
                                                    @endif
                                                    
                                                </td>
                                            </tr>
                                        @endforeach
                                    
                                    @else
                                        <tr>
                                            <td colspan="8" class="text-center">
                                                No <span>variants</span> found for selected <span>product</span>
                                            </td>
                                        </tr>
                                    @endif
                                </tbody>

                            </table>
                        </div>
                        
                    </div>

                    {{-- Pagination --}}
                    <div class="card-footer clearfix">
                        {{ $sub_product_list->links() }}
                    </div>
                    
                    
                </div>

            </div>

        </div>
        
      </div>
    </div>

@endsection


@section('content-scripts')
    <!-- Select2 JS -->
    <script src="{{ asset('plugins/select2/js/select2.full.min.js') }}"></script>

    <script>

        window.onload = ()=>{

            let product_id = 0;


            const SELECT_PRODUCT_ELEMENT = document.getElementById("select-product");

            // Event Listener for various elements in DOM
            document.addEventListener('click', event=>{
                let element = event.target;

                /*
                if(element.id =="load-sub_categories"){
                    let category_slug = document.getElementById("select-category").value;
                    
                    location.href = `/admin/sub-category/${category_slug}`;
                }
                */

                // delete sub category 
                if(element.className.includes("delete-sub_product")){
                    // delete_sub_category(element);
                    if(window.confirm(`You wish to delete ${element.dataset.sub_product_name}?`)){
                        sub_category_action(element, "delete-sub_product");
                    }
                }

                // restore sub category 
                else if(element.className.includes("restore-sub_product")){
                    if(window.confirm(`You wish to restore ${element.dataset.sub_product_name}?`)){
                        sub_category_action(element, "restore-sub_product");
                    }
                }
            });

            document.addEventListener('change', event=>{

                let element = event.target;

                // load based on category
                if(element.id === "select-category"){
                    let category_slug = element.value;
                    
                    location.href = `/admin/sub-category/${category_slug}`;
                }

                // load based on status
                if(element.id === "select-status"){
                    let category_status = element.value;
                    
                    let new_location = MyApp.appendQueryString(MyApp.CURRENT_URL, "status", category_status);

                    //if(category_status == "") new_location = '/admin/sub-category';

                    location.href = new_location;
                }
            });

            // Set product ID
            SELECT_PRODUCT_ELEMENT.addEventListener('change', event=>{
                // let select_element = event.target;
                let selected_option = SELECT_PRODUCT_ELEMENT.options[SELECT_PRODUCT_ELEMENT.selectedIndex];
                product_id = set_product_id();

                // const MyApp.CURRENT_URL = `${MyApp.PROTOCOL}//${MyApp.HOSTNAME}:${MyApp.PORT}${MyApp.PATHNAME}`;

                location.href = `${MyApp.PROTOCOL}//${MyApp.HOSTNAME}:${MyApp.PORT}/admin/products-variants/${selected_option.value}`;
            });


            // set product id
            function set_product_id(){
                let selected_option = SELECT_PRODUCT_ELEMENT.options[SELECT_PRODUCT_ELEMENT.selectedIndex];
                return selected_option.dataset.id;
            }

            
            load_product_list();
            // load product list
            async function load_product_list(){
                //let product_element = document.getElementById('select-product');

                SELECT_PRODUCT_ELEMENT.innerHTML = '<option value="">Loading...</option>';
                /*
                const request_data = {
                    result_count: result_count
                };
                const params = new URLSearchParams(request_data);
                */
                
                const request_options = {
                    method: 'GET',
                    // headers: {},
                    // body: JSON.stringify(request_data)
                };

                let url = '/admin/get-product-list';

                try{
                    let response = await fetch(url, request_options);
                    // console.log(response);
                    let response_data = await response.json();
                    //console.log(response_data);
                    //return response_data;

                    SELECT_PRODUCT_ELEMENT.innerHTML = '<option value="">Select Product</option>';

                    let prod_id_set_FLAG = false;    // to check if the product id is set?

                    let product_list = response_data.product_list;
                    product_list.forEach((element, index)=>{
                        let selected = (SELECT_PRODUCT_ELEMENT.dataset.value === element.product_slug) ? "selected" : "";

                        let opt_str = `<option value="${element.product_slug}" ${selected} data-id=${element.id}>${element.product_name}</option>`;
                        SELECT_PRODUCT_ELEMENT.innerHTML += opt_str;
                    });
                    
                    product_id = set_product_id();
                }
                catch(error){
                    console.error('Error:', error);
                }
            }

            // delete sub category function
            async function delete_sub_category_X(delete_btn){
                let sub_category_id = delete_btn.dataset.sub_category_id;
                let delete_BTN_Content = delete_btn.innerHTML;
                delete_btn.innerHTML = MyApp.LOADER_SMALL;
                delete_btn.disabled = true;
                // return false;

                let form_data = {
                    sub_category_id: sub_category_id,
                };

                // console.log(form_data);

                const request_options = {
                    method: 'POST',
                    headers: {
                        'content-type': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                    },
                    body: JSON.stringify(form_data)
                };

                
                // let url = '{{ route("delete-sub-category") }}';
                // let url = 'sub-category-delete';
                let url = document.querySelector('meta[name="delete-sub-product-url"]').getAttribute('content');

                console.log(url)

                try{
                    let response = await fetch(url, request_options);
                    //console.log(response);
                    let response_data = await response.json();

                    //console.log('Response:', response_data);
                    
                    if(response_data.deleted){
                        toastr.success(response_data.message);
                        
                        //submit_btn.innerHTML = submit_btn_cont;
                        //submit_btn.disabled = false;
                        setTimeout(() => {
                            location.reload();
                            //window.location.href = home_url;
                        }, 1000);
                    }
                    else {
                        toastr.error(response_data.message);
                        delete_btn.disabled = false;
                        delete_btn.innerHTML = delete_BTN_Content;
                    }
                }
                catch(error){
                    console.error('Error:', error);
                }
            }

            async function sub_category_action(action_btn, requested_action=""){
                let sub_product_id = action_btn.dataset.sub_product_id;
                // let requested_action;
                let action_btn_content = action_btn.innerHTML;
                action_btn.innerHTML = MyApp.LOADER_SMALL;
                action_btn.disabled = true;
                // return false;

                let form_data = {
                    sub_product_id: sub_product_id,
                    requested_action: requested_action
                };

                // console.log(form_data);

                const request_options = {
                    method: 'POST',
                    headers: {
                        'content-type': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                    },
                    body: JSON.stringify(form_data)
                };

                
                let url = document.querySelector('meta[name="action-sub-product-url"]').getAttribute('content');

                // console.log(url)

                try{
                    let response = await fetch(url, request_options);
                    //console.log(response);
                    let response_data = await response.json();
                    //console.log('Response:', response_data);

                    switch (response.status) {
                        case MyApp.REQUEST_SUCCESSFUL:
                            if(response_data.requested_action_performed){

                                action_btn.innerHTML = MyApp.CHECK_SUCCESS;
                                toastr.success(response_data.message);
                                setTimeout(()=>{
                                    // action_btn.closest(".variant-action-row").remove();
                                    location.reload();
                                }, 1500);
                            }
                        break;

                        case MyApp.VALIDATION_ERROR:
                            if(response_data.errors){
                                response_data.errors.forEach(message_element=>{
                                    // toastr.error(message_element);
                                    toastr.warning('<span style="color: blue;">'+message_element+'</span>');
                                });
                            }
                            else toastr.error(response_data.message);
                        break;

                        case MyApp.BAD_REQUEST_ERROR:
                            //toastr.error(response_data.message);
                            toastr.warning('<span style="color: blue;">'+response_data.message+'</span>');
                        break;

                        case MyApp.INTERNAL_SERVER_ERROR:
                            toastr.error(response_data.message);
                            console.log(response_data.errors);
                        break;
                        
                        default:
                        toastr.error("Something went down. We are fixing it.");
                    }
                }
                catch(error){
                    console.error('Fetch Error:', error);
                    toastr.error("Something went wrong!!");
                    //resetSubmitBTN();
                }
            }



            // SEARCH ACTION
            
                let result_options = {
                    search_keyword: '',
                    limit: 10,
                    //start: 0
                };

                const VARIANT_SEARCH_BAR = document.getElementById("variant-search-bar");
                const VARIANT_SEARCH_BTN = document.getElementById("search-btn");
                // const PRODUCT_RESULT_SECTION = document.getElementById("load-product-list");

                VARIANT_SEARCH_BAR.addEventListener('keypress', event=>{
                    if(event.key === "Enter"){
                        search_action(VARIANT_SEARCH_BAR);
                    }
                });

                VARIANT_SEARCH_BTN.addEventListener('click', event=>{
                    search_action(VARIANT_SEARCH_BAR);
                });


                function search_action(target_ele){
                    result_options.search_keyword = target_ele.value.replace(/\s/g, " ");

                    if(result_options.search_keyword.length){
                        const queryParams = new URLSearchParams(result_options);
                        let new_url = MyApp.CURRENT_URL+'?'+queryParams;
                        location.href = new_url;
                        //history.pushState(null, null, new_url);
                        //load_products(result_options);
                    }
                }

            // SEARCH ACTION END
        }



        
    </script>
@endsection

