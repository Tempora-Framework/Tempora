<?php

namespace Tempora\Utils\Chronos\Modules;

use Tempora\Traits\UserTrait;
use Tempora\Utils\Chronos\ChronosModule;
use Tempora\Utils\ElementBuilder\ElementBuilder;
use Tempora\Utils\Lang;
use Tempora\Utils\Roles;

class ChronosUserModule extends ChronosModule {
	use UserTrait;

	private Lang $lang;
	private Lang $mainLang;
	private array $roleFormat = [];
	private array $userInfo = [];

	public function __construct() {
		if (
			!isset($_SESSION["user"]["uid"])
			|| !defined(constant_name: "USER_ROLES")
		) {
			$this->enabled = false;

			return;
		}

		$this->id = "chronos_user";
		$this->lang = new Lang(filePath: "chronos/chronos", source: TEMPORA_DIR . "/src/assets");
		$this->mainLang = new Lang(filePath: "main", source: TEMPORA_DIR . "/src/assets");

		foreach (USER_ROLES as $role) {
			$this->roleFormat[] = Roles::getRoleName(role: $role);
		}
		$this->userInfo = $this::getInformation(uid: $_SESSION["user"]["uid"]);

		$this->title = $this->lang->translate(key: "CHRONOS_USER_TITLE");
		$this->icon = "ri-user-line";
		$this->color = "#009b6cff";
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
						return "
							<thead>
								<tr>
									<th>" . $this->lang->translate(key: "CHRONOS_NAME") . "</th>
									<th>" . $this->lang->translate(key: "CHRONOS_VALUE") . "</th>
								</tr>
							</thead>
							<tbody>
								<tr>
									<td>UID</td>
									<td>" . $_SESSION["user"]["uid"] . "</td>
								</tr>
								<tr>
									<td>" . $this->mainLang->translate(key: "MAIN_EMAIL") . "</td>
									<td>" . ($this->userInfo["email"] ?? "") . "</td>
								</tr>
								<tr>
									<td>" . $this->mainLang->translate(key: "MAIN_NAME") . "</td>
									<td>" . ($this->userInfo["name"] ?? "") . "</td>
								</tr>
								<tr>
									<td>" . $this->mainLang->translate(key: "MAIN_SURNAME") . "</td>
									<td>" . ($this->userInfo["surname"] ?? "") . "</td>
								</tr>
								<tr>
									<td>" . $this->mainLang->translate(key: "MAIN_ROLE") . "</td>
									<td>" . join(array: $this->roleFormat, separator: ", ") . "</td>
								</tr>
							</tbody>
						";
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
