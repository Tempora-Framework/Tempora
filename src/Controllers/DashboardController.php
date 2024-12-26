<?php

namespace App\Controllers;

use App\Configs\Path;
use App\Utils\System;

class DashboardController {
	public function render() : void {
		require Path::LAYOUT . "/header.php";

		require Path::LAYOUT . "/navbar.php";

		require Path::LAYOUT . "/dashboard/index.php";

		System::implementScripts(scripts: ["/scripts/engine.js", "/scripts/theme.js"]);

		include Path::LAYOUT . "/footer.php";
	}
}
