<?php

namespace Tempora\Factories;

use Tempora\Router;
use Tempora\Utils\Cache\Cache;
use Tempora\Utils\Lang;
use Tempora\Utils\Route;
use Tempora\Utils\System;

class RouterFactory extends Router {
	public function __construct(string $url, array $modules = []) {
		parent::__construct(url: $url, modules: $modules);

		$controllers = System::getAllFiles(path: APP_DIR . "/src/Controllers");

		$cache = new Cache(file: "routes.json");

		foreach ($controllers as $controller) {
			$controller = Route::getController(controller: $controller);
			$routeAttributes = Route::getAttributes(controller: $controller);

			if (count(value: $routeAttributes) > 0) {
				$routeAttribute = $routeAttributes[0]->newInstance();
			}

			$cache->add(name: $routeAttribute->name, value: $routeAttribute->path);
		}

		$cache->create();

		foreach ($controllers as $controller) {
			$controller = Route::getController(controller: $controller);
			$routeAttributes = Route::getAttributes(controller: $controller);

			if (count(value: $routeAttributes) > 0) {
				$routeAttribute = $routeAttributes[0]->newInstance();

				parent::check(
					url: $routeAttribute->path,
					controller: $controller,
					method: $routeAttribute->method,
					pageData: [
						"page_name" => $routeAttribute->name,
						"page_title" => ($routeAttribute->translateTitle && $routeAttribute->translateFile) ? APP_NAME . " - " . (new Lang(filePath: $routeAttribute->translateFile))->translate(key: $routeAttribute->title) : $routeAttribute->title,
						"page_description" => $routeAttribute->description,
						"page_needLoginToBe" => $routeAttribute->needLoginToBe,
						"page_accessRoles" => $routeAttribute->accessRoles ? array_map(
							callback: function ($role): mixed {
								return $role->value;
							},
							array: $routeAttribute->accessRoles
						) : null
					]
				);
			}
		}

		$lang = new Lang(filePath: "pages/error", source: TEMPORA_DIR . "/src/assets");
		Router::error(
			pageData: [
				"page_title" => APP_NAME . " - " . $lang->translate(key: "ERROR"),
				"error_code" => 404,
				"error_message" => $lang->translate(key: "ERROR_404")
			]
		);
	}
}
