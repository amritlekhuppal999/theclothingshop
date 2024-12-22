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

    @php
        $page_url = explode("/", request()->path());
    @endphp
    
    <div class="content">
      <div class="container-fluid">

        {{-- Margin Div --}}
        <div class="row">
            <div class="col-md-12 mb-3"></div>
        </div>

        {{-- <h3> {{ request()->path() }} </h3> --}}
        {{-- <h3> @dump(explode("/", request()->path()) ) </h3> --}}

        @if(in_array("products-add", $page_url))
            
            {{-- Set Category --}}
            <div class="card card-purple ">
                <div class="card-header">
                    <h3 class="card-title">Category</h3>

                    {{-- collapse-expand BTN --}}
                    <div class="card-tools">
                        <button type="button" class="btn btn-tool" data-card-widget="collapse">
                            <i class="fas fa-minus"></i>
                        </button>
                    </div>
                </div>
                
                {{-- Select Category --}}
                <div class="card-body">
                    <div class="row">

                        {{-- Category --}}
                        <div class="col-md-4">
                            <label>Category</label>
                            <select class="form-control select2bs4" name="select-category" id="select-category" style="width: 100%;">
                                <option value="0">Select</option>
                                <option value="category-1" {{ (isset($categorySlug) && $categorySlug=="category-1") ? "selected" : "" }}>Category 1</option>
                                <option value="category-2" {{ (isset($categorySlug) && $categorySlug=="category-2") ? "selected" : "" }}>Category 2</option>
                                <option value="category-3" {{ (isset($categorySlug) && $categorySlug=="category-3") ? "selected" : "" }}>Category 3</option>
                            </select>
                        </div>

                        {{-- Sub Category --}}
                        <div class="col-md-4">
                            <label>Sub Category</label>
                            <select class="form-control select2bs4" name="select-sub-category" id="select-sub-category" style="width: 100%;">
                                <option value="0">Select</option>
                                <option value="sub-category-1" {{ (isset($subCategorySlug) && $subCategorySlug=="sub-category-1") ? "selected" : "" }}>Sub Category 1</option>
                                <option value="sub-category-2" {{ (isset($subCategorySlug) && $subCategorySlug=="sub-category-2") ? "selected" : "" }}>Sub Category 2</option>
                                <option value="sub-category-3" {{ (isset($subCategorySlug) && $subCategorySlug=="sub-category-3") ? "selected" : "" }}>Sub Category 3</option>
                            </select>
                        </div>

                        <div class="col-md-4 d-flex flex-column-reverse">
                            {{-- <label class=""></label> --}}
                            <button type="button" class=" btn btn-secondary " id="save-category" name="save-category"> Next </button>
                        </div>
                    </div>

                </div>
            </div>

        @elseif(in_array("products-add-images", $page_url) || in_array("products-add-variants", $page_url) )
            
            {{-- Change Product --}}
            <div class="row">
                <div class="col-md-7">
                    <div class="card card-purple card-outline ">
                        <div class="card-body">
                            
                            <div class="row">
                                <div class="col-md-12">
                                    <h3> Current Product Name </h3>
                                </div>
                            </div>

                            <div class="row justify-content-between">
                                {{-- Product --}}
                                <div class="col-md-8">
                                    {{-- <label>Product</label> --}}
                                    <select class="form-control select2bs4" name="change-product" id="change-product" style="width: 100%;" title="change-product">
                                        <option value="0">Select</option>
                                        <option value="product-1" {{ (isset($productSlug) && $productSlug == "product-1") ? "selected" : "" }}>Product 1</option>
                                        <option value="product-2" {{ (isset($productSlug) && $productSlug == "product-2") ? "selected" : "" }}>Product 2</option>
                                        <option value="product-3" {{ (isset($productSlug) && $productSlug == "product-3") ? "selected" : "" }}>Product 3</option>
                                    </select>
                                
                                </div>

                                {{-- Change product BTN --}}
                                <div class="col-md-4 d-flex flex-column-reverse">
                                    {{-- <label class=""></label> --}}
                                    <button 
                                        type="button" 
                                        class=" btn btn-secondary " 
                                        id="change-product-btn" 
                                        name="change-product-btn"
                                        data-url="{{ in_array("products-add-images", $page_url) ? 'products-add-images' : 'products-add-variants' }}"> 
                                        Change Product 
                                    </button>
                                </div>
                            
                            </div>
                            
                        </div>
                    </div>
                </div>
                
                
            </div>

        @endif

        {{-- @elseif( in_array("products-add-images", explode("/", request()->path())) ) --}}
        
        
        {{-- Products and varients --}}
        <div class="row" >
            
            {{-- Add Product Form --}}
            @if(in_array("products-add", $page_url) && isset($show_product_form) && $show_product_form)
                
                <div class="col-md-12">

                    <div class="card card-purple {{ (!$show_product_form) ? "collapsed-card" : "" }} ">
                        <div class="card-header">
                            <h3 class="card-title">Add Product</h3>

                            {{-- collapse-expand BTN --}}
                            <div class="card-tools">
                                <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                    <i class="fas fa-plus"></i>
                                </button>
                            </div>
                        </div>
                        

                        <div class="card-body">
                            <!-- form start -->
                            <form role="form" action="{{ route('add-product') }}" >

                                {{-- Gender --}}
                                <div class="form-group clearfix">
                                    <label class="mr-2">Target Group</label>
                                    <div class="icheck-primary d-inline">
                                        <input type="radio" id="radioPrimary1" name="r1" >
                                        <label for="radio"> Male </label>
                                    </div>

                                    <div class="icheck-primary d-inline">
                                        <input type="radio" id="radioPrimary2" name="r1">
                                        <label for="radio"> Female </label>
                                    </div>

                                    <div class="icheck-primary d-inline">
                                        <input type="radio" id="radioPrimary3" name="r1" >
                                        <label for="radio"> Unisex </label>
                                    </div>
                                </div>

                                {{-- Product Name --}}
                                <div class="form-group">
                                    <label for="">Product Name</label>
                                    <input type="text" class="form-control" id="" placeholder="Product Name">
                                </div>

                                {{-- Product Slug --}}
                                <div class="form-group">
                                    <label for="">Product Slug</label>
                                    <input type="text" class="form-control" id="product-slug" name="product-slug" placeholder="Product slug">
                                    <span id="slug-alert-msg"></span>
                                </div>

                                {{-- Cost Price --}}
                                <div class="form-group">
                                    <label for="">Cost Price</label>
                                    <input type="text" class="form-control" id="cost-price" name="cost-price" placeholder="Cost Price">
                                </div>

                                {{-- Selling Price --}}
                                <div class="form-group">
                                    <label for="">Selling Price</label>
                                    <input type="text" class="form-control" id="selling-price" name="selling-price" placeholder="Selling Price">
                                </div>

                                {{-- Discount --}}
                                <div class="form-group">
                                    <label for="">Discount Percentage</label>
                                    <input type="text" class="form-control" id="discount-percentage" name="discount-percentage" placeholder="Discount">
                                </div>

                                {{-- Short Description --}}
                                <div class="form-group">
                                    <label for="">Short Description</label>
                                    <textarea class="form-control" name="short-description" id="short-description"  rows="5"></textarea>
                                </div>

                                {{-- Long Description --}}
                                <div class="form-group">
                                    <label for="">Long Description</label>
                                    <textarea class="form-control" name="long-description" id="long-description"  rows="10"></textarea>
                                </div>
                                
                                {{-- <div class="form-check">
                                    <input type="checkbox" class="form-check-input" id="exampleCheck1">
                                    <label class="form-check-label" for="exampleCheck1">Check me out</label>
                                </div> --}}

                                {{-- Save product BTN --}}
                                <div class="form-group">
                                    <button 
                                        type="submit" 
                                        class="btn btn-secondary" 
                                        name="save-product" 
                                        id="save-product">
                                        Save Product
                                    </button>
                                </div>
                            
                            </form>
                        </div>
                    </div>
                </div>
            
            {{-- Add Images for the product --}}
            @elseif(in_array("products-add-images", $page_url) && isset($productSlug) )
                
                <div class="col-md-12">

                    <div class="card card-purple">
                        <div class="card-header">
                            <h3 class="card-title">Add Images</h3>

                            {{-- collapse-expand BTN --}}
                            <div class="card-tools">
                                <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                    <i class="fas fa-minus"></i>
                                </button>
                            </div>
                        </div>
                        

                        <div class="card-body">
                            <!-- form start -->
                            <form role="form">

                                <div class="row">
                                    <div class="col-md-6">
                                        <h4>Show added images here</h4>
                                        <p>
                                            The added images will be local and will only be saved once save BTN is clicked.
                                            We will have option to set main image for the product here.
                                            We can mess around with UI more later.
                                        </p>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <input 
                                                type="file" 
                                                class="form-control"
                                                name="add-product-images"
                                                id="add-product-images"
                                            />
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-12 d-flex justify-content-between">
                                        <button type="button" class="btn btn-secondary">Save</button>
                                        
                                        <button type="submit" class="btn btn-primary">Add Variants</button>
                                    </div>
                                </div>
                            
                            </form>
                        </div>
                    </div>
                </div>

            {{-- Add Product Variants --}}
            @elseif(in_array("products-add-variants", $page_url) && isset($productSlug) )
                
                <div class="col-md-12">
                    <div class="card card-secondary "> {{-- collapsed-card --}}
                        <div class="card-header">
                            <h3 class="card-title">Add Product Variants</h3>

                            {{-- collapse-expand BTN --}}
                            <div class="card-tools">
                                <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                    <i class="fas fa-minus"></i>
                                </button>
                            </div>
                        </div>
                        <!-- /.card-header -->
                        <!-- form start -->
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

            @endif

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
        
            document.addEventListener('click', (event)=>{
                let element = event.target;

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



        /*
        document.getElementById("change-product").addEventListener('change', (event)=>{
            let product_slug = document.getElementById("change-product").value;

            if(product_slug !== "0"){
                alert("product changed");
                location.href = `${ADMIN_URL}/products-add-images/${product_slug}`;
            }

            else location.href = `${ADMIN_URL}/products-add-images/`;
        });
        */

        /*
            document.addEventListener('change', (event)=>{
                let element = event.target;
                alert("noogers");
                if(element.id == "change-product"){
                    //event.preventDefault();
                    
                    let product_slug = element.value;

                    if(product_slug !== "0"){
                        alert("product changed");
                        location.href = `${ADMIN_URL}/products-add-images/${product_slug}`;
                    }

                    else location.href = `${ADMIN_URL}/products-add-images/`;

                }
                else alert("noogers");
            });
        */
    </script>
@endsection