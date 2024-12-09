<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\FrontEndService;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;



class FrontendController extends Controller
{
    public function __construct(protected FrontEndService $frontEndService)
    {
    }

    public function index(): View
    {
        return View('admin.stack.index');
    }
    public function create(): View
    {

        $allStackInfo = $this->frontEndService->getAllStackInfo();

        return View("admin.stack.create.frontend", ['allStackInfo' => $allStackInfo]);
    }


    public function store(Request $request): RedirectResponse
    {
        return $this->frontEndService->store($request);
    }
}
