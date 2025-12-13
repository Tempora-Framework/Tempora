<?php

namespace Tempora\Utils\Chronos\Modules;

use Tempora\Utils\Chronos\ChronosModule;
use Tempora\Utils\ElementBuilder\ElementBuilder;
use Tempora\Utils\Lang;

class ChronosDumpModule extends ChronosModule {
	private Lang $lang;
	private string $tab;

	public function __construct() {
		$this->lang = new Lang(filePath: "chronos/chronos", source: TEMPORA_DIR . "/src/assets");
		if ($GLOBALS["chronos"]["dumps"] == []) {
			$this->enabled = false;

			return;
		}

		$this->tab = (new ElementBuilder)
			->setElement(element: "span")
			->setAttributs(attributs: ["class" => "tab"])
			->build()
		;

		$this->title = $this->lang->translate(key: "CHRONOS_DUMPS_TITLE");
		$this->icon = "ri-crosshair-2-line";
		$this->additionalClass = "yellow";
	}

	public function getContent(): ElementBuilder {
		return (new ElementBuilder)
			->setElement(element: "table")
			->setContent(
				content:
					parent::createTitleElement(title: $this->title)->build()
					. (function (): string {
						$tableContent = "
							<thead>
								<tr>
									<th>" . $this->lang->translate(key: "CHRONOS_LOCATION") . "</th>
									<th>" . $this->lang->translate(key: "CHRONOS_VALUE") . "</th>
								</tr>
							</thead>
							<tbody>
						";

						foreach ($GLOBALS["chronos"]["dumps"] as $value) {
							$result = "";

							if (is_array(value: $value["variable"]) || is_object(value: $value["variable"])) {
								$result = explode(separator: "\n", string: print_r(value: $value["variable"], return: true));
								foreach ($result as $key => $line) {
									$result[$key] = "<br>" . $this->tab . htmlspecialchars(string: $line);
								}
								$result = implode($result);
							} else {
								$result = $value["variable"];
							}

							$tableContent .= '
									<tr>
										<td class="min_col">' . $value["trace"] . '</td>
										<td class="min_col mono">' . print_r(value: $result, return: true) . "</td>
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
		return count(value: $GLOBALS["chronos"]["dumps"]);
	}
}
