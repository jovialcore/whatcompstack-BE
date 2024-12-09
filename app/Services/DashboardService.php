<?php

namespace App\Services;

use App\Models\Company;
use App\Models\Framework;
use App\Models\Plang;


class DashboardService
{

    // this is a utility method,it does some calculation, search or some functionanl stuff
    public function getAppStats(): array
    {
        $noOfCompanies = Company::all()->count();

        $noOfPlangs  = Plang::all()->count();

        $noOfFrameworks = Framework::all()->count();

        return compact('noOfCompanies', 'noOfPlangs', 'noOfFrameworks');
    }
}
