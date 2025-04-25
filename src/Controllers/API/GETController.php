<?php

namespace App\Controllers\API;

use App\Controllers\Controller;
use App\Models\Services\APIService;

class GETController extends Controller {
	public function __invoke(): void {
		header(header: "Content-Type: application/json");

		$data["name"] = APP_NAME;
		$data["version"] = TEMPORA_VERSION;

		$api = new APIService;
		echo $api(data: $data);
	}
}
