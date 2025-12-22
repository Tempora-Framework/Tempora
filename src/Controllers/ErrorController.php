<?php

namespace Tempora\Controllers;

use Tempora\Enums\Path;
use Tempora\Utils\Lang;

class ErrorController extends Controller {
	public function render(): void {
		$pageData = $this->getPageData();
		$pageLang = new Lang(filePath: "main/error", source: TEMPORA_DIR . "/src/assets");

		http_response_code(response_code: $pageData["error_code"]);

		$this->setStyles(styles: [
			"/vendor/tempora-framework/tempora/assets/styles/main.css",
			"/vendor/tempora-framework/tempora/assets/styles/remixicon.css"
		]);

		require Path::LAYOUT->value . "/header.php";

		require Path::LAYOUT->value . "/error/index.php";
	}
}
