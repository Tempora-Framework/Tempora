<?php

namespace App\Controllers\Accounts;

use App\Attributes\RouteAttribute;
use App\Controllers\Controller;
use App\Enums\Path;
use App\Factories\NavbarFactory;

class LoginResetController extends Controller {
	#[RouteAttribute(
		path: "/login/reset",
		name: "app_account_login_reset_get",
		method: "GET",
		description: "Login reset page",
		title: "LOGIN_RESET_TITLE",
		needLoginToBe: false
	)]

	public function __invoke(): void {
		$pageData = $this->getPageData();

		$scripts = [
			"/scripts/engine.js",
			"/scripts/theme.js"
		];

		require Path::LAYOUT->value . "/header.php";

		(new NavbarFactory())->render();

		require Path::LAYOUT->value . "/login/reset/index.php";

		include Path::LAYOUT->value . "/footer.php";
	}
}
