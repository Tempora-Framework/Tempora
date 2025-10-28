<?php

namespace Tempora\Controllers;

class Controller {
	private array $pageData = [];
	private array $styles = [];
	private array $scripts = [];
	private array $payloads = [];

	public function includeAssets(): void {
		foreach ($this->styles as $style) {
			if (str_starts_with(haystack: $style, needle: "/assets/")) {
				echo '<link rel="stylesheet" href="' . str_replace(search: ".css", replace: ".min.css", subject: $style) . '">';
			} else {
				echo '<link rel="stylesheet" href="' . $style . '">';
			}
		}
		foreach ($this->scripts as $script) {
			if (str_starts_with(haystack: $script, needle: "/assets/")) {
				echo '<script defer src="' . str_replace(search: ".js", replace: ".min.js", subject: $script) . '"></script>';
			} else {
				echo '<script defer src="' . $script . '"></script>';
			}
		}
	}

	public function includePayloads(): void {
		if (empty($this->payloads)) {
			return;
		}

		echo '<div id="payloads" class="hidden">';
		foreach ($this->payloads as $key => $payload) {
			echo "<div data-payload-" . $key . '="' . htmlspecialchars(string: $payload) . '"></div>';
		}
		echo "</div>";
	}

	/**
	 * Get the value of pageData
	 *
	 * @return array<mixed>
	 */
	public function getPageData(): array {
		return $this->pageData;
	}

	/**
	 * Set the value of pageData
	 *
	 * @param array $pageData
	 *
	 * @return static
	 */
	public function setPageData(array $pageData): static {
		$this->pageData = $pageData;

		return $this;
	}

	/**
	 * Get the value of styles
	 *
	 * @return array
	 */
	public function getStyles(): array {
		return $this->styles;
	}

	/**
	 * Set the value of styles
	 *
	 * @param array $styles
	 *
	 * @return static
	 */
	public function setStyles(array $styles): static {
		$this->styles = $styles;

		return $this;
	}

	/**
	 * Get the value of scripts
	 *
	 * @return array
	 */
	public function getScripts(): array {
		return $this->scripts;
	}

	/**
	 * Set the value of scripts
	 *
	 * @param array $scripts
	 *
	 * @return static
	 */
	public function setScripts(array $scripts): static {
		$this->scripts = $scripts;

		return $this;
	}

	/**
	 * Get the value of payloads
	 *
	 * @return array
	 */
	public function getPayloads(): array {
		return $this->payloads;
	}

	/**
	 * Set the value of payloads
	 *
	 * @param array $payloads
	 *
	 * @return static
	 */
	public function setPayloads(array $payloads): static {
		$this->payloads = $payloads;

		return $this;
	}
}
