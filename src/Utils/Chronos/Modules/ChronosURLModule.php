<?php

namespace Tempora\Utils\Chronos\Modules;

use Tempora\Utils\Chronos\ChronosModule;
use Tempora\Utils\ElementBuilder\ElementBuilder;
use Tempora\Utils\Lang;
use Tempora\Utils\Roles;
use Tempora\Utils\Route;
use Tempora\Utils\System;

class ChronosURLModule extends ChronosModule {
	private Lang $lang;
	private Lang $mainLang;
	private array $controllers = [];

	public function __construct() {
		$this->id = "chronos_url";
		$this->lang = new Lang(filePath: "chronos/chronos", source: TEMPORA_DIR . "/src/assets");
		$this->mainLang = new Lang(filePath: "main", source: TEMPORA_DIR . "/src/assets");
		$this->title = $this->lang->translate(key: "CHRONOS_URL_TITLE");
		$this->icon = "ri-link-m";
		$this->color = "#ce3769";

		foreach (System::getAllFiles(path: APP_DIR . "/src/Controllers") as $controller) {
			$controller = Route::getController(controller: $controller);
			$routeAttributes = Route::getAttributes(controller: $controller);

			if (count(value: $routeAttributes) > 0) {
				$routeAttribute = $routeAttributes[0]->newInstance();
			}

			// Check if not already present, appears sometimes
			if (!in_array(needle: $routeAttribute, haystack: $this->controllers)) {
				$this->controllers[] = $routeAttribute;
			}
		}
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
									<th>" . $this->lang->translate(key: "CHRONOS_METHOD_TITLE") . "</th>
									<th>" . $this->lang->translate(key: "CHRONOS_URL_TITLE") . "</th>
									<th>" . $this->lang->translate(key: "CHRONOS_CONTROLLER_TITLE") . "</th>
									<th>" . $this->lang->translate(key: "CHRONOS_DESCRIPTION") . "</th>
									<th>" . $this->lang->translate(key: "CHRONOS_NEEDLOGINTOBE") . "</th>
									<th>" . $this->lang->translate(key: "CHRONOS_ACCESSROLES") . "</th>
								</tr>
							</thead>
							<tbody>
						";

						foreach ($this->controllers as $controller) {
							$accessRoles = $controller->accessRoles ? array_map(
								callback: function ($role): mixed {
									return Roles::getRoleName($role->value);
								},
								array: $controller->accessRoles
							) : [];

							$tableContent .= "
								<tr style='font-weight: " . (array_key_exists('page_name', $this->pageData) && $controller->name == $this->pageData['page_name'] ? "bold" : "normal") . ";'>
									<td>" . $controller->name . "</td>
									<td>" . $controller->method . "</td>
									<td>" . ($controller->method === "GET" ? "<a href='" . ($controller->path ? $controller->path : "/") . "' >" : "") . ($controller->path ? $controller->path : "/") . "</a></td>
									<td>" . $controller->title . "</td>
									<td>" . $controller->description . "</td>
									<td>" . ($controller->needLoginToBe ?? false ? $this->mainLang->translate(key: "MAIN_YES") : $this->mainLang->translate(key: "MAIN_NO")) . "</td>
									<td>" . implode(separator: ", ", array: $accessRoles) . "</td>
								</tr>
							";
						}

						$tableContent .= "
							</tbody>
						";

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
		return count(value: $this->controllers);
	}
}
