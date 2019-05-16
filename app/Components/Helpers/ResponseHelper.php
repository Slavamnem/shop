<?php

namespace App\Components\Helpers;

class ResponseHelper
{
    public static function success($data, $status = 200)
    {
        return response()->json([
            "success" => true,
            "status"  => $status,
            "data"    => $data
        ]);
    }
}
