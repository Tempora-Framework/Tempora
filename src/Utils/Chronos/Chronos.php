<?php

namespace Tempora\Utils\Chronos;

use Tempora\Enums\Path;
use Tempora\Utils\ElementBuilder\ElementBuilder;

class Chronos {
	public function __construct(array $pageData = [], array $modules = []) {
		include Path::COMPONENT_CHRONOS->value . "/chronos_title.php";

		foreach ($modules as $module) {
			if (
				$module instanceof ChronosModule
				&& $module->enabled
			) {
				$module->pageData = $pageData;
				$module->render();
			}
		}

		echo (new ElementBuilder)
			->setElement(element: "i")
			->setAttributs(
				attributs: [
					"class" => "ri-close-large-line chronos_close",
					"id" => "chronos_close"
				]
			)
			->build()
		;
	}
}
