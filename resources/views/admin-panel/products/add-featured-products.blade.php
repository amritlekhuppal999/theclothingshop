@extends('layouts.dashboard')
    

@section('content-css')
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

        <div class="row">
            
            <div class="col-md-6 offset-md-3">
                <div class="card card-purple">
                    <div class="card-header">
                        <h3 class="card-title">Feature Product</h3>
                    </div>
                    
                    <form action="{{ safe_route('add-featured-product') }}" method="POST" role="form">
                        @csrf

                        {{-- Card Body --}}
                        <div class="card-body">
                            
                            <div class="row">
                                {{-- Select Category --}}
                                <div class="col-md-6">
                                    <div class="form-group">
                                        {{-- <label>Category</label> --}}
                                        <select 
                                            data-live-search="true"
                                            name="selectCategory" 
                                            id="selectCategory" 
                                            class="form-control"
                                            data-value="{{-- isset($category_slug) ? $category_slug : "" --}}">
                                            <option value="">Loading...</option>
                                        </select>
                                    </div>
                                    @error('selectCategory')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>

                                {{-- Select Sub Category --}}
                                <div class="col-md-6">
                                    <div class="form-group">
                                        {{-- <label>Sub-Category</label> --}}
                                        <select 
                                            data-live-search="true"
                                            name="selectSubCategory" 
                                            id="selectSubCategory" 
                                            class="form-control"
                                            data-value="{{-- isset($sub_category_slug) ? $sub_category_slug : "" --}}">
                                            {{-- <option value="">Loading...</option> --}}
                                            <option value="">Select Sub-Category</option>
                                        </select>
                                    </div>
                                    @error('selectSubCategory')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>


                            {{-- category and sub-category ID --}}
                            <input type="text" name="categoryID" id="categoryID" hidden />
                            <input type="text" name="subCategoryID" id="subCategoryID" hidden />



                            {{-- Select Product --}}
                            <div class="form-group">
                                <select 
                                    name="selectProduct" 
                                    id="selectProduct" 
                                    class="form-control"
                                    required>
                                    {{-- <option value="">Loading...</option> --}}
                                    <option value="">Select Product</option>
                                </select>
                            </div>
                            @error('selectProduct')
                                <div class="alert alert-danger">{{ $message }}</div>
                            @enderror

                            {{-- Select Collection --}}
                            <div class="form-group">
                                <label> Featured in which collection? </label>
                                <select 
                                    name="selectCollection" 
                                    id="selectCollection" 
                                    class="form-control"
                                    required>
                                    <option value="">Loading...</option>
                                </select>
                            </div>
                            @error('selectCollection')
                                <div class="alert alert-danger">{{ $message }}</div>
                            @enderror

                            {{-- Display Page --}}
                            <div class="form-group">
                                <label title="Page to be featured on.">Display Page</label>
                                <input 
                                    type="text"
                                    class="form-control" 
                                    id="display_page" name="display_page" 
                                    placeholder="Display Page"
                                    value="{{ old('display_page') }}"
                                    required
                                />
                                {{-- <span id="slug-alert-msg"></span> --}}
                            </div>
                            @error('display_page')
                                <div class="alert alert-danger">{{ $message }}</div>
                            @enderror

                            {{-- Operation Error Message --}}
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
                        </div>

                        <div class="card-footer">
                            <button type="submit" class="btn bg-purple">Feature</button>
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

            /*
            $('.select2bs4').select2({
                theme: 'bootstrap4'
            })
            */

            const current_url = CURRENT_URL;

            const CATEGORY_ID_INPUT = document.getElementById("categoryID");
            const SUB_CATEGORY_ID_INPUT = document.getElementById("subCategoryID");
            
            const SELECT_PRODUCT = document.getElementById("selectProduct");
            const SELECT_COLLECTION = document.getElementById("selectCollection");
            

            load_category_list();
            load_collection_list();

            async function load_category_list(){
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

                let url = '/admin/get-category-list';

                try{
                    let response = await fetch(url, request_options);
                    // console.log(response);
                    let response_data = await response.json();
                    // console.log(response_data);
                    //return response_data;

                    let category_element = document.getElementById('selectCategory');

                    category_element.innerHTML = '<option value="">Select Category</option>';

                    let cat_id_set_FLAG = false;    // to check if the category id is set?

                    let category_list = response_data.category_list;
                    category_list.forEach((element, index)=>{

                        //let selected = (category_element.dataset.value === element.category_slug) ? "selected" : "";

                        if(element.category_slug == "topwear" || element.category_slug == "bottomwear" || element.category_slug == "sneakers"){
                            
                            // FOR setting values via query parameters (?cat=xyz&sub_cat=abc)
                            /*
                            if(!cat_id_set_FLAG){
                                if(selected == "selected"){
                                    //CATEGORY_ID_INPUT.value = element.id;
                                    load_sub_category_list(element.id);
                                    cat_id_set_FLAG = true;
                                }
                                // else CATEGORY_ID_INPUT.value = 0;
                            }
                            */
                            

                            let opt_str = `<option 
                                    value="${element.id}" data-slug="${element.category_slug}" data-id=${element.id}>
                                    ${element.category_name}
                                </option>`;
                            category_element.innerHTML += opt_str;
                        }
                        
                    });
                    

                }
                catch(error){
                    console.error('Error:', error);
                }
            }

            // Load the sub category list 
            async function load_sub_category_list(category_id=0){

                let sub_category_element = document.getElementById('selectSubCategory');

                sub_category_element.innerHTML = '<option value="">Loading...</option>';

                if(!category_id){
                    sub_category_element.innerHTML = '<option value="">Select Sub-Category</option>';
                    //subCategoryID.value = 0;
                    return false;
                }

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

                let url = '/admin/get-sub-category-list/'+category_id;

                try{
                    let response = await fetch(url, request_options);
                    // console.log(response);
                    let response_data = await response.json();
                    //console.log(response_data);
                    //return response_data;

                    sub_category_element.innerHTML = '<option value="">Select Sub Category</option>';

                    let sub_cat_id_set_FLAG = false;    // to check if the sub_category id is set?

                    let sub_category_list = response_data.sub_category_list;

                    sub_category_list.forEach((element, index)=>{

                        // let selected = (sub_category_element.dataset.value === element.sub_category_slug) ? "selected" : "";

                        // FOR setting values via query parameters (?cat=xyz&sub_cat=abc)
                        /*
                        if(!sub_cat_id_set_FLAG){
                            if(selected == "selected"){
                                // SUB_CATEGORY_ID_INPUT.value = element.id;
                                sub_cat_id_set_FLAG = true;
                            }
                            // else SUB_CATEGORY_ID_INPUT.value = 0;
                        }
                        */
                        
                        let opt_str = `<option value="${element.sub_category_slug}" data-id=${element.id}>${element.sub_category_name}</option>`;
                        sub_category_element.innerHTML += opt_str;
                    });
                    
                    

                }
                catch(error){
                    console.error('Error:', error);
                }
            }

            // load product list
            async function load_product_list(category_id, sub_category_id){
                //let product_element = document.getElementById('select-product');

                SELECT_PRODUCT.innerHTML = '<option value="">Loading...</option>';
                
                const request_data = {
                    category_id: category_id,
                    sub_category_id: sub_category_id,
                };
                const params = new URLSearchParams(request_data);
                
                const request_options = {
                    method: 'GET',
                    // headers: {},
                    // body: JSON.stringify(request_data)
                };

                let url = '/admin/get-product-list?'+params;
                // console.log(url);
                //return false;

                try{
                    let response = await fetch(url, request_options);
                    // console.log(response);
                    let response_data = await response.json();
                    //console.log(response_data);
                    //return response_data;

                    SELECT_PRODUCT.innerHTML = '<option value="">Select Product</option>';

                    let prod_id_set_FLAG = false;    // to check if the product id is set?

                    let product_list = response_data.product_list;
                    product_list.forEach((element, index)=>{
                        let selected = (SELECT_PRODUCT.dataset.value === element.product_slug) ? "selected" : "";

                        let opt_str = `<option value="${element.id}" ${selected} data-slug=${element.product_slug}>${element.product_name}</option>`;
                        SELECT_PRODUCT.innerHTML += opt_str;
                    });
                    
                    //product_id = set_product_id();
                }
                catch(error){
                    console.error('Error:', error);
                }
            }


            // Load the collection 
            async function load_collection_list(){

                SELECT_COLLECTION.innerHTML = '<option value="">Loading...</option>';

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

                let url = '/admin/get-collections';

                try{
                    let response = await fetch(url, request_options);
                    // console.log(response);
                    let response_data = await response.json();
                    //console.log(response_data);
                    //return response_data;

                    SELECT_COLLECTION.innerHTML = '<option value="">Select Collection</option>';

                    let collection_list = response_data.collection_list;

                    collection_list.forEach((element, index)=>{

                        // let opt_str = `<option value="${element.sub_category_slug}" data-id=${element.id}>${element.sub_category_name}</option>`;
                        let opt_str = `<option value="${element.id}" data-slug=${element.sub_category_slug}>${element.sub_category_name}</option>`;
                        SELECT_COLLECTION.innerHTML += opt_str;
                    });
                }
                catch(error){
                    console.error('Error:', error);
                }
            }

            document.getElementById("selectCategory").addEventListener('change', event=>{
                let select_element = event.target;

                let selected_option = select_element.options[select_element.selectedIndex];
                let category_id = (selected_option.dataset.id) ? selected_option.dataset.id : 0;
                let category_slug = selected_option.value;

                CATEGORY_ID_INPUT.value = category_id;    
                SUB_CATEGORY_ID_INPUT.value = 0;      // T0 reset Sub Category ID     
                
                load_sub_category_list(category_id);
                load_product_list(CATEGORY_ID_INPUT.value, SUB_CATEGORY_ID_INPUT.value);
                /*if(category_id){
                    let new_url = appendQueryString(current_url, 'cat', category_slug);
                    history.pushState(null, null, new_url);
                }
                else {
                    history.pushState(null, null, current_url);
                }*/
            });

            // passing the sub category slug in the URL
            document.getElementById("selectSubCategory").addEventListener('change', event=>{
                let select_element = event.target;

                let selected_option = select_element.options[select_element.selectedIndex];
                let sub_category_slug = selected_option.value;
                let sub_category_id = (selected_option.dataset.id) ? selected_option.dataset.id : 0;
                // load_sub_category_images(selected_option.dataset.id);

                SUB_CATEGORY_ID_INPUT.value = sub_category_id;
                load_product_list(CATEGORY_ID_INPUT.value, SUB_CATEGORY_ID_INPUT.value);

                //let category_slug;
                /*
                let category_ele = document.getElementById("select-category");
                if(category_ele.value){
                    category_slug = category_ele.value;
                }
                */
                

                /*
                let new_url = appendQueryString(current_url, 'cat', category_slug);
                new_url = appendQueryString(new_url, 'sub_cat', sub_category_slug);
                history.pushState(null, null, new_url);
                */
            });
            
            
            /*
            document.addEventListener('keyup', event=>{
                let element = event.target;

                if(element.id == "subCategoryName"){
                    let sub_category_name = element.value;
                    sub_category_name = remove_whitespace(sub_category_name);
                    document.getElementById('subCategorySlug').value = generate_slug(sub_category_name);
                }
            });
            */
        }


    </script>
@endsection