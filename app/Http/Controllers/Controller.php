<?php

namespace App\Http\Controllers;

use App\Services\ValidationService;
use Laravel\Lumen\Routing\Controller as BaseController;

class Controller extends BaseController
{
    use ValidationService;

    /**
     * Send Successful Response - Helper function
     * @param mixed $data
     * @param string $message
     * @param integer $code - HttpStatusCode
     */
    static function returnSuccess($data, $message = "successful", $code = 200)
    {
        return response()->json([
            "code"      => "00",
            "message"   => $message,
            "data"      => $data
        ], $code);
    }

    /**
     * Send Failed Response - Helper function
     * @param string $message
     * @param integer $code - HttpStatusCode
     * return Array
     */
    static function returnFailed($message = "failed", $code = 400)
    {
        return response()->json([
            "code"      => "02",
            "message"   => $message,
        ], $code);
    }

}
