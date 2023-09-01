<?php

namespace App\Http\Controllers;

use App\Models\Company;
use App\Models\DataSource;
use App\Models\Stack;
use Illuminate\Http\Request;
use App\Services\ScraperService;

class DataControlController extends Controller
{

    private $companySourced = '';

    public function index()
    {

        $companies = Company::get(['id', 'name']);
        $stacks = Stack::all();
        $dataSources = DataSource::all();

        return view('admin.scraper', compact('companies', 'stacks', 'dataSources'));
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
            'company' => 'required', // actuallly the company id
            'stack' => 'required',
            'data_source' => 'required',
        ]);


        $scraper = new ScraperService($request->input('company'), $request->input('data_source'), $request->input('stack'));
        $scraper->dataSource();

        return to_route('admin.preview.results', ['company' => request('company')]);
    }

    public function preview(Request $request)
    {
       
        $newResult = Company::with(['plangs' => function ($query) {
            $query->where('is_draft', 1)->where('is_published', 0)->with('frameworks', function ($query) {
                $query->withWhereHas('companies', function ($query) {
                    // I don't now why I can't access the pivot of frameworks directly on frameworks collection exceptI use withWhereHas on Companies -- should look into it some time in future but for now, lets make do with how it is working now
                    $query->where('is_draft', 1)->where('is_published', 0);
                });
            });
        }])->where('name', $this->companySourced)->first();

        return view('admin.scrapperResultPreview', compact('newResult'));
    }
}
