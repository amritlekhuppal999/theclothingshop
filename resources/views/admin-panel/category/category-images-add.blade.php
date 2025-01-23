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
                                        name="categoryBanner" 
                                        id="categoryBanner" 
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
                                        
                                        {{-- SELECTED IMAGE CONTAINER --}}
                                        <div class="card mr-2">
                                            <div class="card-body p-0">
                                                {{-- card-img-top --}}
                                                <div class="image-wrapper">
                                                    <img 
                                                        src="{{asset("/images/one-piece.webp")}}" 
                                                        alt="Sample image" 
                                                        class="selected-image"
                                                    />
                                                    
                                                    <button class="remove-btn">
                                                        <span class="remove-icon">&times;</span>
                                                    </button>
                                                    
                                                    <label class="btn  btn-success mb-0 radio-wrapper">
                                                        <input type="radio" name="select-image" id="">
                                                        Set Primary
                                                    </label>
                                                </div>
                                            </div>
                                        </div>

                                        {{-- SELECTED IMAGE CONTAINER --}}
                                        <div class="card mr-2">
                                            <div class="card-body p-0">
                                                {{-- card-img-top --}}
                                                <div class="image-wrapper">
                                                    <img 
                                                        src="{{asset("/images/one-piece.webp")}}" 
                                                        alt="Sample image" 
                                                        class="selected-image"
                                                    />
                                                    
                                                    <button class="remove-btn">
                                                        <span class="remove-icon">&times;</span>
                                                    </button>
                                                    
                                                    <label class="btn  btn-success mb-0 radio-wrapper">
                                                        <input type="radio" name="select-image" id="">
                                                        Set Primary
                                                    </label>
                                                </div>
                                            </div>
                                        </div>

                                        {{-- SELECTED IMAGE CONTAINER 2 --}}
                                        <div class="card mr-2">
                                            <div class="card-body p-0">
                                                {{-- card-img-top --}}
                                                <div class="image-wrapper">
                                                    <img 
                                                        src="{{asset("images/naruto-ultimate-collection.webp")}}" 
                                                        alt="Sample image" 
                                                        class="selected-image"
                                                    />
                                                    
                                                    <button class="remove-btn">
                                                        <span class="remove-icon">&times;</span>
                                                    </button>
                                                    
                                                    <label class="btn  btn-success mb-0 radio-wrapper">
                                                        <input type="radio" name="select-image" id="">
                                                        Set Primary
                                                    </label>
                                                </div>
                                            </div>
                                        </div>

                                        {{-- SELECTED IMAGE CONTAINER 3 --}}
                                        <div class="card mr-2">
                                            <div class="card-body p-0">
                                                {{-- card-img-top --}}
                                                <div class="image-wrapper">
                                                    <img 
                                                        src="{{asset("images/rick-n-morty.webp")}}" 
                                                        alt="Sample image" 
                                                        class="selected-image"
                                                    />
                                                    
                                                    <button class="remove-btn">
                                                        <span class="remove-icon">&times;</span>
                                                    </button>
                                                    
                                                    <label class="btn  btn-success mb-0 radio-wrapper">
                                                        <input type="radio" name="select-image" id="">
                                                        Set Primary
                                                    </label>
                                                </div>
                                            </div>
                                        </div>


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

        };

    </script>
@endsection