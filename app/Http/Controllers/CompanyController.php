<?php

namespace App\Http\Controllers;

use App\Models\Company;
use App\Services\CompanyService;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class CompanyController extends Controller
{

    protected $companyService;


    public function __construct()
    {
        $this->companyService = new CompanyService;
    }

    public function index(): View
    {

        $companies =  $this->companyService->getAllCompanies();

        return  view('admin.company.index', $companies);
    }

    public function create(): View
    {
        return  view('admin.company.addCompany');
    }


    public function store(Request $request, Company $company): RedirectResponse
    {

        $this->companyService->storeCompanyData($request, $company);


        return to_route('admin.company.index');
    }
}
