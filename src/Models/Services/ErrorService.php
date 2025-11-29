<?php

namespace Tempora\Models\Services;

use App\Controllers\ErrorController;
use ErrorException;
use Tempora\Enums\Path;
use Tempora\Utils\Lang;
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
		if (DEBUG) {
			header_remove(name: "Content-Security-Policy");
			http_response_code(response_code: is_int(value: $exception->getCode()) ? $exception->getCode() : 500);

			$buffer = ob_get_contents();
			ob_end_clean();

			$render = function (Throwable $exception): string {
				ob_start();

				echo "<style>";
				echo file_get_contents(filename: TEMPORA_DIR . "/assets/styles/error.css");
				echo file_get_contents(filename: TEMPORA_DIR . "/assets/styles/chronos.css");
				echo file_get_contents(filename: TEMPORA_DIR . "/assets/styles/remixicon.css");
				echo "</style>";

				include Path::LAYOUT->value . "/error.php";

				include Path::COMPONENT_CHRONOS->value . "/chronos.php";

				echo "<script>";
				echo file_get_contents(filename: TEMPORA_DIR . "/assets/scripts/engine.js");
				echo file_get_contents(filename: TEMPORA_DIR . "/assets/scripts/error.js");
				echo file_get_contents(filename: TEMPORA_DIR . "/assets/scripts/chronos.js");
				echo "</script>";

				return ob_get_clean();
			};

			$errorRender = $render(exception: $exception);

			echo (new Render(
				buffer:
					str_contains(haystack: $buffer, needle: "<body>")
					? str_replace(
						search: "<body>",
						replace: "<body>" . $errorRender,
						subject: $buffer
					)
					: $errorRender
			))
				->render()
			;
		} else {
			$errorFolder = APP_DIR . "/logs";
			$logFile = $errorFolder . "/" . date(format: "Y-m-d") . ".log";

			if (!file_exists(filename: $errorFolder . "/")) {
				mkdir(directory: $errorFolder, permissions: 0775, recursive: true);
			}

			$errorMessage = "[" . date(format: "Y-m-d H:i:s") . "] ";
			$errorMessage .= "Uncaught Exception: " . $exception->getMessage() . "\n";
			$errorMessage .= "File: " . $exception->getFile() . " (Line " . $exception->getLine() . ")\n";
			$errorMessage .= "Stack trace:\n" . $exception->getTraceAsString() . "\n\n";

			file_put_contents(filename: $logFile, data: $errorMessage, flags: FILE_APPEND);

			ob_end_clean();

			(new ErrorController)
				->setPageData(
					pageData: [
						"page_title" => APP_NAME . " - " . Lang::translate(key: "MAIN_ERROR"),
						"error_code" => 500,
						"error_message" => Lang::translate(key: "ERROR_SERVER")
					]
				)
				->render()
			;
		}
	}

	/**
	 * Exception event
	 *
	 * @return void
	 */
	public static function shutdown(): void {
		$error = error_get_last();
		if ($error != null) {
			$exception = new ErrorException(message: $error["message"], code: 0, severity: $error["type"], filename: $error["file"], line: $error["line"]);
			self::handle(exception: $exception);
		}
	}
}
