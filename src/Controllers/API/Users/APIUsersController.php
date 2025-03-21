<?php

namespace App\Controllers\API\Users;

use App\Models\Entities\API;
use App\Models\Services\APIService;
use App\Utils\ApplicationData;

class APIUsersController {
	public function render(array $pageData): void {
		header(header: "Content-Type: application/json");

		switch ($_SERVER["REQUEST_METHOD"]) {
			case "GET":
				$data = [];
				foreach (ApplicationData::getUsers() as $user) {
					array_push($data, $user);
				}

				$api = new API(data: $data);
				break;
			default:
				http_response_code(response_code: 404);

				$data["error"] = "Not found";
				$data["description"] = "Unknown API call.";

				$api = new API(data: $data);
				break;
		}

		$apiRepo = new APIService(api: $api);
		echo $apiRepo->answer();
	}
}
