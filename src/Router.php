<?php

namespace Tempora;

use Tempora\Enums\Path;
use App\Controllers\ErrorController;
use Tempora\Traits\UserTrait;
use Tempora\Utils\Render;
use Tempora\Utils\Roles;
use Tempora\Controllers\Controller;

class Router {

	use UserTrait;

	private string $clientUrl;
	private array $options = [];

	public function __construct(string $url, array $options = []) {
		$this->clientUrl = $url;
		$this->options = $options;
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
		if (DEBUG == 1) {
			if (str_contains(haystack: $this->clientUrl, needle: "/vendor/tempora-framework/tempora/assets/")) {
				header(header: "Content-type: text/css");
				include TEMPORA_DIR . str_replace(search: "/vendor/tempora-framework/tempora", replace: "", subject: $this->clientUrl);
				exit;
			}
		}

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
			&& !Roles::check(userRoles: USER_ROLES, allowRoles: $pageData["page_accessRoles"])
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

		$render = function($controller, $pageData): string {
			ob_start();
			$controller->setPageData(pageData: $pageData)();

			if (DEBUG == 1) {
				if (!in_array(needle: "Content-Type: application/json", haystack: headers_list())) {
					include Path::COMPONENT_CHRONOS->value . "/chronos.php";
				}
			}

			return ob_get_clean();
		};

		$webpageRender = new Render(
			buffer: $render(
				controller: $controller,
				pageData: $pageData
			)
		);

		if (in_array("remove_whitespace_between_tags", $this->options)) {
			$webpageRender = $webpageRender->removeWhitespaceBetweenTags();
		}

		if (in_array("remove_trailing_whitespace", $this->options)) {
			$webpageRender = $webpageRender->removeTrailingWhitespace();
		}

		if (in_array("remove_empty_lines", $this->options)) {
			$webpageRender = $webpageRender->removeEmptyLines();
		}

		if (in_array("remove_new_lines", $this->options)) {
			$webpageRender = $webpageRender->removeNewLines();
		}

		if (in_array("remove_comments", $this->options)) {
			$webpageRender = $webpageRender->removeComments();
		}

		if (in_array("collapse_spaces", $this->options)) {
			$webpageRender = $webpageRender->collapseSpaces();
		}

		echo $webpageRender->render();

		exit;
	}

	public function error(array $pageData): void {
		(new ErrorController)->setPageData(pageData: $pageData)();

		if (DEBUG == 1)
			include Path::COMPONENT_CHRONOS->value . "/chronos.php";
	}
}
