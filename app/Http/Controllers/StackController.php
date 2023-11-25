<?php

namespace App\Http\Controllers;

use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;


class StackController extends Controller
{
    //

    public function index(): View
    {
        return View('admin.stack.index');
    }

    public function create(): View
    {
        return View('admin.stack.create');
    }



    // public function store(): RedirectResponse
    // {
    // }
}
