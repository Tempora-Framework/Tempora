<?php

namespace App\Factories;

use App\Router;
use App\Utils\Lang;
use App\Utils\Roles;

class RouterFactory extends Router {
	private $data;

	public function __construct(string $url) {
		parent::__construct(url: $url);

		$this->data = json_decode(json: file_get_contents(filename: BASE_DIR . "/src/Configs/routes.json"), associative: true);

		foreach ($this->data as $routeKey => $route) {
			foreach ($route as $methodKey => $method) {
				if (isset($method["title"])) {
					$pageData["page_title"] = APP_NAME . " - " . Lang::translate(key: $method["title"]);
				} else {
					$pageData["page_title"] = APP_NAME;
				}

				$pageData["page_needLoginToBe"] = $method["needLoginToBe"] ?? null;

				if (isset($method["accessRoles"])) {
					$pageData["page_accessRoles"] = [];

					foreach ($method["accessRoles"] as $role) {
						array_push($pageData["page_accessRoles"], Roles::getRoleByName(name: $role));
					}
				}

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
