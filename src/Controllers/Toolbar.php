<?php

namespace Tempora\Controllers;

use Tempora\Enums\Path;
use Tempora\Enums\Role;
use Tempora\Traits\UserTrait;

class Toolbar {

	use UserTrait;

	public function __invoke(array $pageData): void {
		$toolbarSQLCount = 0;
		if (isset($_SESSION["user"]["uid"])) {
			$toolbarSQLCount = 1;
			$userInfo = $this::getInformations(uid: $_SESSION["user"]["uid"]);

			$roleFormat = [];
			foreach (USER_ROLES as $role) {
				array_push($roleFormat, Role::from(value: $role)->name);
			}

			for ($i = 0; $i < $toolbarSQLCount; $i++) {
				array_pop(array: $GLOBALS["toolbar"]["sql_query"]);
			}
		}

		include Path::COMPONENT_TOOLBAR->value . "/toolbar_title.php";
		include Path::COMPONENT_TOOLBAR->value . "/toolbar_ms.php";
		include Path::COMPONENT_TOOLBAR->value . "/toolbar_httpcode.php";
		include Path::COMPONENT_TOOLBAR->value . "/toolbar_user.php";
		include Path::COMPONENT_TOOLBAR->value . "/toolbar_sql.php";
		include Path::COMPONENT_TOOLBAR->value . "/toolbar_session.php";
		include Path::COMPONENT_TOOLBAR->value . "/toolbar_pagedata.php";
		include Path::COMPONENT_TOOLBAR->value . "/toolbar_get.php";
		include Path::COMPONENT_TOOLBAR->value . "/toolbar_post.php";
		include Path::COMPONENT_TOOLBAR->value . "/toolbar_cookie.php";
		include Path::COMPONENT_TOOLBAR->value . "/toolbar_lang.php";
	}
}
