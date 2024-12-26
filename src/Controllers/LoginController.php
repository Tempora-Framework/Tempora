<?php

namespace App\Controllers;

use App\Configs\Path;
use App\Events\LoginEvent;
use App\Utils\System;

class LoginController {
	public function render() : void {
		LoginEvent::implement();

		require Path::LAYOUT . "/header.php";

		require Path::LAYOUT . "/navbar.php";

		require Path::LAYOUT . "/login/index.php";

		System::implementScripts(scripts: ["/scripts/engine.js", "/scripts/theme.js"]);

		include Path::LAYOUT . "/footer.php";
	}
}
