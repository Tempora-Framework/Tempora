<?php

namespace Tempora\Controllers\API;

use Tempora\Attributes\RouteAttribute;
use Tempora\Controllers\Controller;
use Tempora\Models\Services\APIService;

class GETController extends Controller {
	#[RouteAttribute(
		path: "/api",
		name: "app_api_index_get",
		method: "GET",
		description: "API index page",
	)]

	public function __invoke(): void {
		header(header: "Content-Type: application/json");

		$data["name"] = APP_NAME;
		$data["version"] = TEMPORA_VERSION;

		$api = new APIService;
		echo $api(data: $data);
	}
}
