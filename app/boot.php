<?php

use app\core\App;

// Load autoloader
require_once __DIR__.'/autoload.php';

// Run application
try {
    App::$app->run();
} catch (Exception $e) {
    echo "Error: " . $e->getMessage();
    http_response_code(500);
}