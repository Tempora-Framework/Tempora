<?php

namespace App\Controllers\API;

use App\Models\Entities\API;
use App\Models\Services\APIService;

class GETController {
	public function render(array $pageData): void {
		header(header: "Content-Type: application/json");

		$data["name"] = APP_NAME;
		$data["version"] = TEMPORA_VERSION;

		$api = new APIService;
		echo $api(data: $data);
	}
}
