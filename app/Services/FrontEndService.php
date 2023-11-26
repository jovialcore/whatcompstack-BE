<?php

namespace App\Services;

use App\Models\Company;
use App\Models\FeFramework;
use App\Models\Framework;
use App\Models\Plang;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\DB;

class FrontEndService
{


    public function getAllStackInfo(): array
    {

        $allCompanies =  Company::get();
        $allFeFrameworks = FeFramework::get();
        return compact('allCompanies', 'allFeFrameworks');
    }

    public function store($request): RedirectResponse
    {
        $request->validate([
            'frameworks' => 'required|array',
            'company' => 'required|integer',
        ]);

        return $this->saveFrontendStack($request);
    }


    private function saveFrontendStack($request)
    {
        try {
            $company = Company::findOrFail($request->company);
            $company->feFrameworks()->attach($request->frameworks,  ['is_draft' => 0, 'is_published' => 1]);
            return redirect()->back()->with('msg', 'Data was saved successfully');
        } catch (\Exception $e) {

            return redirect()->back()->withErrors(['errors' => $e->getMessage()]);
        }
    }
}
