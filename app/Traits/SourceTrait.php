<?php

namespace App\Traits;

use App\Helpers\Backend;

trait SourceTrait
{

    public  function getStackHelper($stack)
    {

        $stackHelperArr = [
            'backend' => new Backend,
            'frontend' => "frontend helper",
        ];

        return $stackHelperArr[$stack];
    }
}
