<?php

use PHPUnit\Framework\TestCase;
use Tempora\Utils\System;

final class GetFilesTest extends TestCase {
	public function testGetFile(): void {
		$files = System::getFiles(path: __DIR__ . "/../data");
		$this->assertIsArray(actual: $files);
		$this->assertNotEmpty(actual: $files);
	}

	public function testGetAllFiles(): void {
		$files = System::getAllFiles(path: __DIR__ . "/../data");
		$this->assertIsArray(actual: $files);
		$this->assertNotEmpty(actual: $files);
		foreach ($files as $file) {
			$this->assertFileExists(filename: $file);
		}
	}
}
