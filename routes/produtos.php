<?php

use App\Controllers\ProdutoController;

$route->get(['/produtos', [ProdutoController::class, 'index'] ]);
$route->get(['/produto/create', [ProdutoController::class, 'create']]);
$route->get(['/produto/edit/{id}', [ProdutoController::class, 'edit']]);

$route->post(['/produto/store', [ProdutoController::class, 'store']]);
$route->post(['/produto/update/{id}', [ProdutoController::class, 'update']]);
$route->post(['/produto/destroy/{id}', [ProdutoController::class, 'destroy']]);