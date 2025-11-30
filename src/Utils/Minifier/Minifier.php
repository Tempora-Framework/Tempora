<?php

namespace Tempora\Utils\Minifier;

use MatthiasMullie\Minify\CSS;
use MatthiasMullie\Minify\JS;
use Tempora\Enums\Path;
use Tempora\Utils\System;
use Throwable;

class Minifier {
	private string $fileName;
	private string $fileExtension;
	private string $filePath;
	private string $minContent = "";

	public function __construct(string $file) {
		$this->fileName = pathinfo(path: $file, flags: PATHINFO_FILENAME);
		$this->fileExtension = pathinfo(path: $file, flags: PATHINFO_EXTENSION);
		$this->filePath = str_replace(search: Path::APP_ASSETS->value, replace: "", subject: pathinfo(path: $file, flags: PATHINFO_DIRNAME));

		if (!is_dir(filename: Path::APP_ASSETS->value)) {
			mkdir(directory: Path::APP_ASSETS->value);
		}
	}

	/**
	 * Create asset file
	 *
	 * @return void
	 */
	public function create(): void {
		if (DEBUG) {
			$tempMinifierms = microtime(as_float: true);
		}

		$filePath = Path::APP_ASSETS->value . $this->filePath . "/" . $this->fileName . "." . $this->fileExtension;
		$minFilePath = Path::APP_ASSETS_MIN->value . $this->filePath . "/" . $this->fileName . ".min." . $this->fileExtension;

		if (
			// If file not in minified asset's folder
			!is_file(filename: $minFilePath)
			// If last modified time is newer than minified file
			|| filemtime(filename: $filePath) > (filemtime(filename: $minFilePath) ?? 0)
		) {
			switch ($this->fileExtension) {
				case "js":
					$minify = new JS($filePath);
					$this->minContent = $minify->minify();

					break;
				case "css":
					$minify = new CSS($filePath);
					$this->minContent = $minify->minify();

					break;
				case "json":
					$this->processJson(filePath: $filePath);

					break;
			}

			try {
				mkdir(directory: Path::APP_ASSETS_MIN->value . $this->filePath, recursive: true);
			} catch (Throwable $e) {
			}

			file_put_contents(filename: $minFilePath, data: $this->minContent);

			if (DEBUG) {
				array_push(
					$GLOBALS["chronos"]["minifier"],
					[
						"file" => $minFilePath,
						"time" => round(num: (microtime(as_float: true) - $tempMinifierms) * 1000, precision: 3)
					]
				);
			}
		}
	}

	public static function cleanOldFiles(): void {
		$files = array_diff(
			System::getAllFiles(path: Path::APP_ASSETS->value),
			System::getAllFiles(path: Path::APP_ASSETS->value . "/images")
		);
		$minFiles = array_diff(
			System::getAllFiles(path: Path::APP_ASSETS_MIN->value),
			System::getAllFiles(path: Path::APP_ASSETS_MIN->value . "/images")
		);

		foreach ($minFiles as $minFile) {
			if (
				!in_array(
					needle:
						str_replace(
							search: ".min",
							replace: "",
							subject: str_replace(
								search: Path::APP_ASSETS_MIN->value,
								replace: Path::APP_ASSETS->value,
								subject: $minFile
							)
						),
					haystack: $files
				)
			) {
				unlink(filename: $minFile);
			}
		}
	}

	private function processJson(string $filePath): void {
		$content = file_get_contents(filename: $filePath);
		$decoded = json_decode(json: $content, associative: true);

		$this->minContent = json_encode(value: $decoded, flags: JSON_UNESCAPED_UNICODE);
	}
}
