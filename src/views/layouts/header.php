<?php
	use App\Utils\Lang;
?>

<!DOCTYPE html>
<html lang="<?= Lang::translate(key: "MAIN_LANG") ?>" data-theme="<?= $_ENV["DEFAULT_THEME"] ?>">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<?php if (isset($pageData["page_description"])) { ?>
		<meta name="description" content="<?= $pageData["page_description"] ?>">
	<?php } ?>

	<title><?= $pageData["page_title"] ?? APP_NAME . " - " . Lang::translate(key: "MAIN_ERROR") ?></title>
	<link rel="stylesheet" href="/styles/main.css">
	<link rel="stylesheet" href="/styles/remixicon.css">

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
