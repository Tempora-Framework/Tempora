<?php

namespace App\Controllers\Accounts;

use App\Controllers\Controller;
use App\Models\Repositories\ResetPasswordRepository;
use App\Models\Repositories\UserRepository;
use App\Utils\Cookie;
use App\Utils\Lang;
use App\Utils\System;

class LoginResetEventController extends Controller {
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
