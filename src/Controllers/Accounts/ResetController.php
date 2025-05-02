<?php

namespace App\Controllers\Accounts;

use App\Attributes\RouteAttribute;
use App\Controllers\Controller;
use App\Enums\Path;
use App\Factories\NavbarFactory;
use App\Models\Repositories\ResetPasswordRepository;
use App\Utils\System;

class ResetController extends Controller {
	#[RouteAttribute(
		path: '/reset/$link',
		name: 'app_account_reset_get',
		method: "GET",
		description: "Reset password page",
		title: "RESET_TITLE",
		needLoginToBe: false
	)]

	public function __invoke(): void {
		$pageData = $this->getPageData();

		$resetPasswordRepo = new ResetPasswordRepository;
		$resetPasswordRepo
			->setLink(link: $pageData["link"])
			->setUid()
		;

		if ($resetPasswordRepo->getUid() === null)
			System::redirect(url: "/");

		$scripts = [
			"/scripts/engine.js",
			"/scripts/theme.js"
		];

		require Path::LAYOUT->value . "/header.php";

		(new NavbarFactory())->render();

		require Path::LAYOUT->value . "/reset/index.php";

		include Path::LAYOUT->value . "/footer.php";
	}
}
