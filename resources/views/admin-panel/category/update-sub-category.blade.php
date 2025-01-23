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
            
            <div class="col-md-6">
                <div class="card card-purple">
                    <div class="card-header">
                        <h3 class="card-title">Add Sub Category</h3>
                    </div>
                    
                    <form action="{{ route('update-sub-category') }}" method="POST" role="form">
                        @csrf

                        {{-- Sub Category ID --}}
                        <input type="hidden" name="sub_category_id" value="{{ $subCategory[0]->id }}" />
 
                        <div class="card-body">
                            
                            <div class="form-group">
                                <select 
                                    name="select_category" 
                                    id="select-category" 
                                    class="form-control" 
                                    data-slug_value="{{ $subCategory[0]->category_slug }}"
                                    data-value="{{ $subCategory[0]->category_id }}">
                                    <option value="">Loading...</option>
                                </select>
                            </div>
                            @error('categoryId')
                                <div class="alert alert-danger">{{ $message }}</div>
                            @enderror

                            <div class="form-group">
                                <label>Sub-Category Name</label>
                                <input 
                                    type="text" 
                                    class="form-control" 
                                    name="subCategoryName" 
                                    id="subCategoryName" 
                                    placeholder="All Topwear"
                                    value="{{ $subCategory[0]->sub_category_name }}"
                                    required
                                />
                            </div>
                            @error('subCategoryName')
                                <div class="alert alert-danger">{{ $message }}</div>
                            @enderror

                            <div class="form-group">
                                <label>Sub-Category Slug</label>
                                <input 
                                    type="text" 
                                    class="form-control" 
                                    name="subCategorySlug" 
                                    id="subCategorySlug" 
                                    placeholder="all-topwear"
                                    value="{{ $subCategory[0]->sub_category_slug }}"
                                    required
                                />
                            </div>
                            @error('subCategorySlug')
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
                        <!-- /.card-body -->

                        <div class="card-footer">
                            <button type="submit" class="btn btn-primary">Update</button>
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
                        let selected = (category_element.dataset.slug_value === element.category_slug) ? "selected" : "";

                        let opt_str = `<option 
                                value="${element.id}" data-slug="${element.category_slug}" ${selected}>
                                ${element.category_name}
                            </option>`;
                        category_element.innerHTML += opt_str;
                    });
                    

                }
                catch(error){
                    console.error('Error:', error);
                }
            }
        }

        document.addEventListener('keyup', event=>{
            let element = event.target;

            if(element.id == "subCategoryName"){
                let sub_category_name = element.value;
                sub_category_name = remove_whitespace(sub_category_name);
                document.getElementById('subCategorySlug').value = generate_slug(sub_category_name);
            }
        });



    </script>
@endsection