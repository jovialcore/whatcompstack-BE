<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\ScraperService;

class DataControlController extends Controller
{
    protected $scraper;
    public function __construct()
    {
        $this->scraper = new ScraperService();
    }
    public function index()
    {

        $this->scraper->homepageScrape();
        return view('admin.scraper');
    }

    public function initiateDataSourcing(Request  $request)
    {


        // upload cv
        // we list companies based on your profile
        // this companies listed on your profil, you cna send them a cold mail. 
        // organise your job hunting.
        // if you must shoot you shots as in your tech job hunting, make sure you are shooting in the right direction

        // then this where whatcompanystack comes in !

      
        $request->validate([
            'company' => 'required',
            'stack' => 'required',
            'source' => 'required',
        ]);

 
        return view('admin.scrapperResult');
    }
}
