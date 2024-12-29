<?php

namespace App\Middlewares;

class CsrfMiddleware
{
    public function handle($request, $next)
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $token = $_POST['_csrf_token'] ?? '';

            if (empty($token) || $token !== $_SESSION['_csrf_token']) {
                http_response_code(403);
                die('CSRF token mismatch');
            }
        }

        return $next($request);
    }
}
