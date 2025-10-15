<?php

namespace Tempora\Utils;

class Dump {
	public static function dump(mixed $variable = null): void {
		array_push(
			$GLOBALS["chronos"]["dumps"],
			[
				"trace" => str_replace(search: realpath(path: APP_DIR), replace: "", subject: debug_backtrace()[1]["file"]) . ":" . debug_backtrace()[1]["line"],
				"variable" => $variable
			]
		);
	}
}
