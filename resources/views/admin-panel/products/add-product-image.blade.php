@extends('layouts.dashboard')

@section('content-css')

    <meta name="csrf-token" content="{{ csrf_token() }}">
    
    <meta name="img-product-url" content="{{ route('update-product-images') }}">
    <meta name="remove-img-url" content="{{ route('remove-product-images') }}">
    <meta name="update-banner-img" content="{{ route('update-product-primary-image') }}">

    
    <style>
        .image-container {
            position: relative;
            /*width: 200px;*/
            padding-bottom: 10px;
            display: flex;
            flex-direction: column;
            align-items: center;
            border-bottom: 10px solid rgba(255,0,255,0.7)
        }

        .image-wrapper {
            position: relative;
            /*width: 100%;*/
        }

        .selected-image {
            min-height:100px;
            width: 100%;
            max-height: 300px;
            object-fit: cover;
            display: block;
            /*border-bottom: 15px solid grey;
            border-right: 15px solid grey;*/
        }

        .added-images{
            
            height: 300px;
        }

        
        .remove-btn {
            position: absolute;
            top: 10px;
            right: 10px;
            background: white;
            border: none;
            border-radius: 50%;
            width: 25px;
            height: 25px;
            cursor: pointer;
            display: flex;
            align-items: center;
            justify-content: center;
            box-shadow: 0 2px 4px rgba(0,0,0,0.2);
        }

        .remove-btn:hover {
            background: #f8f8f8;
        }

        .remove-icon {
            color: red;
            font-weight: bold;
            font-size: 16px;
        }
        

        .radio-wrapper {
            position:absolute;
            bottom:12px;
            right:10px;
        }



        .highlighter{
            /*border: 3px solid rgba(255,0,255,0.7);*/
            /*border-bottom: 10px solid rgba(255,0,255,0.7);*/
            /*border: 10px solid red;*/
            box-shadow: 10px 10px 5px rgba(255,0,255,0.7);
            animation: movingShadow 4s linear infinite;
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


            {{-- PRODUCT Image FORM --}}
            <div class="row">
                <div class="offset-lg-1 col-md-12 col-lg-10">
                    
                    <div class="card card-purple">
                        <div class="card-header">
                            <h4 class="card-title"> Update {{--$category["category_name"]--}} Images</h4>
                        </div>
                        
                        <form 
                            action="{{-- safe_route('add-category-image') --}}" 
                            method="POST" 
                            role="form" 
                            id="product-image-form" 
                            enctype="multipart/form-data" >
                            @csrf

                            {{-- product ID --}}
                            {{-- <input type="hidden" name="product-id" id="product-id" value=""> --}}

                            <div class="card-body">

                                {{-- Select Product --}}
                                <div class="form-group">
                                    <select 
                                        name="select-product" 
                                        id="select-product" 
                                        class="form-control selectpicker" 
                                        data-value="{{ $productSlug }}"
                                        data-live-search="true"
                                        required>
                                        <option value="">Loading...</option>
                                    </select>

                                    {{-- <x-admin.product.product-picker :productSlug="$productSlug" /> --}}
                                </div>

                                {{-- Select Image --}}
                                <div class="form-group">
                                    <label>Select Image</label>
                                    <input 
                                        type="file" 
                                        class="form-control pl-0 pt-1" 
                                        name="productImages" 
                                        id="productImages" 
                                        accept="image/*"
                                        multiple
                                    />
                                </div>
                                @error('categoryName')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                @enderror

                                {{-- Image Preview --}}
                                <div>
                                    <label> Selected Image</label>
                                    {{-- position-relative --}}
                                    <div id="image-preview" 
                                        {{-- class="d-flex flex-wrap" --}}
                                        class="row"
                                        > </div>
                                </div>

                                {{-- Operation Error Message --}}
                                <div class="form-group">
                                    <span id="error-msg"></span>
                                </div>
                            </div>
                            <!-- /.card-body -->

                            <div class="card-footer">
                                <button type="submit" id="upload-images" class="btn bg-purple">Upload Images</button>
                            </div>
                        </form>

                        {{-- <button type="button" id="upload-images-test" class="btn btn-warning">Upload TEST</button> --}}
                    </div>

                </div>
            </div>

            {{-- Load added/saved category images --}}
            <div class="row" id="stored-product-images">

                <!--
                <div class="col-md-3">
                    <div class="card" style="" data-img_id="">
                        <img src="http://127.0.0.1:8000/images/one-piece.webp" class="card-img-top" />

                        <div class="card-body">
                            {{-- 
                            <h5 class="card-title">Banner Image</h5> <br />
                            <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
                            <a href="#" class="btn btn-primary">Go somewhere</a> --}}
                            
                            <button type="button" class="btn btn-danger" data-img_id="">
                                <span class="remove-img" data-img_id=""> × </span>
                            </button>
                            
                            <label class="btn btn-success radio-wrapper">
                                <input type="radio" class="set_primary" name="select-image" id="" data-img_id="">
                                Set Banner
                            </label>
                        </div>
                    </div>
                </div>
                -->

            </div>
        
        
        </div>
    </div>

    

@endsection


@section('content-scripts')
    
    <script>
        window.onload = ()=>{
            let image_arr = [];
            let primary_img = 0;
            let product_id = 0;
            const MAX_FILE_UPLOAD_LIMIT = 5;

            const FETCHED_IMAGE_SECTION = document.getElementById("stored-product-images");
            const SELECT_PRODUCT_ELE = document.getElementById("select-product");

            //INITIALIZE Selectpicker
            $('.selectpicker').selectpicker();

            load_product_list();

            // load product list
            async function load_product_list(request_data={}){
                let product_element = document.getElementById('select-product');

                product_element.innerHTML = '<option value="">Loading...</option>';

                if(SELECT_PRODUCT_ELE.dataset.value){
                    request_data.product_slug = SELECT_PRODUCT_ELE.dataset.value;
                }
                /*
                const request_data = {
                    result_count: result_count
                };
                */
                const params = new URLSearchParams(request_data);
                
                const request_options = {
                    method: 'GET',
                    // headers: {},
                    // body: JSON.stringify(request_data)
                };

                let url = '/admin/get-product-list?'+params;

                try{
                    let response = await fetch(url, request_options);
                    // console.log(response);
                    let response_data = await response.json();
                    //console.log(response_data);
                    //return response_data;

                    product_element.innerHTML = '<option value="">SELECT PRODUCT</option>';

                    let prod_id_set_FLAG = false;    // to check if the product id is set?

                    let product_list = response_data.product_list;
                    product_list.forEach((element, index)=>{
                        let selected = (product_element.dataset.value === element.product_slug) ? "selected" : "";

                        let opt_str = `<option value="${element.product_slug}" ${selected} data-id=${element.id}>
                            ${element.category_name} | ${element.product_name}
                        </option>`;
                        product_element.innerHTML += opt_str;
                    });

                    $('.selectpicker').selectpicker('refresh');
                    
                    product_id = get_product_id();
                    load_product_images();
                }
                catch(error){
                    console.error('Error:', error);
                }
            }

            // function to load ADDED product images
            async function load_product_images(){
                //FETCHED_IMAGE_SECTION = document.getElementById("stored-product-images");

                FETCHED_IMAGE_SECTION.innerHTML = `
                    <div class="col-md-6">
                        <h5 class="card-title"> Loading Images... ${MyApp.LOADER_MEDIUM} </h5> <br />
                    </div>`; 

                const request_options = {
                    method: 'GET',
                    // headers: {},
                    // body: JSON.stringify(request_data)
                };

                let url = `/admin/get-product-images/${product_id}`;
                console.log(url);

                try{
                    let response = await fetch(url, request_options);
                    //console.log(response);
                    let response_data = await response.json();
                    // console.log(response_data);
                    //return response_data;
                    
                    if(response_data.requested_action_performed){
                        let inner_HTML = '';
                        
                        response_data.productImages.forEach((element, index)=>{
                            let image_id = element.product_img_id;
                            let image_URL = element.image_location;
                            let prime_image = element.prime_image;

                            let highlighter_selector = "", checked = "";
                            if(prime_image){
                                highlighter_selector = "highlighter"; checked = "checked";
                            }

                        inner_HTML += `
                            <div class="col-6 col-md-4 col-lg-3 img-block ${highlighter_selector}">
                                <div class="card card bg-dark text-white" style="" data-img_id="${image_id}">
                                    <img src="${MyApp.PUBLIC_PATH}/${image_URL}" class="card-img-top" />

                                    <div class="card-body">
                                        <button type="button" class="btn btn-sm btn-danger delete-image" data-img_id="${image_id}" title="Delete Image">
                                            <span class="remove-img" data-img_id="${image_id}"> 
                                                <i class="fas fa-trash-alt"></i>
                                            </span>
                                        </button>
                                        
                                        <label class="btn btn-sm btn-success radio-wrapper" title="Change Banner Image">
                                            <input type="radio" class="change_primary" name="select-image" id="" data-img_id="${image_id}" ${checked}>
                                            Banner
                                        </label>
                                    </div>
                                </div>
                            </div>`;
                        });


                        FETCHED_IMAGE_SECTION.innerHTML = `
                            <div class="offset-lg-1 col-md-12 col-lg-10">
                                <div class="row">
                                    ${inner_HTML}
                                </div>
                            </div>`;
                    }

                    else{
                        FETCHED_IMAGE_SECTION.innerHTML = `
                            <div class="offset-lg-1 col-md-12 col-lg-10">
                                <h3 class="text-danger"> No Images added for this product.</h3>
                            </div>`;
                    }
                }

                catch(error){
                    console.error('Error:', error);
                }
            }

        
            // function to set the product ID variable value (NOT IN USE)
            function get_product_id(){
                let select_element = SELECT_PRODUCT_ELE;

                let selected_option = select_element.options[select_element.selectedIndex];
                //console.log(selected_option.dataset.id);
                return selected_option.dataset.id;
            }

            // MAKING THE SELECTPICKER SEARCH DYNAMIC
            $('#select-product').on('loaded.bs.select', function () {
                $(this).parent().find('.bs-searchbox input').on('keyup', function(event) {
                    if(event.keyCode >= 37 && event.keyCode <= 40){
                        return false;
                    }
                    
                    var searchTerm = $(this).val();
                    
                    // Debounce the search to avoid too many calls
                    clearTimeout(window.searchTimeout);
                    window.searchTimeout = setTimeout(function() {
                        //console.log('Searching for:', searchTerm);
                        let request_data = {
                            "searchTerm": searchTerm,
                        };
                        load_product_list(request_data);
                    }, 300); // 300ms delay
                });
            });


            // Selecting Product Event
            SELECT_PRODUCT_ELE.addEventListener('change', event=>{
                product_id = get_product_id();
                load_product_images(FETCHED_IMAGE_SECTION);                
            });


            //image input field EVENT
            document.getElementById('productImages').addEventListener('change', (event)=>{

                let img_input_field = event.target;
                //console.log(img_input_field.files);
                let file_list = img_input_field.files;

                // checks how many images user has selected. Must not me greater than MAX_FILE_UPLOAD_LIMIT
                if(file_list.length > MAX_FILE_UPLOAD_LIMIT){
                    toastr.warning('You cannot add more than '+ MAX_FILE_UPLOAD_LIMIT +' images.');
                    return false;
                }

                // checks if the total image count of user selected and already added is less than 5
                if( (parseInt(image_arr.length) + parseInt(file_list.length)) > MAX_FILE_UPLOAD_LIMIT){
                    let msg_str = 'You have added '+image_arr.length+' images. You can add '+( MAX_FILE_UPLOAD_LIMIT - parseInt(image_arr.length) )+' more.';
                    toastr.warning(msg_str);
                    return false;
                }
        
                for(let i=0; i< file_list.length; i++){
                    if(file_list[i].size > 0 && file_list[i].size < 5000000){
                        if(file_list[i].type.includes("image")){
                            create_image_preview(file_list[i]);        
                        }
            
                        // else preview_div.innerHTML = '<h3> Invalid file type !!!</h3>';
                    }
                    else toastr.warning('File size greater than 5MB!!!');
                }
            });

            // Added IMAGE PREVIEW CLICK EVENT
            document.getElementById("image-preview").addEventListener('click', event=>{
                let element = event.target;
                
                // SET PRIMARY
                if(element.className.includes("set_primary")){
                    //alert(element.dataset.img_id+" Set Primary");

                    // the highlighter class highlights the element as primary
                    if(document.querySelector(".highlighter")){
                        let previous_primary = document.querySelector(".highlighter");
                        previous_primary.classList.remove("highlighter");

                    }

                    element.closest(".card").classList.add("highlighter");
                    primary_img = element.dataset.img_id;
                }

                // REMOVE ADDED IMAGE
                else if(element.className.includes("remove-img")){
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
                }
            });


            // FORM SUBMIT (UPDATE operations)
            document.getElementById("product-image-form").addEventListener('submit', async event=>{
                event.preventDefault();

                if(!image_arr.length){
                    alert("You haven't added any image...");
                    return false;
                }

                if(image_arr.length > 5){
                    alert("You cannot add more than 5 images.");
                    return false;
                }

                let submit_btn = document.getElementById("upload-images");
                let submit_btn_content = submit_btn.innerHTML;

                submit_btn.innerHTML = MyApp.LOADER_SMALL;
                submit_btn.disabled = true;
                
                let form_data = {
                    product_id: product_id,
                    image_arr: image_arr,
                    primary_img_id: primary_img,
                };

                //console.log(image_arr);

                const request_options = {
                    method: 'POST',
                    headers: {
                        'content-type': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('input[name="_token"]').value
                        //'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                    },
                    body: JSON.stringify(form_data)
                };

                let url = document.querySelector('meta[name="img-product-url"]').getAttribute('content');

                try{
                    let response = await fetch(url, request_options);     
                    //console.log(response);
                    let response_data = await response.json();
                    //console.log(response_data);
                    //return response_data;

                    if(response_data.requested_action_performed){
                        submit_btn.innerHTML = MyApp.CHECK_SUCCESS;
                        toastr.success(response_data.message);
                        if(response_data.reload){
                            setTimeout(()=>{
                                location.reload();
                            }, 1500);
                        }
                    }
                    else {
                        toastr.error(response_data.message);
                        submit_btn.innerHTML = submit_btn_content;
                        submit_btn.disabled = false;
                    }
                    

                    //let error_message_span = document.getElementById('error-msg');
                }
                catch(error){
                    console.error('Error:', error);

                    toastr.error("Something went wrong!!");
                    submit_btn.innerHTML = submit_btn_content;
                    submit_btn.disabled = false;
                }

            })


            // Event Listener for FETCHED DB STORED IMAGES SECTION
            FETCHED_IMAGE_SECTION.addEventListener("click", async event=>{
                let element = event.target;

                // DELETE saved Images
                if(element.className.includes("delete-image")){

                    if(!confirm("Delete selected image?")){
                        return false;
                    }

                    let delete_BTN = element;

                    let delete_BTN_content = delete_BTN.innerHTML;
                    delete_BTN.innerHTML = MyApp.LOADER_SMALL;
                    delete_BTN.disabled = true;

                    let parent_DIV = delete_BTN.closest(".img-block");
                    // element.closest(".img-block").remove();

                    let send_data = {
                        img_id: delete_BTN.dataset.img_id
                    };

                    const request_options = {
                        method: 'POST',
                        headers: {
                            'content-type': 'application/json',
                            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                        },
                        body: JSON.stringify(send_data)
                    };

                    let url = document.querySelector('meta[name="remove-img-url"]').getAttribute('content');
                    // remove-category-images

                    try{
                        let response = await fetch(url, request_options);     
                        //console.log(response);
                        let response_data = await response.json();
                        console.log(response_data);
                        //return response_data;

                        if(response_data.requested_action_performed){
                            toastr.success(response_data.message);
                            setTimeout(()=>{
                                parent_DIV.remove();
                            }, 1000);
                            /*
                            submit_btn.innerHTML = MyApp.CHECK_SUCCESS;
                            if(response_data.reload){
                            }
                            */
                        }
                        else {
                            
                            toastr.error(response_data.message);
                            delete_BTN.innerHTML = delete_BTN_content;
                            delete_BTN.disabled = false;
                            
                        }
                    }
                    catch(error){
                        console.error('Error:', error);

                        toastr.error("Something went wrong!!");
                        delete_BTN.innerHTML = delete_BTN_content;
                        delete_BTN.disabled = false;
                        
                    }
                }

                // UPDATE banner IMAGE
                if(element.className.includes("change_primary")){
                    
                    // check for action confirmation
                    if(!confirm("Set selected image as primary?")){
                        return false;
                    }

                    //assign BTN
                    let setBannerBTN = element;
                    let setBTN_content = setBannerBTN.innerHTML;
                    // setBannerBTN.disabled = true;

                    // get parent div
                    let parent_DIV = setBannerBTN.closest(".img-block");

                    // data to send
                    let send_data = {
                        img_id: setBannerBTN.dataset.img_id,
                        product_id: product_id
                    };

                    // fetch request option
                    const request_options = {
                        method: 'POST',
                        headers: {
                            'content-type': 'application/json',
                            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                        },
                        body: JSON.stringify(send_data)
                    };

                    let url = document.querySelector('meta[name="update-banner-img"]').getAttribute('content');
                    // update-category-primary-image

                    try{
                        let response = await fetch(url, request_options);     
                        //console.log(response);
                        let response_data = await response.json();
                        console.log(response_data);
                        //return response_data;

                        if(response_data.requested_action_performed){
                            toastr.success(response_data.message);
                            setTimeout(()=>{
                                let img_block = document.querySelectorAll(".img-block");
                                img_block.forEach(element => {
                                    element.classList.remove('highlighter');
                                });
                                parent_DIV.classList.add("highlighter");
                            }, 1000);
                        }
                        else {
                            
                            toastr.error(response_data.message);
                            setBannerBTN.checked = false;
                            
                        }
                    }
                    catch(error){
                        //console.error('Error:', error);
                        toastr.error("Something went wrong!!");
                        setBannerBTN.checked = false;                        
                    }

                }
            });


            // Create IMAGE PREVIEW
            async function create_image_preview(image_file){

                // async function cause it took an oath to deal with a promise BITCH !!!

                let image_preview = document.getElementById('image-preview');
                // preview_div.innerHTML = '';

                // image_file.name
                // image_file.size
                // image_file.type

                let img_id = Math.floor(Math.random() * 100);
                let IMG_URI = await generate_URI(image_file);

                image_arr.push({
                    img_id : img_id,
                    img_uri: IMG_URI,
                });
                
                let div_ele = document.createElement('div');
                div_ele.dataset.img_id = img_id;
                div_ele.classList = "col-12 col-md-4";

                div_ele.innerHTML = `
                    <div class="card">
                        <div class="card-body p-0" data-img_id="${img_id}">
                            <div class="image-wrapper">
                                <img 
                                    src="${IMG_URI}" 
                                    alt="Sample image" 
                                    class="selected-image"
                                    id="${img_id}"
                                />
                                
                                <button type="button" class="remove-btn" data-img_id="${img_id}">
                                    <span class="remove-icon remove-img" data-img_id="${img_id}">&times;</span>
                                </button>
                                
                                <label class="btn btn-success mb-0 radio-wrapper">
                                    <input type="radio" class="set_primary" name="select-image" id="" data-img_id="${img_id}">
                                    Set Primary
                                </label>
                            </div>
                        </div>
                    </div>`;

                
                // console.log(div_ele);
                // console.log(image_arr);

                image_preview.appendChild(div_ele); 
            }

            // Generate Image URI
            function generate_URI(media_file){
                return new Promise((resolve, reject) =>{

                    const reader = new FileReader();
                    // const baseURI = '';
                    reader.onload = event =>{
                        // baseURI = event.target.result;
                        resolve(event.target.result);
                    }
                    reader.onerror = event =>{
                        reject(event.target.error);
                    }

                    reader.readAsDataURL(media_file);
                });

            }
            
        }
    </script>

    @stack('product-picker-scripts')
@endsection