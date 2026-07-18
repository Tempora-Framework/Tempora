<?php

namespace Tempora\Utils;

use ReflectionObject;
use Tempora\Attributes\RouteAttribute;
use Tempora\Controllers\Controller;

class Route {
	/**
	 * Get controller instance
	 *
	 * @param string $controller
	 *
	 * @return object
	 */
	public static function getController(string $controller): Controller {
		$controller = str_replace(search: APP_DIR . "/src/Controllers/", replace: "", subject: $controller);
		$controller = str_replace(search: ".php", replace: "", subject: $controller);
		$controller = str_replace(search: "/", replace: "\\", subject: $controller);

		return new ("App\\Controllers\\" . $controller);
	}

	/**
	 * Get controller attributes
	 *
	 * @param Controller $controller
	 *
	 * @return array
	 */
	public static function getAttributes(Controller $controller): array {
		$reflection = new ReflectionObject(object: $controller);

		return $reflection->getMethods()[0]->getAttributes(name: RouteAttribute::class);
	}
}
