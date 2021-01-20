<?php

// Define constants
define("MEMEX_DEBUG", true || $_ENV["MEMEX_DEBUG"] == "true");
define("MEMEX_LICENSE", "Apache License 2.0");
define("MEMEX_LICENSE_LINK", "https://github.com/ChlodAlejandro/memex/blob/master/LICENSE");
define("MEMEX_HOMEPAGE", "https://github.com/ChlodAlejandro/memex");

$mxRootUrl = ($_SERVER["HTTPS"] ? "https" : "http") . "://" . $_SERVER["HTTP_HOST"] . "/";

// Load fallback script
require_once __DIR__ . "/fallback.php";

// Handle errors
function mx_shutdown() {
    $lastError = null;
    if (($lastError = error_get_last()) != null) {
        switch ($lastError['type']) {
            case E_ERROR:
            case E_CORE_ERROR:
            case E_COMPILE_ERROR:
            case E_CORE_WARNING:
            case E_COMPILE_WARNING:
            case E_PARSE:
                $error = $lastError['message'] . (
                    MEMEX_DEBUG ? "<br/>File: " . $lastError['file'] . "[" . $lastError['line'] . "]" : ""
                    );
                mx_fatal_exit($error);
        }
    }

    if (http_response_code() >= 400) {
        $_SERVER["REDIRECT_STATUS"] = http_response_code();
        require_once __DIR__ . "/error.php";
    }
}
register_shutdown_function("mx_shutdown");

// Disable `settings.php` loading if installing or troubleshooting.
if (!defined("POWERHOUSE_TROUBLESHOOTING")
    && !defined("POWERHOUSE_INSTALLING")
    && !defined("POWERHOUSE_SKIP_ENV")) {
    if (!file_exists(__DIR__ . "/../settings.php")) {
        mx_fatal_exit("settings.php does not exist. Please configure Memex first.<br/>" .
            "<a href=\"/setup\">Click here to begin the setup.</a>");
    } else {
        try {
            // Attempt to load `settings.php`.
            set_error_handler(function(int $errno , string $errstr) {
                mx_fatal_exit("Memex is misconfigured: $errstr<br/>Please recheck your configuration.");
            });
            include_once __DIR__ . "/../settings.php";
            restore_error_handler();
        } catch (Exception $e) {
            mx_fatal_exit("Memex is misconfigured: " . $e->getMessage() . "<br/>Please recheck your configuration.");
        }

        // Verify the configuration values.
    }
}