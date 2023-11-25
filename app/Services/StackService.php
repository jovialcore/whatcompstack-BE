<?php

namespace App\Services;

use App\Models\Company;
use App\Models\Framework;
use App\Models\Plang;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\DB;

class StackService
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

            'frameworks' => 'required|array',
            'plangs' => 'required|array',
            'company' => 'required|string'
        ]);


        try {
            $company = Company::findOrFail($request->company);

            DB::transaction(function () use ($company, $request) {
                $company->plangs()->sync($request->plangs);
                $company->frameworks()->sync($request->framorks);
            });

            return redirect()->back()->with('success', 'Data was saved successfully');
        } catch (\Exception $e) {

            return redirect()->back()->withErrors(['errors' => $e->getMessage()]);
        }
    }
}
