<?php

namespace App\Controllers;

use App\Configs\Path;
use App\Utils\Lang;

class ErrorController {
	public function render(int $errorCode = 500, string $message = null) : void {
		define(constant_name: "TITLE", value: APP_NAME . " - ". Lang::translate(key: "MAIN_ERROR"));
		define(constant_name: "ERROR_CODE", value: $errorCode);
		define(constant_name: "EXCEPTION", value: isset($message) ? $message : Lang::translate(key: "ERROR_SERVER"));

		http_response_code(response_code: ERROR_CODE);

		require Path::LAYOUT . "/header.php";

		require Path::LAYOUT . "/error/error.php";

		include Path::LAYOUT . "/footer.php";
	}
}
