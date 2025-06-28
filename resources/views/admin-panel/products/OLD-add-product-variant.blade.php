@extends('layouts.dashboard')

@section('content-css')

    <meta name="add-product-variant-route" content="{{ route('add-product-variant') }}">


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
            {{-- <div class="row">
                <h3 class="text-danger">
                    ADD VARIANT OPERATION PENDING
                </h3>
            </div> --}}

            {{-- SELECT PRODUCT --}}
            <div class="row">
                
                {{-- Select PRODUCT --}}
                <div class="col-4">
                    <div class="form-group">
                        <select 
                            name="select-product" 
                            id="select-product" 
                            class="form-control" 
                            data-value="{{ $productSlug }}">
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
                            <form 
                                action="{{-- route('add-product-variant') --}}"
                                method="POST"
                                id="variant-form">
                                
                                @csrf

                                {{-- name and slug --}}
                                <div class="row">
                                    
                                    {{-- Variant Name --}}
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="">Variant Name</label>
                                            <input 
                                                type="text" 
                                                class="form-control" 
                                                id="variant_name" name="variant_name" 
                                                placeholder="Variant Name"
                                                required
                                            />
                                        </div>
                                    
                                    </div>

                                    {{-- Variant Name --}}
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="">Variant Slug</label>
                                            <input 
                                                type="text" 
                                                class="form-control" 
                                                id="variant_slug" name="variant_slug" 
                                                placeholder="Variant Slug"
                                                required
                                            />
                                        </div>
                                    </div>
                                </div>

                                
                                {{-- SKU price qty --}}
                                <div class="row">
                                    
                                    {{-- Variant SKU --}}
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="">SKU</label>
                                            <input 
                                                type="text" 
                                                class="form-control" 
                                                id="sku" name="sku" 
                                                placeholder="SKU"
                                                required
                                            />
                                        </div>
                                    </div>

                                    {{-- Enter PRICE --}}
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="">Price</label>
                                            <input 
                                                type="number"
                                                min="0"
                                                class="form-control" 
                                                id="price" name="price" 
                                                placeholder="Variant Slug"
                                                required
                                            />
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


                                {{-- Variant Details (size, color, qty) --}}
                                <div class="row">

                                    {{-- Select Size --}}
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label for="">Select Attribute</label>
                                            <select class="form-control" name="select-attribute" id="select-attribute">
                                                <option value="">Loading...</option>
                                            </select>
                                        </div>
                                    </div>

                                    {{-- Select Color --}}
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label for="">Select Attribute Value</label>
                                            <select class="form-control" name="select-attribute-value" id="select-attribute-value">
                                                <option value="">Select</option>
                                            </select>
                                        </div>
                                    </div>

                                    {{-- Select Color --}}
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            {{-- <label for="">Select Attribute Value</label> --}}
                                            <br />
                                            <button 
                                                type="button"
                                                class="btn btn-info mt-2"
                                                name="save-attribute"
                                                id="save-attribute">
                                                Add Attribue Pair
                                            </button>
                                        </div>
                                    </div>
                                </div>

                                {{-- Added Attributes (Not saved in DB) --}}
                                <div class="row" id="attribute-pair-section" hidden>
                                    <div class="col-md-12">
                                        <table class="table table-bordered table-hover">
                                            <caption>List of Added Attributes Will be saved in mapper table</caption>
                                            <thead class="">
                                                <tr>
                                                    <th>Attribute</th>
                                                    <th>Attribute Value</th>
                                                    <th>Action</th>
                                                </tr>
                                            </thead>
                                            <tbody id="added-attribute-list"></tbody>
                                            <tfoot>
                                                <tr>
                                                    <td colspan="5" class="text-right">
                                                        <button 
                                                            type="button" 
                                                            class="btn btn-danger" 
                                                            id="clear-pair-list">
                                                            Clear List
                                                        </button>
                                                    </td>
                                                </tr>
                                            </tfoot>
                                        </table>
                                    </div>
                                </div>
                                
                                <div class="row">
                                    <div class="col-md-12 d-flex justify-content-between">
                                        {{-- Add Variant --}}
                                        <button 
                                            type="submit" 
                                            class="btn btn-primary"
                                            id="add-variant"
                                            name="add-variant">
                                            Add Variant
                                        </button>
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

            let attr_arr = [];
            /*
                let attr_object = { id, attribute_name_id, attribute_value_id };
            */

            let product_id = 0;

            const SELECT_PRODUCT_ELEMENT = document.getElementById("select-product");
            const SELECT_ATTRIBUTE_ELEMENT = document.getElementById("select-attribute");
            
            const VARIANT_NAME_ELEMENT = document.getElementById("variant_name");
            const VARIANT_SLUG_ELEMENT = document.getElementById("variant_slug");

            const current_url = MyApp.CURRENT_URL;

            const VARIANT_FORM = document.getElementById('variant-form');

            const ADDED_ATTRIBUTE_LIST = document.getElementById("added-attribute-list");

            const ADDED_ATTRIBUTE_PAIR_SECTION = document.getElementById("attribute-pair-section");

            load_product_list();
            get_attribute_list();
            //get_attribute_values();

            // set product id
            function set_product_id(){
                VARIANT_NAME_ELEMENT.value = "";
                VARIANT_SLUG_ELEMENT.value = "";

                let selected_option = SELECT_PRODUCT_ELEMENT.options[SELECT_PRODUCT_ELEMENT.selectedIndex];
                if(selected_option.value.length > 0){
                    VARIANT_NAME_ELEMENT.value = selected_option.innerText+' VARIANT';
                    VARIANT_SLUG_ELEMENT.value = selected_option.value+'-variant';
                }
                
                return selected_option.dataset.id;
            }

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

            // Load the sub category list 
            async function get_attribute_list(){

                let select_attribute_element = document.getElementById('select-attribute');

                select_attribute_element.innerHTML = '<option value="">Loading...</option>';

                /*
                if(!category_id){
                    select_attribute_element.innerHTML = '<option value="">Select Attribute</option>';
                    return false;
                }
                */
                
                const request_options = {
                    method: 'GET',
                    // headers: {},
                    // body: JSON.stringify(request_data)
                };

                let url = '/admin/get-attribute-list/';

                try{
                    let response = await fetch(url, request_options);
                    // console.log(response);
                    let response_data = await response.json();
                    //console.log(response_data);
                    //return response_data;

                    select_attribute_element.innerHTML = '<option value="">Select Attribute</option>';

                    //let attr_id_set_FLAG = false;    // to check if the sub_category id is set?

                    let attribute_list = response_data.attribute_list;

                    attribute_list.forEach((element, index)=>{
                        // let selected = (select_attribute_element.dataset.value === element.sub_category_slug) ? "selected" : "";
                        let selected = "";

                        // FOR setting values via query parameters (?cat=xyz&sub_cat=abc)
                        /*
                        if(!attr_id_set_FLAG){
                            if(selected == "selected"){
                                SUB_CATEGORY_ID_PRODUCT_FORM.value = element.id;
                                attr_id_set_FLAG = true;
                            }
                            else SUB_CATEGORY_ID_PRODUCT_FORM.value = 0;
                        }
                        */
                        
                        let opt_str = `<option value="${element.id}" ${selected} >${element.name}</option>`;
                        select_attribute_element.innerHTML += opt_str;
                    });
                    
                    

                }
                catch(error){
                    console.error('Error:', error);
                }
            }

            // Load the sub category list 
            async function get_attribute_values(attribute_id=0){

                let select_attribute_values_element = document.getElementById('select-attribute-value');

                select_attribute_values_element.innerHTML = '<option value="">Loading...</option>';

                /*
                if(!category_id){
                    select_attribute_values_element.innerHTML = '<option value="">Select Attribute</option>';
                    return false;
                }
                */
                
                const request_options = {
                    method: 'GET',
                    // headers: {},
                    // body: JSON.stringify(request_data)
                };

                let url = '/admin/get-attribute-values/'+attribute_id;

                try{
                    let response = await fetch(url, request_options);
                    // console.log(response);
                    let response_data = await response.json();
                    //console.log(response_data);
                    //return response_data;

                    select_attribute_values_element.innerHTML = '<option value="">Select Attribute Values</option>';

                    //let attr_id_set_FLAG = false;    // to check if the sub_category id is set?

                    let attribute_values = response_data.attribute_values;

                    attribute_values.forEach((element, index)=>{
                        // let selected = (select_attribute_values_element.dataset.value === element.sub_category_slug) ? "selected" : "";
                        let selected = "";

                        // FOR setting values via query parameters (?cat=xyz&sub_cat=abc)
                        /*
                        if(!attr_id_set_FLAG){
                            if(selected == "selected"){
                                SUB_CATEGORY_ID_PRODUCT_FORM.value = element.id;
                                attr_id_set_FLAG = true;
                            }
                            else SUB_CATEGORY_ID_PRODUCT_FORM.value = 0;
                        }
                        */
                        
                        let opt_str = `<option value="${element.id}" ${selected} >${element.value} - ${element.label}</option>`;
                        select_attribute_values_element.innerHTML += opt_str;
                    });
                    
                    

                }
                catch(error){
                    console.error('Error:', error);
                }
            }

            // function to check duplicate pairs
            function check_redundant_pair(name_id, value_id){
                // name_id: attribute name id,  //value_id: attribute value id
                const exists_index = attr_arr.findIndex(obj => obj.attribute_name_id == name_id && obj.attribute_value_id == value_id);

                return exists_index;
            }


            // Set product ID
            SELECT_PRODUCT_ELEMENT.addEventListener('change', event=>{
                // let select_element = event.target;
                // let selected_option = SELECT_PRODUCT_ELEMENT.options[SELECT_PRODUCT_ELEMENT.selectedIndex];
                product_id = set_product_id();
            });


            SELECT_ATTRIBUTE_ELEMENT.addEventListener('change', event=>{
                let select_element = event.target;

                let selected_option = select_element.options[select_element.selectedIndex];
                // let attribute_id = (selected_option.dataset.id) ? selected_option.dataset.id : 0;
                //console.log(select_element.value, selected_option.value);
                get_attribute_values(selected_option.value);
            });
            

            // Set product slug
            document.getElementById("variant_name").addEventListener('keyup', event=>{
                let element = event.target;
                let variant_name = element.value;
                variant_name = MyApp.remove_whitespace(variant_name);
                document.getElementById('variant_slug').value = MyApp.generate_slug(variant_name);
            });
            
            
            VARIANT_FORM.addEventListener('click', event=>{
                let element = event.target;

                //console.log(event.type);

                // Add attribute pair to the list
                if(element.id == "save-attribute"){
                    
                    let attribute_name = document.getElementById('select-attribute');
                    let attribute_value = document.getElementById('select-attribute-value');

                    if(attribute_name.value == "" || attribute_name.value == "0"){
                        alert("Select Attribute");
                        return false;
                    }

                    if(attribute_value.value == "" || attribute_value.value == "0"){
                        alert("Select Attribute Value");
                        return false;
                    }

                    //Checks if the added name and value of attribute is already present
                    if(check_redundant_pair(attribute_name.value, attribute_value.value) !== -1){
                        alert("Combination already used");
                        return false;
                    }

                    // if the added attribute pairs' table is hidden, unhide it
                    if(ADDED_ATTRIBUTE_PAIR_SECTION.hidden){
                        ADDED_ATTRIBUTE_PAIR_SECTION.hidden = false;
                    }

                    let attr_name_selected_option = attribute_name.options[attribute_name.selectedIndex];
                    let attr_value_selected_option = attribute_value.options[attribute_value.selectedIndex];

                    

                    let temp_id = Math.floor(Math.random() * 100);

                    // alert(attr_name_selected_option.innerText+': '+attr_value_selected_option.innerText);
                    
                    let attr_object = {
                        id: temp_id,
                        attribute_name_id: attr_name_selected_option.value,
                        attribute_value_id: attr_value_selected_option.value
                    };

                    attr_arr.push(attr_object);

                    let TR = document.createElement('tr');
                    TR.dataset.temp_id = temp_id;
                    TR.classList = "attribute-pair-row";

                    TR.innerHTML = `
                        <td>${attr_name_selected_option.innerText}</td>
                        <td>${attr_value_selected_option.innerText}</td>
                        <td>
                            <a href="#" class="text-danger remove-attribute-pair" data-temp_id="${temp_id}"> Remove Variant </a>
                        </td>`;

                    
                    ADDED_ATTRIBUTE_LIST.appendChild(TR);
                }

                // Delete the individual attribute pair
                if(element.className.includes("remove-attribute-pair")){
                   event.preventDefault(); 
                    if(confirm("Delete Pair?")){
                        let temp_id = element.dataset.temp_id;

                        // remove from the attribute index
                        const index = attr_arr.findIndex(obj => obj.id == temp_id);
                        if (index !== -1) {
                            attr_arr.splice(index, 1);
                        }

                        //remove the attribute pair row
                        element.closest(".attribute-pair-row").remove();

                        console.log(attr_arr)

                        if(!attr_arr.length){
                            ADDED_ATTRIBUTE_PAIR_SECTION.hidden = true;
                        }
                    }
                }


                // Delete the entire attribute pair list
                if(element.id == "clear-pair-list" ){
                    //event.preventDefault(); 
                    if(confirm("Delete All Pairs?")){
                        attr_arr = [];
                        ADDED_ATTRIBUTE_LIST.innerHTML = '';
                        ADDED_ATTRIBUTE_PAIR_SECTION.hidden = true;
                    }
                }

                /*
                if(element.id == "add-variant"){
                    event.preventDefault();
                    return false;
                }
                */
            });


            // SUBMIT VARIANT/SUB-PRODUCT form 
            VARIANT_FORM.addEventListener('submit', async event=>{
                event.preventDefault();
                toastr.options.escapeHtml = false;

                let submit_btn = VARIANT_FORM.querySelector('[name="add-variant"]');
                let submit_btn_content = submit_btn.innerHTML;
                submit_btn.innerHTML = MyApp.LOADER_SMALL;
                submit_btn.disabled = true;

                let variant_name = MyApp.remove_whitespace(VARIANT_FORM.querySelector('[name="variant_name"]').value);
                let variant_slug = VARIANT_FORM.querySelector('[name="variant_slug"]').value;
                let sku = VARIANT_FORM.querySelector('[name="sku"]').value;
                let price = VARIANT_FORM.querySelector('[name="price"]').value;
                let quantity = VARIANT_FORM.querySelector('[name="variant-quantity"]').value;

                if(!product_id){
                    toastr.error("Select Product");
                    resetSubmitBTN();
                    return false;
                }

                let form_data = {
                    product_id: product_id,
                    variant_name: variant_name,
                    variant_slug: variant_slug,
                    sku: sku,
                    price: price,
                    quantity: quantity,
                    attribute_pair: attr_arr
                };

                const request_options = {
                    method: 'POST',
                    headers: {
                        'content-type': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('input[name="_token"]').value
                        //'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                    },
                    body: JSON.stringify(form_data)
                };

                let url = document.querySelector('meta[name="add-product-variant-route"]').getAttribute('content');
                //console.log(url);
                //return false;

                try{
                    let response = await fetch(url, request_options);     
                    //console.log(response.status);
                    
                    let response_data = await response.json();
                    //console.log(response_data);

                    switch (response.status) {
                        case MyApp.REQUEST_SUCCESSFUL:
                            if(response_data.requested_action_performed){

                                submit_btn.innerHTML = MyApp.CHECK_SUCCESS;
                                toastr.success(response_data.message);
                                setTimeout(()=>{
                                    // VARIANT_FORM.reset();
                                    // ADDED_ATTRIBUTE_PAIR_SECTION.hidden = true;
                                    // ADDED_ATTRIBUTE_LIST.innerHTML = '';
                                    //resetSubmitBTN();
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
                            resetSubmitBTN();
                        break;

                        case MyApp.BAD_REQUEST_ERROR:
                            //toastr.error(response_data.message);
                            toastr.warning('<span style="color: blue;">'+response_data.message+'</span>');
                            resetSubmitBTN();
                        break;

                        case MyApp.INTERNAL_SERVER_ERROR:
                            toastr.error(response_data.message);
                            console.log(response_data.errors);
                            resetSubmitBTN();
                        break;
                        
                        default:
                        toastr.error("Something went down. We are fixing it.");
                        resetSubmitBTN();
                    }

                    //let error_message_span = document.getElementById('error-msg');
                }
                catch(error){
                    console.error('Fetch Error:', error);
                    toastr.error("Something went wrong!!");
                    resetSubmitBTN();
                }

                function resetSubmitBTN(){
                    submit_btn.innerHTML = submit_btn_content;
                    submit_btn.disabled = false;
                }
            });
        };

        

        /*
            if(confirm("Delete Image?")){
                if(primary_img == element.dataset.img_id){
                    primary_img = 0;
                }

                // remove from the image_array
                const index = image_arr.findIndex(obj => obj.img_id == element.dataset.img_id);
                if (index !== -1) {
                    image_arr.splice(index, 1);
                }

                element.closest(".card").remove();
                // console.log(image_arr);
            }
        */

    </script>
@endsection