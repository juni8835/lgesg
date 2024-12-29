<?php 

namespace app\core;

use app\core\Request;
use app\core\Response;
use Exception;

class Router
{
    private Request $request;
    private Response $response;

    public function __construct(Request $request, Response $response)
    {
        $this->request = $request;
        $this->response = $response;
    }

    /**
     * Resolve the current route and execute its callback
     */
    public function resolve(): void
    {
        $method = $this->request->getMethod();
        $uri = Route::normalizeUri($this->request->getUri(1));
        
        // Execute global middlewares
        Route::handleGlobalMiddlewares($this->request);

        // Find the matching route
        $matchedRoute = $this->findRoute($method, $uri);

        if ($matchedRoute) {
            // Execute middlewares
            $this->handleMiddlewares($matchedRoute['middlewares']);

            // Execute the route callback
            $callback = $matchedRoute['action'];
            $data = $this->executeCallback($callback);

            // Render the view with the data
            render($uri, $data);
            return;
        }

        render($uri, []);

        // Render default 404 view
        $this->response->setStatusCode(404);
        render('errors/404', ['message' => 'Page Not Found']);
    }

    /**
     * Find the matching route from Route::$routes
     */
    private function findRoute(string $method, string $uri): ?array
    {
        foreach (Route::$routes as $route) {
            if ($route['method'] === $method && $route['uri'] === $uri) {
                return $route;
            }
        }
        return null;
    }

    /**
     * Handle middlewares for the current route
     */
    private function handleMiddlewares(array $middlewares): void
    {
        foreach ($middlewares as $middleware) {
            (new $middleware())->handle($this->request, function () {
                // Proceed to the next middleware
            });
        }
    }

    /**
     * Execute the route callback
     */
    private function executeCallback($callback): array
    {
        if (is_callable($callback)) {
            return call_user_func($callback, $this->request, $this->response);
        } elseif (is_array($callback)) {
            [$controller, $method] = $callback;
            $controllerInstance = new $controller();
            return call_user_func([$controllerInstance, $method], $this->request, $this->response);
        }

        throw new Exception("Invalid route callback");
    }
}