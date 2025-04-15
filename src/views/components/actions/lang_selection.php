<?php
	use App\Enums\Path;
	use App\Utils\ElementBuilder\Select;
	use App\Utils\Lang;
	use App\Utils\System;
?>

<?php
	$options = [];
	foreach (System::getFiles(path: Path::PUBLIC->value . "/langs") as $file) {
		$file = str_replace(search: ".json", replace: "", subject: $file);
		$options[$file] = Lang::nameFormat(name: $file);
	}

	$select = new Select;
	$select
		->setClass(class: "lang_selection")
		->setId(id: "lang_selection")

		->setOptions(options: $options)
		->setSelected(selected: $_COOKIE["LANG"])
		->setTranslate(translate: false)
	;
	$select->build();
?>
