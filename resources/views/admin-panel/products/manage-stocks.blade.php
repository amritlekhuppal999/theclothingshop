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

        {{-- Select Product & Variant --}}
        <div class="row">

            {{-- Select Product --}}
            <div class="col-md-4 mb-2">
                
                <select 
                    name="select-product" 
                    id="select-product" 
                    class="form-control" 
                    data-value="{{ isset($productSlug) ? $productSlug : "" }}">
                    <option value="">Loading...</option>
                </select>
            </div>


            {{-- Select VARIANT --}}
            <div class="col-md-4 mb-2">
                
                <select 
                    name="select-variant" 
                    id="select-variant" 
                    class="form-control" 
                    data-value="{{-- ss --}}">
                    <option value="">Loading...</option>
                </select>
            </div>
        </div>
        
        <div class="row">
 
            <div class="col-lg-6">
                {{-- <x-admin.tables.table-component /> --}}

                <div class="card">
                    <div class="card-header border-transparent" id="stock-detail"></div>

                    <form action="{{ route("update-variant-stock") }}" method="POST">
                        @csrf

                        <div class="card-body">

                            {{-- Operation Error/Success Message --}}
                            @if(session('error'))
                                <div class="form-group">
                                    <span class="text-danger">
                                        {{ session('error') }}
                                    </span>
                                </div>
                            @elseif(session('success'))
                                <div class="form-group">
                                    <span class="text-success">
                                        {{ session('success') }}
                                    </span>
                                </div>
                            @endif

                            <input type="hidden" name="variant_id" id="variant_id" />

                            <div class="form-group">
                                <label>Quantity</label>
                                <input 
                                    type="number" 
                                    min="1"
                                    class="form-control" 
                                    id="quantity" name="quantity" 
                                    placeholder="Quantity"
                                    value="{{ old("quantity") }}"
                                    step="1"
                                    required
                                />
                            </div>

                            <div class="form-group">
                                <label>Price</label>
                                <input 
                                    type="number" 
                                    min="1.00"
                                    class="form-control" 
                                    id="price" name="price" 
                                    placeholder="Price"
                                    value="{{ old("price") }}"
                                    step="0.01"
                                    required
                                />
                            </div>
                        </div>
                        
                        <div class="card-footer">
                            <button type="submit" class="btn btn bg-purple">Update Stock</button>
                        </div>

                    </form>
        
                    
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

            let product_name = "";
            let variant_name = "";


            const SELECT_PRODUCT_ELEMENT = document.getElementById("select-product");
            const SELECT_VARIANT_ELEMENT = document.getElementById("select-variant");

            // Set product ID
            SELECT_PRODUCT_ELEMENT.addEventListener('change', event=>{
                // let select_element = event.target;
                let selected_option = SELECT_PRODUCT_ELEMENT.options[SELECT_PRODUCT_ELEMENT.selectedIndex];
                product_id = set_product_id();
                
                product_name = selected_option.innerText;

                // const CURRENT_URL = `${PROTOCOL}//${HOSTNAME}:${PORT}${PATHNAME}`;
                //location.href = `${PROTOCOL}//${HOSTNAME}:${PORT}/admin/products-variants/${selected_option.value}`;

                load_variant_list(product_id);
            });

            SELECT_VARIANT_ELEMENT.addEventListener('change', event=>{
                // let select_element = event.target;
                let selected_option = SELECT_VARIANT_ELEMENT.options[SELECT_VARIANT_ELEMENT.selectedIndex];
                variant_name = selected_option.innerText;
                let variant_id = selected_option.dataset.id;

                document.getElementById("stock-detail").innerHTML = `<h3 class="card-title text-purple">${product_name} | ${variant_name}</h3>`;
                document.getElementById("variant_id").value = variant_id;
                get_variant(variant_id);
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

            load_variant_list();
            async function load_variant_list(product_id=null){
                //let product_element = document.getElementById('select-product');

                SELECT_VARIANT_ELEMENT.innerHTML = '<option value="">Loading...</option>';
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

                let url = '/admin/get-variant-list';

                if(product_id){
                    url+= '?product_id='+product_id;
                }

                try{
                    let response = await fetch(url, request_options);
                    // console.log(response);
                    let response_data = await response.json();
                    //console.log(response_data);
                    //return response_data;

                    SELECT_VARIANT_ELEMENT.innerHTML = '<option value="">Select Variant</option>';

                    let variant_list = response_data.variant_list;
                    variant_list.forEach((element, index)=>{
                        let selected = (SELECT_VARIANT_ELEMENT.dataset.value === element.variant_slug) ? "selected" : "";

                        let opt_str = `<option value="${element.variant_slug}" ${selected} data-id=${element.id}>${element.variant_name}</option>`;
                        SELECT_VARIANT_ELEMENT.innerHTML += opt_str;
                    });
                    
                    
                }
                catch(error){
                    console.error('Error:', error);
                }
            }


            async function get_variant(variant_id){
                let quantity_element = document.getElementById('quantity');
                let price_element = document.getElementById('price');

                
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

                let url = '/admin/get-variant-stock';

                if(variant_id){
                    url+= '?variant_id='+variant_id;
                }

                try{
                    let response = await fetch(url, request_options);
                    // console.log(response);
                    let response_data = await response.json();
                    // console.log(response_data);
                    //return response_data;

                    quantity_element.value = response_data.variant_stock.stock;
                    price_element.value = response_data.variant_stock.price;

                    
                    
                    
                }
                catch(error){
                    console.error('Error:', error);
                }
            }
            
        }



        
    </script>
@endsection

