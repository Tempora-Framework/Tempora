<?php

namespace App\Controllers;

use App\Enums\Path;
use App\Factories\NavbarFactory;

class IndexController {
	public function render(array $pageData): void {
		$scripts = [
			"/scripts/engine.js",
			"/scripts/theme.js"
		];

		require Path::LAYOUT->value . "/header.php";

		(new NavbarFactory())->render();

		require Path::LAYOUT->value . "/index/index.php";

		include Path::LAYOUT->value . "/footer.php";
	}
}
