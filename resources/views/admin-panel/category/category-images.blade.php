@extends('layouts.dashboard')

@section('content-css')
    <meta name="csrf-token" content="{{ csrf_token() }}">
@endsection

@section('content')
    
    <section class="content">
      <div class="container-fluid">

        {{-- Margin Div --}}
        <div class="row">
            <div class="col-md-12 mb-2"></div>
        </div>

        <div class="row">
            <div class="col-md-3 mb-2">
                
                <select 
                    name="select-category" 
                    id="select-category" 
                    class="form-control" 
                    data-value="{{ $categorySlug }}">
                    <option value="">Loading...</option>
                </select>
            </div>

            <div class="col-md-6 mb-2 offset-md-3 d-flex justify-content-end">
                <a href="/admin/category-images-add" class="btn btn-secondary">Add Images</a>
            </div>

        </div>

        <div class="row">
            <div class="col-12">
                
                <div class="card">
                
                    <div class="card-header">
                        <div class="card-title">
                            Category Images
                        </div>

                        <div class="card-tools">
                            <button type="button" class="btn btn-tool" data-card-widget="remove">
                                <i class="fas fa-times"></i>
                            </button>
                        </div>
                    </div>

                    <div class="card-body">
                        <div class="row">
                        <div class="col-sm-2">
                            <a href="#" data-toggle="lightbox" data-title="sample 1 - white" data-gallery="gallery">
                            <img src="{{asset('dist/img/user1-128x128.jpg')}}" class="img-fluid mb-2" alt="white sample"/>
                            </a>
                        </div>
                        <div class="col-sm-2">
                            <a href="#" data-toggle="lightbox" data-title="sample 2 - black" data-gallery="gallery">
                            <img src="{{asset('dist/img/user1-128x128.jpg')}}" class="img-fluid mb-2" alt="black sample"/>
                            </a>
                        </div>
                        <div class="col-sm-2">
                            <a href="#" data-toggle="lightbox" data-title="sample 3 - red" data-gallery="gallery">
                            <img src="{{asset('dist/img/user1-128x128.jpg')}}" class="img-fluid mb-2" alt="red sample"/>
                            </a>
                        </div>
                        <div class="col-sm-2">
                            <a href="#" data-toggle="lightbox" data-title="sample 4 - red" data-gallery="gallery">
                            <img src="{{asset('dist/img/user1-128x128.jpg')}}" class="img-fluid mb-2" alt="red sample"/>
                            </a>
                        </div>
                        <div class="col-sm-2">
                            <a href="#" data-toggle="lightbox" data-title="sample 5 - black" data-gallery="gallery">
                            <img src="{{asset('dist/img/user1-128x128.jpg')}}" class="img-fluid mb-2" alt="black sample"/>
                            </a>
                        </div>
                        <div class="col-sm-2">
                            <a href="#" data-toggle="lightbox" data-title="sample 6 - white" data-gallery="gallery">
                            <img src="{{asset('dist/img/user1-128x128.jpg')}}" class="img-fluid mb-2" alt="white sample"/>
                            </a>
                        </div>
                        <div class="col-sm-2">
                            <a href="#" data-toggle="lightbox" data-title="sample 7 - white" data-gallery="gallery">
                            <img src="{{asset('dist/img/user1-128x128.jpg')}}" class="img-fluid mb-2" alt="white sample"/>
                            </a>
                        </div>
                        <div class="col-sm-2">
                            <a href="#" data-toggle="lightbox" data-title="sample 8 - black" data-gallery="gallery">
                            <img src="{{asset('dist/img/user1-128x128.jpg')}}" class="img-fluid mb-2" alt="black sample"/>
                            </a>
                        </div>
                        <div class="col-sm-2">
                            <a href="#" data-toggle="lightbox" data-title="sample 9 - red" data-gallery="gallery">
                            <img src="{{asset('dist/img/user1-128x128.jpg')}}" class="img-fluid mb-2" alt="red sample"/>
                            </a>
                        </div>
                        <div class="col-sm-2">
                            <a href="#" data-toggle="lightbox" data-title="sample 10 - white" data-gallery="gallery">
                            <img src="{{asset('dist/img/user1-128x128.jpg')}}" class="img-fluid mb-2" alt="white sample"/>
                            </a>
                        </div>
                        <div class="col-sm-2">
                            <a href="#" data-toggle="lightbox" data-title="sample 11 - white" data-gallery="gallery">
                            <img src="{{asset('dist/img/user1-128x128.jpg')}}" class="img-fluid mb-2" alt="white sample"/>
                            </a>
                        </div>
                        <div class="col-sm-2">
                            <a href="#" data-toggle="lightbox" data-title="sample 12 - black" data-gallery="gallery">
                            <img src="{{asset('dist/img/user1-128x128.jpg')}}" class="img-fluid mb-2" alt="black sample"/>
                            </a>
                        </div>
                        </div>
                    </div>
                </div>
            </div>

            {{--
                <div class="col-12">
                    <div class="card card-primary">
                    <div class="card-header">
                        <div class="card-title">
                        FilterizR Gallery with Ekko Lightbox
                        </div>
                    </div>
                    <div class="card-body">
                        <div>
                        <div class="btn-group w-100 mb-2">
                            <a class="btn btn-info active" href="javascript:void(0)" data-filter="all"> All items </a>
                            <a class="btn btn-info" href="javascript:void(0)" data-filter="1"> Category 1 (WHITE) </a>
                            <a class="btn btn-info" href="javascript:void(0)" data-filter="2"> Category 2 (BLACK) </a>
                            <a class="btn btn-info" href="javascript:void(0)" data-filter="3"> Category 3 (COLORED) </a>
                            <a class="btn btn-info" href="javascript:void(0)" data-filter="4"> Category 4 (COLORED, BLACK) </a>
                        </div>
                        <div class="mb-2">
                            <a class="btn btn-secondary" href="javascript:void(0)" data-shuffle> Shuffle items </a>
                            <div class="float-right">
                            <select class="custom-select" style="width: auto;" data-sortOrder>
                                <option value="index"> Sort by Position </option>
                                <option value="sortData"> Sort by Custom Data </option>
                            </select>
                            <div class="btn-group">
                                <a class="btn btn-default" href="javascript:void(0)" data-sortAsc> Ascending </a>
                                <a class="btn btn-default" href="javascript:void(0)" data-sortDesc> Descending </a>
                            </div>
                            </div>
                        </div>
                        </div>
                        <div>
                        <div class="filter-container p-0 row">
                            <div class="filtr-item col-sm-2" data-category="1" data-sort="white sample">
                            <a href="#" data-toggle="lightbox" data-title="sample 1 - white">
                                <img src="{{asset('dist/img/user1-128x128.jpg')}}" class="img-fluid mb-2" alt="white sample"/>
                            </a>
                            </div>
                            <div class="filtr-item col-sm-2" data-category="2, 4" data-sort="black sample">
                            <a href="https://via.placeholder.com/1200/000000.png?text=2" data-toggle="lightbox" data-title="sample 2 - black">
                                <img src="{{asset('dist/img/user1-128x128.jpg')}}" class="img-fluid mb-2" alt="black sample"/>
                            </a>
                            </div>
                            <div class="filtr-item col-sm-2" data-category="3, 4" data-sort="red sample">
                            <a href="#" data-toggle="lightbox" data-title="sample 3 - red">
                                <img src="{{asset('dist/img/user1-128x128.jpg')}}" class="img-fluid mb-2" alt="red sample"/>
                            </a>
                            </div>
                            <div class="filtr-item col-sm-2" data-category="3, 4" data-sort="red sample">
                            <a href="#" data-toggle="lightbox" data-title="sample 4 - red">
                                <img src="{{asset('dist/img/user1-128x128.jpg')}}" class="img-fluid mb-2" alt="red sample"/>
                            </a>
                            </div>
                            <div class="filtr-item col-sm-2" data-category="2, 4" data-sort="black sample">
                            <a href="#" data-toggle="lightbox" data-title="sample 5 - black">
                                <img src="{{asset('dist/img/user1-128x128.jpg')}}" class="img-fluid mb-2" alt="black sample"/>
                            </a>
                            </div>
                            <div class="filtr-item col-sm-2" data-category="1" data-sort="white sample">
                            <a href="#" data-toggle="lightbox" data-title="sample 6 - white">
                                <img src="{{asset('dist/img/user1-128x128.jpg')}}" class="img-fluid mb-2" alt="white sample"/>
                            </a>
                            </div>
                            <div class="filtr-item col-sm-2" data-category="1" data-sort="white sample">
                            <a href="#" data-toggle="lightbox" data-title="sample 7 - white">
                                <img src="{{asset('dist/img/user1-128x128.jpg')}}" class="img-fluid mb-2" alt="white sample"/>
                            </a>
                            </div>
                            <div class="filtr-item col-sm-2" data-category="2, 4" data-sort="black sample">
                            <a href="#" data-toggle="lightbox" data-title="sample 8 - black">
                                <img src="{{asset('dist/img/user1-128x128.jpg')}}" class="img-fluid mb-2" alt="black sample"/>
                            </a>
                            </div>
                            <div class="filtr-item col-sm-2" data-category="3, 4" data-sort="red sample">
                            <a href="#" data-toggle="lightbox" data-title="sample 9 - red">
                                <img src="{{asset('dist/img/user1-128x128.jpg')}}" class="img-fluid mb-2" alt="red sample"/>
                            </a>
                            </div>
                            <div class="filtr-item col-sm-2" data-category="1" data-sort="white sample">
                            <a href="#" data-toggle="lightbox" data-title="sample 10 - white">
                                <img src="{{asset('dist/img/user1-128x128.jpg')}}" class="img-fluid mb-2" alt="white sample"/>
                            </a>
                            </div>
                            <div class="filtr-item col-sm-2" data-category="1" data-sort="white sample">
                            <a href="#" data-toggle="lightbox" data-title="sample 11 - white">
                                <img src="{{asset('dist/img/user1-128x128.jpg')}}" class="img-fluid mb-2" alt="white sample"/>
                            </a>
                            </div>
                            <div class="filtr-item col-sm-2" data-category="2, 4" data-sort="black sample">
                            <a href="#" data-toggle="lightbox" data-title="sample 12 - black">
                                <img src="{{asset('dist/img/user1-128x128.jpg')}}" class="img-fluid mb-2" alt="black sample"/>
                            </a>
                            </div>
                        </div>
                        </div>

                    </div>
                    </div>
                </div>
            --}}
        </div>
      </div><!-- /.container-fluid -->
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