<?php

namespace App\Controllers\Accounts;

use App\Models\Entities\User;
use App\Models\Repositories\UserRepository;
use App\Utils\Lang;
use App\Utils\System;
use Exception;

class AccountEventController {
	public function render(array $pageData): void {
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
				setcookie("NOTIFICATION", Lang::translate(key: "LOGIN_WRONG_CREDENTIALS"), time() + 60*60*24*30);
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
				setcookie("NOTIFICATION", Lang::translate(key: "REGISTER_UNIDENTICAL_PASSWORD"), time() + 60*60*24*30);
			}
		}

		System::redirect();
	}
}
