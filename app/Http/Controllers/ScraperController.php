<?php

namespace App\Http\Controllers;

use Goutte\Client;
use Illuminate\Http\Request;

use App\Helpers\Backend;
use App\Models\Company;
use DonatelloZa\RakePlus\RakePlus;

class ScraperController extends Controller
{


    public function fetch(Company $company)
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



        $backendArr  =  Backend::getBeStack('allstacks');


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


        // lets assume we have the Id of the company we want to save
        $company = $company->find(1);

        // return programming single lang
        $pLangArr  =  Backend::getBeStack('p_lang');



        // return programming single lang
        $be_format_for_db = Backend::getBeStack('be_format_for_db');



        // lets format the scrapped result properly 

        $final_result = [];

        foreach ($result as $key => $scraped_result_item) {

            // find/attach the programming language
            if (in_array($scraped_result_item, $pLangArr)) {

                // get programming language
                $final_result[$scraped_result_item] = $be_format_for_db[$scraped_result_item];

                // determine the framework related to that programming language
                $framework_result = array_intersect($final_result[$scraped_result_item], $result);

                // append the detetermined framework to the programming language key
                $final_result[$scraped_result_item] =  $framework_result;
            }
        }

        $company->stack_be = $final_result;

        $is_saved = $company->save();

        if ($is_saved) {
            dd('it has been saved');
        }
        dump($result);
    }
}
