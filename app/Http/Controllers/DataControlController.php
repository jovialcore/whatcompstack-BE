<?php

namespace App\Http\Controllers;

use App\Models\Company;
use App\Models\DataSource;
use App\Models\Stack;
use App\Services\DataControlService;
use Illuminate\Http\Request;
use App\Services\ScraperService;
use App\Traits\companyPreviewTrait;
use  Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Redirect;

class DataControlController extends Controller
{

    use companyPreviewTrait;

    protected $dataControlService;


    public function __construct()
    {
        $this->dataControlService = new DataControlService;
    }

    public function index()
    {
        $companies = Company::get(['id', 'name']);
        $stacks = Stack::all();
        $dataSources = DataSource::all();

        return view('admin.scraper', compact('companies', 'stacks', 'dataSources'));
    }

    public function initiateDataSourcing(Request  $request): RedirectResponse
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

        return to_route('admin.preview.results', ['company' => $request->input('company')]);
    }

    public function preview(Request $request, $company): View
    {

        $newResult = $this->newlySourced($company);

        $oldResult  = $this->oldSourcedData($company);

        return view('admin.scrapperResultPreview', compact('newResult', 'oldResult', 'company'));
    }


    public function confirmResults(Request $request, $company): View
    {
       $confirmedResult = $this->dataControlService->confirmResult($request, $company);

       $newResult = $this->newlySourced($company);
        return view('admin.scrapperResultPreview', compact('newResult'));
    }
}
