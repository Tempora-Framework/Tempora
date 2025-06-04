<?php

namespace Tempora\Models\Services;

use App\Controllers\ErrorController;
use Tempora\Enums\Path;
use Tempora\Utils\Lang;
use ErrorException;
use Tempora\Utils\Render;
use Throwable;

class ErrorService {

	/**
	 * Catch and store exception
	 *
	 * @param Throwable $exception
	 *
	 * @return void
	 */
	public static function handle(Throwable $exception): void {
		if (DEBUG == 1) {
			$buffer = ob_get_contents();
			ob_end_clean();

			$render = function($exception): string {
				ob_start();

				include PATH::LAYOUT->value . "/error.php";

				include Path::COMPONENT_CHRONOS->value . "/chronos.php";

				return ob_get_clean();
			};

			$errorRender = $render(exception: $exception);

			echo Render::clean(
				buffer: str_replace(
					search: "<body>",
					replace: "<body>" . $errorRender,
					subject: $buffer
				)
			);
		} else {
			$errorFolder = APP_DIR . "/logs";
			$logFile = $errorFolder . "/" . date(format: "Y-m-d") . ".log";

			if (!file_exists(filename: $errorFolder . "/")) {
				mkdir(directory: $errorFolder, permissions: 0770, recursive: true);
			}

			$errorMessage = "[" . date(format: "Y-m-d H:i:s") . "] ";
			$errorMessage .= "Uncaught Exception: " . $exception->getMessage() . "\n";
			$errorMessage .= "File: " . $exception->getFile() . " (Line " . $exception->getLine() . ")\n";
			$errorMessage .= "Stack trace:\n" . $exception->getTraceAsString() . "\n\n";

			file_put_contents(filename: $logFile, data: $errorMessage, flags: FILE_APPEND);

			ob_end_clean();

			(new ErrorController())->setPageData(
				pageData: [
					"page_title" => APP_NAME . " - " . Lang::translate(key: "MAIN_ERROR"),
					"error_code" => 500,
					"error_message" => Lang::translate(key: "ERROR_SERVER")
				]
			)();
		}
	}

	/**
	 * Exception event
	 *
	 * @return void
	 */
	public static function shutdown(): void {
		$error = error_get_last();
		if ($error != NULL) {
			$exception = new ErrorException(message: $error["message"], code: 0, severity: $error["type"], filename: $error["file"], line: $error["line"]);
			self::handle(exception: $exception);
		}
	}
}
