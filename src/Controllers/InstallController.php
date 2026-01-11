<?php

namespace Tempora\Controllers;

use Tempora\Enums\Path;
use Tempora\Utils\Lang;

class InstallController extends Controller {
	public function render(): void {
		$pageData = $this->getPageData();
		$pageLang = new Lang(filePath: "pages/install", source: TEMPORA_DIR . "/src/assets");

		$this->setStyles(styles: [
			TEMPORA_REMIXICON_CSS,
			TEMPORA_INTER_FONT
		]);

		echo "<style>";
		echo file_get_contents(filename: TEMPORA_DIR . "/assets/styles/install.css");
		echo "</style>";

		require Path::LAYOUT->value . "/header.php";

		require Path::LAYOUT->value . "/install/index.php";
	}
}
