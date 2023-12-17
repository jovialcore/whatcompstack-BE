<?php

namespace App\Http\Controllers;


use App\Services\DataControlService;
use Illuminate\Http\Request;
use App\Services\Scraper\ScraperBE;
use App\Services\Scraper\Scraper;
use App\Traits\companyPreviewTrait;
use  Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;

use App\Helpers\Backend;


class DataControlController extends Controller
{

    use companyPreviewTrait;


    protected $dashBoardService;


    public function __construct(protected DataControlService  $dataControlService)
    {

        // unforseen rules, if you are fetching result, your return type should be redirect response
        //if you are fetching results, your return type should as views
    }


    public function index()
    {
        $data = $this->dataControlService->index();

        return  view('admin.scraper', $data);
    }

    public function initiateDataSourcing(Request  $request): RedirectResponse
    {

        $request->validate([
            'company' => 'required', // actuallly the company id
            'stack' => 'required',
            'data_source' => 'required',
        ]);
  
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
