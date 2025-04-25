<?php

namespace App\Controllers;

class Controller {
	private array $pageData = [];

	/**
	 * Get the value of pageData
	 *
	 * @return array
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
}
