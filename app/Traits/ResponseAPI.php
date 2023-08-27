<?php

namespace App\Traits;

trait ResponseAPI
{
    public function coreResponse($message, $statusCode)
    {
        return response()->json($message, $statusCode);
    }

    public function error($message, $statusCode = 500)
    {
        return $this->coreResponse($message, $statusCode);
    }
}