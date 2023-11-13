<?php

namespace App\Http\Controllers;


use App\Services\DashboardService;
use Illuminate\Contracts\View\View;
use OpenTelemetry\API\Globals;
use OpenTelemetry\API\Trace\StatusCode;


class DashboardController extends Controller
{

    protected  $dashboardService;
    public $tracer;
    public function __construct()
    {
        $this->dashboardService =   new DashboardService;

        $this->tracer =  Globals::tracerProvider()->getTracer('whatcompany_Stack');
    }


    public function index(): View
    {

        $span =  $this->tracer->spanBuilder('first_span')->startSpan();

        try {
            $result = random_int(1, 6);

            $data = $this->dashboardService->getAppStats();
        } catch (\Exception $e) {

            $span->recordException($e)->setStatus(StatusCode::STATUS_ERROR);
            throw $e;
        } finally {
            $span->addEvent('called homepage', ['result' => $result])
                ->end();
        }


        return view('admin.dashboard', $data);
    }
}
