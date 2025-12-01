<?php

namespace Tempora\Utils\Chronos\Modules;

use Tempora\Enums\Role;
use Tempora\Traits\UserTrait;
use Tempora\Utils\Chronos\ChronosModule;
use Tempora\Utils\ElementBuilder\ElementBuilder;
use Tempora\Utils\Lang;

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

		$this->lang = new Lang(filePath: "chronos/chronos", source: TEMPORA_DIR . "/src/assets");
		$this->mainLang = new Lang(filePath: "main", source: TEMPORA_DIR . "/src/assets");

		foreach (USER_ROLES as $role) {
			if (Role::tryFrom(value: $role) !== null) {
				array_push($this->roleFormat, Role::from(value: $role)->name);
			} else {
				array_push($this->roleFormat, $role);
			}
		}
		$this->userInfo = $this::getInformation(uid: $_SESSION["user"]["uid"]);

		$this->title = $this->lang->translate(key: "CHRONOS_USER_TITLE");
		$this->icon = "ri-user-line";
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
								<td>UID</td>
								<td>" . $_SESSION["user"]["uid"] . '</td>
							</tr>
							<tr>
								<td>Session timeout</td>
								<td id="chronos_ms">' . ini_get(option: "session.gc_maxlifetime") . " s</td>
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
						</table>";

						return $tableContent;
					})()
			)
		;
	}

	public function setDisplay(): string {
		return "";
	}
}
