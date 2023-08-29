<?php

namespace App\Traits;

use Illuminate\Http\JsonResponse;

trait ApiResponse
{
    /**
     * Return a new JSON response from the application.
     *
     * @param string|null $message
     * @param  string|array|object|null  $data
     * @param bool $success
     * @param  int  $status
     * @param  array  $headers
     * @param  int  $options
     */
    public function response(?string $message = null, string|array|object|null $data = null, bool $success = true, int $status = 200, array $headers = [], int $options = 0): JsonResponse
    {
        return response()->json([
            'message' => $message,
            'success' => $success,
            'data' => $data,
        ], $status, $headers, $options);
    }
}