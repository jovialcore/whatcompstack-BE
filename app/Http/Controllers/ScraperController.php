<?php

namespace App\Http\Controllers;

use Goutte\Client;
use Illuminate\Http\Request;
use Illuminate\Support\Benchmark;

use App\Helpers\Backend;

class ScraperController extends Controller
{
    public function fetch()
    {
        $client = new Client();

        $website = $client->request('GET', 'https://www.businesslist.com.ng/category/interior-design/city:lagos');


        Benchmark::dd(function () {
            $backendItems = Backend::getBeStack();
            foreach ( $backendItems  as $key => $value) {
                if($value == 'PHP') {
                    return 'php';
                }
            }
            // if (in_array('Nodejs',  $backendItems)) {
            //     return 'python';
            // }
        });
        // return  $backendItems;
    }
}
