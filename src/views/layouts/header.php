<?php
	use App\Utils\Lang;
?>

<html lang="<?= Lang::translate(key: "MAIN_LANG") ?>" data-theme="<?= $_ENV["DEFAULT_THEME"] ?>">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title><?= $GLOBALS["title"] ?? APP_NAME . " - " . Lang::translate(key: "MAIN_ERROR") ?></title>
	<link rel="stylesheet" href="/styles/main.css">
	<?php
		if (isset($scripts)) {
			foreach ($scripts as $script) {
	?>
				<script defer src="<?= $script ?>"></script>
	<?php
			}
		}
	?>
</head>
<body>
	<main>
	<noscript>
		<div class="no_script">
			<?= Lang::translate(key: "MAIN_NO_SCRIPT") ?>
		</div>
	</noscript>
