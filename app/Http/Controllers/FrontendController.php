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
    public function create($stackType): View
    {

        $allStackInfo = $this->frontEndService->getAllStackInfo($stackType);

        return View("admin.stack.create.{$stackType}", ['allStackInfo' => $allStackInfo]);
    }


    public function store(Request $request): RedirectResponse
    {
        return $this->frontEndService->store($request);
    }
}
