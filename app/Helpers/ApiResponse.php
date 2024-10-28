<?php

namespace App\Helpers;

class ApiResponse {

    public static function success(String $message = "", Array $data = [], Int $statusCode = 200){
        return response()->json([
            'status' => 'success',
            'message' => $message,
            'data' => $data
        ], $statusCode);
    }

    public static function error(String $message = "", Array $errors = [], Int $statusCode = 200){
        return response()->json([
            'status' => 'error',
            'message' => $message,
            'errors' => $errors
        ], $statusCode);
    }

}
