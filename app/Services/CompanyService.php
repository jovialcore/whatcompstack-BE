<?php

namespace App\Services;

use App\Models\Company;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\DB;

class CompanyService
{

    public function getAllCompanies(): array
    {
        $companies = Company::all();

        return compact('companies');
    }
}
