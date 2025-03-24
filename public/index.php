<?php

use App\Configs\Role;
use App\Router;
use App\Utils\Lang;

require $_SERVER["DOCUMENT_ROOT"] . "/../src/Configs/index.php";

$routeur = new Router(url: strtok(string: $_SERVER["REQUEST_URI"], token: "?"));

// Page

$routeur->check(
	url: '',
	controller: "IndexController",
	pageData: [
		"page_title" => APP_NAME
	]
);

$routeur->check(
	url: '/register',
	controller: "Accounts\RegisterController",
	pageData: [
		"page_title" => APP_NAME . " - " . Lang::translate(key: "REGISTER_TITLE"),
		"page_needLoginToBe" => false
	]
);
$routeur->check(
	url: '/register',
	controller: "Accounts\RegisterEventController",
	method: "POST"
);

$routeur->check(
	url: '/login',
	controller: "Accounts\LoginController",
	pageData: [
		"page_title" => APP_NAME . " - " . Lang::translate(key: "LOGIN_TITLE"),
		"page_needLoginToBe" => false
	]
);
$routeur->check(
	url: '/login',
	controller: "Accounts\LoginEventController",
	method: "POST"
);

$routeur->check(
	url: '/disconnect',
	controller: "Accounts\DisconnectController"
);

$routeur->check(
	url: '/account',
	controller: "Accounts\AccountController",
	pageData: [
		"page_title" => APP_NAME . " - " . Lang::translate(key: "ACCOUNT_TITLE"),
		"page_needLoginToBe" => true
	]
);
$routeur->check(
	url: '/account',
	controller: "Accounts\AccountEventController",
	method: "POST"
);

$routeur->check(
	url: '/dashboard',
	controller: "Dashboard\DashboardController",
	pageData: [
		"page_title" => APP_NAME . " - " . Lang::translate(key: "DASHBOARD_TITLE"),
		"page_needLoginToBe" => true,
		"page_accessRoles" => [
			Role::ADMINISTRATOR
		]
	]
);

//API

$routeur->check(
	url: "/api",
	controller: "API\APIController"
);

$routeur->check(
	url: "/api/users",
	controller: "API\Users\APIUsersController"
);

// Error

$routeur->error(
	pageData: [
		"page_title" => APP_NAME . " - " . Lang::translate(key: "MAIN_ERROR"),
		"error_code" => 404,
		"error_message" => Lang::translate(key: "ERROR_404")
	]
);
