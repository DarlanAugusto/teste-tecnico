<?php

use App\Controllers\ClienteController;
use App\Controllers\ProdutoController;

$route->get(['/api/v1/produto/show/{id}', [ProdutoController::class, 'showApi'] ]);
$route->get(['/api/v1/cliente/show/{id}', [ClienteController::class, 'showApi'] ]);