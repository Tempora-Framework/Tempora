<?php

namespace App\Controllers\Accounts;

use App\Enums\Path;
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

		require Path::LAYOUT->value . "/header.php";

		require Path::LAYOUT->value . "/reset/index.php";

		include Path::LAYOUT->value . "/footer.php";
	}
}
