<?php

namespace App\Controllers\API;

use App\Attributes\RouteAttribute;
use App\Controllers\Controller;
use App\Models\Services\APIService;

class GETController extends Controller {
	#[RouteAttribute(path: "/api", method: "GET")]
	public function __invoke(): void {
		header(header: "Content-Type: application/json");

		$data["name"] = APP_NAME;
		$data["version"] = TEMPORA_VERSION;

		$api = new APIService;
		echo $api(data: $data);
	}
}
