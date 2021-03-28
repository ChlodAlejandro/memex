<?php
namespace Memex\Route\RouteTypes;

use Memex\Route\Route;

class RouteLink extends Route {


    function catch(string $path): bool {
        return false;
    }

    function execute() {

    }
}