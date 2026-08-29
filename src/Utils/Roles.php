<?php

namespace Tempora\Utils;

use Tempora\Enums\Role;

class Roles {
	/**
	 * Check for permissions
	 *
	 * @param array<int> $userRoles
	 * @param array<int> $allowRoles
	 *
	 * @return bool
	 */
	public static function check(array $userRoles, array $allowRoles): bool {
		if (!empty(array_intersect($userRoles, $allowRoles))) {
			return true;
		}

		return false;
	}

	/**
	 * Get role value by name
	 *
	 * @param string $name
	 *
	 * @return int
	 */
	public static function getRoleByName(string $name): int {
		foreach (Role::cases() as $case) {
			if ($case->name === $name) {
				return $case->value;
			}
		}

		return 0;
	}

	/**
	 * Get role name by value
	 *
	 * @param int $role
	 *
	 * @return string
	 */
	public static function getRoleName(int $role): string {
		foreach (Role::cases() as $case) {
			if ($case->value === $role) {
				return $case->name;
			}
		}

		return "";
	}
}
