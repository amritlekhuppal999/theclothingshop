@extends('layouts.dashboard')

@section('content-css')
@endsection

@section('content')
    

    <!-- Main content -->
    <section class="content">
        {{-- Margin Div --}}
        <div class="row">
            <div class="col-md-12 mb-3"></div>
        </div>
        
        <div class="error-page">
            <h2 class="headline text-warning"> 404 </h2>
            {{-- <span class="text-warning"> Page Not Found </span> --}}

            
            <div class="error-content">
                <h3><i class="fas fa-exclamation-triangle text-warning"></i> Page not found.</h3>

                <p>
                    @if( isset($error_message) )
                        {{ $error_message }}
                    @else 
                        We could not find the page you were looking for. Meanwhile, you may <a href="/admin/dashboard">return to dashboard</a>.
                    @endif
                </p>

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
        
    </section>
@endsection


@section('content-scripts')
@endsection

