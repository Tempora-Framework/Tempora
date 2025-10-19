<?php

namespace Tempora\Factories;

use Tempora\Attributes\RouteAttribute;
use Tempora\Controllers\Controller;
use Tempora\Router;
use Tempora\Utils\Cache\Cache;
use Tempora\Utils\Lang;
use Tempora\Utils\System;
use ReflectionObject;

class RouterFactory extends Router {

	public function __construct(string $url, array $options = []) {
		parent::__construct(url: $url, options: $options);

		$controllers = System::getAllFiles(path: APP_DIR . "/src/Controllers");

		$cache = new Cache(file: "routes.json");

		foreach ($controllers as $controller) {
			$controller = $this->getController(controller: $controller);
			$routeAttributes = $this->getAttributes(controller: $controller);

			if (count(value: $routeAttributes) > 0)
				$routeAttribute = $routeAttributes[0]->newInstance();

			$cache->add(name: $routeAttribute->name, value: $routeAttribute->path);
		}

		$cache->create();

		foreach ($controllers as $controller) {
			$controller = $this->getController(controller: $controller);
			$routeAttributes = $this->getAttributes(controller: $controller);

			if (count(value: $routeAttributes) > 0) {
				$routeAttribute = $routeAttributes[0]->newInstance();
				parent::check(
					url: $routeAttribute->path,
					controller: $controller,
					method: $routeAttribute->method,
					pageData: [
						"page_name" => $routeAttribute->name,
						"page_title" => $routeAttribute->translateTitle ? APP_NAME . " - " . Lang::translate(key: $routeAttribute->title) : $routeAttribute->title,
						"page_description" => $routeAttribute->description,
						"page_needLoginToBe" => $routeAttribute->needLoginToBe,
						"page_accessRoles" => $routeAttribute->accessRoles ? array_map(
							callback: function($role): mixed {
								return $role->value;
							},
							array: $routeAttribute->accessRoles
						): null
					]
				);
			}

			$cache->add(name: $routeAttribute->name, value: $routeAttribute->path);
		}

		parent::error(
			pageData: [
				"page_title" => APP_NAME . " - " . Lang::translate(key: "MAIN_ERROR"),
				"error_code" => 404,
				"error_message" => Lang::translate(key: "ERROR_404")
			]
		);
	}

	private function getController(string $controller): Controller {
		$controller = str_replace(search: APP_DIR . "/src/Controllers/", replace: "", subject: $controller);
		$controller = str_replace(search: ".php", replace: "", subject: $controller);
		$controller = str_replace(search: "/", replace: "\\", subject: $controller);

		return new ("App\\Controllers\\" . $controller);
	}

	private function getAttributes(Controller $controller): array {
		$reflection = new ReflectionObject(object: $controller);

		return $reflection->getMethods()[0]->getAttributes(name: RouteAttribute::class);
	}
}
