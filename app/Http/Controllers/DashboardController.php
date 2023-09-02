<?php

namespace App\Http\Controllers;

use App\Services\DashboardService;
use Illuminate\Http\Request;

class DashboardController extends Controller
{

    protected  $dashboardService;
    public function __construct()
    {
        $this->dashboardService =   new DashboardService;
    }


    public function index()
    {
        $this->dashboardService->getAppStats();

        return view('admin.dashboard');
    }
}
