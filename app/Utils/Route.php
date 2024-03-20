<?php

namespace App\Utils;

class Route {
    private array $routes;

    public function get($route = []): void 
    {
        $this->routes[ $route[0] ] = [
            $route[1],
            'GET'
        ];
    }

    public function post($route = []): void
    {
        $this->routes[ $route[0] ] = [
            $route[1],
            'POST'
        ];
    }

    public function getRoutes()
    {
        return $this->routes;
    }

}