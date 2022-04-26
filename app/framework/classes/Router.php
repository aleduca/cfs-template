<?php
namespace app\framework\classes;

use Exception;

class Router
{
    private string $request;
    private string $path;

    private function routeFound($routes)
    {
        if (!isset($routes[$this->request])) {
            throw new Exception("Route {$this->path} does not exist");
        }
        
        if (!isset($routes[$this->request][$this->path])) {
            throw new Exception("Route {$this->path} does not exist");
        }
    }

    private function controllerFound($controllerNamespace, $controller, $action)
    {
        if (!class_exists($controllerNamespace)) {
            throw new Exception("Controller {$controller} does not exist");
        }
        
        if (!method_exists($controllerNamespace, $action)) {
            throw new Exception("Method {$action} does not exist on controller {$controller}");
        }
    }

    public function execute($routes)
    {
        $this->path = path();
        $this->request = request();

        $this->routeFound($routes);

        [$controller, $action] = explode('@', $routes[$this->request][$this->path]);
        
        $controllerNamespace = "app\\controllers\\{$controller}";

        $this->controllerFound($controllerNamespace, $controller, $action);
        
        $controllerInstance = new $controllerNamespace;
        $controllerInstance->$action();
    }
}
