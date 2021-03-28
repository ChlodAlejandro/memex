<?php
namespace Memex\API;

use Memex\API\Configuration\GetConfiguration;

class APIRoutes {

    public static function getApiRoutes() : array {
        return [
            new GetConfiguration()
        ];
    }

}