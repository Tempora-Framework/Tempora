<?php

namespace App\Utils\ElementBuilder;

class ElementBuilder {

	protected ?string $element = null;
	private array $attributs = [];
	private ?string $content = null;

	/**
	 * Element render
	 *
	 * @return string
	 */
	public function render(): string {
		$result = "<" . $this->element;

		foreach ($this->attributs as $key => $value) {
			if ($value != "") {
				$result .= " " . $key . "=\"" . $value . "\"";
			} else {
				$result .= " " . $key;
			}
		}

		$result .= ">";

		$result .= $this->content;

		$result .= "</" . $this->element . ">";

		return $result;
	}

	/**
	 * Get the value of element
	 *
	 * @return string
	 */
	public function getElement(): string {
		return $this->element;
	}

	/**
	 * Set the value of element
	 *
	 * @param string $element
	 *
	 * @return self
	 */
	public function setElement(string $element): self {
		$this->element = $element;

		return $this;
	}

	/**
	 * Get the value of content
	 *
	 * @return string
	 */
	public function getContent(): string {
		return $this->content;
	}

	/**
	 * Set the value of content
	 *
	 * @param string $content
	 *
	 * @return self
	 */
	public function setContent(string $content): self {
		$this->content = $content;

		return $this;
	}

	/**
	 * Get the value of attributs
	 *
	 * @return array<mixed>
	 */
	public function getAttributs(): array {
		return $this->attributs;
	}

	/**
	 * Add attributs
	 *
	 * @param array $attributs
	 *
	 * @return self
	 */
	public function setAttributs(array $attributs): self {
		$this->attributs = $attributs;

		return $this;
	}
}
