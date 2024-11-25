<?php

namespace App\Models\Entities;

class API {
	public array $data;

	/**
	 * API construct
	 *
	 * @param array $data
	 */
	public function __construct(array $data) {
		$this->data = $data;
	}
}
