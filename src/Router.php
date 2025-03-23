<?php

namespace App;

use App\Models\Repositories\UserRepository;
use App\Utils\Roles;

class Router {
	private $clientUrl;
	private	$controllersPath = "App\Controllers\\";

	public function __construct(string $url) {
		$this->clientUrl = $url;
	}

	/**
	 * Add new route
	 *
	 * @param string $url
	 * @param string $controller
	 * @param string $method
	 * @param array $pageData
	 *
	 * @return void
	 */
	public function check(string $url, string $controller, string $method = "GET", array $pageData = []): void {
		if ($_SERVER["REQUEST_METHOD"] == $method) {
			$this->render(url: $url, controller: $controller, pageData: $pageData);
		}
	}

	/**
	 * Render view
	 *
	 * @param string $url
	 * @param string $controller
	 * @param array $pageData
	 *
	 * @return void
	 */
	private function render(string $url, string $controller, array $pageData): void {
		while (mb_substr(string: $this->clientUrl, start: -1) === "/") {
			$this->clientUrl = mb_substr(string: $this->clientUrl, start: 0, length: -1);
		}

		$urlParts = explode(separator: "/", string: $url);
		$clientUrlParts = explode(separator: "/", string: $this->clientUrl);

		// Safe gate
		if (count(value: $urlParts) != count(value: $clientUrlParts))
			return;
		if (isset($pageData["page_needLoginToBe"])) {
			if (isset($_SESSION["user"]) && $pageData["page_needLoginToBe"] === false)
				return;
			if (!isset($_SESSION["user"]) && $pageData["page_needLoginToBe"] === true)
				return;
		}
		if (
			isset($pageData["page_accessRoles"])
			&& $pageData["page_needLoginToBe"] === true
			&& !Roles::check(userRoles: UserRepository::getRoles(uid: $_SESSION["user"]["uid"]), allowRoles: $pageData["page_accessRoles"])
		)
			return;

		for ($i = 0; $i < count(value: $clientUrlParts); $i++) {
			if (mb_substr(string: $urlParts[$i], start: 0, length: 1) != "$") {
				if ($urlParts[$i] != $clientUrlParts[$i]) {
					return;
				}
			} else {
				$pageData[ltrim(string: $urlParts[$i], characters: "$")] = $clientUrlParts[$i];
			}
		}

		if (isset($_SESSION["page_data"])) {
			foreach ($_SESSION["page_data"] as $key => $data) {
				$pageData[$key] = $data;
			}

			unset($_SESSION["page_data"]);
		}

		(new ($this->controllersPath . $controller))->render(pageData: $pageData);

		exit;
	}

	public function error(array $pageData): void {
		(new ($this->controllersPath . "ErrorController"))->render(pageData: $pageData);
	}
}
