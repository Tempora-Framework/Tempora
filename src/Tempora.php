<?php

namespace App;

use App\Enums\Path;
use App\Controllers\ErrorController;
use App\Factories\RouterFactory;
use App\Models\Database;
use App\Models\Services\ErrorService;
use App\Utils\Cookie;
use App\Utils\Lang;
use App\Utils\System;
use Dotenv\Dotenv;
use ErrorException;

class Tempora {
	public function __construct() {
		// Dotenv
		if (!is_file(filename: BASE_DIR . "/.env")) {
			echo "Please create .env file from .env.example at application root.";
			exit;
		}
		Dotenv::createImmutable(paths: BASE_DIR)->load();

		// Configurations
		session_name(name: "TEMPORA");
		ini_set(option: "session.gc_maxlifetime", value: 3600);
		session_start();
		date_default_timezone_set(timezoneId: $_ENV["TIMEZONE"]);

		// Constants
		$this->const();

		// Errors
		$this->errorHandler();

		if (DEBUG == 1)
			$this->toolbar();

		// Database
		$this->database();

		// Languages
		$this->lang();

		new RouterFactory(url: strtok(string: $_SERVER["REQUEST_URI"], token: "?"));
	}

	/**
	 * Constants
	 *
	 * @return void
	 */
	public function const(): void {
		define(constant_name: "TEMPORA_VERSION", value: "1.1.0");
		define(constant_name: "APP_NAME", value: $_ENV["APP_NAME"]);
		define(constant_name: "DEBUG", value: $_ENV["DEBUG"]);
	}

	/**
	 * Toolbar
	 *
	 * @return void
	 */
	public function toolbar(): void {
		$toolbar = [];
		global $toolbar;

		$GLOBALS["toolbar"]["ms_count"] = microtime(as_float: true);
		$GLOBALS["toolbar"]["sql_count"] = 0;
		$GLOBALS["toolbar"]["sql_query"] = [];
		$GLOBALS["toolbar"]["langs"] = [];
		$GLOBALS["toolbar"]["lang_count"] = 0;
		$GLOBALS["toolbar"]["lang_error_count"] = 0;
	}

	/**
	 * Error handler
	 *
	 * @return void
	 */
	public function errorHandler(): void {
		if (DEBUG == 1) {
			ini_set(option: "display_errors", value: 1);
			ini_set(option: "display_startup_errors", value: 1);
			error_reporting(error_level: E_ALL);
		} else {
			set_error_handler(callback: function($severity, $message, $file, $line): void {
				throw new ErrorException(message: $message, code: 0, severity: $severity, filename: $file, line: $line);
			});
			set_exception_handler(callback: [ErrorService::class, "handle"]);
			register_shutdown_function(callback: [ErrorService::class, "shutdown"]);
		}
	}

	/**
	 * Language system
	 *
	 * @return void
	 */
	public function lang(): void {
		$langCookie = new Cookie;
		$langCookie
			->setName(name: "LANG")
			->setValue(value: $_COOKIE["LANG"] ?? $_ENV["DEFAULT_LANG"])
		;
		$langCookie->send();

		if (!in_array(needle: $_COOKIE["LANG"] . ".json", haystack: System::getFiles(path: Path::PUBLIC->value . "/langs"))) {
			$langCookie->setValue(value: $_ENV["DEFAULT_LANG"]);
			$langCookie->send();
			System::redirect();
		}
	}

	/**
	 * Database
	 *
	 * @return void
	 */
	public function database(): void {
		$database = new Database;
		define(constant_name: "DATABASE", value: $database());

		if (DATABASE instanceof Exception) {
			(new ErrorController())->setPageData(
				pageData: [
					"page_title" => APP_NAME . " - " . Lang::translate(key: "MAIN_ERROR"),
					"error_code" => 500,
					"error_message" => Lang::translate(key: "ERROR_DATABASE")
				]
			)();

			exit;
		}
	}
}
