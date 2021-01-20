<?php

require_once __DIR__ . "/route_base.php";
require_once __DIR__ . "/route_error.php";
require_once __DIR__ . "/route_main.php";

/**
 * Routes the current HTTP request into the proper script.
 */
function mx_route() {

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

    // A route was not found. Send to 404 page.
    (new RouteNotFound())->execute();

}