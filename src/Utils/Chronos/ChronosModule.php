<?php

namespace Tempora\Utils\Chronos;

use Tempora\Utils\ElementBuilder\ElementBuilder;

abstract class ChronosModule {
	public bool $enabled = true;
	public string $id;
	public string $title;
	public string $icon;
	public string $color = "#8d1d1d";
	public ?string $displayValue;
	public ?string $additionalClass;
	public array $pageData = [];

	/**
	 * Gets the generated content of Chronos module.
	 *
	 * @return ElementBuilder
	 */
	abstract public function getContent(): ElementBuilder;

	/**
	 * Sets the display value for Chronos module.
	 *
	 * @return string
	 */
	abstract public function setDisplay(): string;

	/**
	 * Renders the Chronos module.
	 *
	 * @return void
	 */
	public function render(): void {
		$this->displayValue = $this->setDisplay();

		$result = (new ElementBuilder)
			->setElement(element: "div")
			->setAttributs(
				attributs: [
					"class" => "tempora_chronos_drop_container"
				]
			)
			->setContent(
				content: (new ElementBuilder)
					->setElement(element: "p")
					->setAttributs(
						attributs: [
							"class" => "tempora_chronos_drop_hover_element" . (isset($this->additionalClass) ? (" " . $this->additionalClass) : ""),
							"title" => htmlspecialchars(string: $this->title),
						]
					)
					->setContent(
						content: $this->createIconElement()->build() . " " . ($this->displayValue ?? "")
					)
					->build()

					. (new ElementBuilder)
						->setElement(element: "div")
						->setAttributs(
							attributs: [
								"class" => "tempora_chronos_block_content",
								"data-id" => htmlspecialchars(string: $this->id),
								"data-color" => htmlspecialchars(string: $this->color)
							]
						)
						->setContent(
							content:
								'<div class="tempora_chronos_drop_element_header">'
									. $this->createIconElement()->build()
									. $this->createTitleElement(title: $this->title)->build()
									. '<i class="ri-pushpin-line pin"></i>
								</div>'

								. '<div class="content">' . $this->getContent()->build() . "</div>"
						)
						->build()
			)
			->build()
		;

		echo $result;
	}

	/**
	 * Creates the icon element for Chronos module.
	 *
	 * @return ElementBuilder
	 */
	public function createIconElement(): ElementBuilder {
		return (new ElementBuilder)
			->setElement(element: "i")
			->setAttributs(
				attributs: [
					"class" => $this->icon
				]
			)
		;
	}

	/**
	 * Creates the title element for Chronos module.
	 *
	 * @param string $title
	 *
	 * @return ElementBuilder
	 */
	public function createTitleElement(string $title): ElementBuilder {
		return (new ElementBuilder)
			->setElement(element: "h1")
			->setContent(
				content: htmlspecialchars(string: $title)
			)
		;
	}
}
