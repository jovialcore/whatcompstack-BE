<?php

namespace App\Http\Controllers;

use App\Services\StackService;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;


class StackController extends Controller
{
    public function __construct(protected StackService $stackService)
    {
    }

    public function index(): View
    {
        return View('admin.stack.index');
    }

    public function create(): View
    {

        $allStackInfo = $this->stackService->getAllStackInfo();

    
        return View('admin.stack.create', ['allStackInfo' => $allStackInfo]);
    }



    public function store(): RedirectResponse
    {
    }
}
