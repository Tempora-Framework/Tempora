<?php

namespace Tempora\Utils\Minifier;

use Exception;
use MatthiasMullie\Minify\JS;
use MatthiasMullie\Minify\CSS;
use Tempora\Enums\Path;
use Tempora\Utils\Cache\Cache;

class Minifier {

	private string $fileName;
	private string $fileExtension;
	private string $filePath;
	private string $minContent = "";

	public function __construct(string $file) {
		$this->fileName = pathinfo(path: $file, flags: PATHINFO_FILENAME);
		$this->fileExtension = pathinfo(path: $file, flags: PATHINFO_EXTENSION);
		$this->filePath = pathinfo(path: $file, flags: PATHINFO_DIRNAME);

		$this->filePath = str_replace(search: Path::ASSETS->value, replace: "", subject: $this->filePath);

		if (!is_dir(filename: Path::ASSETS->value)) {
			mkdir(directory: Path::ASSETS->value);
		}
	}

	/**
	 * Get minified asset file content
	 *
	 * @return string
	 */
	public function get(): string {
		if (!is_file(filename: Path::ASSETS_MIN->value . "/" . $this->filePath . "/" . $this->fileName . ".min." . $this->fileExtension))
			return "";

		return file_get_contents(filename: Path::ASSETS_MIN->value . "/" . $this->filePath . "/" . $this->fileName . ".min." . $this->fileExtension);
	}

	/**
	 * Create asset file
	 *
	 * @return void
	 */
	public function create(): void {
		$file = Path::ASSETS->value . $this->filePath . "/" . $this->fileName . "." . $this->fileExtension;

		if (filemtime(filename: $file) > ((new Cache(file: "minifier.json"))->get()[$file] ?? 0)) {
			if ($this->fileExtension == "js") {
				$minify = new JS($file);
				$this->minContent = $minify->minify();
			}

			if ($this->fileExtension == "css") {
				$minify = new CSS($file);
				$this->minContent = $minify->minify();
			}

			if (
				$this->minContent != ""
				&& self::get() != $this->minContent
			) {
				try {
					mkdir(directory: Path::ASSETS_MIN->value . $this->filePath, recursive: true);
				} catch (Exception $e) {}

				file_put_contents(filename: Path::ASSETS_MIN->value . $this->filePath . "/" . $this->fileName . ".min." . $this->fileExtension, data: $this->minContent);
			}
		}
	}
}
