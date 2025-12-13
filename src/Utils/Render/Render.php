<?php

namespace Tempora\Utils\Render;

class Render {
	private string $buffer;

	public function __construct(string $buffer, array $modules = []) {
		$this->buffer = $buffer;

		foreach ($modules as $module) {
			if (
				$module instanceof RenderModule
				&& $module->enabled
			) {
				$module->buffer = $this->buffer;
				$module->format();
				$this->buffer = $module->buffer;
			}
		}
	}

	/**
	 * Renders the final output.
	 *
	 * @return string
	 */
	public function render(): string {
		return $this->buffer;
	}
}
