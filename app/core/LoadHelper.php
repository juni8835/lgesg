<?php

namespace app\core;

class LoadHelper
{
    /**
     * Load all PHP files from a directory recursively.
     */
    public static function loadAll(string $directoryPath): void
    {
        $realPath = realpath($directoryPath);
        if (!$realPath || !is_dir($realPath)) {
            throw new \Exception("Invalid helpers directory: {$directoryPath}");
        }

        foreach (scandir($realPath) as $file) {
            $filePath = $realPath . DIRECTORY_SEPARATOR . $file;

            // If file is a directory, call loadAll recursively
            if (is_dir($filePath) && $file !== '.' && $file !== '..') {
                self::loadAll($filePath);
            }

            // If file is a PHP file, include it
            if (is_file($filePath) && pathinfo($filePath, PATHINFO_EXTENSION) === 'php') {
                include_once $filePath;
            }
        }
    }
}
