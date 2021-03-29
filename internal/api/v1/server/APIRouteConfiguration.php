<?php
namespace Memex\API\Configuration;

use Memex\API\APIResponse;
use Memex\Data\Configuration;
use Memex\Route\Route;

class APIRouteConfiguration extends Route {

    function catch(string $path): bool {
        return preg_match("#^/api/v1/server/configuration$#", $path);
    }

    function execute() {
        APIResponse::ok([
            "configuration" => Configuration::exportConfiguration()
        ]);
    }

}