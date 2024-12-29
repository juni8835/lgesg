<?php 

namespace app\core;

use app\services\errors\ErrorHandler;
use app\facades\Storage;

class Request
{

    public function getMethod(): string
    {
        return $_SERVER['REQUEST_METHOD'] ?? 'GET';
    }

    public function getUri($trimSlash = false): string
    {
        $uri = strtok($_SERVER['REQUEST_URI'], '?') ?? '/';
        
        if($trimSlash){
            return trim($uri, '/');
        }

        return $uri;
    }

    public function all(): array
    {
        return $_REQUEST;
    }

    /**
     * Get a specific request input.
     *
     * @param string $key
     * @param mixed $default
     * @return mixed
     */
    public function input(string $key, $default = null)
    {
        return $_REQUEST[$key] ?? $default;
    }

    /**
     * Check if the request has a specific key.
     *
     * @param string $key
     * @return bool
     */
    public function has(string $key): bool
    {
        return isset($_REQUEST[$key]);
    }

    /**
     * Check if a file is uploaded with the given key.
     */
    public function hasFile(string $key): bool
    {
        return isset($_FILES[$key]) && $_FILES[$key]['error'] === UPLOAD_ERR_OK;
    }

    /**
     * Get uploaded file details.
     */
    public function file(string $key): ?array
    {
        if (!$this->hasFile($key)) {
            return null;
        }

        $file = $_FILES[$key];
        return [
            'name' => $file['name'],
            'type' => $file['type'],
            'tmp_name' => $file['tmp_name'],
            'error' => $file['error'],
            'size' => $file['size']
        ];
    }

    /**
     * Store the uploaded file using the Storage facade.
     */
    public function store(string $key): array
    {
        if (!$this->hasFile($key)) {
            // 파일이 없는 경우 400 Bad Request 예외를 던짐
            ErrorHandler::badRequest("File with key '{$key}' not found.");
        }

        $file = $this->file($key);

        try {
            // Use Storage facade to store the file
            $fullPath = Storage::put($file['name'], file_get_contents($file['tmp_name']));
            $fileName = basename($fullPath); 
            $relativePath = '/'.str_replace(base_path(), '', $fullPath);

            // Return structured JSON-like response
            return [
                'success' => true,
                'message' => 'File uploaded successfully.',
                'data' => [
                    'name' => $fileName, // Securely generated file name
                    'path' => $fullPath,
                    'src' => $relativePath, // Relative directory path (e.g., storage/uploads)
                    'size' => $file['size'],
                    'type' => $file['type']
                ]
            ];
        } catch (\Throwable $e) {
            // 예외 발생 시 ErrorHandler를 사용하여 예외 처리
            ErrorHandler::handle($e);
        }
    }


    /**
     * Validate the incoming request data using the Validator class.
     */
    public function validate(array $rules, array $messages = [], array $customAttributes = []): Validator
    {  
        // Use the Validator class to validate the request data
        $validator = new Validator($this->all(), $rules, $messages, $customAttributes);

        try {
            // Perform validation
            return $validator->validate();
        } catch (\Exception $e) {
            // Handle validation errors
            $this->handleValidationErrors($validator, $e);
        }
    }

    /**
     * Handle validation errors by redirecting or returning errors
     */
    protected function handleValidationErrors(Validator $validator, \Exception $e): void
    {
        // Store errors in session or handle them accordingly
        // This example assumes a redirect back with errors
        session_start();

        $_SESSION['errors'] = $validator->errors();
        $_SESSION['old'] = $this->all();

        // Redirect to the previous page (or a fallback)
        header('Location: ' . ($_SERVER['HTTP_REFERER'] ?? '/'));
        exit;
    }

    /**
     * Get old input data after validation fails
     */
    public function old(string $key, $default = null)
    {
        session_start();
        return $_SESSION['old'][$key] ?? $default;
    }

}
