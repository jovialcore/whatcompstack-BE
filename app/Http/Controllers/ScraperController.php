<?php

namespace App\Http\Controllers;

use Goutte\Client;
use Illuminate\Http\Request;

use App\Helpers\Backend;
use App\Models\Company;
use DonatelloZa\RakePlus\RakePlus;

class ScraperController extends Controller
{

    public function homepageScrape(Company $company)
    {
        $client = new Client();
        $homepage = $client->request('GET', 'https://www.myjobmag.com/jobs-at/paystack/5');
        $keyword = "";

        // find link that match keyword to click on 
        $homepage->filter('.job-info > ul > .mag-b ')->each(function ($node) use ($client, $company, $keyword) {

            $jobTitles =   $node->text();


            // remove parentensis --just incase and any other stuff aside letters and alphabets and format to smaller letters too 
            $purgedTitles =  strtolower(preg_replace('/[^a-z]/i', ' ', $jobTitles));

            // get the particular keyword, which  in this case, it is "backend"
            $keyword = substr($purgedTitles, strpos($purgedTitles, 'backend'));

            // further extraction to return only one word i.e backend 
            $keyword = preg_replace("/\s.*/", '', ltrim($keyword));

            // click on the job description wit backend 
            if ($keyword == 'backend') {

                // find the link
                $link = $node->selectLink($jobTitles)->link();

                // click on the link
                $website = $client->click($link);


                //  👀  side note or bud:  this stuff loops two times? why ? 👀 
                $this->fetch($company, $website);
            }


            // sieve the key word 
        });
    }

    public function fetch($company, $website)
    {
        $text = "";

        // get the second link that matches the nodes specified 
        $website->filter('p > strong')->each(function ($node) use (&$text, $website) {

            $pattern = '/\b(requirements|nice to haves|requirement|Required competency and skillset to be a Waver|What Your Day to Day Activities Will Be Like:|required)\b/i';


            $r =  strtolower($node->text());

            // match the heading with title like "requirements "
            if (preg_match($pattern, $r)) {

                // get the heading with " job role  requirements  "
                $roleRequirementNode = $website->filter('p:contains("' . $node->text() . '") ')->first();

                // match node (element) with  full text (.i.e immediately after heading or the job title)
                $text  = $roleRequirementNode->nextAll('ul')->first()->text();
            }
        });
        // etract keywords
        $keywords = RakePlus::create($text, ['.js'], 4)->keywords();


        $result = [];
        // get all backend stack 
        $backendArr  =  Backend::getBeStack('allstacks');

        /** ######    This section is used to select all stacks possible  #######  */

        // loop throuh keyword extracted

        foreach ($keywords as $keyword) {

            // convert to small case
            $keyword = strtolower($keyword);

            //check if keywords exist in $backend stacks and retrieve the matched keys
            // using the $keyword as filter, we now return keys of $backendArr that represent which represent perfect name we want tosave in the db

            $matchedKeys = array_keys($backendArr, $keyword);


            // push (merge) the matching item to the result  array
            $result = array_merge($result, $matchedKeys);
        }



        // lets assume we have the Id of the company we want to save
        $company = $company->find(1);

        // return programming single lang
        $pLangArr  =  Backend::getBeStack('p_lang');

        // return programming single lang
        $be_format_for_db = Backend::getBeStack('be_format_for_db');



        /** ######    This section is used to scategorize the stack in frameworks and programming lang  i.e [programming_language => ['framework 1', 'framework2', ]]  #######  */


        // lets format the scrapped result properly 
        $final_result = [];

        foreach ($result as $key => $scraped_result_item) {


            // find/attach the programming language || get programming language
            if (in_array($scraped_result_item, $pLangArr)) {
                // dump($scraped_result_item);

                if ($scraped_result_item == 'JavaScript') {
                    // some Backend job description lists, javascript as backend, so we do the needfull 
                    $scraped_result_item = "Node.js";
                }

                // append the  programming language
                $final_result[$scraped_result_item] = $be_format_for_db[$scraped_result_item];

                // determine the framework related to that programming language
                $framework_result = array_intersect($final_result[$scraped_result_item], $result);

                // append the detetermined framework to the programming language key
                $final_result[$scraped_result_item] =  $framework_result;
            }
        }


        $stackUpdate =  $company->stack_be;
        // dump($final_result);

        foreach ($stackUpdate as $key => $value) {
            $p_lang = strstr($key, '*', true);
            if (!$p_lang) {
                $p_lang = $key;
            }

            if (array_key_exists($p_lang, $final_result)) {
                $nk = $key;

                // delete the item already existing in the column
                unset($stackUpdate[$key]);

                $ratingInteger = (int) substr(strstr($nk, '*'), 1);
                $ratingInteger ?? 0; // if no number, just be zero

                $ratingInteger = $ratingInteger + 1;

                $newkey = $p_lang . '*' . $ratingInteger;


                $stackUpdate[$newkey] = $value;
            }
        }

        // next question is ? how do we make this work 

        if (!empty($stackUpdate)) {

            $company->stack_be =   $stackUpdate;
            $is_saved = $company->save();
            // dd($company);

            if ($is_saved) {
                return $result;
            }
        }
    }
}
