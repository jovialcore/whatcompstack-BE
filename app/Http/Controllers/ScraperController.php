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

        $website = $client->request('GET', 'https://www.myjobmag.com/job/141539/backend-developer-cowrywise');

        $text = "";

        $website->filter('p + ul')->eq(1)->each(function ($node)  use (&$text) {

            $text = $node->text() . "<br/>";
        });

        $keywords = RakePlus::create($text, ['en_US'], 4);

        //check if the kewords are in

        $result = [];

        foreach ($keywords  as $keyword) {
            in_array($keyword, Backend::getBeStack());
            $result[] = $keyword;

        }

        dump($keywords);
        echo $text;
    }
}
