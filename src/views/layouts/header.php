<?php
	use App\Utils\Lang;
?>

<html lang="<?= Lang::translate("MAIN_LANG") ?>" data-theme="light">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title><?= isset($GLOBALS["title"]) ? $GLOBALS["title"] : APP_NAME . " - " . Lang::translate("MAIN_ERROR")?></title>
	<link rel="stylesheet" href="/styles/main.css">
</head>
<body>
	<noscript>
		<div class="no_script">
			<?= Lang::translate(key: "MAIN_NO_SCRIPT") ?>
		</div>
	</noscript>
