<?php

namespace App\Controllers;

use App\Enums\Path;

class ErrorController extends Controller {
	public function __invoke(): void {
		$pageData = $this->getPageData();

		http_response_code(response_code: $pageData["error_code"]);

		require Path::LAYOUT->value . "/header.php";

		require Path::LAYOUT->value . "/error/index.php";

		include Path::LAYOUT->value . "/footer.php";
	}
}
