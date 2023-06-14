<?php

namespace App\Helpers;


class Backend
{
    public static function getBeStack()
    {
        return require_once(resource_path('StackArray/backendstacks.php'));
    }
}
