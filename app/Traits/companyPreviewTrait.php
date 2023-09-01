<?php

namespace App\Trats;

use App\Models\Company;

trait previewCompany
{


    public  function newlySourced($company)
    {
        return  Company::with(['plangs' => function ($query) {
            $query->where('is_draft', 1)->where('is_published', 0)->with('frameworks', function ($query) {
                $query->withWhereHas('companies', function ($query) {
                    // I don't now why I can't access the pivot of frameworks directly on frameworks collection exceptI use withWhereHas on Companies -- should look into it some time in future but for now, lets make do with how it is working now
                    $query->where('is_draft', 1)->where('is_published', 0);
                });
            });
        }])->where('name', $company)->first();
    }

    public  function oldSourcedData($company)
    {
        return  Company::with(['plangs' => function ($query) {
            $query->where('is_draft', 0)->where('is_published', 1)->with('frameworks', function ($query) {
                $query->withWhereHas('companies', function ($query) {
                    // I don't now why I can't access the pivot of frameworks directly on frameworks collection exceptI use withWhereHas on Companies -- should look into it some time in future but for now, lets make do with how it is working now
                    $query->where('is_draft', 0)->where('is_published', 1);
                });
            });
        }])->where('name', $company)->first();
    }
}
