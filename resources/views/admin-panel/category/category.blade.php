@extends('layouts.dashboard')

@section('content-css')
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <meta name="delete-category-url" content="{{ route('delete-category') }}">
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


            {{-- <div class="col-md-6 mb-2 offset-md-3 d-flex justify-content-end">
                <a href="/admin/category-add" class="btn btn-secondary">Add New Category</a>
            </div> --}}

        </div>
        
        <div class="row">
 
            <div class="col-lg-12">
                {{-- <x-admin.tables.table-component /> --}}

                <div class="card">
        
                    <div class="card-header border-transparent     d-flex align-items-center justify-content-between flex-wrap">
                        <h3 class="card-title  mb-2 mb-md-0">Categories</h3>


                        <div class="mx-auto mb-2 mb-md-0   d-flex align-items-center justify-content-between" style="min-width: 300px; flex-grow: 1; max-width: 600px;">
                            <x-admin.searchbar.search-bar 
                                page="category" 
                                divClass="w-100 mr-1"
                                placeholder="Search by name, category, group, price and discount"
                                id="category-search-bar"
                                value="{{ $search_keyword }}"
                            />
                            <button type="button" class="btn btn-sm btn-info w-50" id="advance-search-btn">
                                Advance Filter
                            </button>
                        </div>

                        

                        <div class="card-tools   mb-2 mb-md-0">
                            {{-- <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                <i class="fas fa-minus"></i>
                            </button> --}}
                            
                            {{-- <button type="button" class="btn btn-tool" data-card-widget="remove">
                                <i class="fas fa-times"></i>
                            </button> --}}

                            <a href="{{ route("add-category") }}" class="btn btn-sm btn-secondary ">Add New Category</a>
                        </div>
                    </div>

                    {{-- Card Body --}}
                    <div class="card-body p-0">
                        <div class="table-responsive">
                            <table class="table m-0">
                                <thead>
                                <tr>
                                    <th>Sno</th>
                                    <th>Category</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                                </thead>

                                <tbody>

                                    @if($categories->total())
                                        
                                        @php $counter = 0; @endphp

                                        @foreach($categories as $category)
                                            <tr>
                                                <td rowspan="">
                                                    <a href="#">{{ ++$counter }}</a>
                                                </td>

                                                <td rowspan="">{{ $category["category_name"] }}</td> <!-- Spans vertically across subcategories -->
                                                
                                                <td>
                                                    <span class="badge badge-{{ ($category["status"]) ? "success" : "danger" }}">
                                                        {{ getGeneralStatus($category["status"]) }}
                                                    </span>
                                                </td>

                                                <td>

                                                    @if($category["status"])
                                                        {{-- Add Images --}}
                                                        <a 
                                                            href="/admin/category-images-update/{{ $category["category_slug"] }}"
                                                            class="btn btn-sm btn-info">
                                                            Images
                                                        </a>

                                                        {{-- Edit Category --}}
                                                        <a 
                                                            href="/admin/category-edit/{{ $category["category_slug"] }}"
                                                            class="btn btn-sm btn-secondary">
                                                            Edit
                                                        </a>

                                                        {{-- Delete BTN --}}
                                                        <button 
                                                            type="button" 
                                                            class="btn btn-sm btn-danger delete-category"
                                                            data-category_name="{{$category["category_name"]}}"
                                                            data-category_id="{{ $category["id"] }}">
                                                            Delete
                                                        </button>
                                                    @else
                                                        {{-- Restore --}}
                                                        <button 
                                                            type="button" 
                                                            class="btn btn-sm btn-success restore-category"
                                                            data-category_name="{{$category["category_name"]}}"
                                                            data-category_id="{{ $category["id"] }}">
                                                            Restore
                                                        </button>
                                                    @endif

                                                </td>
                                            </tr>    
                                        @endforeach
                                        
                                    @else
                                        <tr>
                                            <td colspan="4" class="text-center">
                                                No Category Found </span>
                                            </td>
                                        </tr>
                                    @endif
                                

                                    
                                </tbody>

                            </table>
                        </div>
                        <!-- /.table-responsive -->
                    </div>

                    
                    {{-- Pagination --}}
                    <div class="card-footer clearfix">
                        {{ $categories->links() }}
                    </div>
                    
                </div>

            </div>

        </div>
        
      </div>
    </div>

@endsection


@section('content-scripts')
    <script>

        window.onload = ()=> {
            
            document.addEventListener('click', event=>{
                let element = event.target;
                
                // delete category 
                if(element.className.includes("delete-category")){
                    if(window.confirm(`You wish to delete ${element.dataset.category_name}?`)){
                        category_action(element, "delete-category");
                    }
                }

                // restore category 
                else if(element.className.includes("restore-category")){
                    if(window.confirm(`You wish to restore ${element.dataset.category_name}?`)){
                        category_action(element, "restore-category");
                    }
                }
            });

            
            document.addEventListener('change', event=>{

                let element = event.target;

                // load based on status
                if(element.id === "select-status"){
                    let category_status = element.value;
                    console.log(category_status); 
                    //return false;
                    
                    let new_location = MyApp.appendQueryString(MyApp.CURRENT_URL, "status", category_status);

                    if(category_status == "") new_location = '/admin/category';
                    
                    location.href = new_location;
                }
            });


            async function category_action(action_btn, requested_action=""){
                let category_id = action_btn.dataset.category_id;
                // let requested_action;
                let action_btn_content = action_btn.innerHTML;
                action_btn.innerHTML = MyApp.LOADER_SMALL;
                action_btn.disabled = true;
                // return false;

                let form_data = {
                    category_id: category_id,
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

                
                let url = document.querySelector('meta[name="delete-category-url"]').getAttribute('content');

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



            // SEARCH ACTION
                let result_options = {
                    search_keyword: '',
                    limit: 10,
                    //start: 0
                };

                const SEARCH_BAR = document.getElementById("category-search-bar");
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
        };

    </script>
@endsection


{{-- ADD IMAGE UPLOAD OPTION --}}

{{-- READ - Working
ADD - Working
EDIT - Working
DELETE - Working (More operations to be done)
Restore - Working --}}
