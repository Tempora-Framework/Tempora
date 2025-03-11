<?php

namespace App\Utils;

class Roles {
	/**
	 * Check for permissions
	 *
	 * @param array $userRoles
	 * @param array $allowRoles
	 *
	 * @return bool
	 */
	public static function check(array $userRoles, array $allowRoles): bool {
		if (!empty(array_intersect($userRoles, $allowRoles))) {
			return true;
		}
		return false;
	}
}
