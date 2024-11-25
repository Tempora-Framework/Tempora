<?php

namespace App;

use App\Controllers\ErrorController;

class Router {
	protected array $routes = [];

	public function add($url, $path, $title = APP_NAME) : void {
		$this->routes[$url] = [$path, $title];
	}

	public function render($url) : void {
		while (mb_substr(string: $url, start: -1) === "/") {
			$url = mb_substr(string: $url, start: 0, length: -1);
		}

		$view = $this->routes[$url][0] ?? null;
		if ($view) {
			define(constant_name: "TITLE", value: $this->routes[$url][1]);
			$controller = new $view;
			$controller->render();
		} else {
			define(constant_name: "TITLE", value: $this->routes["/error"][1]);
			$controller = new ErrorController();
			$controller->render(errorCode: 404);
		}
	}
}
