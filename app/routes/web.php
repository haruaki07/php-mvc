<?php

use Haruaki07\CompanyProfile\Controller\HomeController;
use Haruaki07\CompanyProfile\Core\Router;

Router::get('/', [HomeController::class]);
Router::get('/about', [HomeController::class, "about"]);
Router::get('/number/([0-9]*)', [HomeController::class, "number"]);
