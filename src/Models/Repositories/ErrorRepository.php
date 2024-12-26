<?php

namespace App\Models\Repositories;

use App\Controllers\ErrorController;
use App\Utils\Lang;
use ErrorException;
use Throwable;

class ErrorRepository {

	/**
	 * Catch and store exception
	 *
	 * @param Throwable $exception
	 *
	 * @return void
	 */
	public static function handle(Throwable $exception) : void {
		$errorFolder = BASE_DIR . "/logs";
		$logFile = $errorFolder . "/" . date(format: "Y-m-d") . ".log";

		if (!file_exists(filename: $errorFolder . "/")) {
			mkdir(directory: $errorFolder, permissions: 0770, recursive: true);
		}

		$errorMessage = "[" . date(format: "Y-m-d H:i:s") . "] ";
		$errorMessage .= "Uncaught Exception: " . $exception->getMessage() . "\n";
		$errorMessage .= "File: " . $exception->getFile() . " (Line " . $exception->getLine() . ")\n";
		$errorMessage .= "Stack trace:\n" . $exception->getTraceAsString() . "\n\n";

		file_put_contents(filename: $logFile, data: $errorMessage, flags: FILE_APPEND);

		$controller = new ErrorController();
		$controller->render(message: Lang::translate(key: "ERROR_SERVER"));
	}

	/**
	 * Exception event
	 *
	 * @return void
	 */
	public static function shutdown() : void {
		$error = error_get_last();
		if ($error != NULL) {
			$exception = new ErrorException(message: $error["message"], code: 0, severity: $error["type"], filename: $error["file"], line: $error["line"]);
			self::handle(exception: $exception);
		}
	}
}
