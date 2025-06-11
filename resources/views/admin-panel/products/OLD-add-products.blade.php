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
    </style>
@endsection

@section('content')

    @php
        $page_url = explode("/", request()->path());
    @endphp
    
    <div class="content">
        <div class="container-fluid">

            {{-- Margin Div --}}
            <div class="row">
                <div class="col-md-12 mb-3"></div>
            </div>

            {{-- <h3> {{ request()->path() }} </h3> --}}
            {{-- <h3> @dump(explode("/", request()->path()) ) </h3> --}}

            {{-- SELECT Category --}}
            <div class="row">
                
                {{-- Select Category --}}
                <div class="col-4">
                    <div class="form-group">
                        <select 
                            name="select-category" 
                            id="select-category" 
                            class="form-control" 
                            data-value="{{ $category_slug }}">
                            <option value="">Loading...</option>
                        </select>
                    </div>
                </div>

                {{-- Select Sub-Category --}}
                <div class="col-4">
                    <div class="form-group">
                        <select 
                            name="select-sub-category" 
                            id="select-sub-category" 
                            class="form-control" 
                            data-value="{{ $sub_category_slug }}">
                            <option value="">Select Sub Category</option>
                        </select>
                    </div>
                </div>
            </div>

            {{-- Add Product Form --}}
            <div class="row">
                <div class="col-md-12">

                    {{-- card --}}
                    <div class="card card-purple ">
                        {{-- card header --}}
                        <div class="card-header">
                            <h3 class="card-title">Add Product</h3>

                            {{-- collapse-expand BTN --}}
                            <div class="card-tools">
                                <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                    <i class="fas fa-plus"></i>
                                </button>
                            </div>
                        </div>
                        
                        {{-- card body --}}
                        <div class="card-body">
                            <!-- form start -->
                            <form role="form" action="{{ route('add-product') }}" method="POST">
                                @csrf

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

                                {{-- Category ID --}}
                                <input type="hidden" id="category_id" name="category_id" value="{{ old('category_id') }}"/>

                                {{-- Sub Category ID --}}
                                <input type="hidden" id="sub_category_id" name="sub_category_id" value="{{ old('sub_category_id') }}"/>

                                @error('category_id')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                                @error('sub_category_id')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                @enderror

                                {{-- Gender --}}
                                <div class="form-group clearfix">
                                    <label class="mr-2">Target Group</label>
                                    
                                    <label class="mr-2"> 
                                        <input type="radio" id="radioPrimary1" name="targetGroup"  value="1">
                                        Male
                                    </label>

                                    <label class="mr-2"> 
                                        <input type="radio" id="radioPrimary2" name="targetGroup" value="2">
                                        Female
                                    </label>
                                    
                                    <label class="mr-2"> 
                                        <input type="radio" id="radioPrimary3" name="targetGroup"  value="3">
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
                                        value="{{ old('product_name') }}"
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
                                        value="{{ old('product_slug') }}"
                                        required
                                    />
                                    {{-- <span id="slug-alert-msg"></span> --}}
                                </div>
                                @error('product_slug')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                @enderror

                                {{-- Cost Price --}}
                                {{-- <div class="form-group">
                                    <label for="">Cost Price</label>
                                    <input type="text" class="form-control" id="cost-price" name="cost-price" placeholder="Cost Price">
                                </div> --}}

                                {{-- Base Price --}}
                                <div class="form-group">
                                    <label for="">Base Price (₹)</label>
                                    <input 
                                        type="number" 
                                        min="1.00"  
                                        class="form-control" 
                                        id="base-price" name="base_price" 
                                        placeholder="Base Price"
                                        value="{{ old('base_price') }}"
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
                                        max="100.00" min="0.00" 
                                        class="form-control" 
                                        id="discount-percentage" name="discount_percentage"
                                        placeholder="Discount"
                                        value="{{ old('discount_percentage') }}"
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
                                    <textarea 
                                        class="form-control" 
                                        name="short_description" id="short-description"  
                                        rows="5"></textarea>
                                </div>
                                @error('short_description')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                @enderror

                                {{-- Long Description --}}
                                <div class="form-group">
                                    <label for="">Long Description</label>
                                    <textarea 
                                        class="form-control" 
                                        name="long_description" id="long-description"  
                                        rows="10"></textarea>
                                </div>
                                @error('long_description')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                @enderror


                                {{-- <div class="form-check">
                                    <input type="checkbox" class="form-check-input" id="exampleCheck1">
                                    <label class="form-check-label" for="exampleCheck1">Check me out</label>
                                </div> --}}

                                {{-- Save product BTN --}}
                                <div class="form-group">
                                    <button 
                                        type="submit" 
                                        class="btn btn-secondary" 
                                        name="save-product" 
                                        id="save-product">
                                        Save Product
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

            const current_url = CURRENT_URL;

            const CATEGORY_ID_PRODUCT_FORM = document.getElementById('category_id');
            const SUB_CATEGORY_ID_PRODUCT_FORM = document.getElementById('sub_category_id');

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
                        let selected = (category_element.dataset.value === element.category_slug) ? "selected" : "";
                        
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

                let sub_category_element = document.getElementById('select-sub-category');

                sub_category_element.innerHTML = '<option value="">Loading...</option>';

                if(!category_id){
                    sub_category_element.innerHTML = '<option value="">Select Sub-Category</option>';
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
                        let selected = (sub_category_element.dataset.value === element.sub_category_slug) ? "selected" : "";

                        // FOR setting values via query parameters (?cat=xyz&sub_cat=abc)
                        if(!sub_cat_id_set_FLAG){
                            if(selected == "selected"){
                                SUB_CATEGORY_ID_PRODUCT_FORM.value = element.id;
                                sub_cat_id_set_FLAG = true;
                            }
                            else SUB_CATEGORY_ID_PRODUCT_FORM.value = 0;
                        }
                        
                        let opt_str = `<option value="${element.sub_category_slug}" ${selected} data-id=${element.id}>${element.sub_category_name}</option>`;
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
                if(category_id){
                    let new_url = appendQueryString(current_url, 'cat', category_slug);
                    history.pushState(null, null, new_url);
                }
                else {
                    history.pushState(null, null, current_url);
                }
            });

            // passing the sub category slug in the URL
            document.getElementById("select-sub-category").addEventListener('change', event=>{
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


                let new_url = appendQueryString(current_url, 'cat', category_slug);
                new_url = appendQueryString(new_url, 'sub_cat', sub_category_slug);
                history.pushState(null, null, new_url);
            });


            // Set product slug
            document.getElementById("product_name").addEventListener('keyup', event=>{
                let element = event.target;
                let product_name = element.value;
                product_name = remove_whitespace(product_name);
                document.getElementById('product_slug').value = generate_slug(product_name);
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
                        location.href = `${ADMIN_URL}/products-add/${sub_category}`;
                    }

                }

                // change product
                else if(element.id == "change-product-btn"){
                    let product_slug = document.getElementById("change-product").value;

                    if(product_slug !== "0"){
                        // alert(product_slug);

                        location.href = `${ADMIN_URL}/${element.dataset.url}/${product_slug}`;

                    }
                }

                // else alert(element.className);
            });

            
        };

        
    </script>
@endsection