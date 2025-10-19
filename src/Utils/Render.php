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

	public function removeWhitespaceBetweenTags(): static {
		$this->buffer = preg_replace(
			pattern: '/>\s+</',
			replacement: '><',
			subject: $this->buffer
		);

		return $this;
	}

	public function removeTrailingWhitespace(): static {
		$this->buffer = preg_replace(
			pattern: '/^\s+|\s+$/m',
			replacement: '',
			subject: $this->buffer
		);

		return $this;
	}

	public function removeEmptyLines(): static {
		$this->buffer = preg_replace(
			pattern: '/\n\s*\n/',
			replacement: "\n",
			subject: $this->buffer
		);

		return $this;
	}

	public function collapseSpaces(): static {
		$this->buffer = preg_replace(
			pattern: '/[ \t]+/',
			replacement: ' ',
			subject: $this->buffer
		);

		return $this;
	}

	public function removeNewlines(): static {
		$this->buffer = preg_replace(
			pattern: '/\n/',
			replacement: '',
			subject: $this->buffer
		);

		return $this;
	}

	public function removeComments(): static {
		$this->buffer = preg_replace(
			pattern: '/<!--(?!<!)[^\[>].*?-->/s',
			replacement: '',
			subject: $this->buffer
		);

		return $this;
	}
}
