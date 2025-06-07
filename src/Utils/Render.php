<?php

namespace Tempora\Utils;

class Render {

	private string $buffer;

	public function __construct(string $buffer) {
		$this->buffer = $buffer;
	}

	public function render(): string {
		return $this->buffer;
	}

	public function removeWhitespace(): self {
		$this->buffer = preg_replace(
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
			subject: $this->buffer
		);

		return $this;
	}

	public function removeComments(): self {
		$this->buffer = preg_replace(
			pattern: '/<!--(?!<!)[^\[>].*?-->/s',
			replacement: '',
			subject: $this->buffer
		);

		return $this;
	}
}
