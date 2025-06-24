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
                        @csrf

                        <div class="card-body">
                            
                            <div class="form-group">
                                <label>Category Name</label>
                                <input 
                                    type="text" 
                                    class="form-control" 
                                    name="categoryName" 
                                    id="categoryName" 
                                    placeholder="Topwear"
                                    value="{{ old('categoryName') }}"
                                    required
                                />
                            </div>
                            @error('categoryName')
                                <div class="alert alert-danger">{{ $message }}</div>
                            @enderror

                            <div class="form-group">
                                <label>Category Slug</label>
                                <input 
                                    type="text" 
                                    class="form-control" 
                                    name="categorySlug" 
                                    id="categorySlug" 
                                    placeholder="topwear"
                                    value="{{ old('categorySlug') }}"
                                    required
                                />
                            </div>
                            @error('categorySlug')
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
                            <button type="submit" class="btn bg-purple">Submit</button>
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

        document.addEventListener('keyup', event=>{
            let element = event.target;

            if(element.id == "categoryName"){
                let category_name = element.value;
                category_name = MyApp.remove_whitespace(category_name);
                document.getElementById('categorySlug').value = MyApp.generate_slug(category_name);
            }
        });

    </script>
@endsection