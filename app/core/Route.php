<?php
namespace app\core;

class Route
{
    public static array $routes = [];
    public static array $globalMiddlewares = []; // 글로벌 미들웨어 관리
    private static array $currentGroup = [];
    private static array $middlewares = [];

    /**
     * Normalize the URI to ensure it ends with .php if needed
     */
    public static function normalizeUri(string $uri): string
    {
        $uri = trim($uri, '/');

        // If the URI does not end with ".php", append "/index.php"
        if (!str_ends_with($uri, '.php')) {
            $uri = rtrim($uri, '/') . '/index.php';
        }

        return trim($uri, '/');
    }

    /**
     * Add a route to the routing table
     */
    public static function add(string $method, string $uri, $action): void
    {
        $prefix = self::$currentGroup['prefix'] ?? '';
        $uri = self::normalizeUri($prefix . '/' . trim($uri, '/'));
    
        if (is_array($action)) {
            if (!isset($action[0]) || !isset($action[1])) {
                throw new \InvalidArgumentException("Invalid route action format. Expected [Controller::class, 'method']");
            }
        }

        self::$routes[] = [
            'method' => strtoupper($method),
            'uri' => $uri,
            'action' => $action,
            'middlewares' => self::$middlewares,
        ];
    }

    /**
     * Define a GET route
     */
    public static function get(string $uri, $action): void
    {
        self::add('GET', $uri, $action);
    }

    /**
     * Define a POST route
     */
    public static function post(string $uri, $action): void
    {
        self::add('POST', $uri, $action);
    }

    /**
     * Define a route group with optional attributes
     */
    public static function group(array $attributes, callable $callback): void
    {
        // Backup current group and middlewares
        $parentGroup = self::$currentGroup;
        $parentMiddlewares = self::$middlewares;

        // Merge current group with new attributes
        self::$currentGroup = array_merge(self::$currentGroup, $attributes);

        // Apply group middlewares if defined
        if (isset($attributes['middleware'])) {
            self::$middlewares = array_merge(self::$middlewares, $attributes['middleware']);
        }

        // Execute the callback inside the group context
        $callback();

        // Restore the previous group and middlewares
        self::$currentGroup = $parentGroup;
        self::$middlewares = $parentMiddlewares;
    }

    /**
     * Define middlewares for the current route or group
     */
    public static function middleware(array $middlewares): void
    {
        self::$middlewares = array_merge(self::$middlewares, $middlewares);
    }

    /**
     * Register a global middleware
     */
    public static function global(string $middleware): void
    {
        self::$globalMiddlewares[] = $middleware;
    }

    /**
     * Execute all global middlewares
     */
    public static function handleGlobalMiddlewares($request): void
    {
        foreach (self::$globalMiddlewares as $middlewareClass) {
            $middleware = new $middlewareClass();
            $middleware->handle($request, function () {
                // Proceed to the next middleware
            });
        }
    }
}