<?php

namespace App\Http\Controllers;

use App\Services\DashboardService;
use Illuminate\Contracts\View\View;


class DashboardController extends Controller
{

    protected  $dashboardService;

    public function __construct(DashboardService $dashboardService)
    {
        $this->dashboardService =   $dashboardService;
    }

    public function index(): View
    {
        $data = $this->dashboardService->getAppStats();
        return view('admin.dashboard', $data);
    }
}
