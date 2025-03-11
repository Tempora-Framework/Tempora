<?php

namespace App\Controllers;

use App\Configs\Path;
use App\Factories\NavbarFactory;

class IndexController {
	public function render(): void {
		$scripts = [
			"/scripts/engine.js",
			"/scripts/theme.js"
		];

		require Path::LAYOUT . "/header.php";

		(new NavbarFactory())->render();

		require Path::LAYOUT . "/index/index.php";

		include Path::LAYOUT . "/footer.php";
	}
}
