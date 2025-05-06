<?php

use App\Http\Controllers\Admin\AdminRegisterController;
use App\Http\Controllers\Admin\AdminLoginController;


// Admin Authentication Routes
    Route::prefix('admin')->group(function () {
        Route::get('/login', [AdminLoginController::class, 'LOGIN_PAGE'])->name('admin-login');
        Route::post('/login', [AdminLoginController::class, 'authenticateAdmin'])->name('login-admin');
        
        // Route::get('/register', [AdminRegisterController::class, 'REGISTER_PAGE'])->name('admin-register');

        Route::get('/forgot-password', function () {
            return view(FRONT_END.'/layouts/forgot-password');
        });

        Route::get('/logout', [AdminLoginController::class, 'AdminLogout']);
    });

// Admin Authentication Routes END


