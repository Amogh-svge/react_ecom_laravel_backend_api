<?php

namespace App\Traits;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;

trait HttpResponse
{
    public function successResponse(array $data, string $message = null, int $code = Response::HTTP_OK): JsonResponse
    {
        return response()->json([
            'status' => $code,
            'message' => $message,
            key($data) ?: 'data' => reset($data),
        ], $code);
    }

    public function errorResponse($data, string $message = null, int $code = Response::HTTP_INTERNAL_SERVER_ERROR): JsonResponse
    {
        return response()->json([
            'status' => $code,
            'message' => $message,
            key($data) ?: 'data' => reset($data),
        ], $code);
    }
}
