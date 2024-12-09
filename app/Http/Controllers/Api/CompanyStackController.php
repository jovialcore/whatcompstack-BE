<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\CompanyResource;
use App\Models\Company;

use App\Services\SearchService;
use Illuminate\Http\Request;

class CompanyStackController extends Controller
{

    public function index(Request $req, Company $company)
    {

        $companies = $company::FetchAllClientDetails();

        //if laravel had an "orWithWhereHAs" 🙂

        if ($companies->exists() > 0) {

            $companies = $companies->paginate(21);

            return CompanyResource::collection($companies);
        } else {
            return response()->json(['message' => 'No  Results found'], 200);
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
