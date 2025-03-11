<?php

namespace App\Controllers\API;

use App\Models\Entities\API;
use App\Models\Services\APIService;

class APIController {
	public function render(): void {
		header(header: "Content-Type: application/json");

		switch ($_SERVER["REQUEST_METHOD"]) {
			case "GET":
				$data["name"] = APP_NAME;
				$data["version"] = "1.0.0";

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
