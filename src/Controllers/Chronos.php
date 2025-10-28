<?php

namespace Tempora\Controllers;

use Tempora\Enums\Path;
use Tempora\Enums\Role;
use Tempora\Traits\UserTrait;
use Tempora\Utils\ElementBuilder\ElementBuilder;

class Chronos {
	use UserTrait;

	public function __invoke(array $pageData = []): void {
		$chronosSQLCount = 0;
		if (isset($_SESSION["user"]["uid"])) {
			$chronosSQLCount = 1;
			$userInfo = $this::getInformation(uid: $_SESSION["user"]["uid"]);

			$roleFormat = [];
			foreach (USER_ROLES as $role) {
				if (Role::tryFrom(value: $role) !== null) {
					array_push($roleFormat, Role::from(value: $role)->name);
				} else {
					array_push($roleFormat, $role);
				}
			}

			for ($i = 0; $i < $chronosSQLCount; $i++) {
				array_pop(array: $GLOBALS["chronos"]["sql_query"]);
			}
		}

		include Path::COMPONENT_CHRONOS->value . "/chronos_title.php";
		include Path::COMPONENT_CHRONOS->value . "/chronos_ms.php";
		include Path::COMPONENT_CHRONOS->value . "/chronos_httpcode.php";
		include Path::COMPONENT_CHRONOS->value . "/chronos_user.php";
		include Path::COMPONENT_CHRONOS->value . "/chronos_sql.php";
		include Path::COMPONENT_CHRONOS->value . "/chronos_dumps.php";
		include Path::COMPONENT_CHRONOS->value . "/chronos_session.php";
		include Path::COMPONENT_CHRONOS->value . "/chronos_server.php";
		include Path::COMPONENT_CHRONOS->value . "/chronos_env.php";
		if ($pageData != []) {
			include Path::COMPONENT_CHRONOS->value . "/chronos_pagedata.php";
		}
		include Path::COMPONENT_CHRONOS->value . "/chronos_get.php";
		include Path::COMPONENT_CHRONOS->value . "/chronos_post.php";
		include Path::COMPONENT_CHRONOS->value . "/chronos_cookie.php";
		include Path::COMPONENT_CHRONOS->value . "/chronos_lang.php";

		echo (new ElementBuilder)
			->setElement(element: "i")
			->setAttributs(
				attributs: [
					"class" => "ri-close-large-line chronos_close",
					"id" => "chronos_close"
				]
			)
			->build()
		;
	}
}
