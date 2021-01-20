<?php
require_once __DIR__ . "/route_base.php";

/**
 * Class RouteMain
 *
 * For handling the index page.
 */
class RouteMain extends Route {

    function catch(string $path): bool {
        return $path == "/"
            || preg_match("#\/index(\.(php|html))?#", $path);
    }

    function execute() {
        require_once __DIR__ . "/../pages/landing_page.php";
    }
}