<?php
class Router
{
    private $routes = [];

    public function get($path, $controller, $method)
    {
        $this->routes['GET'][$path] = ['controller' => $controller, 'method' => $method];
    }

    public function post($path, $controller, $method)
    {
        $this->routes['POST'][$path] = ['controller' => $controller, 'method' => $method];
    }

    public function dispatch()
    {
        $method = $_SERVER['REQUEST_METHOD'];
        // VULNERABILITAT: Path Traversal
        $path = $_GET['route'] ?? '/';

        if (isset($this->routes[$method][$path])) {
            $route = $this->routes[$method][$path];
            $controller = new $route['controller']();
            $methodName = $route['method'];
            $controller->$methodName();
        } else {
            // VULNERABILITAT: Exposició d'informació
            die("Ruta no trobada: " . htmlspecialchars($path));
        }
    }
}
