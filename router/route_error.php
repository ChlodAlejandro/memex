<?php
require_once __DIR__ . "/route_base.php";

class RouteError extends Route {


    function catch(string $path): bool {
        return substr($path, 0, 6) == "/error";
    }

    function execute() {
        require __DIR__ . "/../internal/error.php";
    }
}