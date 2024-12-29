<?php

namespace App\Middlewares;

class AuthMiddleware
{
    public function handle($request, $next)
    {
        // if (!isset($_SESSION['user'])) {
        //     http_response_code(401);
        //     die('Unauthorized');
        // }

        // return $next($request);
    }
}
