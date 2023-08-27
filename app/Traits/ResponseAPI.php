<?php

namespace App\Traits;

trait ResponseAPI
{
    public function coreResponse($message, $data = null, $statusCode, $code = null)
    {
        // Check the params
        if(!$message) return response()->json(['message' => 'Message is required'], 500);

        // Send the response
        if($code == "token") {
            return response()->json([
                'token' => $data
            ], $statusCode);
        } else if($code == "balance") {
            return response()->json([
                'balance' => $data
            ], $statusCode);
        }else if($code == "error") {
            return response()->json([
                'message' => $message,
                'error' => true,
                'code' => $statusCode,
            ], $statusCode);
        }
    }

    public function tokenUser($message, $data, $statusCode = 200)
    {
        return $this->coreResponse($message, $data, $statusCode, "token");
    }

    public function userBalance($message, $data, $statusCode = 200)
    {
        return $this->coreResponse($message, $data, $statusCode, "balance");
    }

    public function error($message, $statusCode = 500)
    {
        return $this->coreResponse($message, null, $statusCode, "error");
    }
}