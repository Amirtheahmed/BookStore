<?php

namespace App\Traits;

use Illuminate\Http\Response;

Trait ApiResponser{
    /**
     * Build success response
     * @param mixed $data
     * @param int $code
     * @return Illuminate\Http\Response
     */
    public function successResponse($data, $code = Response::HTTP_OK){
        return response()->json(['data' => $data, $code]);
    }

    /**
     * Build error response
     * @param mixed $message
     * @param int $code
     * @return Illuminate\Http\Response
     */
    public function errorResponse($message, $code){
        return response()->json(['error' => $message, 'code' => $code], $code);
    }
}