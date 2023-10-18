<?php

namespace App\Traits;


use App\Helpers\StackDetails;

trait SourceTrait
{

    public  function getStackHelper($stack)
    {

        $stackHelperArr = [
            'backend' => StackDetails::backend($stack),
            'frontend' => StackDetails::frontend($stack)
        ];

        return $stackHelperArr[$stack];
    }
}
