<?php

namespace app\facades;

use app\services\storage\StorageManager;

/**
 * @method static string put(string $path, mixed $content)
 * @method static string get(string $path)
 * @method static bool delete(string $path)
 * @method static mixed download(string $path)
 */
class Storage
{
    protected static $manager;

    public static function setManager(StorageManager $manager)
    {
        static::$manager = $manager;
    }

    public static function __callStatic($method, $arguments)
    {
        return call_user_func_array([static::$manager->driver(), $method], $arguments);
    }
}