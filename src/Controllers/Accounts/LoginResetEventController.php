<?php

namespace Tempora\Controllers\Accounts;

use Tempora\Attributes\RouteAttribute;
use Tempora\Controllers\Controller;
use Tempora\Models\Repositories\ResetPasswordRepository;
use Tempora\Models\Repositories\UserRepository;
use Tempora\Utils\Cookie;
use Tempora\Utils\Lang;
use Tempora\Utils\System;

class LoginResetEventController extends Controller {
	#[RouteAttribute(
		path: "/login/reset",
		name: "app_account_login_reset_post",
		method: "POST"
	)]

	public function __invoke(): void {
		if (
			System::checkCSRF()
			&& isset($_POST["email"])
		) {
			if (UserRepository::getUidByEmail(email: $_POST["email"]) === null)
				System::redirect(url: "/login");

			$resetRepo = new ResetPasswordRepository;
			$resetRepo
				->setEmail(email: $_POST["email"])
				->setUid(uid: UserRepository::getUidByEmail(email: $_POST["email"]))
			;

			if ($resetRepo->isUserUid())
				System::redirect(url: "/login");

			$resetRepo->generateResetLink();
		}

		$notificationCookie = new Cookie;
		$notificationCookie
			->setName(name: "NOTIFICATION")
			->setValue(value: Lang::translate(key: "LOGIN_RESET_SEND"))
		;
		$notificationCookie->send();

		System::redirect(url: "/login");
	}
}
