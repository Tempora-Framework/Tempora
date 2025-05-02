<?php

namespace App\Controllers\Accounts;

use App\Attributes\RouteAttribute;
use App\Controllers\Controller;
use App\Models\Repositories\UserRepository;
use App\Utils\Cookie;
use App\Utils\Lang;
use App\Utils\System;
use Exception;

class AccountEventController extends Controller {
	#[RouteAttribute(
		path: "/account",
		name: "app_account_post",
		method: "POST",
		description: "Account event page",
	)]

	public function __invoke(): void {
		if (
			System::checkCSRF()
			&& isset($_POST["old_password"])
			&& isset($_POST["new_password"])
			&& isset($_POST["new_password_confirm"])
		) {
			$userRepo = new UserRepository;
			$userRepo
				->setEmail(email: UserRepository::getInformations(uid: $_SESSION["user"]["uid"])["email"])
				->setPassword(password: $_POST["old_password"])
			;

			if ($userRepo->verifyPassword() instanceof Exception) {
				$notificationCookie = new Cookie;
				$notificationCookie
					->setName(name: "NOTIFICATION")
					->setValue(value: Lang::translate(key: "LOGIN_WRONG_CREDENTIALS"))
				;
				$notificationCookie->send();
				System::redirect();
			}

			if ($_POST["new_password"] === $_POST["new_password_confirm"]) {
				$userRepo = new UserRepository;
				$userRepo
					->setUid(uid: $_SESSION["user"]["uid"])
					->setPassword(password: $_POST["new_password"])
				;

				$userRepo->savePassword();

				System::redirect(url: "/");
			} else {
				$notificationCookie = new Cookie;
				$notificationCookie
					->setName(name: "NOTIFICATION")
					->setValue(value: Lang::translate(key: "REGISTER_UNIDENTICAL_PASSWORD"))
				;
				$notificationCookie->send();
			}
		}

		System::redirect();
	}
}
