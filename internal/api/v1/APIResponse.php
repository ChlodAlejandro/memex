<?php

namespace Memex\API;

use Exception;

class APIResponse {

    static function preResponse($code) {
        http_response_code($code);
    }

    static function postResponse($output) {
        ob_clean();
        header("Content-Type: application/json");
        echo json_encode($output);
    }

    static function response($code = 200, $data = []): void {
        self::preResponse($code);
        $responseData = [
            "error" => false,
            "timestamp" => time()
        ];
        self::postResponse(array_merge($responseData, $data));
    }

    static function errorResponse(
        $code = 500,
        $desc = "An error occurred handling your request.",
        $data = []
    ): void {
        self::preResponse($code);
        $responseData = [
            "error" => [
                "code" => $code,
                "description" => $desc,
                "target" => substr($_SERVER["REQUEST_URI"], 8)
            ],
            "timestamp" => time()
        ];
        self::postResponse(array_merge($responseData, $data));
    }

    static function ok($data) {
        self::response(200, $data);
    }

    static function error($code, $desc, $data = []) {
        self::errorResponse($code, $desc, $data);
    }

    static function exception(Exception $exception) {
        self::errorResponse(500, null, $exception->getMessage());
    }

}