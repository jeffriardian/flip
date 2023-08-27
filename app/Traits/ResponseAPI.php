<?php

namespace App\Traits;

trait ResponseAPI
{
    public function coreResponse($message, $statusCode)
    {
        // Send the response
        if($code == "error") {
            return response()->json([
                'message' => $message,
                'error' => true,
                'code' => $statusCode,
            ], $statusCode);
        }
    }

    public function error($message, $statusCode = 500)
    {
        return $this->coreResponse($message, $statusCode);
    }
}