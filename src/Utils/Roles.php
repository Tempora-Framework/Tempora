<?php

namespace App\Utils;

use App\Enums\Role;

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

	public static function getRoleByName(string $name): int {
		foreach (Role::cases() as $case) {
			if ($case->name === $name) {
				return $case->value;
			}
		}

		return 0;
	}
}
