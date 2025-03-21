<?php

namespace App\Controllers;

use App\Configs\Path;

class ErrorController {
	public function render(array $pageData): void {
		http_response_code(response_code: $pageData["error_code"]);

		require Path::LAYOUT . "/header.php";

		require Path::LAYOUT . "/error/index.php";

		include Path::LAYOUT . "/footer.php";
	}
}
