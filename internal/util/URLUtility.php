<?php
namespace Memex\Util;

class URLUtility
{

    public static function guessRootUrl() {
        return ($_SERVER["HTTPS"] ? "https" : "http") . "://" . $_SERVER["HTTP_HOST"] . "/";
    }

}