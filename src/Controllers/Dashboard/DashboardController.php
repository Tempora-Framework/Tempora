<?php

namespace App\Controllers\Dashboard;

use App\Controllers\Controller;
use App\Enums\Path;
use App\Factories\NavbarFactory;

class DashboardController extends Controller {
	public function __invoke(): void {
		$pageData = $this->getPageData();

		$scripts = [
			"/scripts/engine.js",
			"/scripts/theme.js"
		];

		require Path::LAYOUT->value . "/header.php";

		(new NavbarFactory())->render();

		require Path::LAYOUT->value . "/dashboard/index.php";

		include Path::LAYOUT->value . "/footer.php";
	}
}
