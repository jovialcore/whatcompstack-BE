<?php

namespace App\Services;

use App\Models\Company;

class DataControlService
{


    public function confirmResult($request, $company): bool
    {
        $company  = Company::where('name', $company)->first();
        foreach ($company->frameworks as $framework) {
            $update = $company->frameworks()->updateExistingPivot($framework->id, ['rating' => $framework->pivot->draft_rating, 'draft_rating' => 0, 'is_draft' => 0, 'is_published' => 1]);
        }

        return $update ?? false;
    }
}
