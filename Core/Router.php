<?php

namespace Core;

use Core\Middleware\Authenticated;
use Core\Middleware\Guest;
use Core\Middleware\Middleware;

class Router
{
    protected array $routes = [];

    public function add($method, $uri, $controller): static
    {
        // add to routes array, return instance
        $this->routes[] = [
            'method' => $method,
            'uri' => $uri,
            'controller' => $controller,
            'middleware' => null
        ];

        return $this;
    }

    public function get($uri, $controller): static
    {
        // add a GET route, return it (to be able to chain it with "only")
        // eg. $router->get('/', 'controllers/index.php');
        return $this->add('GET', $uri, $controller);
    }

    public function post($uri, $controller): static
    {
        // add a POST route
        return $this->add('POST', $uri, $controller);
    }

    public function delete($uri, $controller): static
    {
        // add a DELETE route
        return $this->add('DELETE', $uri, $controller);
    }

    public function patch($uri, $controller): static
    {
        // add a PATCH route
        return $this->add('PATCH', $uri, $controller);
    }

    public function put($uri, $controller): static
    {
        // add a PUT route
        return $this->add('PUT', $uri, $controller);
    }

    public function only($key): static
    {
        // for checking authentication; eg. get(...)->only('guest');
        // add to middleware
        $this->routes[array_key_last($this->routes)]['middleware'] = $key;

        return $this;
    }

    /**
     * @throws \Exception
     */
    public function route($uri, $method)
    {
        // todo ?
        // eg. $route->route($uri)
        // To route where ever it needs to go:
        // check if it matches with an existing route
        foreach ($this->routes as $route) {
            if ($route['uri'] === $uri && $route['method'] === strtoupper($method)) {
                Middleware::resolve($route['middleware']);

                return require base_path('Http/controllers/' . $route['controller']);
            }
        }

        // no matching uri in routes
        $this->abort();
    }

    public function previousUrl()
    {
        // use example: redirect($router->previousUrl())
        return $_SERVER['HTTP_REFERER'];
    }

    protected function abort($code = 404)
    {
        // send response code, show error page (default is 404)
        http_response_code($code);

        require base_path("views/{$code}.php");

        die();
    }
}
