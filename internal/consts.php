<?php

define("MEMEX_LICENSE", "Apache License 2.0");
define("MEMEX_LICENSE_LINK", "https://github.com/ChlodAlejandro/memex/blob/master/LICENSE");
define("MEMEX_HOMEPAGE", "https://github.com/ChlodAlejandro/memex");

require_once __DIR__ . "/fallback.php";

// Disable `settings.php` loading if installing or troubleshooting.
if (!defined("POWERHOUSE_TROUBLESHOOTING")
    && !defined("POWERHOUSE_INSTALLING")
    && !defined("POWERHOUSE_SKIP_ENV")) {
    if (!file_exists(__DIR__ . "/../settings.php")) {
        handleFatal("settings.php does not exist. Please configure Memex first.<br/>" .
            "<a href=\"/setup\">Click here to begin the setup.</a>");
    } else {
        try {
            set_error_handler(function() {
                handleFatal("There is an issue with this Memex installation.<br/>Please double-check your configuration.");
            });
            include_once __DIR__ . "/../settings.php";
            restore_error_handler();
        } catch (Exception $e) {
            handleFatal("There is an error with this Memex installation.<br/>Please double-check your configuration.");
        }

        // Verify the configuration values.
    }
}