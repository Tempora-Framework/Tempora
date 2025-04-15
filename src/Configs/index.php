<?php

use App\Enums\Path;
use App\Controllers\ErrorController;
use App\Models\Database;
use App\Models\Services\ErrorService;
use App\Utils\Lang;
use App\Utils\System;
use Dotenv\Dotenv;

// Version
define(constant_name: "TEMPORA_VERSION", value: "1.0.0");

// Paths
define(constant_name: "BASE_DIR", value: __DIR__ . "/../..");

// Composer
$autoload = BASE_DIR . "/vendor/autoload.php";
if (!is_file(filename: $autoload)) {
	echo "Please run composer install before starting the application.";
	exit;
}

if (!is_file(filename: BASE_DIR . "/.env")) {
	echo "Please create .env file from .env.example at application root.";
	exit;
}

require $autoload;

// Configurations
session_name(name: "TEMPORA");
ini_set(option: "session.gc_maxlifetime", value: 3600);
session_start();
Dotenv::createImmutable(paths: BASE_DIR)->load();
date_default_timezone_set(timezoneId: $_ENV["TIMEZONE"]);
define(constant_name: "APP_NAME", value: $_ENV["APP_NAME"]);

// Debug
define(constant_name: "DEBUG", value: $_ENV["DEBUG"]);

if (DEBUG == 1) {
	$toolbar = [];
	global $toolbar;

	$GLOBALS["toolbar"]["ms_count"] = microtime(as_float: true);
	$GLOBALS["toolbar"]["sql_count"] = 0;
	$GLOBALS["toolbar"]["sql_query"] = [];
	$GLOBALS["toolbar"]["langs"] = [];
	$GLOBALS["toolbar"]["lang_count"] = 0;
	$GLOBALS["toolbar"]["lang_error_count"] = 0;
}

// Languages
setcookie(name: "LANG", value: $_COOKIE["LANG"] ?? $_ENV["DEFAULT_LANG"], expires_or_options: time() + 60*60*24*30, path: "/");

if (!in_array($_COOKIE["LANG"] . ".json", System::getFiles(path: Path::PUBLIC->value . "/langs"))) {
	setcookie(name: "LANG", value: $_ENV["DEFAULT_LANG"], expires_or_options: time() + 60*60*24*30, path: "/");
	System::redirect();
}

// Errors
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

// Database
$database = new Database;
define(constant_name: "DATABASE", value: $database());

if (DATABASE instanceof Exception) {
	$controller = new ErrorController();
	$controller->render(
		pageData: [
			"page_title" => APP_NAME . " - " . Lang::translate(key: "MAIN_ERROR"),
			"error_code" => 500,
			"error_message" => Lang::translate(key: "ERROR_DATABASE")
		]
	);

	exit;
}
