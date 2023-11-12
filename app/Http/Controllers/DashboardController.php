<?php

namespace App\Http\Controllers;

use App\Services\DashboardService;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Http;
use OpenTelemetry\SDK\Trace\TracerProviderFactory;



class DashboardController extends Controller
{

    protected  $dashboardService;
    public function __construct()
    {
        $this->dashboardService =   new DashboardService;
    }


    public function index(): View
    {

        Http::withTrace()->get('https://google.com');

        $traceFactory = new TracerProviderFactory();
        dd($traceFactory);
        $tracerProvider = $traceFactory->create();
        $tracer = $tracerProvider->getTracer('whatcompanystack_trace');

        $span = $tracer->spanBuilder('get_all_details')->startSpan();

        $result = random_int(1, 6);

        $data = $this->dashboardService->getAppStats();

        $span->setAttribute('get_all_details_id', $result);

        $span->end();

        return view('admin.dashboard', $data);

        $tracerProvider->shutDown();
    }
}
