<?php

namespace App\Models\Entities;

class API {
	private array $data;

	/**
	 * API construct
	 *
	 * @param array $data
	 */
	public function __construct(array $data) {
		$this->data = $data;
	}

	public function __get($var): mixed {
		return $this->$var;
	}
}
