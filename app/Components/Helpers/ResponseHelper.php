<?php

namespace App\Components\Helpers;

class ResponseHelper
{
    /**
     * @param $data
     * @param int $status
     * @return \Illuminate\Http\JsonResponse
     */
    public static function success($data, $status = 200)
    {
        return response()->json([
            "success" => true,
            "status"  => $status,
            "data"    => $data
        ]);
    }

    /**
     * @param $message
     * @param int $status
     * @return \Illuminate\Http\JsonResponse
     */
    public static function error($message, $status = 500)
    {
        return response()->json([
            "success" => false,
            "status"  => $status,
            "message" => $message
        ]);
    }
}
