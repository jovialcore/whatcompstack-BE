<?php

namespace App\Http\Controllers;

use Goutte\Client;
use Illuminate\Http\Request;

class ScraperController extends Controller
{
    public function fetch() {
        $client = new Client();

        $website = $client->request('GET', 'https://www.businesslist.com.ng/category/interior-design/city:lagos');
        

        return $website->html();
    }
}
