<?php

namespace App\Http\Controllers;


use App\Services\DashboardService;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use OpenTelemetry\API\Globals;
use OpenTelemetry\SDK\Trace\SpanExporter\ConsoleSpanExporterFactory;
use OpenTelemetry\SDK\Trace\TracerProviderFactory;



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

        $result = random_int(1, 6);

        $data = $this->dashboardService->getAppStats();

        $exporter = new  ConsoleSpanExporterFactory;

        $span->addEvent('called the home page', ['result' => $result])
            ->end();
       
        return view('admin.dashboard', $data);
    }
}
