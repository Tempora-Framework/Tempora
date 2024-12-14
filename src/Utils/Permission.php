<?php

namespace App\Utils;

use App\Controllers\ErrorController;
use App\Models\Repositories\UserRepository;

class Permission {

	/**
	 * Check access permissions
	 *
	 * @param boolean $login
	 * @param array $whitelist
	 *
	 * @return void
	 */
	public static function check($login = false, $rolesWhitelist = []) : void {
		if (isset($_SESSION["user"])) {
			if ($login == false) {
				$controller = new ErrorController();
				$controller->render(errorCode: 403);
				exit;
			}

			$userRoles = UserRepository::getRoles(uid: $_SESSION["user"]["uid"]);
			if (empty(array_intersect($userRoles, $rolesWhitelist))) {
				$controller = new ErrorController();
				$controller->render(errorCode: 403);
				exit;
			}
		} else {
			if ($login == true) {
				$controller = new ErrorController();
				$controller->render(errorCode: 404);
				exit;
			}
		}
	}
}
