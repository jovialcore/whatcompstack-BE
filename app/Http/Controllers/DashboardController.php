<?php

namespace App\Http\Controllers;

use App\Models\Company;
use App\Models\DataSource;
use App\Models\Stack;
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

    public function dataControlPage()
    {

        $companies = Company::get(['id', 'name']);
        $stacks = Stack::all();
        $dataSources = DataSource::all();

        return view('admin.scraper', compact('companies', 'stacks', 'dataSources'));
    }
}
