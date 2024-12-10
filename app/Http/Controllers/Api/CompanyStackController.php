<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\CompanyResource;
use App\Models\Company;

use App\Services\CompanyService;
use Illuminate\Http\Request;

class CompanyStackController extends Controller
{
    protected $companyService;
    public function __construct(CompanyService $companyService)
    {
        $this->companyService = $companyService;
    }
    public function index(Request $req, Company $company)
    {
        $searchTerm = $req->query('term');
        $companies = $this->companyService->getCompanies($company, $searchTerm);
        if ($companies->exists() === 0) {
            return response()->json(['message' => 'No  Results found'], 404);
        }
        $companies = $companies->paginate(21);
        return CompanyResource::collection($companies);
    }

    public function show($source_slug)
    {
        $company = new Company();

    
        $companyStack = $company->FetchAllClientDetails()->whereName($source_slug)->first();

        if ($companyStack) {
            return new CompanyResource($companyStack);
        } else {

            return response()->json(['message' => 'No  details for this company yet'], 200);
        }
    }
}
