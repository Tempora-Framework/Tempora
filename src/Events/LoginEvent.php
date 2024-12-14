<?php

namespace App\Events;

use App\Models\Entities\User;
use App\Models\Repositories\UserRepository;
use App\Utils\System;
use Exception;

class LoginEvent {
	public static function implement() : void {
		if ($_SERVER["REQUEST_METHOD"] === "POST") {
			if (
				isset($_POST["email"])
				&& isset($_POST["password"])
			) {
				$user = new User(email: $_POST["email"], password: $_POST["password"]);
				$userRepo = new UserRepository(user: $user);
				$uid = $userRepo->verifyPassword();

				if ($uid instanceof Exception) {
					echo "no";
				} else {
					$_SESSION["user"]["uid"] = $uid;
					System::redirect(path: "/");
				}
			}
		}
	}
}
