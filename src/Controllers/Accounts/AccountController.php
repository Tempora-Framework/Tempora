<?php

namespace App\Controllers\Accounts;

use App\Attributes\RouteAttribute;
use App\Controllers\Controller;
use App\Enums\Path;
use App\Factories\NavbarFactory;

class AccountController extends Controller {
	#[RouteAttribute(
		path: "/account",
		method: "GET",
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
