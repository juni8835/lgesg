<?php

namespace app\core;

use app\core\Request;
use app\core\Response;

class Controller
{
    /**
     * Array of middleware applied to the controller.
     *
     * @var array
     */
    protected array $middlewares = [];

    /**
     * Add a middleware to the controller.
     *
     * @param string $middleware Middleware class name.
     * @return void
     */
    public function middleware(string $middleware): void
    {
        $this->middlewares[] = $middleware;
    }

    /**
     * Handle middleware execution for the given request.
     *
     * @param Request $request
     * @return void
     * @throws \Exception
     */
    public function executeMiddlewares(Request $request): void
    {
        foreach ($this->middlewares as $middlewareClass) {
            $middleware = new $middlewareClass();
            if (method_exists($middleware, 'handle')) {
                $middleware->handle($request, function () {
                    // Next middleware or request continues
                });
            } else {
                throw new \Exception("Middleware {$middlewareClass} must have a 'handle' method.");
            }
        }
    }

    /**
     * Return a JSON response.
     *
     * @param array $data
     * @param int $statusCode
     * @return void
     */
    protected function json(array $data, int $statusCode = 200): void
    {
        (new Response())->setStatusCode($statusCode)->json($data);
    }

    /**
     * Return a view response.
     *
     * @param string $view
     * @param array $data
     * @return void
     */
    protected function view(string $view, array $data = []): void
    {
        (new Response())->view($view, $data);
    }

    /**
     * Redirect to a specific URL.
     *
     * @param string $url
     * @return void
     */
    protected function redirect(string $url): void
    {
        header("Location: {$url}");
        exit;
    }

    /**
     * Return a back response (redirect to the previous URL).
     *
     * @return void
     */
    protected function back(): void
    {
        (new Response())->back();
    }
}
