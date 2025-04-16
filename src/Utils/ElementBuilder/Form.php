<?php

namespace App\Utils\ElementBuilder;

use App\Utils\System;

class Form extends ElementBuilder {

	private array $inputs = [];

	private bool $csrf = true;

	public function __construct() {
		$this->setElement(element: "form");
	}

	/**
	 * Build content
	 *
	 * @return string
	 */
	public function build(): string {
		$content = "";

		$content .= ($this->csrf ? System::createCSRF() : "");

		foreach ($this->inputs as $input) {
			$content .= $input;
		}

		$this->setContent(content: $content);

		return parent::render();
	}

	public function addInput(ElementBuilder $input): self {
		array_push($this->inputs, $input->render());

		return $this;
	}

	/**
	 * Get the value of inputs
	 *
	 * @return array
	 */
	public function getInputs(): array {
		return $this->inputs;
	}

	/**
	 * Get the value of csrf
	 *
	 * @return bool
	 */
	public function isCsrf(): bool {
		return $this->csrf;
	}

	/**
	 * Set the value of csrf
	 *
	 * @param bool $csrf
	 *
	 * @return self
	 */
	public function setCsrf(bool $csrf): self {
		$this->csrf = $csrf;

		return $this;
	}
}
