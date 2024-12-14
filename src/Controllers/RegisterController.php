<?php

namespace App\Controllers;

use App\Configs\Path;
use App\Events\RegisterEvent;

class RegisterController {
	public function render() : void {
		RegisterEvent::implement();

		require Path::LAYOUT . "/header.php";

		require Path::LAYOUT . "/navbar.php";

		require Path::LAYOUT . "/register/index.php";

		include Path::LAYOUT . "/footer.php";
	}
}
