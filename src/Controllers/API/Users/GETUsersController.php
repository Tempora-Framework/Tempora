<?php

namespace App\Controllers\API\Users;

use App\Controllers\Controller;
use App\Models\Services\APIService;
use App\Utils\ApplicationData;

class GETUsersController extends Controller {
	public function __invoke(): void {
		header(header: "Content-Type: application/json");

		$data = [];
		foreach (ApplicationData::getUsers() as $user) {
			array_push($data, $user);
		}

		$api = new APIService;
		echo $api(data: $data);
	}
}
