<?php

namespace Tempora\Utils\Chronos\Modules;

use Tempora\Utils\Chronos\ChronosModule;
use Tempora\Utils\ElementBuilder\ElementBuilder;
use Tempora\Utils\Lang;

class ChronosPageDataModule extends ChronosModule {
	private Lang $lang;

	public function __construct() {
		$this->lang = new Lang(filePath: "chronos/chronos", source: TEMPORA_DIR . "/src/assets");
		$this->title = $this->lang->translate(key: "CHRONOS_PAGEDATA_TITLE");
		$this->icon = "ri-folder-2-line";
	}

	public function getContent(): ElementBuilder {
		return (new ElementBuilder)
			->setElement(element: "table")
			->setContent(
				content:
					parent::createTitleElement(title: $this->title)->build()
					. (function (): string {
						$tableContent = "";
						foreach ($this->pageData as $key => $value) {
							$tableContent .= "<tr>
								<td>" . $key . "</td>
								<td>" . htmlspecialchars(string: print_r(value: $value, return: true)) . "</td>
							</tr>";
						}

						return $tableContent;
					})()
			)
		;
	}

	public function setDisplay(): string {
		return count(value: $this->pageData);
	}
}
