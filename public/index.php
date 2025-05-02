<?php

use Tempora\Tempora;

// Paths
define(constant_name: "BASE_DIR", value: __DIR__ . "/..");

// Composer
$autoload = BASE_DIR . "/vendor/autoload.php";
if (!is_file(filename: $autoload)) {
	echo "Please run composer install before starting the application.";
	exit;
}
require $autoload;

// Tempora's kernel
new Tempora;
