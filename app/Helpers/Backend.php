<?php

namespace App\Helpers;


class Backend
{
    public static function getBeStack()
    {
        // return the path 
        return require_once(resource_path('StackArray/backendstacks.php'));
    }
}
