<?php

namespace App\Controllers\Accounts;

use App\Configs\Path;
use App\Models\Entities\ResetPassword;
use App\Models\Repositories\ResetPasswordRepository;
use App\Utils\System;

class ResetController {
	public function render(array $pageData): void {
		$resetPasswordRepo = new ResetPasswordRepository(resetPassword: new ResetPassword(link: $pageData["link"]));

		if ($resetPasswordRepo->getUid() === null)
			System::redirect(url: "/");

		$scripts = [
			"/scripts/engine.js",
			"/scripts/theme.js"
		];

		require Path::LAYOUT . "/header.php";

		require Path::LAYOUT . "/reset/index.php";

		include Path::LAYOUT . "/footer.php";
	}
}
