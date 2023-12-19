<?php

namespace App\Http\Controllers;

use App\Models\Mobile;
use App\Services\MobileService;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class MobileController extends Controller
{

    public function __construct(protected MobileService $mobileService)
    {
    }

    public function index(): View
    {
        return View('admin.stack.index');
    }
    public function create(): View
    {
        $allStackInfo = $this->mobileService->getAllStackInfo();

        return View("admin.stack.create.mobile", ['allStackInfo' => $allStackInfo]);
    }

    public function store(Request $request): RedirectResponse
    {
        return $this->mobileService->store($request);
    }
}
