<?php

namespace App\Controllers;

use App\Configs\Path;
use App\Events\LoginEvent;
use App\Utils\Permission;

class LoginController {
	public function render() : void {
		Permission::check(login: false);

		LoginEvent::implement();

		require Path::LAYOUT . "/header.php";

		require Path::LAYOUT . "/navbar.php";

		require Path::LAYOUT . "/login/index.php";

		include Path::LAYOUT . "/footer.php";
	}
}
