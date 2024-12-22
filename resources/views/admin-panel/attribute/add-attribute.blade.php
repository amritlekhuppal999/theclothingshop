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
                        <h3 class="card-title">Add Attribute</h3>
                    </div>
                    
                    <form action="{{ route('add-attribute') }}" method="POST" role="form">
                        @csrf

                        <div class="card-body">
                            
                            {{-- Type --}}
                            <div class="form-group">
                                <select name="attributeType" id="attributeType" class="form-control" required>
                                    <option value="0">Select Type</option>
                                    <option value="1">Size</option>
                                    <option value="2">Color</option>
                                    <option value="3">Theme</option>
                                </select>
                            </div>
                            @error('attributeType')
                                <div class="alert alert-danger">{{ $message }}</div>
                            @enderror

                            {{-- Attribute Value --}}
                            <div class="form-group">
                                <label for="">Attribute Value</label>
                                <input type="text" class="form-control" name="attributeValue" id="attributeValue" value="{{ old('attributeValue') }}" placeholder="XS,Red" required>
                                <input type="hidden" class="" name="attributeValue" id="attributeValueColor" value="{{ old('attributeValue') }}" placeholder="XS,Red" required>
                            </div>
                            
                            @error('attributeValue')
                                <div class="alert alert-danger">{{ $message }}</div>
                            @enderror

                            {{-- Attribute Label --}}
                            <div class="form-group">
                                <label for="exampleInputPassword1">Label</label>
                                <input type="text" class="form-control" name="attributeLabel" id="attributeLabel" value="{{ old('attributeLabel') }}" placeholder="Name of attribute" required>
                            </div>
                            @error('attributeLabel')
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


            document.addEventListener('change', event=>{
                let element = event.target;
                
                if(element.id == "attributeType"){
                    if(element.value == "2"){
                        document.getElementById("attributeValue").type = "hidden";
                        document.getElementById("attributeValueColor").type = "color";
                    }

                    else{
                        document.getElementById("attributeValue").type = "text";
                        document.getElementById("attributeValueColor").type = "hidden";
                    }
                }
            });
        }
    </script>
@endsection