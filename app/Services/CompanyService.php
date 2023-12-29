<?php

declare(strict_types=1);

namespace App\Services;

use App\Models\Company;
use App\Traits\companyPreviewTrait;
use Cloudinary\Api\Upload\UploadApi;
use CloudinaryLabs\CloudinaryLaravel\Facades\Cloudinary;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\ValidationException;

class CompanyService
{
    use companyPreviewTrait;

    public function getAllCompanies(): array
    {
        $companies = Company::paginate(15);

        return compact('companies');
    }

    public function storeCompanyData(Request $request, Company $company)
    {
        $request->validate([
            'name' => 'required',
            'about' => 'required',
            'url' => 'url|unique:companies,url',
            'ceo_name' => 'string|nullable',
            'cto_contact' => 'url|nullable',
            'cto_name' => 'string|nullable',
            'hr_name' => 'string|nullable',
            'hr_contact' => 'url |nullable',
            'logo' => 'required|mimes:png,jpeg,svg',
            'source_slug' => 'nullable|string|unique:companies,source_slug'
        ]);

        try {
            $companyData = $request->all();
            if ($request->has('logo')) {
                $logoUrl = Cloudinary::upload(
                    $request->file('logo')->getRealPath(),
                    [
                        'folder' => 'wcsLogos',
                        'public_id' => $request->name,
                    ]
                )->getSecurePath();
                $companyData = $request->except('logo');
                $companyData['logo'] = $logoUrl;
            }
            return Company::create($companyData);
        } catch (\Exception $e) {

            return $e->getMessage(); // ??
        }
    }

    public function showCompany(int $id): Company
    {
        $company = $this->companyWithTechData()->find($id);
        return $company;
    }
}
