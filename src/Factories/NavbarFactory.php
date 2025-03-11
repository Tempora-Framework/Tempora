<?php

namespace App\Factories;

use App\Configs\Role;
use App\Utils\Lang;
use App\Utils\Navbar;

class NavbarFactory extends Navbar {
	public function __construct() {
		parent::add(
			title: Lang::translate(key: "NAVBAR_HOME"),
			url: "/",
			class: "button button_secondary"
		);
		parent::add(
			title: Lang::translate(key: "NAVBAR_DASHBOARD"),
			url: "/dashboard",
			class: "button button_secondary",
			needLoginToBe: true,
			accessRoles: [Role::ADMINISTRATOR]
		);

		parent::add(
			title: Lang::translate(key: "NAVBAR_LOGIN"),
			url:"/login",
			class: "button",
			needLoginToBe: false,
		);
		parent::add(
			title: Lang::translate(key: "NAVBAR_REGISTER"),
			url:"/register",
			class: "button",
			needLoginToBe: false,
		);
	}

	/**
	 * Render navbar
	 *
	 * @return void
	 */
	public function render(): void {
		parent::render();
	}
}
