<?php

namespace App;

class Router
{
    private array $routes = [];
    public function __construct(private Container $container)
    {
    }
    public function register(string $registerMethod, string $route, callable|array $action)
    {
        $this->routes[$registerMethod][$route] = $action;
        return $this;
    }

    public function get(string $route, callable|array $action)
    {
        return $this->register('GET', $route, $action);
    }

    public function post(string $route, callable|array $action)
    {
        return $this->register('POST', $route, $action);
    }

    public function getRoutes()
    {
        return $this->routes;
    }

    public function resolve(string $requestURI, string $requestMethod)
    {
        $route = explode("?", $requestURI)[0];
        $action = $this->routes[$requestMethod][$route] ?? null;

        if (!$action) {
            throw new \App\Exceptions\NotFoundException();
        }

        if (is_callable($action)) {
            return call_user_func($action);
        }
        if (is_array($action)) {
            [$class, $method] = $action;
            if (class_exists($class)) {
                $class = $this->container->get($class);
                if (method_exists($class, $method)) {
                    return call_user_func_array([$class, $method], []);
                }
            }
        }
        throw new \App\Exceptions\NotFoundException();
    }
}
