<?php

namespace App\Controllers\Accounts;

use App\Models\Entities\User;
use App\Models\Repositories\UserRepository;
use App\Utils\Lang;
use App\Utils\System;
use Exception;

class LoginEventController {
	public static function render(array $pageData): void {
		if (
			isset($_POST["email"])
			&& isset($_POST["password"])
		) {
			$user = new User(email: $_POST["email"], password: $_POST["password"]);
			$userRepo = new UserRepository(user: $user);
			$uid = $userRepo->verifyPassword();

			if ($uid instanceof Exception) {
				setcookie("NOTIFICATION", Lang::translate(key: "LOGIN_WRONG_CREDENTIALS"), time() + 60*60*24*30);
			} else {
				$_SESSION["user"]["uid"] = $uid;
				System::redirect(url: "/");
			}
		}
		System::redirect(url: "/login");
	}
}
