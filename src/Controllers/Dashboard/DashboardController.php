<?php

namespace App\Controllers\Dashboard;

use App\Configs\Path;
use App\Factories\NavbarFactory;

class DashboardController {
	public function render() : void {
		$scripts = [
			"/scripts/engine.js",
			"/scripts/theme.js"
		];

		require Path::LAYOUT . "/header.php";

		new NavbarFactory();

		require Path::LAYOUT . "/dashboard/index.php";

		include Path::LAYOUT . "/footer.php";
	}
}
