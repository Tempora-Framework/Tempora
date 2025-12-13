<?php

namespace Tempora\Utils\Render\Modules;

use Tempora\Utils\Render\RenderModule;

class RenderRemoveWhitespaceBetweenTagsModule extends RenderModule {
	public function format(): void {
		$this->buffer = preg_replace(
			pattern: "/>\\s+</",
			replacement: "><",
			subject: $this->buffer
		);
	}
}
