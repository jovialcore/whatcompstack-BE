<?php

namespace App\Helpers;


class Backend
{
    public static function getBeStack($type)
    {
        $p = [
            'allstacks' => require(resource_path('StackArray/backendstacks.php')),
            'p_lang' => require(resource_path('StackArray/programming_lang.php')),
            'be_format_for_db' => require(resource_path('StackArray/beformatfordb.php')),
        ];
        return $p[$type];
    }
}
