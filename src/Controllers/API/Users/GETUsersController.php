<?php

namespace Tempora\Controllers\API\Users;

use Tempora\Attributes\RouteAttribute;
use Tempora\Controllers\Controller;
use Tempora\Models\Services\APIService;
use Tempora\Utils\ApplicationData;

class GETUsersController extends Controller {
	#[RouteAttribute(
		path: "/api/users",
		name: "app_api_users_get",
		method: "GET",
		description: "API users page",
	)]

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
