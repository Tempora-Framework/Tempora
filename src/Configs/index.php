<?php

use App\Configs\Path;
use App\Controllers\ErrorController;
use App\Factories\RouterFactory;
use App\Utils\Lang;
use App\Utils\System;
use Dotenv\Dotenv;
use App\Models\Repositories\ErrorRepository;
use App\Models\Entities\Database;
use App\Models\Repositories\DatabaseRepository;

// Paths
define(constant_name: "BASE_DIR", value: __DIR__ . "/../..");

// Composer
require BASE_DIR . "/vendor/autoload.php";

// Configurations
session_name(name: "SESSION");
session_start();
Dotenv::createImmutable(paths: BASE_DIR)->load();
date_default_timezone_set(timezoneId: $_ENV["TIMEZONE"]);
define(constant_name: "APP_NAME", value: $_ENV["APP_NAME"]);

// Languages
setcookie(name: "LANG", value: isset($_COOKIE["LANG"]) ? $_COOKIE["LANG"] : $_ENV["DEFAULT_LANG"], expires_or_options: time() + 60*60*24*30, path: "/");

if (!in_array($_COOKIE["LANG"] . ".json", System::getFiles(Path::PUBLIC . "/langs"))) {
	setcookie(name: "LANG", value: $_ENV["DEFAULT_LANG"], expires_or_options: time() + 60*60*24*30, path: "/");
	System::redirect();
}

// Errors
if ($_ENV["DEBUG"] == 1) {
	ini_set(option: "display_errors", value: 1);
	ini_set(option: "display_startup_errors", value: 1);
	error_reporting(error_level: E_ALL);
} else {
	set_error_handler(callback: function($severity, $message, $file, $line) : void {
		throw new ErrorException(message: $message, code: 0, severity: $severity, filename: $file, line: $line);
	});
	set_exception_handler(callback: [ErrorRepository::class, "handle"]);
	register_shutdown_function(callback: [ErrorRepository::class, "shutdown"]);
}

//Database
$database = new Database(
	hostname: $_ENV["DATABASE_HOST"],
	port: $_ENV["DATABASE_PORT"],
	dbname: $_ENV["DATABASE_NAME"],
	username: $_ENV["DATABASE_USER"],
	password: $_ENV["DATABASE_PASSWORD"],
	driver: $_ENV["DATABASE_DRIVER"],
	charset: $_ENV["DATABASE_CHARSET"]
);
$databaseRepo = new DatabaseRepository(database: $database);
define(constant_name: "DATABASE", value: $databaseRepo->createConnection());

if (DATABASE instanceof Exception) {
	$controller = new ErrorController();
	$controller->render(message: Lang::translate(key: "ERROR_DATABASE"));
	exit;
}

// Routes
$router = new RouterFactory();
