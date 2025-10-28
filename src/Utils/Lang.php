<?php

namespace Tempora\Utils;

class Lang {
	/**
	 * Lang function
	 *
	 * @param string $key  Language's key out of language's file
	 * @param array  $data Line replace text
	 *
	 * @return string
	 */
	public static function translate(string $key, ?array $data = null): string {
		if (isset(LANG_FILE->{$key})) {
			$result = LANG_FILE->{$key};
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

		if (DEBUG) {
			$GLOBALS["chronos"]["langs"][$key] = $result;
			$GLOBALS["chronos"]["lang_count"]++;
		}

		return $result;
	}
}
