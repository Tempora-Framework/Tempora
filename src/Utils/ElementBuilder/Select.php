<?php

namespace App\Utils\ElementBuilder;

use App\Utils\Lang;

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
	public function build(): void {
		$content = "";

		foreach ($this->options as $key => $value) {
			$content .= "<option value=\"" . $key . "\"" . ($key == $this->selected ? " selected" : "") . ">" . ($this->translate ? Lang::translate(key: $value) : $value) . "</option>";
		}

		$this->setContent(content: $content);

		parent::render();
	}

	/**
	 * Set the value of options
	 *
	 * @param array $options
	 *
	 * @return self
	 */
	public function setOptions(array $options): self {
		$this->options = $options;

		return $this;
	}

	/**
	 * Set the value of selected
	 *
	 * @param mixed $selected
	 *
	 * @return self
	 */
	public function setSelected($selected): self {
		$this->selected = $selected;

		return $this;
	}

	/**
	 * Set the value of translate
	 *
	 * @param bool $translate
	 *
	 * @return self
	 */
	public function setTranslate(bool $translate): self {
		$this->translate = $translate;

		return $this;
	}
}
