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
                <a href="/"><b>{{config('app.name')}}</b></a>
            </div>
            
            <div class="card">
                <div class="card-body login-card-body">
                    <p class="login-box-msg" id="login-box-msg">
                        You forgot your password? Here you can easily retrieve a new password.
                    </p>

                    <!-- Forgot Password Form -->
                    <form action="#" method="post">
                        
                        <!-- Email -->
                        <div class="input-group mb-3">
                            <input type="email" class="form-control" placeholder="Email">
                            <div class="input-group-append">
                                <div class="input-group-text">
                                    <span class="fas fa-envelope"></span>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <!-- Sign In BTN -->
                            <div class="col-12">
                                <button type="submit" class="btn btn-secondary btn-block">Request new password</button>
                            </div>
                        </div>
                    </form>

                    <!-- Forggot password -->
                    <p class="mt-3 mb-1">
                        <a href="/login" class="text-muted">Login</a>
                    </p>
                    <!-- New Member -->
                    <p class="mb-0">
                        <a href="/register" class="text-center text-muted">Register a new membership</a>
                    </p>

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