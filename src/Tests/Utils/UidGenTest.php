<?php

use PHPUnit\Framework\TestCase;
use Tempora\Utils\System;

final class UidGenTest extends TestCase {
	public function testGenerateUid(): void {
		$uid = System::uidGen(size: 16);
		$this->assertIsString(actual: $uid);
		$this->assertEquals(expected: 16, actual: strlen(string: $uid));
	}
}
