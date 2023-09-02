<?php

namespace App\Http\Controllers;

use App\Models\Company;
use App\Models\DataSource;
use App\Models\Stack;
use App\Services\DashboardService;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;

class DashboardController extends Controller
{

    protected  $dashboardService;
    public function __construct()
    {
        $this->dashboardService =   new DashboardService;
    }


    public function index(): View
    {
        $data = $this->dashboardService->getAppStats();

        return view('admin.dashboard', $data);
    }
}
