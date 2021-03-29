<?php
namespace Memex\Errors;

use Memex\Pages\PageLoader;

class ErrorHandler {

    public static function shutdown() {
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
                    ErrorHandler::mx_fatal_exit($error);
            }
        }

        if (http_response_code() >= 400) {
            $_SERVER["REDIRECT_STATUS"] = http_response_code();
            PageLoader::loadPage("error");
        }
    }

    public static function mx_fatal_exit(string $reason) {
        $sapi_type = php_sapi_name();
        if (substr($sapi_type, 0, 3) != "cgi" && substr($sapi_type, 0, 3) != "cli") {
            if (!headers_sent())
                header("X-Memex-Error", $reason);
            ob_clean(); ?>
			<!DOCTYPE html>
			<html lang="en">
				<head>
					<meta charset="UTF-8">
					<meta name="viewport" content="width=device-width, initial-scale=1.0">

					<title>Error | Memex</title>

					<link rel="stylesheet" type="text/css" href="/resources/styles/global.css">
					<link rel="stylesheet" type="text/css" href="/resources/styles/error.css">
				</head>
				<body class="flex-centered">

					<header class="flex-centered">
						<img id="logo" src="/resources/memex-logo/memex-logo.512.png" alt="Memex logo">
						<img id="wordmark" src="/resources/memex-wordmark.svg" alt="Memex">
					</header>

					<main>
						<p>An error occurred while loading Memex. This may be due to an issue with your installation
							configuration.</p>
						<p>The following details were provided:</p>
						<pre><?php echo $reason ?></pre>
					</main>

					<footer>
						<a href="<?php echo MEMEX_HOMEPAGE ?>">Memex</a> &ndash; the simple URL shortener. <a
								href="<?php echo MEMEX_LICENSE_LINK ?>">Free and open-source.</a>
					</footer>

				</body>
			</html>
            <?php
            error_log($reason);
            die();
        } else {
            die($reason);
        }
    }

}
