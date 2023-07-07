<?php

namespace App\Http\Controllers;

use Goutte\Client;
use Illuminate\Http\Request;

use App\Helpers\Backend;
use App\Models\Company;
use App\Models\Framework;
use App\Models\Plang;
use DonatelloZa\RakePlus\RakePlus;

class ScraperController extends Controller
{

    public function homepageScrape(Company $company)
    {
        $client = new Client();
        $homepage = $client->request('GET', 'https://www.myjobmag.com/jobs-at/konga/7');
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
        $keywords = RakePlus::create($text, ['.js'], 3)->keywords();


        $result = [];
        // get all backend stack 

        $backendArr  =  Backend::getBeStack('allstacks');
        $be_format_for_db  =  Backend::getBeStack('be_format_for_db');

        /** ######    This section is used to select all stacks possible  #######  */

        // loop throuh keyword extracted
        // dd( $keywords);
        foreach ($keywords as $keyword) {

            // convert to small case
            $keyword = strtolower($keyword);

            //check if keywords exist in $backend stacks and retrieve the matched keys
            // using the $keyword as filter, we now return keys of $backendArr that represent which represent perfect name we want tosave in the db
            if ($keyword == 'javascript') {
                $keyword = 'node.js';
            }

            $matchedKeys = array_keys($backendArr, $keyword);

            // dump($matchedKeys);
            // push (merge) the matching item to the result  array
            $result = array_merge($result, $matchedKeys);
        }

        // lets get frameworks 
        $result[] = 'Spring Boot';
        $result[] = 'Laravel';
        $result[] = 'Symfony';
        $result[] = 'Grails';


        $k = [];

        foreach ($result as $key => $value) {

            if (array_key_exists($value, $be_format_for_db)) {


                $framework = array_intersect($be_format_for_db[$value], $result);

                $k[$value] = $framework;
            }
        }


        // lets assume we have the Id of the company we want to save
        $company = $company->with('plangs.frameworks.companies', 'frameworks')->find(2);
        $allPlangs = Plang::with('frameworks')->get();


        // if the language is already in the database

        if ($company->plangs->count() > 0) {
            foreach ($company->plangs as $progrLang) {

                if (array_key_exists($progrLang->name, $k)) {


                    // just update the rating coulmn on pivot table                       // add plus one to the rating  column

                    $company->plangs()->updateExistingPivot($progrLang->id, ['rating' => $progrLang->pivot->rating + 1]);

                    // if there are any frameworks and they are what we had before ? do the following
                    if (!empty($k[$progrLang->name])) {

                        // loop through the ssupposedly frameworks that we have
                        foreach ($k[$progrLang->name] as $frameworkName) {
                            // get the related framework id
                            $frameworkId = $progrLang->frameworks->where('name', $frameworkName)->first()->id;
                            // loop through company frameworks and update the pivot table of ids that match 
                            foreach ($company->frameworks as $fw) {
                                $company->frameworks()->updateExistingPivot( $frameworkId , ['rating' => $fw->pivot->rating + 1]);
                            }
                           
                        }
                    }
                } else {
                        dd('yeah... array key does not exist');
                    $company->plangs()->attach($progrLang->id, ['rating' => 0]);
                }

                // update framework rating too on the pivot table


            }
        } else {
            foreach ($allPlangs as $plang) {

                // check if the  programming lang matches with the one in db

                if (array_key_exists($plang->name, $k)) {
                    // attach a programming language with the company

                    $company->plangs()->attach($plang->id, ['rating' => 0]);

                    // attach the  framework under the programmming language

                    if (isset($k[$plang->name])) {

                        foreach ($k[$plang->name]  as $frameworkName) {
                            // get the id of the framework that matched
                            $framework_id = $plang->frameworks->where('name', $frameworkName)->first()->id;
                            // attach to compnay_framework table 
                            $company->frameworks()->attach($framework_id, ['rating' => 0]);
                        }
                    }
                    // attach the framework id to the company

                }
            }
                //notes of to do
            // revisist "hasManyThrough" "hasManyThrough" will definitely work !
            //what if we have frameworks and there is no programming language?  wahala !

            // find the framework related with that language and match that to the company


        }

        dump($company);

        // dd($company->flatMap->plangs);

        // return programming single lang

        $be_format_for_db = Backend::getBeStack('be_format_for_db');
    }
}
