<?php

namespace Tempora\Controllers;

use Tempora\Enums\Path;
use Tempora\Utils\Lang;

class ErrorController extends Controller {
	public function render(): void {
		$pageData = $this->getPageData();
		$pageLang = new Lang(filePath: "pages/error", source: TEMPORA_DIR . "/src/assets");

		http_response_code(response_code: $pageData["error_code"]);

		$this->setStyles(styles: [
			TEMPORA_REMIXICON_CSS,
			TEMPORA_INTER_FONT
		]);

		echo "<style>";
		echo file_get_contents(filename: TEMPORA_DIR . "/assets/styles/error.css");
		echo "</style>";

		require Path::LAYOUT->value . "/header.php";

		require Path::LAYOUT->value . "/error/index.php";
	}
}
