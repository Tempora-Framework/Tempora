<?php

namespace Tempora\Utils\Render\Modules;

use Tempora\Utils\Render\RenderModule;

class RenderRemoveNewLinesModule extends RenderModule {
	public function format(): void {
		$this->buffer = str_replace(
			search: "\n",
			replace: "",
			subject: $this->buffer
		);
	}
}
