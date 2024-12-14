<?php

namespace App\Controllers;

use App\Configs\Path;

class ErrorController {
	public function render(int $errorCode = 500) : void {
		define(constant_name: "ERROR_CODE", value: $errorCode);

		http_response_code(response_code: ERROR_CODE);

		require Path::LAYOUT . "/header.php";

		include Path::LAYOUT . "/navbar.php";

		require Path::LAYOUT . "/error/error.php";

		include Path::LAYOUT . "/footer.php";
	}
}
