<?php

namespace App\Traits;

trait ResponseAPI
{
    public function coreResponse($data = null, $statusCode, $code = null)
    {
        // Send the response
        if($code == "token") {
            return response()->json([
                'token' => $data
            ], $statusCode);
        } else if($code == "balance") {
            return response()->json([
                'balance' => $data
            ], $statusCode);
        } else if($code == "topup") {
            return response()->json("Topup successful", $statusCode);
        } else if($code == "error") {
            return response()->json([
                'message' => "Bad Request",
                'error' => true,
                'code' => $statusCode,
            ], $statusCode);
        }
    }

    public function tokenUser($data, $statusCode = 200)
    {
        return $this->coreResponse($data, $statusCode, "token");
    }

    public function userBalance($data, $statusCode = 200)
    {
        return $this->coreResponse($data, $statusCode, "balance");
    }

    public function topUp($statusCode = 200)
    {
        return $this->coreResponse($statusCode, "topup");
    }

    public function error($statusCode = 500)
    {
        return $this->coreResponse(null, $statusCode, "error");
    }
}