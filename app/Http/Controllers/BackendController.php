<?php

namespace App\Http\Controllers;

use App\Services\BackEndService;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;


class BackendController extends Controller
{

    public function __construct(protected BackEndService $backEndService)
    {
    }

    public function create(): View
    {
        $allStackInfo = $this->backEndService->getAllStackInfo();
        return View("admin.stack.create.backend", ['allStackInfo' => $allStackInfo]);
    }


    public function store(Request $request): RedirectResponse
    {
        return $this->backEndService->store($request);
    }
}
