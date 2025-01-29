<?php

namespace App\Exceptions;

use Exception;

class CustomException extends Exception
{
    /**
     * Render the exception as an HTTP response.
     */
    public function render($request)
    {
        return response()->json([
            'error' => 'Model Not Found',
            'message' => $this->getMessage(),
        ], 422);
    }
    
}