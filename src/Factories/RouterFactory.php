<?php

namespace App\Factories;

use App\Attributes\RouteAttribute;
use App\Router;
use App\Utils\Cache;
use App\Utils\Lang;
use App\Utils\System;
use ReflectionObject;

class RouterFactory extends Router {

	private array $routes = [];

	public function __construct(string $url) {
		parent::__construct(url: $url);

		$controllers = System::getAllFiles(path: BASE_DIR . "/src/Controllers");

		$cache = new Cache(file: "routes.json");

		foreach ($controllers as $controller) {
			$controller = str_replace(search: BASE_DIR . "/src/Controllers/", replace: "", subject: $controller);
			$controller = str_replace(search: ".php", replace: "", subject: $controller);
			$controller = str_replace(search: "/", replace: "\\", subject: $controller);
			$controller = new ("App\\Controllers\\" . $controller);

			$reflection = new ReflectionObject(object: $controller);
			$routeAttributes = $reflection->getMethods()[0]->getAttributes(name: RouteAttribute::class);

			if (count(value: $routeAttributes) > 0) {
				$routeAttribute = $routeAttributes[0]->newInstance();
				parent::check(url: $routeAttribute->path, controller: $controller, method: $routeAttribute->method, pageData: [
					"page_title" => $routeAttribute->title,
					"page_needLoginToBe" => $routeAttribute->needLoginToBe,
					"page_accessRoles" => $routeAttribute->accessRoles ? array_map(callback: function($role): mixed {
						return $role->value;
					}, array: $routeAttribute->accessRoles) : null
				]);
			}

			$cache->add(name: $routeAttribute->name, value: $routeAttribute->path);
		}

		$cache->create();

		parent::error(
			pageData: [
				"page_title" => APP_NAME . " - " . Lang::translate(key: "MAIN_ERROR"),
				"error_code" => 404,
				"error_message" => Lang::translate(key: "ERROR_404")
			]
		);
	}
}
