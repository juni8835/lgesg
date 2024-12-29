<?php

use app\core\App;
use app\core\Config;
use app\core\LoadHelper;

// Autoload dependencies and classes
spl_autoload_register(function ($class) {
    $filePath = dirname(__DIR__).'/'.str_replace('\\', '/', $class) . '.php';

    if (file_exists($filePath)) {
        require_once $filePath;
    }
});

// Load configuration files
Config::loadAll(dirname(__DIR__) . '/config');

// // Load helper files
LoadHelper::loadAll(dirname(__DIR__) . '/app/helpers');

// Register routes
LoadHelper::loadAll(dirname(__DIR__) . '/routes');

// Initialize application
$app = new App(dirname(__DIR__));