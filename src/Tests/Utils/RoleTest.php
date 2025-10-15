<?php

use PHPUnit\Framework\TestCase;
use Tempora\Utils\Roles;

final class RoleTest extends TestCase {
	public function testCheckRole(): void {
		$this->assertTrue(condition: Roles::check(userRoles: [1, 2, 3], allowRoles: [2, 4]));
		$this->assertFalse(condition: Roles::check(userRoles: [1, 2, 3], allowRoles: [4, 5]));
		$this->assertTrue(condition: Roles::check(userRoles: [1, 2, 3], allowRoles: [1, 2]));
		$this->assertFalse(condition: Roles::check(userRoles: [], allowRoles: [1, 2]));
	}
}
