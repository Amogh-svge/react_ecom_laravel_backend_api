<?php

namespace App\Traits;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;

trait HttpResponse
{
    /**
     *
     * @param string|null $message
     * @param integer $code
     * @return JsonResponse
     */

    public function successResponse(array $data, string $message = null, int $code = Response::HTTP_OK): JsonResponse
    {
        return response()->json([
            'status' => 'Success',
            'message' => $message,
            key($data) ?: 'data' => reset($data)
        ], $code);
    }



    /**
     *
     * @param string|null $message
     * @param integer $code
     * @return JsonResponse
     */
    public function errorResponse($data, string $message = null, int $code = Response::HTTP_INTERNAL_SERVER_ERROR): JsonResponse
    {
        return response()->json([
            'status' => 'Error',
            'message' => $message,
            key($data) ?: 'data' => reset($data)
        ], $code);
    }
}
