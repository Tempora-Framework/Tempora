<?php

namespace Tempora\Utils\Render\Modules;

use Tempora\Utils\Render\RenderModule;

class RenderRemoveTrailingWhitespaceModule extends RenderModule {
	public function format(): void {
		$this->buffer = preg_replace(
			pattern: "/^\\s+|\\s+\$/m",
			replacement: "",
			subject: $this->buffer
		);
	}
}
