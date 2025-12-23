<?php

namespace Tempora\Utils\Render\Modules;

use Tempora\Utils\Render\RenderModule;

class RenderCollapseSpacesModule extends RenderModule {
	/**
	 * Format buffer
	 *
	 * @return void
	 */
	public function format(): void {
		$this->buffer = preg_replace(
			pattern: "/[ \\t]+/",
			replacement: " ",
			subject: $this->buffer
		);
	}
}
