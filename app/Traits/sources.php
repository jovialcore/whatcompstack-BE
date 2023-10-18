<?php

namespace App\Traits;

use App\Services\Scraper\Scraper;

class sources
{

    public  getStackSource(){
        
        new Scraper($request->input('company'), $request->input('data_source'), $request->input('stack'), new Backend);
    }
}
