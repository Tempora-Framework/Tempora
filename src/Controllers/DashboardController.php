<?php

namespace App\Controllers;

use App\Configs\Path;
use App\Configs\Role;
use App\Utils\Permission;

class DashboardController {
	public function render() : void {
		Permission::check(login: true, rolesWhitelist: [Role::ADMINISTRATOR]);

		require Path::LAYOUT . "/header.php";

		require Path::LAYOUT . "/navbar.php";

		require Path::LAYOUT . "/dashboard/index.php";

		include Path::LAYOUT . "/footer.php";
	}
}
