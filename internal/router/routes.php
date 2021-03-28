<?php
namespace Memex\Route;

use Memex\Route\RouteTypes\RouteError;
use Memex\Route\RouteTypes\RouteMain;
use Memex\Route\RouteTypes\RouteNotFound;

/**
 * Routes the current HTTP request into the proper script.
 */
class Router {

    public static function routeRequest() {
        $routes = [
            new RouteError(),
            new RouteMain()
        ];

        foreach ($routes as $route) {
            if ($route->catch($_SERVER["REQUEST_URI"])) {
                $route->execute();
                return;
            }
        }

        // A route was not found. Sentence them to the 404 page.
        (new RouteNotFound())->execute();
    }

}