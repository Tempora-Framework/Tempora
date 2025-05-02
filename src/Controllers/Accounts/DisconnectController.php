<?php

namespace Tempora\Controllers\Accounts;

use Tempora\Attributes\RouteAttribute;
use Tempora\Controllers\Controller;
use Tempora\Utils\System;

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
