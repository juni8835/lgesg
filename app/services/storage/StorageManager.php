<?php 

namespace app\services\storage;

use app\contracts\StorageInterface;
use app\services\errors\ErrorHandler;

class StorageManager
{
    protected array $drivers = [];
    protected string $defaultDriver = 'local';

    public function addDriver(string $name, StorageInterface $driver)
    {
        $this->drivers[$name] = $driver;
    }

    public function setDefaultDriver(string $driver)
    {
        if (!isset($this->drivers[$driver])) {
            ErrorHandler::serverError("Driver [$driver] not found.");
        }
        $this->defaultDriver = $driver;
    }

    public function driver(string $name = null): StorageInterface
    {
        $name = $name ?: $this->defaultDriver;

        if (!isset($this->drivers[$name])) {
            ErrorHandler::serverError("Driver [$name] not found.");
        }

        return $this->drivers[$name];
    }
}
