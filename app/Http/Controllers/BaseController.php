<?php

namespace App\Http\Controllers;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class BaseController extends Controller
{
    protected function successResponse(mixed $data = null, ?string $message =null):JsonResponse
    {
        $response = [
            'success' => true,
        ];

        if (!is_null($message)) {
            $response['message'] = $message;
        }
        if (!is_null($data)) {
            $response['data'] = $data;
        }

        return response()->json($response,200);
    }

    protected function errorResponse(array $data = null, string $message):JsonResponse
    {
        $response = [
            'success' => false,
            'message' => $message,
        ];

        if (!empty($data)) {
            $response['data'] = $data;
        }
        return response()->json($response,404);
    }
}
