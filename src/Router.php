<?php

namespace App;

use App\Controllers\ErrorController;
use App\Models\Repositories\UserRepository;
use App\Utils\Lang;
use App\Utils\Roles;

class Router {
	protected array $routes = [];

	/**
	 * Create routeur's routes
	 *
	 * @param string $url Access URL
	 * @param string $controller View's controller
	 * @param string $title View's title
	 * @param bool $needLoginToBe Does user have to be connected or have to be disconnected, null for no restrictions
	 * @param array $accessRoles Roles that can render view
	 *
	 * @return void
	 */
	public function add(string $url, string $controller, string $title = APP_NAME, bool $needLoginToBe = null, array $accessRoles = []): void {
		$this->routes[$url] = [
			"controller" => $controller,
			"title" => $title,
			"needLoginToBe" => $needLoginToBe,
			"accessRoles" => $accessRoles
		];
	}

	/**
	 * Render route's view
	 *
	 * @param string $url Access URL
	 *
	 * @return void
	 */
	public function render(string $url): void {
		while (mb_substr(string: $url, start: -1) === "/") {
			$url = mb_substr(string: $url, start: 0, length: -1);
		}

		$title = APP_NAME;
		global $title;
		$errorCode = 404;
		$view = $this->routes[$url]["controller"] ?? null;

		if ($view) {
			// Page accessible anytime for everyone
			if ($this->routes[$url]["needLoginToBe"] === null) {
				$GLOBALS["title"] = $this->routes[$url]["title"];
				$controller = new $view;
				$controller->render();
				exit;
			}

			// User is connected and need to be connected
			if ($this->routes[$url]["needLoginToBe"] === true && isset($_SESSION["user"])) {
				// User got necessary permissions
				if (
					$this->routes[$url]["accessRoles"] === []
					|| Roles::check(userRoles: UserRepository::getRoles(uid: $_SESSION["user"]["uid"]), allowRoles: $this->routes[$url]["accessRoles"])
				) {
					$GLOBALS["title"] = $this->routes[$url]["title"];
					$controller = new $view;
					$controller->render();
					exit;
				}

				$errorCode = 403;
			}

			// User is not connected and need to not be connected
			if ($this->routes[$url]["needLoginToBe"] === false && !isset($_SESSION["user"])) {
				$GLOBALS["title"] = $this->routes[$url]["title"];
				$controller = new $view;
				$controller->render();
				exit;
			}
		}

		$controller = new ErrorController();
		$controller->render(errorCode: $errorCode, message: Lang::translate(key: "ERROR_" . $errorCode));
	}
}
