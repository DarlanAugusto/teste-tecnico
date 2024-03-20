<?php

use App\Controllers\AuthController;

$route->get(['/auth/login', [AuthController::class, 'login'] ]);
$route->post(['/auth/login/do', [AuthController::class, 'loginDo'] ]);
$route->get(['/auth/register', [AuthController::class, 'register'] ]);
$route->get(['/auth/logout', [AuthController::class, 'logout'] ]);
$route->post(['/auth/store', [AuthController::class, 'store'] ]);