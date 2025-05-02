<?php

namespace App\Factories;

use App\Enums\Role;
use App\Utils\Navbar;

class NavbarFactory extends Navbar {
	public function __construct() {
		parent::add(
			title: "NAVBAR_HOME",
			url: "/",
			icon: "ri-home-2-line",
			class: "button button_secondary"
		);
		parent::add(
			title: "NAVBAR_DASHBOARD",
			url: "/dashboard",
			class: "button button_secondary",
			needLoginToBe: true,
			accessRoles: [
				Role::ADMINISTRATOR->value
			]
		);

		parent::add(
			title: "NAVBAR_LOGIN",
			url: "/login",
			class: "button",
			needLoginToBe: false,
		);
		parent::add(
			title: "NAVBAR_REGISTER",
			url: "/register",
			class: "button",
			needLoginToBe: false,
		);
		parent::add(
			title: "NAVBAR_ACCOUNT",
			url: "/account",
			class: "button",
			needLoginToBe: true,
		);
		parent::add(
			title: "NAVBAR_DISCONNECT",
			url: "/disconnect",
			class: "button",
			needLoginToBe: true,
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
