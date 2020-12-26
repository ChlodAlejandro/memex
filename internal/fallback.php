<?php

function handleFatal(string $reason) {
    $sapi_type = php_sapi_name();
    if (substr($sapi_type, 0, 3) == "cgi" || substr($sapi_type, 0, 3) == "cli")
        die($reason);
    else { ?>
<!doctype html>
<html lang="en">
	<head>
		<meta charset="UTF-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">

		<title>Error | Memex</title>

		<style>
			body {
				box-sizing: border-box;
				margin: 0;
				padding: 16px;
				min-height: 100vh;

				font-family: sans-serif;
				background-color: #eee;
			}

			.flex-centered {
                display: flex;
                flex-direction: column;
                justify-content: center;
                align-items: center;
			}

			header {
				text-align: center;
			}

			header * {
                pointer-events: none;
			}

			#logo {
				min-width: 150px;
				width: 12.5vw;
			}

			#wordmark {
				min-width: 250px;
				width: 17.5vw;
				margin: 16px 0;
			}

			main {
				margin: 16px 0;
				padding: 32px;
				border: 1px solid #bbb;
				border-radius: 8px;
				background-color: #fff;

				text-align: center;
			}

            main :first-child {
                margin-top: 0;
            }

            main :last-child {
                margin-bottom: 0;
            }

			footer {
                font-size: small;
			}

			footer a {
				color: #222;
			}
		</style>
	</head>
	<body class="flex-centered">

		<header class="flex-centered">
			<img id="logo" src="/resources/memex-logo/memex-logo.512.png">
			<img id="wordmark" src="/resources/memex-wordmark.svg">
		</header>

		<main>
			<p>An error occurred while loading Memex. This may be due to an issue with your installation configuration.</p>
			<p>The following details were provided:</p>
			<pre><?php echo $reason ?></pre>
		</main>

		<footer>
			<a href="<?php echo MEMEX_HOMEPAGE ?>">Memex</a> &ndash; the simple URL shortener. <a href="<?php echo MEMEX_LICENSE_LINK ?>">Free and open-source.</a>
		</footer>

	</body>
</html>
<?php }
}
?>