<?php

namespace Tempora\Utils\ElementBuilder;

use Tempora\Utils\Lang;

class Select extends ElementBuilder {

	private array $options = [];
	private mixed $selected = "";
	private bool $translate = false;

	public function __construct() {
		$this->setElement(element: "select");
	}

	/**
	 * Build content
	 *
	 * @return void
	 */
	public function build(): string {
		$content = "";

		foreach ($this->options as $key => $value) {
			$content .= "<option value=\"" . $key . "\"" . ($key == $this->selected ? " selected" : "") . ">" . ($this->translate ? Lang::translate(key: $value) : $value) . "</option>";
		}

		$this->setContent(content: $content);

		return parent::build();
	}

	/**
	 * Set the value of options
	 *
	 * @param array $options
	 *
	 * @return static
	 */
	public function setOptions(array $options): static {
		$this->options = $options;

		return $this;
	}

	/**
	 * Set the value of selected
	 *
	 * @param mixed $selected
	 *
	 * @return static
	 */
	public function setSelected($selected): static {
		$this->selected = $selected;

		return $this;
	}

	/**
	 * Set the value of translate
	 *
	 * @param bool $translate
	 *
	 * @return static
	 */
	public function setTranslate(bool $translate): static {
		$this->translate = $translate;

		return $this;
	}
}
