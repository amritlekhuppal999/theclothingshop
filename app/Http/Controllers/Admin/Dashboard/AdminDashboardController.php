<?php

namespace App\Http\Controllers\Admin\Dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;

class AdminDashboardController extends Controller
{
    //To return dashboard page view
    public function showDashboard()
    {
        return view('admin-panel/admin-dashboard');
    }
}
