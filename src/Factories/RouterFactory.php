<?php

namespace App\Factories;

use App\Router;
use App\Utils\Lang;

class RouterFactory extends Router {
	private $data;

	public function __construct(string $url) {
		parent::__construct(url: $url);

		$this->data = json_decode(json: file_get_contents(filename: BASE_DIR . "/src/Configs/routes.json"), associative: true);

		foreach ($this->data as $routeKey => $route) {
			foreach ($route as $methodKey => $method) {
				$pageData["title"] = $method["title"] ?? null;
				$pageData["needLoginToBe"] = $method["needLoginToBe"] ?? null;
				$pageData["accessRoles"] = $method["accessRoles"] ?? null;

				parent::check(url: $routeKey, controller: str_replace(search: "/", replace: "\\", subject: $method["controller"]), method: $methodKey, pageData: $pageData);
			}
		}

		parent::error(
			pageData: [
				"page_title" => APP_NAME . " - " . Lang::translate(key: "MAIN_ERROR"),
				"error_code" => 404,
				"error_message" => Lang::translate(key: "ERROR_404")
			]
		);
	}
}
