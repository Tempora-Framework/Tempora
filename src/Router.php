<?php

namespace App;

use App\Controllers\ErrorController;
use App\Models\Repositories\UserRepository;
use App\Utils\Lang;

class Router {
	protected array $routes = [];

	/**
	 * Create routeur's routes
	 *
	 * @param mixed $url Access URL
	 * @param mixed $controller View's controller
	 * @param mixed $title View's title
	 * @param mixed $needLoginToBe Does user have to be connected or have to be disconnected, null for full access
	 * @param mixed $accessRoles Roles that can render view
	 *
	 * @return void
	 */
	public function add($url, $controller, $title = APP_NAME, $needLoginToBe = null, $accessRoles = []) : void {
		$this->routes[$url] = [
			$controller,
			$title,
			$needLoginToBe,
			$accessRoles
		];
	}

	/**
	 * Render route's view
	 *
	 * @param mixed $url Access URL
	 *
	 * @return void
	 */
	public function render($url) : void {
		while (mb_substr(string: $url, start: -1) === "/") {
			$url = mb_substr(string: $url, start: 0, length: -1);
		}

		$errorCode = 404;
		$view = $this->routes[$url][0] ?? null;
		if ($view) {
			// Page accessible anytime for everyone
			if ($this->routes[$url][2] === null) {
				define(constant_name: "TITLE", value: $this->routes[$url][1]);
				$controller = new $view;
				$controller->render();
				exit;
			}

			// User is connected and need to be connected
			if ($this->routes[$url][2] == true && isset($_SESSION["user"])) {
				// User got necessary permissions
				if (
					!empty(array_intersect($this->routes[$url][3], UserRepository::getRoles(uid: $_SESSION["user"]["uid"])))
					|| $this->routes[$url][3] === []
				) {
					define(constant_name: "TITLE", value: $this->routes[$url][1]);
					$controller = new $view;
					$controller->render();
					exit;
				}
				$errorCode = 403;
			}

			// User is not connected and need to not be connected
			if ($this->routes[$url][2] == false && !isset($_SESSION["user"])) {
				define(constant_name: "TITLE", value: $this->routes[$url][1]);
				$controller = new $view;
				$controller->render();
				exit;
			}
		}
		$controller = new ErrorController();
		$controller->render(errorCode: $errorCode, message: Lang::translate(key: "ERROR_" . $errorCode));
	}
}
