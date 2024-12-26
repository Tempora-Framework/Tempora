<?php

namespace App\Controllers;

use App\Configs\Path;
use App\Events\RegisterEvent;
use App\Utils\System;

class RegisterController {
	public function render() : void {
		RegisterEvent::implement();

		require Path::LAYOUT . "/header.php";

		require Path::LAYOUT . "/navbar.php";

		require Path::LAYOUT . "/register/index.php";

		System::implementScripts(scripts: ["/scripts/engine.js", "/scripts/theme.js"]);

		include Path::LAYOUT . "/footer.php";
	}
}
