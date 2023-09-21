<?php

namespace App\Http\Controllers;

use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class CompanyController extends Controller
{
    public function create(): View
    {
        return  view('admin.company.addCompany');
    }

    public function store(): RedirectResponse
    {
        return to_route('admin.company.index');
    }
}
