<?php

namespace App\Services;

use App\Models\Company;
use App\Models\Mobile;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\DB;

class MobileService
{

    const mobileOrBeOnlyStack = 1;
    const notMobileOrBeOnlyStack = 0;


    public function getAllStackInfo(): array
    {
        $allCompanies =  Company::get();
        $allFeFrameworks = Mobile::get();
        return compact('allCompanies', 'allFeFrameworks');
    }

    public function store($request): RedirectResponse
    {
        $request->validate([
            'frameworks' => 'array|nullable',
            'company' => 'required|integer',
            'mobileOnly' => 'required'
        ]);

        return $this->saveMobileStack($request);
    }

    private function saveMobileStack($request)
    {
        try {
            $company = Company::findOrFail($request->company);
            DB::transaction(function () use ($company, $request) {

                if ($request->onlyMobile) {
                    $company->mobileAndBeStackOnly = self::mobileOrBeOnlyStack;
                    $company->save();
                }
                //update fameworks--do not remove previous framewoks and don't create duplicates
                $company->mobilePlangs()->syncWithPivotValues($request->frameworks,  ['is_draft' => 0, 'is_published' => 1], false);
            });

            return redirect()->back()->with('msg', 'Mobile was saved successfully');
        } catch (\Exception $e) {

            return redirect()->back()->withErrors(['errors' => $e->getMessage()]);
        }
    }
}
