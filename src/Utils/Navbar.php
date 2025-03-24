<?php

namespace App\Utils;

use App\Configs\Path;
use App\Models\Repositories\UserRepository;

class Navbar {
	private $navbar = [];

	/**
	 * Add navbar element
	 *
	 * @param string $title
	 * @param string $icon
	 * @param string $url
	 * @param string $class
	 * @param bool $needLoginToBe Does user have to be connected or have to be disconnected, null for no restrictions
	 * @param array $accessRoles Roles that can access item
	 *
	 * @return void
	 */
	public function add(string $title, string $url, string $class, string $icon = "", bool $needLoginToBe = null, array $accessRoles = []): void {
		array_push(
			$this->navbar,
			[
				"title" => $title,
				"icon" => $icon,
				"url" => $url,
				"class" => $class,
				"needLoginToBe" => $needLoginToBe,
				"accessRoles" => $accessRoles
			]
		);
	}

	/**
	 * Render navbar
	 *
	 * @return void
	 */
	public function render(): void {
		echo "<nav>";

		foreach ($this->navbar as $element) {
			if ($element["needLoginToBe"] === null) {
				include Path::COMPONENT_ACTIONS . "/navbar_item.php";
			} else {
				if ($element["needLoginToBe"] === true and isset($_SESSION["user"])) {
					if (
						$element["accessRoles"] === []
						|| Roles::check(userRoles: UserRepository::getRoles(uid: $_SESSION["user"]["uid"]), allowRoles: $element["accessRoles"])
					) {
						include Path::COMPONENT_ACTIONS . "/navbar_item.php";
					}
				}
				if ($element["needLoginToBe"] === false and !isset($_SESSION["user"])) {
					include Path::COMPONENT_ACTIONS . "/navbar_item.php";
				}
			}
		}

		include Path::COMPONENT_ACTIONS . "/theme_button.php";
		include Path::COMPONENT_ACTIONS . "/lang_selection.php";

		echo "</nav>";
	}
}
