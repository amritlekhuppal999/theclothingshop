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
    
    <div class="content">
      <div class="container-fluid">

        {{-- Margin Div --}}
        <div class="row">
            <div class="col-md-12 mb-3"></div>
        </div>

        {{-- Select Category --}}
        <div class="card card-purple collapsed-card">
            <div class="card-header">
                <h3 class="card-title">Select Category</h3>

                {{-- collapse-expand BTN --}}
                <div class="card-tools">
                    <button type="button" class="btn btn-tool" data-card-widget="collapse">
                        <i class="fas fa-plus"></i>
                    </button>
                </div>
            </div>

            <div class="card-body">
                <div class="row">

                    {{-- Category --}}
                    <div class="col-md-4">
                        <label>Category</label>
                        <select class="form-control select2bs4" name="select-category" id="select-category" style="width: 100%;">
                            <option value="0">Select</option>
                            <option value="1" selected>Category 1</option>
                            <option value="2">Category 2</option>
                            <option value="3">Category 3</option>
                        </select>
                    </div>

                    {{-- Sub Category --}}
                    <div class="col-md-4">
                        <label>Sub Category</label>
                        <select class="form-control select2bs4" name="select-sub-category" id="select-sub-category" style="width: 100%;">
                            <option value="0">Select</option>
                            <option value="1" selected>Sub Category 1</option>
                            <option value="2">Sub Category 2</option>
                            <option value="3">Sub Category 3</option>
                        </select>
                    </div>

                    <div class="col-md-4 d-flex flex-column-reverse">
                        {{-- <label class=""></label> --}}
                        <button type="button" class=" btn btn-secondary " id="save-category" name="save-category"> Save and Proceed</button>
                    </div>
                </div>

            </div>
            


            {{-- <div class="card-footer">
                <button type="submit" class="btn btn-secondary">Save & Proceed</button>
            </div> --}}
        </div>
        

        {{-- Products and varients --}}
        <div class="row" >
            
            {{-- Add Product Form --}}
            <div class="col-md-12">

                <div class="card card-purple collapsed-card">
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
                        <form role="form">

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

                            <div class="form-group">
                                <button type="submit" class="btn btn-secondary">Next</button>
                            </div>
                        
                        </form>
                    </div>
                </div>
            </div>

            {{-- Add Images for the product --}}
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
            <div class="col-md-12">
                <div class="card card-secondary collapsed-card">
                    <div class="card-header">
                        <h3 class="card-title">Add Product Variants</h3>

                        {{-- collapse-expand BTN --}}
                        <div class="card-tools">
                            <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                <i class="fas fa-plus"></i>
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

        </div>
        
      </div>
    </div>

    

@endsection


@section('content-scripts')
    
    <!-- Select2 JS -->
    <script src="{{ asset('plugins/select2/js/select2.full.min.js') }}"></script>

    <script>
        //$('#select-category').select2();
        $('.select2bs4').select2({
            theme: 'bootstrap4'
        })
    </script>
@endsection