<?php

namespace App\Services;

use App\Helpers\Backend;
use App\Models\Company;
use App\Models\DataSource;
use App\Models\Framework;
use App\Models\Plang;
use App\Models\Stack;
use App\Traits\SourceTrait;
use App\Services\Scraper\Scraper;

class DataControlService
{

    use SourceTrait;

    // I return mostly arrays, bool, in the service class, anyother thing will be returned except mentioned will be in controller 

    public function index(): array
    {
        $companies = Company::get(['id', 'name']);
        $stacks = Stack::all();
        $dataSources = DataSource::all();

        return  compact('companies', 'stacks', 'dataSources');
    }

    public function initiateDataSourcing($request)
    {

      
        $source_slug = Company::where('name', $request->input('company'))->first()->source_slug;    
     
        $scraper = new Scraper(
            company: $request->input('company'),
            sourceSlug: $source_slug,
            dataSource: $request->input('data_source'),
            stack: $request->input('stack'),
            stackOptions: $this->getStackHelper('backend')
        );
        return $scraper->dataSource();
    }

    public function confirmResult($company): bool
    {
        $plang = $this->confirmResultForPlang($company);
        $framework =  $this->confirmResultForFramework($company);

        if ($plang && $framework) {
            return true;
        } else {
            return false; // something strange happened ---should be abe to reverse transaction 👀 ??
        }
    }

    private function confirmResultForFramework($company): bool
    {
        $company  = Company::where('name', $company)->with('frameworks')->first();

        foreach ($company->frameworks as $framework) {
            $updateForFramework = $company->frameworks()->updateExistingPivot($framework->id, ['rating' => $framework->pivot->draft_rating + $framework->pivot->rating, 'draft_rating' => 0, 'is_draft' => 0, 'is_published' => 1]);
        }

        return $updateForFramework ?? false;
    }

    private function confirmResultForPlang($company): bool
    {
        $company  = Company::where('name', $company)->with('plangs')->first();
        foreach ($company->plangs as $plang) {

            $updateForPlang = $company->plangs()->updateExistingPivot($plang->id, ['rating' => $plang->pivot->draft_rating + $plang->pivot->rating, 'draft_rating' => 0, 'is_draft' => 0, 'is_published' => 1]);
        }
        // suprisingly, this saving approach can track if a record has been updted before--even if you run this function before,it has an update it will return 0 ( reason being that it has been updated before)---nicee 

        return  $updateForPlang ?? false;
    }
}
