<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Company;
use Illuminate\Http\Request;

class CompanyStackController extends Controller
{
    public function show($id)
    {

        $company = new Company();

        $companyStack = $company->first($id);

        return response()->json(['company_details' =>  $companyStack]);
    }
}
