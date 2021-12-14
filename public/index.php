<?php

require_once __DIR__ . "/../vendor/autoload.php";

use Haruaki07\CompanyProfile\Core\Router;


$router = new Router;

require_once __DIR__ . "/../app/routes/web.php";

// start listen all registered routes
$router->listen();
