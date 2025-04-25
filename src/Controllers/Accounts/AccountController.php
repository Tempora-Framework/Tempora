<?php

namespace App\Controllers\Accounts;

use App\Controllers\Controller;
use App\Enums\Path;
use App\Factories\NavbarFactory;

class AccountController extends Controller {
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
