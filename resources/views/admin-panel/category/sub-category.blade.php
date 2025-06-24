@extends('layouts.dashboard')

@section('content-css')
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <meta name="delete-sub-category-url" content="{{ route('delete-sub-category') }}">
    
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

        {{-- infobox --}}
        <div class="row">
            <div class="col-md-4 mb-2">
                
                <select 
                    name="select-category" 
                    id="select-category" 
                    class="form-control" 
                    data-value="{{ isset($categorySlug) ? $categorySlug : '' }}">
                    <option value="">Loading...</option>
                </select>
            </div>

            {{-- Select Status --}}
            <div class="col-md-3 mb-2">
                
                <select 
                    name="select-status" 
                    id="select-status" 
                    class="form-control" 
                    data-value="{{ request('status') }}">
                    <option value="">Status</option>
                    <option value="active" {{ request('status') == "active" ? "selected" : "" }}>Active</option>
                    <option value="deleted" {{ request('status') == "deleted" ? "selected" : "" }}>Deleted</option>
                </select>
            </div>

            {{-- <div class="col-md-5  mb-2 d-flex justify-content-end"> 
                <a href="/admin/sub-category-add" class="btn btn-secondary">Add New Sub-Category</a>
            </div> --}}

        </div>
        
        <div class="row">
 
            <div class="col-lg-12">
                {{-- <x-admin.tables.table-component /> --}}

                <div class="card">
        
                    <div class="card-header border-transparent     d-flex align-items-center justify-content-between flex-wrap">
                        <h3 class="card-title">Sub Categories</h3>

                        <div class="mx-auto mb-2 mb-md-0   d-flex align-items-center justify-content-between" style="min-width: 300px; flex-grow: 1; max-width: 600px;">
                            <x-admin.searchbar.search-bar 
                                page="category" 
                                divClass="w-100 mr-1"
                                placeholder="Search by name, category, group, price and discount"
                                id="sub-category-search-bar"
                                value="{{ isset($search_keyword) ? $search_keyword : '' }}"
                            />
                            <button type="button" class="btn btn-sm btn-info w-50" id="advance-search-btn">
                                Advance Filter
                            </button>
                        </div>

                        <div class="card-tools    mb-2 mb-md-0">
                            {{-- <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                <i class="fas fa-minus"></i>
                            </button>
                            
                            <button type="button" class="btn btn-tool" data-card-widget="remove">
                                <i class="fas fa-times"></i>
                            </button> --}}

                            <a href="{{ route("sub-category-add") }}" class="btn btn-sm btn-secondary">Add New Sub-Category</a>
                        </div>
                    </div>

                    
                    <div class="card-body p-0">
                        <div class="table-responsive">
                            <table class="table m-0">
                                <thead>
                                    <tr>
                                        <th>Sno</th>
                                        {{-- <th>Category</th> --}}
                                        <th>Sub Category</th>
                                        <th>Status</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>

                                <tbody>
                                    @if($subCategories->total())
                                        
                                        @php
                                            $counter = 0;
                                        @endphp
                                        @foreach($subCategories as $subCategory)
                                            <tr>
                                                <td>
                                                    <a href="#">{{++$counter}}</a>
                                                </td>

                                                <td>{{ $subCategory["sub_category_name"] }}</td> 
                                                
                                                <td>
                                                    <span class="badge badge-{{ ($subCategory["status"]) ? "success" : "danger" }}">
                                                        {{ getGeneralStatus($subCategory["status"]) }}
                                                    </span>
                                                </td>

                                                <td>

                                                    @if($subCategory["status"])
                                                        {{-- Add Images --}}
                                                        <a 
                                                            href="{{ route("subcat-img-up", [ "subCategorySlug" => $subCategory["sub_category_slug"]]) }}"
                                                            class="btn btn-sm btn-info">
                                                            Images
                                                        </a>

                                                        {{-- Edit --}}
                                                        <a 
                                                            class="btn btn-sm btn-secondary"
                                                            data-sub_category_id="{{ $subCategory["id"] }}"
                                                            data-sub_category_slug="{{ $subCategory["sub_category_slug"] }}"
                                                            href="{{-- route("sub-category-edit", [ "subCategorySlug" => $subCategory["sub_category_slug"] ]) --}}"
                                                            class="btn btn-sm btn-secondary">
                                                            Edit
                                                        </a>

                                                        {{-- Delete --}}
                                                        <button 
                                                            type="button" 
                                                            class="btn btn-sm btn-danger delete-sub_category"
                                                            data-sub_category_name="{{ $subCategory["sub_category_name"] }}"
                                                            data-sub_category_id="{{ $subCategory["id"] }}"
                                                            data-sub_category_slug="{{ $subCategory["sub_category_slug"] }}">
                                                            Delete
                                                        </button>
                                                    @else
                                                        {{-- Restore --}}
                                                        <button 
                                                            type="button" 
                                                            class="btn btn-sm btn-success restore-sub_category"
                                                            data-sub_category_name="{{ $subCategory["sub_category_name"] }}"
                                                            data-sub_category_id="{{ $subCategory["id"] }}"
                                                            data-sub_category_slug="{{ $subCategory["sub_category_slug"] }}">
                                                            Restore
                                                        </button>
                                                    @endif
                                                    
                                                </td>
                                            </tr>
                                        @endforeach
                                    
                                    @else
                                        <tr>
                                            <td colspan="5" class="text-center">
                                                No <span>sub-category</span> found for selected <span>category</span>
                                            </td>
                                        </tr>
                                    @endif
                                </tbody>

                            </table>
                        </div>
                        
                    </div>

                    {{-- Pagination --}}
                    <div class="card-footer clearfix">
                        {{ $subCategories->links() }}
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

            /*
                $('#select-category').select2({
                    theme: 'bootstrap4'
                })
            */

            // Event Listener for various elements in DOM
            document.addEventListener('click', event=>{
                let element = event.target;

                /*
                if(element.id =="load-sub_categories"){
                    let category_slug = document.getElementById("select-category").value;
                    
                    location.href = `/admin/sub-category/${category_slug}`;
                }
                */

                // delete sub category 
                if(element.className.includes("delete-sub_category")){
                    // delete_sub_category(element);
                    if(window.confirm(`You wish to delete ${element.dataset.sub_category_name}?`)){
                        sub_category_action(element, "delete-sub-category");
                    }
                }

                // restore sub category 
                else if(element.className.includes("restore-sub_category")){
                    if(window.confirm(`You wish to restore ${element.dataset.sub_category_name}?`)){
                        sub_category_action(element, "restore-sub-category");
                    }
                }
            });

            document.addEventListener('change', event=>{

                let element = event.target;

                // load based on category
                if(element.id === "select-category"){
                    let category_slug = element.value;
                    
                    location.href = `/admin/sub-category/${category_slug}`;
                }

                // load based on status
                if(element.id === "select-status"){
                    let category_status = element.value;
                    
                    let new_location = MyApp.appendQueryString(MyApp.CURRENT_URL, "status", category_status);

                    //if(category_status == "") new_location = '/admin/sub-category';

                    location.href = new_location;
                }
            });

            
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

            // delete sub category function
            async function delete_sub_category_X(delete_btn){
                let sub_category_id = delete_btn.dataset.sub_category_id;
                let delete_BTN_Content = delete_btn.innerHTML;
                delete_btn.innerHTML = MyApp.LOADER_SMALL;
                delete_btn.disabled = true;
                // return false;

                let form_data = {
                    sub_category_id: sub_category_id,
                };

                // console.log(form_data);

                const request_options = {
                    method: 'POST',
                    headers: {
                        'content-type': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                    },
                    body: JSON.stringify(form_data)
                };

                
                // let url = '{{ route("delete-sub-category") }}';
                // let url = 'sub-category-delete';
                let url = document.querySelector('meta[name="delete-sub-category-url"]').getAttribute('content');

                console.log(url)

                try{
                    let response = await fetch(url, request_options);
                    //console.log(response);
                    let response_data = await response.json();

                    //console.log('Response:', response_data);
                    
                    if(response_data.deleted){
                        toastr.success(response_data.message);
                        
                        //submit_btn.innerHTML = submit_btn_cont;
                        //submit_btn.disabled = false;
                        setTimeout(() => {
                            location.reload();
                            //window.location.href = home_url;
                        }, 1000);
                    }
                    else {
                        toastr.error(response_data.message);
                        delete_btn.disabled = false;
                        delete_btn.innerHTML = delete_BTN_Content;
                    }
                }
                catch(error){
                    console.error('Error:', error);
                }
            }

            async function sub_category_action(action_btn, requested_action=""){
                let sub_category_id = action_btn.dataset.sub_category_id;
                // let requested_action;
                let action_btn_content = action_btn.innerHTML;
                action_btn.innerHTML = MyApp.LOADER_SMALL;
                action_btn.disabled = true;
                // return false;

                let form_data = {
                    sub_category_id: sub_category_id,
                    requested_action: requested_action
                };

                // console.log(form_data);

                const request_options = {
                    method: 'POST',
                    headers: {
                        'content-type': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                    },
                    body: JSON.stringify(form_data)
                };

                
                let url = document.querySelector('meta[name="delete-sub-category-url"]').getAttribute('content');

                // console.log(url)

                try{
                    let response = await fetch(url, request_options);
                    //console.log(response);
                    let response_data = await response.json();

                    //console.log('Response:', response_data);
                    
                    if(response_data.requested_action_performed){
                        toastr.success(response_data.message);

                        setTimeout(() => {
                            location.reload();
                            //window.location.href = home_url;
                        }, 1000);
                    }
                    else {
                        toastr.error(response_data.message);
                        action_btn.disabled = false;
                        action_btn.innerHTML = action_btn_content;
                    }
                }
                catch(error){
                    console.error('Error:', error);
                }
            }
        }


         // SEARCH ACTION
            let result_options = {
                search_keyword: '',
                limit: 10,
                //start: 0
            };

            const SEARCH_BAR = document.getElementById("sub-category-search-bar");
            const SEARCH_BTN = document.getElementById("search-btn");
            // const PRODUCT_RESULT_SECTION = document.getElementById("load-product-list");

            SEARCH_BAR.addEventListener('keypress', event=>{
                if(event.key === "Enter"){
                    search_action(SEARCH_BAR);
                }
            });

            SEARCH_BTN.addEventListener('click', event=>{
                search_action(SEARCH_BAR);
            });


            function search_action(target_ele){
                result_options.search_keyword = target_ele.value.replace(/\s/g, " ");

                if(result_options.search_keyword.length){
                    const queryParams = new URLSearchParams(result_options);
                    let new_url = MyApp.CURRENT_URL+'?'+queryParams;
                    location.href = new_url;
                    //history.pushState(null, null, new_url);
                    //load_products(result_options);
                }
            }
        // SEARCH ACTION END
        
    </script>
@endsection

{{-- ADD IMAGE UPLOAD OPTION --}}

{{-- READ - WORKING
ADD - WORKING 
EDIT - WORKING 
DELETE - WORKING  
Restore - WORKING  --}}