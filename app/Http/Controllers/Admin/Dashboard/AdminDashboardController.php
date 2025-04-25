<?php

namespace App\Http\Controllers\Admin\Dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;

class AdminDashboardController extends Controller
{
    private $dashboard_route = 'admin-panel/admin-dashboard';

    //To return dashboard page view
    public function INDEX()
    {
        return view($this->dashboard_route);
    }
}
