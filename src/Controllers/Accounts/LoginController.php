<?php

namespace Tempora\Controllers\Accounts;

use Tempora\Attributes\RouteAttribute;
use Tempora\Controllers\Controller;
use Tempora\Enums\Path;
use Tempora\Factories\NavbarFactory;

class LoginController extends Controller {
	#[RouteAttribute(
		path: "/login",
		name: "app_account_login_get",
		method: "GET",
		description: "Login page",
		title: "LOGIN_TITLE",
		needLoginToBe: false
	)]

	public function __invoke(): void {
		$pageData = $this->getPageData();

		if (isset($pageData["form_email"])) {
			$_SESSION["page_data"] = [
				"form_email" => $pageData["form_email"]
			];
		}

		$scripts = [
			"/scripts/engine.js",
			"/scripts/theme.js"
		];

		require Path::LAYOUT->value . "/header.php";

		(new NavbarFactory())->render();

		require Path::LAYOUT->value . "/login/index.php";

		include Path::LAYOUT->value . "/footer.php";
	}
}
