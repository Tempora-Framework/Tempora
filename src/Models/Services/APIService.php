<?php

namespace App\Models\Services;

class APIService {
	/**
	 * API response
	 *
	 * @param array $data
	 *
	 * @return string
	 */
	public function __invoke(array $data): string {
		return json_encode(value: $data);
	}
}
