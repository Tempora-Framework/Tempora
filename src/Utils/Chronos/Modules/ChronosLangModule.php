<?php

namespace Tempora\Utils\Chronos\Modules;

use Tempora\Utils\Chronos\ChronosModule;
use Tempora\Utils\ElementBuilder\ElementBuilder;
use Tempora\Utils\Lang;

class ChronosLangModule extends ChronosModule {
	private Lang $lang;
	private int $total;
	private int $rest;

	public function __construct() {
		$this->id = "chronos_langs";
		$this->lang = new Lang(filePath: "chronos/chronos", source: TEMPORA_DIR . "/src/assets");
		$this->total = $GLOBALS["chronos"]["lang_count"];
		$this->rest = $this->total - $GLOBALS["chronos"]["lang_error_count"];

		$this->title = $this->lang->translate(key: "CHRONOS_LANG_TITLE");
		$this->icon = "ri-global-line";
		$this->additionalClass = $this->total - $this->rest > 0 ? "red" : "";
		$this->color = "#6e42c1";
	}

	public function getContent(): ElementBuilder {
		return (new ElementBuilder)
			->setElement(element: "table")
			->setContent(
				content:
					(function (): string {
						ksort(array: $GLOBALS["chronos"]["langs"]);

						$tableContent = "
							<thead>
								<tr>
									<th>" . $this->lang->translate(key: "CHRONOS_NAME") . "</th>
									<th>" . $this->lang->translate(key: "CHRONOS_VALUE") . "</th>
								</tr>
							</thead>
							<tbody>
						";

						foreach ($GLOBALS["chronos"]["langs"] as $key => $value) {
							$tableContent .= "
									<tr>
										<td " . ($value === $key ? " class='red'" : "") . ">" . $key . "</td>
										<td " . ($value === $key ? " class='red'" : "") . ">" . $value . "</td>
									</tr>
								</tbody>
							";
						}

						return $tableContent;
					})()
			)
		;
	}

	public function setDisplay(): string {
		return $this->rest . "/" . $this->total;
	}
}
