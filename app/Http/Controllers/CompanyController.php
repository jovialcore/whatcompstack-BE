<?php

namespace App\Http\Controllers;

use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class CompanyController extends Controller
{
    public function create()
    {
        return  view('admin.company.addCompany');
    }

    public function store() : RedirectResponse
    {
        return to_route('admin.company.index');
    }
}
