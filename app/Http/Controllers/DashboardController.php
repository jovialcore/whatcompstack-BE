<?php

namespace App\Http\Controllers;


use App\Services\DashboardService;
use Exception;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Log;
use Keepsuit\LaravelOpenTelemetry\Facades\Tracer;
use OpenTelemetry\Contrib\Otlp\OtlpHttpTransportFactory;
use OpenTelemetry\Contrib\Otlp\SpanExporter;
use OpenTelemetry\SDK\Trace\SpanProcessor\SimpleSpanProcessor;
use OpenTelemetry\SDK\Trace\TracerProvider;

class DashboardController extends Controller
{

    protected  $dashboardService;
    public $tracer;
    public function __construct()
    {
        $this->dashboardService =   new DashboardService;
    }


    public function index(): View
    {


        $transport = (new OtlpHttpTransportFactory())->create('https://otel.highlight.io:4318/v1/traces', 'application/x-protobuf');
        $exporter = new SpanExporter($transport);

        $tr = new TracerProvider(
            new SimpleSpanProcessor($exporter)
        );

        $span  = $tr->getTracer('jovialcore')->spanBuilder('root')->startSpan();
        try {

            $scope = $span->activate();
            $span->setAttribute('project_id', 'memz47yg');
            $data = $this->dashboardService->getAppStats();


            $result = random_int(1, 6);

            throw new Exception('an example of an exemption that can be thrown');
        } catch (\Exception $e) {

            Log::error($e);
        }


        $span->end();
        $scope->detach();
        return view('admin.dashboard', $data);
    }
}
