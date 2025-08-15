
    @php
        $view = $attributes->get('view');
    @endphp

    @if($view == "normal")
        
        <a href="/" class="navbar-brand" style="">
            <!-- src="../../dist/img/AdminLTELogo.png" -->
            <!-- https://www.thesouledstore.com/static/img/newlogosticky.f7f01f0.png -->
            {{-- <img 
                src="{{asset('dist/img/AdminLTELogo.png')}}" 
                alt="AdminLTE Logo" 
                class="brand-image img-circle elevation-3"
                style="opacity: .8; width:5vh"
            /> --}}

            @if(env("APP_ENV") == "local")
                <span class="brand-text font-weight-heavy text-purple border-bottom border-danger">{{config('app.name')}}</span>
            @elseif(env("APP_ENV") == "production") 
                <span class="brand-text font-weight-heavy text-purple">{{config('app.name')}}</span>
            @endif
        </a>
        


    @elseif($view == "mobile")
        
        <a href="#" class="sidebar-logo">
            <div class="logo-icon"></div>
            {{-- TheClothingShop --}}
            @if(env("APP_ENV") == "local")
                <span class="brand-text font-weight-light text-danger">{{config('app.name')}}</span>
            @elseif(env("APP_ENV") == "production") 
                <span class="brand-text font-weight-light text-success">{{config('app.name')}}</span>
            @endif
        </a>

    @endif