<?php

use App\Http\Controllers\Admin\Dashboard\AdminDashboardController;

Route::prefix('admin')->group(function () {
    Route::get('/dashboard', [AdminDashboardController::class, 'showDashboard'])->name('dashboard');
});