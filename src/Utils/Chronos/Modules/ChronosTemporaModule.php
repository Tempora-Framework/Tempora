<?php

namespace Tempora\Utils\Chronos\Modules;

use Tempora\Utils\Chronos\ChronosModule;
use Tempora\Utils\ElementBuilder\ElementBuilder;
use Tempora\Utils\Git;
use Tempora\Utils\Lang;

class ChronosTemporaModule extends ChronosModule {
	private Lang $lang;

	public function __construct() {
		$this->id = "chronos_tempora";
		$this->lang = new Lang(filePath: "chronos/chronos", source: TEMPORA_DIR . "/src/assets");
		$this->title = "Tempora";
		$this->icon = "ri-git-repository-line";
		$this->color = "#5879f7";
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
									<th>" . $this->lang->translate(key: "CHRONOS_VALUE") . "</th>
								</tr>
							</thead>
							<tbody>
								<tr>
									<td>Tempora</td>
									<td>" . TEMPORA_VERSION . "</td>
								</tr>
								<tr>
									<td>PHP</td>
									<td>v" . PHP_VERSION . "</td>
								</tr>
								<tr>
									<td>Server</td>
									<td>" . PHP_OS . " " . $_SERVER["SERVER_SOFTWARE"] . "</td>
								</tr>
								<tr>
									<td>Memory limit</td>
									<td>" . ini_get(option: "memory_limit") . "</td>
								</tr>
								<tr>
									<td>Memory usage</td>
									<td>" . round(num: memory_get_peak_usage() / 1048576, precision: 2) . "M</td>
								</tr>";

						if (is_dir(filename: APP_DIR . "/.git")) {
							$tableContent .= "<tr>
										<td>" . APP_NAME . ' Git branch</td>
										<td><a href="' . Git::getRepoUrl() . "/tree/" . Git::getBranch() . '" target="_blank">' . Git::getBranch() . ' <i class="ri-external-link-line"></i></a></td>
									</tr>
									<tr>
										<td>' . APP_NAME . ' Git commit</td>
										<td><a href="' . Git::getRepoUrl() . "/tree/" . Git::getCommit() . '" target="_blank">' . substr(string: Git::getCommit(), offset: 0, length: 7) . ' <i class="ri-external-link-line"></i></a></td>
									</tr>';
						}

						return $tableContent;
					})()
			)
		;
	}

	/**
	 * Set display
	 *
	 * @return string
	 */
	public function setDisplay(): string {
		return "";
	}
}
