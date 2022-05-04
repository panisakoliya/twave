<?php


namespace App\Helper;


class APIResponseHelper
{
    public static function apiErrorResponse($message = null)
    {
        return response()->json([
            'status' => false,
            'message' => $message
        ]);
    }
}
