<?php

namespace App\Factories;

use App\Configs\Role;
use App\Router;
use App\Utils\Lang;

class RouterFactory extends Router {
	private	$controllersPath = "App\Controllers\\";

	public function __construct() {
		// Pages
		parent::add(
			url: "",
			controller: $this->controllersPath . "IndexController"
		);
		parent::add(
			url: "/dashboard",
			controller: $this->controllersPath . "Dashboard\DashboardController",
			title: APP_NAME . " - " . Lang::translate(key: "DASHBOARD_TITLE"),
			needLoginToBe: true,
			accessRoles: [
				Role::ADMINISTRATOR
			]
		);

		// Sessions
		parent::add(
			url: "/login",
			controller: $this->controllersPath . "Accounts\LoginController",
			title: APP_NAME . " - " . Lang::translate(key: "LOGIN_TITLE"),
			needLoginToBe: false
		);
		parent::add(
			url: "/register",
			controller: $this->controllersPath . "Accounts\RegisterController",
			title: APP_NAME . " - " . Lang::translate(key: "REGISTER_TITLE"),
			needLoginToBe: false);
		parent::add(
			url: "/disconnect",
			controller: $this->controllersPath . "Accounts\DisconnectController",
			needLoginToBe: true
		);

		// API
		parent::add(
			url: "/api",
			controller: $this->controllersPath . "API\APIController",
			title: APP_NAME . " - API"
		);
		parent::add(
			url: "/api/users",
			controller: $this->controllersPath . "API\Users\APIUsersController",
			title: APP_NAME . " - API"
		);

	}

	/**
	 * Render route's view
	 *
	 * @param string $url Access URL
	 *
	 * @return void
	 */
	public function render(string $url): void {
		parent::render(url: $url);
	}
}
