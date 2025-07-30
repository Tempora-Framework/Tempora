<?php

namespace Tempora\Utils\ElementBuilder;

use Tempora\Utils\Roles;

class ElementBuilder {

	protected ?string $element = null;
	private array $attributs = [];
	private ?string $content = null;
	private bool $accessibility = false;
	private array $accessRoles = [];
	private ?bool $needLoginToBe = null;

	/**
	 * Element render
	 *
	 * @return string
	 */
	public function build(): string {
		if (
			(
				$this->accessRoles === []
				|| (
					isset($_SESSION["user"])
					&& Roles::check(userRoles: USER_ROLES, allowRoles: $this->accessRoles)
				)
			)
			&& (
				$this->needLoginToBe === null
				|| (
					$this->needLoginToBe === true
					&& isset($_SESSION["user"])
				)
				|| (
					$this->needLoginToBe === false
					&& !isset($_SESSION["user"])
				)
			)
		) {
			$result = "<" . $this->element;

			if ($this->accessibility) {
				$result .= " aria-label=\"" . $this->attributs["label"] . "\"";
			}

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

		return "";
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

	/**
	 * Get the value of accessibility
	 *
	 * @return bool
	 */
	public function isAccessibility(): bool {
		return $this->accessibility;
	}

	/**
	 * Set the value of accessibility
	 *
	 * @param bool $accessibility
	 *
	 * @return self
	 */
	public function setAccessibility(bool $accessibility): self {
		$this->accessibility = $accessibility;

		return $this;
	}

	/**
	 * Get the value of accessRoles
	 *
	 * @return array
	 */
	public function getAccessRoles(): array {
		return $this->accessRoles;
	}

	/**
	 * Set the value of accessRoles
	 *
	 * @param array $accessRoles
	 *
	 * @return self
	 */
	public function setAccessRoles(array $accessRoles): self {
		$this->accessRoles = $accessRoles;

		return $this;
	}

	/**
	 * Get the value of needLoginToBe
	 *
	 * @return bool
	 */
	public function isNeedLoginToBe(): bool {
		return $this->needLoginToBe;
	}

	/**
	 * Set the value of needLoginToBe
	 *
	 * @param bool $needLoginToBe
	 *
	 * @return self
	 */
	public function setNeedLoginToBe(bool $needLoginToBe): self {
		$this->needLoginToBe = $needLoginToBe;

		return $this;
	}
}
