@extends('layouts.dashboard')

@section('content-css')

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
            
            <div class="col-md-6 mb-2 offset-md-6 d-flex justify-content-end">
                <a href="javascript:void(0)" class="btn btn-sm btn-secondary">Add New Category</a>
                {{-- <a href="javascript:void(0)" class="btn btn-sm btn-secondary ">View All Orders</a> --}}
            </div>

        </div>
        
        <div class="row">
 
            <div class="col-lg-12">
                {{-- <x-admin.tables.table-component /> --}}

                <div class="card">
        
                    <div class="card-header border-transparent">
                        <h3 class="card-title">Categories</h3>

                        

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
                                    <th>Category</th>
                                    <th>Sub Categories</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                                </thead>

                                <tbody>
                                    <tr>
                                        <td rowspan="">
                                            <a href="#">1</a>
                                        </td>

                                        <td rowspan="">Topwear</td> <!-- Spans vertically across subcategories -->
                                        
                                        {{-- Sub Categories --}}
                                        <td>
                                            <div class="card card-outline card-primary collapsed-card">
                                                <div class="card-header">
                                                    <h3 class="card-title">Expand</h3>

                                                    <div class="card-tools">
                                                        <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                                            <i class="fas fa-plus"></i>
                                                        </button>
                                                    </div>
                                                </div>

                                                <div class="card-body p-0">
                                                    <ul class="list-group">
                                                        <li class="list-group-item">All Topwear</li>
                                                        <li class="list-group-item">All T-Shirts</li>
                                                        <li class="list-group-item">All Shirts</li>
                                                        <li class="list-group-item">Oversized T-Shirts</li>
                                                        <li class="list-group-item">Polos</li>
                                                        <li class="list-group-item">Solid T-Shirts</li>
                                                        <li class="list-group-item">Classic Fit T-Shirts</li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </td>

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

                                        <td rowspan="">Bottomwear</td> <!-- Spans vertically across subcategories -->
                                        
                                        {{-- Sub Categories --}}
                                        <td>
                                            <div class="card card-outline card-primary collapsed-card">
                                                <div class="card-header">
                                                    <h3 class="card-title">Expand</h3>

                                                    <div class="card-tools">
                                                        <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                                            <i class="fas fa-plus"></i>
                                                        </button>
                                                    </div>
                                                </div>

                                                <div class="card-body p-0">
                                                    <ul class="list-group">
                                                        <li class="list-group-item">All Bottomwear </li>
                                                        <li class="list-group-item">Pants </li>
                                                        <li class="list-group-item">Cargos </li>
                                                        <li class="list-group-item">Jeans </li>
                                                        <li class="list-group-item">Joggers </li>
                                                        <li class="list-group-item">Shorts </li>
                                                        <li class="list-group-item">Boxers Innerwear </li>
                                                        <li class="list-group-item">Pajamas </li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </td>

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

                                        <td rowspan="">Bestseller</td> <!-- Spans vertically across subcategories -->
                                        
                                        {{-- Sub Categories --}}
                                        <td>
                                            <div class="card card-outline card-primary collapsed-card">
                                                <div class="card-header">
                                                    <h3 class="card-title">Expand</h3>

                                                    <div class="card-tools">
                                                        <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                                            <i class="fas fa-plus"></i>
                                                        </button>
                                                    </div>
                                                </div>

                                                <div class="card-body p-0">
                                                    <ul class="list-group">
                                                        <li class="list-group-item">Best of T-Shirts </li>
                                                        <li class="list-group-item">Best of Shirts </li>
                                                        <li class="list-group-item">Best of Polos </li>
                                                        <li class="list-group-item">Best of Bottoms </li>
                                                        <li class="list-group-item">Best of Sneakers </li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </td>

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
                        <!-- /.table-responsive -->
                    </div>

                    
                    {{-- <div class="card-footer clearfix">
                        <a href="javascript:void(0)" class="btn btn-sm btn-info float-left">Add New Category</a>
                        <a href="javascript:void(0)" class="btn btn-sm btn-secondary float-right">View All Orders</a>
                    </div> --}}
                    
                </div>

            </div>

        </div>
        
      </div>
    </div>

@endsection


@section('content-scripts')
    
@endsection