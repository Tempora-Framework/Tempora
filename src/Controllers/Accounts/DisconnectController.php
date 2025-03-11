<?php

namespace App\Controllers\Accounts;

use App\Utils\System;

class DisconnectController {
	public function render(): void {
		session_regenerate_id();

		unset($_SESSION["user"]);

		System::redirect(url: "/");
	}
}
