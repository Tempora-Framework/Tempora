<?php

use App\Factories\RouterFactory;

require $_SERVER["DOCUMENT_ROOT"] . "/../src/Configs/index.php";

$routerFactory = new RouterFactory(url: strtok(string: $_SERVER["REQUEST_URI"], token: "?"));
