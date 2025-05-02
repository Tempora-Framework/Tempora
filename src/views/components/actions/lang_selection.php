<?php
	use Tempora\Enums\Path;
	use Tempora\Utils\ElementBuilder\Select;
	use Tempora\Utils\Lang;
	use Tempora\Utils\System;
?>

<?php
	$options = [];
	foreach (System::getFiles(path: Path::PUBLIC->value . "/langs") as $file) {
		$file = str_replace(search: ".json", replace: "", subject: $file);
		$options[$file] = Lang::nameFormat(name: $file);
	}

	$select = new Select;
	$select
		->setAttributs(
			attributs: [
				"class" => "lang_selection",
				"id" => "lang_selection",
				"label" => Lang::translate(key: "ACCESSIBILITY_LANG"),
			]
		)
		->setAccessibility(accessibility: true)
		->setOptions(options: $options)
		->setSelected(selected: $_COOKIE["LANG"])
		->setTranslate(translate: false)
	;
?>

<?= $select->build() ?>
