<?php

namespace App\Helpers;


class Backend
{
    public static function getBeStack($type)
    {
        $p = [
            'g' => require_once(resource_path('StackArray/backendstacks.php')),
            'b' => require_once(resource_path('StackArray/backendstacks.php')),
        ];
        return $p[$type];
    }
}
