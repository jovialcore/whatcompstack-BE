<?php

namespace App\Services\Api;

use App\Models\Company;
use CloudinaryLabs\CloudinaryLaravel\Facades\Cloudinary;
use Illuminate\Support\Facades\DB;

class CompanyService
{
    public function addCompany($data)
    {
        // Add company to the database
        if (isset($data['logo'])) {
            $data['logo'] = Cloudinary::upload(
                $data['logo']->getRealPath(),
                [
                    'folder' => 'wcsLogos',
                    'public_id' => $data['name'],
                ]
            )->getSecurePath();
        };

        $company = Company::create($data);

        // if FE frameworks are provided, add them to the company
        if (isset($data['fe_frameworks'])) {
            $company->feFrameworks()->syncWithPivotValues($data['fe_frameworks'],  ['is_draft' => 0, 'is_published' => 0], false);
        }

        // if BE frameworks are provided, add them to the company
        if (isset($data['be_frameworks'])) {
            DB::transaction(function () use ($company, $data) {
                //update fameworks--do not remove previous framewoks and don't create duplicates
                $company->plangs()->syncWithPivotValues($data['be_plangs'], ['is_draft' => 0, 'is_published' => 0], false);
                $company->frameworks()->syncWithPivotValues($data['be_frameworks'],  ['is_draft' => 0, 'is_published' => 0], false);
            });
        }

        // if mobile frameworks are provided, add them to the company
        if (isset($data['mobile_frameworks'])) {
            DB::transaction(function () use ($company, $data) {

                if (isset($data['mobileOnly'])) {
                    $company->is_mobile_only = $data['mobileOnly'] === 'true' ? 1 : 0;
                    $company->save();
                }

                //update fameworks--do not remove previous framewoks and don't create duplicates
                $company->mobilePlangs()->syncWithPivotValues($data['mobile_frameworks'],  ['is_draft' => 0, 'is_published' => 0], false);
            });
        }

        return $company;
    }
}
