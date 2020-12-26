<?php

/**
 * Class Route
 *
 * A Route is a class that checks a given URL path and redirects it into the proper flow
 * which is responsible for handling paths that match the given URL.
 */
abstract class Route {

    abstract function catch(string $path) : boolean;
    abstract function execute();

}