<?php

namespace App\Controllers;

use App\Configs\Path;

class DashboardController {
	public function render() : void {
		require Path::LAYOUT . "/header.php";

		require Path::LAYOUT . "/navbar.php";

		require Path::LAYOUT . "/dashboard/index.php";

		include Path::LAYOUT . "/footer.php";
	}
}
