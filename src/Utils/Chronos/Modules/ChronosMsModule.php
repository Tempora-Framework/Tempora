<?php

namespace Tempora\Utils\Chronos\Modules;

use Tempora\Utils\Chronos\ChronosModule;
use Tempora\Utils\ElementBuilder\ElementBuilder;
use Tempora\Utils\Lang;

class ChronosMsModule extends ChronosModule {
	private float $time;

	public function __construct() {
		$this->time = round(num: (microtime(as_float: true) - $GLOBALS["chronos"]["ms_count"]) * 1000, precision: 2);

		$this->title = Lang::translate(key: "CHRONOS_MS_TITLE");
		$this->icon = "ri-time-line";
	}

	public function getContent(): ElementBuilder {
		return (new ElementBuilder)
			->setElement(element: "table")
			->setContent(
				content:
				parent::createTitleElement(title: $this->title)->build()
				. (function (): string {
					return '<table class="chronos_minifier" cellpadding="0" cellspacing="0">
						<tr>
							<td class="min_col">' . APP_NAME . '</td>
							<td class="min_col">' . $this->time . "ms</td>
						</tr>
					</table>";
				})()
				. parent::createTitleElement(title: Lang::translate(key: "CHRONOS_MINIFIER_MS_TITLE"))->build()
				. (function (): string {
					$tableContent = '<table class="chronos_minifier" cellpadding="0" cellspacing="0">';
					foreach ($GLOBALS["chronos"]["minifier"] as $value) {
						$tableContent .= '<tr>
							<td class="min_col">' . htmlspecialchars(string: $value["file"]) . '</td>
							<td class="min_col">' . htmlspecialchars(string: $value["time"]) . "ms</td>
						</tr>";
					}
					$tableContent .= '<tr>
							<td class="min_col">' . Lang::translate(key: "MAIN_TOTAL") . '</td>
							<td class="min_col">' . array_sum(array_column(array: $GLOBALS["chronos"]["minifier"], column_key: "time")) . "ms</td>
						</tr>";
					$tableContent .= "</table>";

					return $tableContent;
				})()
				. parent::createTitleElement(title: Lang::translate(key: "CHRONOS_IMAGES_MS_TITLE"))->build()
				. (function (): string {
					$tableContent = '<table class="chronos_minifier" cellpadding="0" cellspacing="0">';
					foreach ($GLOBALS["chronos"]["images_ms"] as $value) {
						$tableContent .= '<tr>
							<td class="min_col">' . htmlspecialchars(string: $value["file"]) . '</td>
							<td class="min_col">' . htmlspecialchars(string: $value["time"]) . "ms</td>
						</tr>";
					}
					$tableContent .= '<tr>
							<td class="min_col">' . Lang::translate(key: "MAIN_TOTAL") . '</td>
							<td class="min_col">' . array_sum(array_column(array: $GLOBALS["chronos"]["images_ms"], column_key: "time")) . "ms</td>
						</tr>";
					$tableContent .= "</table>";

					return $tableContent;
				})()
				. parent::createTitleElement(title: Lang::translate(key: "CHRONOS_SQL_TITLE"))->build()
				. (function (): string {
					return '<table class="chronos_minifier" cellpadding="0" cellspacing="0">
						<tr>
							<td>' . Lang::translate(key: "MAIN_TOTAL") . "</td>
							<td>" . array_sum(array_column(array: $GLOBALS["chronos"]["sql_query"], column_key: "time")) . "ms</td>
						</tr>
					</table>";
				})()
			)
		;
	}

	public function setDisplay(): string {
		return $this->time . "ms";
	}
}
