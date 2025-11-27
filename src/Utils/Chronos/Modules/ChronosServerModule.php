<?php

namespace Tempora\Utils\Chronos\Modules;

use Tempora\Utils\Chronos\ChronosModule;
use Tempora\Utils\ElementBuilder\ElementBuilder;
use Tempora\Utils\Lang;

class ChronosServerModule extends ChronosModule {
	public function __construct() {
		$this->title = Lang::translate(key: "CHRONOS_SERVER_TITLE");
		$this->icon = "ri-server-line";
	}

	public function getContent(): ElementBuilder {
		return (new ElementBuilder)
			->setElement(element: "table")
			->setContent(
				content:
					parent::createTitleElement(title: $this->title)->build()
					. (function (): string {
						$tableContent = "";
						foreach ($_SERVER as $key => $value) {
							$tableContent .= "<tr>
								<td>" . htmlspecialchars(string: $key) . "</td>
								<td>" . htmlspecialchars(string: print_r(value: $value, return: true)) . "</td>
							</tr>";
						}

						return $tableContent;
					})()
			)
		;
	}

	public function setDisplay(): string {
		return count(value: $_SERVER);
	}
}
