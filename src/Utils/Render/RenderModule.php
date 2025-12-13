<?php

namespace Tempora\Utils\Render;

abstract class RenderModule {
	public bool $enabled = true;
	public string $buffer;

	/**
	 * Formats the buffer according to the module's purpose.
	 *
	 * @return void
	 */
	abstract public function format(): void;
}
