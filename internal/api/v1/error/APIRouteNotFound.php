<?php
namespace Memex\API\Error;


use Memex\API\APIResponse;
use Memex\Route\Route;

class APIRouteNotFound extends Route {

    function catch(string $path): bool {
        return substr($path, 0, 8) == "/api/v1/";
    }

    function execute() {
        APIResponse::error(404, "Not Found");
    }

}