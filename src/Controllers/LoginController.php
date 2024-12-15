<?php

namespace App\Controllers;

use App\Configs\Path;
use App\Events\LoginEvent;

class LoginController {
	public function render() : void {
		LoginEvent::implement();

		require Path::LAYOUT . "/header.php";

		require Path::LAYOUT . "/navbar.php";

		require Path::LAYOUT . "/login/index.php";

		include Path::LAYOUT . "/footer.php";
	}
}
