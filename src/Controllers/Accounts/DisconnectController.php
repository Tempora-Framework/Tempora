<?php

namespace App\Controllers\Accounts;

use App\Attributes\RouteAttribute;
use App\Controllers\Controller;
use App\Utils\System;

class DisconnectController extends Controller {
	#[RouteAttribute(
		path: "/disconnect",
		name: "app_account_disconnect_get",
		method: "GET",
		description: "Disconnect page",
	)]

	public function __invoke(): void {
		session_regenerate_id();

		unset($_SESSION["user"]);

		System::redirect(url: "/");
	}
}
