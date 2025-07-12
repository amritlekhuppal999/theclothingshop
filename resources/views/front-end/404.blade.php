@extends('layouts.pages') 

@section('content-css')
    <link rel="stylesheet" href="{{ asset('css/front-end/category.css') }}">
@endsection

@section('content')
    
    <style>
        .billing-side{
            width:80%; 
            margin-left: 44px;
        }
    </style>

    <div class="content"> 
        <div class="container">
            <!-- <p>Page Content..</p> -->

            
            <div class="row">
                <div class="col-md-12 mb-3"></div>
            </div>
            
            <div class="error-page">
                <h2 class="headline text-warning"> 404 </h2>
                {{-- <span class="text-warning"> Page Not Found </span> --}}

                
                <div class="error-content">
                    @if(isset($message))
                        <h3 class="text-danger">
                            <i class="fas fa-exclamation-triangle text-warning"></i> 
                            {{ $message }} 
                        </h3>
                        <a href="/home">return home</a>
                    @else
                        
                        <h3><i class="fas fa-exclamation-triangle text-warning"></i> Page not found.</h3>

                        <p>
                            We could not find the page you were looking for. Meanwhile, you may <a href="/home">return home</a>.
                        </p>
                    @endif


                    {{-- <form class="search-form">
                        <div class="input-group">
                        <input type="text" name="search" class="form-control" placeholder="Search">

                        <div class="input-group-append">
                            <button type="submit" name="submit" class="btn btn-warning"><i class="fas fa-search"></i>
                            </button>
                        </div>
                        </div>
                    </form> --}}

                </div>

                <div>
                    <img 
                        src="{{ asset("images/where-template.png") }}" 
                        alt=""
                        style="width:100%"
                    />
                </div>
            </div>

        </div>
    </div>
@endsection




@section('content-scripts')
    
@endsection