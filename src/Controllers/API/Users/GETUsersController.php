<?php

namespace App\Controllers\API\Users;

use App\Models\Services\APIService;
use App\Utils\ApplicationData;

class GETUsersController {
	public function render(array $pageData): void {
		header(header: "Content-Type: application/json");

		$data = [];
		foreach (ApplicationData::getUsers() as $user) {
			array_push($data, $user);
		}

		$api = new APIService;
		echo $api(data: $data);
	}
}
