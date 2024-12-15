<?php

use App\Configs\Role;
use App\Router;

$router = new Router;

$controllersPath = "App\Controllers\\";

// Pages
$router->add(
	url: "",
	controller: $controllersPath . "IndexController"
);
$router->add(
	url: "/dashboard",
	controller: $controllersPath . "DashboardController",
	needLoginToBe: true,
	accessRoles: [Role::ADMINISTRATOR]
);

// Sessions
$router->add(
	url: "/login",
	controller: $controllersPath . "LoginController",
	needLoginToBe: false
);
$router->add(
	url: "/register",
	controller: $controllersPath . "RegisterController",
	needLoginToBe: false);
$router->add(
	url: "/disconnect",
	controller: $controllersPath . "DisconnectController",
	needLoginToBe: true
);

// Errors
$router->add(
	url: "/error",
	controller: $controllersPath . "ErrorController",
	title: APP_NAME . " - Erreur"
);

// API
$router->add(
	url: "/api",
	controller: $controllersPath . "API\APIController",
	title: APP_NAME . " - API"
);
$router->add(
	url: "/api/users",
	controller: $controllersPath . "API\APIUsersController",
	title: APP_NAME . " - API"
);
