<?php

namespace Tempora\Controllers\Accounts;

use Tempora\Attributes\RouteAttribute;
use Tempora\Controllers\Controller;
use Tempora\Enums\Path;
use Tempora\Factories\NavbarFactory;

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
