@extends('layouts.dashboard')

@section('content-css')
    <meta name="csrf-token" content="{{ csrf_token() }}">

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

                <div class="col-8 offset-md-2">
                    
                    <div class="card card-purple">
                        <div class="card-header">
                            <h3 class="card-title">Add Category Image</h3>
                        </div>
                        
                        <form action="{{-- route('add-category-image') --}}" method="POST" role="form">
                            @csrf

                            {{-- <input type="hidden" name="category_id" value=""> --}}

                            <div class="card-body">

                                {{-- Select Category --}}
                                <div class="form-group">
                                    <select 
                                        name="select-category" 
                                        id="select-category" 
                                        class="form-control" 
                                        data-value="{{ $categorySlug }}">
                                        <option value="">Loading...</option>
                                    </select>
                                </div>
                                
                                {{-- Select Image --}}
                                <div class="form-group">
                                    <label>Select Image</label>
                                    <input 
                                        type="file" 
                                        class="form-control pl-0 pt-1" 
                                        name="categoryImages" 
                                        id="categoryImages" 
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
                                    <div id="image-preview" class="d-flex flex-wrap"> {{-- position-relative --}}
                                        
                                        


                                    </div>
                                </div>

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
                            <!-- /.card-body -->

                            <div class="card-footer">
                                <button type="submit" class="btn btn-primary">Update</button>
                            </div>
                        </form>
                    </div>

                </div>
            </div>
        </div>
    </section>

@endsection


@section('content-scripts')
    <script>

        window.onload = ()=> {

            image_arr = [];
            
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
                    console.log(response_data);
                    //return response_data;

                    let category_element = document.getElementById('select-category');

                    category_element.innerHTML = '<option value="">Select Category</option>';

                    let category_list = response_data.category_list;
                    category_list.forEach((element, index)=>{
                        let selected = (category_element.dataset.value === element.category_slug) ? "selected" : "";

                        let opt_str = `<option value="${element.category_slug}" ${selected}>${element.category_name}</option>`;
                        category_element.innerHTML += opt_str;
                    });
                    

                }
                catch(error){
                    console.error('Error:', error);
                }
            }

            
            document.getElementById('categoryImages').addEventListener('change', (event)=>{

                let img_input_field = event.target;
                console.log(img_input_field.files);
                let file_list = img_input_field.files;
        
                // if(file_list[0].type.includes("image")){
                //     create_image_preview(file_list[0]);        
                // }
        
                // else preview_div.innerHTML = '<h3> Invalid file type !!!</h3>';

                /*
                    if(file_list[0].size > 0 && file_list[0].size < 5000000){
                        if(file_list[0].type.includes("image")){
                            create_image_preview(file_list[0]);        
                        }
            
                        // else preview_div.innerHTML = '<h3> Invalid file type !!!</h3>';
                    }
                    else alert('File size greater than 5MB!!!');
                */

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


            async function create_image_preview(image_file){

                // async function cause it took an oath to deal with a promise BITCH !!!

                let image_preview = document.getElementById('image-preview');
                // preview_div.innerHTML = '';

                // image_file.name
                // image_file.size
                // image_file.type

                // let video_heading = document.createElement("h3");
                // video_heading.innerText = image_file.name;

                let img_id = Math.floor(Math.random() * 100);
                let IMG_URI = await generate_URI(image_file);

                image_arr.push({
                    img_id : img_id,
                    img_uri: IMG_URI,
                });
                
                let div_ele = document.createElement('div');
                div_ele.dataset.img_id = img_id;
                div_ele.classList = "card mr-2";

                div_ele.innerHTML = `
                    <div class="card-body p-0" data-img_id="${img_id}">
                        <div class="image-wrapper">
                            <img 
                                src="${IMG_URI}" 
                                alt="Sample image" 
                                class="selected-image"
                                id="${img_id}"
                            />
                            
                            <button class="remove-btn" data-img_id="${img_id}">
                                <span class="remove-icon">&times;</span>
                            </button>
                            
                            <label class="btn  btn-success mb-0 radio-wrapper">
                                <input type="radio" name="select-image" id="" data-img_id="${img_id}">
                                Set Primary
                            </label>
                        </div>
                    </div>`;

                
                console.log(div_ele);
                // console.log(image_arr);

                image_preview.appendChild(div_ele); 
            }


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

        };

    </script>
@endsection