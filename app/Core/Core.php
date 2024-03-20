<?php

namespace App\Core;

use App\Controllers\AuthController;
use App\Http\Response;
use App\Http\Request;
use App\Utils\Session;

class Core {

    public function run(Request $request, $routes)
    {
        $url = $request->getUri();

        $url = ($url != '/') ? rtrim($url, '/') : $url;

        if(!str_starts_with($url, '/auth')) {
            if(!AuthController::isLoggedIn()) {
                header('Location: /auth/login');
                exit;
            }
        }
        
        foreach($routes as $path => $controller) {
            $pattern = '#^' . preg_replace('/{id}/', '(\w+)', $path) . '$#';

            if(preg_match($pattern, $url, $matches)) {

                if($request->getHttpMethod() != $controller[1]) {
                    return Response::notAllowed();
                }

                array_shift($matches);

                [$currentController, $action] = $controller[0];

                return $currentController::$action($request, $matches[0]);

            }
        }

        return Response::notFound();

    }

}