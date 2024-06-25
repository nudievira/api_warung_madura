<?php

namespace App\Helpers;

class ResponseFormatter
{
    protected static $response = [
        'meta' => [
            'code' => null,
            'status' => null,
            'message' => null,
        ],
    ];

    // status code 200 get data success
    public static function success($data = null, $message = 'success', $code = 200)
    {
        self::$response['meta']['code'] = 200;
        self::$response['meta']['status'] = 'success';
        self::$response['meta']['message'] = $message;
        self::$response['data'] = $data;

        return response()->json(self::$response, $code);
    }

    // status code 201 created data success
    public static function created($data = null, $message = 'Data Created', $code = 201)
    {
        self::$response['meta']['code'] = 201;
        self::$response['meta']['status'] = 'Success';
        self::$response['meta']['message'] = $message;
        self::$response['data'] = $data;

        return response()->json(self::$response, $code);
    }

    

    // status code 400 bad request
    public static function error($message = 'Bad Request', $data = null, $code = 400)
    {
        self::$response['meta']['code'] = 400;
        self::$response['meta']['status'] = 'Error';
        self::$response['meta']['message'] = $message;
        self::$response['data'] = $data;

        return response()->json(self::$response, $code);
    }

    // status code 401 unauthorized
    public static function unauthorized($message = 'Unauthorized', $data = null, $code = 401)
    {
        self::$response['meta']['code'] = 401;
        self::$response['meta']['status'] = 'Error';
        self::$response['meta']['message'] = $message;
        self::$response['data'] = $data;

        return response()->json(self::$response, $code);
    }

    // status code 403 forbidden
    public static function forbidden($message = 'Forbidden', $data = null, $code = 403)
    {
        self::$response['meta']['code'] = 403;
        self::$response['meta']['status'] = 'Error';
        self::$response['meta']['message'] = $message;
        self::$response['data'] = $data;

        return response()->json(self::$response, $code);
    }

    // status code 404 not found
    public static function notFound($message = 'Not Found', $data = null, $code = 404)
    {
        self::$response['meta']['code'] = 404;
        self::$response['meta']['status'] = 'Error';
        self::$response['meta']['message'] = $message;
        self::$response['data'] = $data;

        return response()->json(self::$response, $code);
    }
    // status code 408 request timeout
    public static function requestTimeout($message = 'Request Timeout', $data = null, $code = 408)
    {
        self::$response['meta']['code'] = 408;
        self::$response['meta']['status'] = 'Error';
        self::$response['meta']['message'] = $message;
        self::$response['data'] = $data;

        return response()->json(self::$response, $code);
    }
    
    // status code 409 conflict
    public static function conflict($message = 'Conflict', $data = null, $code = 409)
    {
        self::$response['meta']['code'] = 409;
        self::$response['meta']['status'] = 'Error';
        self::$response['meta']['message'] = $message;
        self::$response['data'] = $data;

        return response()->json(self::$response, $code);
    }

    // status code 500 internal server error
    public static function internalServerError($message = 'Internal Server Error', $data = null, $code = 500)
    {
        self::$response['meta']['code'] = 500;
        self::$response['meta']['status'] = 'Error';
        self::$response['meta']['message'] = $message;
        self::$response['data'] = $data;

        return response()->json(self::$response, $code);
    }

    
}
