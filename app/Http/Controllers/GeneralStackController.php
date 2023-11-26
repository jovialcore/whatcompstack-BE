<?php

namespace App\Http\Controllers;


use Illuminate\Contracts\View\View;

class GeneralStackController extends Controller
{

    public function index(): View
    {
        return View('admin.stack.index');
    }
}
