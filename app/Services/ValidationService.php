<?php

namespace App\Services;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

trait ValidationService
{
    private static $errorArray;

    public static $ShiftValidationRule = [
        "worker_id" => "required|integer",
        "shift_id" => "required|integer|exists:shifts,id",
        "date" => "required|date_format:Y-m-d",
    ];
    
    public static $FilterValidationRule = [
        "start_date" => "date_format:Y-m-d" ?? "",
        "end_date" => "date_format:Y-m-d" ?? "",
        "shift_id" => "integer|exists:shifts,id" ?? "",
        "shift_type" => "in:all,morning,noon,evening" ?? "",
    ];


    /**
     * Error message method
     * @param Array $errorArray
     * @return Mixed or null
     */
    public static function formatError($errorArray)
    {
        self::$errorArray = collect($errorArray);
        return self::$errorArray->map(function ($error) {
            return $error[0];
        });
    }

    /**
     * Validation of request parameters
     *
     * @param  $request
     * @return Mixed or null
     */
    public static function validateRequestParams(array $request, array $validationRule)
    {
        $validation = Validator::make($request, $validationRule);

        if ($validation->fails()) return self::formatError($validation->errors());
        return false;
    }
}
