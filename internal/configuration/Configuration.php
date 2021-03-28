<?php
namespace Memex\Data;

use Exception;
use Memex\Errors\ErrorHandler;

class Configuration
{


    public static function loadConfiguration() {
        if (!defined("MEMEX_TROUBLESHOOTING")
            && !defined("MEMEX_INSTALLING")
            && !defined("MEMEX_SKIP_ENV")) {
            if (!file_exists(__DIR__ . "/../../settings.php")) {
                ErrorHandler::mx_fatal_exit(
                    "settings.php does not exist. Please configure Memex first.<br/>" .
                    "<a href=\"/setup\">Click here to begin the setup.</a>"
                );
            } else {
                try {
                    // Attempt to load `settings.php`.
                    set_error_handler(function(int $errno , string $errstr) {
                        ErrorHandler::mx_fatal_exit(
                            "Memex is misconfigured: $errstr ($errno)<br/>" .
                            "Please recheck your configuration."
                        );
                    });
                    include_once __DIR__ . "/../../settings.php";
                    restore_error_handler();
                } catch (Exception $e) {
                    ErrorHandler::mx_fatal_exit(
                        "Memex is misconfigured: " . $e->getMessage() . "<br/>" .
                        "Please recheck your configuration."
                    );
                }

                // Verify the configuration values.
            }
        }
    }

}