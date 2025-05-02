<?php

namespace Tempora\Controllers\Accounts;

use Tempora\Attributes\RouteAttribute;
use Tempora\Controllers\Controller;
use Tempora\Enums\Path;
use Tempora\Factories\NavbarFactory;

class RegisterController extends Controller {
	#[RouteAttribute(
		path: "/register",
		name: "app_account_register_get",
		method: "GET",
		description: "Register page",
		title: "REGISTER_TITLE",
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

		require Path::LAYOUT->value . "/register/index.php";

		include Path::LAYOUT->value . "/footer.php";
	}
}
