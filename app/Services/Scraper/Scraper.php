<?php

namespace App\Services\Scraper;

use Goutte\Client;
use Illuminate\Http\Request;

use App\Models\Company;
use App\Models\Framework;
use App\Models\Plang;
use DonatelloZa\RakePlus\RakePlus;

class Scraper
{
    const published = 2;
    const draft = 1;

    protected $company;
    protected $dataSource;
    protected $stack;
    protected $noOfResultsPerPage;
    protected $stackOptions;
    protected $sourceSlug;

    public function __construct($company, $sourceSlug, $dataSource, $stack, $stackOptions)
    {
        $this->company = $company;
        $this->dataSource = $dataSource;
        $this->stack = $stack;
        $this->stackOptions = $stackOptions;
        $this->sourceSlug = $sourceSlug;
    }
    public function dataSource()
    {


        $company = new  Company();

        $client = new Client();

        $noOfResultsTracker = 0;
        $noOfResultsPerPage = 17;
        $cc = '';
        $pagination = 1;
        $keyword = "";
        $slugToSourceFor = strtolower($this->sourceSlug);


        while (true) { // controls moving to next page asin controls flow of pagination

            // use paystack to test for nodejs cases ..flutterwave to test for getting frameworks too
            $homepage = $client->request('GET', "{$this->dataSource}{$slugToSourceFor}/{$pagination}");

            $isItEndOfPaginationResult = $homepage->filter('.job-list > .job-list-li')->first()->count();


            if ($noOfResultsTracker < $noOfResultsPerPage) { /// controls no of sections per page


                $homepage->filter('.job-info > ul > .mag-b ')->each(function ($node, $key) use ($client, $company, &$keyword, &$cc, &$noOfResultsTracker) {

                    $jobTitles =   $node->text();

                    $noOfResultsTracker++;

                    // remove parentensis --just incase and any other stuff aside letters and alphabets and format to smaller letters too
                    $purgedTitles =  strtolower(preg_replace('/[^a-z]/i', ' ', $jobTitles));

                    // get the particular keyword, which  in this case, it is "backend"

                    $keyword = substr($purgedTitles, strpos($purgedTitles,  $this->stack));

                    // further extraction to return only one word i.e backend
                    $keyword = preg_replace("/\s.*/", '', ltrim($keyword));

                    // click on the job description that has the keyword backend
                    if ($keyword == $this->stack) {
                        // find the link
                        $link = $node->selectLink($jobTitles)->link();

                        // click on the link
                        $website = $client->click($link);

                        //  👀  side note or bud:  this stuff loops two times? why ?  it should be fixed now though: Dec 19-12-2023 👀
                        $this->fetch($company, $website);
                    }

                    // sieve the key word
                });
            }




            if ($noOfResultsTracker   <=  18) {

                $pagination = $pagination + 1;

                dump('Page ' . $pagination . ' initiated.  and this is the value of tracker ' . $noOfResultsTracker);

                if ($isItEndOfPaginationResult === 0) {

                    $pagination =  $pagination - 2;
                    dump('this is key word at the end of page ' . $keyword);

                    dump('We have reached the maximun no of pages which is ' . $pagination);

                    return $cc;

                    break; //exit the loop
                } else {
                    //reset
                    $noOfResultsTracker = 0;
                }
            } else {
                // I will use this to check if keyword exist and if we have scraped this site before
                dd('looks like key word does not exist in this source ');
            }
        }
    }



    public function fetch($company, $website)
    {

        $text = "";

        // get the second link that matches the nodes specified
        $website->filter('p > strong')->each(function ($node) use (&$text, $website) {

            $requirmentBe = implode('|', $this->stackOptions['requirement_keywords']);

            $pattern = '/\b(' . $requirmentBe . ')\b/i';

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

        if ($this->stack == 'backend') {
            $keywords = RakePlus::create($text, ['.js'], 3)->keywords();
        }


        $result = [];
        // get all backend stack

        $backendArr  = $this->stackOptions['allstacks'];
        $be_format_for_db  =   $this->stackOptions['format_for_db'];

        /** ######    This section is used to select all stacks possible  #######  */

        // loop throuh keyword extracted

        // dd($keywords);
        foreach ($keywords as $keyword) {

            // convert to small case
            $keyword = strtolower($keyword);

            //check if keywords exist in $backend stacks and retrieve the matched keys
            // using the $keyword as filter, we now return keys of $backendArr that represent which represent perfect name we want tosave in the db

            if (in_array($keyword, ['javascript', 'node'])) {
                $keyword = 'node.js'; // converted to the small form so we can use array_keys to get the properdb formate name, see below 👇👇👇
            }

            $matchedKeys = array_keys($backendArr, $keyword); // note that array_keys can act as filters too

            // push (merge) the matching item to the result  array
            $result = array_merge($result, $matchedKeys);
        }
        //array_splice($result, 0); // assuming there is no programming language
        //lets get frameworks

        // $result[] = 'Laravel';

        // $result[] = 'Ruby on Rails';
        // $result[] = 'Django';
        // $result[] = 'Flask';

        // $result[] = 'Symfony';
        // $result[] = 'CherryPy';
        // $result[] = 'Grails';
        // $result[] = 'Swift';
        // $result[] = 'Lua';

        // $result[] = 'CakePHP';
        // $result[] = 'Express.js';



        /** ######    Group frameworks into their respective programming languages (as Assoc Array) #######  */
        $k = [];



        foreach ($result as $key => $value) {

            // check if p_lang from scraped results match that of keys in the speculative db format arrangment
            if (array_key_exists($value, $be_format_for_db)) {
                // match the framework to the specific language from the scraped results or get the framework
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



        $company = $company->with('plangs.frameworks.companies', 'frameworks')->where('name', $this->company)->first();


        // if the language is already in the database
        foreach ($k as  $plangKey => $framework) {

            $progrLangQuery = $company->plangs->where('name', 'Java');
            if (($company->plangs->count() > 0) && ($company->plangs->pluck('name')->contains($plangKey))) {

                $progrLang =    $progrLangQuery->first();
                if ($progrLang) {
                    // just update the rating coulmn on pivot table        // add plus one to the rating  column

                    $company->plangs()->updateExistingPivot($progrLang->id, ['draft_rating' => $progrLang->pivot->draft_rating + 1, 'is_draft' => 1, 'is_published' => 0]);

                    // if there are any frameworks from scraped results and they are what we had before ? do the following
                    if (!empty($k[$progrLang->name])) {

                        // loop through the ssupposedly frameworks that we have
                        foreach ($k[$progrLang->name] as $frameworkName) {
                            // get the related framework id
                            $frameworkId = $progrLang->frameworks->where('name', $frameworkName)->first()->id;
                            // loop through company frameworks and update the pivot table of ids that match
                            foreach ($company->frameworks as $fw) {
                                $company->frameworks()->updateExistingPivot($frameworkId, ['draft_rating' => $fw->pivot->draft_rating + 1, 'is_draft' => 1, 'is_published' => 0]);
                            }
                        }
                    }
                }
            } else {

                $progrLang = Plang::with('frameworks')->where('name', $plangKey)->first();
                $company->plangs()->attach($progrLang->id, ['draft_rating' => 1, 'is_draft' => 1, 'is_published' => 0]);

                if (isset($framework) && $framework != "" && !is_null($framework)) {

                    foreach ($framework  as $frameworkName) {

                        // get the id of the framework that matched
                        $frameworkMatched =   $progrLang->frameworks->where('name', $frameworkName)->first();

                        if ($frameworkMatched) {
                            // insert to compnay_framework table
                            $company->frameworks()->attach($frameworkMatched->id, ['draft_rating' => 1, 'is_draft' => 1, 'is_published' => 0]);
                        } else {
                            dd('cant find ' . $frameworkName . ' cos it is related to ' . $plangKey);
                        }
                    }
                }
                // if a scraped result have only programming laguages, you should detect the framework
                // after that, changed the model to use "hasManyThrough-- suggestion
            }
        }
    }
}
