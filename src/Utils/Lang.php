<?php

namespace Tempora\Utils;

use Tempora\Enums\Path;

class Lang {
	private string $langKey;
	private array $langs = [];
	private string $source;

	public function __construct(string $filePath, ?string $source = null) {
		$this->source = ($source ?? Path::APP_ASSETS_MIN->value) . "/langs";

		$this->langKey = MAIN_LANG ?? "en_GB";

		if (!in_array(needle: $this->langKey, haystack: System::getFiles(path: $this->source))) {
			$this->langKey = "en_GB";
		}

		$this->langs = json_decode(json: file_get_contents(filename: $this->source . "/" . $this->langKey . "/" . $filePath . (isset($source) ? "" : ".min") . ".json"), associative: true);
	}

	/**
	 * Lang function
	 *
	 * @param string $key  Language's key out of language's file
	 * @param array  $data Line replace text
	 *
	 * @return string
	 */
	public function translate(string $key, ?array $data = null): string {
		if (isset($this->langs[$key])) {
			$result = $this->langs[$key];
		} else {
			if (DEBUG) {
				$GLOBALS["chronos"]["lang_error_count"]++;
			}

			$result = $key;
		}

		if (isset($data)) {
			foreach ($data as $index => $option) {
				$result = str_replace(search: "\$[" . $index . "]", replace: $option, subject: $result);
			}
		}

		if (
			DEBUG
			&& $this->source == (Path::APP_ASSETS_MIN->value . "/langs")
		) {
			$GLOBALS["chronos"]["langs"][$key] = $result;
			$GLOBALS["chronos"]["lang_count"]++;
		}

		return $result;
	}
}
