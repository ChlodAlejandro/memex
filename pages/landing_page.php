<?php
namespace Memex\Pages\Landing;
global $mxRootUrl, $mxRequireAuth;
?>
<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="UTF-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">

		<title>Memex</title>

		<meta name="description" content="A simple URL shortener.">

		<meta name="og:title" property="og:title" content="Memex" />
		<meta name="og:description" property="og:description" content="A simple URL shortener." />
		<meta name="og:image" property="og:image" content="<?php echo $mxRootUrl; ?>resources/memex-logo/memex-logo.512.png"/>
		<meta name="twitter:card" content="summary"/>
		<meta name="twitter:image" content="<?php echo $mxRootUrl; ?>resources/memex-logo/memex-logo.512.png"/>

		<link rel="shortcut" type="image/png" href="/favicon.ico">
		<link rel="icon" type="image/png" href="/favicon.ico">

		<link rel="stylesheet" type="text/css" href="/resources/styles/global.css">
		<link rel="stylesheet" type="text/css" href="/resources/styles/index.css">

		<link rel="stylesheet" type="text/css" href="https://unpkg.com/material-components-web@latest/dist/material-components-web.min.css">
		<script src="https://unpkg.com/material-components-web@latest/dist/material-components-web.min.js"></script>

		<script src="/resources/scripts/memex-core.js"></script>
        <?php if ($mxRequireAuth): ?>

        <?php else: ?>
		<script src="/resources/scripts/api/memex-api-linker.js"></script>
        <?php endif; ?>
	</head>
	<body class="landingPage">

		<header>
			<img id="banner" src="/resources/memex-banner.png" alt="Memex">
		</header>

		<div class="landingPage-content">
            <?php if ($mxRequireAuth): ?>
				login
            <?php else:
                include __DIR__ . "/components/landing_page_linker.php";
            endif; ?>
		</div>
	</body>
</html>