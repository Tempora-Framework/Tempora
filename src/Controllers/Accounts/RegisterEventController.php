<?php

namespace App\Controllers\Accounts;

use App\Models\Repositories\UserRepository;
use App\Utils\Lang;
use App\Utils\System;
use Exception;

class RegisterEventController {
	public function render(array $pageData): void {
		if (
			System::checkCSRF()
			&& isset($_POST["name"])
			&& isset($_POST["surname"])
			&& isset($_POST["email"])
			&& isset($_POST["password"])
			&& isset($_POST["password_confirm"])
		) {
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
					setcookie("NOTIFICATION", Lang::translate(key: "REGISTER_ALREADY_EXIST", options: ["email" => htmlspecialchars(string: $_POST["email"])]), time() + 60*60*24*30);
				} else {
					$_SESSION["user"]["uid"] = $uid;
					System::redirect(url: "/");
				}
			} else {
				setcookie("NOTIFICATION", Lang::translate(key: "REGISTER_UNIDENTICAL_PASSWORD"), time() + 60*60*24*30);
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
