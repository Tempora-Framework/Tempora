<?php

namespace App\Controllers\Accounts;

use App\Models\Entities\User;
use App\Models\Repositories\UserRepository;
use App\Utils\Lang;
use App\Utils\System;
use Exception;

class RegisterEventController {
	public static function render(array $pageData): void {
		if (
			isset($_POST["name"])
			&& isset($_POST["surname"])
			&& isset($_POST["email"])
			&& isset($_POST["password"])
			&& isset($_POST["password_confirm"])
		) {
			if ($_POST["password"] === $_POST["password_confirm"]) {
				$user = new User(name: $_POST["name"], surname: $_POST["surname"], email: $_POST["email"], password: $_POST["password"]);
				$userRepo = new UserRepository(user: $user);
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
		}
		System::redirect(url: "/register");
	}
}
