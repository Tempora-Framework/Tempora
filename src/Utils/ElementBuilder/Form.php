<?php

namespace Tempora\Utils\ElementBuilder;

use Tempora\Utils\System;

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

		return parent::build();
	}

	public function addInput(ElementBuilder $input): static {
		array_push($this->inputs, $input->build());

		return $this;
	}

	/**
	 * Get the value of inputs
	 *
	 * @return array<ElementBuilder>
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
	 * @return static
	 */
	public function setCsrf(bool $csrf): static {
		$this->csrf = $csrf;

		return $this;
	}
}
