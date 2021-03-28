<?php
namespace Memex\Pages;

class PageLoader {

    public static function loadPage($name, $file = null) {
        /** @noinspection PhpIncludeInspection */
        include realpath(
            __DIR__ . "/../../pages/" . $name . "/" . (isset($file) ? $file : "index.php")
        );
    }

}