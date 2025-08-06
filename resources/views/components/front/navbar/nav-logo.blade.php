


    <a href="/" class="navbar-brand">
        <!-- src="../../dist/img/AdminLTELogo.png" -->
        <!-- https://www.thesouledstore.com/static/img/newlogosticky.f7f01f0.png -->
        <img 
            src="{{asset('dist/img/AdminLTELogo.png')}}" 
            alt="AdminLTE Logo" 
            class="brand-image img-circle elevation-3"
            style="opacity: .8"
        />
        @if(env("APP_ENV") == "local")
            <span class="brand-text font-weight-light text-danger">{{config('app.name')}}</span>
        @elseif(env("APP_ENV") == "production") 
            <span class="brand-text font-weight-light text-success">{{config('app.name')}}</span>
        @endif
    </a>