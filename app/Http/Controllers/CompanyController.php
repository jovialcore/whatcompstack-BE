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
     
        return  view('admin.company.index', 'companies');
    }

    public function create(): View
    {

        return  view('admin.company.addCompany');
    }


    public function store(Request $request, Company $company): RedirectResponse
    {

        $request->validate([
            'name' => 'required',
            'about' => 'required',
            'url' => 'url',
            'ceo_name' => 'string|nullable',
            'cto_contact' => 'url|nullable',
            'cto_name' => 'string|nullable',
            'hr_name' => 'string',
            'hr_contact' => 'url |nullable',
            'logo' => 'mimes:png,jpeg',
        ]);

        $companyData = $request->all();

        if ($request->has('logo')) {
            $filePath = $request->file('logo')->storeAs('Company logos', $request->name . '.' . $request->file('logo')->extension());
            $companyData = $request->except('logo');
            $companyData['logo'] = $filePath;
        }

        Company::create($companyData);

        return to_route('admin.company.index');
    }
}
