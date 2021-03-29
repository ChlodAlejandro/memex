<?php
namespace Memex\API;

use Memex\API\Configuration\APIRouteConfiguration;
use Memex\API\Error\APIRouteNotFound;

class APIRoutes {

    public static function getApiRoutes(): array {
        return [
            new APIRouteConfiguration(),

            new APIRouteNotFound()
        ];
    }

}