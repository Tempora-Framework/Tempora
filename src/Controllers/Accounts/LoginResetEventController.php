<?php

namespace App\Controllers\Accounts;

use App\Models\Repositories\ResetPasswordRepository;
use App\Models\Repositories\UserRepository;
use App\Utils\Lang;
use App\Utils\System;

class LoginResetEventController {
	public function render(array $pageData): void {
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

		setcookie("NOTIFICATION", Lang::translate(key: "LOGIN_RESET_SEND"), time() + 60*60*24*30);

		System::redirect(url: "/login");
	}
}
