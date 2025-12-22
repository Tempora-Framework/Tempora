<?php
use Tempora\Utils\Lang;

$lang = new Lang(filePath: "main/main");
?>

<!DOCTYPE html>
<html lang="<?= $lang->translate(key: "MAIN_LANG") ?>" data-theme="<?= $_ENV["DEFAULT_THEME"] ?>">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<?php if (isset($pageData["page_description"])) { ?>
		<meta name="description" content="<?= $pageData["page_description"] ?>">
	<?php } ?>

	<title><?= $pageData["page_title"] ?? "Tempora" ?></title>

	<?php $this->includeAssets(); ?>
	<?php $this->includePayloads(); ?>
</head>
<body>
	<main>
	<noscript>
		<div class="no_script">
			<?= $lang->translate(key: "MAIN_NO_SCRIPT") ?>
		</div>
	</noscript>
