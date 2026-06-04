<?php

namespace App\Http\Controllers\superadmin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class SuperAdminDashboardController extends Controller
{
    public function SuperAdminDashboardPage()
    {
        return view('superadmin.dashboard.index');
    }
}
