<?php

namespace Tempora\Utils\Chronos\Modules;

use Tempora\Utils\Chronos\ChronosModule;
use Tempora\Utils\ElementBuilder\ElementBuilder;
use Tempora\Utils\Lang;

class ChronosHttpCodeModule extends ChronosModule {
	public function __construct($httpCode) {
		$httpCodeType = substr(string: $httpCode, offset: 0, length: 1);
		$httpCodeClass = match ($httpCodeType) {
			"1" => "blue",
			"2" => "green",
			"3" => "yellow",
			"4", "5" => "red"
		};

		$this->title = Lang::translate(key: "CHRONOS_HTTP_CODE_TITLE");
		$this->icon = "ri-code-line";
		$this->displayValue = $httpCode;
		$this->additionalClass = $httpCodeClass . " bold";
	}

	public function getContent(): ElementBuilder {
		return (new ElementBuilder)
			->setElement(element: "table")
			->setContent(
				content:
					parent::createTitleElement(title: $this->title)->build()
					. (function (): string {
						$tableContent = "<table>
							<tr>
								<td>Request method</td>
								<td>" . $_SERVER["REQUEST_METHOD"] . "</td>
							</tr>
							<tr>
								<td>Request URI</td>
								<td>" . $_SERVER["REQUEST_URI"] . "</td>
							</tr>
							<tr>
								<td>" . Lang::translate(key: "MAIN_NAME_OBJECT") . "</td>
								<td>" . ($this->pageData["page_name"] ?? "") . "</td>
							</tr>
						</table>";

						return $tableContent;
					})()
			)
		;
	}

	public function setDisplay(): string {
		return $this->displayValue;
	}
}
