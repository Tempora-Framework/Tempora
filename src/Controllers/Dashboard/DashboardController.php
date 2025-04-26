<?php

namespace App\Controllers\Dashboard;

use App\Attributes\RouteAttribute;
use App\Controllers\Controller;
use App\Enums\Path;
use App\Enums\Role;
use App\Factories\NavbarFactory;

class DashboardController extends Controller {
	#[RouteAttribute(path: "/dashboard", method: "GET", title: "DASHBOARD_TITLE", needLoginToBe: true, accessRoles: [Role::ADMINISTRATOR])]
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
