<?php

namespace Tempora;

use Tempora\Enums\Path;
use Tempora\Models\Repositories\UserRepository;
use Tempora\Utils\Lang;
use Tempora\Utils\Roles;
use Tempora\Controllers\Controller;

class Router {
	private $clientUrl;
	private	$controllersPath = "Tempora\Controllers\\";

	public function __construct(string $url) {
		$this->clientUrl = $url;
	}

	/**
	 * Add new route
	 *
	 * @param string $url
	 * @param Controller $controller
	 * @param string $method
	 * @param array $pageData
	 *
	 * @return void
	 */
	public function check(string $url, Controller $controller, string $method = "GET", array $pageData = []): void {
		if ($_SERVER["REQUEST_METHOD"] == $method) {
			$this->render(url: $url, controller: $controller, pageData: $pageData);
		}
	}

	/**
	 * Render view
	 *
	 * @param string $url
	 * @param Controller $controller
	 * @param array $pageData
	 *
	 * @return void
	 */
	private function render(string $url, Controller $controller, array $pageData): void {
		while (mb_substr(string: $this->clientUrl, start: -1) === "/") {
			$this->clientUrl = mb_substr(string: $this->clientUrl, start: 0, length: -1);
		}

		$urlParts = explode(separator: "/", string: $url);
		$clientUrlParts = explode(separator: "/", string: $this->clientUrl);

		// Safe gates
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

		if (isset($pageData["page_title"])) {
			$pageData["page_title"] = APP_NAME . " - " . Lang::translate(key: $pageData["page_title"]);
		} else {
			$pageData["page_title"] = APP_NAME;
		}

		$controller->setPageData(pageData: $pageData)();

		if (DEBUG == 1) {
			if (!in_array(needle: "Content-Type: application/json", haystack: headers_list())) {
				include Path::COMPONENT_TOOLBAR->value . "/toolbar.php";
			}
		}

		exit;
	}

	public function error(array $pageData): void {
		(new ($this->controllersPath . "ErrorController"))->setPageData(pageData: $pageData)();

		if (DEBUG == 1)
			include Path::COMPONENT_TOOLBAR->value . "/toolbar.php";
	}
}
