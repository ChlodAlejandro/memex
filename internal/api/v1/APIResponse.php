<?php

namespace Memex\API;

use Exception;

class APIResponse {

    static function response($code = 200, $data = []) : void {
        http_response_code($code);

        $responseData = [
            "error" => false,
            "timestamp" => time()
        ];
        if ($code < 400) {
            $responseData["error"] = true;
        }

        ob_clean();
        header("Content-Type: application/json");
        echo json_encode(array_merge($responseData, $data));
    }

    static function ok($data) {
        self::response(200, $data);
    }

    static function error($code, $data) {
        self::response($code, $data);
    }

    static function exception(Exception $exception) {
        self::response(500, $exception->getMessage());
    }

}