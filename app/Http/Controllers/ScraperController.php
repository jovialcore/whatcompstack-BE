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
                $keyword = 'node.js'; // converted to the small form so we can use array_keys to get the properdb formate name, see below 👇👇👇
            }

            $matchedKeys = array_keys($backendArr, $keyword); // note that array_keys can act as filters too 

            // dump($matchedKeys);
            // push (merge) the matching item to the result  array
            $result = array_merge($result, $matchedKeys);
        }
        array_splice($result, 0); // assuming there is no programming language 
        // lets get frameworks 

        $result[] = 'Spring Boot';
        $result[] = 'Laravel';

        $result[] = 'Ruby on Rails';
        $result[] = 'Django';
        $result[] = 'Flask';

        $result[] = 'Symfony';
        $result[] = 'Grails';
        $result[] = 'Swift';
        $result[] = 'Lua';

        $result[] = 'CakePHP';
        $result[] = 'Express.js';


        // dd($result);
        /** ######    Group frameworks into their respective programming languages (as Assoc Array) #######  */
        $k = [];

        foreach ($result as $key => $value) {

            // check if p_lang from scraped results match that of keys in the speculative db format arrangment
            if (array_key_exists($value, $be_format_for_db)) {
                // the framework
                $framework = array_intersect($be_format_for_db[$value], $result);
                // then use the $value i.e programming langauge and assign the returned framework inside the new collector: $k array
                $k[$value] = $framework;
                // if no programming language are found, that means we have only frameworks, then assign the scrapped framework results to their respective programming languages  
            } else {
                foreach ($be_format_for_db as $keyy => $fwk) {

                    // cater for if we have progrmamming language in the array before so we avoid duplicates of values i.e frameworks e.g ( [PHP => 'laravel', 'cakephp', 'laravel])
                    if (in_array($value, $be_format_for_db[$keyy])) {
                        if (isset($k[$keyy])) {
                            if (!in_array($value, $k[$keyy]))
                                $k[$keyy][] = $value;
                        } else {
                            $k[$keyy][] = $value;
                        }
                    }
                }
            }
        }

        // lets assume we have the Id of the company we want to save
        $company = $company->with('plangs.frameworks.companies', 'frameworks')->find(2);
        $allPlangs = Plang::with('frameworks')->get();


        // if the language is already in the database

        if ($company->plangs->count() < 0) {
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
                                $company->frameworks()->updateExistingPivot($frameworkId, ['rating' => $fw->pivot->rating + 1]);
                            }
                        }
                    }
                } else {

                    $company->plangs()->attach($progrLang->id, ['rating' => 0]);
                }
            }
        } else {
            foreach ($allPlangs as $plang) {

                // check if the  programming lang from scraped result matches with the one in db

                if (array_key_exists($plang->name, $k)) {
                    // attach a programming language with the company

                    $company->plangs()->attach($plang->id, ['rating' => 0]);

                    // attach the  framework under the programmming language


                    if (isset($k[$plang->name]) && $k[$plang->name] != "" && !is_null($k[$plang->name])) {

                        $ffs = [];
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

            // if a scraped result have only programming laguages, you should detect the framework
            // after that, changed the model to use "hasManyThrough
        }

        dump($company);

        // dd($company->flatMap->plangs);

        // return programming single lang

        $be_format_for_db = Backend::getBeStack('be_format_for_db');
    }
}
