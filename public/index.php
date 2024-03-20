<?php

ob_start();
session_start();

require_once __DIR__ . '/../vendor/autoload.php';
require_once __DIR__ . '/../routes/web.php';
require_once __DIR__ . '/../routes/api.php';
require_once __DIR__ . '/../routes/auth.php';

use App\Core\Core;
use App\Http\Request;

$request = new Request();

$app = new Core();
$app->run($request, $route->getRoutes());