<?php

namespace App\Controllers\Accounts;

use App\Configs\Path;
use App\Events\LoginEvent;
use App\Factories\NavbarFactory;

class LoginController {
	public function render() : void {
		LoginEvent::implement();

		$scripts = [
			"/scripts/engine.js",
			"/scripts/theme.js"
		];

		require Path::LAYOUT . "/header.php";

		new NavbarFactory();

		require Path::LAYOUT . "/login/index.php";

		include Path::LAYOUT . "/footer.php";
	}
}
