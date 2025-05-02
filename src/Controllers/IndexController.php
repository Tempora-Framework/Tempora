<?php

namespace Tempora\Controllers;

use Tempora\Attributes\RouteAttribute;
use Tempora\Enums\Path;
use Tempora\Factories\NavbarFactory;

class IndexController extends Controller {
	#[RouteAttribute(
		path: "",
		name: "app_index_get",
		method: "GET",
		description: "Index page",
	)]

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
