<?php

namespace App\Controllers\Accounts;

use App\Configs\Path;
use App\Events\RegisterEvent;
use App\Factories\NavbarFactory;

class RegisterController {
	public function render() : void {
		RegisterEvent::implement();

		$scripts = [
			"/scripts/engine.js",
			"/scripts/theme.js"
		];

		require Path::LAYOUT . "/header.php";

		(new NavbarFactory())->render();

		require Path::LAYOUT . "/register/index.php";

		include Path::LAYOUT . "/footer.php";
	}
}
