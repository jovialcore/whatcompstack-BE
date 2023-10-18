<?php

declare(strict_types=1);

namespace App\Services;

use App\Models\Company;
use App\Traits\companyPreviewTrait;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

class CompanyService
{
    use companyPreviewTrait;

    public function getAllCompanies(): array
    {
        $companies = Company::all();

        return compact('companies');
    }

    public function storeCompanyData(Request $request, Company $company): Company
    {
        $request->validate([
            'name' => 'required',
            'about' => 'required',
            'url' => 'url|unique:companies,url',
            'ceo_name' => 'string|nullable',
            'cto_contact' => 'url|nullable',
            'cto_name' => 'string|nullable',
            'hr_name' => 'string',
            'hr_contact' => 'url |nullable',
            'logo' => 'mimes:png,jpeg',
        ]);

        try {
            $companyData = $request->all();

            if ($request->has('logo')) {
                $filePath = $request->file('logo')->storeAs('Company logos', $request->name . '.' . $request->file('logo')->extension());
                $companyData = $request->except('logo');
                $companyData['logo'] = $filePath;
            }
            return Company::create($companyData);
        } catch (\Exception $e) {
            return $e;
        }
    }

    public function showCompany(int $id): Company
    {
        $company = $this->companyWithTechData()->find($id);
        return $company;
    }
}
