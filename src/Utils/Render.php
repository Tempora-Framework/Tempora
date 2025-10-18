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

	public function removeWhitespaceBetweenTags(): self {
		$this->buffer = preg_replace(
			pattern: '/>\s+</',
			replacement: '><',
			subject: $this->buffer
		);

		return $this;
	}

	public function removeTrailingWhitespace(): self {
		$this->buffer = preg_replace(
			pattern: '/^\s+|\s+$/m',
			replacement: '',
			subject: $this->buffer
		);

		return $this;
	}

	public function removeEmptyLines(): self {
		$this->buffer = preg_replace(
			pattern: '/\n\s*\n/',
			replacement: "\n",
			subject: $this->buffer
		);

		return $this;
	}

	public function collapseSpaces(): self {
		$this->buffer = preg_replace(
			pattern: '/[ \t]+/',
			replacement: ' ',
			subject: $this->buffer
		);

		return $this;
	}

	public function removeNewlines(): self {
		$this->buffer = preg_replace(
			pattern: '/\n/',
			replacement: '',
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
