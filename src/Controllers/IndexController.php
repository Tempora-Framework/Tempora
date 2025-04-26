<?php

namespace App\Controllers;

use App\Attributes\RouteAttribute;
use App\Enums\Path;
use App\Factories\NavbarFactory;

class IndexController extends Controller {
	#[RouteAttribute(path: "", method: "GET")]
	public function __invoke(): void {
		$pageData = $this->getPageData();

		$scripts = [
			"/scripts/engine.js",
			"/scripts/theme.js"
		];

		require Path::LAYOUT->value . "/header.php";

		(new NavbarFactory())->render();

		require Path::LAYOUT->value . "/index/index.php";

		include Path::LAYOUT->value . "/footer.php";
	}
}
