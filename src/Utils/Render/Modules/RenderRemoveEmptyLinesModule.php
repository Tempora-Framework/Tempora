<?php

namespace Tempora\Utils\Render\Modules;

use Tempora\Utils\Render\RenderModule;

class RenderRemoveEmptyLinesModule extends RenderModule {
	public function format(): void {
		$this->buffer = preg_replace(
			pattern: "/\\n\\s*\\n/",
			replacement: "\n",
			subject: $this->buffer
		);
	}
}
