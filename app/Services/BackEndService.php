<?php

namespace App\Services;

use App\Models\Company;
use App\Models\FeFramework;
use App\Models\Framework;
use App\Models\Plang;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\DB;

class BackEndService
{
    public function getAllStackInfo(): array
    {
        $allCompanies =  Company::get();
        $allPlangs = Plang::get();
        $allFrameworks = Framework::get();
        return compact('allCompanies', 'allPlangs', 'allFrameworks');
    }

    public function store($request): RedirectResponse
    {
        $request->validate([
            'frameworks' => 'array|nullable',
            'plangs' => 'required|array',
            'company' => 'required|integer',
        ]);

        return $this->saveBackendStack($request);
    }

    private function saveBackendStack($request)
    {
        try {
            $company = Company::findOrFail($request->company);

            DB::transaction(function () use ($company, $request) {
                //update fameworks--do not remove previous framewoks and don't create duplicates
                $company->plangs()->syncWithPivotValues($request->plangs, ['is_draft' => 0, 'is_published' => 1], false);
                $company->frameworks()->syncWithPivotValues($request->frameworks,  ['is_draft' => 0, 'is_published' => 1], false);
            });

            return redirect()->back()->with('msg', 'Data was saved successfully');
        } catch (\Exception $e) {

            return redirect()->back()->withErrors(['errors' => $e->getMessage()]);
        }
    }
}
