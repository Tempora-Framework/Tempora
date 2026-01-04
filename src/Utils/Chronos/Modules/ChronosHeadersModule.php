<?php

namespace Tempora\Utils\Chronos\Modules;

use Tempora\Utils\Chronos\ChronosModule;
use Tempora\Utils\ElementBuilder\ElementBuilder;
use Tempora\Utils\Lang;

class ChronosHeadersModule extends ChronosModule {
	private Lang $lang;

	public function __construct() {
		$this->id = "chronos_headers";
		$this->lang = new Lang(filePath: "chronos/chronos", source: TEMPORA_DIR . "/src/assets");
		$this->title = $this->lang->translate(key: "CHRONOS_HEADER_TITLE");
		$this->icon = "ri-layout-row-fill";
		$this->color = "#e4671fff";
	}

	/**
	 * Get content
	 *
	 * @return ElementBuilder
	 */
	public function getContent(): ElementBuilder {
		return (new ElementBuilder)
			->setElement(element: "table")
			->setContent(
				content:
					(function (): string {
						$tableContent = "
							<thead>
								<tr>
									<th>" . $this->lang->translate(key: "CHRONOS_NAME") . "</th>
								</tr>
							</thead>
							<tbody>
						";

						foreach (headers_list() as $value) {
							$tableContent .= "
									<tr>
										<td>" . htmlspecialchars(string: print_r(value: $value, return: true)) . "</td>
									</tr>
								</tbody>
							";
						}

						return $tableContent;
					})()
			)
		;
	}

	/**
	 * Set display
	 *
	 * @return int
	 */
	public function setDisplay(): string {
		return count(value: headers_list());
	}
}
