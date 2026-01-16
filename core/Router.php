<?php
namespace Core;

class Router
{
    private array $routes = [
        'GET'  => [],
        'POST' => [],
    ];

    /* ==========================
       DÉCLARATION DES ROUTES
    ========================== */

    public function get(string $path, $callback): void
    {
        $this->routes['GET'][$this->normalize($path)] = $callback;
    }

    public function post(string $path, $callback): void
    {
        $this->routes['POST'][$this->normalize($path)] = $callback;
    }

    /* ==========================
       DISPATCH
    ========================== */

    public function dispatch(): void
    {
        $method = $_SERVER['REQUEST_METHOD'];
        $uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
        $uri = $this->normalize($uri);

        if (!isset($this->routes[$method][$uri])) {
            http_response_code(404);
            echo "404 - Page introuvable";
            return;
        }

        $callback = $this->routes[$method][$uri];

        /* Callback sous forme : [Controller::class, 'method'] */
        if (is_array($callback)) {
            [$controller, $method] = $callback;
            $controllerInstance = new $controller();
            call_user_func([$controllerInstance, $method]);
            return;
        }

        /* Callback anonyme */
        if (is_callable($callback)) {
            call_user_func($callback);
            return;
        }

        throw new \Exception("Route invalide");
    }

    /* ==========================
       UTILS
    ========================== */

    private function normalize(string $path): string
    {
        if ($path === '') {
            return '/';
        }

        $path = '/' . trim($path, '/');
        return rtrim($path, '/') ?: '/';
    }
}
