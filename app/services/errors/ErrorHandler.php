<?php

namespace app\services\errors;

use app\core\Config;

class ErrorHandler
{
    /**
     * Handle an exception and return a JSON response with debug information.
     */
    public static function handle(\Throwable $e): void
    {
        $statusCode = $e instanceof HttpException ? $e->getStatusCode() : 500;

        // HTTP 상태 코드 설정
        http_response_code($statusCode);

        // JSON 응답
        echo json_encode([
            'success' => false,
            'message' => $e->getMessage(),
            'file' => $e->getFile(),
            'line' => $e->getLine(),
            'trace' => $e->getTrace()
        ], JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES);
        exit;
    }

    /**
     * Return a 404 error response.
     */
    public static function pageNotFound(): void
    {
        self::outputError(404, 'Page not found.');
    }

    /**
     * Return a 500 error response.
     */
    public static function serverError(string $message = 'Internal server error.'): void
    {
        self::outputError(500, $message);
    }

    /**
     * Return a 403 Forbidden error response.
     */
    public static function forbidden(string $message = 'You do not have permission to access this resource.'): void
    {
        self::outputError(403, $message);
    }

    /**
     * Return a 401 Unauthorized error response.
     */
    public static function unauthorized(string $message = 'Unauthorized access. Please log in.'): void
    {
        self::outputError(401, $message);
    }

    /**
     * Return a 422 Unprocessable Entity error response.
     */
    public static function validationError(array $errors = []): void
    {
        self::outputError(422, 'Validation failed.', $errors);
    }

    /**
     * Return a 400 Bad Request error response.
     */
    public static function badRequest(string $message = 'Invalid request.'): void
    {
        self::outputError(400, $message);
    }

    /**
     * Return a 429 Too Many Requests error response.
     */
    public static function tooManyRequests(string $message = 'Too many requests. Please try again later.'): void
    {
        self::outputError(429, $message);
    }

    /**
     * General method to output an error with debug information.
     */
    private static function outputError(int $statusCode, string $message, $data = null): void
    {
        $debugBacktrace = debug_backtrace(DEBUG_BACKTRACE_IGNORE_ARGS, 2);
        $errorLocation = $debugBacktrace[0] ?? ['file' => 'Unknown file', 'line' => 0]; // 기본값 추가
        http_response_code($statusCode);
        echo json_encode([
            'success' => false,
            'message' => $message,
            'file' => $errorLocation['file'],
            'line' => $errorLocation['line'],
            'data' => $data
        ], JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES);
        if(Config::get('app.debug')){
            throw new \Exception($message); 
        }
        exit;
    }

}
