<?php

namespace Tempora;

use App\Controllers\ErrorController;
use Composer\InstalledVersions;
use Dotenv\Dotenv;
use ErrorException;
use Exception;
use Tempora\Enums\Path;
use Tempora\Factories\RouterFactory;
use Tempora\Models\Database;
use Tempora\Models\Services\ErrorService;
use Tempora\Traits\UserTrait;
use Tempora\Utils\Cookie;
use Tempora\Utils\JWT;
use Tempora\Utils\Lang;
use Tempora\Utils\Minifier\Minifier;
use Tempora\Utils\System;

class Tempora {
	use UserTrait;

	public function __construct(array $options = []) {
		// Paths
		define(constant_name: "TEMPORA_DIR", value: __DIR__ . "/..");
		if (!defined(constant_name: "APP_DIR")) {
			define(constant_name: "APP_DIR", value: $_SERVER["DOCUMENT_ROOT"] . "/..");
		}

		// Dotenv
		if (!is_file(filename: APP_DIR . "/.env")) {
			echo "Please create .env file from .env.example at application root.";
			exit;
		}
		Dotenv::createImmutable(paths: APP_DIR)->load();

		// Configurations
		session_name(name: "TEMPORA");
		session_set_cookie_params(
			lifetime_or_options: [
				"httpOnly" => true,
				"path" => "/",
				"samesite" => "Strict"
			]
		);
		ini_set(option: "session.gc_maxlifetime", value: 3600);
		session_start();
		date_default_timezone_set(timezoneId: $_ENV["TIMEZONE"]);

		// Constants
		$this->const();

		// Headers
		header(header: "X-Powered-By: Tempora v" . TEMPORA_VERSION, replace: true);
		header(header: "Content-Security-Policy: default-src 'self'; script-src 'self'; style-src 'self'; img-src 'self' data:; font-src 'self'; frame-ancestors 'none'; base-uri 'self'; form-action 'self';");

		// Errors
		$this->errorHandler();

		if (DEBUG) {
			$this->chronos();
		}

		$this->functions();

		// Database
		$this->database();

		// Token
		$this->jwt();

		// User
		if (isset($_SESSION["user"]["uid"])) {
			define(constant_name: "USER_ROLES", value: $this::getRoles(uid: $_SESSION["user"]["uid"]));
		}

		// Minify assets
		$this->minify();

		// Languages
		$this->lang();

		ob_start(callback: "ob_gzhandler");

		new RouterFactory(url: strtok(string: $_SERVER["REQUEST_URI"], token: "?"), options: $options);

		ob_end_flush();
	}

	/**
	 * Constants
	 *
	 * @return void
	 */
	public function const(): void {
		define(constant_name: "TEMPORA_VERSION", value: InstalledVersions::getPrettyVersion(packageName: "tempora-framework/tempora"));
		define(constant_name: "APP_NAME", value: $_ENV["APP_NAME"]);
		define(constant_name: "DEBUG", value: $_ENV["DEBUG"] == 1);
	}

	/**
	 * Chronos
	 *
	 * @return void
	 */
	public function chronos(): void {
		$GLOBALS["chronos"]["ms_count"] = microtime(as_float: true);
		$GLOBALS["chronos"]["sql_count"] = 0;
		$GLOBALS["chronos"]["sql_query"] = [];
		$GLOBALS["chronos"]["minifier"] = [];
		$GLOBALS["chronos"]["images_ms"] = [];
		$GLOBALS["chronos"]["langs"] = [];
		$GLOBALS["chronos"]["lang_count"] = 0;
		$GLOBALS["chronos"]["lang_error_count"] = 0;
		$GLOBALS["chronos"]["dumps"] = [];
	}

	/**
	 * Load functions
	 *
	 * @return void
	 */
	public function functions(): void {
		foreach (System::getAllFiles(path: TEMPORA_DIR . "/src/functions") as $file) {
			require_once $file;
		}
	}

	/**
	 * Error handler
	 *
	 * @return void
	 */
	public function errorHandler(): void {
		set_error_handler(callback: function ($severity, $message, $file, $line): void {
			throw new ErrorException(message: $message, code: 0, severity: $severity, filename: $file, line: $line);
		});
		set_exception_handler(callback: [ErrorService::class, "handle"]);
		register_shutdown_function(callback: [ErrorService::class, "shutdown"]);
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

		if (!isset($_COOKIE["LANG"])) {
			System::redirect();
		}

		define(constant_name: "MAIN_LANG", value: $_COOKIE["LANG"]);
	}

	/**
	 * Minify assets
	 *
	 * @return void
	 */
	public function minify(): void {
		// Take all assets files except "images" folder
		$files = array_diff(
			System::getAllFiles(path: Path::APP_ASSETS->value),
			System::getAllFiles(path: Path::APP_ASSETS->value . "/images")
		);
		foreach ($files as $file) {
			(new Minifier(file: $file))->create();
		}

		Minifier::cleanOldFiles();
	}

	/**
	 * JWT
	 *
	 * @return void
	 */
	public function jwt(): void {
		if (isset($_COOKIE["JWT"])) {
			$jwt = new JWT;
			$jwtUid = $jwt->getUserUid(token: $_COOKIE["JWT"]);
			if ($jwtUid) {
				$_SESSION["user"]["uid"] = $jwtUid;
			} else {
				$jwtCookie = new Cookie;
				$jwtCookie
					->setName(name: "JWT")
					->setValue(value: "")
					->setExpire(expire: 0)
				;
				$jwtCookie->send();

				unset($_SESSION["user"]);

				System::redirect();
			}
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
			$lang = new Lang(filePath: "main", source: TEMPORA_DIR . "/src/assets");
			(new ErrorController)
				->setPageData(
					pageData: [
						"page_title" => APP_NAME . " - " . $lang->translate(key: "MAIN_ERROR"),
						"error_code" => 500,
						"error_message" => $lang->translate(key: "ERROR_DATABASE")
					]
				)
				->render()
			;

			exit;
		}
	}
}
