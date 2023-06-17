<?php

namespace App\Http\Controllers;

use Goutte\Client;
use Illuminate\Http\Request;

use App\Helpers\Backend;

use DonatelloZa\RakePlus\RakePlus;

class ScraperController extends Controller
{
    public function fetch()
    {
        $client = new Client();

        $website = $client->request('GET', 'https://www.myjobmag.com/job/75131/junior-software-engineer-backend-paystack');


        // return $website->html();

        $text = "";

        $website->filter('p + ul')->eq(1)->each(function ($node)  use (&$text) {
            // dump($node->text() );

            $text = $node->text() . "<br/>";
        });
        echo $text;
    }
}
