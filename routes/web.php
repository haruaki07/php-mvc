<?php

use App\Controller\HomeController;
use App\Core\Router;

Router::get('/', [HomeController::class]);
Router::get('/about', [HomeController::class, "about"]);
Router::get('/number/([0-9]*)', [HomeController::class, "number"]);
