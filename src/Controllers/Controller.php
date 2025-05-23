<?php

namespace Tempora\Controllers;

class Controller {

	private array $pageData = [];
	private array $styles = [];
	private array $scripts = [];
	private array $payloads = [];

	public function includeAssets(): void {
		foreach ($this->styles as $style) {
			echo "<link rel=\"stylesheet\" href=\"" . str_replace(search: ".css", replace: ".min.css", subject: $style) . "\">";
		}
		foreach ($this->scripts as $script) {
			echo "<script defer src=\"" . str_replace(search: ".js", replace: ".min.js", subject: $script) . "\"></script>";
		}
	}

	public function includePayloads(): void {
		if (empty($this->payloads))
			return;

		echo "<div id=\"payloads\" class=\"hidden\">";
		foreach ($this->payloads as $key => $payload) {
			echo "<div data-payload-" . $key . "=\"" . htmlspecialchars(string: $payload) . "\"></div>";
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
	 * @return self
	 */
	public function setPageData(array $pageData): self {
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
	 * @return self
	 */
	public function setStyles(array $styles): self {
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
	 * @return self
	 */
	public function setScripts(array $scripts): self {
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
	 * @return self
	 */
	public function setPayloads(array $payloads): self {
		$this->payloads = $payloads;

		return $this;
	}
}
