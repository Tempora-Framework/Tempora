<?php

namespace App\Controllers\Accounts;

use App\Attributes\RouteAttribute;
use App\Controllers\Controller;
use App\Enums\Path;
use App\Factories\NavbarFactory;

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
