<?php

use App\Http\Controllers\Admin\RegisterController;
use App\Http\Controllers\Admin\LoginController;


// Admin Authentication Routes
    Route::prefix('admin')->group(function () {
        Route::get('/login', [LoginController::class, 'showAdminLoginForm'])->name('login-admin');
        Route::post('/login', [LoginController::class, 'authenticateAdmin'])->name('login-admin');

        Route::get('/forgot-password', function () {
            return view(FRONT_END.'/layouts/forgot-password');
        });

        Route::get('/logout', [LoginController::class, 'AdminLogout']);
    });

// Admin Authentication Routes END