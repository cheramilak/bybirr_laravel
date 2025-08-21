<?php

namespace App\Http\Controllers;

use Illuminate\Http\JsonResponse;

abstract class Controller
{
    public function success(mixed $data, string $message = "okay", int $satusCode = 200): JsonResponse
    {

        return response()->json([
            'data' => $data,
            'success' => true,
            'message' => $message
        ], $satusCode);
    }

    public function error(string $message, int $satusCode = 400)
    {
        return response()->json([
            'data' => null,
            'success' => false,
            'message' => $message
        ], $satusCode);
    }

    public function validationError(string $message, int $satusCode = 422)
    {
        return response()->json([
            'data' => null,
            'success' => false,
            'message' => $message
        ], 400);
    }
}
