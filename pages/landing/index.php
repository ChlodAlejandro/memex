<?php
namespace Memex\Pages\Landing;

use Memex\Data\Configuration;
use Memex\Util\URLUtility;
?>
<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="UTF-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">

		<title>Memex</title>

		<base href="<?php echo URLUtility::guessRootUrl() ?>">

		<meta name="description" content="A simple URL shortener.">

		<meta name="og:title" property="og:title" content="Memex" />
		<meta name="og:description" property="og:description" content="A simple URL shortener." />
		<meta name="og:image" property="og:image" content="<?php
			// OpenGraph tags require absolute URLs.
			echo Configuration::$rootUrl;
		?>resources/memex-logo/memex-logo.512.png"/>
		<meta name="twitter:card" content="summary"/>
		<meta name="twitter:image" content="<?php
        	// OpenGraph tags require absolute URLs.
			echo Configuration::$rootUrl;
		?>resources/memex-logo/memex-logo.512.png"/>

		<link rel="shortcut" type="image/png" href="/favicon.ico">
		<link rel="icon" type="image/png" href="/favicon.ico">

		<link rel="stylesheet" type="text/css" href="/resources/styles/global.css">
		<link rel="stylesheet" type="text/css" href="/resources/styles/index.css">

		<link rel="stylesheet" type="text/css" href="/resources/third-party/material-web-components/min@10.0.0.css">
		<script src="/resources/third-party/material-web-components/min@10.0.0.js"></script>

		<script src="/resources/scripts/memex-core.js"></script>
        <?php if (Configuration::$requireAuth): ?>

        <?php else: ?>
		<script src="/resources/scripts/api/memex-api-linker.js"></script>
        <?php endif; ?>
	</head>
	<body class="landingPage">

		<header>
			<img id="banner" src="/resources/memex-banner.png" alt="Memex">
		</header>

		<div class="landingPage-content">
            <?php if (Configuration::$requireAuth): ?>
				login
            <?php else:
                include __DIR__ . "/components/landing_page_linker.php";
            endif; ?>
		</div>
	</body>
</html>