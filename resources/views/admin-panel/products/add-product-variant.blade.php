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

    <div class="content">
        <div class="container-fluid">

            {{-- Margin Div --}}
            <div class="row">
                <div class="col-md-12 mb-3"></div>
            </div>

            {{-- Margin Div --}}
            <div class="row">
                <h3 class="text-danger">
                    ADD VARIANT OPERATION PENDING
                </h3>
            </div>

            {{-- SELECT PRODUCT --}}
            <div class="row">
                
                {{-- Select PRODUCT --}}
                <div class="col-4">
                    <div class="form-group">
                        <select 
                            name="select-product" 
                            id="select-product" 
                            class="form-control" 
                            data-value="{{--$category_slug--}}">
                            <option value="">Loading...</option>
                        </select>
                    </div>
                </div>
            </div>


            {{-- Variant Form --}}
            <div class="row">
                <div class="col-md-12">

                    {{-- card --}}
                    <div class="card card-secondary "> {{-- collapsed-card --}}
                        {{-- card header --}}
                        <div class="card-header">
                            <h3 class="card-title">Add Product Variants</h3>

                            {{-- collapse-expand BTN --}}
                            <div class="card-tools">
                                <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                    <i class="fas fa-minus"></i>
                                </button>
                            </div>
                        </div>
                        

                        <!-- Card body (form start) -->
                        <div class="card-body">
                            <form role="form">

                                <div class="row">
                                    <div class="col-md-6">
                                        {{-- Variant Name --}}
                                        <div class="form-group">
                                            <label for="">Variant Name</label>
                                            <input 
                                                type="text" 
                                                class="form-control" 
                                                id="variant-name" name="variant-name" 
                                                placeholder="Variant Name"
                                                required
                                            />
                                        </div>
                                    
                                    </div>

                                    <div class="col-md-6">
                                        {{-- Variant Name --}}
                                        <div class="form-group">
                                            <label for="">Variant Slug</label>
                                            <input 
                                                type="text" 
                                                class="form-control" 
                                                id="variant-slug" name="variant-slug" 
                                                placeholder="Variant Slug"
                                                required
                                            />
                                        </div>
                                    </div>
                                </div>

                                {{-- Added Variants (Not saved in DB) --}}
                                <div class="row">
                                    <div class="col-md-12">
                                        <table class="table table-bordered table-hover">
                                            <caption>List of Added Variants</caption>
                                            <thead class="">
                                                <tr>
                                                    <th>Sno</th>
                                                    <th>Size</th>
                                                    <th>Color</th>
                                                    <th>Quantity</th>
                                                    <th>Action</th>
                                                </tr>
                                            </thead>
                                            <tbody id="added-variant-list">
                                                <tr>
                                                    <th>1</th>
                                                    <td>XL</td>
                                                    <td>Red</td>
                                                    <td>100</td>
                                                    <td>
                                                        <a href="#" class="text-danger">
                                                            Remove Variant
                                                        </a>
                                                    </td>
                                                </tr>
                                            </tbody>
                                            <tfoot>
                                                <tr>
                                                    <td colspan="5" class="text-right">
                                                        <button 
                                                            type="button" 
                                                            class="btn btn-danger" 
                                                            id="clear-variant-list">
                                                            Clear List
                                                        </button>
                                                    </td>
                                                </tr>
                                            </tfoot>
                                        </table>
                                    </div>
                                </div>
                                

                                {{-- Variant Details (size, color, qty) --}}
                                <div class="row">

                                    {{-- Select Size --}}
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="">Select Size</label>
                                            <select class="form-control select2bs4" name="select-variant-size" id="select-variant-size">
                                                <option value="0">Select</option>
                                                <option value="1">XS</option>
                                                <option value="2">S</option>
                                                <option value="3">M</option>
                                                <option value="4" selected>L</option>
                                                <option value="5">XL</option>
                                                <option value="6">XXL</option>
                                                <option value="7">XXXL</option>
                                            </select>
                                        </div>
                                    </div>

                                    {{-- Select Color --}}
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="">Select Color</label>
                                            <select class="form-control select2bs4" name="select-variant-color" id="select-variant-color">
                                                <option value="0">Select</option>
                                                <option value="1">Red</option>
                                                <option value="2">Green</option>
                                                <option value="3">Blue</option>
                                                <option value="4">Orange</option>
                                                <option value="5" selected>Purple</option>
                                                <option value="6">Indigo</option>
                                                <option value="7">Cyan</option>
                                            </select>
                                        </div>
                                    </div>

                                    {{-- Enter Quantity --}}
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="">Enter Quantity</label>
                                            <input 
                                                type="number" min="0" 
                                                name="variant-quantity" id="variant-quantity" 
                                                placeholder="Total no of items"
                                                class="form-control"
                                                required
                                            />
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-12 d-flex justify-content-between">
                                        {{-- Add Another Variant BTN --}}
                                        <button type="button" class="btn btn-secondary">Add Another Variant</button>

                                        {{-- Proceed Next --}}
                                        <button type="submit" class="btn btn-primary">Next</button>
                                    </div>
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

            load_product_list();
            //load_sub_category_list();

            // load product list
            async function load_product_list(){
                let product_element = document.getElementById('select-product');

                product_element.innerHTML = '<option value="">Loading...</option>';
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

                    product_element.innerHTML = '<option value="">Select Product</option>';

                    let prod_id_set_FLAG = false;    // to check if the product id is set?

                    let product_list = response_data.product_list;
                    product_list.forEach((element, index)=>{
                        let selected = (product_element.dataset.value === element.product_slug) ? "selected" : "";
                        
                        let opt_str = `<option value="${element.product_slug}" ${selected} data-id=${element.id}>${element.product_name}</option>`;
                        product_element.innerHTML += opt_str;
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