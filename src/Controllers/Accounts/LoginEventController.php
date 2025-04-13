<?php

namespace App\Controllers\Accounts;

use App\Models\Repositories\UserRepository;
use App\Utils\Lang;
use App\Utils\System;
use Exception;

class LoginEventController {
	public function render(array $pageData): void {
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
				setcookie("NOTIFICATION", Lang::translate(key: "LOGIN_WRONG_CREDENTIALS"), time() + 60*60*24*30);

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
