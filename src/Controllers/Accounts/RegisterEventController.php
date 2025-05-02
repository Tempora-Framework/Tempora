<?php

namespace Tempora\Controllers\Accounts;

use Tempora\Attributes\RouteAttribute;
use Tempora\Controllers\Controller;
use Tempora\Models\Repositories\UserRepository;
use Tempora\Utils\Cookie;
use Tempora\Utils\Lang;
use Tempora\Utils\System;
use Exception;

class RegisterEventController extends Controller {
	#[RouteAttribute(
		path: "/register",
		name: "app_account_register_post",
		method: "POST"
	)]

	public function __invoke(): void {
		if (
			System::checkCSRF()
			&& isset($_POST["name"])
			&& isset($_POST["surname"])
			&& isset($_POST["email"])
			&& isset($_POST["password"])
			&& isset($_POST["password_confirm"])
		) {
			$notificationCookie = new Cookie;
			$notificationCookie->setName(name: "NOTIFICATION");

			if ($_POST["password"] === $_POST["password_confirm"]) {
				$userRepo = new UserRepository;
				$userRepo
					->setName(name: $_POST["name"])
					->setSurname(surname: $_POST["surname"])
					->setEmail(email: $_POST["email"])
					->setPassword(password: $_POST["password"])
				;

				$uid = $userRepo->create();

				if ($uid instanceof Exception) {
					$notificationCookie->setValue(value: Lang::translate(key: "REGISTER_ALREADY_EXIST", options: ["email" => htmlspecialchars(string: $_POST["email"])]));
					$notificationCookie->send();
				} else {
					$_SESSION["user"]["uid"] = $uid;
					System::redirect(url: "/");
				}
			} else {
				$notificationCookie->setValue(value: Lang::translate(key: "REGISTER_UNIDENTICAL_PASSWORD"));
				$notificationCookie->send();
			}

			$_SESSION["page_data"] = [
				"form_name" => $_POST["name"],
				"form_surname" => $_POST["surname"],
				"form_email" => $_POST["email"],
				"form_password" => $_POST["password"],
				"form_password_confirm" => $_POST["password_confirm"]
			];
		}

		System::redirect();
	}
}
