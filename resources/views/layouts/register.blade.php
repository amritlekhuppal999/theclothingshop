<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <!-- headers -->
        <x-front.page-header />
        
    </head>
    
    <body class="hold-transition register-page">
        <!-- <h1>Welcome to the {{config('app.name')}}</h1> -->

        <div class="register-box">
            <div class="register-logo">
                <a href="/"><b>{{config('app.name')}}</b></a>
            </div>

            <div class="card">
                <div class="card-body register-card-body">
                    <p class="login-box-msg" id="login-box-msg">
                        
                        @if ($errors->any())
                            @error('Failed')
                                <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        @else
                            Register a new membership
                        @endif
                    </p>

                    <!-- @error('Failed')
                        <div class="alert alert-danger">{{ $message }}</div>
                    @enderror -->

                    <!-- Register Form -->
                    <form action="{{ route('register-user') }}" method="post">
                        @csrf

                        <!-- Full Name -->
                        <div class="input-group mb-3">
                            <input type="text" name="fullName" class="form-control" placeholder="Full name" value="{{ old('fullName') }}" required>
                            <div class="input-group-append">
                                <div class="input-group-text">
                                    <span class="fas fa-user"></span>
                                </div>
                            </div>
                        </div>
                        @error('fullName')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror

                        <!-- Email -->
                        <div class="input-group mb-3">
                            <input type="email" name="email" class="form-control" placeholder="Email" value="{{ old('email') }}" required>
                            <div class="input-group-append">
                                <div class="input-group-text">
                                <span class="fas fa-envelope"></span>
                                </div>
                            </div>
                        </div>
                        @error('email')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror

                        <!-- Password -->
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

                        <!-- Retype Password -->
                        <div class="input-group mb-3">
                            <input type="password" name="password_confirmation" class="form-control" placeholder="Retype password" required>
                            <div class="input-group-append">
                                <div class="input-group-text">
                                <span class="fas fa-lock"></span>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <!-- Terms & Conditions -->
                            <div class="col-8">
                                <div class="icheck-primary">
                                    <input type="checkbox" id="agreeTerms" name="terms" value="agree">
                                    <label for="agreeTerms">
                                        I agree to the <a href="#">terms</a>
                                    </label>
                                </div>
                            </div>
                            
                            <!-- Register BTNS -->
                            <div class="col-4">
                                <button type="submit" class="btn btn-secondary btn-block">Register</button>
                            </div>
                            
                        </div>
                    </form>

                    {{-- 
                        <!-- social-auth-links -->
                        <div class="social-auth-links text-center">
                            <p>- OR -</p>
                            <a href="#" class="btn btn-block btn-primary">
                            <i class="fab fa-facebook mr-2"></i>
                            Sign up using Facebook
                            </a>
                            <a href="#" class="btn btn-block btn-danger">
                            <i class="fab fa-google-plus mr-2"></i>
                            Sign up using Google+
                            </a>
                        </div>
                    --}}

                    <a href="/login" class="text-center text-muted">I already have a membership</a>
                </div>
            </div>
        </div>


        <!-- ADMIN LTE JS -->
        <x-front.adminlte-scripts />
    
    </body>
</html>


<?php 
    /*
     * 
     * {{-- <x-component /> --}}
     * @include('component')
     * 
     * these two do the same thing so don't get confused
     */
?>