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
                <a href="/admin/attribute-add" class="btn btn-sm btn-secondary">Add New Attribute</a>
            </div>

        </div>
        
        <div class="row">
 
            <div class="col-lg-12">
                {{-- <x-admin.tables.table-component /> --}}

                <div class="card">
        
                    <div class="card-header border-transparent">
                        <h3 class="card-title">Attributes</h3>

                        

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
                                        <th>Attribute</th>
                                        <th>Name</th>
                                        <th>Type</th>
                                        {{-- <th>Status</th> --}}
                                        <th>Action</th>
                                    </tr>
                                </thead>

                                <tbody>
                                    @foreach($attributes as $attribute)
                                        <tr>
                                            <td>{{ $attribute->id }}</td>
                                            <td>{{ $attribute->attribute }}</td>
                                            <td>{{ $attribute->label }}</td>
                                            <td>{{ $attribute->type }}</td>
                                            <td>
                                                <a href="edit/{{$attribute->id}}" class="btn btn-sm btn-secondary">Edit</a>
                                                <a href="delete/{{$attribute->id}}" class="btn btn-sm btn-danger">Edit</a>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>                                

                                {{--
                                    <tbody>
                                        <tr>
                                            <td rowspan="">
                                                <a href="#">1</a>
                                            </td>

                                            <td rowspan="">XS</td> 
                                            
                                            <td> Extra Small </td>
                                            
                                            <td> Size </td>

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

                                            <td rowspan="">S</td> 
                                            
                                            <td> Small </td>
                                            
                                            <td> Size </td>

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

                                            <td rowspan="">Red</td> 
                                            
                                            <td> Red </td>
                                            
                                            <td> Color </td>

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

                                            <td rowspan="">Green</td> 
                                            
                                            <td> Green </td>
                                            
                                            <td> Color </td>

                                            <td rowspan="">
                                                <span class="badge badge-success">Active</span>
                                            </td>
                                            <td rowspan="">
                                                <button class="btn btn-sm btn-secondary">Edit</button>
                                                <button class="btn btn-sm btn-danger">Delete</button>
                                            </td>
                                        </tr>
                                    </tbody>
                                --}}

                            </table>
                        </div>
                        <!-- /.table-responsive -->
                    </div>

                    
                    <div class="card-footer clearfix">
                        {{-- <a href="javascript:void(0)" class="btn btn-sm btn-info float-left">Add New Category</a>
                        <a href="javascript:void(0)" class="btn btn-sm btn-secondary float-right">View All Orders</a> --}}
                        {{ $attributes->links() }}
                    </div>
                    
                </div>

            </div>

        </div>
        
      </div>
    </div>

@endsection


@section('content-scripts')
    
@endsection