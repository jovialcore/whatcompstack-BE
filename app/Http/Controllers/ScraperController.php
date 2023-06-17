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

        $website->filter('p + ul')->eq(1)->each(function ($node) use (&$text) {
            $text = $node->text() . "<br/>";
        });

        $keywords = RakePlus::create($text, ['en_US'], 4)->keywords();

        // Check if the keywords are in Backend::getBeStack()

        $result = [];

        // invoke this or pass to a constructor later

        $backendArr  = Backend::getBeStack();


        // loop throuh keywords
        foreach ($keywords as $keyword) {

            // convert to small case
            $keyword = strtolower($keyword);

            //check if keywords exist in $backend stacks and retrieve the matched keys
            // using the $keyword as filter, we now return keys of $backendArr that represent the perfect naming
            $matchedKeys = array_keys($backendArr, $keyword);

            // push the matching item to the array
            $result = array_merge($result, $matchedKeys);
        }

        dump($result);
    }
}
