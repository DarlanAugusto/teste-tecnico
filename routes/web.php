<?php

use App\Controllers\HomeController;
use App\Utils\Route;

$route = new Route();

$route->get([ '/', [HomeController::class, 'index'] ]);

require_once __DIR__ . '/clientes.php';
require_once __DIR__ . '/produtos.php';
