<?php

namespace App\Http\Controllers;

use App\Models\DataSource;
use App\Services\DataSourceService;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class DataSourceController extends Controller
{

    protected $dataSourceService;
    public function __construct()
    {
        $this->dataSourceService = new DataSourceService;
    }
    public function create(): View
    {
        return view('admin.source.create');
    }

    public function store(Request $request): RedirectResponse
    {
        if ($this->dataSourceService->addDataSource($request)) {
            return to_route('admin.source.create');
        }

        return to_route('admin.source.create')->with('msg', 'Something went wrong with saving data source');
    }
}
