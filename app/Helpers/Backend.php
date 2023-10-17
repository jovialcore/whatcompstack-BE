<?php

namespace App\Helpers;


class Backend
{
    public static function getStack($type)
    {
        $stackDetails = [
            'allstacks' => require(resource_path('StackArray/backendstacks.php')),
            'p_lang' => require(resource_path('StackArray/programming_lang.php')),
            'format_for_db' => require(resource_path('StackArray/beformatfordb.php')),
            'requirement_keywords' => require(resource_path('StackArray/keyword_req.php'))
        ];
        return $stackDetails[$type];
    }
}
