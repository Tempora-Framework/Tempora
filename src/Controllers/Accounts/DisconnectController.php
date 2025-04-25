<?php

namespace App\Controllers\Accounts;

use App\Controllers\Controller;
use App\Utils\System;

class DisconnectController extends Controller {
	public function __invoke(): void {
		session_regenerate_id();

		unset($_SESSION["user"]);

		System::redirect(url: "/");
	}
}
