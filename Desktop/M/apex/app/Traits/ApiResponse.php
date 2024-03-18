<?php

namespace App\Traits;

use Illuminate\Http\JsonResponse;

trait ApiResponse
{

    protected function success(array|object  $data = [], string $message = '', int $code = 200): JsonResponse
    {
        return $this->res('success', message: $message, data: $data,  code: $code);
    }

    protected function error(array|object $data = [], string $message = '', int $code = 400): JsonResponse
    {
        return $this->res('Invalid request', $message, $data, $code);
    }

    protected function notFound(array|object $data = [], string $message = '', int $code = 404): JsonResponse
    {
        return $this->res('not_found', $message, $data, $code);
    }

    protected function serverError(array|object $data = [], string $message = '', int $code = 500): JsonResponse
    {
        return $this->res('server_error', $message, $data, $code);
    }

    protected function notPermitted(array|object $data = [], string $message = '', int $code = 500): JsonResponse
    {
        return $this->res('not_Permitted', $message, $data, $code);
    }
    
    protected function res(string $type, string $message, array|object $data, int $code): JsonResponse
    {

        return response()->json(
            [
                'response' => ($type == 'success') ? true : false,
                'type' => $type,
                'message' => $message,
                'status' => $code,
                'data' => $data,

            ]
        );
    }
}
