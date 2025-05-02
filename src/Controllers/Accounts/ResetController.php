<?php

namespace Tempora\Controllers\Accounts;

use Tempora\Attributes\RouteAttribute;
use Tempora\Controllers\Controller;
use Tempora\Enums\Path;
use Tempora\Factories\NavbarFactory;
use Tempora\Models\Repositories\ResetPasswordRepository;
use Tempora\Utils\System;

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
