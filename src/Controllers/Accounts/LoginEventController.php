<?php

namespace App\Controllers\Accounts;

use App\Attributes\RouteAttribute;
use App\Controllers\Controller;
use App\Models\Repositories\UserRepository;
use App\Utils\Cookie;
use App\Utils\Lang;
use App\Utils\System;
use Exception;

class LoginEventController extends Controller {
	#[RouteAttribute(
		path: "/login",
		method: "POST"
	)]

	public function __invoke(): void {
		if (
			System::checkCSRF()
			&& isset($_POST["email"])
			&& isset($_POST["password"])
		) {
			$userRepo = new UserRepository;
			$userRepo
				->setEmail(email: $_POST["email"])
				->setPassword(password: $_POST["password"])
			;

			$uid = $userRepo->verifyPassword();

			if ($uid instanceof Exception) {
				$notificationCookie = new Cookie;
				$notificationCookie
					->setName(name: "NOTIFICATION")
					->setValue(value: Lang::translate(key: "LOGIN_WRONG_CREDENTIALS"))
				;
				$notificationCookie->send();

				$_SESSION["page_data"] = [
					"form_email" => $_POST["email"],
					"form_password" => $_POST["password"]
				];
			} else {
				$_SESSION["user"]["uid"] = $uid;
				System::redirect(url: "/");
			}
		}

		System::redirect();
	}
}
