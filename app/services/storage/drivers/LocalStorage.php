<?php

namespace app\services\storage\drivers;

use app\contracts\StorageInterface;
use app\services\errors\ErrorHandler;

class LocalStorage implements StorageInterface
{
    protected string $root;

    public function __construct(string $root = null)
    {
        $this->root = $root ?? base_path('storage');
    }

    /**
     * Store a file at the specified path with secure naming.
     */
    public function put(string $path, $content): string
    {
        try {
            // Generate secure filename
            $extension = pathinfo($path, PATHINFO_EXTENSION);
            $secureName = $this->generateSecureName($extension);

            // Combine the root path and the directory
            $directory = $this->root . '/' . trim(dirname($path), '/');

            $fullPath = dirname($directory) . '/' . $secureName;

            // Create directory if it doesn't exist
            if (!is_dir($directory)) {
                if (!mkdir($directory, 0755, true)) {
                    ErrorHandler::serverError("Failed to create directory: {$directory}");
                }
            }

            // Write file content
            if (file_put_contents($fullPath, $content) === false) {
                ErrorHandler::serverError("Failed to write file to {$fullPath}");
            }

            // Return the full file path
            return $fullPath;
        } catch (\Throwable $e) {
            // Handle any errors using ErrorHandler
            ErrorHandler::handle($e);
        }
    }

    /**
     * Retrieve the content of a file.
     */
    public function get(string $path): string
    {
        try {
            $fullPath = $this->root . '/' . $path;

            if (!file_exists($fullPath)) {
                ErrorHandler::serverError("File not found: $path");
            }

            return file_get_contents($fullPath);
        } catch (\Throwable $e) {
            ErrorHandler::handle($e);
        }
    }

    /**
     * Delete a file.
     */
    public function delete(string $path): bool
    {
        try {
            $fullPath = $this->root . '/' . $path;

            if (!file_exists($fullPath)) {
                throw ErrorHandler::serverError("File not found: $path");
            }

            return unlink($fullPath);
        } catch (\Throwable $e) {
            ErrorHandler::handle($e);
        }
    }

    /**
     * Download a file.
     */
    public function download(string $path): mixed
    {
        try {
            $fullPath = $this->root . '/' . $path;

            if (!file_exists($fullPath)) {
                throw ErrorHandler::serverError("File not found: $path");
            }

            header('Content-Type: application/octet-stream');
            header('Content-Disposition: attachment; filename="' . basename($path) . '"');
            return readfile($fullPath);
        } catch (\Throwable $e) {
            ErrorHandler::handle($e);
        }
    }

    /**
     * Generate a secure file name using a random hash.
     */
    private function generateSecureName(string $extension): string
    {
        return uniqid('', true) . '.' . $extension;
    }
}
