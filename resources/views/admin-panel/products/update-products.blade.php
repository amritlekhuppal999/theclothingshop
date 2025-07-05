@extends('layouts.dashboard')

@section('content-css')

    <!-- Select2 JS -->
    <link rel="stylesheet" href="{{ asset("plugins/select2/css/select2.min.css") }}">
    <link rel="stylesheet" href="{{ asset("plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css") }}">

    <!-- iCheck for checkboxes and radio inputs -->
    <link rel="stylesheet" href="{{ asset("plugins/icheck-bootstrap/icheck-bootstrap.min.css") }}">


    <style>
        label[for="radio"]{
            color: indigo;
        }
        
        .sub-category-container {
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(10px);
            border-radius: 10px;
            padding: 20px;
            /*box-shadow: 0 20px 40px rgba(0, 0, 0, 0.1);*/
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0);
            /*border: 1px solid rgba(255, 255, 255, 0.2);*/
            border: 1px solid lightgrey;
            /*max-width: 500px;*/
            width: 100%;
        }

        /*.sub-category-container h2 {
            text-align: center;
            color: #333;
            margin-bottom: 30px;
            font-weight: 600;
            font-size: 1.8em;
        }
        */

        .checkbox-item {
            display: inline-flex;
            align-items: center;
            margin: 10px;
            /*margin-bottom: 10px;*/
            /*margin: auto;*/
            padding: 10px;
            background: rgba(255, 255, 255, 0.7);
            border-radius: 12px;
            transition: all 0.3s ease;
            border: 2px solid transparent;
        }

        .checkbox-item:hover {
            background: rgba(255, 255, 255, 0.9);
            border-color: rgba(102, 126, 234, 0.3);
            transform: translateY(-2px);
            box-shadow: 0 8px 25px rgba(0, 0, 0, 0.1);
        }

        .checkbox-item input[type="checkbox"] {
            appearance: none;
            width: 24px;
            height: 24px;
            border: 2px solid #ddd;
            border-radius: 6px;
            margin-right: 15px;
            position: relative;
            cursor: pointer;
            transition: all 0.3s ease;
            flex-shrink: 0;
        }

        .checkbox-item input[type="checkbox"]:checked {
            background: linear-gradient(135deg, #667eea, #764ba2);
            border-color: #667eea;
        }

        .checkbox-item input[type="checkbox"]:checked::after {
            content: '✓';
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            color: white;
            font-weight: bold;
            font-size: 14px;
        }

        .checkbox-item input[type="checkbox"]:hover {
            border-color: #667eea;
            transform: scale(1.1);
        }

        .checkbox-item label {
            margin-top:8px;
            color: #555;
            font-weight: 500;
            cursor: pointer;
            user-select: none;
            flex: 1;
            font-size: 1.1em;
        }

        .checkbox-item:has(input:checked) {
            background: rgba(102, 126, 234, 0.1);
            border-color: rgba(102, 126, 234, 0.3);
        }

        .checkbox-item:has(input:checked) label {
            color: #333;
            font-weight: 600;
        }
    </style>
@endsection

@section('content')

    {{-- @php $page_url = explode("/", request()->path()); @endphp --}}
    
    <div class="content">
        <div class="container-fluid">

            {{-- Margin Div --}}
            <div class="row">
                <div class="col-md-12 mb-3"></div>
            </div>

            {{-- <h3> {{ request()->path() }} </h3> --}}
            {{-- <h3> @dump(explode("/", request()->path()) ) </h3> --}}

            {{-- Operation ERROR/SUCCESS Message --}}
            <div class="row">
                <div class="col-md-12">
                    @if(session('error'))
                        <div class="card card-danger">
                            <div class="card-header">
                                <h4 class="card-title"> {{ session('error') }} </h4>
                            </div>
                        </div>
                    @elseif(session('success'))
                        <div class="card card-success">
                            <div class="card-header">
                                <h4 class="card-title"> {{ session('success') }} </h4>
                            </div>
                        </div>
                    @endif
                </div>
            </div>

            {{-- Add Product Form --}}
            <div class="row">
                <div class="col-md-12">

                    {{-- card --}}
                    <div class="card card-purple card-outline">
                        
                        {{-- card body --}}
                        <div class="card-body">
                            
                            {{-- Product Name --}}
                            <h5 class="card-text mb-4">
                                Update Product:  <span class="text-purple">{{ $product["product_name"] }}</span> 
                            </h5>

                            <!-- form start -->
                            <form role="form" action="{{ route('update-product') }}" method="POST">
                                @csrf

                                {{-- Product ID --}}
                                <input type="hidden" id="product_id" name="product_id" value="{{ $product["id"] }}"/>

                                {{-- Category ID --}}
                                <input type="hidden" id="category_id" name="category_id" value="{{ $product["category_id"] }}"/>

                                {{-- Sub Category ID --}}
                                <input type="hidden" id="sub_category_id" name="sub_category_id" value="{{ $product["sub_category_id"] }}"/>

                                {{-- @error('category_id')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                                @error('sub_category_id')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                @enderror --}}

                                
                                {{-- Gender --}}
                                <div class="form-group clearfix">
                                    <label class="mr-2">Target Group</label>
                                    
                                    <label class="mr-2"> 
                                        <input 
                                            type="radio" 
                                            id="radioPrimary1" 
                                            name="targetGroup"  
                                            value="1" 
                                            {{ ($product["target_group"] == 1 ) ? 'checked' : '' }} 
                                        />
                                        Male
                                    </label>

                                    <label class="mr-2"> 
                                        <input 
                                            type="radio" 
                                            id="radioPrimary2" 
                                            name="targetGroup" 
                                            value="2"
                                            {{ ($product["target_group"] == 2 ) ? 'checked' : '' }}
                                        />
                                        Female
                                    </label>
                                    
                                    <label class="mr-2"> 
                                        <input 
                                            type="radio" 
                                            id="radioPrimary3" 
                                            name="targetGroup"  
                                            value="3"
                                            {{ ($product["target_group"] == 3 ) ? 'checked' : '' }}
                                        />
                                        Unisex
                                    </label>
                                </div>
                                @error('targetGroup')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                @enderror

                                {{-- Product Name --}}
                                <div class="form-group">
                                    <label for="">Product Name</label>
                                    <input 
                                        type="text" 
                                        class="form-control" 
                                        id="product_name" name="product_name" 
                                        placeholder="Product Name"
                                        value="{{ $product["product_name"] }}"
                                        required
                                    />
                                </div>
                                @error('product_name')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                @enderror

                                {{-- Product Slug --}}
                                <div class="form-group">
                                    <label for="">Product Slug</label>
                                    <input 
                                        type="text" 
                                        class="form-control" 
                                        id="product_slug" name="product_slug" 
                                        placeholder="Product slug"
                                        value="{{ $product["product_slug"] }}"
                                        required
                                    />
                                    

                                    {{-- Product Slug Backup to check if the value is changed after edit --}}
                                    <input type="hidden" name="product_slug_backup" id="product_slug_backup" value="{{ $product["product_slug"] }}" />
                                </div>
                                @error('product_slug')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                @enderror

                                
                                {{-- Base Price --}}
                                <div class="form-group">
                                    <label for="">Base Price (₹)</label>
                                    <input 
                                        type="number" 
                                        min="1"  
                                        class="form-control" 
                                        id="base-price" name="base_price" 
                                        placeholder="Base Price"
                                        value="{{ $product["base_price"] }}"
                                        step="0.01"
                                        required
                                    />
                                </div>
                                @error('base_price')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                @enderror

                                {{-- Discount --}}
                                <div class="form-group">
                                    <label for="">Discount Available %</label>
                                    <input 
                                        type="number" 
                                        max="99.99" min="0.00" 
                                        class="form-control" 
                                        id="discount-percentage" name="discount_percentage"
                                        placeholder="Discount"
                                        value="{{ $product["discount_percentage"] }}"
                                        step="0.01"
                                        required
                                    />
                                </div>
                                @error('discount_percentage')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                @enderror

                                {{-- Short Description --}}
                                <div class="form-group">
                                    <label for="">Short Description</label>
                                    @if(!empty($product["short_description"]))
                                        <textarea 
                                            class="form-control" 
                                            name="short_description" id="short-description"  
                                            rows="5">{{ $product["short_description"] }}</textarea>
                                        
                                    @else
                                        <textarea 
                                            class="form-control" 
                                            name="short_description" id="short-description"  
                                            rows="5"></textarea>
                                    @endif
                                </div>
                                @error('short_description')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                @enderror

                                {{-- Long Description --}}
                                <div class="form-group">
                                    <label for="">Long Description</label>
                                    @if(!empty($product["long_description"]))
                                        <textarea 
                                            class="form-control" 
                                            name="long_description" id="long-description"  
                                            rows="5">{{ $product["long_description"] }}</textarea>
                                        
                                    @else
                                        <textarea 
                                            class="form-control" 
                                            name="long_description" id="long-description"  
                                            rows="10"></textarea>
                                    @endif
                                    
                                </div>
                                @error('long_description')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                @enderror

                                <hr>
                                {{-- Select Category --}}
                                <div class="row">
                                    <div class="col-4">
                                        <div class="form-group">
                                            <label for="">Select Category</label>
                                            <select 
                                                name="select-category" 
                                                id="select-category" 
                                                class="form-control" 
                                                data-value="{{ isset($product["category_id"]) ? $product["category_id"] : '' }}">
                                                <option value="">Loading...</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                @error('category_id')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                @enderror

                                {{-- Select Sub-Category --}}
                                <div class="row mb-3">
                                    <div class="col-md-12">
                                        <label>Select Sub Category</label>
                                        <div class="sub-category-container" id="sub-category-container">
                                            {{-- <h4>Select Sub Category</h4> --}}
                                            
                                            {{-- <div class="checkbox-item">
                                                <input type="checkbox" id="option1">
                                                <label for="option1">Email Notifications</label>
                                            </div> --}}
                                        </div>
                                    </div>
                                </div>
                                @error('sub_category_id')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                                
                                {{-- Update product BTN --}}
                                <div class="form-group">
                                    <button 
                                        type="submit" 
                                        class="btn btn-secondary" 
                                        name="update-product" 
                                        id="update-product">
                                        Update Product
                                    </button>
                                </div>
                            
                            </form>
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

            $('.select2bs4').select2({
                theme: 'bootstrap4'
            })

            /*
                This value has been fetched from backend and converted to a json.
                Holds the value of sub-categories mapped to the given product.
            */
            const productSubCategories = @json($product_sub_categories);
            // console.log(productSubCategories);

            const current_url = MyApp.CURRENT_URL;

            const CATEGORY_ID_PRODUCT_FORM = document.getElementById('category_id');
            const SUB_CATEGORY_ID_PRODUCT_FORM = document.getElementById('sub_category_id');
            
            const SELECT_PRODUCT_ELEMENT = document.getElementById('select-product');

            load_category_list();
            //load_sub_category_list();

            // load category list
            async function load_category_list(){
                let category_element = document.getElementById('select-category');

                category_element.innerHTML = '<option value="">Loading...</option>';
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
                    //console.log(response_data);
                    //return response_data;

                    category_element.innerHTML = '<option value="">Select Category</option>';

                    let cat_id_set_FLAG = false;    // to check if the category id is set?

                    let category_list = response_data.category_list;
                    category_list.forEach((element, index)=>{
                        let selected = (category_element.dataset.value == element.id) ? "selected" : "";
                        //console.log(category_element.dataset.value, element.id, selected);
                        
                        // FOR setting values via query parameters (?cat=xyz&sub_cat=abc)
                        if(!cat_id_set_FLAG){
                            if(selected == "selected"){
                                CATEGORY_ID_PRODUCT_FORM.value = element.id;
                                load_sub_category_list(element.id);
                                cat_id_set_FLAG = true;
                            }
                            else CATEGORY_ID_PRODUCT_FORM.value = 0;
                        }

                        let opt_str = `<option value="${element.category_slug}" ${selected} data-id=${element.id}>${element.category_name}</option>`;
                        category_element.innerHTML += opt_str;
                    });
                    

                }
                catch(error){
                    console.error('Error:', error);
                }
            }

            // Load the sub category list 
            async function load_sub_category_list(category_id=0){

                let sub_category_element = document.getElementById('sub-category-container');

                sub_category_element.innerHTML = '<span class="animate-loading-text">Loading...</span>';

                if(!category_id){
                    sub_category_element.innerHTML = '<option value="">No category selected</option>';
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

                    sub_category_element.innerHTML = '';

                    // let sub_cat_id_set_FLAG = false;    // to check if the sub_category id is set?

                    let sub_category_list = response_data.sub_category_list;

                    sub_category_list.forEach((element, index)=>{
                        let checked = "";
                        const slugPresent = productSubCategories.some(subCategory => subCategory.sub_category_slug === element.sub_category_slug);
                        if(slugPresent){
                            checked = "checked";
                        }

                        let opt_str = `
                            <div class="checkbox-item">
                                <input type="checkbox" id="${element.sub_category_slug}" name="sub_category_id[]" value="${element.id}" ${checked}>
                                <label for="${element.sub_category_slug}">${element.sub_category_name}</label>
                            </div>`;
                        sub_category_element.innerHTML += opt_str;
                    });
                    
                    

                }
                catch(error){
                    console.error('Error:', error);
                }
            }
        
            // get category id from the select category element AND passing the category slug in the URL
            document.getElementById("select-category").addEventListener('change', event=>{
                let select_element = event.target;

                let selected_option = select_element.options[select_element.selectedIndex];
                let category_id = (selected_option.dataset.id) ? selected_option.dataset.id : 0;
                let category_slug = selected_option.value;

                SUB_CATEGORY_ID_PRODUCT_FORM.value = 0;
                CATEGORY_ID_PRODUCT_FORM.value = category_id;
                
                load_sub_category_list(category_id);
                /*
                if(category_id){
                    let new_url = appendQueryString(current_url, 'cat', category_slug);
                    history.pushState(null, null, new_url);
                }
                else {
                    history.pushState(null, null, current_url);
                }
                */
            });

            // passing the sub category slug in the URL
            /*document.getElementById("select-sub-category").addEventListener('change', event=>{
                let select_element = event.target;

                let selected_option = select_element.options[select_element.selectedIndex];
                let sub_category_slug = selected_option.value;
                let sub_category_id = (selected_option.dataset.id) ? selected_option.dataset.id : 0;
                // load_sub_category_images(selected_option.dataset.id);
                let category_slug;
                let category_ele = document.getElementById("select-category");
                if(category_ele.value){
                    category_slug = category_ele.value;
                }
                
                SUB_CATEGORY_ID_PRODUCT_FORM.value = sub_category_id;

                
                // let new_url = appendQueryString(current_url, 'cat', category_slug);
                // new_url = appendQueryString(new_url, 'sub_cat', sub_category_slug);
                // history.pushState(null, null, new_url);
                
            });*/


            // Set product slug
            document.getElementById("product_name").addEventListener('keyup', event=>{
                let element = event.target;
                let product_name = element.value;
                product_name = MyApp.remove_whitespace(product_name);
                document.getElementById('product_slug').value = MyApp.generate_slug(product_name);
            });
            
            
            document.addEventListener('click', (event)=>{
                let element = event.target;

                return false;

                if(element.id == "save-category"){
                    event.preventDefault();
                    

                    let category = document.getElementById("select-category").value;
                    let sub_category = document.getElementById("select-sub-category").value;

                    if(category !== "0" && sub_category !== "0"){
                        alert("category saved");
                        location.href = `${MyApp.ADMIN_URL}/products-add/${sub_category}`;
                    }

                }

                // change product
                else if(element.id == "change-product-btn"){
                    let product_slug = document.getElementById("change-product").value;

                    if(product_slug !== "0"){
                        // alert(product_slug);

                        location.href = `${MyApp.ADMIN_URL}/${element.dataset.url}/${product_slug}`;

                    }
                }

                // else alert(element.className);
            });

            
        };

        
    </script>
@endsection