<?php

namespace App\Controllers\Accounts;

use App\Configs\Path;
use App\Factories\NavbarFactory;

class AccountController {
	public function render(array $pageData): void {
		$scripts = [
			"/scripts/engine.js",
			"/scripts/theme.js"
		];

		require Path::LAYOUT . "/header.php";

		(new NavbarFactory())->render();

		require Path::LAYOUT . "/account/index.php";

		include Path::LAYOUT . "/footer.php";
	}
}
