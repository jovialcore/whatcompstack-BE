<?php

namespace App\Http\Controllers;


use App\Services\DashboardService;
use Exception;
use Illuminate\Contracts\View\View;
use OpenTelemetry\API\Globals;
use OpenTelemetry\API\Trace\SpanKind;
use OpenTelemetry\API\Trace\StatusCode;
use OpenTelemetry\SDK\Trace\Tracer;
use OpenTelemetry\SDK\Trace\TracerProvider;

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

        $span =  $this->tracer->spanBuilder('first_span')->setSpanKind(SpanKind::KIND_INTERNAL)->startSpan();

        try {

            $result = random_int(1, 6);

            throw new Exception('an example of an exemption that can be thrown');

            $data = $this->dashboardService->getAppStats();
        } catch (\Exception $e) {

            $span->recordException($e)->setStatus(StatusCode::STATUS_ERROR);

            $span->addEvent('called homepage', ['result' => $result]);
            $span->end();
        }


        return view('admin.dashboard', $data);
    }
}
