<?php

namespace App\Events;

use App\Models\Entities\User;
use App\Models\Repositories\UserRepository;
use App\Utils\System;
use Exception;

class RegisterEvent {
	public static function implement() : void {
		if ($_SERVER["REQUEST_METHOD"] === "POST") {
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
						echo "no";
					} else {
						$_SESSION["user"]["uid"] = $uid;
						System::redirect(path: "/");
					}
				} else {
					echo "no";
				}
			}
		}
	}
}
