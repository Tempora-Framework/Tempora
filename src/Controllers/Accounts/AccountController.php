<?php

namespace Tempora\Controllers\Accounts;

use Tempora\Attributes\RouteAttribute;
use Tempora\Controllers\Controller;
use Tempora\Enums\Path;
use Tempora\Factories\NavbarFactory;

class AccountController extends Controller {
	#[RouteAttribute(
		path: "/account",
		name: "app_account_get",
		method: "GET",
		description: "Account page",
		title: "ACCOUNT_TITLE",
		needLoginToBe: true
	)]

	public function __invoke(): void {
		$pageData = $this->getPageData();

		$scripts = [
			"/scripts/engine.js",
			"/scripts/theme.js"
		];

		require Path::LAYOUT->value . "/header.php";

		(new NavbarFactory())->render();

		require Path::LAYOUT->value . "/account/index.php";

		include Path::LAYOUT->value . "/footer.php";
	}
}
