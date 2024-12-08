<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\CompanyResource;
use App\Models\Company;

use App\Services\SearchService;
use Illuminate\Http\Request;

class CompanyStackController extends Controller
{
    private function getCompaniesBySearchTerm($term, Company $company)
    {
        $term = strtolower($term);
        $companies = $company->FetchAllClientDetails()
            ->where(function ($query) use ($term) {
                $query->where('name', 'LIKE', "%{$term}%")
                    ->orWhereHas('plangs', function ($query) use ($term) {
                        $query->where('name', 'LIKE', "%{$term}%");
                    })
                    ->orWhereHas('frameworks', function ($query) use ($term) {
                        $query->where('name', 'LIKE', "%{$term}%");
                    })
                    ->orWhereHas('feFrameworks', function ($query) use ($term) {
                        $query->where('name', 'LIKE', "%{$term}%");
                    })
                    ->orWhereHas('mobilePlangs', function ($query) use ($term) {
                        $query->where('name', 'LIKE', "%{$term}%");
                    });
        });
        return $companies;
    }

    public function index(Request $req, Company $company)
    {
        $searchTerm = $req->query('term');
        if ($searchTerm) {
            $paginatedCompanies = $this->getCompaniesBySearchTerm($searchTerm, $company)->paginate(21);
            return CompanyResource::collection($paginatedCompanies);
        }

        $companies = $company->FetchAllClientDetails();
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
