<?php

require_once __DIR__ . "/../vendor/autoload.php";

// Setup .env file
$dotenv = Dotenv\Dotenv::createUnsafeImmutable(__DIR__ . DIRECTORY_SEPARATOR . "..");
$dotenv->safeLoad();

use App\Core\Router;

$router = new Router;

require_once __DIR__ . "/../routes/web.php";

// start listen all registered routes
$router->listen();
