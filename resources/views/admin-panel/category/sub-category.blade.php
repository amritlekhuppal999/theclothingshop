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

        {{-- infobox --}}
        <div class="row">
            <div class="col-md-4 mb-2">
                
                <select name="select-category" id="select-category" class="form-control select2bs4">
                    <option value="0">Select Category</option>
                    <option value="topwear" selected>Topwear</option>
                    <option value="bottomwear">Bottomwear</option>
                    <option value="bestseller">Bestseller</option>
                    <option value="sneakers">Sneakers</option>
                    <option value="accessories">Accessories</option>
                    <option value="collection">Collection</option>
                    <option value="themes">Themes</option>
                </select>
            </div>

            <div class="col-md-6 offset-md-2 mb-2 d-flex justify-content-end">
                <a href="javascript:void(0)" class="btn btn-sm btn-secondary">Add New Sub Category</a>
            </div>

        </div>
        
        <div class="row">
 
            <div class="col-lg-12">
                {{-- <x-admin.tables.table-component /> --}}

                <div class="card">
        
                    <div class="card-header border-transparent">
                        <h3 class="card-title">Sub Categories</h3>

                        <div class="card-tools">
                            <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                <i class="fas fa-minus"></i>
                            </button>
                            
                            {{-- <button type="button" class="btn btn-tool" data-card-widget="remove">
                                <i class="fas fa-times"></i>
                            </button> --}}
                        </div>
                    </div>

                    
                    <div class="card-body p-0">
                        <div class="table-responsive">
                            <table class="table m-0">
                                <thead>
                                    <tr>
                                        <th>Sno</th>
                                        <th>Name</th>
                                        <th>Status</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>

                                <tbody>
                                    <tr>
                                        <td rowspan="">
                                            <a href="#">1</a>
                                        </td>

                                        <td rowspan="">All Topwear</td> 
                                        
                                        <td rowspan="">
                                            <span class="badge badge-success">Active</span>
                                        </td>
                                        <td rowspan="">
                                            <button class="btn btn-sm btn-secondary">Edit</button>
                                            <button class="btn btn-sm btn-danger">Delete</button>
                                        </td>
                                    </tr>

                                    <tr>
                                        <td rowspan="">
                                            <a href="#">2</a>
                                        </td>

                                        <td rowspan="">All T-Shirts</td> 
                                        
                                        <td rowspan="">
                                            <span class="badge badge-success">Active</span>
                                        </td>
                                        <td rowspan="">
                                            <button class="btn btn-sm btn-secondary">Edit</button>
                                            <button class="btn btn-sm btn-danger">Delete</button>
                                        </td>
                                    </tr>

                                    <tr>
                                        <td rowspan="">
                                            <a href="#">3</a>
                                        </td>

                                        <td rowspan="">All Shirts</td> 
                                        
                                        <td rowspan="">
                                            <span class="badge badge-success">Active</span>
                                        </td>
                                        <td rowspan="">
                                            <button class="btn btn-sm btn-secondary">Edit</button>
                                            <button class="btn btn-sm btn-danger">Delete</button>
                                        </td>
                                    </tr>

                                    <tr>
                                        <td rowspan="">
                                            <a href="#">4</a>
                                        </td>

                                        <td rowspan="">Oversized T-Shirts</td> 
                                        
                                        <td rowspan="">
                                            <span class="badge badge-success">Active</span>
                                        </td>
                                        <td rowspan="">
                                            <button class="btn btn-sm btn-secondary">Edit</button>
                                            <button class="btn btn-sm btn-danger">Delete</button>
                                        </td>
                                    </tr>

                                    <tr>
                                        <td rowspan="">
                                            <a href="#">5</a>
                                        </td>

                                        <td rowspan="">Polos</td> 
                                        
                                        <td rowspan="">
                                            <span class="badge badge-success">Active</span>
                                        </td>
                                        <td rowspan="">
                                            <button class="btn btn-sm btn-secondary">Edit</button>
                                            <button class="btn btn-sm btn-danger">Delete</button>
                                        </td>
                                    </tr>

                                    <tr>
                                        <td rowspan="">
                                            <a href="#">6</a>
                                        </td>

                                        <td rowspan="">Solid T-Shirts</td> 
                                        
                                        <td rowspan="">
                                            <span class="badge badge-success">Active</span>
                                        </td>
                                        <td rowspan="">
                                            <button class="btn btn-sm btn-secondary">Edit</button>
                                            <button class="btn btn-sm btn-danger">Delete</button>
                                        </td>
                                    </tr>

                                    <tr>
                                        <td rowspan="">
                                            <a href="#">7</a>
                                        </td>

                                        <td rowspan="">Classic Fit T-Shirts</td> 
                                        
                                        <td rowspan="">
                                            <span class="badge badge-success">Active</span>
                                        </td>
                                        <td rowspan="">
                                            <button class="btn btn-sm btn-secondary">Edit</button>
                                            <button class="btn btn-sm btn-danger">Delete</button>
                                        </td>
                                    </tr>
                                </tbody>

                            </table>
                        </div>
                        
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

            $('.select2bs4').select2({
                theme: 'bootstrap4'
            })
        }
    </script>
@endsection