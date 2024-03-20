<?php

use App\Controllers\ClienteController;

$route->get(['/clientes', [ClienteController::class, 'index'] ]);
$route->get(['/cliente/create', [ClienteController::class, 'create']]);
$route->get(['/cliente/edit/{id}', [ClienteController::class, 'edit']]);

$route->post(['/cliente/store', [ClienteController::class, 'store']]);
$route->post(['/cliente/update/{id}', [ClienteController::class, 'update']]);
$route->post(['/cliente/destroy/{id}', [ClienteController::class, 'destroy']]);
