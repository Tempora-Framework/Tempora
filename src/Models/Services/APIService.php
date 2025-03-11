<?php

namespace App\Models\Services;

use App\Models\Entities\API;

class APIService {
	private $api;

	/**
	 * APIRepository construct
	 *
	 * @param API $api
	 */
	public function __construct(API $api) {
		$this->api = $api;
	}

	/**
	* Answer API method
	*
	* @return string
	*/
	public function answer(): string {
		return json_encode(value: $this->api->data);
	}
}
