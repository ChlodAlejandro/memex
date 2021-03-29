<?php
namespace Memex\Route\RouteTypes;

use Memex\Pages\PageLoader;
use Memex\Route\Route;

/**
 * Class RouteMain
 *
 * For handling the index page.
 */
class RouteMain extends Route {

    function catch(string $path): bool {
        return $path == "/"
            || preg_match("#^/index(\.(php|html))?$#", $path);
    }

    function execute() {
        PageLoader::loadPage("landing");
    }

}