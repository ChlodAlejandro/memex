<?php
namespace Memex\API\Configuration;

use Memex\API\APIResponse;
use Memex\Data\Configuration;
use Memex\Route\Route;

class GetConfiguration extends Route
{

    function catch(string $path): bool
    {
        return $path == "/api/v1/server/configuration/get";
    }

    function execute()
    {
        APIResponse::ok([
            "configuration" => Configuration::exportConfiguration()
        ]);
    }

}