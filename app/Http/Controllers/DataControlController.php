<?php

namespace App\Http\Controllers;


use App\Services\DataControlService;
use Illuminate\Http\Request;
use App\Services\ScraperService;
use App\Traits\companyPreviewTrait;
use  Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;


class DataControlController extends Controller
{

    use companyPreviewTrait;

    protected $dataControlService;
    protected $dashBoardService;


    public function __construct()
    {
        $this->dataControlService = new DataControlService;

        // unforseen rules, if you are fetching result, your return type should be redirect response
        //if you are fetching results, your return type should as views
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

    public function confirmResults($company): RedirectResponse
    {
        $this->dataControlService->confirmResult($company);

        $oldResult = $this->oldSourcedData($company);

        return to_route('admin.preview.results', ['oldResult' =>  $oldResult, 'company' => $company]);
    }
}
