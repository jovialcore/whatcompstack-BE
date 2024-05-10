<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\CompanyResource;
use App\Models\Company;
use App\Services\Api\CompanyService;

use App\Services\SearchService;
use Illuminate\Http\Request;

class CompanyStackController extends Controller
{
    private $service;
    public function __construct()
    {
        $this->service = new CompanyService();
    }

    public function index(Request $req, Company $company)
    {

        $companies = $company::FetchAllClientDetails();

        //if laravel had an "orWithWhereHAs" ðŸ™‚

        if ($companies->exists() > 0) {

            $companies = $companies->paginate(21);

            return CompanyResource::collection($companies);
        } else {
            return response()->json(['message' => 'No  Results found'], 200);
        }
    }

    public function store(Request $request)
    {
        try {
            $request->validate([
                'logo' => 'required|image',
                'about' => 'required|string',
                'linkedin_url' => 'required|url|unique:companies,linkedin_url',
                'url' => 'required|url|unique:companies,url',
                'name' => 'required|string',
                'fe_frameworks' => 'array|required_without_all:be_frameworks,mobile_frameworks',
                'be_frameworks' => 'array|required_without_all:fe_frameworks,mobile_frameworks',
                'be_plangs' => 'array|present_with:be_frameworks',
                'mobile_frameworks' => 'array|required_without_all:fe_frameworks,be_frameworks',
            ]);

            $company = $this->service->addCompany($request->all());

            return response()->json([
                'message' => 'Company added successfully',
                'data' => $company
            ], 201);
        } catch (\Exception $e) {
            return response()->json(['message' => $e->getMessage()], 400);
        }
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
