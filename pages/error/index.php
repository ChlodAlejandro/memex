<?php
// https://gist.github.com/henriquemoody/6580488
$http_errors = [
	200 => 'Error Page Found',
    400 => 'Bad Request',
    401 => 'Unauthorized', // RFC 7235
    402 => 'Payment Required',
    403 => 'Forbidden',
    404 => 'Not Found',
    405 => 'Method Not Allowed',
    406 => 'Not Acceptable',
    407 => 'Proxy Authentication Required', // RFC 7235
    408 => 'Request Timeout',
    409 => 'Conflict',
    410 => 'Gone',
    411 => 'Length Required',
    412 => 'Precondition Failed', // RFC 7232
    413 => 'Payload Too Large', // RFC 7231
    414 => 'URI Too Long', // RFC 7231
    415 => 'Unsupported Media Type', // RFC 7231
    416 => 'Range Not Satisfiable', // RFC 7233
    417 => 'Expectation Failed',
    418 => 'I\'m a teapot', // RFC 2324, RFC 7168
    421 => 'Misdirected Request', // RFC 7540
    422 => 'Unprocessable Entity', // WebDAV; RFC 4918
    423 => 'Locked', // WebDAV; RFC 4918
    424 => 'Failed Dependency', // WebDAV; RFC 4918
    425 => 'Too Early', // RFC 8470
    426 => 'Upgrade Required',
    428 => 'Precondition Required', // RFC 6585
    429 => 'Too Many Requests', // RFC 6585
    431 => 'Request Header Fields Too Large', // RFC 6585
    451 => 'Unavailable For Legal Reasons', // RFC 7725
    500 => 'Internal Server Error',
    501 => 'Not Implemented',
    502 => 'Bad Gateway',
    503 => 'Service Unavailable',
    504 => 'Gateway Timeout',
    505 => 'HTTP Version Not Supported',
    506 => 'Variant Also Negotiates', // RFC 2295
    507 => 'Insufficient Storage', // WebDAV; RFC 4918
    508 => 'Loop Detected', // WebDAV; RFC 5842
    510 => 'Not Extended', // RFC 2774
    511 => 'Network Authentication Required', // RFC 6585
];
ob_clean();

$status = isset($_SERVER["REDIRECT_STATUS"]) ? $_SERVER["REDIRECT_STATUS"] : 200;
?>
<!doctype html>
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
            <h1><?php
				echo $http_errors[$status];
			?></h1>
            <p>Perhaps you would like to <a href="<?php echo $_SERVER["HTTP_REFERER"] ?? "/" ?>">go back</a>?</p>
        </main>

        <footer>
            <a href="<?php echo MEMEX_HOMEPAGE ?>">Memex</a> &ndash; the simple URL shortener. <a href="<?php echo MEMEX_LICENSE_LINK ?>">Free and open-source.</a>
        </footer>

    </body>
</html>