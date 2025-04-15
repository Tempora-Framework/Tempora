<?php

namespace App\Utils\ElementBuilder;

class ElementBuilder {

	protected ?string $element = null;
	private ?string $class = null;
	private ?string $id = null;
	private ?string $name = null;
	private ?string $value = null;

	private ?string $content = null;

	public function render(): void {
		$result = "<" . $this->element;
		$result .= (isset($this->class) ? " class=\"" . $this->class . "\"" : "");
		$result .= (isset($this->id) ? " id=\"" . $this->id . "\"" : "");
		$result .= (isset($this->name) ? " name=\"" . $this->name . "\"" : "");
		$result .= (isset($this->value) ? " value=\"" . $this->value . "\"" : "");
		$result .= ">";

		$result .= $this->content;

		$result .= "</" . $this->element . ">";

		echo $result;
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
	 * Get the value of class
	 *
	 * @return string
	 */
	public function getClass(): string {
		return $this->class;
	}

	/**
	 * Set the value of class
	 *
	 * @param string $class
	 *
	 * @return self
	 */
	public function setClass(string $class): self {
		$this->class = $class;

		return $this;
	}

	/**
	 * Get the value of id
	 *
	 * @return string
	 */
	public function getId(): string {
		return $this->id;
	}

	/**
	 * Set the value of id
	 *
	 * @param string $id
	 *
	 * @return self
	 */
	public function setId(string $id): self {
		$this->id = $id;

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
}
