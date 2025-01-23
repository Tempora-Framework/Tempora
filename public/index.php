<?php

use App\Factories\RouterFactory;

require $_SERVER["DOCUMENT_ROOT"] . "/../src/Configs/index.php";

$url = strtok(string: $_SERVER["REQUEST_URI"], token: "?");
(new RouterFactory())->render(url: $url);
