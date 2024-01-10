<?php

namespace App\Http\Controllers;

use App\Models\Company;
use Illuminate\Http\Request;
use App\Services\CompanyService;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Redirect;
use App\Http\Requests\StoreCompanyDataRequest;

class CompanyController extends Controller
{

    protected $companyService;


    public function __construct(CompanyService $companyService)
    {
        $this->companyService = $companyService;
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


    public function store(StoreCompanyDataRequest $request, Company $company): RedirectResponse
    {
        $this->companyService->storeCompanyData($request, $company);

        return to_route('admin.company.index');
    }

    public function show(int $id): View
    {

        $company = $this->companyService->showCompany($id);
        // dd( $company);

        return view('admin.company.show', ['company' => $company]);
    }
}
