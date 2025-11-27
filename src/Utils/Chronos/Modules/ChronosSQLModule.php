<?php

namespace Tempora\Utils\Chronos\Modules;

use Tempora\Utils\Chronos\ChronosModule;
use Tempora\Utils\ElementBuilder\ElementBuilder;
use Tempora\Utils\Lang;

class ChronosSQLModule extends ChronosModule {
	private int $tempSQLCount = 0;
	private int $chronosSQLCount;

	public function __construct() {
		$this->chronosSQLCount = 0;
		if (isset($_SESSION["user"]["uid"])) {
			$this->chronosSQLCount = 1;

			for ($i = 0; $i < $this->chronosSQLCount; $i++) {
				array_pop(array: $GLOBALS["chronos"]["sql_query"]);
			}
		}

		$tempSQL = [];

		foreach ($GLOBALS["chronos"]["sql_query"] as $value) {
			if (in_array(needle: $value["query"], haystack: $tempSQL)) {
				$this->tempSQLCount++;
			} else {
				array_push($tempSQL, $value["query"]);
			}
		}

		$this->title = Lang::translate(key: "CHRONOS_SQL_TITLE");
		$this->icon = "ri-database-2-line";
		$this->additionalClass = ($this->tempSQLCount > 0 ? " yellow" : "");
	}

	public function getContent(): ElementBuilder {
		return (new ElementBuilder)
			->setElement(element: "table")
			->setContent(
				content:
					parent::createTitleElement(title: $this->title)->build()
					. (function (): string {
						$tableContent = "";
						foreach ($GLOBALS["chronos"]["sql_query"] as $value) {
							$tableContent .= '<tr>
								<td class="min_col">' . $value["time"] . "ms</td>
								<td>" . ($value["class"] ?? "") . '</td>
								<td class="min_col">Line ' . $value["line"] . '</td>
								<td class="min_col">' . $value["query"] . "</td>
							</tr>";
						}

						return $tableContent;
					})()
			)
		;
	}

	public function setDisplay(): string {
		return $GLOBALS["chronos"]["sql_count"] - $this->chronosSQLCount . " " . ($this->tempSQLCount > 0 ? "(" . $this->tempSQLCount . '<i class="ri-arrow-up-double-line"></i>)' : "");
	}
}
