<?php

declare(strict_types=1);

namespace App\Services;

use App\Models\Company;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Traits\companyPreviewTrait;
use Illuminate\Contracts\View\View;
use Cloudinary\Api\Upload\UploadApi;
use Illuminate\Support\Facades\Storage;
use Symfony\Component\Console\Input\Input;
use App\Http\Requests\StoreCompanyDataRequest;
use Illuminate\Validation\ValidationException;
use CloudinaryLabs\CloudinaryLaravel\Facades\Cloudinary;

class CompanyService
{
    use companyPreviewTrait;

    public function getAllCompanies(): array
    {
        $companies = Company::all();

        return compact('companies');
    }

    public function storeCompanyData(Request $request)
    {
        $validated = $request->validated();

        try {
            if ($request->has('logo')) {
                $logoUrl = Cloudinary::upload(
                    $request->file('logo')->getRealPath(),
                    [
                        'folder' => 'wcsLogos',
                        'public_id' => $request->name,
                    ]
                )->getSecurePath();

                $validated['logo'] = $logoUrl;
            }
            Company::create($validated);

            return true;
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
