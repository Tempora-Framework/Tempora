<?php

namespace Tempora\Utils\Render;

use Tempora\Enums\Path;

class Render {
	private string $buffer;

	public function __construct(string $buffer, array $modules = [], $pageData = []) {
		$this->buffer = $buffer;

		if (
			defined(constant_name: "DEBUG")
			&& DEBUG
			&& !in_array(needle: "Content-Type: application/json", haystack: headers_list())
		) {
			$this->injectChronos(pageData: $pageData);
		}

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
	 * Inject Chronos
	 *
	 * @param array<string,mixed> $pageData
	 *
	 * @return void
	 */
	private function injectChronos(array $pageData): void {
		$chronos = (function (array $pageData): string {
			ob_start();
			include Path::COMPONENT_CHRONOS->value . "/chronos.php";

			return ob_get_clean();
		});

		$this->buffer = str_replace(
			search: "<body>",
			replace: "<body>" . $chronos(pageData: $pageData),
			subject: $this->buffer
		);
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
