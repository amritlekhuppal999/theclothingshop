@extends('layouts.dashboard')

@section('content-css')
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <meta name="img-category-url" content="{{ route('add-category-images') }}">

    <link rel="stylesheet" href="{{asset("css/animation.css")}}">

    <style>
        .image-container {
            position: relative;
            width: 200px;
            padding-bottom: 10px;
            display: flex;
            flex-direction: column;
            align-items: center;
        }

        .image-wrapper {
            position: relative;
            width: 100%;
        }

        .selected-image {
            width: 100%;
            max-height: 300px;
            object-fit: cover;
            display: block;
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
            bottom:10px;
            right:10px;
        }



        .highlighter{
            border: 3px solid rgba(255,0,255,0.7);
            animation: movingShadow 4s linear infinite;
        }
    </style>
@endsection

@section('content')
    
    <section class="content">
        <div class="container-fluid">

            {{-- Margin Div --}}
            <div class="row">
                <div class="col-md-12 mb-2"></div>
            </div>

            <div class="row">

                <div class="col-4">
                    
                    {{-- Select Category --}}
                    <div class="form-group">
                        <select 
                            name="select-category" 
                            id="select-category" 
                            class="form-control" 
                            data-value="{{ $categorySlug }}"
                            required>
                            <option value="">Loading...</option>
                        </select>
                    </div>

                    {{-- <div class="card card-purple">
                        <div class="card-header">
                            <h3 class="card-title">Add Category Image</h3>
                        </div>

                        <div class="card-body"></div>
                    </div> --}}

                </div>
            </div>

            {{-- Load added/saved category images --}}
            <div class="row" id="saved-category-images"></div>
        </div>
    </section>

@endsection


@section('content-scripts')
    <script>

        window.onload = ()=> {

            // let image_arr = [];
            // let primary_img = 0;
            // let category_id = 0;
            
            load_category_list();
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
                    //console.log(response_data);
                    //return response_data;

                    let category_element = document.getElementById('select-category');

                    category_element.innerHTML = '<option value="">Select Category</option>';

                    let category_list = response_data.category_list;
                    category_list.forEach((element, index)=>{
                        let selected = (category_element.dataset.value === element.category_slug) ? "selected" : "";

                        let opt_str = `<option value="${element.category_slug}" ${selected} data-id=${element.id}>${element.category_name}</option>`;
                        category_element.innerHTML += opt_str;
                    });
                    

                }
                catch(error){
                    console.error('Error:', error);
                }
            }

            // get id from the select category element
            document.getElementById("select-category").addEventListener('change', event=>{
                let select_element = event.target;

                let selected_option = select_element.options[select_element.selectedIndex];
                // category_id = selected_option.dataset.id;

                load_category_images(selected_option.dataset.id);
            });

            // load_category_images(category_id);
            // function to load ADDED category images
            async function load_category_images(category_id){

                document.getElementById("saved-category-images").innerHTML = `
                    <div class="col-md-6">
                        <h5 class="card-title"> Loading Images... ${MyApp.LOADER_MEDIUM} </h5> <br />
                    </div>
                `; 

                const request_options = {
                    method: 'GET',
                    // headers: {},
                    // body: JSON.stringify(request_data)
                };

                let url = `/admin/get-category-images/${category_id}`;
                // console.log(url);

                try{
                    let response = await fetch(url, request_options);
                    //console.log(response);
                    let response_data = await response.json();
                    // console.log(response_data);
                    //return response_data;
                    
                    if(response_data.requested_action_performed){
                        let inner_HTML = '';
                        
                        response_data.categoryImages.forEach((element, index)=>{
                            let image_id = element.category_img_id;
                            let image_URL = element.image_location;
                            let prime_image = element.prime_image;

                            let highlighter_selector = "", checked = "";
                            if(prime_image){
                                highlighter_selector = "highlighter"; checked = "checked";
                            }

                        inner_HTML += `
                            <div class="col-md-4 img-block ${highlighter_selector}">
                                <div class="card card bg-dark text-white" style="" data-img_id="${image_id}">
                                    <img src="${MyApp.PUBLIC_PATH}/${image_URL}" class="card-img-top" />

                                    <!-- 
                                    <div class="card-body">
                                        <button type="button" class="btn btn-danger delete-image" data-img_id="${image_id}" title="Delete Image">
                                            <span class="remove-img" data-img_id="${image_id}"> 
                                                <i class="fas fa-trash-alt"></i>
                                            </span>
                                        </button>
                                        
                                        <label class="btn btn-success radio-wrapper" title="Change Banner Image">
                                            <input type="radio" class="change_primary" name="select-image" id="" data-img_id="${image_id}" ${checked}>
                                            Set Banner
                                        </label>
                                    </div>
                                    -->
                                </div>
                            </div>`;
                        });


                        document.getElementById("saved-category-images").innerHTML = inner_HTML;
                    }

                    else{
                        document.getElementById("saved-category-images").innerHTML = `
                            <div class="col-md-12">
                                <h3 class="text-danger"> No images were added for this category!</h3>
                            </div>`;
                    }
                }

                catch(error){
                    console.error('Error:', error);
                }
            }
        };

    </script>
@endsection