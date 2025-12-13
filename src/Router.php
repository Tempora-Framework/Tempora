<?php

namespace Tempora;

use App\Controllers\ErrorController;
use Tempora\Controllers\Controller;
use Tempora\Enums\Path;
use Tempora\Traits\UserTrait;
use Tempora\Utils\Render\Render;
use Tempora\Utils\Roles;

class Router {
	use UserTrait;

	private string $clientUrl;
	private array $modules = [];

	public function __construct(string $url, array $modules = []) {
		$this->clientUrl = $url;
		$this->modules = $modules;
	}

	/**
	 * Add new route
	 *
	 * @param string     $url
	 * @param Controller $controller
	 * @param string     $method
	 * @param array      $pageData
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
	 * @param string     $url
	 * @param Controller $controller
	 * @param array      $pageData
	 *
	 * @return void
	 */
	private function render(string $url, Controller $controller, array $pageData): void {
		while (mb_substr(string: $this->clientUrl, start: -1) === "/") {
			$this->clientUrl = mb_substr(string: $this->clientUrl, start: 0, length: -1);
		}

		$urlParts = explode(separator: "/", string: $url);
		$clientUrlParts = explode(separator: "/", string: $this->clientUrl);

		// Serve Tempora assets in debug mode
		if (
			DEBUG
			&& str_contains(haystack: $this->clientUrl, needle: "/vendor/tempora-framework/tempora/assets/")
		) {
			header(header: "Content-type: text/css");

			include TEMPORA_DIR . str_replace(search: "/vendor/tempora-framework/tempora", replace: "", subject: $this->clientUrl);

			exit;
		}

		// Safeguard checks
		if (
			count(value: $urlParts) != count(value: $clientUrlParts)
			|| !$this->loginStateCheck(needLoginToBe: $pageData["page_needLoginToBe"])
			|| !$this->accessRolesCheck(accessRoles: $pageData["page_accessRoles"] ?? [])
		) {
			return;
		}

		// Parse URL parameters
		for ($i = 0; $i < count(value: $clientUrlParts); $i++) {
			if (mb_substr(string: $urlParts[$i], start: 0, length: 1) != "\$") {
				// Static part, check equality
				if ($urlParts[$i] != $clientUrlParts[$i]) {
					return;
				}
			} else {
				// Dynamic part, save parameter
				$pageData[ltrim(string: $urlParts[$i], characters: "\$")] = $clientUrlParts[$i];
			}
		}

		// Save session page data
		if (isset($_SESSION["page_data"])) {
			foreach ($_SESSION["page_data"] as $key => $data) {
				$pageData[$key] = $data;
			}

			unset($_SESSION["page_data"]);
		}

		// Render page
		$webpageRender = new Render(
			buffer: $this->webpageRender(controller: $controller, pageData: $pageData),
			modules: $this->modules
		);

		echo $webpageRender->render();

		exit;
	}

	/**
	 * Webpage render
	 *
	 * @param Controller $controller
	 * @param array      $pageData
	 *
	 * @return string
	 */
	private function webpageRender(Controller $controller, array $pageData): string {
		ob_start();

		$controller
			->setPageData(pageData: $pageData)
			->render()
		;

		// Import Chronos
		if (
			DEBUG
			&& !in_array(needle: "Content-Type: application/json", haystack: headers_list())
		) {
			include Path::COMPONENT_CHRONOS->value . "/chronos.php";
		}

		return ob_get_clean();
	}

	/**
	 * Check login state
	 *
	 * @param bool|null $needLoginToBe
	 *
	 * @return bool
	 */
	private function loginStateCheck(?bool $needLoginToBe = null): bool {
		if (!isset($needLoginToBe)) {
			return true;
		}

		if ($needLoginToBe) {
			return isset($_SESSION["user"]);
		} else {
			return !isset($_SESSION["user"]);
		}
	}

	/**
	 * Check access roles
	 *
	 * @param array $accessRoles
	 *
	 * @return bool
	 */
	private function accessRolesCheck(array $accessRoles): bool {
		if (empty($accessRoles)) {
			return true;
		}

		if (!isset($_SESSION["user"])) {
			return false;
		}

		return Roles::check(userRoles: USER_ROLES, allowRoles: $accessRoles);
	}

	/**
	 * Error page
	 *
	 * @param array $pageData
	 *
	 * @return void
	 */
	public function error(array $pageData): void {
		(new ErrorController)
			->setPageData(pageData: $pageData)
			->render()
		;

		if (DEBUG) {
			include Path::COMPONENT_CHRONOS->value . "/chronos.php";
		}
	}
}
