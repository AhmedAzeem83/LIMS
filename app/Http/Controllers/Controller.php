<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController
{
    use AuthorizesRequests, ValidatesRequests;

    /**
     * Return a standardized JSON success response.
     */
    protected function successResponse($data = [], $message = 'Success', $code = 200)
    {
        return response()->json([
            'status' => true,
            'message' => $message,
            'data' => $data
        ], $code);
    }

    /**
     * Return a standardized JSON error response.
     */
    protected function errorResponse($message = 'Error', $code = 400, $data = [])
    {
        return response()->json([
            'status' => false,
            'message' => $message,
            'data' => $data
        ], $code);
    }

    /**
     * Log an action for auditing purposes.
     */
    protected function logAction($action, $details = [])
    {
        \Log::info('Controller Action', [
            'action' => $action,
            'user_id' => auth()->id(),
            'details' => $details,
            'timestamp' => now(),
        ]);
    }

    // Add more shared logic for all controllers here
}
