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
                        <h3 class="card-title">Add Category</h3>
                    </div>
                    
                    <form action="{{ route('add-category') }}" method="POST" role="form">
                        <div class="card-body">
                            
                            <div class="form-group">
                                <label for="exampleInputEmail1">Attribute Value</label>
                                <input type="text" class="form-control" id="attributeValue" placeholder="XS,Red">
                            </div>

                            <div class="form-group">
                                <label for="exampleInputPassword1">Name</label>
                                <input type="text" class="form-control" id="attributeName" placeholder="Name of attribute">
                            </div>

                            <div class="form-group">
                                <label for="exampleInputFile">Type</label>
                                <select name="attributeType" id="attributeType" class="form-control select2bs4">
                                    <option value="0">Select</option>
                                    <option value="1">Size</option>
                                    <option value="2">Color</option>
                                    <option value="3">Theme</option>
                                </select>
                            </div>

                            {{-- <div class="form-check">
                                <input type="checkbox" class="form-check-input" id="exampleCheck1">
                                <label class="form-check-label" for="exampleCheck1">Check me out</label>
                            </div> --}}
                        </div>
                        <!-- /.card-body -->

                        <div class="card-footer">
                            <button type="submit" class="btn btn-primary">Submit</button>
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

            $('.select2bs4').select2({
                theme: 'bootstrap4'
            })
        }
    </script>
@endsection