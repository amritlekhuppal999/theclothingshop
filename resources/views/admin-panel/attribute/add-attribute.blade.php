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
            
            @if($form_type == "add-attribute")
                
                {{-- Add Attribute FORM --}}
                <div class="col-md-6">
                    <div class="card card-purple">
                        <div class="card-header">
                            <h3 class="card-title">Add Attribute</h3>
                        </div>
                        
                        <form action="{{ route('add-attribute') }}" method="POST" role="form">
                            @csrf

                            <div class="card-body">
                                
                                {{-- Attribute Name --}}
                                <div class="form-group">
                                    <label for="">Attribute Name</label>
                                    <input 
                                        type="text" 
                                        class="form-control" 
                                        name="attributeName" 
                                        id="attributeName" 
                                        value="{{ old('attributeName') }}" 
                                        placeholder="Size, Color" 
                                        required
                                    />
                                </div>
                                
                                @error('attributeName')
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
                            </div>
                            <!-- /.card-body -->

                            <div class="card-footer">
                                <button type="submit" class="btn bg-purple">Add Attribute</button>
                            </div>
                        </form>
                    </div>
                </div>

            @elseif($form_type == "add-attribute-value")
                
                {{-- ATTRIBUTE VALUE FORM --}}
                <div class="col-md-6">
                    <div class="card card-purple">
                        <div class="card-header">
                            <h3 class="card-title">Add Attribute</h3>
                        </div>
                        
                        <form action="{{ route('add-attribute-value') }}" method="POST" role="form">
                            @csrf

                            <div class="card-body">

                                {{-- Type --}}
                                <div class="form-group">
                                    <select name="attribute_id" id="attribute_id" class="form-control" required>
                                        <option value="">Select Type</option>
                                        @foreach($attribute_list as $obj)
                                            <option value="{{$obj->id}}">{{$obj->name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                                @error('attribute_id')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                @enderror

                                {{-- Attribute Value --}}
                                <div class="form-group">
                                    <label>Attribute Value</label>
                                    <input 
                                        type="text" 
                                        class="form-control" 
                                        name="attributeValue" 
                                        id="attributeValue" 
                                        value="{{ old('attributeValue') }}" 
                                        placeholder="XS,Red" required
                                    />
                                    {{-- <input type="hidden" class="" name="attributeValue" id="attributeValueColor" value="{{ old('attributeValue') }}" placeholder="XS,Red" required> --}}
                                </div>
                                
                                @error('attributeValue')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                @enderror

                                {{-- Attribute Label --}}
                                <div class="form-group">
                                    <label>Label</label>
                                    <input 
                                        type="text" 
                                        class="form-control" 
                                        name="attributeLabel" 
                                        id="attributeLabel" 
                                        value="{{ old('attributeLabel') }}" 
                                        placeholder="Name of attribute" 
                                        required
                                    />
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
                                <button type="submit" class="btn bg-purple">Add Attribute Value</button>
                            </div>
                        </form>
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


            // Does Nothing for now
            document.addEventListener('change', event=>{
                return false;
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