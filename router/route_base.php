<?php

namespace Memex\Route;

/**
 * Class Route
 *
 * A Route is a class that checks a given URL path and redirects it into the proper flow
 * which is responsible for handling paths that match the given URL.
 */
abstract class Route {

    /**
     * Checks if the given path will be caught by this route.
     * @param string $path The path to check.
     * @return bool Whether or not this route will process this path.
     */
    abstract function catch(string $path) : bool;
    /**
     * Execute the route. This includes sending headers, output text, etc.
     */
    abstract function execute();

}


namespace Memex\Route\RouteTypes;

use Memex\Route\Route;
/**
 * Class RouteNotFound
 *
 * A Route which is called whenever there are no more available routes to try. This route
 * is automatically called upon by the router whenever all routes have returned a false
 * value for their checks - indicating that no route accepts the given path.
 */
class RouteNotFound extends Route {

    function catch(string $path): bool {
        return true;
    }

    function execute() {
        http_response_code(404);
    }

}