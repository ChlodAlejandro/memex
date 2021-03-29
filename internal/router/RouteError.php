<?php
namespace Memex\Route\RouteTypes;

use Memex\Pages\PageLoader;
use Memex\Route\Route;

class RouteError extends Route {


    function catch(string $path): bool {
        return substr($path, 0, 6) == "/error";
    }

    function execute() {
        PageLoader::loadPage("error");
    }

}