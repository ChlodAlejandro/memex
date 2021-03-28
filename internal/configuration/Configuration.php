<?php
namespace Memex\Data;

use Exception;
use Memex\Errors\ErrorHandler;
use Memex\Util\URLUtility;
use ReflectionClass;
use ReflectionException;
use ReflectionProperty;

class Configuration
{
    /**
     * @var bool Whether or not authentication is required before login.
     * @setting mxRequireAuth
     */
    public static $requireAuth = false;

    /**
     * @var string The root URL of this Memex installation.
     * @setting mxRootUrl
     */
    public static $rootUrl = null;

    /**
     * Set the default values for some configuration settings which
     * require expressions as their default values.
     */
    public static function setSpecialDefaults() {
        Configuration::$rootUrl = URLUtility::guessRootUrl();
    }

    public static function loadConfiguration() {
        Configuration::setSpecialDefaults();

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

                Configuration::applyConfiguration(get_defined_vars());
            }
        }
    }

    public static function applyConfiguration($configurationVariables) {
        $refClass = new ReflectionClass("Memex\Data\Configuration");
        foreach ($refClass->getStaticProperties() as $property => $default) {
            try {
                $refProp = new ReflectionProperty("Memex\Data\Configuration", $property);
                preg_match("#@setting (.*?)\n#s", $refProp->getDocComment(), $docSetting);
                $setting = trim($docSetting[1]);
                if (isset($configurationVariables[$setting])) {
                    $refProp->setValue(null, $configurationVariables[$setting]);
                }
            } catch (ReflectionException $e) {
                continue;
            }
        }
    }

}