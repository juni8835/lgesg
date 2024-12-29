<?php 

use app\core\Route;
use App\Controllers\AdminController;
use App\Middlewares\AuthMiddleware;

// Define admin routes with middleware
Route::group(['prefix' => 'admin'], function () {
    Route::middleware([AuthMiddleware::class]);

    Route::get('/index.php', function ($request, $response) {
        $controller = new AdminController();
        return $controller->dashboard($request, $response);
    });

    Route::get('/users.php', function ($request, $response) {
        $controller = new AdminController();
        return $controller->users($request, $response);
    });
});

