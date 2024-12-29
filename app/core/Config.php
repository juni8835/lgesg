<?php

namespace app\core;

class Config
{
    private static array $settings = [];

    /**
     * Load a configuration file and store it under its file name as a key.
     */
    public static function load(string $filePath): void
    {
        if (!file_exists($filePath)) {
            throw new \Exception("Configuration file not found: {$filePath}");
        }

        $config = include $filePath;
        if (!is_array($config)) {
            throw new \Exception("Configuration file must return an array: {$filePath}");
        }

        $key = pathinfo($filePath, PATHINFO_FILENAME);
        self::$settings[$key] = $config;
    }

    /**
     * Load all PHP configuration files in a directory recursively and merge them.
     */
    public static function loadAll(string $directoryPath): void
    {
        $realPath = realpath($directoryPath);
        if (!$realPath || !is_dir($realPath)) {
            throw new \Exception("Invalid configuration directory: {$directoryPath}");
        }

        foreach (scandir($realPath) as $file) {
            $filePath = $realPath . DIRECTORY_SEPARATOR . $file;

            // If file is a directory, call loadAll recursively
            if (is_dir($filePath) && $file !== '.' && $file !== '..') {
                self::loadAll($filePath);
            }

            // If file is a PHP file, load it
            if (is_file($filePath) && pathinfo($filePath, PATHINFO_EXTENSION) === 'php') {
                self::load($filePath);
            }
        }
    }

    /**
     * Get a configuration value using dot notation.
     */
    public static function get(string $key, $default = null)
    {
        $keys = explode('.', $key);
        $value = self::$settings;

        foreach ($keys as $keyPart) {
            if (!isset($value[$keyPart])) {
                return $default;
            }
            $value = $value[$keyPart];
        }

        return $value;
    }

    /**
     * Set a configuration value using dot notation.
     */
    public static function set(string $key, $value): void
    {
        $keys = explode('.', $key);
        $current = &self::$settings;

        foreach ($keys as $keyPart) {
            if (!isset($current[$keyPart])) {
                $current[$keyPart] = [];
            }
            $current = &$current[$keyPart];
        }

        $current = $value;
    }

    /**
     * Get all settings.
     */
    public static function all(): array
    {
        return self::$settings;
    }
}
