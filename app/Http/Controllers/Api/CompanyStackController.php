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
        $companies  = $company::FetchAllFeDetails()->paginate(10);


        //if larvel had a "orWithWhereHAs" 🙂


        if ($companies->count() > 0) {

            return CompanyResource::collection($companies);
        } else {

            return response()->json(['message' => 'No  Results found'], 200);
        }
    }

    // retrieving details about a particular stack 
    public function show($id)
    {
        $company = new Company();

        $companyStack = $company->FetchAllFeDetails()->find($id);

        if ($companyStack) {

            return new CompanyResource($companyStack);
        } else {

            return response()->json(['message' => 'No  details for this company yet'], 200);
        }
    }
}
