<?php

namespace Tempora\Utils;

class Render {

	public static function clean(mixed $buffer): mixed {
		return preg_replace(
			pattern: [
				'/>\s+</', // Remove whitespace between tags
				'/^\s+|\s+$/m', // Remove leading/trailing whitespace
				'/\n\s*\n/', // Remove empty lines
				'/[ \t]+/', // Collapse spaces
				'/\n/', // Remove newlines
			],
			replacement: [
				'><',
				'',
				"\n",
				' ',
				'',
			],
			subject: $buffer
		);
	}
}
