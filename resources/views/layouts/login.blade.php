<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <!-- headers -->
        <x-front.page-header />
        
    </head>
    
    <body class="hold-transition login-page">
        <!-- <h1>Welcome to the {{config('app.name')}}</h1> -->

        <div class="login-box">
            <div class="login-logo">
                
                @if(Request::is('admin/*'))
                    <small class="text-danger">AdminLogin</small>
                @endif
                <a href="/" class="text-purple"> 
                    <b> {{config('app.name')}} </b> 
                </a>
            </div>
            
            <div class="card ">
                <div class="card-body login-card-body">
                    <p class="login-box-msg" id="login-box-msg">
                        {{-- @if ($errors->any())
                            @error('error')
                                <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        @else
                        @endif --}}
                            Manage your store
                    </p>

                    <!-- Login Form -->
                    <form action="{{ Request::is('admin/*') ? route('login-admin') : route('login-user') }}" method="POST">
                        @csrf 
                        <!-- Email -->
                        <div class="input-group mb-3">
                            <input type="email" name="email" class="form-control" value="{{ old('email') }}" placeholder="Email" required>
                            <div class="input-group-append">
                                <div class="input-group-text">
                                    <span class="fas fa-envelope"></span>
                                </div>
                            </div>
                        </div>
                        @error('email')
                                <div class="alert alert-danger">{{ $message }}</div>
                        @enderror

                        <!-- password -->
                        <div class="input-group mb-3">
                            <input type="password" name="password" class="form-control" placeholder="Password" required>
                            <div class="input-group-append">
                                <div class="input-group-text">
                                    <span class="fas fa-lock"></span>
                                </div>
                            </div>
                        </div>
                        @error('password')
                                <div class="alert alert-danger">{{ $message }}</div>
                        @enderror

                        <div class="row">
                            <!-- Remember Me -->
                            <div class="col-8">
                                <div class="icheck-primary">
                                    <input type="checkbox" name="remember_me" id="remember" />
                                    <label for="remember">
                                        Remember Me
                                    </label>
                                </div>
                            </div>
                            
                            <!-- Sign In BTN -->
                            <div class="col-4">
                                <button type="submit" id="login-btn" class="btn btn-secondary btn-block">Sign In</button>
                            </div>
                        </div>
                    </form>

                    {{-- 
                        <!-- social-auth-links -->
                        <div class="social-auth-links text-center mb-3">
                            <p>- OR -</p>
                            <a href="#" class="btn btn-block btn-primary">
                                <i class="fab fa-facebook mr-2"></i> Sign in using Facebook
                            </a>

                            <a href="#" class="btn btn-block btn-danger">
                                <i class="fab fa-google-plus mr-2"></i> Sign in using Google+
                            </a>
                        </div>
                    --}}
                    

                    <!-- Forggot password -->
                    <p class="mb-1">
                        <a href="/forgot-password" class="text-muted">I forgot my password</a>
                    </p>
                    <!-- New Member -->
                    <p class="mb-0">
                        <a href="{{ Request::is('admin/*') ? route('admin-register') : route('resgister') }}" class="text-center text-muted">Register a new membership</a>
                    </p>
                </div>
            </div>

            {{-- ERRORS --}}
            @if ($errors->any())
                @error('error')
                    <div class="alert alert-danger">{{ $message }}</div>
                @enderror

                @error('exception_msg')
                    <div class="alert alert-danger">{{ $message }}</div>
                @enderror
            @endif

        </div>


        <!-- ADMIN LTE JS -->
        <x-front.adminlte-scripts />

        <!-- login js file -->
        <!-- <script scr="{{ asset('js/login.js') }}"></script> -->
        <script>

            

        </script>
    
    </body>
</html>
